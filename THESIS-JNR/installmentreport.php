<?php
    session_start();
    if(!isset($_SESSION['admin_username'])){
        header("location: login.php");
    }
?>
<!doctype html>
<html lang="en">
  <head>
  <link rel="icon" type="image/png" sizes="16x16" href="images/tubat-logo.jpg">
    <title>JNR Motorcycle parts and Accessories</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="mycss/sidescrollbar.css" rel="stylesheet">
    <link href="mycss/installments-report.css" rel="stylesheet" media="screen">
    <link href="mycss/installments-report-print.css" rel="stylesheet" media="print">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
  </head>
  <?php require_once 'PROCESS.php'; ?>
<?php require_once 'connect.php'; ?>
<?php   $stmt = $mysqli->query("SELECT COUNT(stock) AS numberofstock FROM tbl_inventory WHERE stock <= minimum") or die(mysqli_error($mysqli));
        $count =  mysqli_fetch_assoc($stmt);
        $num_stock=$count['numberofstock'];

        $stmt1 = $mysqli->query("SELECT COUNT(stock) AS numberofstock1 FROM tbl_inventory WHERE stock <= minimum AND category ='freebies'") or die(mysqli_error($mysqli));
        $count1 =  mysqli_fetch_assoc($stmt1);
        $num_stock1=$count1['numberofstock1'];

        $stmt2 = $mysqli->query("SELECT COUNT(stock) AS numberofstock2 FROM tbl_inventory WHERE stock <= minimum AND category !='freebies'") or die(mysqli_error($mysqli));
        $count2 =  mysqli_fetch_assoc($stmt2);
        $num_stock2=$count2['numberofstock2'];

        ?>
        <?php $account = $mysqli->query("SELECT * FROM tbl_account");
        $rowaccount = $account->fetch_assoc() ?>
  <body>

		<div class="wrapper d-flex align-items-stretch">
		<nav id="sidebar">
				<div class="p-4 pt-4">
		  		<a href="#" class="img logo rounded-circle mb-5" style="background-image: url(images/tubat-logo.jpg);"></a>
	        <ul class="list-unstyled components mb-5">
	          <li>
	            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">POINT OF SALES</a>
	            <ul class="collapse list-unstyled" id="homeSubmenu">
              <li>
                    <a href="POS.php">CHECKOUT</a>
                </li>
                <li>
                    <a href="POStransaction.php">TRANSACTIONS</a>
                </li>
                <li>
                    <a href="salesreport.php">SALES REPORT</a>
                </li>
	            </ul>
	          </li>
            <li  class="active">
            <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">INSTALLMENT <span class="badge" style="background:red;color:white;width:20px;border-radius:10px;margin-left:10px" id="noti_number"></span></i></a>
            <ul class="collapse list-unstyled" id="pageSubmenu3">
                  <li>
                      <a href="intallment.php">MANAGE INSTALLMENT <span class="badge" style="background:red;color:white;width:20px;border-radius:10px;margin-left:10px" id="noti_number1"></span></a>
                  </li>
                  <li>
                      <a href="installmentreport.php">INSTALLMENT REPORT</a>
                  </li>
                </ul>
              <li>
              <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">SUPPLIER</a>
              <ul class="collapse list-unstyled" id="pageSubmenu1">
                <li>
                    <a href="supplier.php">Information</a>
                </li>
                <li>
                    <a href="suppliertran.php">Transaction</a>
                </li>
              </ul>
              </li>
              <li>
                <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">INVENTORY <span class="badge" style="background:red;color:white;width:20px;border-radius:10px;margin-left:10px"><?php echo $num_stock; ?></span>
                    </a>
                <ul class="collapse list-unstyled" id="pageSubmenu2">
                  <li>
                      <a href="mainitem.php">MANAGE INVENTORY</a>
                  </li>
                  <li>
                      <a href="inventoryreport.php">INVENTORY REPORT</a>
                  </li>
                  <li>
                       <a href="lowstock.php">
                      <?php if ($num_stock ==0): ?>
                                        <span class="hide-menu" >LOW STOCK</span>
                                    <?php else: ?>
                                        <span class="hide-menu" >LOW STOCK</span><span class="badge" style="background:red;color:white;width:20px;border-radius:10px;margin-left:10px"><?php echo $num_stock; ?></span>
                                    <?php endif; ?>
                  </a>
                  </li>
                </ul>
                </li>

              <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">EXPENSE</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                  <li>
                      <a href="expense.php">Expense</a>
                  </li>
                  <li>
                      <a href="expenserecord.php">Expense Record</a>
                  </li>
                </ul>
                </li>
              <li>
              </li>
	        </ul>



	      </div>
    	</nav>

        <!-- Page Content  -->
    <div id="content" class="p-3 p-md-3">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" style="background-color:red" class="btn">
                <i class="fa fa-bars"></i>
                <span class="sr-only">Toggle Menu</span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="accounts.php">Account</a>
                    </li>
                    <li class="nav-item active">
                    <a class="nav-link" href="#" id="sign_out">Sign out</a>
                    </li>

                </ul>
                </div>
            </div>
        </nav>

    <style>
        @media print{
            body * {
                visibility:hidden;
            }
            .div_to_print, .div_to_print *{
                visibility:visible;
            }
        }
    </style>

        <div class="row">
        <div class="col-md-12">
            <h4>INSTALLMENT REPORT</h4>
        </div>
                                        <div class="col-md-5">
                                           <label class="neym">Start date:</label>
                                            <div class="col-lg-12">

                                                <input type="date" class="datebox"  name="date" required  id="from_date" name="from_date">

                                            </div>

                                        </div>

                                        <div class="col-md-5">
                                          <label class="neym">End date:</label>
                                            <div class="col-lg-12">

                                                 <input type="date" class="datebox" name="date" required  id="to_date" name="to_date">

                                            </div>

                                        </div>
                                       <div class="col-md-2">

                                            <button name="filter" id="filter" class="filter">F I L T E R</button>


                                       </div>

                                       <div class="col-lg-12">
                                            <button class="btn btn-success float-right" id="print" disabled="true" onclick="window.print();">Print</button>
                                       </div>
            <div class="col-lg-12">
                    <div class="div_to_print">
                        <div class="table-resposive tbody1">
                            <table class="teybol">
                                <tr>
                                    <th>ITEM</th>
                                    <th>Purchaser</th>
                                    <th>Status</th>
                                    <th>Penalty Fee</th>
                                    <th>Total contract price</th>
                                    <th>Total price</th>
                                    <th>Balance</th>
                                    <th>Date of contract</th>
                                </tr>
                                <tbody>
                                <?php $ins_report_result = $mysqli->query("SELECT * FROM tbl_installmentaccount ORDER BY date DESC");
                                while($ins_report_row = $ins_report_result->fetch_assoc()): ?>
                                    <tr>
                                        <td style="text-transform:capitalize"><?php echo $ins_report_row['item_name'];  ?></td>
                                        <td style="text-transform:capitalize"><?php echo $ins_report_row['customer_name'];  ?></td>
                                        <td style="text-transform:capitalize"><?php echo $ins_report_row['statuss'];  ?></td>
                                        <td>₱<?php echo number_format($ins_report_row['penalty_fee'], 2);  ?></td>
                                        <td>₱<?php echo number_format($ins_report_row['total_amount'], 2);  ?></td>
                                        <td>₱<?php echo number_format($ins_report_row['total'], 2);  ?></td>
                                        <td>₱<?php echo number_format($ins_report_row['balance'], 2);  ?></td>
                                        <td><?php echo $ins_report_row['date'];  echo ' to ';
                                            if($ins_report_row['penalty_date'] == ''){
                                                echo $ins_report_row['due_date'];
                                            }
                                            else{
                                                echo $ins_report_row['penalty_date'];
                                            }
                                        ?></td>

                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>

        </div>



    </div>
    <script>
        $(document).ready(function(){
            $("#filter").click(function(){
                var to = document.getElementById("to_date").value;
                var from = document.getElementById("from_date").value;
                const print = document.querySelector("#print");
                if(to != '' && from != ''){

                    $.ajax({
                        url:'insAction.php',
                        method:'POST',
                        data:{
                            installment_report_to:to,installment_report_from:from
                        },
                        success:function(data){
                            $(".div_to_print").html(data);
                            print.disabled = false;
                        }
                    });

                }
                else{
                    alert("Set a date");
                }
            });
        });



       function loadDoc() {
           setInterval(function(){
           var xhttp = new XMLHttpRequest();
           xhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200) {
               document.getElementById("noti_number").innerHTML = this.responseText;
               }
           };
           xhttp.open("GET", "notification.php", true);
           xhttp.send();
           },400);
       }
       loadDoc();

       function loadDoc1() {
           setInterval(function(){
           var xhttp = new XMLHttpRequest();
           xhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200) {
               document.getElementById("noti_number1").innerHTML = this.responseText;
               }
           };
           xhttp.open("GET", "notification.php", true);
           xhttp.send();
           },400);
       }
       loadDoc1();

       $(document).ready(function(){
           $('#sign_out').click(function(){
           window.location = "signout.php";
           });
       });

</script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>