<?php include("sidebar.php");
include('../connect.php')

?>
<style type="text/css">
    .box {
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
      padding: 20px;
    }
    .table-bordered tr th {
        background-color: rgb(113, 15, 66);
        color: white;
    }
    .btn{
      background-color: rgb(113, 15, 66);
        color: white;
    }
</style>
<div class="page-content container-fluid">
    <div class="footer">
        <div class="d-flex justify-content-between">
            <h2 class="text-center" style="font-weight: 600">Add New Bus</h2>
        </div>
    </div>
</div>


<!-- Viewing Registered Users -->
<main class="page-content">
    <hr />
    <div class="row">
      <div class="col-md-4">
        <div class="box">
          <h4>Add Bus Details</h4><hr />
          <!-- <form> -->
            <div class="form-group">
              <label for="title">Bus Name:</label>
              <input type="text" id="busname" name="title" class="form-control" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="title">Bus Number:</label>
              <input type="text" id="busnumber" name="title" class="form-control" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="location">Driver Name:</label>
              <input type="text" id="drivername" name="location" class="form-control" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="des">Total Seat:</label>
              <input type="text" id="totalseat" name="totalseat" class="form-control" autocomplete="off">
            </div>
            <!-- <div class="form-group">
              <label for="file">Image:</label>
              <input type="file" class="form-control form-control-sm" name="path" id="path"  accept="image/jpeg, image/png" required>
            </div> -->
            <div class="form-group">
              <input type="submit" value="Submit" class="btn" id="places">
              <center><div id="submited"></div></center>
            </div>
          <!-- </form> -->
        </div>
      </div>
      <div class="col-md-8">
        <div class="table-responsive" style="overflow-y:scroll; height: 380px;">
          <table class="table table-bordered table-striped bg-white" id="example">
            <thead>
              <tr>
                <th>Sl No</th>
                <th>Bus Name</th>
                <th>Bus Number</th>
                <th>Driver Name</th>
                <th>Total Seat</th>
              </tr>
            </thead>
            <tbody class="mytable">
               
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() 
    {

      loade();
      function loade()
      {
          var table=$('#example').DataTable();
          table.destroy();
          let log=$.ajax({
              url: 'ajax/add_bus.php',
              type: "POST",
              data:{Submit:"submit"},
              cache:false,
              success:function(data)
              {
                  $('.mytable').html(data);
                  $('#example').DataTable();
              }
          }); 
      }

    //   $('#location').keypress(function(event){
    //     var keycode = (event.keyCode ? event.keyCode : event.which);
    //         if ((keycode < 48 || keycode > 57))
    //         return true;

    //         return false;
    //     });
      
      $('#places').click(function()
      {
        var busname = $('#busname').val();
        var busnumber = $('#busnumber').val();
        var drivername = $('#drivername').val();
        var totalseat = $('#totalseat').val();
        var inputIds = ['#busname','#busnumber','#drivername','#totalseat'];

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

        var form_data = new FormData();
        form_data.append('busname', busname);
        form_data.append('busnumber', busnumber);
        form_data.append('drivername', drivername);
        form_data.append('totalseat', totalseat);
        let log=$.ajax({
            url:"ajax/add_bus.php",
            method:"POST",
            data:form_data,
            contentType: false,
            processData: false,
            success: function(response) 
            {
                $('#submited').html(response);
                loade();
                setTimeout(function() {
                    $('#submited').html('');
                }, 3000);
                for (var i = 0; i < inputIds.length; i++) {
                    $(inputIds[i]).val('');
                }
            }
        });
      });

    });

  </script>
</main>
