<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    include '_dbconnect.php';
    $login_email=$_POST['loginemail'];
    $password=$_POST['loginpassword'];
    $sql="SELECT * FROM `users` WHERE user_email='$login_email'";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    if($num==1){
       while($row=mysqli_fetch_assoc($result)){
            if(password_verify($password,$row['user_pass'])){
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['sno']=$row['sno'];
                $_SESSION['useremail']=$login_email;
               $_SESSION['username']= $row['user_name'];
                echo "logged in".$login_email;
                header("Location:/forum/index.php");
                exit();
            }
            else{
                header("Location:/forum/index.php");
            }
        }
    }
    header("Location:/forum/index.php");
}


?>