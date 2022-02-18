<?php require('partials/head.php'); ?>
    <title>Tasks</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="<?=root();?>main">Home</a></li>
            <li><a href="<?=root();?>/">Log out</a></li>
        </ul>
    </nav><br>
    <header>
        <h2>Controlador de <?php if ($_SESSION["userRol"] == 2){ echo "profesor"; } else if ($_SESSION["userRol"] == 3) { echo "administrador"; } ?></h2>
    </header>
    <?php var_dump($_SESSION["usrList"]);?>
    <form action="<?=root();?>panel/curs" method="post">
        <select name="usrList">
            <?php foreach($_SESSION["usrList"] as $usr){?>
                <option value=<?php echo $usr["id"]; ?> placeholder="Users"><?php echo $usr["username"]?></option>
            <?php } ?>
        </select>
    </form>
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
</body>
</html>