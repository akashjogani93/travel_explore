<?php include("sidebar.php");
include('../connect.php')

?>
<style type="text/css">
    .table-bordered tr th {
        background-color: rgb(113, 15, 66);
        color: white;
    }
</style>
<div class="page-content container-fluid">
    <div class="footer">
        <div class="d-flex justify-content-between">
            <h2 class="text-center" style="font-weight: 600">Booked Details</h2>
        </div>
    </div>
</div>


<!-- Viewing Registered Users -->
<main class="page-content">
    <hr />
    <div class="table-responsive" style="overflow-y:scroll; height: 480px;">
        <table class="table table-bordered table-striped bg-white" id="example">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Full Name</th>
                    <th>Mobile</th>
                    <th>Date</th>
                    <th>Seat</th>
                    <!-- <th>Action</th> -->
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sql="SELECT `booked`.*,`user`.`name`,`user`.`phone` FROM `booked`,`user` WHERE `booked`.`id`=`user`.`id` ORDER BY `booked`.`id` DESC";
                    $exc=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($exc))
                    {
                        ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['seat']; ?></td>
                            </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
        <script>
            $('#example').DataTable();
        </script>
    </div>
</main>
