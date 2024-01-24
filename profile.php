<?php include('header.php'); include('connect.php')?>
<style>
    body
    {
        background-image: url("image/log.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }
    #profi{
        color:rgb(113, 15, 66);
        font-weight: 800;
    }
</style>
<div class="container-fluid">
    <div class="row main">
    <!-- Profile -->

    <?php 
        $id=$_SESSION['userid'];
        $profData="SELECT * FROM `user` WHERE `id`='$id'";
        $exc=mysqli_query($conn,$profData);
        while($row=mysqli_fetch_assoc($exc))
        {
            $name=$row['name'];
            $email=$row['email'];
            $phone=$row['phone'];
            $gender=$row['gender'];
            $password=$row['password'];
        }
    ?>
    <div class="profile-card pb-3">
        <div class="profile-image" style="width:100%;">
            <h2 style="color:white;">Profile</h2>
            <img src="<?php echo 'image/profile.png';?>"  alt="Profile Image" />
        </div>
        <div class="profile-info p-3">
            <div class="conatiner">
                <div class="row">
                    <div class="col-md-12">
                        <p><span>Name: <?php echo $name; ?></span></p>
                        <p><span>Email: <?php echo $email; ?></span></p>
                        <p><span>Phone: <?php echo $phone; ?></span></p>
                        <p><span>Gender: <?php echo $gender; ?></span></p>
                        <p><span>Password: <?php echo $password; ?></span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="edit-button">
            <button id="editProfileBtn">Edit</button>
        </div>
    </div>
    <!-- Profile Edit -->
    <div class="profile-edit-card py-3 pt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="file">Profile:</label>
                    <input type="file" id="path" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $name; ?>">
                    <input type="hidden" id="id" class="form-control" value="<?php echo $id; ?>">
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" class="form-control" value="<?php echo $phone; ?>">
                    <div id="validmobile"></div>
                    <input type="hidden" id="phoneold" class="form-control" >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <label class="d-block" for="gender">Gender:</label>
                <select name="gen" id="gen">
                    <option><?php echo $gender; ?></option>
                    <?php if($gender=='MALE')
                    {
                        ?>
                        <option>FEMALE</option>
                        <?php
                    }else
                    {
                        ?>
                        <option>MALE</option>
                        <?php
                    }?>
                    
                    
                </select>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" class="form-control" value="<?php echo $email; ?>">
                    <div id="validemail"></div>
                    <input type="hidden" id="emailold" class="form-control" >
                </div>
            </div>
            <div class="text-center pt-3">
                <button id="saveProfileBtn" class="btn btn-primary" onclick="submitData()">Save</button>
                <button id="goback" class="btn btn-success">Cancel</button>
                <div id="submited"></div>
            </div>
        </div>
    </div>
    </div>
</div>
<?php include('footer.php'); ?>
<script>
  const editProfileBtn = document.getElementById('editProfileBtn');
  const goback = document.getElementById('goback');
  const saveProfileBtn = document.getElementById('saveProfileBtn');
  const profileCard = document.querySelector('.profile-card');
  const profileEditCard = document.querySelector('.profile-edit-card');

  editProfileBtn.addEventListener('click', function() {
    profileCard.style.display = 'none';
    profileEditCard.style.display = 'block';
  });
  goback.addEventListener('click', function() {
    profileCard.style.display = 'block';
    profileEditCard.style.display = 'none';
  });



  function submitData()
  {
    var id=$('#id').val();
    var name=$('#name').val();
    var email=$('#email').val();
    var phone=$('#phone').val();
    var gen=$('#gen').val();

    var inputIds = ['#name','#email','#phone','#gen'];
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

    // when registration Box  email validation
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(!emailPattern.test(email))
    {
        $('#validemail').html("<span style='color:red'>Email Is Not Valid</span>");
        $('#email').css('border-color', 'red');
        setTimeout(function()
            {
            $('#validemail').empty();
            $('#email').css('border-color', '');
        }, 5000);
        return;
    }

    //Mobile Number Validation
    if(!phone.length==10 && areAllDigitsSame(phone)) 
    {
        $('#validmobile').html("<span style='color:red'>Mobile Is Not Valid</span>");
        $('#phone').css('border-color', 'red');
        setTimeout(function()
        {
            $('#validmobile').empty();
            $('#phone').css('border-color', '');
        }, 5000);
        return;
    }

    let ajax=$.ajax({
        url:"api/insert_api.php",
        method:"POST",
        data:{
            name1:name,
            email1:email,
            phone1:phone,
            gen1:gen,
            id:id
        },
        success: function(response)
        {
            console.log(response);
            if(response==1)
            {
                Swal.fire({
                    icon: 'success',
                    text: 'SUCCESSFULLY UPDATED',
                }).then(() => {
                    window.location.href = 'profile.php';
                });
            }else if(response==0)
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Somenthing Went Wrong.!',
                })
            }
        }
    });
    console.log(ajax);
  }
  function areAllDigitsSame(phoneNumber) 
    {
        var firstDigit = phoneNumber.charAt(0);

        for (var i = 1; i < phoneNumber.length; i++) {
            if (phoneNumber.charAt(i) !== firstDigit) {
            return false;
            }
        }

        return true;
    }
</script>