<?php require('partials/head.php'); ?>
    <title>Login</title>
</head>
<body>
    <header>
    </header>
    <aside>
        <nav>
            <ul class="menu">
                <li>
                    <a href ="<?=root();?>index">Home</a>
                </li>
            </ul>
        </nav>
        <br>
    </aside>
<main>
    <h3>Iniciar sesión</h3>
    <form action="<?=root();?>login/form" method="post">
        <input type="username" name="username" placeholder="Introduce tu usuario"><br>
        <input type="password" name="password" placeholder="Introduce tu contraseña"><br>
        <label style="color:red;"></label><br>
        <button type="submit" name="login">Login</button><br><br>
        <!--<input type="checkbox" id="remember" name="remember"><label for="remember">Remember me</label>-->
    </form>
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
        input{
            margin:2px;
        }
        </style>
</body>
</html>