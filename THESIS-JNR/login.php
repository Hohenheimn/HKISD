<?php
    session_start();
?>
<html lang="en">
<head>
    <link rel="icon" type="image/png" sizes="16x16" href="images/tubat-logo.jpg">
    <title>Sign in JNR Motorcycle parts and Accessories</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="mycss/login.css">
    <link href="mycss/sidescrollbar.css" rel="stylesheet">
    <style>
        #hm{
            display:none;
        }
    </style>
</head>
<?php
$error ='';
$error1 ='';
    require_once 'connect.php';
    if(isset($_POST['login'])){
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $salt = "codeflix";
        if($pass != '' && $user != ''){
            $validate = $mysqli->query("SELECT * FROM  tbl_account WHERE username='$user'");
            if(mysqli_num_rows($validate) == 1){
                $row = $validate->fetch_array();
                if(password_verify($pass, $row['password'])){
                    $_SESSION['admin_username'] = $row['username'];
                    echo "<script>window.location = 'dashboard.php';</script>";
                }
                else{
                    $error = "<p class='error_login'>Wrong username or password</p>";
                }
               
            }
            else{
                $error = "<p class='error_login'>Wrong username or password</p>";
            }
        }
        else{
            $error = "<p class='error_login'>Enter username and password</p>";
        }
    }
 ?>
<body>
    <div class="hero">
                     
                        <div class="form-box1">
                        
                        <header>
                        
                        <img src="images/tubat-logo.jpg" class="loggo">
                        <h4><span class="JNR">JNR</span><span class="name"> MOTO</span></h4>
                            
                         
                        </header>
                       
                            <div class="form-box">
                            
                                <div class="button-box">
                                
                                    <div id="btn"></div>
                                    <button class="toggle-btn" onclick="login()">ADMIN</button>
                                    <button class="toggle-btn1" onclick="register()">STAFF</button>
                                </div>
                               
                            <form action="login.php" method="POST">
                                <div id="login" class="input-group">
                               
                                    <input type="mail" class="input-field" name="username" placeholder="username">
                                    <div class="passBox">
                                        <input type="password" id="passwordText" class="input-field1" name="password" placeholder="password">
                                        <a class="passhide" id="bhide"><img src="images/hidePass.png" id="hide" class="eye" alt="">
                                        <img src="images/showPass.png" id="shows" class="eye" alt=""></a> 
                                    </div>
                                    <!-- <input type="password" class="input-field" name="password" placeholder="password"> -->
                                    <p class="ss"><?php echo $error; ?></p>
                                    <button class="submit-btn" name="login">SIGN IN</button>
                                    <div class="forgot">
                                        <a href="JNR-send-otp.php" class="forget">FORGOT PASSWORD?</a>
                                    </div>
                                </div>
                                
                            </form>
                                <div id="register" class="input-group">
                                
                                    <input type="password" class="input-field" id="stid" placeholder="ID Number">
                                    <p class='error_login' id="error"></p>
                                    <p id="hm"></p>
                                    <button class="submit-btn" id="stuffid">SIGN IN</button>
                                    <div class="forgot1">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
    
   
    <div>
   
    <script>
        $(document).ready(function(){

            $('#bhide').click(function(){

              var passwordField = $('#passwordText');
              var passFieldType = passwordField.attr('type');

              if(passFieldType == 'password'){
                    passwordField.attr('type', 'text');
                    document.getElementById('hide').style.display='none';
                    document.getElementById('shows').style.display='inline';
              }
              else{
                    passwordField.attr('type', 'password');
                    document.getElementById('hide').style.display='inline';
                    document.getElementById('shows').style.display='none';
              }
               
            });
            
        });
        $(document).ready(function(){
            
            $('#shows').click(function(){
              document.getElementById('hide').style.display='inline';
              document.getElementById('shows').style.display='none';
            });

        });
        $(document).ready(function(){
               
            $('#stuffid').click(function(){
                var staffid = document.getElementById('stid').value;
                if(staffid != ''){
                    $.ajax({
                        url:"POSaction.php",
                        method:"POST",
                        data:{staffid:staffid},
                        success:function(data)
                        {
                            $('#hm').html(data);
                            var a = document.getElementById('hm').innerHTML;
                            switch(a){
                                case 'login':
                                    window.location="POS_stuff.php";
                                break;
                                default:
                                document.getElementById('error').innerHTML = "Invalid ID";
                                break;
                            }
                        }

                    });
                }
                else{
                    document.getElementById('error').innerHTML = "Enter an ID";
                }
            });
        });

        var x= document.getElementById('login');
        var y= document.getElementById('register');
        var z= document.getElementById('btn');

        function register(){
            x.style.left ="-450px";
            y.style.left ="25px";
            z.style.left ="120px";
        }
        function login(){
            x.style.left ="25px";
            y.style.left ="500px";
            z.style.left ="0px";
        }
    </script>
</body>
</html>