<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Welcome to iDiscuss - coding forums</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php' ?>
    <?php include 'partials/_header.php' ?>
    

    <?php
       $id=$_GET['threadid'];  
       $sqli= "SELECT * FROM `threads` WHERE thread_id=$id";
       $result=mysqli_query($conn,$sqli);
       while($row=mysqli_fetch_assoc($result)){
           $title=$row['thread_title'];
           $desc=$row['thread_desc'];
           $thread_user_id=$row['thread_user_id'];


           //query the users to table to find out the name of op
           $sql2="SELECT user_name FROM `users` where sno='$thread_user_id'";
                $result2=mysqli_query($conn,$sql2);
                $row2=mysqli_fetch_assoc($result2);
                $posted_by=$row2['user_name'];


          }
         
       
    ?>
    <?php
    $showalert=false;
        $method=$_SERVER['REQUEST_METHOD'];
          if($method=='POST'){
              //insert threrad into comment db
              $comment=$_POST['comment'];
              $comment=str_replace("<","&lt;",$comment);
              $comment=str_replace(">","&gt;",$comment);
              $sno=$_POST["sno"];
              
              $sql= "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`)
               VALUES ('$comment', '$id', '$sno', current_timestamp())";
              
              $result=mysqli_query($conn,$sql);
              $showalert=true;
              if($showalert){
                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your comment has been added.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
              }

          }

    ?>
    

    <!-- cateogories start here -->

    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title;?> </h1>
            <p class="lead"><?php echo $desc;?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times. </p>
            <p>Posted by: <em><?php echo $posted_by; ?></em></p>
        </div>
    </div>
    
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<div class="container">
                <h1 class="py-2">Post a Comment</h1>
                <form action="'. $_SERVER['REQUEST_URI'].'" method="post">
                    
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Type your Comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                    </div>
                    <button type="submit" class="btn btn-success">Post Comment</button>
                </form>
            </div>';
    }
    else{
        echo '<div class="container">
                <h1 class="py-2">Post a Comment</h1>
                <div class="row">
                    <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                        
                        <p class="lead">You are not logged in. To post a comment please login.</p>
                        <button class="btn btn-outline-danger" data-toggle="modal" data-target="#loginModal">Login</a>
                        </div>
                    </div>
                </div>
            </div>';
    }
    ?>

    <div class="container mb-5">
        <h1 class="py-2">Discussions</h1>
        <?php
            $id=$_GET['threadid'];  
            $sqli= "SELECT * FROM `comments` WHERE thread_id=$id";
            $result=mysqli_query($conn,$sqli);
            $noResult=true;
            while($row=mysqli_fetch_assoc($result)){
                $noResult=false;
                $tid=$row['comment_id'];
                $content=$row['comment_content'];
                $comment_time=$row['comment_time'];
                $comment_user=$row['comment_by'];
                $sql2="SELECT user_name FROM `users` where sno='$comment_user'";
                $result2=mysqli_query($conn,$sql2);
                $row2=mysqli_fetch_assoc($result2);

           
        
            echo '<div class="media my-3">
                <img src="img/user.jpg" width="60px" class="mr-3" alt="...">
                <div class="media-body">
                <p class="font-weight-bold my-0">'.$row2['user_name'].' at '.$comment_time.'</p>
                    <p>'.$content.'</p>
                </div>
            </div>';
        }
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                    <p class="display-4">No Comments Found</p>
                    <p class="lead">Be the first person to .</p>
                    </div>
                </div>';
        }
        ?>






    </div>
    </div>
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