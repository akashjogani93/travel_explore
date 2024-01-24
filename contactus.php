<?php include('header.php'); ?>
  <style>
    #conta{
    color:rgb(113, 15, 66);
    font-weight: 800;
  }
  .main{
    margin-top:50px;
    margin-bottom:50px;
  }
  h1 {
    text-align: center;
  }
  </style>
<div class="container-fluid">
  <div class="row main">
    <div class="col-md-6">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d248849.90089956965!2d77.46612571649636!3d12.95394561387551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae1670c9b44e6d%3A0xf8dfc3e8517e4fe0!2sBengaluru%2C%20Karnataka!5e0!3m2!1sen!2sin!4v1686742081994!5m2!1sen!2sin" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="col-md-6">
      <h5 style="text-align:left">Contact Us</h5>
      <div class="contact-form">
        <input type="text" name="name" placeholder="Your Name" required id="name" autocomplate="off">
        <input type="email" name="email" placeholder="Your Email" required id="email" autocomplate="off">
        <div id="validemail" style="display:none; font-size:12px; margin:0; padding:0;"></div>
        <textarea name="message" placeholder="Your Message" required id="message"></textarea>
        <button type="submit" id="contactsubmit" class="btBack">Send Message</button>
        <div id="conform"></div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function()
  {

    $('#name').keypress(function(event)
    {
        var keycode = (event.keyCode ? event.keyCode : event.which);
            if ((keycode < 48 || keycode > 57))
            return true;

            return false;

    });
      $('#contactsubmit').click(function()
      {
          var name=$('#name').val();
          var email=$('#email').val();
          var message=$('#message').val();

          var inputIds = ['#name','#email', '#message'];
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

          var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if(emailPattern.test(email))
          {

            $('#validemail').html('');
            $('#email').css('border-color', '');

            

            var form_data = new FormData();
            form_data.append('contname', name);
            form_data.append('contemail', email);
            form_data.append('contmessage', message);

            let log=$.ajax({
                url:"api/insert_api.php",
                method:"POST",
                data:form_data,
                contentType: false,
                processData: false,
                success: function(response) 
                {
                    $('#conform').html(response);
                    setTimeout(function() 
                    {
                        $('#conform').html('');
                    }, 3000);

                    for (var i = 0; i < inputIds.length; i++) {
                            $(inputIds[i]).val('');
                        }
                }
           });
            // console.log(log);
          }else
          {
              $('#validemail').show();
              $('#validemail').html("<span style='color:red'>Email Is Not Valid</span>");
              $('#email').css('border-color', 'red');
          }
      });
  });
</script>

<?php include('footer.php'); ?>