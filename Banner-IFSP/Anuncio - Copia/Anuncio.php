<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anúncios IFSP</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <a href="#"><img class="back-button" src="../icons/back-button.svg" alt="Voltar"></a>
            <div class="title-section">
                <img src="../icons/anunciocopy.svg" alt="Anúncios">
                <h1>Anúncios</h1>
                <h1><span class="highlight">Aqui!</span></h1>
            </div>
            <img src="../icons/ifsp_logo_itp.png" alt="Instituto Federal" class="logo">
        </header>
        <main>
        <div class="anucnio" id="anuncio">
                    <?php
                    $dir = "../Uploads/";
                    $images = glob($dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

                    foreach($images as $image) {
                        echo '<img src="' . $image . '" alt="Imagem do Anúncio" style="max-width: 100%; height: auto; display: none;">';
                    }
                    ?>
                </div>
        </main>
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
            setInterval(showNextImage, 3000); // 3000ms = 3 seconds
        }
    </script>
</body>
</html>
