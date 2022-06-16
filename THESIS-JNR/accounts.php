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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="mycss/account.css" rel="stylesheet">
    <link href="mycss/buttons.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="mycss/sidescrollbar.css" rel="stylesheet">
    <style>
      .picture{
      
            background-image:url("images/tubat-logo.jpg");
            background-repeat: no-repeat;
            background-position:center;
            background-size:cover;
            background-color:rgb(175, 73, 73);
            background-blend-mode:screen;
      
      }
    </style>
  </head>
<?php require_once 'PROCESS.php'; ?>
<?php   $stmt = $mysqli->query("SELECT COUNT(stock) AS numberofstock FROM tbl_inventory WHERE stock <= minimum") or die(mysqli_error($mysqli));
        $count =  mysqli_fetch_assoc($stmt);
        $num_stock=$count['numberofstock'];

        ?>
        <?php $stuff = $mysqli->query("SELECT * FROM tbl_stuff");
        $admin =  $mysqli->query("SELECT * FROM tbl_account");
        $row_admin = $admin->fetch_array();
        $contact =  $mysqli->query("SELECT * FROM tbl_contact_number");
        $bank =  $mysqli->query("SELECT * FROM tbl_bank");
        $address =  $mysqli->query("SELECT * FROM tbl_address");
        $row_address = $address->fetch_array();
        if(empty($row_address)){
          $addressJNR = '';
        }
        else{
          $addressJNR = $row_address['address'];
        }
        ?>

  <body>
		
		<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
				<div class="p-4 pt-4" style="margin-top:100px">
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
                  <a class="nav-link" href="signout.php" id="sign_out">Sign out</a>
                  </li>
              
              
              </ul>
            </div>
          </div>
        </nav>
<!-- flex1 -->
        <div class="flex-container">
            <div class="flex1">
              <div class="flex1-body">
                  <div class="picture">
                      
                  </div>

                  <div class="flex-info">

                    
                      <div class="col-12">
                          <label>Email: </label>
                          <a href="#" id="email" class="float-right" data-toggle="modal" data-target="#mymodal1">edit</a>
                          <input type="text" class="gmail" readonly value="<?php echo $row_admin['username'];  ?>">
                      </div>

                      <div class="col-12 arrange">
                          <label class="pad">Address:</label>
                          <a href="#" class="float-right pad" id="address" data-toggle="modal" data-target="#mymodal2">edit</a>
                          <p id="address2"><?php echo $addressJNR; ?></p>
                      </div>

                      <div class="col-12 arrange">
                              <label class="pad">Contact:</label>
                              <a href="#" class="float-right pad" id="contact" data-toggle="modal" data-target="#mymodal3">edit</a>
                               <table class="tablee" id="con_table2">
                                  <?php while($row_con = $contact->fetch_assoc()): ?>      
                                    <tr>
                                      <td class="bank-td"><?php echo $row_con['name']; ?></td>
                                      <td class="bank-td"><?php echo $row_con['number']; ?></td>
                                    
                                    </tr>
                                  <?php endwhile; ?>  
                                  </table>         
                        </div>

                        <div class="col-12 arrange">
                              <label class="pad">Bank accounts:</label>
                              <a href="#" class="float-right pad" id="bank" data-toggle="modal" data-target="#mymodal4">edit</a>
                                  <table class="tablee" id="bank_table1">
                                  <?php while($row_bank = $bank->fetch_assoc()): ?>      
                                    <tr>
                                      <td class="bank-td"><?php echo $row_bank['bank_name']; ?></td>
                                      <td class="bank-td"><?php echo $row_bank['account_num']; ?></td>
                                    
                                    </tr>
                                  <?php endwhile; ?>
                                   
                                  </table>
                          </div>

                  </div>
              </div>  
            </div>  
<!-- end -->


              <div class="modal fade" id="modal_deletes">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <input type="hidden" id="trans_id">
                                   <p>Are you sure you want to delete the account of <span id="dell_acc"></span> ?</p>
                                   <button class="btn btn-info float-right" id="yes_to_delete">Yes</button>
                                   <button class="btn btn-default" data-dismiss="modal">No</button>
                                </div>
                            </div>
                        </div>
              </div>
              
