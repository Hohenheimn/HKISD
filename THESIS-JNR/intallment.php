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

    <link href="mycss/installment.css" rel="stylesheet">

    <link rel="stylesheet" href="fixing-some-style.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
      .hiden{
            display: none;
        }
    </style>
  </head>

  <?php
        require_once 'insAction.php';
        require_once 'connect.php';
        $result = $mysqli->query("SELECT * FROM tbl_inventory");
        $stmt = $mysqli->query("SELECT COUNT(stock) AS numberofstock FROM tbl_inventory WHERE stock <= minimum") or die(mysqli_error($mysqli));
        $count =  mysqli_fetch_assoc($stmt);
        $num_stock=$count['numberofstock'];
        $account = $mysqli->query("SELECT * FROM tbl_account");
        $rowaccount = $account->fetch_assoc();
        $result1 = $mysqli->query("SELECT * FROM tbl_category");
  ?>

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
            <button class="add" data-toggle="modal" data-target="#mymodal1">Add Form</button>
            <button class="add1" data-toggle="modal" data-target="#mymodal2">Add Location</button>
          </div>
          <div class="modal fade" id="mymodal2">
                        <div class="modal-dialog">
                            <div class="modal-content">

                              <div class="modal-header">
                                <h5 class="text-uppercase">Area</h5>
                                <h5 data-dismiss="modal">
                                  <button  data-dismiss="modal" style="border:none;background-color:transparent;margin-right:15px">x</button>
                                </h5>
                              </div>

                          <div class="container">
                               <div class="row">

                                <div class="col-2">
                                      <label>Location:</label>
                                  </div>
                                  <div class="col-10 arrange">
                                      <input type="text" class="form_text" id="a_area">
                                  </div>
                                  <div class="col-2">
                                      <label>Fee:</label>
                                  </div>
                                  <div class="col-10 arrange">
                                      <input type="number" class="form_text" id="a_fee">
                                  </div>


                                  <div class="col-12 arrange">

                                    <div class="col-12">
                                      <span class="errorr" id="errorr"></span>
                                      <button class="add1 float-right" id="add_area">Add</button>
                                    </div>

                                  </div>
                                  <div class="table-responsive bod">
                                      <table  class="table-striped tebo">
                                      <tr>
                                        <th>Location</th>
                                        <th>Fees</th>
                                        <th></th>
                                        <th></th>
                                      </tr>
                                      <tbody>
                                      <?php
                                      $result12 = $mysqli->query("SELECT * FROM tbl_area");
                                      while($row12 = $result12->fetch_assoc()): ?>
                                                            <tr>
                                                                <td data-label="Item" class="text-uppercase"><?php echo $row12['area']; ?></td>
                                                                <td data-label="Brand" class="text-uppercase">₱ <?php echo number_format($row12['fee'], 2); ?></td>
                                                                <td data-label="Brand" class="text-uppercase"><p class="hiden"><?php echo $row12['id']; ?></p></td>

                                                                <td data-label="Action" class="text-uppercase">

                                                                  <a style="text-design:none;float:right;margin-right:10px" class="btn_delete">
                                                                  <img src="images/delete.png" class="imgg"></a>
                                                                </td>
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
          <div class="modal fade" id="mymodal1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="text-uppercase">Form</h5>
                                <h5 data-dismiss="modal">
                                  <button  data-dismiss="modal" id="closes"  style="border:none;background-color:transparent;margin-right:15px">x</button>
                                </h5>
                              </div>


                                <div class="modal-body">
                                  <div class="container">
                                  <div class="row ">
                                        <div class="search_container">
                                            <input placeholder="Model Name" autocomplete="off" type="text" name="name" id="searchBox" class="searcchinput"><a name="searchbar"><img src="images/search_logo.png" class="imgg float-right" alt="search"></a>
                                        </div>
                                        <div id="response"></div>

                                        <div class="col-lg-12 arrange">
                                            <input type="text" id="customer" autocomplete="off" placeholder="name" class="form_text2">
                                            <button class="btn btn-info" id="ref_no">Check Mark</button>
                                        </div>




                                        <div class="col-md-12 arrange">
                                            <label class="asd">Reference Number: </label>
                                            <input type="text" id="ref" readonly class="ref_numberText">
                                        </div>

                                        <div class="col-2">
                                            <label>Price:</label>
                                        </div>
                                        <div class="col-10 arrange">
                                            <input type="text" readonly id="price" value="0" class="form_text">
                                        </div>
                                        <div class="col-2">
                                            <label>Area:</label>
                                        </div>
                                        <div class="col-10 arrange">
                                        <input placeholder="area" autocomplete="off" type="text" name="name" id="area_loc" class="form_text">
                                        </div>
                                        <div class="col-4">

                                        </div>
                                        <div class="col-8">
                                          <div id="response2"></div>
                                        </div>

                                        <div class="col-2">
                                            <label>Fee:</label>
                                        </div>
                                        <div class="col-10 arrange">
                                            <input type="text" readonly value="0" class="form_text"  id="fee">
                                        </div>
                                        <div class="col-2">
                                            <label>Total:</label>
                                        </div>
                                        <div class="col-10 arrange">
                                            <input type="text" readonly class="form_text"  id="total">
                                        </div>
                                        <table class="table arrange form-table">
                                            <tr>
                                              <th style="text-align:center">Amount</th>

                                              <th style="text-align:center">Date</th>
                                            </tr>

                                            <tr>
                                              <td><input type="number" class="paymentNumber" id="downpaymentamount" placeholder="Down"> </td>
                                              <td><input type="date" class="form_text" id="datedown"></td>
                                            </tr>

                                            <tr>
                                              <td><input type="number" class="paymentNumber" id="firstpaymentamount" placeholder="First"> </td>
                                              <td> <input type="date" class="form_text" id="datefirst"></td>
                                            </tr>

                                            <tr>
                                              <td><input type="number" class="paymentNumber" id="secondpaymentamount" placeholder="Second (Due Date)"> </td>
                                              <td><input type="date" class="form_text" id="datesecond"></td>
                                            </tr>
                                        </table>






                                        <div class="col-12"  style="margin-top:15px">
                                          <p id="reminder"></p>
                                          <button class="btn btn-info float-right" id="addd">Add</button>
                                        </div>
                                    </div>
                                  </div>


                                </div>


                            </div>
                        </div>

            </div>

          <div class="col-lg-3">
            <div class="dropdown">
              <button class="button">Forms   <img src="images/arrow_down.png" class="imgg" alt=""></button>
              <div class="div">
                <a class="a" href="down.php">Down payment</a>
                <a class="a" href="balance.php">Balance</a>
                <a class="a" href="penalty.php">Penalty</a>
                <a class="a" href="paid.php">Paid</a>
              </div>
          </div>


          </div>

        </div>
        </div>


      <div class="filter-table">

			<div class="search-filter-container">
				<input placeholder="Search" type="text" name="search" id="search" class="search-filter">
				<img src="images/search_logo.png" class="imgg float-right" alt="search">
			</div>

			<div class="search-filter-container">
				<select name="" id="filter-type" class="select-status" onchange ='filter_status()'>
					<option value="Default">Search By Status</option>
					<option value="all">All</option>
					<option value="unfilled">Unfilled</option>
					<option value="filled up">Filled Up</option>
				</select>
			</div>

      </div>




             <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                                            <div class="table-responsive thayt" id ='table_load'>

                                                <table class="teybol" id="teybol">

                                                            <thead>
                                                                <th>Applicant name</th>
                                                                <th>Reference number</th>
                                                                <th>Date Created</th>
                                                                <th>STATUS</th>
                                                                <th class="text-right">action</th>
                                                            </thead>

                                                        <tbody>
                                                        <?php
                                                        $result13 = $mysqli->query("SELECT * FROM tbl_form  ORDER BY date_it_made DESC");
                                                        while($row = $result13->fetch_assoc()): ?>
                                                        <tr class="tr">
                                                            <td><?php echo $row['cus_name']; ?></td>
                                                            <td ><?php echo $row['ref']; ?></td>
                                                            <td ><?php echo $row['date_it_made']; ?></td>
                                                            <td><?php echo $row['statuss']; ?></td>

                                                            <td class="text-uppercase">
                                                            <?php if($row['statuss'] == 'filled up'):
                                                            ?>
                                                                <a style="text-design:none;float:right;margin-right:0px" target="form-filledup.php?print=<?php echo $row['ref']; ?>" href="form-filledup.php?form=<?php echo $row['ref']; ?>">
                                                                <img src="images/fillup.png" class="imggg"></a>
                                                            <?php else:
                                                            ?> <a style="text-design:none;float:right;margin-right:0px" target="form.php?formss=<?php echo $row['ref']; ?>" href="form.php?formss=<?php echo $row['ref']; ?>">
                                                                <img src="images/fillup.png" class="imggg"></a>

                                                            <?php endif; ?>

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

  <script>

	  function filter_status () {
		var form_status_filter = document.getElementById('filter-type').value;
		if(form_status_filter == 'Default'){

		}
		else{
			$.ajax({
				url: 'insAction.php',
				method: 'POST',
				data: {
					form_status_filter: form_status_filter
				},
				success: function (data) {
					$('#table_load').html(data);
				}
			})
		}
	  }

     //delete form
    $(document).ready(function(){
        $('#yes').click(function(){
          var col1 =  document.getElementById('modal_delete').innerHTML;
               $.ajax({
                                  url: 'insAction.php',
                                  method: 'POST',
                                  data: {
                                      form_id:col1
                                  },
                                  success: function (data) {
                                      alert('Successfully deleted');
                                      window.location = "intallment.php";
                                  }
              });
        });
      });

    $(document).ready(function(){
             $('.teybol, tbody').on('click','.btn_delete2',function(){
            var currow =$(this).closest('tr');
            var col1 =currow.find('td:eq(1)').text();
            document.getElementById('modal_delete').innerHTML = col1;



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
      $('#closes').click(function(){

        document.getElementById('searchBox').value = '';
        document.getElementById('ref').value = '';
        document.getElementById('price').value = '';
        document.getElementById('area_loc').value = '';
        document.getElementById('fee').value = '';
        document.getElementById('total').value = '';
        document.getElementById('customer').value = '';
        document.getElementById('date').value = '';
      });
    });

    $(document).ready(function(){
      $('#ref_no').click(function(){
        var ref_no = "random";

        $.ajax({
          url: 'insAction.php',
          method: 'POST',
          data: {
            ref_no:ref_no
          },
          success: function (data) {
            $('#ref').val(data);
          }
        });

      });
    });
    $(document).ready(function(){

      $('#addd').click(function(){
        var downpaymentamount = document.getElementById('downpaymentamount').value;
        var firstpaymentamount = document.getElementById('firstpaymentamount').value;
        var secondpaymentamount = document.getElementById('secondpaymentamount').value;

        var validate_total = parseFloat(downpaymentamount) + parseFloat(firstpaymentamount)  + parseFloat(secondpaymentamount) ;

        var datedown = document.getElementById('datedown').value;

        var itemname1 = document.getElementById('searchBox').value;
        var ref = document.getElementById('ref').value;
        var price = document.getElementById('price').value;
        var area_loc = document.getElementById('area_loc').value;
        var fee = document.getElementById('fee').value;
        var total1 = document.getElementById('total').value;
        var cus = document.getElementById('customer').value;
        var date1 = document.getElementById('datefirst').value;
        var date2 = document.getElementById('datesecond').value;
        var count = $("#freebies_table tr").length;

        var item_freebies = [];
        var freebies_price = [];
        var freebies_qty = [];
          $('.item_freebies').each(function(){
            item_freebies.push($(this).text());
          });

          $('.freebies_price').each(function(){
            freebies_price.push($(this).text());
          });
          $('.freebies_qty').each(function(){
            freebies_qty.push($(this).text());
          });

        if(count <= 0){

            if(itemname1 != '' && ref != '' && price != '' && downpaymentamount != '' && firstpaymentamount != '' && secondpaymentamount != '' && datedown != ''
            && area_loc != '' && fee != '' && total1 != '' && cus != '' && date1 != '' && date2 != '')
            {
              if(validate_total != total1){
                alert('The total of entered amount is not equal on total amount');
              }
              else{

                                    $.ajax({
                                      url: 'insAction.php',
                                      method: 'POST',
                                      data: {
                                          item:itemname1,ref:ref,price:price,area:area_loc,
                                          fee:fee,total:total1,customer:cus,
                                          datefirst:date1,datesecond:date2,downpaymentamount:downpaymentamount,firstpaymentamount:firstpaymentamount,
                                          secondpaymentamount:secondpaymentamount,datedown:datedown,item_freebies:1
                                      },
                                      success: function (data) {
                                        $('#reminder').html(data);
                                        var reminder = document.getElementById('reminder').innerHTML;
                                        if(reminder != ''){
                                          document.getElementById('reminder').style.color='#dd0000';
                                          document.getElementById('reminder').style.fontWeight='700';
                                        }
                                        else{
                                          alert('Form successfully created');
                                          window.location='intallment.php';
                                        }

                                      }
                                    });
              }


            }
            else{
                alert('Complete the form');
            }

        }
        else{

          var tablee = document.getElementById('freebies_table');
          var validate = '';
          var validate_quantity_freebies = '';

              for(var i = 0; i < tablee.rows.length; i++){
                if(tablee.rows[i].cells[3].innerHTML == ''){
                  validate = 'cant proceed';
                }
              }

              if(validate == ''){
                    for(var a = 0; a < tablee.rows.length; a++){
                      if(tablee.rows[a].cells[0].innerHTML == ''){
                        validate_quantity_freebies = 'cant proceed';
                      }
                    }
                    if(validate_quantity_freebies != ''){
                      alert("Enter Quantity of freebies");
                    }
                    else{
                      if(itemname1 != '' && ref != '' && price != '' && downpaymentamount != '' && firstpaymentamount != '' && secondpaymentamount != '' && datedown != ''
                        && area_loc != '' && fee != '' && total1 != '' && cus != '' && date1 != '' && date2 != '')
                        {

                            $.ajax({
                                                  url: 'insAction.php',
                                                  method: 'POST',
                                                  data: {
                                                      item:itemname1,ref:ref,price:price,area:area_loc,
                                                      fee:fee,total:total1,customer:cus,
                                                      datefirst:date1,datesecond:date2,downpaymentamount:downpaymentamount,firstpaymentamount:firstpaymentamount,
                                                      secondpaymentamount:secondpaymentamount,datedown:datedown,item_freebies:item_freebies,freebies_price:freebies_price,freebies_qty:freebies_qty
                                                  },
                                                  success: function (data) {
                                                    $('#reminder').html(data);
                                                    var reminder = document.getElementById('reminder').innerHTML;
                                                    if(reminder != ''){
                                                      document.getElementById('reminder').style.color='#dd0000';
                                                      document.getElementById('reminder').style.fontWeight='600';
                                                    }
                                                    else{
                                                      alert('Form successfully created');
                                                      window.location='intallment.php';
                                                    }

                                                  }
                            });

                        }
                        else{
                            alert('Complete the form');
                        }
                    }


              }
              else{
                alert('Enter a price of Freebies');
              }

        }




      });
    });
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
    //calculate total

    //delete area
     $(document).ready(function(){
             $('.teybol, tbody').on('click','.btn_delete',function(){
            var currow =$(this).closest('tr');
            var col1 =currow.find('td:eq(2)').text();
            $.ajax({
                                url: 'POSaction.php',
                                method: 'POST',
                                data: {
                                    delete_area:col1
                                },
                                success: function (data) {
                                  $('.bod').html(data);
                                }
            });
            });
            });
            //end
            //verification
     $(document).ready(function(){
      $('#add_area').click(function(){
        var c = document.getElementById('a_area').value;
        var d = document.getElementById('a_fee').value;
           if(c != '' && d != ''){
              $.ajax({
                                  url: 'POSaction.php',
                                  method: 'POST',
                                  data: {
                                      area1:c,fee1:d
                                  },
                                  success: function (data) {

                                    $('.errorr').html(data);
                                  }

              });

           }

      });
       //add area
         $('#add_area').click(function(){
           var a = document.getElementById('a_area').value;
           var b = document.getElementById('a_fee').value;
           if(a != '' && b != ''){
            $.ajax({
                                url: 'POSaction.php',
                                method: 'POST',
                                data: {
                                    area:a,fee:b
                                },
                                success: function (data) {

                                  $('.bod').html(data);
                                  var error =  document.getElementById('errorr').value;
                                    if(error != ''){
                                      document.querySelector('#errorr').style.color = "#dd0000";
                                    }
                                    document.getElementById('a_area').value = '';
                                    document.getElementById('a_fee').value = '';
                                }

            });

           }
           else{
           alert("Fill up all information");
           }
        });
     });
     //end
        // autocomplete for freebies

        $(document).ready(function () {
                $("#freebies").keyup(function () {
                    var query = $("#freebies").val();

                    if (query.length > 0) {
                        $.ajax(
                            {
                                url: 'connect.php',
                                method: 'POST',
                                data: {
                                    search2_free: 1,
                                    q1_free: query
                                },
                                success: function (data) {
                                    $("#response3").html(data);
                                },
                                dataType: 'text'
                            }
                        );
                    }
                    else{

                      document.querySelector('#hiddeee').style.display = "none";
                    }

                    });

                $(document).on('click', '#li_free', function () {
                    var country = $(this).text();
                    $("#freebies").val(country);
                    $("#response3").html("");
                    var count = 1;

                    var html_code = "<tr id='row"+count+"'>";
                    html_code += "<td contenteditable='true' class='freebies_qty' style='border:1px solid #c0c0c0;height:5px;text-align:center'></td>";
                    html_code += "<td class='item_freebies'>"+country+"</td>";
                    html_code += "<td>₱</td>";
                    html_code += "<td contenteditable='true' class='freebies_price' style='border:1px solid #c0c0c0;height:5px;text-align:center'></td>";
                    html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger float-right btn-xs remove'>-</button></td>";
                    html_code +="</tr>";
                    $('#freebies_table').append(html_code);
                    document.getElementById('freebies').value ='';
                });
        });
        $(document).ready(function(){
            $('#freebies_table, tbody').on('click','.remove',function(){
              var currow =$(this).closest('tr');
              var price = currow.find('td:eq(3)').text();

              var total = document.getElementById("total").value;

              total = parseFloat(total) - parseFloat(price);
              document.getElementById("total").value = total;
              $(this).closest('tr').remove();

            });
          });


       //autocomplete for item
      $(document).ready(function () {
                $("#searchBox").keyup(function () {
                    var query = $("#searchBox").val();

                    if (query.length > 0) {
                        $.ajax(
                            {
                                url: 'connect.php',
                                method: 'POST',
                                data: {
                                    search: 1,
                                    q: query
                                },
                                success: function (data) {
                                    $("#response").html(data);
                                },
                                dataType: 'text'
                            }
                        );
                    }
                    else{

                      document.querySelector('#hidde').style.display = "none";
                    }

                    });

                $(document).on('click', '#li', function () {
                    var country = $(this).text();
                    $("#searchBox").val(country);
                    $("#response").html("");
                    $.ajax({
                                url: 'POSaction.php',
                                method: 'POST',
                                data: {
                                    aname: country
                                },
                                success: function (data) {

                                  $('#price').val(data);
                                  var count = $("#freebies_table tr").length;
                                  if(count > 0){
                                      var table = document.getElementById("freebies_table"), sumVal = 0;

                                      for(var i = 0; i < table.rows.length; i++)
                                      {
                                          sumVal = sumVal + parseFloat(table.rows[i].cells[3].innerHTML);
                                      }

                                        var x = document.getElementById('fee').value;
                                        var y = document.getElementById('price').value;
                                        var total;
                                        total = parseFloat(x) +parseFloat(y) + parseFloat(sumVal);
                                        document.getElementById('total').value = total;
                                  }
                                  else{
                                        var x = document.getElementById('fee').value;
                                        var y = document.getElementById('price').value;
                                        var total;
                                        total = parseFloat(x) +parseFloat(y);
                                        document.getElementById('total').value = total;
                                  }

                                }
                    });

                });
        });
        //end
        //autocomplete for area
        $(document).ready(function () {
                $("#area_loc").keyup(function () {
                    var a_l = $("#area_loc").val();

                    if (a_l.length > 0) {
                        $.ajax(
                            {
                                url: 'connect.php',
                                method: 'POST',
                                data: {
                                    search1: 1,
                                    z: a_l
                                },
                                success: function (data) {
                                    $("#response2").html(data);
                                },
                                dataType: 'text'
                            }
                        );
                    }
                    else{
                      document.querySelector('#hiddee').style.display = "none";
                    }
                    });
                    $(document).on('click', '#lii', function () {
                        var country = $(this).text();
                        $("#area_loc").val(country);
                        $("#response2").html("");
                        $.ajax({
                                    url: 'POSaction.php',
                                    method: 'POST',
                                    data: {
                                        feee: country
                                    },
                                    success: function (data) {

                                      $('#fee').val(data);

                                      var count = $("#freebies_table tr").length;
                                      if(count > 0){
                                          var table = document.getElementById("freebies_table"), sumVal = 0;

                                          for(var i = 0; i < table.rows.length; i++)
                                          {
                                              sumVal = sumVal + parseFloat(table.rows[i].cells[3].innerHTML);
                                          }

                                            var x = document.getElementById('fee').value;
                                            var y = document.getElementById('price').value;
                                            var total;
                                            total = parseFloat(x) +parseFloat(y) + parseFloat(sumVal);
                                            document.getElementById('total').value = total;
                                      }
                                      else{
                                            var x = document.getElementById('fee').value;
                                            var y = document.getElementById('price').value;
                                            var total;
                                            total = parseFloat(x) +parseFloat(y);
                                            document.getElementById('total').value = total;
                                      }
                                    }
                        });

                    });
        });
        $(document).ready(function(){
            $("#price, #freebies_table, #fee").keyup(function(){
                var table = document.getElementById("freebies_table"), sumVal = 0;

                for(var i = 0; i < table.rows.length; i++)
                {
                    sumVal = sumVal + parseFloat(table.rows[i].cells[3].innerHTML);
                }

                var w2 = Number($("#fee").val());
                var x2 = Number($("#price").val());
                var y2 = sumVal;
                var total2 = x2 + parseFloat(y2) + w2;
                $("#total").val(total2);
            });
          });
  </script>

    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>