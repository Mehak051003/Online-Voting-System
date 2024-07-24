<?php
    include ("connect.php");

    $name=$_POST['name'];
    $mobile=$_POST['mobile'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    $address=$_POST['address'];
    $image=$_FILES['photo']['name'];
    $tmp_name=$_FILES['photo']['tmp_name'];
    $role=$_POST['role'];

    if (!preg_match ("/^[a-zA-z]*$/", $name) ) {  
        echo '
        <script>
        alert("Only alphabets and whitespace are allowed in name.");  
        window.location="../routes/register.html";
        </script>
        ';
    }
    if(strlen($password) < 3 || strlen($password) >8){
        echo '
        <script>
        alert("Password must be of length 3 to 8");  
        window.location="../routes/register.html";
        </script>
        ';
    }

    if($password==$cpassword){
        move_uploaded_file($tmp_name,"../uploads/$image");
        $insert=mysqli_query($connect,"INSERT INTO user(name,mobile,password,address,photo,role,status,votes) VALUES('$name','$mobile','$password','$address','$image','$role',0,0)");
        if($insert){
            echo '
        <script>
        alert("Registration successfull!");
        window.location="../";
        </script>
        ';
        }
        else{
            echo '
        <script>
        alert("Some error occured");
        window.location="../routes/register.html";
        </script>
        ';
        }
    }
    else{
        echo '
        <script>
        alert("Password and confirm password do not match!");
        window.location="../routes/register.html";
        </script>
        ';
    }

?>