<?php

    $showalert=false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $name=$_POST['cname'];
    $desp=$_POST['cdesp'];
    $name=str_replace("<","&lt;",$name);
    $name=str_replace(">","&gt;",$name);

    $desp=str_replace("<","&lt;",$desp);
    $desp=str_replace(">","&gt;",$desp);

   $sql="INSERT INTO `categories` (`category_name`, `category_description`, `created`) 
            VALUES ('$name', '$desp', current_timestamp())";
    $result=mysqli_query($conn,$sql);
    if($result){
        $showAlert = true;
        header("Location: /forum/index.php?categorysuccess=true");
        exit();
    }

}

?>