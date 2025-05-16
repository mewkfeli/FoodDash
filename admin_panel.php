<?php
session_start();
require_once 'connect-db.php';

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add':
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $weight = mysqli_real_escape_string($conn, $_POST['weight']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $uploadDir = '../resources/';
                
                // Берём оригинальное имя файла (с расширением)
                $originalName = basename($_FILES['image']['name']);
                $uploadPath = $uploadDir . $originalName;
                
                // Перемещаем файл
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                    $url_photo = '../resources/' . $originalName;
                }
            }
            
            $query = "INSERT INTO food (name, id_category, price, weight, description, url_photo) 
                      VALUES ('$name', '$category', '$price', '$weight', '$description', '$url_photo')";
            mysqli_query($conn, $query);
            break;
            
        case 'edit':
            // Редактирование блюда
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $weight = mysqli_real_escape_string($conn, $_POST['weight']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            
            // Получаем текущий путь к изображению
            $currentImage = '';
            $result = mysqli_query($conn, "SELECT url_photo FROM food WHERE idfood = '$id'");
            if ($row = mysqli_fetch_assoc($result)) {
                $currentImage = $row['url_photo'];
            }
            
            // Обработка загрузки нового изображения
            $url_photo = $currentImage;
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                if (!empty($currentImage) && file_exists('../' . $currentImage)) {
                    unlink('../' . $currentImage); //удаляем файл из системы
                }
                
                $uploadDir = '../resources/';
                $fileName = basename($_FILES['image']['name']);                
                $uploadPath = $uploadDir . $fileName;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                    // перемещает загруженный файл из временной папки
                    $url_photo = '../resources/' . $fileName;
                }
            }
            
            $query = "UPDATE food SET 
                      name = '$name',
                      id_category = '$category',
                      price = '$price',
                      weight = '$weight',
                      description = '$description',
                      url_photo = '$url_photo'
                      WHERE idfood = '$id'";
            mysqli_query($conn, $query);
            break;
            
        case 'delete':
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $query = "SELECT url_photo FROM food WHERE idfood = '$id'";
            $result = mysqli_query($conn, $query);
            
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $filePath = $row['url_photo'];
                if (file_exists($filePath)) {
                    unlink($filePath); // Удаление файла
                }
            }
            
            $query = "DELETE FROM food WHERE idfood = '$id'";
            mysqli_query($conn, $query);
            break;
    }
}

// Получаем список пользователей
$users = [];
$usersResult = mysqli_query($conn, "SELECT * FROM user");
if ($usersResult) {
    while ($row = mysqli_fetch_assoc($usersResult)) {
        $users[] = $row;
    }
}

// Получаем список блюд
$dishes = [];
$dishesResult = mysqli_query($conn, "SELECT * FROM food");
if ($dishesResult) {
    while ($row = mysqli_fetch_assoc($dishesResult)) {
        $dishes[] = $row;
    }
}

