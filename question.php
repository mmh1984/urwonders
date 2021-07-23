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
                    <li class="nav-item" role="presentation"><a class="nav-link" href="question.php">Quiz</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="login.html">Login</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <main class="page projects-page">
        <section class="portfolio-block projects-cards">
            <div class="container">
              
                <div class="heading">
                    <h2>Test your knowledge</h2>
                    <p class='text-center'><button class='btn btn-success btn-lg' id="btnstart" onclick="load_quiz()">Start</button></p>
                </div>
                <div class="row" >
                    <div class='col-md-2 col-lg-2 col-xl-2 col-sm-12'></div>
                    <div id="quiz" class='col-md-8 col-lg-8 col-xl-8 col-sm-12'>
                        <p class='text-center' id="counter"><strong>Question 1 of 10</strong></p>
                        <p class='alert alert-info'>Name this card</p>
                        <img id="image" src="controls/category/noimage.png" class="img-thumbnail mx-auto d-block" style="width:30%;height:auto;"/>
                        <p class='text-center'>Select Answer</p>
                        <div id="answer" class='text-center'></div>
                        <p class='text-center'>
                        <button id="btnblue" class='btn btn-primary btn-lg' onclick="next_question(this)">Submit Answer</button>
                        <button id="btngreen" class='btn btn-success btn-lg' onclick="next_question(this)">Submit Answer</button>
                        <button id="btnred" class='btn btn-danger btn-lg' onclick="next_question(this)">Submit Answer</button>
                        <button id="btnyellow" class='btn btn-warning btn-lg' onclick="next_question(this)">Submit Answer</button>
                        </p>
                    </div>
                    <div id="summary" class='col-md-8 col-lg-8 col-xl-8 col-sm-12'>
                       
                    </div>
                    <div class='col-md-2 col-lg-2 col-xl-2 col-sm-12'></div>
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
    var quiz_counter=1
    var quiz;
    var correct_answer=[];
    var user_answer=[];
    var marks=[];
    $(document).ready(function(){
       
        $("#quiz").hide();
        $("#summary").hide();
       
        //arr1.sort( () => .5 - Math.random())
       
       
        
    });

    function load_quiz(){
       $("#btnstart").hide();
      $.ajax({
          url:"controls/quiz.php",
          success:function(response){
              quiz=$.parseJSON(response);
              $("#quiz").show();
              start_quiz()
          }
          
      });
    }
    
    function start_quiz(){
        
        if(quiz_counter <= 10){
            $("#answer").focus();
        $("#counter").html("Question " + quiz_counter + " of 10");
        src="controls/cards/" + quiz[quiz_counter-1]["cardimage"];
        $("#image").attr("src",src)
            //populate choices
            choices=[] //array for possible choices
            choices.push(quiz[quiz_counter-1]["cardname"]); //store correct answer
          
           for(x=0;x<quiz.length;x++) //generate other answer
           {
               if(choices.includes(quiz[x]["cardname"])==false){ //include answer <> actual answer
               choices.push(quiz[x]["cardname"]);
           }
               
           }
           buttonanswer=[]; //create array for choices
           for(a=0;a<4;a++){
              buttonanswer.push(choices[a]); //push only 3 answer
           }
           //randomize
           buttonanswer.sort( () => .5 - Math.random()) //randomize 3 answer
           $("#btnblue").html(buttonanswer[0]);
           $("#btnred").html(buttonanswer[1]);
           $("#btngreen").html(buttonanswer[2]);
           $("#btnyellow").html(buttonanswer[3]);

        }
        else {
            alert("Game Over");
            load_summary();
        }

    }
    function load_summary(){
        content="<table class='table table-condensed'>";
        content+="<tr><th>Question no</th><th>Correct Answer</th><th>Your Answer</th><th>Answer</th></tr>"
        for(i=0;i<marks.length;i++){
            content+="<tr>";
            content+="<td>"+ (i+1) +"</td>"
            content+="<td>"+ correct_answer[i]+"</td>"
            content+="<td>"+ user_answer[i]+"</td>"
            if(marks[i]=="Correct"){
            content+="<td><span class='badge badge-success'>"+ marks[i] +"</span></td>"
            }
            else {
            content+="<td><span class='badge badge-danger'>"+ marks[i] +"</span></td>"
            }
            content+="</tr>";
        }
        content+="</table>"
        content+="<p class='text-center '><a class='btn btn-primary text-white' href='question.php'>Play Again</a></p>"
        $("#quiz").hide();
        $("#summary").show();
        $("#summary").html(content)
    }

    function next_question(item){
       
        answer=$(item).html();
        if(answer.length==0){
            alert("Please enter your answer");
        }
        else{
            answer=answer.toLowerCase();
            correct=quiz[quiz_counter-1]["cardname"]
            correct=correct.toLowerCase();
            user_answer.push(answer)
            correct_answer.push(correct)
            if(correct.includes(answer)){
                $("#answer").html("<p class='alert alert-success'>Correct Answer</p>")
                marks.push("Correct")
            }
            else {
                $("#answer").html("<p class='alert alert-danger'>Wrong Answer</p>")
                marks.push("Wrong")
                
            }
            //$("#answer").html("");
            setTimeout(function(){
                $("#answer").html("");
                quiz_counter++;
                start_quiz();
            },1000)
                
            
            

        }
    }

    
</script>