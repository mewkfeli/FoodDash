<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: signIn-db.php');
    exit();
}
require_once "connect-db.php";

$user_id = $_SESSION['user']['iduser'];

$query = "UPDATE `user` SET `status`='Удалён' WHERE `iduser` = $user_id";
$result = mysqli_query($conn, $query);
    
if(mysqli_num_rows($result) >= 0) {
    // Уничтожаем сессию
    session_unset();
    session_destroy();
    echo "<script>
            alert('Аккаунт успешно удалён!');
            location.href='index.php';
        </script>";
        exit();
} 
else {
    echo "<script>
    location.href='index.php';
</script>";
}

exit();
?>