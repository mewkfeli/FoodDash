<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/auth.css">
    <title>Авторизация</title>
</head>
<body>
    <main class="auth-container">
        <section class="header-container">
            <img src="..\resources\background_auth.png" alt="Картинка слева">
        </section>
        <section class="right-container">
            <div class="logo-header">
                <a href="index.php"><img src="../resources/logo.svg" alt="Логотип FoodDash"></a>
            </div>
            <div class="text">
                <h1>Login to your account!</h1>
            </div>
            <div class="button-auth">
                <button><img src="..\resources\google.svg" alt="google logo"> Login with Google</button>
                <button><img src="..\resources\facebook.svg" alt="facebook logo"> Login with Facebook</button>
            </div>
            <div class="or">
                <p>OR</p>
            </div>
            <div class="form-container" style="margin-top: -55px;">
                <form action="signIn-db.php" method="POST" class="block-signIn">
                    <div class="email-container">
                        <label for="email">Email Address</label><br>
                        <input name="email" type="email" id="email" required>
                    </div>
                    <div class="pass-container">
                        <label for="pass">Password</label><br>
                        <input name="pass" type="password" id="pass" required>
                        <button type="submit">Login To Continue</button>
                        <p>Don't have an account? <a href="registration.php"><span>Sign up</span></a></p>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>