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
    <link href="mycss/images.css" rel="stylesheet">
    <link href="mycss/sidescrollbar.css" rel="stylesheet">


    <link href="mycss/pos_trans1.css" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
    <style>
      .imgg{
        height:20px;
        width:20px;
      }
    </style>
  </head>
<?php require_once 'PROCESS.php'; ?>
<?php require_once 'connect.php'; ?>
<?php    $stmt = $mysqli->query("SELECT COUNT(stock) AS numberofstock FROM tbl_inventory WHERE stock <= minimum") or die(mysqli_error($mysqli));
        $count =  mysqli_fetch_assoc($stmt);
        $num_stock=$count['numberofstock']; ?>
        <?php $account = $mysqli->query("SELECT * FROM tbl_account");
        $rowaccount = $account->fetch_assoc();
        $result = $mysqli->query("SELECT * FROM tbl_postransaction ORDER BY date DESC");
      ?>

  <body>
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


        <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row head">
                    <div class="col-lg-6 align-self-center">
                      <h5>TRANSACTIONS</h5>
                    </div>
                    <div class="col-lg-6">
                      <select name="" class="trans_type" id="trans_type" onchange="typee()">
                          <option id="all">Type of transaction</option>
                          <option id="all">All</option>
                          <option id="checkout_type">Checkout</option>
                          <option id="installment_type">Installment</option>
                      </select>
                    </div>

            </div>
            </div>

                                    <div class="row" style="margin-bottom:35px;margin-top:15px;margin-left:5px">

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
                                    </div>
                                    <label>Transaction Number:</label>
                                    <div class="row ewan">
                                          <div class="col-lg-3">
                                                <input type="number" id="tran_no" class="tran_no">
                                          </div>
                                          <div class="col-lg-2">
                                                <button class="tran_btn" id="tran_no_btn">Search</button>
                                          </div>
                                    </div>
            <div class="searchdate">
                <div class="row dito">


                    <div class="col-md-6 ">
                        <p class="rev rf">Total Amount : ₱   <span class="noaction" id="rev">No action</span></p>
                    </div>
                    <div class="col-md-6 nos">
                        <p class="rev">Number of Sales : <span class="noaction" id="nos">No action</span> <img class="imggg" src="images/revenue.png" alt=""></p>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                               <div class="table-responsive tbody1">
                                    <table class="teybol" id="teybol">
                                        <thead>
                                            <th>Transaction No.</th>
                                            <th>Total amount</th>
                                            <th>Amount tendered</th>
                                            <th>Change</th>
                                            <th>Date</th>
                                            <th>Type of Transaction</th>
                                            <th></th>
                                            <th></th>

                                        </thead>
                                         <tbody>
                                        <?php while($row = $result->fetch_assoc()): ?>

                                                        <tr>
                                                            <td class="text-uppercase"><?php echo $row['id_postran']; ?></td>
                                                            <td class="text-uppercase">₱<?php echo number_format($row['totala'], 2); ?></td>
                                                            <td class="text-uppercase">₱<?php echo number_format($row['amount'], 2); ?></td>
                                                            <td class="text-uppercase">₱<?php echo number_format($row['changee'], 2); ?></td>
                                                            <td class="text-uppercase"><?php echo $row['date']; ?></td>
                                                            <td class="text-uppercase"><?php echo $row['type']; ?></td>
                                                            <td class="text-uppercase" style="display:none"><?php echo $row['id_postran']; ?></td>
                                                            <td><a class="remove1"><img src="images/delete.png" class="imgg" alt=""></a></td>
                                                            <?php if($row['type'] == 'INSTALLMENT'): ?>
                                                              <td class="text-uppercase">
                                                                <a style="text-design:none;float:right;margin-right:0px" class="open_ins" id="open_ins"  data-toggle="modal" data-target="#mymodal2">
                                                                <img src="images/action.png" class="imgg"></a>
                                                             </td>
                                                            <?php else: ?>
                                                               <td class="text-uppercase">
                                                                <a style="text-design:none;float:right;margin-right:0px" class="open" id="open"  data-toggle="modal" data-target="#mymodal1">
                                                                <img src="images/action.png" class="imgg"></a>
                                                             </td>
                                                            <?php endif; ?>


                                                        </tr>


                                        <?php endwhile; ?>
                                         </tbody>
                                    </table>
                               </div>
                        </div>
                    </div>
            </div>






            </div>
            </div>
            <div class="modal fade" id="mymodal2">
                        <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modalbody1">

                              </div>


                            </div>
                        </div>
            </div>
            <div class="modal fade" id="mymodal1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modalbody">

                              </div>


                            </div>
                        </div>
            </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $('#teybol, tbody').on('click','.remove1', function(){
            var currow =$(this).closest('tr');
            var id = currow.find('td:eq(0)').text();
            $(this).closest('tr').remove();
            $.ajax({
              url:'POSaction.php',
              method:'POST',
              data:{
                transactionPOS_id:id
              },
              success:function(data){
              }
            });
      });
    });

  function typee(){
    var a = document.getElementById('trans_type').value;

    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();

    if(a == 'Type of transaction'){

    }
    else{
      $.ajax({
        url:'POSaction.php',
        method:'POST',
        data:{
          pos_tran_type:a,
          type_from:from_date,
          type_to:to_date
        },
        success:function(data){
          $('.tbody1').html(data);
        }
      });
      $.ajax({
        url:'POSaction.php',
        method:'POST',
        data:{
          pos_tran_type_rev:a
        },
        success:function(data){
          $('#rev').html(data);
          var a = document.getElementById('rev').innerHTML;
            if(a == 'No Transaction found'){
              document.querySelector('#rev').style.color = "#dd0000";
            }
            else{
              document.querySelector('#rev').style.color = "rgb(25, 185, 25)";
            }
        }
      });
      $.ajax({
        url:'POSaction.php',
        method:'POST',
        data:{
          pos_tran_type_nos:a
        },
        success:function(data){
            $('#nos').html(data);
            var a = document.getElementById('nos').innerHTML;
            if(a == 'No Transaction found'){
              document.querySelector('#nos').style.color = "#dd0000";
            }
            else{
              document.querySelector('#nos').style.color = "rgb(25, 185, 25)";
            }
        }
      });
    }
  }





  $(document).ready(function(){
    $('#tran_no_btn').click(function(){
      document.getElementById('trans_type').value = 'Type of transaction';
      var tran_no = document.getElementById('tran_no').value;
      if(tran_no != ''){
        $.ajax({
          url: 'POSaction.php',
          method: 'POST',
          data:{
            tran_no,tran_no
          },
          success:function(data){
            $('.tbody1').html(data);
          }
        });
        $.ajax({
          url:'POSaction.php',
          method:'POST',
          data:{
            tran_no_rev:tran_no
          },
          success:function(data){
            $('#rev').html(data);
            var a = document.getElementById('rev').innerHTML;
            if(a == 'No Transaction found'){
              document.querySelector('#rev').style.color = "#dd0000";
            }
            else{
              document.querySelector('#rev').style.color = "rgb(25, 185, 25)";
            }

          }
        });
        $.ajax({
          url:'POSaction.php',
          method:'POST',
          data:{
            tran_no_nos:tran_no
          },
          success:function(data){
            $('#nos').html(data);
            var a = document.getElementById('nos').innerHTML;
            if(a == 'No Transaction found'){
              document.querySelector('#nos').style.color = "#dd0000";
            }
            else{
              document.querySelector('#nos').style.color = "rgb(25, 185, 25)";
            }

          }
        });
      }
      else{
        alert('No Transaction number entered');
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
        $('.teybol, tbody').on('click','.open',function(){
          var currow =$(this).closest('tr');
          var id =currow.find('td:eq(6)').text();
              $.ajax({
              url:"POSaction.php",
              method:"POST",
              data:{id:id},
              success:function(data){
                $('.modalbody').html(data);
              }
              });
        });
        });
        $(document).ready(function(){
        $('.teybol, tbody').on('click','.open_ins',function(){

          var currow1 =$(this).closest('tr');
          var id1 =currow1.find('td:eq(6)').text();
          $.ajax({
              url:"POSaction.php",
              method:"POST",
              data:{ref_installment:id1},
              success:function(data){
                $('.modalbody1').html(data);
              }
              });

        });
        });

    $(document).ready(function(){
          $('#filter').click(function(){
          var type = $('#trans_type').val();
          var from_date = $('#from_date').val();
          var to_date = $('#to_date').val();
          var trans_type = $('#trans_type').val();
          document.getElementById('tran_no').value = '';
          if (from_date != '' && to_date != '')
          {
            if(type == 'Type of transaction'){
              alert("SET A TYPE OF TRANSACTION");
            }
            else{

              $.ajax({
                      url:"POSaction.php",
                      method:"POST",
                      data:{
                        from_date:from_date, to_date:to_date,trans_type:trans_type
                      },
                      success:function(data){
                        $('.tbody1').html(data);

                      }
                    });
                    $.ajax({
                      url:"POSaction.php",
                      method:"POST",
                      data:{
                        from_daterev:from_date, to_daterev:to_date,trans_typerev:trans_type
                      },
                      success:function(data){
                        $('#rev').html(data);
                        var rev = document.getElementById('rev').innerHTML;
                        if(rev != 0){
                          document.querySelector('#rev').style.color = "rgb(25, 185, 25)";
                        }
                      }
                    });
                    $.ajax({
                      url:"POSaction.php",
                      method:"POST",
                      data:{
                        from_datenos:from_date, to_datenos:to_date,trans_typenos:trans_type
                      },
                      success:function(data){
                        $('#nos').html(data);
                        var nos = document.getElementById('nos').innerHTML;
                        if(nos != 0){
                          document.querySelector('#nos').style.color = "rgb(25, 185, 25)";
                        }

                      }
                    });
            }

          }
          else{
            alert("SET A DATE!")
          }
        });
    });

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