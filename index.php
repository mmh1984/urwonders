<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon/favicon.ico" type="image/x-icon">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top portfolio-navbar gradient" style="filter: blur(0px) brightness(84%) contrast(200%) grayscale(0%) hue-rotate(241deg) invert(0%) saturate(200%) sepia(21%);">
        <div class="container">
            <a class="navbar-brand logo" href="index.php"><img src="assets/img/urwonders.png"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navbarNav"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="about.html">About</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="question.php">Quiz</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="login.html">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page lanidng-page">
        <section class="portfolio-block block-intro">
            <div class="container">
                <div class="avatar" style="background-image:url(&quot;assets/img/avatars/avatar.jpg&quot;);"></div>
                <div class="about-me">
                    <p>A direct learning guidance and communication with the use of visuals mechanism to support and assist individuals with autism. To go deeper to understand their needs and wants.</p>
                </div>
            </div>
        </section>
       
        <section class="portfolio-block skills">
            <div class="container-fluid" style="border:1px solid #aeaeae;padding:10px;">
                <div class="heading">
                    <h2>Explore</h2>
                </div>
                <div class="row">
                    <div class="col-md-4" data-bs-hover-animate="tada">
                        <div class="card special-skill-item border-0">
                            <div class="card-header bg-transparent border-0"><img src="assets/img/categories.png" style="width: 200px;height: 200px;border-radius:20px;box-shadow:2px 2px 2px #aeaeae;"></div>
                            <div class="card-body">
                                <h3 class="card-title">Categories</h3>
                            </div>
                        </div>
                        <p class="text-center"><button class="btn btn-primary" type="button" onclick="redirect_page('categories.php')">View</button></p>
                    </div>
                    <div class="col-md-4" data-bs-hover-animate="tada">
                        <div class="card special-skill-item border-0">
                            <div class="card-header bg-transparent border-0"><img src="assets/img/cards.png" style="width: 200px;height: 200px;border-radius:20px;box-shadow:2px 2px 2px #aeaeae;"></div>
                            <div class="card-body">
                                <h3 class="card-title">Cards</h3>
                            </div>
                        </div>
                        <p class="text-center"><button class="btn btn-primary" type="button" onclick="redirect_page('picturecards.php')">View</button></p>
                    </div>
                    <div class="col-md-4" data-bs-hover-animate="tada">
                        <div class="card special-skill-item border-0">
                            <div class="card-header bg-transparent border-0"><img src="assets/img/quiz.png" style="width: 200px;height: 200px;border-radius:20px;box-shadow:2px 2px 2px #aeaeae;"></div>
                            <div class="card-body">
                                <h3 class="card-title">Quiz</h3>
                            </div>
                        </div>
                        <p class="text-center"><button class="btn btn-primary" type="button">View</button></p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <section class="portfolio-block website gradient">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-5 offset-lg-1 text">
                    <h3>Website Project</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget velit ultricies, feugiat est sed, efr nunc, vivamus vel accumsan dui. Quisque ac dolor cursus, volutpat nisl vel, porttitor eros.</p>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div class="portfolio-laptop-mockup">
                        <div class="screen">
                            <div class="screen-content" style="background-image:url(&quot;assets/img/tech/image6.png&quot;);"></div>
                        </div>
                        <div class="keyboard"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="page-footer">
        <div class="container">
            <div class="links"><a href="#">About me</a><a href="#">Contact me</a><a href="#">Projects</a></div>
            <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram-outline"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a></div>
        </div>
    </footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
<script>

    function redirect_page(page){
        window.location.href=page;
    }
</script>