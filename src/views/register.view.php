<?php require('partials/head.php');?>
    <title>Register</title>
</head>
<body>
    <header>

    </header>
    <aside>
        <ul>
            <li>
                <a href ="<?=root();?>index">Home</a>
            </li>
        </ul>
        <br>
</aside>
<main>
    <form action="<?= root(); ?>register/form" method="post">
        <input type="username" name="username" placeholder="Nombre de usuario" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Introduce tu contraseña" required><br>
        <input type="password" name="password2" placeholder="Introduce tu contraseña de nuevo" required><br>
        <label style="color:red;"><?php// echo $_SESSION["error_reg"]; ?></label><br><br>
        <select name="rol">
            <option value="1">Alumne</option> 
            <option value="2">Profesor</option> 
        </select><br><br>
        <button type="submit" name="register">Register</button><br><br>
</body>
</html>