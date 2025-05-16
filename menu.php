<?php
session_start();
$isAuth = isset($_SESSION['user']);
$user = $isAuth ? $_SESSION['user'] : null;
require_once "connect-db.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/menu.css">
    <title>Меню</title>
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
        <div class="menu">
            <div class="best-text">
                <p>Our <span>Best Popular</span> <br>
                    Indian Dish</p>
            </div>
            <div class="container-dish">
                <div class="dish">
                    <img src="..\resources\menu_dish\1.svg" alt="first"> <br>
                    <p>Indian Vegetable<br>
                        Pulao</p>
                    <div class="stars-container"><img class="stars" src="..\resources\fb-star.svg" alt="stars">(50)</div> <br>
                    <p style="font-size: 36px;">₹200</p><br>
                    <div class="dish-count">
                        <button>-</button>
                        <p>00</p>
                        <button>+</button>
                    </div><br>
                    <button>ADD TO CART</button>
                </div>
                <div class="dish">
                    <img src="..\resources\menu_dish\2.svg" alt="second"> <br>
                    <p>Indian Vegetable<br>
                        Pulao</p>
                    <div class="stars-container"><img class="stars" src="..\resources\fb-star.svg" alt="stars">(50)</div> <br>
                    <p style="font-size: 36px;">₹200</p><br>
                    <div class="dish-count">
                        <button>-</button>
                        <p>00</p>
                        <button>+</button>
                    </div><br>
                    <button>ADD TO CART</button>
                </div>
                <div class="dish">
                    <img src="..\resources\menu_dish\3.svg" alt="third"> <br>
                    <p>Indian Vegetable<br>
                        Pulao</p>
                    <div class="stars-container"><img class="stars" src="..\resources\fb-star.svg" alt="stars">(50)</div> <br>
                    <p style="font-size: 36px;">₹200</p><br>
                    <div class="dish-count">
                        <button>-</button>
                        <p>00</p>
                        <button>+</button>
                    </div><br>
                    <button>ADD TO CART</button>
                </div>
            </div>
            <div class="best-text">
                <p>Our <span>Snacks</span> Menu</p>
            </div>
            <div class="container-dish">
                <div class="dish">
                    <img src="..\resources\menu_dish\10.svg" alt="tea-time-snacks"> <br>
                    <p>Tea Time Snacks</p>
                    <div class="stars-container"><img class="stars" src="..\resources\fb-star.svg" alt="stars">(50)</div> <br>
                    <p style="font-size: 36px;">₹200</p><br>
                    <div class="dish-count">
                        <button>-</button>
                        <p>00</p>
                        <button>+</button>
                    </div><br>
                    <button>ADD TO CART</button>
                </div>
                <div class="dish">
                    <img src="..\resources\menu_dish\11.svg" alt="Salted-Fenugreek"> <br>
                    <p>Salted Fenugreek</p>
                    <div class="stars-container"><img class="stars" src="..\resources\fb-star.svg" alt="stars">(50)</div> <br>
                    <p style="font-size: 36px;">₹200</p><br>
                    <div class="dish-count">
                        <button>-</button>
                        <p>00</p>
                        <button>+</button>
                    </div><br>
                    <button>ADD TO CART</button>
                </div>
                <div class="dish">
                    <img src="..\resources\menu_dish\12.svg" alt="Murukku"> <br>
                    <p>Murukku</p>
                    <div class="stars-container"><img class="stars" src="..\resources\fb-star.svg" alt="stars">(50)</div> <br>
                    <p style="font-size: 36px;">₹200</p><br>
                    <div class="dish-count">
                        <button>-</button>
                        <p>00</p>
                        <button>+</button>
                    </div><br>
                    <button>ADD TO CART</button>
                </div>
            </div>
            <div class="best-text">
                <p>Our <span>Regular</span> Menu</p>
            </div>
            <div class="container-dish">
                <div class="dish">
                    <img src="..\resources\menu_dish\4.svg" alt="fourth"> <br>
                    <p>Masala Dosa</p>
                    <div class="stars-container"><img class="stars" src="..\resources\fb-star.svg" alt="stars">(50)</div> <br>
                    <p style="font-size: 36px;">₹200</p><br>
                    <div class="dish-count">
                        <button>-</button>
                        <p>00</p>
                        <button>+</button>
                    </div><br>
                    <button>ADD TO CART</button>
                </div>
                <div class="dish">
                    <img src="..\resources\menu_dish\5.svg" alt="second"> <br>
                    <p>Pav Bhaji</p>
                    <div class="stars-container"><img class="stars" src="..\resources\fb-star.svg" alt="stars">(50)</div> <br>
                    <p style="font-size: 36px;">₹200</p><br>
                    <div class="dish-count">
                        <button>-</button>
                        <p>00</p>
                        <button>+</button>
                    </div><br>
                    <button>ADD TO CART</button>
                </div>
                <div class="dish">
                    <img src="..\resources\menu_dish\6.svg" alt="third"> <br>
                    <p>Dal Bati Churma</p>
                    <div class="stars-container"><img class="stars" src="..\resources\fb-star.svg" alt="stars">(50)</div> <br>
                    <p style="font-size: 36px;">₹200</p><br>
                    <div class="dish-count">
                        <button>-</button>
                        <p>00</p>
                        <button>+</button>
                    </div><br>
                    <button>ADD TO CART</button>
                </div>
            </div>
            <div class="container-dish">
                <div class="dish">
                    <img src="..\resources\menu_dish\7.svg" alt="seventh"> <br>
                    <p>Puri Sabji</p>
                    <div class="stars-container"><img class="stars" src="..\resources\fb-star.svg" alt="stars">(50)</div> <br>
                    <p style="font-size: 36px;">₹200</p><br>
                    <div class="dish-count">
                        <button>-</button>
                        <p>00</p>
                        <button>+</button>
                    </div><br>
                    <button>ADD TO CART</button>
                </div>
                <div class="dish">
                    <img src="..\resources\menu_dish\8.svg" alt="eight"> <br>
                    <p>Naan Bread</p>
                    <div class="stars-container"><img class="stars" src="..\resources\fb-star.svg" alt="stars">(50)</div> <br>
                    <p style="font-size: 36px;">₹200</p><br>
                    <div class="dish-count">
                        <button>-</button>
                        <p>00</p>
                        <button>+</button>
                    </div><br>
                    <button>ADD TO CART</button>
                </div>
                <div class="dish">
                    <img src="..\resources\menu_dish\9.svg" alt="nineth"> <br>
                    <p>Aloo Mutter</p>
                    <div class="stars-container"><img class="stars" src="..\resources\fb-star.svg" alt="stars">(50)</div> <br>
                    <p style="font-size: 36px;">₹200</p><br>
                    <div class="dish-count">
                        <button>-</button>
                        <p>00</p>
                        <button>+</button>
                    </div><br>
                    <button>ADD TO CART</button>
                </div>
            </div>
        </div>
    </main>
    <footer class="site-footer">
        <div class="footer-decoration">
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="6" aria-hidden="true">
                <line x1="0" y1="3" x2="100%" y2="3" stroke="#ff4e0e" stroke-width="6" 
                      stroke-dasharray="10 10" stroke-linecap="round" />
            </svg>
        </div>
        <div class="footer-content">
            <div class="footer-main">
                <div class="footer-brand">
                    <h2 class="logo"><span>FOOD</span> DASH <span>.</span></h2>
                    <p class="copyright">Food Dash ©2023 All Rights Reserved</p>
                </div>
                <div class="footer-social">
                    <div class="social-links">
                        <a href="#" aria-label="Instagram"><img src="../resources/inst.svg" alt="" width="24" height="24"></a>
                        <a href="#" aria-label="LinkedIn"><img src="../resources/in.svg" alt="" width="24" height="24"></a>
                        <a href="#" aria-label="Facebook"><img src="../resources/f.svg" alt="" width="24" height="24"></a>
                        <a href="#" aria-label="Twitter"><img src="../resources/twitter.svg" alt="" width="24" height="24"></a>
                        <a href="#" aria-label="Dribbble"><img src="../resources/ball.svg" alt="" width="24" height="24"></a>
                    </div>
                    <p class="author">By - Piyush Prajapat</p>
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