<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: signIn-db.php');
    exit();
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <link href="https://fonts.googleapis.com/css?family=Wendy+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lexend&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link href="../css/profile.css" rel="stylesheet">

</head>
<body>
    <header>
        <div class="header-block">
            <div class="logo-header">
                <img src="../resources/logo.svg" alt="Логотип FoodDash">
            </div>
            <nav>
                <ul class="links-header">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="Offers">Offers</a></li>
                    <li><a href="Service">Service</a></li>
                    <li><a href="About Us">About Us</a></li>
                </ul>
            </nav>
            <div class="button-header">
                <a href="#" aria-label="Search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                        <path d="M14.3333 14.3333L21 21M8.77778 16.5556C4.48223 16.5556 1 13.0733 1 8.77778C1 4.48223 4.48223 1 8.77778 1C13.0733 1 16.5556 4.48223 16.5556 8.77778C16.5556 13.0733 13.0733 16.5556 8.77778 16.5556Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>
                <a href="authorization.php" aria-label="User Profile" style="width: 50px; height: 50px;">
                    <img src="../resources/user.svg" alt="Фото пользователя">
                </a>
            </div>
        </div>
    </header>
    
    <div class="container">        
        <main class="profile-content">
            <form class="profile-form" action="update_profile.php" method="POST">
                <h2 class="section-title">Personal data</h2>
                <div class="two-column-form">
                    <div class="form-column">
                        
                        <div class="form-group">
                            <label class="form-label">Username</label>
                            <div class="input-container">
                                <input type="username" required class="form-input" name="username" 
                                value="<?= $user['user_name'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <div class="input-container">
                                <input type="email" required class="form-input" name="email" 
                                value="<?= $user['email'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Phone number</label>
                            <div class="input-container">
                                <input type="tel" required placeholder="+7 (___) ___-____" minlength=11 maxlength=11  class="form-input" name="phone"
                                value="<?= $user['phone'] ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-column">
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <div class="input-container">
                            <input type="password" placeholder="******" class="form-input" name="password">
                            </div>
                        </div>
                        
                        <div class="birthday-group"> 
                            <div class="birthday-field">
                                <label class="form-label">Birthday Date</label>
                                <div class="input-container">
                                <input type="text" class="form-input" required name="birthdate" pattern="\d{4}\-\d{2}\-\d{2}\" 
                                placeholder="ГГГГ-ММ-ДД"
                                value="<?= $user['birthdate'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="button" class="delete-account-btn" onclick="confirmDelete()">Delete Account</button>
                    <button type="submit" class="save-btn">Save</button>
                    <?php 
                    if ($user['role'] === 'admin'): ?>
                        <a href="../admin_panel.php" class="admin-btn">Admin Panel</a>
                    <?php endif; ?>
                    <a href="../exit-db.php">Exit</a>
                </div>
            </form>
            
            <div class="welcome-section">
                <h2 class="welcome-message" value="You're welcome, <?= $user['username'] ?>!">You're welcome!</h2>
                <img class="profile-image" src="../resources/user.svg" ?>
            </div>
        </main>
    </div>

    <script>
        function confirmDelete() {
            if (confirm('Удалить аккаунт?')) {
                window.location.href = 'delete_account.php';
            }
        }
    </script>
</body>
</html>