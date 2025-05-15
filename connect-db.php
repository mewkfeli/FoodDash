<?php
$conn = mysqli_connect('localhost', 'root', '', 'FoodDushBd', '3307');
if (!$conn) {
    echo "<script>
        alert('Возникла ошибка при подключении к БД');
        window.location.href='index.php';
    </script>";
}