<!-- flex2 -->
            <div class="flex2">
              <div class="flex2-body">
                  <div class="table-overflow">
                    <table class="table" id="tablee">
                      <thead>
                        <th class="th text-uppercase">Name</th>
                        <th class="th text-uppercase">ID number</th>
                        <th class="ths"></th>
                        <th class="ths"></th>
    
                        
                      </thead>
                      <tbody>
                        
                    
                      <?php $staff = $mysqli->query("SELECT * FROM tbl_stuff"); 
                      while($row_Staff = $staff->fetch_assoc()):
                      ?>
                      <tr>
                          <td class="td"><?php echo $row_Staff['name']; ?></td>
                          <td class="td"><?php echo $row_Staff['id_code']; ?></td>
                          <td class="td tds"><a style="text-design:none;float:right;margin-right:10px" 
                          class="aktyon" data-target="#modal-info" id="show-info" data-toggle="modal" href="#"> <img src="images/action.png" class="pikyur"></a></td>
                          <td class="td tds"><a style="text-design:none;float:right;margin-right:10px" 
                          class="delit"  data-toggle="modal" id="delete_staff" data-target="#modal_deletes" href="#"><img src="images/delete.png" class="pikyur"></a></td>
                      </tr>
                      <?php endwhile; ?>
                      </tbody>
                    </table>  
                  </div>
              


                  <header>Register account:</header>
                  <div class="header">
                      <div class="flexx">
                          <label class="lbl">Employee name:</label> 
                         
                          <input type="text" id="staffname" required class="textbox" placeholder="full name" >
                        
                         
                         <label class="lbl">Contact number:</label> 
                         
                          <input type="number" id="staffcontactnumber" class="textbox">
                                             
                         
                          <label class="lbl">Address:</label>
                         
                          <input type="text" id="staffaddress" placeholder="address" required class=" textbox">
                                            
                          
                          <label class="lbl">Date:</label>
                          <input type="date" id="staffdate" required class="textbox">
                                           
                         <button id="rand">ID number:</button>
                          
                          <input type="text" id="id_code" readonly  required class="textbox1 text-uppercase" placeholder="staff login method" >
                         
                        
                            <p id="error"></p>
                           
                         
                          
                            <button class="submit" id="submit">Submit</button>
                        
                         
                          
                      </div>

              </div>

            </div>
