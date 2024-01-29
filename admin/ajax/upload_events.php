<?php include('../../connect.php');
  
  
if(isset($_POST['Submit']))
{
    $query="SELECT `places`.*,`packge`.`packgename` FROM `places`,`packge` WHERE `places`.`pkid`=`packge`.`id` ORDER BY `places`.`id`";
    $sn=0;
    $confirm = mysqli_query($conn, $query) or die(mysqli_error());
    while ($out = mysqli_fetch_array($confirm)) 
    { 
        $image=$out['image'];
        ?>
        <tr>
            <td><?php echo ++$sn; ?></td>
            <td><?php echo $out['packgename']; ?></td>
            <td><?php echo $out['title']; ?></td>
            <td><?php echo $out['location']; ?></td>
            <td><?php echo $out['des']; ?></td>
            <td><img src="<?php echo 'ajax/'.$image;?>" alt="" height="80" widht="80"></td>

        </tr>
        <?php   
    }
}
if(isset($_POST['title']))
{
    $title = $_POST['title'];
    $pkg = $_POST['pkg'];
    $location = $_POST['location'];
    $des = $_POST['des'];
    $file = $_FILES['file'];
    $bond1 = upload_Profile($file,"../../image/");
    $query = "INSERT INTO places (`title`,`location`,`des`,`image`,`pkid`) VALUES ('$title','$location','$des','$bond1','$pkg')";
    if (mysqli_query($conn, $query))
    {
        echo "<span style='color:green'>New 'Places' Added successfully</span>";
    }
    else {
            echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
    mysqli_close($conn);
}




if(isset($_POST['busid']) && isset($_POST['pkgid']) && isset($_POST['price']) && isset($_POST['ftime']) && isset($_POST['ttime']) && isset($_POST['date']) && isset($_POST['name']))
{
    $busid = $_POST['busid'];
    $pkgid = $_POST['pkgid'];
    $price = $_POST['price'];
    $ftime = $_POST['ftime'];
    $ttime = $_POST['ttime'];
    $date = $_POST['date'];
    // $name = $_POST['name'];
    $query="INSERT INTO `seat`(`date`, `available`, `busid`, `price`, `fromtime`, `totime`, `pkg`) VALUES ('$date',0,'$busid','$price','$ftime','$ttime','$pkgid')";
    if (mysqli_query($conn, $query))
    {
        echo "<span style='color:green'>New 'seat' Added successfully</span>";
    }
    else {
            echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
    mysqli_close($conn);
}


  
if(isset($_POST['seat']))
{
    $query="SELECT `seat`.*,`bus`.`busname`,`bus`.`totalseat`,`packge`.`packgename` FROM `seat`,`bus`,`packge` WHERE `bus`.`id`=`seat`.`busid` AND `packge`.`id`=`seat`.`pkg` ORDER BY `seat`.`id`";
    $sn=0;
    $confirm = mysqli_query($conn, $query) or die(mysqli_error());
    while ($out = mysqli_fetch_array($confirm)) 
    { 
        ?>
        <tr>
            <td><?php echo ++$sn; ?></td>
            <td><?php echo $out['busname']; ?></td>
            <td><?php echo $out['packgename']; ?></td>
            <td><?php echo $out['price']; ?></td>
            <td><?php echo $out['totalseat']; ?></td>
            <td><?php echo $out['available']; ?></td>
            <td><?php echo $out['date']; ?></td>
            <td><?php echo $out['fromtime']; ?></td>
            <td><?php echo $out['totime']; ?></td>
        </tr>
        <?php   
    }
}

function upload_Profile($image, $target_dir)
{   
        if($image['name']!=""){
        $target_file = $target_dir . basename($image["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $msg = " ";
        try {
            $check = getimagesize($image["tmp_name"]);
            $msg = array();
            if ($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                $msg[1] = "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if ($imageFileType != "pdf" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $msg[2] = "Sorry, only PDF, JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $msg[3] = "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($image["tmp_name"], $target_file)) {
                    //$msg= "The file ". basename( $image["name"]). " has been uploaded.";
                } else {
                    $msg[4] = "Sorry, there was an error uploading your file.";
                }
            }
            // echo "<pre>";
            // print_r($msg);
            return ltrim($target_file, '');
            } catch (Exception $e) {
            // echo "Message" . $e->getmessage();
        }
    }else{
        return "";
    }
}
?>