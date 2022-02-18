<?php require('partials/head.php'); ?>
    <title>Tasks</title>
</head>
<body>
    <header>
        <div style="display:flex;">
            <div>
                <h1><?php 
                    $list = $_SESSION["list"];
                    //var_dump($list);
                    if(isset($_SESSION["username"])){
                ?></h1>
                <nav>
                    <ul>
                        <li><a href="<?=root();?>main">Home</a></li>
                        <li><a href="<?=root();?>/">Log out</a></li>
                    </ul>
                </nav><br>
                <h2>Bienvenido <?php echo $_SESSION["username"];?></h2><br>
                <h3>Crea tu lista: </h3>
                <!-- Crear list -->
                <form action="<?=root();?>main/formList" method="post">
                    <input type="text" name="list" placeholder="Introduce el nombre tu nueva lista"><br><br>
                    <input type="submit" name="createlist" value="Crear"><!--Crear</button>-->
                </form><br>



                <h3>Crea una nueva tarea: </h3>
                <!-- Crear task -->
                <form action="<?=root();?>main/formTask" method="post">
                    <select name="lists">
                        <?php foreach($list as $listData){?>
                            <option value=<?php echo $listData["id"]; ?> placeholder="Listas"><?php echo $listData["list_name"]?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="task" placeholder="Nombre de la tarea"><br>
                    <input type="text" style="margin:5px;margin-left:63px;" name="taskdes" placeholder="Descripción de la tarea"><br><br>
                    <input type="submit" name="refresh" value="Recargar listas">
                    <input type="submit" name="createtask" value="Crear"><!-- Crear</button> -->
                </form>
                <br><br><br>
                <form action="<?=root();?>main/btnPanel">
                <?php 
                if ($_SESSION["userRol"] == 2) { ?>
                    <a href ="<?=root();?>panel">Panel de profesor</a>
                <?php } else if ($_SESSION["userRol"] == 3) { ?>
                    <a href ="<?=root();?>panel">Panel de administrador</a>
                <?php } ?>
                </form>
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
                <?php foreach($_SESSION["allTasks"] as $allTasks){?>
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
                <?php $_SESSION["created"] = null; } ?>
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
                <form action="<?=root();?>main/delTask" method="post">
                    <select name="tasksDel">
                        <?php foreach($list as $listData){?>
                            <option value=<?php echo $listData["id"]; ?> placeholder="Listas"><?php echo $listData["list_name"]?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="delTask" placeholder="Nombre de la lista">
                    <input type="submit" name="btnDelTask" value="Eliminar" placeholder="Nombre de la lista"><br>
                </form>
            </div>
            <div style="margin-top:10%; margin-left:10%;">
                <h3>Tus cursos: </h3>
                
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
</body>
</html>