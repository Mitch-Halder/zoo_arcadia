<!DOCTYPE html>

    <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
                    <base href="/project/">
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

                <a href="/project/home.php#accueil">Accueil</a>
                <a href="/project/home.php#a_propos">A propos</a>
                <a href="/project/home.php#gallery">Galerie</a>
                <a href="/project/home.php#habitats">habitats</a>
                <a href="/project/home.php#services">Services</a>
                <a href="/project/home.php#tarifs">Tarifs</a>
                <a href="/project/home.php#contact">Contact</a>
                <a href="/project/avis.php#avis">Laisser un avis</a>

            </nav>

        </div>
        
        <div class="user-connexion">
            <div class="icons">
            <div id="menu-btn" class="fas fa-bars fa-3x"></div>
            <i class="fas fa-user fa-3x"></i>
            </div>
        </div>

    </header>


    <script>
        let navbar = document.querySelector(".header .navbar");
        console.log('test');

        document.querySelector('#menu-btn').onclick = () => {
        navbar.classList.toggle('active');
}

    </script>
</body>
    
</html>