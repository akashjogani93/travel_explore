<?php 
session_start();

    include('../connect.php');

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password']))
{
    $name=$_POST['name'];
    $email=$_POST['email'] ;
    $phone=$_POST['phone'] ;
    $password=$_POST['password'];
    $gen=$_POST['gen'];

    $check="SELECT * FROM `login` WHERE `user`='$email' AND `type`='user'";
    $checkExc=mysqli_query($conn,$check);
    if(mysqli_num_rows($checkExc) > 0)
    {
        // echo "User already exists.";
        echo 0;
    }else
    {
        $insertUser="INSERT INTO `user`(`name`, `email`, `phone`, `gender`, `password`) VALUES ('$name','$email','$phone',' $gen','$password')";
        $exc=mysqli_query($conn,$insertUser);
        if($exc)
        {
            $insertedId = mysqli_insert_id($conn); 
            $insertLogin="INSERT INTO `login`(`user`, `pass`, `type`,`userId`) VALUES ('$email','$password','user','$insertedId')";
            $logExc=mysqli_query($conn,$insertLogin);
            if($logExc)
            {
                $_SESSION['userid'] = $insertedId;
                // echo "User registered successfully.";
                echo 1;
            }else
            {
                echo "Login insertion failed.";
            }
        }else
        {
            echo "User registration failed.";
        }
    }
}


if(isset($_POST['name1']) && isset($_POST['email1']) && isset($_POST['phone1']))
{
    $name=$_POST['name1'];
    $email=$_POST['email1'] ;
    $phone=$_POST['phone1'] ;
    $gen=$_POST['gen1'];
    $userid=$_POST['id'];

    $check="SELECT * FROM `login` WHERE `user`='$email' AND `type`='user' AND `userId` != '$userid'";
    $checkExc=mysqli_query($conn,$check);
    if(mysqli_num_rows($checkExc) > 0)
    {
        // echo "User already exists.";
        echo 0;
    }else
    {
        $updateUser="UPDATE `user` SET `name`='$name',`email`='$email',`phone`='$phone',`gender`='$gen' WHERE `id`='$userid'";
        $exc=mysqli_query($conn,$updateUser);
        if($exc)
        {
            $insertedId = mysqli_insert_id($conn); 
            $updateLogin="UPDATE `login` SET `user`='$email' WHERE `userId`='$userid'";
            $logExc=mysqli_query($conn,$updateLogin);
            if($logExc)
            {
                // $_SESSION['userid'] = $insertedId;
                // echo "User registered successfully.";
                echo 1;
            }else
            {
                echo "Login insertion failed.";
            }
        }else
        {
            echo "User registration failed.";
        }
    }
}

if(isset($_POST['username']) && isset($_POST['password1']))
{
    $username=$_POST['username'];
    $password1=$_POST['password1'];

    $check="SELECT * FROM `login` WHERE `user`='$username' AND `pass`='$password1'";
    $checkExc=mysqli_query($conn,$check);
    if(mysqli_num_rows($checkExc) > 0)
    {
        while($row=mysqli_fetch_assoc($checkExc))
        {
            $id=$row['userId'];
            $type=$row['type'];
            if($type=='admin')
            {
                $_SESSION['type'] = $type;
                echo 0;
            }else
            {
                $_SESSION['userid'] = $id;
                echo 1;
            }
            
        }
        // echo "User already exists.";
    }else
    {
        echo 2;
    }
}


if(isset($_POST['avail']) && isset($_POST['book']))
{
    $avail=$_POST['avail'];
    $book=$_POST['book'];
    $date=$_POST['date'];
    $id=$_POST['id'];
    $last=$avail-$book;
    $query="INSERT INTO `booked`(`date`, `seat`, `status`,`userid`) VALUES('$date','$book','booked','$id')";
    $checkExc=mysqli_query($conn,$query);
    if($checkExc)
    {
        $update="UPDATE `seat` SET `available`='$last' WHERE `date`='$date' AND `available`='$avail'";
        $excuteUpdate=mysqli_query($conn, $update);
        if($excuteUpdate)
        {
            echo 0;
        }
    }
}



 
if(isset($_POST['contname']) && isset($_POST['contemail']) && isset($_POST['contmessage']))
{
    $name = $_POST['contname'];
    $email = $_POST['contemail'];
    $message = $_POST['contmessage'];
    $query="INSERT INTO `contactus`(`name`, `email`, `message`) VALUES ('$name','$email','$message')";
    if(mysqli_query($conn,$query))
    {
        echo "<span style='color:green'>Your Message Was Submitted</span>";
    }
}
?>