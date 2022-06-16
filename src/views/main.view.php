<?php require('partials/head.php'); use App\Registry;?>
    <title>Tasks</title>
</head>
<body>
    <header>
        <nav>
            <ul class="menu">
                <li><a href="<?=root();?>main">Home</a></li>
                <li><a href="<?=root();?>/">Log out</a></li>
            
            <form action="<?=root();?>main/btnPanel">
            <?php 
            if ($_SESSION["userRol"] == 2) { ?>
                <li><a href ="<?=root();?>panel">Panel de profesor</a></li>
            <?php } else if ($_SESSION["userRol"] == 3) { ?>
                <li><a href ="<?=root();?>panel">Panel de administrador</a></li>
            <?php } ?>
            </form>
            </ul>
        </nav><br>
        <div style="display:flex;">
            <div>

                <h1><?php 
                    if(isset($_SESSION["list"])){
                        $list = $_SESSION["list"];
                    } else {
                        $list = "";
                    }
                    //var_dump($list);
                    if(isset($_SESSION["username"])){
                ?></h1>

                <h2>Bienvenido <?php echo $_SESSION["username"];?></h2><br>
                <h3>Crea tu lista: </h3>
                <!-- Crear list -->
                <form action="<?=root();?>main/formList" method="post">
                    <input type="text" name="list" placeholder="Introduce el nombre tu nueva lista">
                    <input type="submit" name="createlist" value="Crear"><!--Crear</button>-->
                </form><br>



                <h3>Crea una nueva tarea: </h3>
                <!-- Crear task -->
                <form action="<?=root();?>main/formTask" method="post">
                    <select name="lists" style="margin:2px;">
                        <?php foreach($list as $listData){?>
                            <option value=<?php echo $listData["id"]; ?> placeholder="Listas"><?php echo $listData["list_name"]?></option>
                        <?php } ?>
                    </select><br>
                    <input type="text" style="margin:2px;" name="task" placeholder="Nombre de la tarea"><br>
                    <input type="text" style="margin:2px;" name="taskdes" placeholder="Descripción de la tarea"><br><br>
                    <input type="submit" name="refresh" value="Recargar listas">
                    <input type="submit" name="createtask" value="Crear"><!-- Crear</button> -->
                </form>
                <br><br><br>

            </div>           

            <div style="margin-top:10%; margin-left:10%;">                   
                <h3>Mostrar lista de tareas: </h3>
                <!-- Show list -->
                <form action="<?=root();?>main/form" method="post">
                    <select name="showLists">
                        <?php foreach($list as $listData){?>
                            <option value=<?php echo $listData["id"]; ?> placeholder="Listas"><?php echo $listData["list_name"]; ?></option>
                        <?php } ?>
                    </select>
                    <input type="submit" name="showTasks" value="Mostrar las tareas">
                </form>
                <tr>
                <?php 
                    foreach($_SESSION["allTasks"] as $allTasks){?>
                    <br><td><b><?php echo $allTasks[0]; echo ":</b> "; echo $allTasks[1];?> </td>
                <?php } 
                //var_dump($_SESSION["allTasks"]);?>
                </tr>
                <!-- <h4><?php// if (isset($_SESSION["allTasks"]) != null){ echo $_SESSION["createList"]; }?></h4> -->
                <?php //if(isset($_SESSION["list"])){?>
                <?php    
                } else {
                    header("Location:?url=login");
                }?>
                <?php if($_SESSION["created"] != null) {?>
                    <script type="text/javascript"> alert("Se ha creado correctamente"); </script>
                <?php $_SESSION["created"] = null; }?>
            </div>
            <div style="margin-top:10%; margin-left:5%;"> 
                <h3>Eliminar lista: </h3>
                <form action="<?=root();?>main/delList" method="post">
                    <select name="listsDel" style="width:260px">
                        <?php foreach($list as $listData){?>
                            <option value=<?php echo $listData["id"]; ?> placeholder="Listas"><?php echo $listData["list_name"]?></option>
                        <?php } ?>
                    </select>
                    <input type="submit" name="btnDelList" value="Eliminar" placeholder="Nombre de la lista"><br>
                </form><br><br>
                <h3>Eliminar tarea: </h3>
                <!-- <form action="<?=root();?>main/actTask" method="post"> -->
                <form action="<?=root();?>main/delTask" method="post">
                    <select name="listsDel">
                        <?php foreach($list as $listData){
                            $listDataName = str_replace(' ', '_', $listData["list_name"]);?>
                            <option placeholder="Listas"><?php echo $listData["list_name"]?></option>
                        <?php } ?>
                    </select>
                    
                    <select name="tasksDel">
                        <?php foreach($_SESSION["taskDel"] as $task){?>
                            <option placeholder="Tareas"><?php echo $task["tarea_name"];?></option>
                        <?php } ?>
                    </select>
                    <!-- <input type="text" name="delTask" placeholder="Nombre de la lista"> -->
                    
                    <input type="submit" name="btnDelTask" value="Eliminar" placeholder="Nombre de la lista"><br>
                <!-- </form> -->
                
                    <input type="submit" name="refresh" value="Actualizar">
                </form>
            </div>
            <div style="margin-top:10%; margin-left:10%;">
                <h3>Tus cursos: </h3>
                <div style="display:flex;flex-direction:row">
                <?php 
                    $db = Registry::get('database');
                    $sql_usrCurs = "SELECT id_curso from usuarios_cursos WHERE id_usuarios = '".$_SESSION["usrid"]."';";
                    $stmt_usrCurs = $db->query($sql_usrCurs);
                    $stmt_usrCurs->execute();
                    $allUsersCurs = $stmt_usrCurs->fetchAll();
                    
                    for($i=0;$i<count($allUsersCurs);$i++){
                        $sql_shUsrCurs = "SELECT * from cursos WHERE id = '".$allUsersCurs[$i]["id_curso"]."';";
                        $stmt_shUsrCurs = $db->query($sql_shUsrCurs);
                        $stmt_shUsrCurs->execute();
                        $allShUsersCurs = $stmt_shUsrCurs->fetchAll();
                        // var_dump($allShUsersCurs);
                        //var_dump($allUsersCurs[$i]["id_curso"]);
                        echo "<div style='background-color:gray;color:white;border: 1px solid black;padding-left:15px;padding-right:15px;margin:5px; border-radius:5px'>";
                        echo "<h4>".$allShUsersCurs[0]["curs_name"]."</h4>";
                        echo "<hr>";

                        $sql_usrCurs1 = "SELECT id_usuarios from usuarios_cursos WHERE id_curso = '".$allUsersCurs[$i]["id_curso"]."';";
                        $stmt_usrCurs1 = $db->query($sql_usrCurs1);
                        $stmt_usrCurs1->execute();
                        $allUsersCurs1 = $stmt_usrCurs1->fetchAll();
                        //  var_dump($allUsersCurs1);
                        echo "<b>Profesores: </b><br>";
                        for($o=0;$o<count($allUsersCurs1);$o++){
                            // var_dump($allUsersCurs1[$o]["id_usuarios"]);
                            $sql_shUsrCurs2 = "SELECT username from usuarios WHERE rol = '2' AND id = '".$allUsersCurs1[$o]["id_usuarios"]."';";
                            $stmt_shUsrCurs2 = $db->query($sql_shUsrCurs2);
                            $stmt_shUsrCurs2->execute();
                            $allShUsersCurs2 = $stmt_shUsrCurs2->fetchAll();
                            echo $allShUsersCurs2[0]["username"]."<br> ";
                            // for($i=0;$i<count($allShUsersCurs2);$i++){
                            //     echo $allShUsersCurs2[$i]["username"]."<br>";
                        }
                        echo "</div>";
                    }

                        // foreach($allUsersCurs1 as $usrID){
                        //     var_dump();
                        //     $sql_shUsrCurs2 = "SELECT username from usuarios WHERE rol = '2' AND id = '".$usrID[0]."';";
                        //     $stmt_shUsrCurs2 = $db->query($sql_shUsrCurs2);
                        //     $stmt_shUsrCurs2->execute();
                        //     $allShUsersCurs2 = $stmt_shUsrCurs2->fetchAll();
                        //     for($i=0;$i<count($allShUsersCurs2);$i++){
                        //         echo $allShUsersCurs2[$i]["username"]."<br>";
                        //     }
                        // }
                ?>
                </div>
            </div>
        </div>
    </header>
    <aside>
        <ul>
            <?php if($_SESSION["username"]==null){?>
            <li>
                <a href="?url=login">Login</a>
            </li>
            <li>
                <a href="?url=register">Register</a>
            </li>
            
            <?php }?>
        </ul>
    </aside>
    <style>

    *{
        font-family:sans-serif;
    }
    body {
        background-color:#cecece;
    }
    .menu {
        display:flex;
        flex-direction:row;
        list-style-type: none;
    }
    .menu li{
        margin-right:20px;
        
    }
    .menu li a{
        text-decoration: none;
        color:white;
    }
    .menu li a:hover{
        text-decoration: none;
        color:#cecece;
    }
    nav {
        background-color: black;
        padding:20px;
        /* margin-right:20px; */
        /* width:100%; */
        color:white;
    }
    </style>
</body>
</html>