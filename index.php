<?php include('header.php');
include('connect.php')
?>
<style>
  #home{
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
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 banner-container">
            <img src="image/banner1.png" alt="Banner Image" class="banner-image">
        </div>
    </div>
    <div class="row main">
        <div class="col-lg-12">
            <center><h3 class="text-center" style="color:black;">OUR LATEST PLACES</h3>
                <button class="btn btn-info" id="booking">Book A Trip</button>
            </center>
        </div>
    </div>
    <div class="row main">
        <div class="col-lg-12">
            <label for="">Package</label>
            <select name="pkgname" id="pkgname" class="form-control" onchange="packagenamechange()">
                <option value="All">All</option>
                <?php 
                  $query="SELECT * FROM `packge`";
                  $confirm = mysqli_query($conn, $query) or die(mysqli_error());
                  while ($out = mysqli_fetch_array($confirm)) 
                  {
                    $id=$out['id'];
                    $pkgname=$out['packgename'];
                    ?>
                      <option value="<?php echo $id; ?>"><?php echo $pkgname; ?></option>
                    <?php
                  } 
                ?>
            </select>
        </div>
    </div>
    <div class="row main" id="eventRow">
        
    </div>


    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="date" class="form-control" id="date" name="date" min="" max="" onchange="dateChageAvail()">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Seat</label>
                            <input type="text" class="form-control" id="seat" name="seat" oninput="seatCheck()">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Available</label>
                            <input type="text" class="form-control" id="avl" name="avl" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="booktrip">Book Trip</button>
            </div>
            </div>
        </div>
    </div>

    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" id="clickModal">
    </button> -->
</div>
<?php include('footer.php'); ?>
<script>
    $(document).ready(function()
    {
        const currentDate = new Date();
        document.getElementById('date').min = currentDate.toISOString().split('T')[0];
        const tomorrowDate = new Date(currentDate);
        tomorrowDate.setDate(currentDate.getDate() + 1);
        document.getElementById('date').max = tomorrowDate.toISOString().split('T')[0];

        let log=$.ajax({
          url: 'api/load_events.php',
          type: "POST",
          data:{Submit:"submit",opt:'All'},
          cache:false,
          success:function(data)
          {
            // console.log(data);
              $('#eventRow').html(data);
          }
        });

        $('#booking').click(function()
        {
            <?php
                if(isset($_SESSION['userid']))
                {
                    $id=$_SESSION['userid'];
                    ?>
                        var id="<?php echo $id; ?>";
                    <?php
                }else
                {
                    $id="null";
                    ?>
                        var id="<?php echo $id; ?>";
                    <?php
                }
            ?>
            if(id =='null')
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'First You Have To Login!',
                })
            }else
            {
                $('#exampleModalCenter').modal('show');
            }
        });

        $('#booktrip').click(function()
        {
            var avail=$('#avl').val();
            var book=$('#seat').val();
            var date=$('#date').val();
            var inputIds = ['#date','#seat','#avl'];
            for (var i = 0; i < inputIds.length; i++) 
            {
                var inputValue = $(inputIds[i]).val();
                if (inputValue === '') 
                {
                    $(inputIds[i]).css('border-color', 'red');
                    exit();
                }else {
                    $(inputIds[i]).css('border-color', '');
                }
            }

            <?php
                if(isset($_SESSION['userid']))
                {
                    $id=$_SESSION['userid'];
                    ?>
                        var id="<?php echo $id; ?>";
                    <?php
                }else
                {
                    $id="null";
                    ?>
                        var id="<?php echo $id; ?>";
                    <?php
                }
            ?>

            let ajax=$.ajax({
                url:"api/insert_api.php",
                method:"POST",
                data:{
                    avail:avail,
                    book:book,
                    date:date,
                    id:id,
                },
                success: function(response)
                {
                    console.log(response);
                    if(response==0)
                    {
                        Swal.fire({
                            icon: 'success',
                            text: 'SUCCESSFULLY BOOKED',
                        }).then(() => {
                            window.location.href = 'index.php';
                        });
                    }
                }
            });
        });
    });

    function packagenamechange()
    {
        var opt=$('#pkgname').val();
        let log=$.ajax({
          url: 'api/load_events.php',
          type: "POST",
          data:{Submit:"submit",opt:opt},
          cache:false,
          success:function(data)
          {
            $('#eventRow').empty();
            $('#eventRow').html(data);
          }
        });
    }
    function dateChageAvail()
    {
        var date=$('#date').val();
        let seatAvil=$.ajax({
          url: 'api/load_events.php',
          type: "POST",
          data:{seat:date},
          cache:false,
          success:function(data)
          {
            // console.log(data);
            $('#avl').val(data);
          }
        });
    }

    function seatCheck()
    {
        var avail=$('#avl').val();
        var book=$('#seat').val();
        if(book > avail)
        {
            $('#seat').val(avail)
        }
    }
</script>