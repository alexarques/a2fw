<?php require('partials/head.php');?>
    <title>Register</title>
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
    <h3>Registrar usuario</h3>
    <form action="<?= root(); ?>register/form" method="post">
        <input type="username" name="username" placeholder="Nombre de usuario" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Introduce tu contraseña" required><br>
        <input type="password" name="password2" placeholder="Introduce tu contraseña de nuevo" required><br>
        <label style="color:red;"><?php// echo $_SESSION["error_reg"]; ?></label><br>
        <select name="rol">
            <option value="1">Alumne</option> 
            <option value="2">Profesor</option> 
        </select>
        <button type="submit" name="register">Register</button><br>
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