<?php
    require_once 'connect.php';
    session_start();
?>
<html lang="en">
<head>
    <link rel="icon" type="image/png" sizes="16x16" href="images/tubat-logo.jpg">
    <title>JNR Installment status</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="mycss/viewstatus.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body{
            background-color: #ec2f2f;
        }
    </style>
</head>
<body>
<?php 
$error= "";
if(isset($_POST['proceed'])){
$input = $_POST['input'];
$validate = $mysqli->query("SELECT * FROM  tbl_installmentaccount WHERE referrence_number='$input'");
    if(mysqli_num_rows($validate) >= 1){
        $error = "Login";
        $_SESSION['customer'] = $input;
        header("location: status.php");
    }
    else{
        $error = "Referrence number not found";
    }
}
?>
<div class="hero">
    <div class="form-box1">
          <form action="viewstatus.php" method="POST">
           <div class="form-box container">
            <p class="h11">Installment Account</p>
            <img src="images/tubat-logo.jpg" alt="">
            <input type="number" name="input" placeholder="referrence number" autocomplete="off">
            <div class="margin">
             <p><?php echo $error; ?></p>
            </div>
           
            <div class="butt">
              <button name="proceed">Proceed</button>
            </div>
          </form>
         
        </div>
    </div>
</div>
</body>
</html>