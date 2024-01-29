<?php include('../connect.php');

if(isset($_POST['Submit']))
{
    $opt=$_POST['opt'];
    if($opt=='All')
    {
        $query="SELECT * FROM `places` ORDER BY `id`";
    }else
    {
        $query="SELECT * FROM `places` WHERE `pkid`='$opt' ORDER BY `id`";
    }
    $sn=0;
    $confirm = mysqli_query($conn, $query) or die(mysqli_error());
    while ($out = mysqli_fetch_array($confirm))
    {
        $title=$out['title'];
        $location=$out['location'];
        $profile=$out['image'];
        $des=$out['des'];
        ?>
            <div class="eventsboxes">
                <img src="<?php echo 'ajax/admin/'.$profile; ?>" alt="Image 1" class="card-img-top1">
                <h4 class="card-title text-left" style="color:black;"><?php echo $title; ?></h4>
                <p><b>Location: </b><?php echo $location; ?></p>
                <p><?php echo $des; ?></p>
            </div>
        <?php   
    } 
}

if(isset($_POST['seat']))
{
    $date=$_POST['seat'];
    $query="SELECT * FROM `seat` WHERE `date`='$date'";
    $exc=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($exc))
    {
        $seat=$row['name'];
        $available=$row['available'];
        echo $available;
    }
    
}


?>