<!-- end -->
        



              <div class="modal fade" id="mymodal1">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5>Account</h5>
                                    <span style="font-size:25px;cursor:pointer;margin-right:10px" data-dismiss="modal">x</span>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                      <div class="col-5">Email:</div>
                                      <div class="col-7" style="margin-bottom:10px"><input id="emaill" type="email" class="form-control" style="margin-bottom:10px" placeholder="Enter new gmail">
                                      <input id="otp_verify" style="display:none" type="number" class="form-control" placeholder="OTP NUMBER"></div>
                                      <div class="col-6"><p id="error_email" style="color:#dd0000"></p></div>
                                      <div class="col-6"><button id="email_update" style="margin-bottom:10px" class="btn btn-info float-right">Update</button>
                                      <button id="email_update1" style="margin-bottom:10px;display:none" class="btn btn-success float-right">Proceed</button></div>
                                      
                                      
                                      <div class="col-5">Current-password:</div>
                                      <div class="col-7" style="margin-bottom:10px"><input type="password" id="curr" class="form-control"></div>
                                      <div class="col-5">New Password:</div>
                                      <div class="col-7 " style="margin-bottom:10px"><input type="password" id="new" class="form-control"></div>
                                      <div class="col-5">Confirm new Password:</div>
                                      <div class="col-7" style="margin-bottom:10px"><input type="password" id="confirm" class="form-control"></div>
                                      <div class="col-5"></div>
                                      <div class="col-7"><input type="number" style="display:none;margin-bottom:10px" class="form-control" placeholder="OTP NUMBER" id="otp_password"></div>
                                      <div class="col-6"><p id="err101" style="color:#dd0000"></p></div>
                                      <div class="col-6"><button id="update_pssword" class="btn btn-info float-right">Update</button>
                                      <button id="update_pssword1" style="display:none"  class="btn btn-success float-right">Proceed</button></div>
                                      
                                    </div>
                                </div>


                            </div>
                        </div>

            </div>
            
            <div class="modal fade" id="mymodal2">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5>Address</h5>
                                    <span style="font-size:25px;cursor:pointer;margin-right:10px" data-dismiss="modal">x</span>
                                </div>

                                <div class="modal-body">
                                    <input type="text" id="address1" class="form-control">
                                    <br>
                                    <button class="btn btn-success float-right" data-dismiss="modal" id="update_address">Update</button>

                                </div>


                            </div>
                        </div>

            </div>
            <div class="modal fade" id="mymodal3">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5>Contact number/s</h5>
                                    <span style="font-size:25px;cursor:pointer;margin-right:10px" data-dismiss="modal">x</span>
                                </div>

                                <div class="modal-body">
                                <label>Number name:</label>
                                <input type="text" id="name" class="form-control">
                                <br>
                                <label>Number:</label>
                                <input type="text" id="number" class="form-control">
                                <br>
                                <button style="margin-bottom:10px" id="add_contact"  data-dismiss="modal" class="btn btn-primary float-right">Add</button>
                                <br>
                                  <table class="table table-striped" id="con_table1">

                                  <?php
                                  $contacttt = $mysqli->query("SELECT * FROM tbl_contact_number");
                                   while($contactt = $contacttt->fetch_assoc()): ?>
                                    <tr>
                                      <td><?php echo $contactt['name']; ?></td>
                                      <td><?php echo $contactt['number']; ?></td>
                                      <td>
                                      <a style="text-design:none;float:right;margin-right:10px" 
                                      class="delit" id="con_delit"  data-dismiss="modal" href="#">-</a>      
                                      </td>
                                    </tr>
                                   <?php endwhile; ?>

                                  </table>
                                </div>


                            </div>
                        </div>

            </div>
            <div class="modal fade" id="mymodal4">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5>Bank Account/s</h5>
                                    <span style="font-size:25px;cursor:pointer;margin-right:10px" data-dismiss="modal">x</span>
                                </div>

                                <div class="modal-body">
                                <label>Bank name:</label>
                                <input type="text" id="name_bank" class="form-control">
                                <br>
                                <label>Account number:</label>
                                <input type="text" id="number_bank" class="form-control">
                                <br>
                                <button style="margin-bottom:10px" id="add_bank"  data-dismiss="modal" class="btn btn-primary float-right">Add</button>
                                <br>
                                  <table class="table table-striped" id="bank_table">
                                    
                                  <?php
                                  $contacttt = $mysqli->query("SELECT * FROM tbl_bank");
                                   while($contactt = $contacttt->fetch_assoc()): ?>
                                    <tr>
                                      <td><?php echo $contactt['bank_name']; ?></td>
                                      <td><?php echo $contactt['account_num']; ?></td>
                                      <td>
                                      <a style="text-design:none;float:right;margin-right:10px" 
                                      class="delit"  data-dismiss="modal" id="bank_delit" href="#">-</a>      
                                      </td>
                                    </tr>
                                   <?php endwhile; ?>

                                  </table>
                                 
                                </div>
                            </div>
                        </div>
            </div>

            <div class="modal fade" id="modal-info">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4>Staff Information</h4>
                                    <span style="font-size:25px;cursor:pointer;margin-right:10px" data-dismiss="modal">x</span>
                                </div>
                                <div class="modal-body">
                                   <h5 class="nem" id="nems"></h5>
                                  <div class="row">
                                      <div class="col-4">
                                            <label>ID Number:</label>
                                      </div>
                                      <div class="col-8">
                                            <p class="value" id="id">065498897</p>
                                      </div>
                                      <div class="col-4">
                                            <label>Address:</label>
                                      </div>
                                      <div class="col-8">
                                            <p class="value" id="addressss"></p>
                                      </div>
                                      <div class="col-4">
                                            <label>Contact Number:</label>
                                      </div>
                                      <div class="col-8">
                                          <p class="value" id="contacttt"></p>
                                      </div>
                                      <div class="col-4">
                                            <label>Date:</label>
                                      </div>
                                      <div class="col-8">
                                        <p class="value" id="date"></p>
                                      </div>
                                  </div>

                                </div>

                          


                            </div>
                        </div>
            </div>

 <script>
      $(document).ready(function(){
        $('#tablee, tbody').on('click', '#show-info', function(){
                var currow =$(this).closest('tr');
                var name =currow.find('td:eq(0)').text();
                var id_number =currow.find('td:eq(1)').text();
          
                document.getElementById('nems').innerHTML = name;
                document.getElementById('id').innerHTML = id_number;
                $.ajax({
                  url:'POSaction.php',
                  method:'POST',
                  data:{
                    id_number_address:id_number
                  },
                  success:function(data){
                    $('#addressss').html(data);
                  }
                });
                $.ajax({
                  url:'POSaction.php',
                  method:'POST',
                  data:{
                    id_number_contact:id_number
                  },
                  success:function(data){
                    $('#contacttt').html(data);
                  }
                });
                $.ajax({
                  url:'POSaction.php',
                  method:'POST',
                  data:{
                    id_number_date:id_number
                  },
                  success:function(data){
                    $('#date').html(data);
                  }
                });
              
        });
      });
        
        $(document).ready(function(){
          $('#email_update').click(function(){
          var email = document.getElementById('emaill').value;
          var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
          if(email != ''){
            if(email.match(emailPattern)){
              document.getElementById('email_update').disabled = true;
              alert("Sending OTP Number");
               $.ajax({
                      url:"insAction.php",
                      method:"POST",
                      data:{
                        verify_email_send_otp:email
                      },
                      success:function(data){
                        document.getElementById('otp_verify').style.display = 'inline';
                        document.getElementById('email_update').style.display = 'none';
                        document.getElementById('email_update1').style.display = 'inline';
                      }
                });
               
            }
            else{
              alert("INVALID EMAIL ADDRESS");
            }

          }
          else{
            alert("Enter an email");
          }
          
        });
        $(document).ready(function(){
          $('#email_update1').click(function(){
            var email = document.getElementById('emaill').value;
            var otp = document.getElementById('otp_verify').value;
            if(otp != '' && otp != 0){
              $.ajax({
                url:"insAction.php",
                  method:"POST",
                  data:{
                    email_update_otp:otp,email_update:email
                  },
                  success:function(data){
                    $('#error_email').html(data);
                    var a = document.getElementById('error_email').innerHTML;
                    if(a == ''){
                      alert("Email address successfully updated");
                      window.location = 'accounts.php';
                    }
                  }
              }); 
            }
            else{
              alert("INVALID OTP NUMBER");
            }
          });
        });
        $(document).ready(function(){
          $('#update_pssword1').click(function(){
            var curr = document.getElementById('curr').value;
            var neww = document.getElementById('new').value;
            var confirm = document.getElementById('confirm').value;
            var otp = document.getElementById('otp_password').value;
            if(curr != '' && neww != '' && confirm != '' && otp != '' && otp != 0){

              if(confirm != neww){
                alert("password does not match");
              }
              else{
                $.ajax({
                  url:'insAction.php',
                  method:'POST',
                  data:{
                    crrent:curr,newww:neww,confirrm:confirm,otp_nuumber:otp
                  },
                  success:function(data){
                    
                    $('#err101').html(data);
                    var a = document.getElementById('err101').innerHTML;
                    if(a == ''){
                      alert("Password successfully updated");
                      window.location="accounts.php";
                    }
                  }
                });
              }

            }
            else{
              alert("Complete a form");
            }

          });
        });
        $('#update_pssword').click(function(){
          var curr = document.getElementById('curr').value;
          var neww = document.getElementById('new').value;
          var confirm = document.getElementById('confirm').value;
          if(curr != '' && neww != '' && confirm != ''){
            if(neww == confirm){
              alert("Sending OTP Number");
              document.getElementById('update_pssword').disabled = true;
              $.ajax({
                  url:"insAction.php",
                  method:"POST",
                  data:{
                   curr:curr,neww:neww,confirm:confirm
                  },
                  success:function(data){
                    $('#err').html(data);
                    document.getElementById('otp_password').style.display = 'inline';
                    document.getElementById('update_pssword').style.display = 'none';
                    document.getElementById('update_pssword1').style.display = 'inline';
                  }
                });
                 
            }
            else{
              alert('password does not match');
            }
           
          }
          else{
            alert("Complete a form");
          }
          
        });
        });
            $(document).ready(function(){
              $('#rand').click(function(){
                var random = "random";
                $.ajax({
                  url:"insAction.php",
                  method:"POST",
                  data:{
                    random_id:random
                  },
                  success:function(data){
                    $('#id_code').val(data);
                  }
                });
              });
            });

 
            $(document).ready(function(){
              $('#submit').click(function(){
                var a = document.getElementById('staffname').value;
                var b = document.getElementById('staffcontactnumber').value;
                var c = document.getElementById('staffaddress').value;
                var d = document.getElementById('staffdate').value;
                var e = document.getElementById('id_code').value;
                if(a !='' && b !='' && c !='' && d !='' && e !=''){
                    $.ajax({
                      url:"insAction.php",
                      method:"POST",
                      data:{
                        staff_name:a,staff_number:b,staff_address:c,staff_date:d,staff_code:e
                      },
                      success:function(data){
                        $('#error').html(data);
                      
                        var val = document.getElementById('error').innerHTML;
                        switch(val){
                          case 'done':
                            document.querySelector('#error').style.display = "none";
                            alert("Account successfully registered");
                            window.location="accounts.php";
                          break;
                          default:
                          document.querySelector('#error').style.color = "#dd0000";
                          document.querySelector('#error').style.fontSize = "80%";
                          break;
                        }
                      }
                    });
                }
                else{
                  alert("Complete the information");
                }
              });
            });
            $(document).ready(function(){
                $('#staff_table, tr').on('click','#delete_staff',function(){
                    var row =$(this).closest('tr');
                    var id_no = row.find('td:eq(1)').text();
                    var nem = row.find('td:eq(0)').text();
                    
                    document.getElementById('trans_id').value = id_no;
                    document.getElementById('dell_acc').innerHTML = nem;
          
                });
              });
              $(document).ready(function(){
                $('#yes_to_delete').click(function(){
                  var a = document.getElementById('trans_id').value;
                  $.ajax({
                    url:'insAction.php',
                    method:'POST',
                    data:{
                      yes_to_delete:a
                    },
                    success:function(data){
                      window.location = 'accounts.php';
                    }
                  }); 
                });
              });
            //ADDRESS
            $(document).ready(function(){
              $('#address').click(function(){
                var address = document.getElementById("address2").innerHTML;
                document.getElementById("address1").value = address;
              });
            });
            $(document).ready(function(){
              $('#update_address').click(function(){
                var trigger = document.getElementById("address1").value;
                if(trigger != ''){
                    $.ajax({
                      url:"insAction.php",
                      method:"POST",
                      data:{
                          trigger:trigger
                      },
                      success:function(data){
                        $('#address2').html(data);
                        alert("Address successfully updated");
                      }
                  });
                }
                else{
                  alert("Input an address");
                }
              

              });
            });
            //END
            //bank account
            $(document).ready(function(){
              $('#add_bank').click(function(){
                var a = document.getElementById("name_bank").value;
                var b = document.getElementById("number_bank").value;
               if(a != '' && b!=''){
                $.ajax({
                    url:"insAction.php",
                    method:"POST",
                    data:{
                        bank_name:a,bank_number:b
                    },
                    success:function(data){
                      alert("Bank account successfully updated");
                      window.location="accounts.php";
                    }
                  });
               }
               else{
                 alert("Complete the information");
               }
              });
            });
            $(document).ready(function(){
                $('#bank_table, tr').on('click','#bank_delit',function(){
                    var row =$(this).closest('tr');
                    var bank_num = row.find('td:eq(1)').text();
                    var bank_name = row.find('td:eq(0)').text();
                    $.ajax({
                      url:"insAction.php",
                      method:"POST",
                      data:{
                          bank_num_del:bank_num,bank_name_del:bank_name
                      },
                      success:function(data){
                        alert("bank account successfully deleted");
                        window.location="accounts.php";
                        
                      }
                    });  
                });
              });

              
           
            //contact number
              $(document).ready(function(){
                $('#con_table1, tr').on('click','#con_delit',function(){
                    var row =$(this).closest('tr');
                    var del_num = row.find('td:eq(1)').text();

                      $.ajax({
                      url:"insAction.php",
                      method:"POST",
                      data:{
                          del_num:del_num
                      },
                      success:function(data){
                        alert("contact number successfully deleted");
                        window.location="accounts.php";
                        
                      }
                    });
                   
                });
              });



            $(document).ready(function(){
              $('#add_contact').click(function(){
                var a = document.getElementById("name").value;
                var b = document.getElementById("number").value;
                if(a != '' && b != ''){
                  $.ajax({
                    url:"insAction.php",
                    method:"POST",
                    data:{
                        cont_name:a,cont_number:b
                    },
                    success:function(data){
                      alert("contact number successfully added");
                        window.location="accounts.php";
                    }
                });
                }
                else{
                  alert("Complete the information");
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
 </script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>