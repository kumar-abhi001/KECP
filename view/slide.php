<?php
$images = [
    ['src' => 'assets/image1.jpg', 'alt' => 'Image 1'],
    ['src' => 'assets/image2.jpg', 'alt' => 'Image 2'],
    ['src' => 'assets/image3.jpg', 'alt' => 'Image 3'],
    ['src' => 'assets/image4.jpg', 'alt' => 'Image 4']
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Slider</title>
    <style>
        .image-slider {
            max-width: 1000vh;
            position: relative;
            margin: auto;
        }

        .image {
            width: 100%;
            height: 50vh;
        }

        .indicators {
            text-align: center;
            margin-top: 10px;
        }

        .indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            background-color: #bbb;
            border-radius: 50%;
            margin: 0 5px;
            cursor: pointer;
        }

        .active {
            background-color: #717171;
        }

        .main-image {
            position: relative;
        }
    </style>
</head>

<body>

    <div class="main-image">
        <div class="image-slider">
            <div class="slide" id="image-slider">
                <?php foreach ($images as $index => $image): ?>
                    <div class="image-container" style="display: <?= $index === 0 ? 'block' : 'none'; ?>">
                        <img src="<?= $image['src']; ?>" alt="<?= $image['alt']; ?>" class="image" onmouseenter="changeOpacity(1)" onmouseleave="changeOpacity(1)">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="indicators">
            <?php foreach ($images as $index => $image): ?>
                <span class="indicator" onclick="goToSlide(<?= $index; ?>)" id="indicator-<?= $index; ?>"></span>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        let currentSlide = 0;
        const totalSlides = <?= count($images); ?>;
        const slides = document.querySelectorAll('.image-container');
        const indicators = document.querySelectorAll('.indicator');

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.display = i === index ? 'block' : 'none';
                indicators[i].classList.toggle('active', i === index);
            });
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(currentSlide);
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        function goToSlide(index) {
            currentSlide = index;
            showSlide(currentSlide);
        }

        showSlide(currentSlide);

        let targetOpacity = 1;

        function changeOpacity(opacity) {
            targetOpacity = opacity;
            document.querySelectorAll('.image').forEach(img => img.style.opacity = targetOpacity);
        }

        setInterval(nextSlide, 2000);
    </script>

</body>

</html>