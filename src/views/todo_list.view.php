<?php require('head.php');?>
    <title>Tasks</title>
</head>
<body>
    <header>
        <h1><?php 
            session_start();
            $list = $_SESSION["list"];
            //var_dump($list);
            if(isset($_SESSION["username"])){
         ?></h1>
         <nav>
             <ul>
                 <li><a href="?url=home">Home</a></li>
                 <li><a href="?url=logout_action">Log out</a></li>
             </ul>
         </nav><br>
         <h3>Crea tu lista: </h3>
         <form action="?url=to_do_list_action" method="post">
            <input type="text" name="list" placeholder="Introduce el nombre tu nueva lista"><br><br>
            <input type="submit" name="createlist" value="Crear"><!--Crear</button>-->
         </form>
         <h3>Crea una nueva tarea: </h3>
         <!-- <select name="lists">
            <?php /*foreach($list as $listData){?>
                <option value=<?php echo $listData["id"]; ?>><?php echo $listData["list"];?></option>
            <?php }*/ ?>
         </select> -->
         <form action="?url=to_do_list_action" method="post">
            <select name="lists">
                <?php foreach($list as $listData){?>
                    <option value=<?php echo $listData["id"]; ?> placeholder="Listas"><?php echo $listData["list"];?></option>
                <?php } ?>
            </select>
            <input type="text" name="task" placeholder="Nombre de la tarea">
            <input type="text" name="taskdes" placeholder="Descripción de la tarea"><br><br>
            <input type="submit" name="refresh" value="Recargar listas">
            <input type="submit" name="createtask" value="Crear"><!-- Crear</button> -->
         </form>
         <br>
         <h3>Mostrar lista de tareas: </h3>
         <form action="?url=to_do_list_action" method="post">
            <select name="showLists">
                <?php foreach($list as $listData){?>
                    <option value=<?php echo $listData["id"]; ?> placeholder="Listas"><?php echo $listData["list"];?></option>
                <?php } ?>
            </select>
            <input type="submit" name="showTasks" value="Mostrar las tareas">
         </form>
         <tr>
         <?php foreach($_SESSION["allTasks"] as $allTasks){?>
            <td><?php echo $allTasks[0]; ?> </td>
         <?php } 
         //var_dump($_SESSION["allTasks"]);?>
         </tr>
         <!-- <h4><?php// if (isset($_SESSION["allTasks"]) != null){ echo $_SESSION["createList"]; }?></h4> -->
         <?php //if(isset($_SESSION["list"])){?>
        <?php    
        } else {
            header("Location:?url=login");
        }?>
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