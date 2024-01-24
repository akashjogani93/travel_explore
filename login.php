<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="custome.css">
    <title>Explore</title>
</head>
<style>

</style>
<body>
    <div class="login-box-container">
        <div class="login-box-form" id="login-form">
            <!-- Login Box -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            
                        <h4 class="heading">LOGIN</h4></center>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="username">Email</label>
                            <input type="email" id="username" class="form-control" required autocomplete="off">
                            <div id="emailvalid" style="margin-top:7px; font-size:10px; letter-spacing:0.8px"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password1" class="form-control" required  autocomplete="off">
                            <div id="passvalid" style="margin-top:7px; font-size:10px; letter-spacing:0.8px"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button id="login" class="btn btn-block">LOGIN</button>
                        <p class="register-link text-center">Don't have an account? <a href="#" id="register-link">Register here</a></p></br>
                        <!-- <p class="register-link text-center">Forgot Password? <a href="#" id="forget-link">Reset here</a></p> -->
                    </div>
                </div>
            </div>
            <!-- Login Box End -->
        </div>

        <!-- Registration Box -->
        <div id="register-form"  class="register-box-form" style="display: none;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <center>
                        <h4 class="heading">REGISTER</h4></center>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" required autocomplete="off">
                            <div id="validemail" style="margin-top:7px; font-size:10px; letter-spacing:0.8px"></div>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" class="form-control" required autocomplete="off">
                            <div id="validmobile" style="margin-top:7px; font-size:10px; letter-spacing:0.8px"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" id="password" class="form-control" required autocomplete="off">
                            <div style="margin-top:7px; font-size:10px; letter-spacing:0.8px">Password Must Be Alphanumeric Minumum length 6</div>
                            <div id="passValid" style="margin-top:7px; font-size:10px; letter-spacing:0.8px"></div>
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" id="confirm-password" class="form-control" required autocomplete="off">
                            <div id="confirm" style="margin-top:7px; font-size:10px; letter-spacing:0.8px"></div>
                        </div>
                        <div class="form-group">
                            <label for="sta">SELECT GENDER</label>
                            <select id="gen" class="form-control" required>
                                <option value=""></option>
                                <option>MALE</option>
                                <option>FEMALE</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <center><button type="submit" class="btn btn-block reg" id="register">REGISTER</button><center>
                        <p class="login-link text-center">Already have an account? <a href="#" id="login-link">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() 
        {
            $("#register-link").click(function (e) 
            {
                e.preventDefault();
                $("#login-form").hide();
                $("#register-form").show();
            });
            $("#login-link").click(function (e) {
                e.preventDefault();
                $("#register-form").hide();
                $("#login-form").show();
            });


            // when Click On Registration Box register box
            $('#register').click(function()
            {
                var name=$('#name').val();
                var email=$('#email').val();
                var phone=$('#phone').val();
                var password=$('#password').val();
                var confirmPassword=$('#confirm-password').val();
                var gen=$('#gen').val();


                var inputIds = ['#name','#email','#phone','#password','#confirm-password'];
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

                // To Pass And Conform Pass
                if(confirmPassword!=password)
                {
                    $('#confirm-password').css('border-color', 'red');
                    $('#confirm').html('<span style="color:red">Password Not Matched</span>');
                    exit();
                }else
                {
                    $('#confirm-password').css('border-color', '');
                    $('#confirm').html('');
                }

                // Do not take Same Email And Mobile Already Regestered
                // let log=$.ajax({
                        // url:"ajax/register.php",
                        // method:"POST",
                        // data:{validemail:email},
                        // success: function(response)
                        // {
                //             if(response=='valid')
                //             {
                //                 $('#email').css('border-color', 'green');
                //                 $('#validemail').html('');
                //             }else
                //             {
                //                 $('#validemail').html("<span style='color:red'>Email Is Alredy Used</span>");
                //                 $('#email').css('border-color', 'red');
                //                 exit();
                //             }
                //         }
                //});
                    let ajax=$.ajax({
                        url:"api/insert_api.php",
                        method:"POST",
                        data:{
                            name:name,
                            email:email,
                            phone:phone,
                            password:password,
                            gen:gen
                        },
                        success: function(response)
                        {
                            console.log(response);
                            if(response==1)
                            {
                                Swal.fire({
                                    icon: 'success',
                                    text: 'SUCCESSFULLY REGISTERED',
                                }).then(() => {
                                    window.location.href = 'index.php';
                                });
                            }else if(response==0)
                            {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'User already exists.!',
                                })
                            }
                        }
                    });
                    // console.log(ajax);
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

            });


            $('#login').click(function()
            {
                var username=$('#username').val();
                var password1=$('#password1').val();

                var inputIds = ['#username','#password1'];
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

                    let ajax=$.ajax({
                        url:"api/insert_api.php",
                        method:"POST",
                        data:{
                            username:username,
                            password1:password1,
                        },
                        success: function(response)
                        {
                            console.log(response);
                            if(response==0)
                            {
                                Swal.fire({
                                    icon: 'success',
                                    text: 'SUCCESSFULLY Login',
                                }).then(() => {
                                    window.location.href = 'admin/user.php';
                                });
                            }else if(response==1)
                            {
                                Swal.fire({
                                    icon: 'success',
                                    text: 'SUCCESSFULLY Login',
                                }).then(() => {
                                    window.location.href = 'index.php';
                                });
                            }
                            else if(response==2)
                            {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'WRONG USERNAME AND PASSWORD.!',
                                })
                            }
                        }
                    });
            });
        });
    </script>
</body>