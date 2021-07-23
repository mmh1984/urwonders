<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Projects - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Box-panels-1.css">
    <link rel="stylesheet" href="assets/css/Box-panels.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css">
    <link rel="stylesheet" href="assets/css/Lightbox-Gallery.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Tabbed-Panel.css">
    <link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon/favicon.ico" type="image/x-icon">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top portfolio-navbar gradient" style="filter: blur(0px) brightness(84%) contrast(200%) grayscale(0%) hue-rotate(241deg) invert(0%) saturate(200%) sepia(21%);">
        <div class="container"><a class="navbar-brand logo" href="index.php"><img src="assets/img/urwonders.png"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navbarNav"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="about.html">About</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="question.php">Questions</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="login.html">Login</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <main class="page projects-page">
        <section class="portfolio-block projects-cards">
            <div class="container">
                <div class="row">
                    <div class="col"><a class='btn btn-warning text-white' href='categories.php'>Back to categories</a></div>
                </div>
                <div class="heading">
                    <h2><?php echo $_GET["name"]?><input type="hidden" id="catid" value="<?php echo $_GET["id"]; ?>"/></h2>
                    <p class='text-center'>No of cards <span id="count" class='text-primary'>0</span></p>
                </div>
                <div class="row" id="cards">
                    
                   
                </div>
            </div>
        </section>
    </main>
    <footer class="page-footer">
        <div class="container">
            <div class="links"><a href="#">About me</a><a href="#">Contact me</a><a href="#">Projects</a></div>
            <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram-outline"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a></div>
        </div>
    </footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
<script>
    $(document).ready(function(){
        load_cards();

    });

    function load_cards(){
        $("#cards").html("<img src='assets/img/loading.gif' style='display:block;margin:20px auto;width:50%'/>")
        
        $.ajax({
            url:"controls/cards.php",
            type:"POST",
            data:{
                action:"listcard",
                id:$("#catid").val()
            },
            success:function(response){
                $("#cards").html(response);

            }
        })
   }
</script>