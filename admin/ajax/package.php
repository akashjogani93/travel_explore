<?php include('../../connect.php');
  
  
if(isset($_POST['Submit']))
{
    $query="SELECT * FROM `packge` ORDER BY `id`";
    $sn=0;
    $confirm = mysqli_query($conn, $query) or die(mysqli_error());
    while ($out = mysqli_fetch_array($confirm)) 
    { 
        ?>
        <tr>
            <td><?php echo ++$sn; ?></td>
            <td><?php echo $out['packgename']; ?></td>
            <!-- <td><?php echo $out['location']; ?></td> -->
            <td><?php echo $out['des']; ?></td>
            <!-- <td><img src="<?php echo 'ajax/'.$image;?>" alt="" height="80" widht="80"></td> -->

        </tr>
        <?php   
    }
}
if(isset($_POST['title']))
{
    $title = $_POST['title'];
    $location = $_POST['location'];
    $des = $_POST['des'];
    // $file = $_FILES['file'];
    // $bond1 = upload_Profile($file,"../../image/");
    $query = "INSERT INTO packge (`packgename`,`des`) VALUES ('$title','$des')";
    if(mysqli_query($conn, $query))
    {
        echo "<span style='color:green'>New 'Package' Added successfully</span>";
    }
    else {
            echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
    mysqli_close($conn);
}
?>