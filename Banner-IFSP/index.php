<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Totem IFSP</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Bem-vindo ao <br> totem do <span class="highlight">IF!</span></span></h1>
            <img src="icons/ifsp_logo_itp.png" alt="Instituto Federal" class="logo">
        </header>
        <main>
            <div class="box">
                <div class="anucnio" id="anuncio">
                    <?php
                    $dir = "Uploads/";
                    $images = glob($dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

                    foreach($images as $image) {
                        echo '<img src="' . $image . '" alt="Imagem do Anúncio" style="max-width: 100%; height: auto; display: none;">';
                    }
                    ?>
                </div>

                <a href="Anuncieaqui/AnuncieAqui.html" class="anucnio-btn">
                    <img src="icons/Anuncie-aqui.webp" alt="Anuncie aqui">
                    <span>Anuncie aqui</span>
                </a>
            </div>
            <div class="projetos">
                <div class="button">
                    <img src="icons/Armario.png" alt="">
                    <a href="PastaBanners/pagBanners.php">Reserve <span class="highlight">seu</span> armário</a>
                </div>
                <div class="button">
                    <img src="icons/Feedback.webp" alt="">
                    <a href="#">Fale <span class="highlight">Conosco</span></a>
                </div>
            </div>
        </main>

        <footer>
            
        </footer>

    </div>
    <script>
        let currentImageIndex = 0;
        const images = document.querySelectorAll('#anuncio img');
        const totalImages = images.length;

        function showNextImage() {
            images[currentImageIndex].style.display = 'none';
            currentImageIndex = (currentImageIndex + 1) % totalImages;
            images[currentImageIndex].style.display = 'block';
        }

        if (totalImages > 0) {
            images[0].style.display = 'block';
            setInterval(showNextImage, 3000); // 30000ms = 30 seconds
        }
    </script>
</body>
</html>
