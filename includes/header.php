<?php
session_start();

    require 'guard.php';
   
    function getNameByRoleId(){
        switch ($_SESSION['user']['role_id']) {
            case 1:
                echo 'admin';
                break;
            case 2:
                echo 'employe';
                break;
            case 3:
                echo 'veterinaire';
                break;
           
            default:
                # code...
                break;
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ARCADIA</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!--<base href="/"> -->
        <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
   
    <body>
        <header class="header">
            <div class="left">
                <a href="#" class="logo"> <i class="fas fa-paw"></i> Arcadia</a>
            </div>

            <div class="center">
                <nav class="navbar">
                    <a href="/home.php#accueil">Accueil</a>
                    <a href="/home.php#a_propos">A propos</a>
                    <a href="/home.php#gallery">Galerie</a>
                    <a href="/home.php#habitats">habitats</a>
                    <a href="/home.php#services">Services</a>
                    <a href="/home.php#tarifs">Tarifs</a>
                    <a href="/home.php#contact">Contact</a>
                    <a href="/home.php#horaires">Horaires</a>
                    <a href="/avis.php#avis">Laisser un avis</a>
                    <?php if(isset($_SESSION['user'])):?>
                        <a href="/<?php getNameByRoleId();?>.php">Tableau de bord</a>
                    <?php endif ?>
                </nav>
            </div>

            <div class="user-connexion">
                <div class="icons">
                    <div id="menu-btn" class="fas fa-bars fa-3x"></div>
                    <?php if(isset($_SESSION['user'])) :?>
                        <h2><?php echo $_SESSION['user']['username'];?></h2>
                        <?php $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];?>
                        <a href="/logout.php"><i class="fas fa-sign-out-alt fa-2x"></i></a>
                    <?php else:?>
                        <a href="/login.php"><i class="fas fa-user fa-3x"></i></a>
                    <?php endif;?>
                </div>
            </div>
        </header>

        <script>
            let navbar = document.querySelector(".header .navbar");
            document.querySelector('#menu-btn').onclick = () => {
                navbar.classList.toggle('active');
            }
        </script>
    </body>
</html>