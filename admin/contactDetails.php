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
            <h2 class="text-center" style="font-weight: 600">CONTACTED MESSAGES</h2>
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
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $query="SELECT * FROM `contactus` ORDER BY `id`";
                    $sn=0;
                    $confirm = mysqli_query($conn, $query) or die(mysqli_error());
                    while ($out = mysqli_fetch_array($confirm)) 
                    { ?>
                        <tr>
                            <td><?php echo ++$sn; ?></td>
                            <td><?php echo $out['name']; ?></td>
                            <td><?php echo $out['email']; ?></td>
                            <td><?php echo $out['message']; ?></td>
                        </tr>
                        <?php   
                    } ?>
            </tbody>
        </table>
        <script>
            $('#example').DataTable();
        </script>
    </div>
</main>
