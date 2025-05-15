<?php
session_start();
$isAuth = isset($_SESSION['user']);
$user = $isAuth ? $_SESSION['user'] : null;
require_once "connect-db.php";

$bestDishes = [];
$regularDishes = [];

// Получаем все блюда категории 1 (Best Delivered)
$bestResult = mysqli_query($conn, "SELECT * FROM `food` WHERE `id_category` = 1 LIMIT 3");
while ($row = mysqli_fetch_assoc($bestResult)) {
    $bestDishes[] = $row;
}

// Получаем все блюда категории 2 (Regular Menu)
$regularResult = mysqli_query($conn, "SELECT * FROM `food` WHERE `id_category` = 2");
while ($row = mysqli_fetch_assoc($regularResult)) {
    $regularDishes[] = $row;
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodDash</title>
    <link rel="stylesheet" href="../css/style.css">
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
                <a class="btn-header-a" href="#" aria-label="Search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                        <path
                            d="M14.3333 14.3333L21 21M8.77778 16.5556C4.48223 16.5556 1 13.0733 1 8.77778C1 4.48223 4.48223 1 8.77778 1C13.0733 1 16.5556 4.48223 16.5556 8.77778C16.5556 13.0733 13.0733 16.5556 8.77778 16.5556Z"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                    </svg>
                </a>
                <?php if($isAuth): ?>
                <!-- Для авторизованных - ссылка на профиль -->
                    <a href="profile.php" class="profile-link">
                        <img src="<?= !empty($user['avatar']) ? $user['avatar'] : '../resources/user.svg' ?>" alt="Profile">
                    </a>
                <?php else: ?>
                    <!-- Для гостей - кнопка входа -->
                    <button id="myBtn"><img src="../resources/user.svg" alt="Login"></button>
                <?php endif; ?>
                <div id="myModal" class="modal" style="display: none;">
                                        <!-- Модальное -->
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <div class="auth-container">
                            <section class="header-container">
                                <img src="..\resources\background_auth.png" alt="Картинка слева">
                            </section>
                            <section class="right-container">
                                <div class="logo-header">
                                    <img src="../resources/logo.svg" alt="Логотип FoodDash">
                                </div>
                                <div class="text">
                                    <h1>Login to your account!</h1>
                                </div>
                                <div class="button-auth">
                                    <button><img src="..\resources\google.svg" alt="google logo"> Login with
                                        Google</button>
                                    <button><img src="..\resources\facebook.svg" alt="facebook logo"> Login with
                                        Facebook</button>
                                </div>
                                <div class="form-container">
                                    <form action="signIn-db.php" method="POST" class="block-signIn">
                                        <div class="email-container">
                                            <label for="email">Email Address</label><br>
                                            <input name="email" type="email" id="email" required>
                                        </div>
                                        <div class="pass-container">
                                            <label for="pass">Password</label><br>
                                            <input name="pass" type="password" id="pass" required>
                                            <button type="submit">Login To Continue</button>
                                            <div class="sign-up-container"><p>Don't have an account? <a href="registration.php"><span class="dont-have">Sign
                                                up</span></a></p></div>
                                        </div>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section class="block-welcome-color">
            <div class="block-welcome">
                <div class="block-welcome-text">
                    <h1>Quick <span>and</span> Tasty <br>
                        Food Delivered <span>with</span> a Dash of <span>Speed</span>
                    </h1>
                    <button>Order now</button>
                    <button>Track Order</button>
                </div>
                <div class="block-welcome-img">
                    <img src="../resources/dish.svg" alt="Изображение еды">
                </div>
            </div>
        </section>

        <section class="block-advantages">
            <div class="block-advantages-container">
                <img src="..\resources\fast-delivery 1.svg" alt="Первое преимущество иконка">
                <h1><span>Fast Delivery</span><br> Promise To Deliver Within 30 Mins</h1>
            </div>
            <div class="block-advantages-container">
                <img src="..\resources\fresh.svg" alt="Второе преимущество иконка">
                <h1><span>Fresh Food</span><br> Your Food Will Be Delivered 100% Fresh To Your Home. </h1>
            </div>
            <div class="block-advantages-container">
                <img src="..\resources\box 1.svg" alt="Третье преимущество иконка">
                <h1><span>Free Delivery</span><br> Your Food Delivery Is Absolutely Free. No Cost Just Order</h1>
            </div>
        </section>

        <section class="block-best">
            <div class="block-best-text">
                <h1>Our <span>Best Delivered</span> <br>
                    Indian Dish
                </h1>
                <h1>It's Not Just About Bringing You Good Food <br> From Restaurants, We Deliver You Experience</h1>
            </div>
            <div class="block-best-dish">
                <?php foreach ($bestDishes as $dish): ?>
                <div class="dish">
                    <img src="<?= $dish['url_photo'] ?>" alt="<?= $dish['name'] ?>">
                    <h1><?= $dish['name'] ?></h1>
                    <a href="#">Order Now ></a>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="block-best-stars">
                <div class="block-best-stars-container">
                    <img src="..\resources\star.svg" alt="Звезда">
                    <h1>Rajasthan</h1>
                </div>
                <div class="block-best-stars-container">
                    <img src="..\resources\star.svg" alt="Звезда">
                    <h1>South Indian</h1>
                </div>
                <div class="block-best-stars-container">
                    <img src="..\resources\star.svg" alt="Звезда">
                    <h1>Gujarat</h1>
                </div>
                <div class="block-best-stars-container">
                    <img src="..\resources\star.svg" alt="Звезда">
                    <h1>Maharashtra</h1>
                </div>
            </div>
            <div class="menu-text">
                <div class="menu-text-btn-h1">
                    <h1>Our <span>Regular</span> Menu</h1>
                    <button>See All</button>
                </div>
                <h3>There Are Our Regular Menus. <br>
                    You Can Order Anything You Like. </h3>
            </div>
            <div class="menu-container">
                <?php for ($i = 0; $i < 3 && $i < count($regularDishes); $i++): 
                    $dish = $regularDishes[$i];
                    $nameParts = explode(' ', $dish['name'], 2);
                ?>
                <div class="menu-dish">
                    <div class="background-menu"></div>
                    <img src="<?= $dish['url_photo'] ?>" alt="<?= $dish['name'] ?>">
                    <div class="dish-info">
                        <div class="dish-name-and-fb">
                            <h1><span><?= $nameParts[0] ?></span> <br><?= isset($nameParts[1]) ? $nameParts[1] : '' ?></h1>
                        </div>
                        <span><img src="../resources/fb-star.svg" alt="star"></span>
                        <div class="menu-cost">
                            <h3>₹<?= $dish['price'] ?></h3>
                            <button class="btn-buy">Buy Now</button>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>

            <div class="menu-container">
                <?php for ($i = 3; $i < 6 && $i < count($regularDishes); $i++): 
                    $dish = $regularDishes[$i];
                    $nameParts = explode(' ', $dish['name'], 2); // разделяем строку по пробелу
                ?>
                <div class="menu-dish">
                    <div class="background-menu"></div>
                    <img src="<?= $dish['url_photo'] ?>" alt="<?= $dish['name'] ?>">
                    <div class="dish-info">
                        <div class="dish-name-and-fb">
                            <h1><span><?= $nameParts[0] ?></span> <br><?= isset($nameParts[1]) ? $nameParts[1] : '' ?></h1>
                        </div>
                        <div class="raiting-comment">
                            <img src="../resources/fb-star.svg" alt="star">
                        </div>
                        <div class="menu-cost">
                            <h3>₹<?= $dish['price'] ?></h3>
                            <button class="btn-buy">Buy Now</button>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </section>

        <section class="block-marketing">
            <div class="market-container">
                <img src="..\resources\market1.svg" alt="">
                <div class="market-container-col">
                    <img src="..\resources\market2.svg" alt="">
                    <img src="..\resources\market3.svg" alt="">
                </div>
            </div>
        </section>
    </main>
    <footer class="block-footer">
        <div class="block-footer-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="6">
                <line x1="0" y1="3" x2="100%" y2="3" stroke="#ff4e0e" stroke-width="6" stroke-dasharray="10 10"
                    stroke-linecap="round" />
            </svg>
            <div class="block-footer-container-text">
                <div class="block-footer-left">
                    <div class="block-footer-left-one">
                        <h1><span>FOOD</span> DASH <span>.</span></h1>
                        <h3>Food Dash ©2023 All Rights Reserved</h3>
                        <h3>By - Piyush Prajapat</h3>
                    </div>
                    <div class="block-footer-left-two">
                        <h1 style="color: var(--main-color);">Follow Us On</h1>
                        <div>
                            <a href="#" aria-label="Instagram"><img src="../resources/inst.svg" alt="Instagram"></a>
                            <a href="#" aria-label="LinkedIn"><img src="../resources/in.svg" alt="LinkedIn"></a>
                            <a href="#" aria-label="Facebook"><img src="../resources/f.svg" alt="Facebook"></a>
                            <a href="#" aria-label="Twitter"><img src="../resources/twitter.svg" alt="Twitter"></a>
                            <a href="#" aria-label="Dribbble"><img src="../resources/ball.svg" alt="Dribbble"></a>
                        </div>
                    </div>
                </div>

                <div class="block-footer-right">
                    <div class="footer-menu">
                        <h2>Menu</h2>
                        <a href="">Home</a>
                        <a href="">Offers</a>
                        <a href="">Service</a>
                        <a href="">About Us</a>
                    </div>
                    <div class="footer-information">
                        <h2>Information</h2>
                        <a href="">Menu</a>
                        <a href="">Quality</a>
                        <a href="">Make A Choice</a>
                        <a href="">Fast Delivery</a>
                    </div>
                    <div class="footer-contact">
                        <h2>Contact</h2>
                        <h3>+123456789</h3>
                        <h3>Explore</h3>
                        <h3>Info@FoodDash.com</h3>
                        <h3>12, Maharashtra, Indian</h3>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script>
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function () {
            modal.style.display = "block";
            setTimeout(function () {
                modal.classList.add("show");
            }, 10);
        }

        span.onclick = function () {
            modal.classList.remove("show");
            setTimeout(function () {
                modal.style.display = "none";
            }, 300);
        }

    </script>
     <script>
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];

        // Показываем модальное окно только если кнопка существует (для гостей)
        if(btn) {
            btn.onclick = function() {
                modal.style.display = "block";
                setTimeout(function() {
                    modal.classList.add("show");
                }, 10);
            }
        }

        span.onclick = function() {
            modal.classList.remove("show");
            setTimeout(function() {
                modal.style.display = "none";
            }, 300);
        }
    </script>
</body>

</html>