<?php
session_start();
require_once "connect-db.php";

$user_id = $_SESSION['user']['iduser'];
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$new_password = $_POST['password'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';

$current_password_result = mysqli_query($conn, "SELECT password FROM user WHERE iduser = $user_id"); //ищем пользователя
$user_data = mysqli_fetch_assoc($current_password_result); //получаем массив данных
$current_hashed_password = $user_data['password'];

// Проверяем, не совпадает ли новый пароль с текущим
if (!empty($new_password)) {
    if (password_verify($new_password, $current_hashed_password)) {
        echo "<script>
            alert('Новый пароль не должен совпадать с текущим!');
            window.location.href='profile.php';
        </script>";
        exit();
    }
}

$username = mysqli_real_escape_string($conn, $username);
$email = mysqli_real_escape_string($conn, $email);
$phone = mysqli_real_escape_string($conn, $phone);
$birthdate = mysqli_real_escape_string($conn, $birthdate);

$query = "UPDATE user SET 
          user_name = '$username', 
          email = '$email', 
          phone = '$phone', 
          birthdate = '$birthdate'";

if (!empty($new_password)) {
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $hashed_password = mysqli_real_escape_string($conn, $hashed_password);
    $query .= ", password = '$hashed_password'";
}

$query .= " WHERE iduser = $user_id";

if (mysqli_query($conn, $query)) {
    $_SESSION['user']['user_name'] = $username;
    $_SESSION['user']['email'] = $email;
    $_SESSION['user']['phone'] = $phone;
    $_SESSION['user']['birthdate'] = $birthdate;
    
    echo "<script>
        alert('Данные успешно обновлены!');
        window.location.href='profile.php';
    </script>";
} else {
    echo "<script>
        alert('Ошибка изменения данных');
        window.location.href='profile.php';
    </script>";
}
mysqli_close($conn);
?>