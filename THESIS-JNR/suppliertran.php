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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="mycss/style.css" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="mycss/table1.css">
    <link href="mycss/sidescrollbar.css" rel="stylesheet">
    <link rel="stylesheet" href="mycss/supplieraaction.css">

  </head>
  <?php require_once 'connect.php'; ?>
<?php    $stmt = $mysqli->query("SELECT COUNT(stock) AS numberofstock FROM tbl_inventory WHERE stock <= minimum") or die(mysqli_error($mysqli));
        $count =  mysqli_fetch_assoc($stmt);
        $num_stock=$count['numberofstock'];

       ?>
<?php $account = $mysqli->query("SELECT * FROM tbl_account");
        $rowaccount = $account->fetch_assoc();
        $result1 = $mysqli->query("SELECT * FROM tbl_suppliertran ORDER BY date DESC"); ?>

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
            <li>
            <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">INSTALLMENT <span class="badge" style="background:red;color:white;width:20px;border-radius:10px;margin-left:10px" id="noti_number"></span></i></a>
            <ul class="collapse list-unstyled" id="pageSubmenu3">
                  <li>
                      <a href="intallment.php">MANAGE INSTALLMENT <span class="badge" style="background:red;color:white;width:20px;border-radius:10px;margin-left:10px" id="noti_number1"></span></a>
                  </li>
                  <li>
                      <a href="installmentreport.php">INSTALLMENT REPORT</a>
                  </li>
                </ul>
              <li  class="active">
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
                  <a class="nav-link" href="signout.php">Sign out</a>
                  </li>

              </ul>
            </div>
          </div>
        </nav>
        <div class="page-wrapper">
            <div class="page-breadcrumb">

            <div class="row head">
                    <div class="col-7 align-self-center">
                   <h5>Supplier Transactions</h5>
                    </div>

                    <div class="col-5 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                        <a href="supplieraction.php" class="addsupplier">Add Supplier
                    </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom:5px;margin-top:15px;margin-left:5px">

                                        <div class="col-lg-5">
                                          <label class="neym">Start date:</label>
                                            <div class="col-12">

                                                <input type="date"  id="from_date" name="from_date" required class="datebox">

                                            </div>

                                        </div>

                                        <div class="col-lg-5">
                                         <label class="neym">End date:</label>
                                            <div class="col-12">

                                                 <input type="date" id="to_date" name="to_date" required class="datebox">

                                            </div>

                                        </div>
                                       <div class="col-lg-2">


                                            <button class="filter" id="filter" name="searchh">FILTER</button>

                                       </div>
                                    </div>


            <br>
            <div >
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <div class="tabletop"></div>
                                            <div class="table-responsive tbody1" id="order_table">
                                                <table class="teybol  table-striped" id="crud_table">
                                                    <thead>
                                                            <th>ID</th>
                                                            <th class="text-uppercase">Company</th>
                                                            <th class="text-uppercase">Item name</th>
                                                            <th class="text-uppercase">Quantity</th>
                                                            <th class="text-uppercase">Amount</th>
                                                            <th class="text-uppercase">Date</th>
                                                            <th></th>



                                                        </thead>

                                                        <tbody>
                                                        <?php while($row = $result1->fetch_assoc()): ?>
                                                        <tr>
                                                          <td data-label ="Item name" class="text-uppercase"><?php echo $row['id']; ?></td>
                                                            <td data-label ="Item name" class="text-uppercase"><?php echo $row['brand']; ?></td>
                                                            <td data-label ="Company"class="text-uppercase"><?php echo $row['name']; ?></td>
                                                            <td data-label ="Quantity"class="text-uppercase"><?php echo $row['quantity']; ?></td>
                                                            <td data-label ="Amount"class="text-uppercase">₱ <?php echo number_format($row['amount'], 2);?></td>
                                                            <td data-label ="Date" class="text-uppercase"><?php echo $row['date'];?></td>
                                                            <td><a class="remove1"><img src="images/delete.png" class="imgg" alt=""></a></td>


                                                        </tr>
                                                        <?php endwhile; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="tablebottom"></div>
                                            </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
  </div>
  <script>
   $(document).ready(function(){
      $('#crud_table, tbody').on('click','.remove1', function(){
            var currow =$(this).closest('tr');
            var id = currow.find('td:eq(0)').text();
            $(this).closest('tr').remove();
            $.ajax({
              url:'POSaction.php',
              method:'POST',
              data:{
                supplier_id:id
              },
              success:function(data){
              }
            });
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
     $('#filter').click(function(){
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      if (from_date != '' && to_date != '')
      {
        $.ajax({
          url:"POSaction.php",
          method:"POST",
          data:{
            from_date3:from_date, to_date3:to_date
          },
          success:function(data){
            $('#order_table').html(data);
          }
        });
      }
      else{
        alert("SET A DATE!")
      }
    });
    });

  </script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>