<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"
        crossorigin="anonymous" />

    <title>Welcome to iDiscuss - coding forums</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php' ?>
    <?php include 'partials/_header.php' ?>

    <?php
        $showalert=false;
            $method=$_SERVER['REQUEST_METHOD'];
            if($method=='POST'){
                //insert threrad into comment db
                $name=$_POST['fname'];
                $email=$_POST['email'];
                $message=$_POST['mess'];
                $message=str_replace("<","&lt;",$message);
                $message=str_replace(">","&gt;",$message);
                
                $sql= "INSERT INTO `message` (`email`, `name`, `mess`, `mess_time`)
                        VALUES ('$email', '$name', '$message', current_timestamp())";
                
                $result=mysqli_query($conn,$sql);
                $showalert=true;
                if($showalert){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> Your message has been sent.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                }

            }

    ?>

    <div class="container width-75">
        <div class="container">
            <div class="card text-center">
                <div class="card-header">
                    <h2>Get in touch</h2>
                </div>
                <div class="card-body">
                    <h5 class="card-title">We'd <i class="far fa-heart"></i> to help!</h5>
                    <p class="card-text">We like to create things with fun, open-minded people. Feel free to say hello!
                    </p>
                    <p><i class="fas fa-map-marker-alt"></i> NJ Web Design <br>Mbi, Bihar</p>
                    <p><i class="fas fa-envelope"></i> <a href="mailto:jhanitish17177@gmail.com">njwebx@gmail.com</a>
                    </p>
                </div>
                <div class="card-footer text-muted">
                    <div class="container">
                        <a href="https://www.facebook.com/profile.php?id=100007765624761" target="_blank"><i
                                class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/its_ur_boy_jha/" target="_blank"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://twitter.com/jhanitish7" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/in/jhanitish0521/" target="_blank"><i
                                class="fab fa-linkedin"></i></a>
                        <a href="https://github.com/jhanitish135" target="_blank"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo '<div class="container">
                <form action=" '.$_SERVER["REQUEST_URI"].'" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="fname">Name</label>
                        <input type="text" class="form-control" name="fname" id="fname">
                    </div>
                    <div class="form-group">
                    <label for="message">Elaborate Your Problem</label>
                    <textarea class="form-control" id="mess" name="mess" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>';
        }
        else{
            echo '<div class="container py-4">
                    <h1 class="py-2">Chat With Us</h1>
                    <div class="row ">
                        <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <p class="lead">You are not logged in. To chat with us please login.</p>
                                <button class="btn btn-outline-danger" data-toggle="modal" data-target="#loginModal">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
        
    ?>

    <?php include 'partials/_footer.php' ?>







    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
</body>

</html>