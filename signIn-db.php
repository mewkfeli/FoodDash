<?php
session_start();
require_once "connect-db.php";

// Проверяем авторизацию в самом начале
if(isset($_SESSION['user'])) {
    header("Location: profile.php");
    exit();
}

$email = $_POST['email'] ?? '';
$pass = $_POST['pass'] ?? '';

if(!empty($email) && !empty($pass)) {
    $query = "SELECT * FROM `user` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        if(password_verify($pass, $user['password'])) {
            if ($user['status'] == 'Удалён') {
                echo "<script>
                    alert('Аккаунт удалён!');
                    location.href='signIn-db.php';
                </script>";
                exit(); 
            }

            $_SESSION['user'] = $user;
            echo "<script>
                alert('Добро пожаловать!');
                location.href='profile.php';
            </script>";
            exit(); 
        } else {
            echo "<script>
                alert('Неверный пароль!');
                location.href='signIn-db.php';
            </script>";
            exit(); 
        }
    } else {
        echo "<script>
            alert('Пользователь не найден');
            location.href='signIn-db.php';
        </script>";
        exit(); 
    }
    exit();
} else {
    echo "<script>
        alert('Заполните все поля');
        location.href='signIn-db.php';
    </script>";
    exit(); 
}
?>