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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="mycss/sidescrollbar.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="mycss/installments-manage.css" rel="stylesheet">
    <style>
      .hiden{
          display: none;
      }
      input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button{
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
  </head>
  <?php require_once 'insAction.php'; ?>
  <?php require_once 'connect.php';
 ?>
<?php
    $result = $mysqli->query("SELECT * FROM tbl_inventory");
?>
<?php   $stmt = $mysqli->query("SELECT COUNT(stock) AS numberofstock FROM tbl_inventory WHERE stock <= minimum") or die(mysqli_error($mysqli));
        $count =  mysqli_fetch_assoc($stmt);
        $num_stock=$count['numberofstock'];?>
<?php $account = $mysqli->query("SELECT * FROM tbl_account");
        $rowaccount = $account->fetch_assoc() ?>
        <?php  $result1 = $mysqli->query("SELECT * FROM tbl_category"); ?>

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
                  <a class="nav-link" href="signout.php" id="sign_out">Sign out</a>
                  </li>

              </ul>
            </div>
          </div>
        </nav>
        <h5>MANAGE INSTALLMENT</h5>
        <div class="page-wrapper">
        <div class="row">
          <div class="col-lg-9">
             <div class="searchcontainer">

                                     <input placeholder="Search" type="text" name="search" id="search" class="searchinput"><a name="searchbar"><img src="images/search_logo.png" class="imgg float-right" alt="search"></a>
                           </div>
          </div>

          <div class="col-lg-3">
          <div class="dropdown">
            <button class="button">Balance<img src="images/arrow_down.png" class="imgg" alt=""></button>
            <div class="div">
              <a class="a" href="intallment.php">Forms</a>
              <a class="a" href="down.php">Down Payment</a>
              <a class="a" href="penalty.php">Penalty</a>
              <a class="a" href="paid.php">Paid</a>
            </div>
          </div>


          </div>

        </div>
        </div>





             <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                                            <div class="table-responsive thayt">

                                                <table class="teybol" id="teybol">

                                                            <thead>

                                                                <th>Reference number</th>
                                                                <th>Applicant name</th>
                                                                <th>Balance</th>
                                                                <th>Total amount</th>
                                                                <th>Due date</th>
                                                                <th class="text-right"></th>
                                                            </thead>

                                                        <tbody>
                                                        <?php
                                                        $result13 = $mysqli->query("SELECT * FROM tbl_installmentaccount  WHERE statuss = 'balance' ORDER BY date DESC");
                                                        while($row = $result13->fetch_assoc()): ?>
                                                        <tr class="tr">

                                                            <td ><?php echo $row['referrence_number']; ?></td>
                                                            <td><?php echo $row['customer_name']; ?></td>
                                                            <td>₱ <?php echo number_format($row['balance'], 2); ?></td>
                                                            <td>₱ <?php echo number_format($row['total_amount'], 2); ?></td>
                                                            <td><?php echo $row['due_date']; ?></td>
                                                            <td class="text-uppercase">
                                                            <a style="text-design:none;float:right;margin-right:0px" href="#" class="btn_modal"  data-toggle="modal" data-target="#mymodal1">
                                                            <img src="images/actionblue2.png" class="imggg"></a>
                                                                <a style="text-design:none;float:right;margin-right:10px" data-toggle="modal" data-target="#modal-delete" class="btn_delete2">
                                                                <img src="images/deletered.png" class="imggg"></a>

                                                             </td>
                                                        </tr>
                                                        <?php endwhile; ?>
                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                </form>

                            </div>
                        </div>
                    </div>
            </div>
    </div>
  </div>
                                                      <div class="modal fade" id="modal-delete">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">


                                                                    <div class="modal-body">
                                                                      <div class="row">

                                                                        <div class="col-12">
                                                                          <p>Are you sure you want to delete this account? : <span id="modal_delete"></span></p>
                                                                        </div>

                                                                        <div class="col-12">
                                                                          <button class="btn" id="no" data-dismiss="modal">No</button>
                                                                          <button class="btn btn-info float-right" data-dismiss="modal" id="yes">Yes</button>
                                                                        </div>

                                                                      </div>



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>





                                                        <div class="modal fade" id="mymodal1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">

                                                                    <input type="hidden" value="<?php echo $_SESSION['admin_username']; ?>" id="user">
                                                                    <div class="modal-header">
                                                                        <h5 id="name2"></h5>
                                                                        <h5 id="ref2"></h5>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                    <div class="row">

                                                                      <div class="col-12">
                                                                      <h5 id="insItem" style="text-transform:uppercase"></h5>
                                                                      </div>

                                                                      <div class="col-6">
                                                                      <label>Total amount:</label>
                                                                      <h5 id="total"></h5></div>

                                                                      <div class="col-6">
                                                                         <label>Balance:</label>
                                                                      <h5 id="balance"></h5></div>

                                                                    </div>
                                                                    <br>

                                                                    <div class="table"></div>


                                                                    <label>Amount:</label>
                                                                       <input type="number" name="amount" id="amount" class="form-control">
                                                                        <br>
                                                                       <input type="date" name="date" id="date" class="form-control">


                                                                       <button class="btn btn-danger" data-dismiss="modal" style="margin-top:40px" id = "close">Close</button>

                                                                       <button class="btn btn-success float-right" id = "proceed">Proceed</button>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

  <script>
  //notification
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
     //VALIDATING
     $(document).ready(function(){
        $('#close').click(function(){
          document.getElementById('amount').value = '';
          document.getElementById('date').value = '';
        });
      });
      $(document).ready(function(){
            $('#proceed').click(function(){
                var a = document.getElementById('amount').value;
                var d = document.getElementById('date').value;
                var ref = document.getElementById('ref2').innerHTML;
                var cus_name = document.getElementById('name2').innerHTML;
                var user = document.getElementById('user').value;
                document.getElementById('proceed').disabled = true;
                if(a != '' && d != ''){
                    $.ajax({
                                    url: 'insAction.php',
                                    method: 'POST',
                                    data: {
                                        ref_action:ref,a:a,d:d,cus_name:cus_name,user:user
                                    },
                                    success: function (data) {

                                      alert("Payment successfuly stored");
                                      window.location= 'balance.php';
                                    }
                    });
                }
                else{
                  alert("Set a date and amount");
                }
            });
        });
      //DELETE
      $(document).ready(function(){
        $('#yes').click(function(){
          var col1 =  document.getElementById('modal_delete').innerHTML;
               $.ajax({
                                  url: 'insAction.php',
                                  method: 'POST',
                                  data: {
                                      bal_ref:col1
                                  },
                                  success: function (data) {
                                      alert('Successfully deleted');
                                      window.location = "balance.php";
                                  }
              });
        });
      });

      $(document).ready(function(){
             $('.teybol, tbody').on('click','.btn_delete2',function(){
            var currow =$(this).closest('tr');
            var col1 =currow.find('td:eq(0)').text();
            document.getElementById('modal_delete').innerHTML = col1;



            });
            });
      //OPEN MODAL
       $(document).ready(function(){
        $('.teybol, tbody').on('click','.btn_modal',function(){
                var currow =$(this).closest('tr');
                var name =currow.find('td:eq(1)').text();
                var ref =currow.find('td:eq(0)').text();
                var bal =currow.find('td:eq(2)').text();
                var total =currow.find('td:eq(3)').text();
                document.getElementById('name2').innerHTML = name;
                document.getElementById('ref2').innerHTML = ref;
                document.getElementById('balance').innerHTML = bal;
                document.getElementById('total').innerHTML = total;
                document.getElementById('amount').value = '';
                document.getElementById('date').value = '';
                $.ajax({
                    url:"insAction.php",
                    method:"POST",
                    data:{
                      ref_bal:ref
                      },
                    success:function(data)
                    {
                        $('.table').html(data);
                    }
                });

                $.ajax({
                  url:"insAction.php",
                  method:"POST",
                  data:{
                    insItem:ref
                  },
                  success:function(data){
                    $('#insItem').html(data);
                  }
                });
        });
       });
       //SEARCH
        $(document).ready(function(){
                $('#search').keyup(function(){
                        search_table($(this).val());
                });
                function search_table(value){
                        $('#teybol .tr').each(function(){
                            var found = 'false';
                            $(this).each(function(){
                                if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)
                                {
                                    found = 'true';
                                }
                            });
                            if(found == 'true')
                            {
                                $(this).show();
                            }
                            else
                            {
                                $(this).hide();
                            }
                        });
                }
        });

  </script>

    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>