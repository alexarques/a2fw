<?php require('partials/head.php'); ?>
    <title>Login</title>
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
    <form action="<?=root();?>login/form" method="post">
        <input type="username" name="username" placeholder="Introduce tu usuario"><br>
        <input type="password" name="password" placeholder="Introduce tu contraseña"><br>
        <label style="color:red;"></label><br><br>
        <button type="submit" name="login">Login</button><br><br>
        <!--<input type="checkbox" id="remember" name="remember"><label for="remember">Remember me</label>-->
</body>
</html>