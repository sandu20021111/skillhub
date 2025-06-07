<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Project Showcase Hub</title>
    <link rel="stylesheet" href="assets/css/styles.css">

    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <img class="image-gradient" src="gradient.png" alt="">
    <div class="layer-blur"></div>

    <div class="content">
        <!-- Tag Box -->
        <div data-aos="fade-zoom-in"
             data-aos-easing="ease-in-back"
             data-aos-delay="300"
             data-aos-offset="0" 
             data-aos-duration="1500" 
             class="tag-box">
            <div class="tag">WELCOME TO</div>
        </div>

        <!-- Heading -->
        <h1 data-aos="fade-zoom-in"
            data-aos-easing="ease-in-back"
            data-aos-delay="300"
            data-aos-offset="0" 
            data-aos-duration="2000">
            STUDENT PROJECT <br>SHOWCASE HUB
        </h1>

        <!-- Description -->
        <p data-aos="fade-zoom-in"
           data-aos-easing="ease-in-back"
           data-aos-delay="300"
           data-aos-offset="0" 
           data-aos-duration="2500" 
           class="description">
            Discover, share, and celebrate the creativity of students from all disciplines. Upload your academic projects, explore innovative ideas, and connect with fellow students and educators around the world.
        </p>

        <!-- Buttons -->
        <div data-aos="fade-zoom-in"
             data-aos-easing="ease-in-back"
             data-aos-delay="300"
             data-aos-offset="0" 
             data-aos-duration="3000" 
             class="buttons">
            <a href="/student-showcase/project/all-projects.php" class="btn-get-started">Explore Projects &gt;</a>
            <a href="/student-showcase/auth/auth.php" class="btn-signing-main">Get Started &gt;</a>
        </div>
    </div>

    <!-- 3D Robot Viewer -->
    <spline-viewer data-aos="fade-zoom-in"
                   data-aos-easing="ease-in-back"
                   data-aos-delay="300"
                   data-aos-offset="0" 
                   data-aos-duration="3000" 
                   class="robot-3d" 
                   url="https://prod.spline.design/2ksZhN5snA8Ci1mB/scene.splinecode">
    </spline-viewer>

    <!-- JS Scripts -->
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.10.2/build/spline-viewer.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>
</html>
