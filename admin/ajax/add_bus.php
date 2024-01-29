<?php include('../../connect.php');
  
  
if(isset($_POST['Submit']))
{
    $query="SELECT * FROM `bus` ORDER BY `id`";
    $sn=0;
    $confirm = mysqli_query($conn, $query) or die(mysqli_error());
    while ($out = mysqli_fetch_array($confirm)) 
    { 
        ?>
        <tr>
            <td><?php echo ++$sn; ?></td>
            <td><?php echo $out['busname']; ?></td>
            <td><?php echo $out['bus_no']; ?></td>
            <td><?php echo $out['drivername']; ?></td>
            <td><?php echo $out['bus_no']; ?></td>
        </tr>
        <?php   
    }
}
if(isset($_POST['busname']))
{
    $busname = $_POST['busname'];
    $busnumber = $_POST['busnumber'];
    $drivername = $_POST['drivername'];
    $totalseat = $_POST['totalseat'];
    $query="INSERT INTO `bus`(`busname`, `drivername`, `totalseat`,`bus_no`) VALUES ('$busname','$drivername','$totalseat','$busnumber')";
    if(mysqli_query($conn, $query))
    {
        echo "<span style='color:green'>New 'Bus' Added successfully</span>";
    }
    else {
            echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
    mysqli_close($conn);
}
?>