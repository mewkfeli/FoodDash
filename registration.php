<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/auth.css">
    <title>Регистрация</title>
</head>
<body>
    <main class="auth-container">
        <section class="photo-left">
            <img src="../resources/background_auth.png" style="width: 740px; height: 1110px" alt="Картинка слева">
        </section>
        <section class="right-container">
            <div class="logo-header">
                <a href="index.php"><img src="../resources/logo.svg" alt="Логотип FoodDash"></a>
            </div>
            <div class="text">
                <h1>Create Account</h1>
            </div>
            <div class="form-container">
                <form action="signUp-db.php" method="POST">
                    <div class="username-container">
                        <label for="username">Username</label><br>
                        <input name="username" type="text" id="username" placeholder="Enter your username" required>
                    </div>
                    <div class="email-container">
                        <label for="email">Email Address</label><br>
                        <input name="email" type="email" id="email" placeholder="Youraddres@email.com" required>
                    </div>
                    <div class="pass-container">
                        <label for="pass">Password</label><br>
                        <input name="pass" type="password" id="pass" placeholder="Enter your password" required>
                    </div>
                    <button type="submit">Register</button>
                    <p>Already have an account? <a href="authorization.php"><span>Sign in</span></a></p>
                </form>
            </div>
            <div class="button-auth">
                <button><img src="../resources/google.svg" alt="google logo"> Login with Google</button>
                <button><img src="../resources/facebook.svg" alt="facebook logo"> Login with Facebook</button>
            </div>
        </section>
    </main>
</body>
</html>