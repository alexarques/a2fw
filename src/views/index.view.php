<?php require('partials/head.php');?>
    <title>Home</title>
</head>
<body>
    <!-- <header>
        <h1><?php 
            // session_start();
            // if(isset($_SESSION["username"])){
            // echo "Bienvenido ".$_SESSION["username"];
            // echo "<br>";
            // echo "<h5>Registrado desde: ".$_SESSION["date"]."</h5>";
            // echo "<br>";
         ?></h1>
         <nav>
             <ul>
                 <li><a href="?url=to_do_list">Tasks</a></li>
                 <li><a href="?url=logout_action">Log out</a></li>
             </ul>
         </nav>
        <?php //} ?>
    </header> -->
    <aside>
        <nav>
            <ul class="menu">
                <?php //if($_SESSION["username"]==null){?>
                <li>
                    <a href ="<?=root();?>login">Login</a>
                </li>
                <li>
                    <a href ="<?=root();?>register">Register</a>
                </li>
                <?php //}?>
            </ul>
        </nav>
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
        color:white;
    }
    </style>
</body>
</html>