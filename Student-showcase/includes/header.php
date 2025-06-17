<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Header</title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/header.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>
    <header>
        <h1 data-aos="fade-down" data-aos-duration="1500" class="logo">🌐 Acadex</h1>



        <nav>
            <a data-aos="fade-down" data-aos-duration="3000" href="/student-showcase/index.php">HOME</a>
            <a data-aos="fade-down" data-aos-duration="2000" href="/student-showcase/about.php">ABOUT</a>
            <a data-aos="fade-down" data-aos-duration="2500" href="/student-showcase/contact.php">CONTACT</a>
           <!-- <a data-aos="fade-down" data-aos-duration="3000" href="/student-showcase/project/all-projects.php">PROJECT</a>-->
        </nav>

        <div class="header-buttons">
    <a href="/student-showcase/auth/auth.php">
        <button data-aos="fade-down" data-aos-duration="1500" class="btn-signing">SIGNIN</button>
    </a>
    <a href="/student-showcase/profile/dashboard.php">
        <button data-aos="fade-down" data-aos-duration="1500" class="btn-profile">PROFILE</button>
    </a>
</div>

    </header>

    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
