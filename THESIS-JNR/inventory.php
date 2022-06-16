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
        <link href="mycss/inventoryaction1.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link href="mycss/sidescrollbar.css" rel="stylesheet">

        <style>
            input[type=number]::-webkit-inner-spin-button,
            input[type=number]::-webkit-outer-spin-button{
                -webkit-appearance: none;
                margin: 0;
            }
        </style>
  </head>
  <?php require_once 'PROCESS.php'; ?>
<?php require_once 'connect.php'; ?>
<?php   $stmt = $mysqli->query("SELECT COUNT(stock) AS numberofstock FROM tbl_inventory WHERE stock <= minimum") or die(mysqli_error($mysqli));
        $count =  mysqli_fetch_assoc($stmt);
        $num_stock=$count['numberofstock'];
        ?>
<?php $account = $mysqli->query("SELECT * FROM tbl_account");
        $rowaccount = $account->fetch_assoc();
        $result = $mysqli->query("SELECT * FROM tbl_supplier");
        $resultcategory = $mysqli->query("SELECT * FROM tbl_category");?>
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
              <li class="active">
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
        <div class="page-wrapper">
        <div class="page-breadcrumb">

                <div class="row">
                    <div class="col-4 align-self-center">
                    <?php if($update == true): ?>
                        <h5 class="page-title">UPDATE ITEM</h5>
                    <?php else: ?>
                       <h5 class="page-title">REGISTER ITEM</h5>
                    <?php endif; ?>
                    </div>
                    <div class="col-8 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="mainitem.php">inventory</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Add new</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="container-fluid">
                <div class="row">
                <?php if($update == true): ?>
                    <div class="col-md-12 row row1">
                        <form method="post" id="update_form" enctype="multipart/form-data">
                               <input type="hidden" name="update_id" id="id" value="<?php echo $id; ?>">

                                    <div class="row">

                                    <div class="col-lg-4 neym">Category:</div>
                                            <div class="col-lg-8 col-xs-12">
                                            <select id="category" name="update_category" class="textbox" required>

                                                <option  readonly><?php echo $category; ?></option>

                                                <?php while($categoryrow = $resultcategory->fetch_assoc()): ?>

                                                    <option><?php echo $categoryrow['name']; ?></option>

                                                <?php endwhile; ?>

                                            </select>
                                            <br>
                                            <br>
                                    </div>

                                    <div class="col-lg-4 neym">Update image:</div>
                                    <div class="col-lg-8" style="overflow:hidden">
                                                    <input type="file" id="image" name="update_image" >
                                    </div>
                                    <div class="col-lg-4 neym"></div>
                                    <div class="col-lg-8 itemPicture">
                                        <div id="itemPicture">
                                        </div>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['picture'] ); ?>" class="itempic"id="itempic" />
                                    </div>
                                    <br>
                                    <br>


                                    <div class="col-lg-4 neym">Item Name:</div>
                                            <div class="col-lg-8 col-xs-12">
                                            <input type="text" name="update_itemname" id="itemname" value="<?php echo $itemname; ?>" class="textbox text-uppercase" placeholder="full item name" >
                                            <label class="lbl">*required</label>
                                            <br>
                                            <br>
                                    </div>



                                    <div class="col-lg-4 neym">Price from supplier:</div>
                                            <div class="col-lg-8 col-xs-12">
                                            <input type="number" name="update_pfs" id="pfs" value="<?php echo $supplierprice; ?>" class="textbox">
                                            <label class="lbl">*required</label>
                                            <br>
                                            <br>
                                    </div>

                                     <div class="col-lg-4 neym">Profit price:</div>
                                            <div class="col-lg-8 col-xs-12">
                                            <input type="number" name="update_pop" id="pop" value="<?php echo $profitprice; ?>" class="textbox">
                                            <label class="lbl">*required</label>
                                            <br>
                                            <br>
                                    </div>

                                    <div class="col-lg-4 neym">Item price:</div>
                                            <div class="col-lg-8 col-xs-12">
                                            <input type="number" name="update_ip" id="ip" readonly value="<?php echo $invprice; ?>" class="textbox readonly">
                                            <label class="lbl">*required</label>
                                            <br>
                                            <br>
                                    </div>

                                    <div class="col-lg-4 neym">Brand:</div>
                                    <div class="col-lg-8 col-xs-12">
                                        <select id="brand" name="update_brand" value="<?php echo $brand; ?>" class="textbox text-uppercase" >
                                        <option><?php echo $brand; ?></option>
                                        <?php while($row = $result->fetch_assoc()): ?>
                                            <option><?php echo $row['name']; ?></option>
                                        <?php endwhile; ?>

                                        </select>
                                        <label class="lbl">Select brand</label>
                                        <br>
                                        <br>
                                    </div>





                                        <div class="col-lg-4 neym">Stock:</div>
                                            <div class="col-lg-8 col-xs-12">
                                            <input type="hidden" id="hidden_stock" readonly value="<?php echo $stock; ?>">
                                            <input type="number" name="update_stock1" readonly id="update_stock1" value="<?php echo $stock; ?>" class="textbox">
                                            <labe class="lbl"l>*required</label>
                                            <br>
                                            <br>
                                        </div>




                                    <div class="col-lg-4 neym">Unit of measure:</div>
                                            <div class="col-lg-8 col-xs-12">
                                            <input type="text" class="textbox text-uppercase" value="<?php echo $unitmeasure; ?>" name="update_unitofmeasure" id="unitofmeasure">
                                            <label class="lbl">*required</label>
                                            <br>
                                            <br>
                                    </div>

                                    <div class="col-lg-4 neym">Minimum stock Allowed:</div>
                                            <div class="col-lg-8 col-xs-12">
                                            <input type="number" name="update_minimum" id="minimum" value="<?php echo $minimum; ?>" class="textbox">
                                            <label class="lbl">*required</label>
                                            <br>
                                            <br>
                                            <br>


                                    </div>



                                    <div class="col-12"><h5>Make a transaction  </h5><span>*Can update without making a transaction</span><br><br><br><br></div>
                                        <div class="col-lg-4 neym" id="transaction">Add Stock:</div>
                                                <div class="col-lg-8 col-xs-12">
                                                <input type="number" id="stock" name="update_stock" class="textbox">
                                                <label class="lbl">*required</label>
                                                <br>
                                                <br>
                                        </div>



                                    <div class="col-lg-4 neym">Date:</div>
                                            <div class="col-lg-8 col-xs-12">
                                            <input type="date" name="date_update" id="date" class="textbox">
                                            <label class="lbl">*required</label>
                                            <br>
                                            <br>
                                    </div>

                                    <div class="col-lg-4 col-xs-4 neym">Cost Amount:</div>
                                    <div class="col-lg-8 col-xs-4">
                                        <input type="number" name="update_amountt" readonly id="amount" class="textbox readonly">
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-lg-4 col-xs-4 neym"></div>
                                    <div class="col-lg-8 col-xs-4">
                                        <p id="error" style="color:#dd0000;font-weight:bold"></p>
                                    </div>


                                    <div class="col-lg-9 col-xs-9"></div>
                                    <div class="col-lg-3 col-xs-3">

                                        <a href="mainitem.php" type="button" class="btn btn-danger">Cancel</a>
                                        <input type="submit" id="main_update" value="Update" class="btn btn-success float-right">


                                    </div>




                                    <br>
                        </form>
                <div>
            <?php else: ?>
                <div class="col-md-12 row row1">

                                    <form method="post" id="image_form" enctype="multipart/form-data" class="row">

                                    <div class="col-lg-4 neym">Category:</div>
                                            <div class="col-lg-8 col-xs-12">
                                            <select id="category" name="cat" class="textbox" required>

                                                <option  readonly><?php echo $category; ?></option>

                                                <?php while($categoryrow = $resultcategory->fetch_assoc()): ?>

                                                    <option><?php echo $categoryrow['name']; ?></option>

                                                <?php endwhile; ?>

                                            </select>
                                            <br>
                                            <br>
                                    </div>

                                    <div class="col-lg-4 neym">Insert image:</div>
                                        <div class="col-lg-8" style="overflow:hidden">
                                                    <input type="file" name="image" id="image" />
                                        </div>
                                    <div class="col-lg-4 neym"></div>
                                        <div class="col-lg-8 itemPicture">
                                            <div id="itemPicture">
                                            </div>
                                        </div>
                                    <br>
                                    <br>


                                    <div class="col-lg-4 neym">Item Name:</div>
                                            <div class="col-lg-8 col-xs-12">
                                            <input type="text" name="uitemname" id="itemname" value="<?php echo $itemname; ?>" class="textbox text-uppercase" placeholder="full item name" >
                                            <label class="lbl">*required</label>
                                            <br>
                                            <br>
                                    </div>



                                    <div class="col-lg-4 neym">Price from supplier:</div>
                                            <div class="col-lg-8 col-xs-12">
                                            <input type="number" name="pfs" id="pfs" value="<?php echo $supplierprice; ?>" class="textbox">
                                            <label class="lbl">*required</label>
                                            <br>
                                            <br>
                                    </div>

                                     <div class="col-lg-4 neym">Price of profit:</div>
                                            <div class="col-lg-8 col-xs-12">
                                            <input type="number" name="pop" id="pop" value="<?php echo $profitprice; ?>" class="textbox">
                                            <label class="lbl">*required</label>
                                            <br>
                                            <br>
                                    </div>

                                    <div class="col-lg-4 neym">Item price:</div>
                                            <div class="col-lg-8 col-xs-12">
                                            <input type="number" name="ip" id="ip" readonly value="<?php echo $invprice; ?>" class="textbox readonly">
                                            <label class="lbl">*required</label>
                                            <br>
                                            <br>
                                    </div>

                                    <div class="col-lg-4 neym">Brand:</div>
                                    <div class="col-lg-8 col-xs-12">
                                        <select id="brand" name="brand" value="<?php echo $brand; ?>" class="textbox text-uppercase" >
                                        <option><?php echo $brand; ?></option>
                                        <?php while($row = $result->fetch_assoc()): ?>
                                            <option><?php echo $row['name']; ?></option>
                                        <?php endwhile; ?>

                                        </select>
                                        <label class="lbl">Select brand</label>
                                        <br>
                                        <br>
                                    </div>




                                        <div class="col-lg-4 neym">Stock:</div>

                                                <div class="col-lg-8 col-xs-12">
                                                    <input type="number" name="stock" id="stock" value="<?php echo $stock; ?>" class="textbox">
                                                <labe class="lbl">*required</label>
                                                <br>
                                                <br>
                                        </div>




                                    <div class="col-lg-4 neym">Unit of measure:</div>
                                            <div class="col-lg-8 col-xs-12">
                                            <input type="text" class="textbox text-uppercase" value="<?php echo $unitmeasure; ?>" name="unitofmeasure" id="unitofmeasure">
                                            <label class="lbl">*required</label>
                                            <br>
                                            <br>
                                    </div>

                                    <div class="col-lg-4 neym">Minimum stock Allowed:</div>
                                            <div class="col-lg-8 col-xs-12">
                                            <input type="number" name="minimum" id="minimum" value="<?php echo $minimum; ?>" class="textbox">
                                            <label class="lbl">*required</label>
                                            <br>
                                            <br>
                                    </div>

                                    <div class="col-lg-4 neym">Date:</div>
                                            <div class="col-lg-8 col-xs-12">
                                            <input type="date" name="dateee" id="date" class="textbox">
                                            <label class="lbl">*required</label>
                                            <br>
                                            <br>
                                    </div>

                                    <div class="col-lg-4 col-xs-4 neym">Cost Amount:</div>
                                    <div class="col-lg-8 col-xs-4">
                                        <input type="number" name="amountt" readonly id="amount" class="textbox readonly">
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-lg-4 col-xs-4 neym"></div>
                                    <div class="col-lg-8 col-xs-4">
                                        <p id="error" style="color:#dd0000;font-weight:bold"></p>
                                    </div>


                                    <div class="col-lg-9 col-xs-9"></div>
                                    <div class="col-lg-3 col-xs-3">


                                        <a href="mainitem.php" type="button" class="btn btn-danger" >Cancel</a>
                                        <input type="submit" id="main_save" name="insert" value="Register" class="btn btn-info float-right">



                                    </div>

                                    </form>
                                    <br>
                            </div>
            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
	</div>
    <script>
        function filePreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#itemPicture + img').remove();
                    $('#itemPicture').after('<img class="itempic" src="'+e.target.result+'"/>');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function () {
            filePreview(this);
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
            $('#image_form').submit(function(event){
                event.preventDefault();
                var main_itemname = document.getElementById('itemname').value;
                var main_pfs101 = document.getElementById('pfs').value;
                var main_brand = document.getElementById('brand').value;
                var main_stock101 = document.getElementById('stock').value;
                var main_minimum = document.getElementById('minimum').value;
                var main_date = document.getElementById('date').value;
                var main_pop = document.getElementById('pop').value;
                var main_ip = document.getElementById('ip').value;
                var main_category = document.getElementById('category').value;
                var unit_measure = document.getElementById('unitofmeasure').value;
                var main_amount = document.getElementById('amount').value;
                var image_name = $('#image').val();
                    if(unit_measure != '' && main_itemname != '' && main_pfs101 != '' &&  main_brand != '~~SELECT~~' &&  main_category != '~~SELECT~~' && main_stock101 != ''
                    && main_minimum != '' && main_date != '' && main_amount != '' && main_pop != '' && main_ip != ''  && image_name !=''){
                            var extension = $('#image').val().split('.').pop().toLowerCase();
                            if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                            {
                                alert("Invalid Image File");
                                $('#image').val('');
                                return false;
                            }
                            else
                            {
                                $.ajax({
                                url:"PROCESS.php",
                                method:"POST",
                                data:new FormData(this),
                                contentType:false,
                                processData:false,
                                success:function(data)
                                {
                                    $('#error').html(data);
                                    var a = document.getElementById('error').innerHTML;
                                    document.querySelector('#error').style.display = "none";
                                    switch(a){
                                        case 'Item registered':
                                            alert("Item successfully registered");
                                            window.location= "mainitem.php";
                                        break;
                                        default:
                                        document.querySelector('#error').style.color = "#dd0000";
                                        document.querySelector('#error').style.display = "inline";
                                        break;
                                        }
                                }
                                });
                            }

                    }
                    else
                    {
                       alert("Complete the information");
                       return false;

                    }
                });


        });
        $(document).ready(function(){
            $('#update_form').submit(function(event){
                event.preventDefault();

                var id = document.getElementById('id').value;
                var category = document.getElementById('category').value;
                var image = document.getElementById('image').value;

                var itemname = document.getElementById('itemname').value;
                var pfs = document.getElementById('pfs').value;
                var pop = document.getElementById('pop').value;
                var ip = document.getElementById('ip').value;
                var brand = document.getElementById('brand').value;
                var unitofmeasure = document.getElementById('unitofmeasure').value;
                var minimum = document.getElementById('minimum').value;
                var stock = document.getElementById('stock').value;

                var date = document.getElementById('date').value;
                var amount = document.getElementById('amount').value;
                var update_stock1 = document.getElementById('update_stock1').value;
                var hidden_stock = document.getElementById('hidden_stock').value;

                if(itemname != '' && pfs != '' && pop != '' && ip != '' && brand != '' &&
                unitofmeasure != '' && minimum != '' && update_stock1 != ''){
                    if(image != ''){
                            var extension = $('#image').val().split('.').pop().toLowerCase();
                            if(jQuery.inArray(extension, ['jpg','jpeg']) == -1)
                            {
                                alert("JPG, JPEG Only");
                                $('#image').val('');
                                return false;
                            }
                    }
                    if(stock > 0 && date != ''){
                        if(hidden_stock != update_stock1){
                            alert('Transaction and Updating stock cant do at the same time');
                            return false;
                        }
                    }
                    if(stock > 0 && date == ''){
                        alert('Set a date');
                        return false;
                    }

                    else if (stock <= 0 && date != ''){
                        alert('Enter a stock');
                        return false;
                    }

                    // else if(stock > 0 && date !=''){

                    //     // if(hidden_stock != update_stock1){
                    //     //     alert("Transaction and Update stock can't proceed at the same time");
                    //     //     return false;
                    //     // }

                    // }


                    else{
                            $.ajax({
                                url:"PROCESS.php",
                                method:"POST",
                                data:new FormData(this),
                                contentType:false,
                                processData:false,
                                success:function(data)
                                {
                                    $('#error').html(data);
                                    var err = document.getElementById('error').innerHTML;
                                    if(err == 'UPDATED NO TRANSACTION MADE'){
                                        document.getElementById('error').style.display='none';
                                        alert('UPDATED NO STOCK ADDED');
                                        window.location = 'mainitem.php';
                                    }
                                    else{
                                        document.getElementById('error').style.display='none';
                                        alert('UPDATED STOCK ADDED');
                                        window.location = 'mainitem.php';
                                    }
                                }
                            });
                    }


                }
                else
                {
                    alert("Complete the information");
                    return false;
                }



            });
        });

    $(document).ready(function(){
        $("#pfs, #stock").keyup(function(){
            var total = 0;
            var x = Number($("#pfs").val());
            var y = Number($("#stock").val());
            var total = x * y;
            $("#amount").val(total);
    });
    });


    $(document).ready(function(){
        $("#pfs, #pop").keyup(function(){
            var total1 = 0;
            var x1 = Number($("#pfs").val());
            var y1 = Number($("#pop").val());
            var total1 = x1 + y1;
            $("#ip").val(total1);
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