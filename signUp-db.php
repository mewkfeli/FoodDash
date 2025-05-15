<?php
    session_start()
    require_once "connect-db.php";

    if (isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['username'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['pass'];
    }
        
        if (empty($username) || empty($email) || empty($password)) {
            echo "<script>
            alert(\"Заполните все поля\");
            location.href='signup.php';
            </script>";
            exit();
        }
        
        $passHash = password_hash($password, PASSWORD_DEFAULT);
        
        $query_check_user = mysqli_query($conn, "INSERT INTO `user`(`email`, `password`, `user_name`, `birthdate`, `phone`, `avatar`, `status`, `role`) VALUES ('$email','$passHash','$username','2000-01-01','','','Активен', '')");

        if (password_verify($password, $passHash)) {
            $_SESSION['email'] = $email;
            echo "<script>
            alert('Вы зарегистрированы!');
            location.href='signIn-db.php';
            </script>";
            exit();
        } else {
            echo "<script>
            alert('Ошибка регистрации');
            location.href='signUp-db.php';
            </script>";
            exit();
        }
?>