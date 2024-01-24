<?php include('header.php');
    include('connect.php');
    $id=$_SESSION['userid'];
?>
<style>
  #booked{
    color:rgb(113, 15, 66);
    font-weight: 800;
  }
  .banner-container {
            position: relative;
            height: 600px; 
            overflow: hidden;
        }

        /* Custom CSS for the banner image */
        .banner-image {
            position: absolute;
            top: 50%; /* Center the image vertically */
            left: 0;
            transform: translateY(-50%); /* Adjust to center the image */
            width: 100%;
            height: auto;
        }
        .main
        {
            margin-top:50px;
            margin-bottom:50px;
        }
</style>
<div class="container-fluid">
    <!-- <div class="row">
        <div class="col-md-12 banner-container">
            <img src="image/banner1.png" alt="Banner Image" class="banner-image">
        </div>
    </div> -->
    <div class="row main">
        <div class="col-md-4">
            <div class="baner-image">
                <img src="image/tra.jpg" alt="book" style="width: 100%; height: 400px; object-fit: cover;">
            </div>
        </div>
        <div class="col-md-8">
            <div class="table-co">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Seat</th>
                            <!-- <th>Status</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql="SELECT * FROM `booked` WHERE `userId`='$id'";
                            $exc=mysqli_query($conn,$sql);
                            while($row=mysqli_fetch_assoc($exc))
                            {
                                ?>
                                    <tr>
                                        <!-- <td><?php echo $row['id']; ?></td> -->
                                        <td><?php echo $row['date']; ?></td>
                                        <td><?php echo $row['seat']; ?></td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>