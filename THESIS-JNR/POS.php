<?php 
    session_start();
    if(!isset($_SESSION['admin_username'])){
        header("location: login.php");
    }
    require_once 'connect.php';
    $updateSession = $mysqli->query("SELECT * FROM tbl_account");
    $updateses = $updateSession->fetch_array();
    $session_updated = $updateses['username'];
    $_SESSION['admin_username'] = $session_updated;
?>
<!doctype html>
<html lang="en">
  <head>
    <link rel="icon" type="image/png" sizes="16x16" href="images/tubat-logo.jpg">
    <title>JNR Motorcycleparts and Accessories</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
   
    <link href="mycss/checkout1.css" rel="stylesheet">
    <link href="mycss/sidescrollbar.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
    <style>
        .tago{
            display:none;
        }
    </style>
  </head>
<?php require_once 'PROCESS.php'; ?>
<?php  $identifyuser = $mysqli->query("SELECT username AS user FROM tbl_account WHERE id = '1'");
        $identifyuser1 =  mysqli_fetch_assoc($identifyuser);
        $identifyuser2 = $identifyuser1['user'];
 // $mysqli->query("SELECT * FROM tbl_accounts WHERE username = '$username'"); ?>
<?php   $stmt = $mysqli->query("SELECT COUNT(stock) AS numberofstock FROM tbl_inventory WHERE stock <= minimum") or die(mysqli_error($mysqli));
        $count =  mysqli_fetch_assoc($stmt);
        $num_stock=$count['numberofstock']; ?>
        
        <?php
        $result = $mysqli->query("SELECT * FROM tbl_inventory"); ?>
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
                <div class="row">
                    <div class="col-5 align-self-center">
                    <h5 class="pointofsale">CHECKOUT</h5>
                    </div>
                    <div class="col-7 align-self-center">                    
                    <button class="float-right referral" data-toggle="modal" data-target="#mymodal4">REFERRAL</button>
                     
                    </div>


                   
                    <div class="col-lg-7 align-self-center">
                        <div>
                           <div class="searchcontainer">
                             
                                     <input placeholder="Search" type="text" name="search" id="search" class="searchinput"><a name="searchbar"><img src="images/search_logo.png" class="imgg" alt="search"></a>
                           </div>
                        </div>
                    </div>
                </div>
                
            </div>
           
            <div class="modal fade" id="mymodal4">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header" id="modal3">
                                    <h3>Referral</h3>
                                </div>
                                <div class="modal-body row mymodal2body">
                                    <div class="freebies_con">
                                    <input placeholder="Search by name" type="text" id="search_freebies" class="search_freebies"><img src="images/search_logo.png" class="img" alt="search">
                                    </div>
                                    <br>
                                    <div class="table-responsive taas">
                                        <table class="teybol teybola" id="teyboll">
                                            <thead>
                                                <th>Name</th>
                                                <th>Count of referral</th>
                                                <th></th>
                                            </thead>
                                              
                                             </tr>
                                            <?php
                                            $referrals = $mysqli->query("SELECT * FROM tbl_referral");
                                            while($refs = $referrals->fetch_assoc()):
                                            ?>
                                            <tr class="trr">
                                                <td><?php echo $refs['name']; ?></td>
                                                <td><?php echo $refs['referral_number']; ?></td>
                                                <td><a href="#" id="reset">Reset</a></td>
                                            </tr>
                                            <?php endwhile; ?>
                                        </table>
                                    </div>
                                    <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
            </div>
         
         <br>


            <div class="body">
                <div class="row">
                    <div class="col-md-7 ">
                        <div class="card card1">
                               <div class="table-responsive tbody">
                                    <table class="teybol2 table-striped" id="teybol">
                                        <tr>
                                            <th>BRAND</th>
                                            <th>ITEM NAME</th>
                                            <th>CATEGORY</th>
                                            <th>STOCK</th>
                                            <th>PRICE(₱)</th>
                                            <th></th>
                                      
                      
                                        </tr>
                                        <tbody>
                                            
                                        <?php while($row = $result->fetch_assoc()): ?>      
                                                        <tr class="tr">
                                                            <td class="text-uppercase"><?php echo $row['brand']; ?></td>
                                                            <td><?php echo $row['name']; ?></td>  
                                                            <td><?php echo $row['category']; ?></td> 
                                                            <td><?php echo $row['stock']; ?></td>    
                                                            <td id="decimaaal"><?php echo $row['price'];?></td>
                                                            <td data-label="action" class="text-uppercase">
                                                                <button style="text-design:none;border:none;background-color:transparent" href="" class="btn_modal"
                                                                data-toggle="modal" data-target="#mymodal1">
                                                                <img src="images/add_red.png" class="imgg"> </button>  
                                                            </td> 
                                                            <td class="tago"><?php echo $row['id']; ?></td>  
                                                        </tr>
                                        <?php endwhile; ?>
                                        </tbody>
                                    </table>
                               </div>

                        </div>   
                        <div class="modal fade" id="mymodal1">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header mymodal2header" id="addmodal">
                                       <h4 id="itemname" class="text-uppercase"></h4>
                                </div>

                                <div class="modal-body row">
                                   
                                    <div class="col-lg-12 modal_picture">
                                            <input type="hidden" id="inv_id">
                                        <div class="col-6 float-right">
                                            <div class="picture">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                                <label class="lbl_modal1">Price:</label>
                                                    <span class="peso">₱</span><input type="text" readonly id="price" class="value">       
                                               
                                        </div>
                                        <div class="col-6">
                                                
                                                <label class="lbl_modal1">Stock:</label>
                                                <input type="text" readonly id="stock" class="value">  
                                        </div>
                                    </div>
                                    <div class="col-lg-12 row secondpart">
                                    <div class="col-lg-6">
                                          <label class="lbl_modal">Quantity:</label>
                                            <input type="number" id="qty">
                                    </div> 

                                 
                                   

                                    
                                    <div class="col-lg-6">
                                        <label class="lbl_modal">Total Price:</label>
                                            <span class="peso">₱</span><input type="text" id="tprice" readonly class="value">
                                   
                                    </div>
                                    </div> 
                                        
                                  

                                    <div class="col-lg-6"> <h4 id="out_stock"></h4></div>
                                    <div class="col-lg-6">
                                      
                                        <button class="float-right" data-dismiss="modal" id="add">A D D</button>
                                        <button class="float-left btn btn-default" data-dismiss="modal">Cancel</button>
                                        <br>
                                    </div>
                                    <br>

                              
                             
                                </div>


                            </div>
                        </div>


                    </div>                           
                    </div>
                        <br>
                        <br>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="table-responsive summary">

                                    <table class="teybol" id="crud_table">
                                       <th>QTY</th>
                                       <th>ITEM</th>
                                       <th>AMOUNT</th>
                                       <th></th>
                                     
                                    </table>
                                </div>
                                <div class="total">
                                    <div class="row">
                                            <div class="col-lg-12 pers"><p class="leybel">TOTAL AMOUNT:</p></div>
                                       
                                            <div class="col-lg-12 sekond"><div class="amount"><span class="pesoCart">₱</span><span class="val"  id="val">0.00</span></div></div>
                                           
                                            <div class="col-lg-12 terd"><button class="checkout" data-toggle="modal" data-target="#mymodal2" id="checkout">CHECKOUT</button></div>
                                          
                                    </div>


                                 
                                        
                                  
    
                                       
                                </div>
                            </div>                              
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal fade" id="mymodal2">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header  mymodal2header" id="modal2">
                                    <h3>Checkout</h3>
                                </div>
                                <div class="modal-body row mymodal2body">

                                    <div class="col-lg-5">
                                        <p>Transaction Number:</p>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" style="margin-top:-10px" readonly id="transaction_number" class="value">
                                        <br>
                                        <br>
                                    </div>
                                    
                                    <div class="col-lg-5">
                                        <p>Customer name:</p>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="checkout_txt" id="cus_name" name="cus_name" placeholder="name">
                                        <br>
                                        <br>
                                    </div>
                                    
                                    <div class="col-lg-5">
                                        <p>Referral name:</p>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="checkout_txt" id="ref_name" name="ref_name"placeholder="if any">
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-lg-5">
                                        <p>Discount:</p>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="number" class="checkout_txt discount" name="discount" id="discount">
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-lg-5">
                                        <input type="hidden" id="user" value="<?php echo $_SESSION['admin_username']; ?>" name="user">
                                        <label>Total amount:</label>
                                    </div>
                                    <div class="col-lg-7">
                                        <span class="peso_Checkout">₱</span><input type="text"  readonly name="totalamount" id="totalamount" class="value">
                                        <input type="hidden"  readonly name="totalamount1" id="totalamount1" class="value">
                                        <br>
                                        <br>
                                    </div>

                                    <div class="col-lg-5">
                                        <p>Amount tendered:</p>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="number" class="amount_tendered" name="atendered" id="atendered">
                                        <br>
                                        <br>
                                    </div>
                                    
                                    <div class="col-lg-5">Change:</div>
                                    <div class="col-lg-7">
                                        <span class="peso_Checkout">₱</span><input type="text"  readonly class="value" name="change" id="change">
                                        <br>
                                        <br>
                                    </div> 
                                    <div class="col-lg-12">
                                         <p id="cant_proceed"></p>
                                    </div>
                                    <div class="col-lg-12">
                                        <button href="POS.php" name="proceed" id="save" class="savu float-right">Check out <img class="img" src="images/checkout.png"></button>
                                        <button class="float-left btn btn-default" data-dismiss="modal">Cancel</button>
                                        <br>
                                    </div>
                                   
                                    <br>

                                   
                                </div>
                            </div>
                        </div>
    </div>
    </div>
    <script>
        //FORMATING THE NUMBER WITH DECIMAL
        var tablea = document.getElementById('teybol'), sumval =0;
        for(var i = 1; i < tablea.rows.length; i++){
            sumval = parseInt(tablea.rows[i].cells[4].innerHTML);
            sumval = (Math.round(sumval * 100)/ 100).toFixed(2);
            tablea.rows[i].cells[4].innerHTML = sumval;
        }
        //-----------------
        //notifications in sidebar
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
        //-----------------

        //RESET THE COUNT OF REFERRAL
        $(document).ready(function(){
             $('#teyboll, tbody').on('click','#reset',function(){
                var row =$(this).closest('tr');
                var name = row.find('td:eq(0)').text();

                $.ajax({
                    url:"POSaction.php",
                    method:"POST",
                    data:{name_referral:name},
                    success:function(data)
                    {
                        $('.taas').html(data);
                    }
                });
             });
          });
          //-----------------


        // CHECKOUT
        $(document).ready(function(){
            var totaamount101 = document.querySelector("#totalamount");
            var amount_tendered101 = document.querySelector(".amount_tendered");
            const submit101 = document.querySelector(".savu");
            submit101.disabled = true;

                totaamount101,amount_tendered101.addEventListener("keyup", () => {
                    var totalamount102 = document.getElementById('totalamount').value;
                    var amount_tendered102 = document.getElementById('atendered').value;


                    if(parseFloat(totalamount102) <= parseFloat(amount_tendered102)){
                        submit101.disabled = false;
                        document.getElementById('cant_proceed').innerHTML ='Proceed';
                        document.querySelector('#cant_proceed').style.color = "green";
                        document.querySelector('#save').style.background = "#90ee90";
                        document.querySelector('#modal2').style.background = "#90ee90";
                    }
                    else{
                        submit101.disabled = true;
                        document.getElementById('cant_proceed').innerHTML ='Lack of payment!';
                        document.querySelector('#cant_proceed').style.color = "red";
                        document.querySelector('#save').style.background = "#dd0000";
                        document.querySelector('#modal2').style.background = "#dd0000";
                    }
                    
                    switch(totalamount102){
                        case '0':
                        submit101.disabled = true;
                    }
            });
        //-----------------

        //ADD ITEM IN SUMMARY
        $(document).ready(function(){
                var stocku = document.querySelector("#stock");
                var qtyu = document.querySelector("#qty");
                const add101 = document.querySelector("#add");
                add101.disabled = true;

                stocku,qtyu.addEventListener("keyup", () => {
                    var stocku102 = document.getElementById('stock').value;
                    var qtyu102 = document.getElementById('qty').value;


                 
                    if(parseFloat(qtyu102) <= parseFloat(stocku102)){
                        add101.disabled = false;
                        document.getElementById('out_stock').innerHTML = "";
                        document.querySelector('#add').style.background = "#90ee90";
                        document.querySelector('#addmodal').style.background = "#90ee90";
                    }
                    else{
                        document.getElementById('out_stock').innerHTML = "Lack of stock";
                        document.getElementById('out_stock').style.color = "#dd0000";
                        add101.disabled = true;
                        document.querySelector('#add').style.background = "#dd0000";
                        document.querySelector('#addmodal').style.background = "#dd0000";
                    }
                    if (qtyu102 == '' || qtyu102 == 0){
                        document.getElementById('out_stock').innerHTML = "Enter a quantity";
                        document.querySelector('#add').style.background = "#dd0000";
                        document.querySelector('#addmodal').style.background = "#dd0000";
                    }
                });
        });
        //-----------------

        //CHECKOUT AND SAVE
        $('#save').click(function(){
            var qty =[];
            var itemname = [];
            var price = [];
            var stock = [];
            var inv_id = [];
            var totalamount1 = document.getElementById('totalamount').value;
            var atendered1 = document.getElementById('atendered').value;
            var change1 = document.getElementById('change').value;
            var user1 = document.getElementById('user').value;
            var cus_name1 = document.getElementById('cus_name').value;
            var ref_name1 = document.getElementById('ref_name').value;
            var discount_item = document.getElementById('discount').value;
            if(discount_item == ''){
                discount_item = 0;
            }
            $('.qty').each(function(){
                qty.push($(this).text());
            });
            
            $('.itemname').each(function(){
                itemname.push($(this).text());
            });
            
            $('.price').each(function(){
                price.push($(this).text());
            });
            $('.stocks').each(function(){
                stock.push($(this).text());
            });
            $('.inv_id').each(function(){
                inv_id.push($(this).text());
            });
            $.ajax({
                url:"POSaction.php",
                method:"POST",
                data:{atendered1:atendered1,cus_name1:cus_name1,ref_name1:ref_name1,totalamount1:totalamount1,
                change1:change1,user1:user1,qty:qty, itemname:itemname, price:price,inv_id:inv_id,
                stock:stock,discount_item:discount_item},
                success:function(data)
                {
                    document.getElementById('save').disabled = true;
                    $('#cant_proceed').html(data);
                    var cant = document.getElementById('cant_proceed').innerHTML;
                    if(cant == ''){
                        window.location = 'POS.php';
                    }
                    else{
                        document.getElementById('cant_proceed').style.color = '#dd0000';
                        document.querySelector('#modal2').style.background = "#dd0000";
                    }
                }

            });
         
        });
    });
      //-----------------
        
         $(document).ready(function(){
             var count = 1;
            $('#add').click(function(){
                var tprice = document.getElementById('tprice').value;
                var name = document.getElementById('itemname').innerHTML;
                var qty = document.getElementById('qty').value;
                var stock = document.getElementById('stock').value;
                var inv_id = document.getElementById('inv_id').value;
        
                var html_code = "<tr id='row"+count+"'>";
                    html_code += "<td class='qty'>"+qty+"</td>";
                    html_code += "<td class='itemname'>"+name+"</td>";
                    html_code += "<td class='price'>"+tprice+"</td>";
                    html_code += "<td class='stocks' style='display:none'><p>"+stock+"</p></td>";
                    html_code += "<td class='inv_id' style='display:none'>"+inv_id+"</td>";

                    html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>-</button></td>";
                    html_code +="</tr>";
                    $('#crud_table').append(html_code);
                    document.getElementById('qty').value = 1;
                    //ADDING SUMMARY OF ORDER
                    var table = document.getElementById("crud_table"), sumVal = 0;
            
                    for(var i = 1; i < table.rows.length; i++)
                    {
                        sumVal = sumVal + parseFloat(table.rows[i].cells[2].innerHTML);
                    }
                    sumVal = (Math.round(sumVal * 100)/ 100).toFixed(2);
                    document.getElementById("val").innerHTML = sumVal  ;
                   
                    
                    
            });
    
        //sign-out
        
          $(document).ready(function(){
            $('#sign_out').click(function(){
                window.location = "signout.php";
            });
            //check out
            $('#checkout').click(function(){
                document.getElementById('cant_proceed').innerHTML = "";
                var a = 1;
                var totalamount = document.getElementById('val').innerHTML;
                document.getElementById('totalamount').value = totalamount;
                document.getElementById('totalamount1').value = totalamount;
                document.getElementById('atendered').value = 0;
                document.getElementById('discount').value = 0;
                document.getElementById('change').value = 0;
                var count_table = $('#crud_table tr').length;
                const textbox = document.querySelector("#atendered");
                textbox.disabled = false;
                switch(totalamount){
                    case "0":
                        document.getElementById('cant_proceed').innerHTML = "No transaciton";
                        textbox.disabled = true;
                    break;
                }
                $.ajax({
                    url: 'POSaction.php',
                    method: 'POST',
                    data:{
                        getTransactionNumber:a
                    },
                    success:function(data){
                        $('#transaction_number').val(data);
                    }
                });
            });
            });
            //keyup for change
            $(document).ready(function(){
                $("#totalamount, #atendered").keyup(function(){
                    var kabuuan = 0;
                    var z =   document.getElementById('change').value;
                    if (z <= 0){
                        document.getElementById('change').value = 0;
                    }
                    var x = Number($("#totalamount").val());
                    var y = Number($("#atendered").val());
                    var kabuuan = y - x;
                    kabuuan = (Math.round(kabuuan * 100)/ 100).toFixed(2);
                    
                    $("#change").val(kabuuan);
                });
            }); 
            // keyup for discount
            $(document).ready(function(){
                $("#totalamount1, #discount").keyup(function(){
                    var mytotal = 0;
                    var jomari = 0;
                    var total1 = document.getElementById('totalamount1').value;
                    var discount_2 = document.getElementById('discount').value;
                    var total2 = document.getElementById('totalamount').value;

                    var bayad = document.getElementById('atendered').value;


                    if(discount_2 == '' && discount_2 == 0){
                        document.getElementById('totalamount').value = total1;
                       
                            var kapalit = parseFloat(bayad) - parseFloat(total1);
                            document.getElementById('change').value = kapalit;
                       
                    }
                    else{
                        mytotal = parseFloat(total1) - parseFloat(discount_2);
                        mytotal = (Math.round(mytotal * 100)/ 100).toFixed(2);
                        document.getElementById('totalamount').value = mytotal;
                    }
                    
                });
            }); 
            $(document).ready(function(){
                $("#totalamount1, #discount").keyup(function(){
        
                    var total2 = document.getElementById('totalamount').value;
                    var bayad = document.getElementById('atendered').value;
                    
                        if(bayad != '' && bayad != 0){
                            jomari = parseFloat(bayad) - parseFloat(total2);
                            jomari = (Math.round(jomari * 100)/ 100).toFixed(2);
                    
                            document.getElementById('change').value = jomari;
                        }
                    
                });
            }); 

        //OPEN MODAL FOR ADD TO CART
          $(document).ready(function(){
             $('.tebol, tbody').on('click','.btn_modal',function(){
                document.getElementById('out_stock').innerHTML = "";
                document.getElementById('add').disabled = false;
                var currow =$(this).closest('tr');
                var col1 =currow.find('td:eq(1)').text();
                var col2 =currow.find('td:eq(3)').text();
                var col3 =currow.find('td:eq(4)').text();
                var inv_id =currow.find('td:eq(6)').text();
                document.getElementById('inv_id').value = inv_id;
                document.querySelector('#add').style.background = "#90ee90";
                document.querySelector('#addmodal').style.background = "#90ee90";
                $.ajax({
                    url:"POSaction.php",
                    method:"POST",
                    data:{
                        item_name:col1
                    },
                    success:function(data){
                        $('.picture').html(data);

                    }
                });


                document.getElementById('itemname').innerHTML = col1;
                document.getElementById('stock').value = col2;
                col3 = (Math.round(col3 * 100)/ 100).toFixed(2);
                document.getElementById('price').value = col3;
                document.getElementById('tprice').value = col3;
                document.getElementById('qty').value = 1;
            switch(col2){
                case '0':
                    document.getElementById('add').disabled = true;
                    document.getElementById('out_stock').innerHTML = "Out of stock";
                    document.querySelector('#add').style.background = "#dd0000";
                    document.querySelector('#addmodal').style.background = "#dd0000";
                    document.querySelector('#out_stock').style.color = "#dd0000";
                    break;
            }
            
                });
                });

       
        $(document).ready(function(){
        $("#price, #qty").keyup(function(){
            var total = 0;
            var x = Number($("#price").val());
            var y = Number($("#qty").val());
            var total = x * y;
            total = (Math.round(total * 100)/ 100).toFixed(2);
            $("#tprice").val(total);
        });
        });
        $(document).ready(function(){
            $('#crud_table, tbody').on('click','.remove',function(){
                var currow =$(this).closest('tr');
                var price = currow.find('td:eq(2)').text();
                var total = document.getElementById('val').innerHTML;
                total = total - price;
                total = (Math.round(total * 100)/ 100).toFixed(2);
                document.getElementById('val').innerHTML = total;


            $(this).closest('tr').remove();
           
            });
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
            $(document).ready(function(){  
           $('#search_freebies').keyup(function(){  
                search_table($(this).val());  
           });  
           function search_table(value){  
                $('#teyboll .trr').each(function(){  
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