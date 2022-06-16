<?php
        require_once 'connect.php';
        $err_otp = '';
        session_start();

        if(isset($_POST['resend_otp'])){

            $otp = rand(111111,999999);

            $mysqli->query("UPDATE tbl_account SET OTP = $otp");
            $result_send = $mysqli->query("SELECT * FROM tbl_account");
            $row_send = $result_send->fetch_array();

            $gmail = $row_send['username']; // Reciever
            $subj = 'JNR OTP Number';
            $message = "OTP : ".$otp."";
            $headers = "From: jnrmoto.binan@gmail.com";

            $mail_sent = mail($gmail, $subj, $message, $headers);

            if ($mail_sent == true){
              echo "<script>alert('OTP Number sent'); </script>";
            }
            else {
              echo "<script>alert('Error, There is something wrong'); </script>";
            }

        }



        if(isset($_POST['submit_otp'])){
            $otp = $_POST['otp'];
            $length = strlen($otp);
            if($otp == 0){
                $err_otp = "Wrong OTP number re-send OTP number";
                $mysqli->query("UPDATE tbl_account SET OTP = 0");
            }
            else{
                 $result = $mysqli->query("SELECT * FROM tbl_account WHERE OTP = $otp");
                if(mysqli_num_rows($result) == 1){

                    $mysqli->query("UPDATE tbl_account SET OTP = 0");
                    $_SESSION['chpassword'] = "chPassword";
                    header('location: change-password.php');

                }
                else{
                    $err_otp = "Wrong OTP number re-send OTP number";
                    $mysqli->query("UPDATE tbl_account SET OTP = 0");

                }
            }

        }
?>
<html lang="en">
<head>
    <link rel="icon" type="image/png" sizes="16x16" href="images/tubat-logo.jpg">
    <title>JNR Send OTP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="mycss/otp.css">


</head>
<body style="background-color: #ec2f2f;">
    <button onclick="back()" style="
        background:#28a745;
        border:none;
        width:100px;
        height:50px;
        border-radius:5px;
        color:#ffffff;
        outline:none;
        cursor:pointer;
        margin-left:10px;
        margin-top:10px;
    ">Back</button>
    <div class="container">
        <div class="row">

            <div class="col-lg-3 "></div>
            <div class="col-lg-6 box" >
                <form action="JNR-send-otp.php" method="POST">
                    <div class="row">


                            <div class="col-12">
                                <h5 class="h5">Enter OTP Number</h5>
                                <input type="number" name="otp" class="form-control inp" id="otp" placeholder="-  -  -  -  -  -">
                            </div>
                            <div class="col-12 ee">
                                <p id="error"><?php echo $err_otp; ?></p>
                            </div>
                            <div class="col-8 luh">
                                <button class="btn btn-info float-left b" name="resend_otp" id="resend">Send</button>
                            </div>

                            <div class="col-4">

                                <button class="btn btn-success float-right b" name="submit_otp" id="submit">Submit</button>
                            </div>



                    </div>
                </form>



            </div>
            <div class="col-lg-3 "></div>
        </div>
    </div>
</body>
<script>
    function back () {
        window.location = "index.php"
    }
</script>
</html>