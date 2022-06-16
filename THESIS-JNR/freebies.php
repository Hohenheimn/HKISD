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
    <title>JNR Motorcycleparts and Accessories</title>
    <meta charset="utf-8">
    <link href="mycss/sidescrollbar.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet"> 
    <link href="mycss/inventory1.css" rel="stylesheet">
   
    

		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
  </head>
  <?php require_once 'PROCESS.php'; ?>
<?php require_once 'connect.php'; ?>
<?php
    $result = $mysqli->query("SELECT * FROM tbl_inventory WHERE category = 'freebies'");
?>
<?php    $stmt = $mysqli->query("SELECT COUNT(stock) AS numberofstock FROM tbl_inventory WHERE stock <= minimum") or die(mysqli_error($mysqli));
        $count =  mysqli_fetch_assoc($stmt);
        $num_stock=$count['numberofstock'];
?>
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
              <li  class="active">
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
        <div class="row row1">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">FREEBIES</h4>
                </div>
                <div class="col-7 align-self-center">                    
                        <a href="mainitem.php" class="main float-right">Main Items</a>
                    </div>
                </div>
        </div>
        <div class="row row2">
            
                <div class="col-lg-5 r">
                        <button id="to_additem" class="a" href="freebiesaction.php">Add item</button>
                </div>
                <div class="col-lg-7"> 
                    <div class="serts_con">
                         <input type="text" id="search" placeholder="search"><img src="images/search_logo.png" class="float-right imgg" alt="search">
                    </div>                   
                      
                </div>
        </div>





           
           
            <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                                            <div class="table-responsive hayt1">
                                               
                                                <table id="teybol">
                                                        
                                                            <tr>
                                                                <th class="text-uppercase">Brand</th>
                                                                <th class="text-uppercase">Item name</th>
                                                                <th class="text-uppercase">Stock</th>
                                                                <th class="text-uppercase">Minimum</th>
                                                                <th class="text-uppercase">Unit of measure</th>
                                                                <th class="text-right"></th>
                                                                <th class="text-right"></th>
                                                             
                                                            
                                                            </tr>
                                                            <tbody>
                                                              <?php while($row1 = $result->fetch_assoc()): ?>      
                                                              <tr class="tr">
                                                                  <td data-label="Brand" class="text-uppercase"><?php echo $row1['brand']; ?></td>
                                                                  <td data-label="Model" class="text-uppercase"><?php echo $row1['name']; ?></td>
                                                                  <td data-label="Stock" class="text-uppercase"><?php echo $row1['stock']; ?></td>
                                                                 <td data-label="Stock" class="text-uppercase"><?php echo $row1['minimum']; ?></td>
                                                                 <td data-label="Stock" class="text-uppercase"><?php echo $row1['unitmeasure']; ?></td>

                                                                 
                                                                  <td data-label="Action" class="text-uppercase">     
                                                                      <a style="text-design:none;float:right;margin-right:0px" class="aktyon" href="freebiesaction.php?free_action=<?php echo $row1['id']; ?>">
                                                                      <img src="images/action.png" class="pikyur"></a>
                                                                  </td>
                                                                  <td>
                                                                      <a style="text-design:none;float:right;margin-right:10px" class="delit" id="delit">
                                                                      <img src="images/delete.png" class="pikyur"></a>   
                                                                  </td>
                                                              </tr>
                                                              <?php endwhile; ?>
                                                            </tbody>

                                                       
                                                    </table>


                                                </div>  
                                                <div class="tablebottom"></div>                                               
                                            </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    <script>
     //load to inventory action
     $(document).ready(function(){
      $('#to_additem').click(function(){
        window.location="freebiesaction.php";
      });
    });
     // -------------------------
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
    // -------------------------
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
     // -------------------------
    $(document).ready(function(){
             $('.teybol, tbody').on('click','.delit',function(){
            var currow =$(this).closest('tr');
            var col1 =currow.find('td:eq(1)').text();
            var confirmation = confirm("Do you want delete this item: " + col1);
            if(confirmation){
              $.ajax({
                url: 'PROCESS.php',
                                method: 'POST',
                                data: {
                                    inventory_Delete:col1
                                },
                                success: function (data) {
                                  alert(col1 + " successfully deleted");
                                  window.location = "freebies.php";
                                
                                }
              });
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
    </script>

    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>