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
        <h5>Manage Installment</h5>
        <div class="page-wrapper">
        <div class="row">
          <div class="col-lg-9">
             <div class="searchcontainer">
                <input placeholder="Search" type="text" name="search" id="search" class="searchinput"><a name="searchbar"><img src="images/search_logo.png" class="imgg float-right" alt="search"></a>
              </div>
          </div>

          <div class="col-lg-3">
          <div class="dropdown">
            <button class="button">Paid<img src="images/arrow_down.png" class="imgg" alt=""></button>
            <div class="div">
              <a class="a" href="staff-installment.php">Forms</a>
              <a class="a" href="staff-balance.php">Balance</a>
              <a class="a" href="staff-down.php">Down Payment</a>
              <a class="a" href="staff-penalty.php">Penalty</a>

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
                                                                <th>Total contract price</th>
                                                                <th>Penalty fees</th>
                                                                <th>Total amount</th>
                                                                <th>Due date</th>
                                                                <th>Paid date</th>

                                                                <th></th>
                                                            </thead>

                                                        <tbody>
                                                        <?php
                                                        $result13 = $mysqli->query("SELECT * FROM tbl_installmentaccount  WHERE statuss = 'paid'");
                                                        while($row = $result13->fetch_assoc()): ?>
                                                        <tr class="tr">

                                                            <td ><?php echo $row['referrence_number']; ?></td>

                                                            <td><?php echo $row['customer_name']; ?></td>

                                                            <td>₱ <?php echo number_format($row['total_amount'], 2); ?></td>
                                                            <td>₱ <?php echo number_format($row['penalty_fee'], 2); ?></td>
                                                            <td>₱ <?php echo number_format($row['total'], 2); ?></td>
                                                            <td><?php echo $row['due_date']; ?></td>
                                                            <td><?php echo $row['paid_date']; ?></td>
                                                            <td>
                                                              <a style="text-design:none;float:right;margin-right:15px" href="#" class="btn_modal" id="view" data-toggle="modal" data-target="#modal">
                                                              View</a>

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
  <div class="modal fade" id="modal">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
                <h5>PAYMENT HISTORY</h5>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <h5 id="item"></h5>
                </div>

                  <div class="col-12 table_other"></div>

                <div class="col-12">
                  <div class="theTable" style="margin-top:20px">
                  </div>
                  <button class="btn btn-danger float-right" data-dismiss="modal" style="margin-top:20px">Close</button>

                </div>
            </div>



            </div>
          </div>
        </div>
      </div>
    </div>

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
     $(document).ready(function(){
             $('#teybol, tbody').on('click','#view',function(){
            var currow =$(this).closest('tr');
            var reference =currow.find('td:eq(0)').text();
            $.ajax({
              url:'insAction.php',
              method:'POST',
              data:{
                reference_item:reference
              },
              success:function(data){
                $('#item').html(data);
              }
            });
            $.ajax({
                    url:"insAction.php",
                    method:"POST",
                    data:{ref_table_other1:reference},
                    success:function(data)
                    {
                        $('.table_other').html(data);
                    }
                });
            $.ajax({
              url:'insAction.php',
              method:'POST',
              data:{
                reference_table:reference
              },
              success:function(data){
                $('.theTable').html(data);
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