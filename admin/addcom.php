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
    .combtn{
      background-color: rgb(113, 15, 66);
        color: white;
    }
    .svg-inline--fa {
      font-size: 12px;
    }
</style>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
<div class="page-content container-fluid">
    <div class="footer">
        <div class="d-flex justify-content-between">
            <h2 class="text-center" style="font-weight: 600">Seats ADD AND VIEW</h2><div class="d-flex flex-direction-row social">
      </div>
        </div>
    </div>
</div>


<!-- Viewing Registered Users -->
<main class="page-content">
    <hr />
    <div class="row">
      <div class="col-md-4">
        <div class="box">
          <h4>Add Seat Details</h4><hr />
          <!-- <form> -->
            <div class="form-group">
              <label for="name">Seats:</label>
              <input type="text" id="name" name="name" class="form-control" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="phone">Date:</label>
              <input type="date" id="date" name="date" class="form-control" autocomplete="off">
            </div>
            <div class="form-group">
              <input type="submit" value="Submit" class="btn combtn" id="community">
              <input type="submit" value="Update" class="btn combtn" id="update" style="display:none;">
              <input type="submit" value="Back" class="btn btn-info" id="back">
              <input type="hidden" id="upvalue" name="upvalue" class="form-control" autocomplete="off" style="display:none;">
              <input type="hidden" id="idupdate" name="upvalue" class="form-control" autocomplete="off" style="display:none;">
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
                <th>Action</th>
                <th>Seats</th>
                <th>Abailable</th>
                <th>Date</th>
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
              url: 'ajax/upload_events.php',
              type: "POST",
              data:{seat:"submit"},
              cache:false,
              success:function(data)
              {
                  $('.mytable').html(data);
                  $('#example').DataTable();
              }
          }); 
      }

      $('#name').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
            if ((keycode < 48 || keycode > 57))
            return false;

            return true;
        });
      
      $('#community').click(function()
      {
        var name = $('#name').val();
        var date = $('#date').val();

          var inputIds = ['#name','#date'];
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
        form_data.append('name', name);
        form_data.append('date', date);
        let log=$.ajax({
            url:"ajax/upload_events.php",
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
