<?php
      session_start();
      if(!isset($_SESSION['chpassword'])){
          header("location: login.php");
      }
      require_once 'connect.php';
      $err = "";
      if(isset($_POST['submit'])){
          $new = $_POST['new'];
          $confirm = $_POST['confirm'];
          if($new != '' && $confirm != ''){
               if($confirm != $new){
                    $err = "Password does not match";
                }
                else{

                    $result = $mysqli->query("SELECT * FROM tbl_account");
                    $row = $result->fetch_array();
                    $_SESSION['admin_username'] = $row['username'];
                    $hash = password_hash($confirm, PASSWORD_DEFAULT);
                    $mysqli->query("UPDATE tbl_account SET password = '$hash'");
                    unset($_SESSION['chpassword']);
                    header("location: dashboard.php");

                }
          }
          else{
              $err = "Enter password";
          }
         
      }
?>
<html lang="en">
<head>
    <link rel="icon" type="image/png" sizes="16x16" href="images/tubat-logo.jpg">
    <title>JNR Change password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="mycss/otp.css">
    <script src="js/jquery.min.js"></script>
   
</head>
<body style="background-color: #ec2f2f;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 "></div>


            <div class="col-lg-6 box1" style="background-color: white;box-shadow: 0 0 10px 4px #08080833;">
                <form action="change-password.php" method="POST">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="h5">JNR Change Password</h5>
                            <img src="images/tubat-logo.jpg" class="img">
                            <input type="password" name="new" class="form-control inp" placeholder="New password">
                            
                            <input type="password" name="confirm" class="form-control inp" placeholder="Confirm password">
                        </div>
                        <div class="col-8 ee">
                            <p id="error"><?php echo $err; ?></p>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-success float-right s" name="submit">Submit</button>
                        </div>
                    </div>
                </form> 
            </div>


            <div class="col-lg-3 "></div>
        </div>
    </div>
    

</body>
</html>