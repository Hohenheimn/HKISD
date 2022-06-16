<?php 
    session_start();
    $cdate =  date("Y-m-d");
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
    <link href="mycss/sidescrollbar.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="mycss/dashboard1.css">
    <script src="js/jquery.min.js"></script>
		
		<link rel="stylesheet" href="css/style.css">
  </head>
  <?php require_once 'PROCESS.php'; ?>
<?php require_once 'connect.php'; ?>
<?php   
    
        $helmet_get = $mysqli->query("SELECT * FROM tbl_inventory WHERE category = 'helmet'");
        $compute_HELMET = 0;
        while($count_helmet = $helmet_get->fetch_assoc()){
            $compute_HELMET = $compute_HELMET + $count_helmet['stock'];
        }
        $helmet_stock = $compute_HELMET;

        
        $stmt = $mysqli->query("SELECT COUNT(stock) AS numberofstock FROM tbl_inventory WHERE stock <= minimum") or die(mysqli_error($mysqli));
        $count =  mysqli_fetch_assoc($stmt);
        $num_stock=$count['numberofstock'];

        $number_sale = $mysqli->query("SELECT SUM(qty) AS num FROM tbl_positem WHERE date = '$cdate'") or die($mysqli->error);
        $num_sum =  mysqli_fetch_assoc($number_sale);
        $numberofsale = $num_sum['num'];

        $rev = $mysqli->query("SELECT SUM(totala) AS revenue FROM tbl_postransaction WHERE date = '$cdate'") or die($mysqli->error);
        $reven =  mysqli_fetch_assoc($rev);
        $revenue = $reven['revenue'];

        $c = $mysqli->query("SELECT SUM(amount) AS cost FROM tbl_expense WHERE date = '$cdate'") or die($mysqli->error);
        $cos =  mysqli_fetch_assoc($c);
        $costs = $cos['cost'];
        if($costs ==''){
            $cost = 0;
        }
        else{
            $cost = $costs;
        }
        $profit = $revenue - $cost;


        $calculateResult = $mysqli->query("SELECT * FROM tbl_inventory");
        $completeCompute = 0;
        while($cal_row = $calculateResult->fetch_assoc()){
          $cal_price = $cal_row['price'];
          $cal_stock = $cal_row['stock'];
          $multiply = $cal_stock * $cal_price;
          $completeCompute = $completeCompute + $multiply;
        }
        $inv_stock= $completeCompute;

        $free = $mysqli->query("SELECT SUM(price) AS free FROM tbl_inventory WHERE category = 'freebies'") or die(mysqli_error($mysqli));
        $free_count =  mysqli_fetch_assoc($free);
        $free_stock=$free_count['free'];

        $week = date('w');
     
        $monday = date('Y-m-d', strtotime("+".(1-$week)." days"));
        $tuesday = date('Y-m-d', strtotime("+".(2-$week)." days"));
        $wednesday = date('Y-m-d', strtotime("+".(3-$week)." days"));
        $thursday = date('Y-m-d', strtotime("+".(4-$week)." days"));
        $friday =date('Y-m-d', strtotime("+".(5-$week)." days"));
        $saturday =date('Y-m-d', strtotime("+".(6-$week)." days"));
        $sunday =date('Y-m-d', strtotime("+".(7-$week)." days"));

        $mon = $mysqli->query("SELECT SUM(totala) AS mon FROM tbl_postransaction WHERE date = '$monday'") or die($mysqli->error);
        $mond =  mysqli_fetch_assoc($mon);
        $total_mon = $mond['mon'];
        $tue = $mysqli->query("SELECT SUM(totala) AS tue FROM tbl_postransaction WHERE date = '$tuesday'") or die($mysqli->error);
        $tues =  mysqli_fetch_assoc($tue);
        $total_tues = $tues['tue'];
       
        $wed = $mysqli->query("SELECT SUM(totala) AS wed FROM tbl_postransaction WHERE date = '$wednesday'") or die($mysqli->error);
        $wedn =  mysqli_fetch_assoc($wed);
        $total_wedn = $wedn['wed'];

        $thu = $mysqli->query("SELECT SUM(totala) AS thu FROM tbl_postransaction WHERE date = '$thursday'") or die($mysqli->error);
        $thur =  mysqli_fetch_assoc($thu);
        $total_thur = $thur['thu'];

        $fri = $mysqli->query("SELECT SUM(totala) AS fri FROM tbl_postransaction WHERE date = '$friday'") or die($mysqli->error);
        $frid =  mysqli_fetch_assoc($fri);
        $total_frid = $frid['fri'];

        $sun = $mysqli->query("SELECT SUM(totala) AS sun FROM tbl_postransaction WHERE date = '$sunday'") or die($mysqli->error);
        $sund =  mysqli_fetch_assoc($sun);
        $total_sun = $sund['sun'];

        $sat = $mysqli->query("SELECT SUM(totala) AS sat FROM tbl_postransaction WHERE date = '$saturday'") or die($mysqli->error);
        $satu =  mysqli_fetch_assoc($sat);
        $total_satu = $satu['sat'];


        $trenvenue = $mysqli->query("SELECT SUM(totala) AS trenvenue FROM tbl_postransaction WHERE date BETWEEN '$monday' AND '$sunday'") or die(mysqli_error($mysqli));
        $trenvenue_count =  mysqli_fetch_assoc($trenvenue);
        $trenvenue_sum=$trenvenue_count['trenvenue'];

        $no_sale = $mysqli->query("SELECT SUM(qty) AS no_sale FROM tbl_positem WHERE amount != 0 AND date BETWEEN '$monday' AND '$sunday'") or die(mysqli_error($mysqli));
        $no_sale_count =  mysqli_fetch_assoc($no_sale);

        $no_sale_sum=$no_sale_count['no_sale'];

        $expense = $mysqli->query("SELECT SUM(amount) AS expense FROM tbl_expense WHERE date BETWEEN '$monday' AND '$sunday'") or die(mysqli_error($mysqli));
        $expense_count =  mysqli_fetch_assoc($expense);
        $expense_sum=$expense_count['expense'];
        $week_profit = $trenvenue_sum - $expense_sum;
       
        ?>
        <?php $stuff = $mysqli->query("SELECT * FROM tbl_stuff");
        ?>
  <body>
		<input type="hidden" id="monday" value="<?php echo $total_mon; ?>">
    <input type="hidden" id="tuesday" value="<?php echo $total_tues; ?>">
    <input type="hidden" id="wednesday" value="<?php echo $total_wedn; ?>">
    <input type="hidden" id="thursday" value="<?php echo $total_thur; ?>">
    <input type="hidden" id="friday" value="<?php echo $total_frid; ?>">
    <input type="hidden" id="saturday" value="<?php echo $total_satu; ?>">
    <input type="hidden" id="sunday" value="<?php echo $total_sun; ?>">

		<div class="wrapper d-flex align-items-stretch">
		<nav id="sidebar">
				<div class="p-4 pt-4">
		  		<a href="#" class="img logo rounded-circle mb-5" style="background-image: url(images/tubat-logo.jpg);"></a>
	        <ul class="list-unstyled components mb-5">
	          <li class="active">
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
            <li>
            <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">INSTALLMENT </a>
            <ul class="collapse list-unstyled" id="pageSubmenu3">
                  <li>
                      <a href="intallment.php">MANAGE INSTALLMENT</a>
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
                <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">INVENTORY
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
                        LOW STOCK
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
                      <a class="nav-link" href="accounts.php">Account</a>
                  </li>
                  <li class="nav-item active">
                  <a class="nav-link" href="#" id="sign_out">Sign out</a>
                  </li>
              
              </ul>
            </div>
          </div>
        </nav>
        <div class="page-wrapper">
        <div class="page-breadcrumb">                               
            <div class="row">
                

                <div class="col-lg-4">
                    <div class="minicard">
                        <header>New Installment accounts</header>
                        <img src="images/installment_wait1.png" class="imgg float-right" alt="">
                        <div class="result1" id="noti_number1">
                      
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="minicard1">
                         <header>Low Stock</header>
                         <img src="images/lowstock.png" class="imgg float-right" style="border-radius:50%" alt="">
                         <div class="result12"><?php echo $num_stock; ?></div>
                    </div>
                </div>

                <div class="col-lg-4">
                  <div class="minicard">
                    <header>Inventory Total Amount Remaining</header>
                    <img src="images/inventoryAmount.png" class="imgg float-right" style="border-radius:50%" alt="">
                    <div class="result3">₱ <?php echo number_format($inv_stock, 2); ?></div>
                 
                  </div>
                </div>
                <div class="col-lg-7">
                  <div class="dashboard">
                  <div class="chartt">
                     <canvas id="mychart"></canvas>
                  </div>
               
                  
                  
                  </div>
                </div>

                <div class="col-lg-4">

                  <div class="dashboard1">
                    <div class="row">
                    <header class="col-5 hm">Stats Report</header>
                    <div class="col-6 hm2"> <img src="images/cash.png" class="img float-right" alt=""></div>
                   
                    <p class="col-12 hm3">This week: <?php echo $monday; ?> | <?php echo $sunday; ?></p>
                    </div>
                  
                    <div class="uno" id="uno">No. of Sales
                      <p class="result"><?php 
                       if($no_sale_sum == ''){
                        $no_sale_sum = 0;
                      }
                      echo $no_sale_sum; ?></p>
                    </div>

                    <div class="uno" id="dos">Revenue
                    <p class="result">₱ <?php
                    if($trenvenue_sum == ''){
                      $trenvenue_sum = 0;
                    }
                    echo number_format($trenvenue_sum, 2); ?></p>
                    </div>

                    <div class="dos" id="tres">Cost
                    <p class="result">₱ <?php
                    if($expense_sum == ''){
                      $expense_sum = 0;
                    }
                     echo number_format($expense_sum,2); ?></p>
                    </div>

                    <div class="dos" id="kwatro">Profit
                    <p class="result">₱ <?php 
                    if($week_profit < 0){
                      $week_profit = 0;
                    }
                    echo number_format($week_profit, 2); ?></p>
                    </div>
                   
                  </div>
                </div>
            </div>
          
        </div>
       
        
</div>

    <script>
        let mon = document.getElementById('monday').value;
        let tue = document.getElementById('tuesday').value;
        let wed = document.getElementById('wednesday').value;
        let thu = document.getElementById('thursday').value;
        let fri = document.getElementById('friday').value;
        let sat = document.getElementById('saturday').value;
        let sun = document.getElementById('sunday').value;
        let mychart = document.getElementById("mychart").getContext("2d");
        let masschart = new Chart(mychart,{
          type:'bar',
          data:{
            labels:[
            'Monday', 'Tuesday', 'Wednesday','Thursday','Friday','Saturday','Sunday'
              ],
            datasets:[{
              label:'Total Sales Per Day',
              data:[
                mon,tue,wed,thu,fri,sat,sun
              ],
              backgroundColor:[
                'rgb(240, 135, 135)',
                'rgb(240, 135, 135)',
                'rgb(240, 135, 135)',
                'rgb(240, 135, 135)',
                'rgb(240, 135, 135)',
                'rgb(240, 135, 135)',
                'rgb(240, 135, 135)'
              ]  
            }]
          },
          options:{}
         
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
  </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>