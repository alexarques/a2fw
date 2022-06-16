<?php require('partials/head.php'); use App\Registry;?>
    <title>Tasks</title>
</head>
<body>
    <nav>
        <br>
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
    <header>
        <h2>Panel del <?php if ($_SESSION["userRol"] == 2){ echo "profesor"; } else if ($_SESSION["userRol"] == 3) { echo "administrador"; } ?></h2><br><br>
    </header>
    <?php //var_dump($_SESSION["usrList"]);?>
    
    <div style="display:flex;flex-direction:row;">
        <?php if($_SESSION["userRol"]==3){ ?>
            <div>
            <h3>Crea un curso:</h3>
                <form action="<?=root();?>panel/curs" method="post">
                    <input type="text" name="nameCurs">
                    <input type="submit" name="createCurs" value="Crear curso">
                </form>
            </div>
        <?php } ?>
        <div style="margin-left:30px">
        <h3>Crea una materia:</h3>
            <form action="<?=root();?>panel/curs" method="post">
                <select name="crearMatCurs">
                    <?php foreach($_SESSION["shCurs"] as $cursMat){ ?>
                        <option value="<?php echo $cursMat["id"] ?>"><?php echo $cursMat["curs_name"] ?></option>
                    <?php }?>
                </select>
                <?php if ($_SESSION["userRol"] == 3){ ?>
                    <select name="crearMatProf">
                        <?php foreach($_SESSION["shProf"] as $professor){ ?>
                            <option value="<?php echo $professor["id"] ?>"><?php echo $professor["username"] ?></option>
                        <?php }?>
                    </select>
                <?php } else {?>
                    <input type="text" name="crearMatProf" value="<?php echo $_SESSION["usrid"]?>" hidden>
                <?php } ?>
                    <input type="text" name="nameMat">
                    <input type="submit" name="createMat" value="Crear materia">
            </form>
        </div>
    </div>
    <br>
    <?php $num = 0; ?>
    <div style="display:flex;flex-direction:row">
        <?php foreach($_SESSION["shCurs"] as $curs){
            $num++?>
            <div style="background-color:gray;border: 1px solid black; width:10%;margin:5px; border-radius:5px">
                <h5 style="margin-left:10px;color:white"><?php echo "Curs: ".$curs["curs_name"]; ?></h5>
                <?php 
                    $db = Registry::get('database');
                    $sql_allMat = "SELECT materia_name from materias WHERE id_curs = '".$curs["id"]."';";
                    $stmt_allMat= $db->query($sql_allMat);
                    $stmt_allMat->execute();
                    $allMat = $stmt_allMat->fetchAll();
                ?>
                <select name="materiasView" style="margin:10px">
                    <?php foreach($allMat as $materia){ ?>
                        <option ><?php echo $materia[0] ?></option>
                    <?php }?>
                </select><br>
                <?php if($_SESSION["userRol"]==3){ ?>
                    <form action="<?=root();?>panel/curs" method="post">
                        <input type="text" name="deleteCursName" value="<?php echo $curs['curs_name']?>" hidden>
                        <input style="margin:10px" type="submit" name="deleteCurs" value="Eliminar curso">
                    </form>
                <?php } ?>
            </div>
            <br>

        <?php } ?>
    </div>
    <br><br>
    <hr>
    <br><br>

    <h2>Lista de usuarios:</h2>
    
        <?php foreach($_SESSION["usrList"] as $usr){?>
            <form action="<?=root();?>panel/edit" method="post">
            <?php switch($usr["rol"]){
                case 1:
                    $rol = "estudiante";
                    break;
                case 2:
                    $rol = "profesor";
                    break;
                case 3:
                    $rol = "administrador";
                    break;
                }?>
                <h3 style="margin-bottom:0px;"><?php echo $usr["username"]; ?></h3>
            <div style="display:flex;flex-direction:row;">
                <h5 style="margin-right:20px;"><?php echo "email: ".$usr["email"]; ?></h5> <h5><?php echo "rol: ".$rol; ?></h5>
            </div>
            <?php 
                $db = Registry::get('database');
                $sql_usrCurs = "SELECT id_curso from usuarios_cursos WHERE id_usuarios = '".$usr["id"]."';";
                $stmt_usrCurs = $db->query($sql_usrCurs);
                $stmt_usrCurs->execute();
                $allUsersCurs = $stmt_usrCurs->fetchAll();
                for($i=0;$i<count($allUsersCurs[0]);$i++){
                    $sql_shUsrCurs = "SELECT curs_name from cursos WHERE id = '".$allUsersCurs[$i][0]."';";
                    $stmt_shUsrCurs = $db->query($sql_shUsrCurs);
                    $stmt_shUsrCurs->execute();
                    $allShUsersCurs = $stmt_shUsrCurs->fetchAll();
                    echo "<b>Curs:</b> ".$allShUsersCurs[0][0]."<br>";
                }

            ?>
            <?php if($_SESSION["userRol"]==3){ ?>
            <div style="display:flex;flex-direction:row;">
                <div>
                    <h5>Asignar rol:</h5>
                    <select name="roleSelect">
                        <option value=1>Estudiante</option>
                        <option value=2>Professor</option>
                        <option value=3>Administrador</option>
                    </select>
                    <?php// echo $usr["username"]; ?>
                    <input type="text" name="roleSelectUsr" value=<?php echo $usr["username"]; ?> hidden>
                    <input type="submit" name="roleSelectBtn" value="Asignar"><br>
                </div>
            <?php } ?>
                <div style="margin-left:30px">
                    <h5>Asignar curso:</h5>
                    <select name="cursoSelect">
                        <?php foreach($_SESSION["shCurs"] as $curs){?>
                            <option><?php echo $curs["curs_name"] ?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="cursoSelectUsr" value="<?php echo $usr["id"]; ?>" hidden>
                    <input type="submit" name="cursoSelectBtn" value="Asignar"><br>
                </div>
                <?php if($_SESSION["userRol"]==3){ ?>
                <div style="display:flex; height:30px; margin-top:55px; margin-left:40px">
                    <input type="submit" name="delUser" value="Eliminar Usuario">
                </div>
                <?php } ?>
            </div>
            <br><br>
            <hr>
            </form>
        <?php } ?>
    
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
        body nav {
            background-color: black;
            padding-bottom:20px;
            padding-left:20px;
            color:white;
        }
    </style>
</body>
</html>