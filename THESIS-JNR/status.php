<?php
    require_once 'connect.php';
    session_start();
    if(!isset($_SESSION['customer'])){
        header("location: viewstatus.php");
    }
    $ref = $_SESSION['customer'];
    $result = $mysqli->query("SELECT * FROM tbl_installmentaccount WHERE referrence_number=$ref") or die($mysqli->error());
    $result1 = $mysqli->query("SELECT * FROM tbl_payment WHERE referrence_number=$ref") or die($mysqli->error());
    $row = $result->fetch_array();
    $customer = $row['customer_name'];
    $ref = $row['referrence_number'];
    $due = $row['due_date'];
    $total = $row['total'];
    $penalty_fee = $row['penalty_fee'];
    $status = $row['statuss'];
?>
<html lang="en">
<head>
    <link rel="icon" type="image/png" sizes="16x16" href="images/tubat-logo.jpg">
    <title>JNR Installment status</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="mycss/status.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body{
            background-color: #ec2f2f;
        }
    </style>
</head>
<body>
        <div class="grid">
            <div class="left"></div>
            <div class="mid">
                <div class="row innerGrid">
                    <div class="col-12">
                        <header><span>JNR</span> Motorcycle Parts and Accessories</header>
                    </div>
                    <div class="col-6">
                        <h3 class="cus"><?php echo $customer ?></h3>
                    </div>

                    <div class="col-6">
                    <label>Due date:</label>
                        <p class="p"><?php echo $due ?></p>   
                    </div>


                    <div class="col-6">
                    <label>Referrence Number:</label>
                        <p class="p"><?php echo $ref ?></p>
                    </div>

                    <div class="col-6">
                    <label>Total amount:</label>
                        <p class="p"><?php echo $total ?></p>
                    </div>

                    <div class="col-6">
                    <label>Status:</label>
                        <p class="p"><?php echo $status ?></p>
                    </div>
                    
                    
                    <div class="col-6">
                    <label>Penalty Fee:</label>
                        <p class="penalty"><?php echo $penalty_fee ?></p>
                    </div>

                </div>

                    <table class="table">
                            <tr>
                                <th>AMOUNT TENDERED</th>
                                <th>DATE</th>
                            </tr>
                            <?php while($row1 = $result1->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row1['amount']; ?></td>
                                <td><?php echo $row1['date']; ?></td>
                            
                            </tr>   
                            <?php endwhile; ?>
                    </table>

            </div>


            <div class="right"></div>

              
         
         
        </div>
</body>
</html>