// Получаем список категорий для выпадающего списка
$categories = [];
$categoriesResult = mysqli_query($conn, "SELECT * FROM category");
if ($categoriesResult) {
    while ($row = mysqli_fetch_assoc($categoriesResult)) {
        $categories[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="../css/admin_panel.css" rel="stylesheet">
</head>
<body>
    <div class="admin-container">
        <!-- Меню админ-панели -->
        <div class="admin-menu">
            <div class="logo-header">
                <img src="../resources/logo.svg" alt="Логотип FoodDash">
            </div>
             <ul>
                <li><a href="#users">Пользователи</a></li>
                <li><a href="#dishes">Блюда</a></li>
                <li><a href="../index.php">На сайт</a></li>
                <li><a href="../exit-db.php">Выйти</a></li>
            </ul>
        </div>
        
        <!-- Основное содержимое -->
        <div class="admin-content">
            <div class="admin-header">
                <h1>Панель администратора</h1>
                <p>Добро пожаловать, <?= $_SESSION['user']['user_name'] ?>!</p>
            </div>
            
            <!-- Секция пользователей -->
            <div class="section" id="users">
                <h2>Пользователи</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Email</th>
                            <th>Телефон</th>
                            <th>Дата рождения</th>
                            <th>Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['iduser'] ?></td>
                            <td><?= $user['user_name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['phone'] ?></td>
                            <td><?= $user['birthdate'] ?></td>
                            <td><?= $user['status'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Секция блюд -->
            <div class="section" id="dishes">
                <h2>Блюда</h2>
                <button class="add-btn" onclick="openAddModal()">Добавить блюдо</button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Изображение</th>
                            <th>Категория</th>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Вес</th>
                            <th>Описание</th>
                            <th>Рейтинг</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dishes as $dish): 
                            // Получаем название категории
                            $categoryName = '';
                            foreach ($categories as $category) {
                                if ($category['idcategory'] == $dish['id_category']) {
                                    $categoryName = $category['name'];
                                    break;
                                }
                            }
                        ?>
                        <tr>
                            <td><?= $dish['idfood'] ?></td>
                            <td>
                                <?php if (!empty($dish['url_photo'])): ?>
                                    <img src="../<?= $dish['url_photo'] ?>" alt="<?= $dish['name'] ?>" style="max-width: 100px; max-height: 100px;">
                                <?php else: ?>
                                    Нет изображения
                                <?php endif; ?>
                            </td>
                            <td><?= $categoryName ?></td>
                            <td><?= $dish['name'] ?></td>
                            <td><?= $dish['price'] ?></td>
                            <td><?= $dish['weight'] ?></td>
                            <td><?= $dish['description'] ?></td>
                            <td>
                                <?= $dish['raiting_count'] > 0 ? 
                                    round($dish['raiting_sum'] / $dish['raiting_count'], 1) : 
                                    'Нет оценок' ?>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn edit-btn" 
                                            onclick="openEditModal(
                                                '<?= $dish['idfood'] ?>',
                                                '<?= $dish['id_category'] ?>',
                                                '<?= $dish['name'] ?>',
                                                '<?= $dish['price'] ?>',
                                                '<?= $dish['weight'] ?>',
                                                '<?= $dish['description'] ?>',
                                                '<?= $dish['url_photo'] ?>'
                                            )">
                                        Редакт.
                                    </button>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?= $dish['idfood'] ?>">
                                        <button type="submit" class="action-btn delete-btn">Удалить</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Модальное окно добавления блюда -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddModal()">&times;</span>
            <h2>Добавить новое блюдо</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">
                
                <div class="form-group">
                    <label for="add_name">Название:</label>
                    <input type="text" id="add_name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="add_category">Категория:</label>
                    <select id="add_category" name="category" required>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['idcategory'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="add_price">Цена:</label>
                    <input type="number" id="add_price" name="price" step="0.01" required>
                </div>
                
                <div class="form-group">
                    <label for="add_weight">Вес (г):</label>
                    <input type="number" id="add_weight" name="weight" required>
                </div>
                
                <div class="form-group">
                    <label for="add_description">Описание:</label>
                    <textarea id="add_description" name="description" rows="3"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="add_image">Изображение:</label>
                    <input type="file" id="add_image" name="image" accept="image/*">
                </div>
                
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeAddModal()">Отмена</button>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Модальное окно редактирования блюда -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>Редактировать блюдо</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" id="edit_id" name="id">
                
                <div class="form-group">
                    <label for="edit_name">Название:</label>
                    <input type="text" id="edit_name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="edit_category">Категория:</label>
                    <select id="edit_category" name="category" required>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['idcategory'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="edit_price">Цена:</label>
                    <input type="number" id="edit_price" name="price" step="0.01" required>
                </div>
                
                <div class="form-group">
                    <label for="edit_weight">Вес (г):</label>
                    <input type="number" id="edit_weight" name="weight" required>
                </div>
                
                <div class="form-group">
                    <label for="edit_description">Описание:</label>
                    <textarea id="edit_description" name="description" rows="3"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="edit_image">Изображение:</label>
                    <input type="file" id="edit_image" name="image" accept="image/*">
                    <div id="current-image-container" style="margin-top: 10px;">
                        <p>Текущее изображение:</p>
                        <img id="current-image" src="" style="max-width: 200px; max-height: 200px; display: none;">
                        <p id="no-image-message">Нет изображения</p>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }

        //  модальные окна
        function openAddModal() {
            document.getElementById('addModal').style.display = 'block';
        }
        
        function closeAddModal() {
            document.getElementById('addModal').style.display = 'none';
        }
        
        function openEditModal(id, categoryId, name, price, weight, description, url_photo) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_category').value = categoryId;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_price').value = price;
            document.getElementById('edit_weight').value = weight;
            document.getElementById('edit_description').value = description;
            
            // Управление отображением текущего изображения
            const currentImage = document.getElementById('current-image');
            const noImageMessage = document.getElementById('no-image-message');
            
            if (url_photo) {
                currentImage.src = '../' + url_photo;
                currentImage.style.display = 'block';
                noImageMessage.style.display = 'none';
            } else {
                currentImage.style.display = 'none';
                noImageMessage.style.display = 'block';
            }
            
            document.getElementById('editModal').style.display = 'block';
        }
        
        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>
</html>