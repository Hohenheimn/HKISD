<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: login.php");
    }
?>
<!doctype html>
<html lang="en">
  <head>
  <link rel="icon" type="image/png" sizes="16x16" href="images/tubat-logo.jpg">
    <title>JNR Motorcycleparts and Accessories</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="mycss/sidescrollbar.css" rel="stylesheet">
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
<?php require_once 'PROCESS.php'; ?>
<?php require_once 'connect.php'; ?>
  <body>
        <!-- Page Content  -->
      <div id="content" class="p-3 p-md-3">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <p><img src="images/employee.png" style="height:20px;width:20px"  alt=""> Hi, <?php echo $_SESSION['username']; ?></p>

            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
              <li class="nav-item active">
                    <a class="nav-link" href="POS_stuff.php">Checkout</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#" id="sign-out">Sign out</a>
                </li>

              </ul>
            </div>
          </div>
        </nav>
        <h5>MANAGE DOWNPAYMENT</h5>
        <div class="page-wrapper">
        <div class="row">
          <div class="col-lg-9">
             <div class="searchcontainer">

                                     <input placeholder="Search" type="text" name="search" id="search" class="searchinput"><a name="searchbar"><img src="images/search_logo.png" class="imgg float-right" alt="search"></a>
                           </div>
          </div>

          <div class="col-lg-3">
          <div class="dropdown">
            <button class="button">Down Payment<img src="images/arrow_down.png" class="imgg" alt=""></button>
            <div class="div">
              <a class="a" href="staff-installment.php">Forms</a>
              <a class="a" href="staff-balance.php">Balance</a>
              <a class="a" href="staff-penalty.php">Penalty</a>
              <a class="a" href="staff-paid.php">Paid</a>
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
                                                                <th>Applicant name</th>
                                                                <th>Reference number</th>
                                                                <th>Date created</th>
                                                                <th>Total amount</th>
                                                                <th class="text-right"></th>
                                                            </thead>

                                                        <tbody>
                                                        <?php
                                                        $result13 = $mysqli->query("SELECT * FROM tbl_installmentaccount  WHERE statuss = 'down payment'");
                                                        while($row = $result13->fetch_assoc()): ?>
                                                        <tr class="tr">
                                                            <td><?php echo $row['customer_name']; ?></td>
                                                            <td ><?php echo $row['referrence_number']; ?></td>
                                                            <td><?php echo $row['date']; ?></td>
                                                            <td>₱ <?php echo number_format($row['total_amount'], 2); ?></td>
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
                                                                <input type="hidden" value="<?php echo $_SESSION['username']; ?>" id="user">

                                                                    <div class="modal-header">
                                                                        <h5 id="name"></h5>
                                                                        <h5 id="ref"></h5>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                    <div class="row">
                                                                      <div class="col-8"><h5 id="itemname" class="text-uppercase"></h5></div>
                                                                      <div class="col-4"><h5>Stock: <span id="stock"></span></h5></div>
                                                                    </div>




                                                                    <h5 id="total"></h5>

                                                                    <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-12 table_other"></div>
                                                                    </div>
                                                                    <label>Amount:</label>
                                                                       <input type="number" name="amount" id="amount" class="form-control">
                                                                        <br>
                                                                       <input type="date" name="date" id="date" class="form-control">

                                                                       <br>
                                                                       <p id="error"></p>

                                                                       <button class="btn btn-danger" data-dismiss="modal" style="margin-top:40px" id = "close">Close</button>

                                                                       <button class="btn btn-success float-right" id = "proceed">Proceed</button>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" id="hiden">

  <script>
       $(document).ready(function(){
          $('#sign-out').click(function(){
              a = "logout";
              $.ajax({
                  url:'POSaction.php',
                  method:'POST',
                  data:{
                      logout:a
                  },
                  success:function(data){
                      window.location = "login.php";
                  }
              });
          });
        });
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
        $('#proceed').click(function(){
            document.getElementById('proceed').disabled = true;
            var a = document.getElementById('amount').value;
            var d = document.getElementById('date').value;
            var ref = document.getElementById('ref').innerHTML;
            var cus_name = document.getElementById('name').innerHTML;
            var user = document.getElementById('user').value;
            if(a != '' && d != ''){
                $.ajax({
                                url: 'insAction.php',
                                method: 'POST',
                                data: {
                                    down_action:ref,a:a,d:d,cus_name:cus_name,user:user
                                },
                                success: function (data) {
                                $("#hiden").val(data);
                                  var hiden = document.getElementById("hiden").value;

                                  if(hiden == 'outofitem'){
                                    alert("This item is out of Stock");
                                    document.getElementById('proceed').disabled = false;
                                  }
                                  else if(hiden == 'changename'){
                                    alert("Can't Proceed Freebies name might be change by admin Refresh the page to continue");
                                    document.getElementById('proceed').disabled = false;
                                  }
                                  else if(hiden == 'pribisnostock'){
                                    alert("Freebies is lack of item or out of stock, Can't Proceed");
                                    document.getElementById('proceed').disabled = false;
                                  }
                                  else{
                                    alert("Payment successfuly stored");
                                    window.location = 'staff-down.php';
                                  }
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
                                      down_ref:col1
                                  },
                                  success: function (data) {
                                      alert("Successfully deleted");
                                      window.location = 'staff-down.php';
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
      //OPEN MODAL
       $(document).ready(function(){
        $('.teybol, tbody').on('click','.btn_modal',function(){
                var currow =$(this).closest('tr');
                var name =currow.find('td:eq(0)').text();
                var ref =currow.find('td:eq(1)').text();
                var total =currow.find('td:eq(3)').text();
                document.getElementById('amount').value = '';
                document.getElementById('date').value = '';
                document.getElementById('name').innerHTML = name;
                document.getElementById('ref').innerHTML = ref;
                document.getElementById('total').innerHTML = total;
                $.ajax({
                    url:"insAction.php",
                    method:"POST",
                    data:{ref_balance:ref},
                    success:function(data)
                    {
                        $('#itemname').html(data);
                    }
                });
                $.ajax({
                    url:"insAction.php",
                    method:"POST",
                    data:{ref_table_other:ref},
                    success:function(data)
                    {
                        $('.table_other').html(data);
                    }
                });
                $.ajax({
                    url:"insAction.php",
                    method:"POST",
                    data:{down_stock:ref},
                    success:function(data)
                    {
                        $('#stock').html(data);
                        var stock = document.getElementById('stock').innerHTML;
                        if(stock <= 0){
                          document.getElementById('stock').style.color="#dd0000";
                          document.getElementById('stock').style.fontWeight="600";
                        }
                        else{
                          document.getElementById('stock').style.color="green";
                          document.getElementById('stock').style.fontWeight="600";
                        }
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