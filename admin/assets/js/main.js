
  function verify(e){
        let adhar =$('#adhar_upload').val();
        let doc = $('#doc_upload').val();
        let pan = $('#pan_upload').val();
        if((adhar=="")&&(doc=="")&&(pan=="")){
          swal("Error","Upload Document", "error");
          return "false";
        }else{
         $(e).attr("type","submit");
        }
  }

    // image display when select  
     function image_select(e){
       $(e).click();
     }
     
    //  selected view image 
     function readURL(input,id){
      if(input.files && input.files[0])
          {
              //var id = "#profimg";
              var reader =new FileReader();
              reader.onload=function(e){
                  $(id).attr('src',e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
  }

//to cheack profile image selected or not
function file_valid()
{
    var x = document.getElementById("profile_upload").value;
    if(x!="")
    {
      return true;
    }
    else{
      alert("select profile image.");
      return false;
    }
}

// input only takes number
function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode;
  if ((charCode < 46 || charCode == 47 || charCode > 57))
  return false;   

  return true;
}


//validation For File


function  Filevalidation(fi,id){
        //const fi = document.getElementById('file'); 
         var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
        if ($.inArray($(fi).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
          swal("Error","Only formats are allowed : "+fileExtension.join(', '), "error");
            //alert("Only formats are allowed : "+fileExtension.join(', '));
             fi.value="";
        }

        // Check if any file is selected. 
        if (fi.files.length > 0) { 
            for (const i = 0; i <= fi.files.length - 1; i++) { 

                const fsize = fi.files.item(i).size; 
                const file = (fsize /(1024*1024)).toFixed(2);
                // The size of the file. 
                if (file >= 0.2) { 
                  swal("Error","File Is Too Big", "error");
                    fi.value="";
                } else if (file < .009) { 
                   
                } else { 
                  //id = "#profimg";
                  readURL(fi,id);
                } 
            } 
        } 

        
}



jQuery(function ($) {

    $(".sidebar-dropdown > a").click(function() {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this)
      .parent()
      .hasClass("active")
  ) {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .parent()
      .removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .next(".sidebar-submenu")
      .slideDown(200);
    $(this)
      .parent()
      .addClass("active");
  }
});

$("#close-sidebar").click(function() {
  $(".page-wrapper").removeClass("toggled");
});
$("#show-sidebar").click(function() {
  $(".page-wrapper").addClass("toggled");
});   
});
