<!--login.php-->
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Please Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/style_login.css">
</head>
<body>
    <div class="blurred-box">
        <div class="user-login-box">
            <h1><div class="word1">ระบบประชาสัมพันธ์</div></h1>
            <div class="word1">กรุณาล็อกอิน</div>
            <form method="POST" action="logon.php">
                <input type="text" class="user-username" placeholder="username" name="user">
                <input type="password" class="user-password" placeholder="password" name="pass">
                <br><input type="submit" class="button" value="Login"> 
            </form>
        </div>
    </div>
</body>
</html>