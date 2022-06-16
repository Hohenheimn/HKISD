<?php

require_once 'connect.php';
session_start();
$open = false;
$err_otp = '';
//open modal for account staff-information
if(isset($_POST['id_number_address'])){
    $id_add  = $_POST['id_number_address'];
    $result_add = $mysqli->query("SELECT * FROM tbl_stuff WHERE id_code = $id_add");
    $row_add  = $result_add ->fetch_array();
    echo $row_add ['address'];
}
if(isset($_POST['id_number_contact'])){
    $id_con = $_POST['id_number_contact'];
    $result_con = $mysqli->query("SELECT * FROM tbl_stuff WHERE id_code = $id_con");
    $row_con  = $result_con ->fetch_array();
    echo $row_con['contact'];
}
if(isset($_POST['id_number_date'])){
    $id_date = $_POST['id_number_date'];
    $result_date = $mysqli->query("SELECT * FROM tbl_stuff WHERE id_code = $id_date");
    $row_date  = $result_date ->fetch_array();
    echo $row_date['date'];
}
//modal checkout
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $output = '';
    $reslt = $mysqli->query("SELECT * FROM tbl_postransaction WHERE id_postran=$id") or die($mysqli->error());
    $rw = $reslt->fetch_array();
    $admin = $rw['admin'];
    $totala = $rw['totala'];
    $amount = $rw['amount'];
    $change = $rw['changee'];
    $date= $rw['date'];
    $cusx= $rw['cus_name'];
    $refx =$rw['ref_name'];
    $discount = $rw['discount'];
    if($cusx == ''){
        $cusx = 'Unknown';
    }
    if($refx == ''){
        $refx = 'None';
    }

    $query1 = "SELECT * FROM tbl_positem WHERE id_item = '".$id."'";
    $result1 = mysqli_query($connect, $query1);
    $output .='
    <div class="modal-header">
    <h5 class="text-uppercase">'.$admin.'</h5>
    <h5 data-dismiss="modal">
    <button  style="border:none;background-color:transparent;margin-right:15px">x</button>
    </h5>
    </div>
    <div class="row inner">
    <div class="col-6 inn">

    <label>Customer:</label>
        <h5>'.$cusx.'</h5>
    </div>

    <div class="col-6 inn">
        <label>Referral Agent:</label>
        <h5>'.$refx.'</h5>
    </div>

    <div class="col-6 inn">
        <label>Total Amount:</label>
        <h5 style="margin-left:5px">₱ '.number_format($totala, 2).'</h5>
    </div>

    <div class="col-6 inn">
        <label>Total Tendered:</label>
        <h5 style="margin-left:5px">₱'.number_format($amount, 2).'</h5>
    </div>

    <div class="col-6 inn">
        <label>Discount:</label>
        <h5 style="margin-left:5px">₱'.number_format($discount, 2).'</h5>
    </div>


    <div class="col-6 inn">
        <label>Change:</label>
        <h5 style="margin-left:5px">₱'.number_format($change, 2).'</h5>
    </div>

    <div class="col-6 inn">
        <label>Date:</label>
        <h5 style="margin-left:5px">'.$date.'</h5>
    </div>



    <div class="table-responsive modalhayt_Table">
        <table class="teybo">
        <thead>
            <th>Item</th>
            <th>Quantity</th>
            <th>Amount</th>
        </thead>

    ';
    while($row = mysqli_fetch_Array($result1)){
        $output .= '

            <tr>
                <td class="text-uppercase">'.$row['itemname'].'</td>
                <td class="text-uppercase">'.$row['qty'].'</td>
                <td class="text-uppercase">₱'.number_format($row['amount'], 2).'</td>
            </tr>
        ';
    }
    $output .='

      </table>

                    </div>

                    </div>
                    </div>
            </div>';
    echo $output;
}
//installment open modal
if(isset($_POST['ref_installment'])){
    $ref = $_POST['ref_installment'];


    $pos_result2 = $mysqli->query("SELECT * FROM tbl_postransaction WHERE id_postran = '$ref'");
    $pos_row2 = $pos_result2->fetch_array();
    $typePayment = $pos_row2['type_payment'];
    $installment_ref = $pos_row2['ref_number'];
    $cus_name = $pos_row2['cus_name'];
    $totalamount = $pos_row2['amount'];
    $user = $pos_row2['admin'];
    $ins_output = '';
    $ins_output .= '
        <div class="modal-header">
        <h5>'.$user.'</5>
        <h5 data-dismiss="modal">
        <button  style="border:none;background-color:transparent;margin-right:15px">x</button>
        </h5>
        </div>

        <div class="modal-body">

            <div class="row">
                <div class="col-7 margin">
                <label class="lins">Customer:</label>
                    <h5>'.$cus_name.'</h5>
                </div>
                <div class="col-5">
                <label class="lins">Reference Number:</label>
                    <h5>'.$installment_ref.'</h5>
                </div>
                <br>
                <br>
                <div class="col-7">
                    <label class="lins">Amount Tendered:</label>
                    <h5 class="mins">₱'.number_format($totalamount, 2).'</h5>
                </div>
                <div class="col-5 margin">
                <label class="lins">Type of payment:</label>
                <h5>'.$typePayment.'</h5>
                </div>
    </div>
    <br>
    ';
    echo $ins_output;
}

//POSTRANSACTION FILTER DATE
if(isset($_POST["from_daterev"], $_POST["to_daterev"])){
    $trans_type = $_POST['trans_typerev'];
    $from_daterev = $_POST["from_daterev"];
    $to_daterev = $_POST["to_daterev"];
    if($trans_type == 'All'){
        $stmt1 = $mysqli->query("SELECT SUM(totala) AS a FROM tbl_postransaction WHERE date BETWEEN '$from_daterev' AND '$to_daterev'");
    }
    else{
        $stmt1 = $mysqli->query("SELECT SUM(totala) AS a FROM tbl_postransaction WHERE date BETWEEN '$from_daterev' AND '$to_daterev' AND type = '$trans_type'");

    }
     $sum1 =  mysqli_fetch_assoc($stmt1);
    $sum_amount = $sum1['a'];
        if($sum_amount == ''){
            echo 0;
            }
        else{
            echo number_format($sum_amount, 2);
            }
    }

if(isset($_POST["from_datenos"], $_POST["to_datenos"])){
    $trans_type = $_POST['trans_typenos'];
    $from2 = $_POST["from_datenos"];
    $to2 = $_POST["to_datenos"];
    if($trans_type == 'All'){
        $stmt = $mysqli->query("SELECT SUM(qty) AS p FROM tbl_positem WHERE amount != 0 AND date BETWEEN '$from2' AND '$to2'");
    }
    else{
         $stmt = $mysqli->query("SELECT SUM(qty) AS p FROM tbl_positem WHERE amount != 0 AND date BETWEEN '$from2' AND '$to2' AND type = '$trans_type'");
    }
   $sum =  mysqli_fetch_assoc($stmt);
    $sum_item = $sum['p'];
        if($sum_item == ''){
            echo 0;
            }
        else{
            echo $sum_item;
            }

}
//FILTER TRANSACTION
if(isset($_POST["from_date"], $_POST["to_date"])){
    $trans_type = $_POST['trans_type'];
    $from = $_POST['from_date'];
    $to = $_POST['to_date'];
    if($trans_type == 'All'){
        $query = $mysqli->query("SELECT * FROM tbl_postransaction WHERE date BETWEEN '$from' AND '$to'");
    }
    else{
        $query = $mysqli->query("SELECT * FROM tbl_postransaction WHERE date BETWEEN '$from' AND '$to' AND type ='$trans_type'");
    }

    $output = '';
    if(mysqli_num_rows($query) > 0){
        $output .= '

                    <table class="teybol" id="teybol">
                                <thead>
                                    <th>TRANSACTION NO.</th>
                                    <th>Total amount</th>
                                    <th>Amount tendered</th>
                                    <th>Change</th>
                                    <th>Date</th>
                                    <th>Type of Transaction</th>
                                    <th></th>
                                    <th></th>
                                </thead>
                                <tbody>
        ';
        while($row = $query->fetch_assoc())
        {
            $output .= '

                <tr>
                    <td class="text-uppercase">'.$row['id_postran'].'</td>
                    <td class="text-uppercase">₱'.number_format($row['totala'], 2).'</td>
                    <td class="text-uppercase">₱'.number_format($row['amount'], 2).'</td>
                    <td class="text-uppercase">₱'.number_format($row['changee'], 2).'</td>
                    <td class="text-uppercase">'.$row['date'].'</td>
                    <td class="text-uppercase">'.$row['type'].'</td>
                    <td class="text-uppercase" style="display:none">'.$row['id_postran'].'</td>
                    <td><a class="remove1"><img src="images/delete.png" class="imgg" alt=""></a></td>';
                    if($row['type'] == 'INSTALLMENT'){
                        $output .='
                        <td class="text-uppercase">
                            <a style="text-design:none;float:right;margin-right:0px" class="open_ins" id="open"  data-toggle="modal" data-target="#mymodal2">
                            <img src="images/action.png" class="imgg"></a>
                        </td>';
                    }
                    else{
                    $output .='
                    <td class="text-uppercase">
                        <a style="text-design:none;float:right;margin-right:0px" class="open" id="open"  data-toggle="modal" data-target="#mymodal1">
                        <img src="images/action.png" class="imgg"></a>
                    </td>';
                    }

                    $output .='
                </tr>
            ';
        }
        $output .='
        </tbody>
        </table>
        <script>
        $(document).ready(function(){
            $("#teybol, tbody").on("click",".remove1", function(){
                  var currow =$(this).closest("tr");
                  var id = currow.find("td:eq(0)").text();
                  $(this).closest("tr").remove();
                  $.ajax({
                    url:"POSaction.php",
                    method:"POST",
                    data:{
                      transactionPOS_id:id
                    },
                    success:function(data){
                    }
                  });
            });
          });

        $(document).ready(function(){
            $(".teybol, tbody").on("click",".open",function(){

                var currow =$(this).closest("tr");
                var id =currow.find("td:eq(6)").text();
                $.ajax({
                url:"POSaction.php",
                method:"POST",
                data:{id:id},
                success:function(data){
                    $(".modalbody").html(data);
                }
                });
                });
        });
        $(document).ready(function(){
            $(".teybol, tbody").on("click",".open_ins",function(){

              var currow1 =$(this).closest("tr");
              var id1 =currow1.find("td:eq(6)").text();
              $.ajax({
                  url:"POSaction.php",
                  method:"POST",
                  data:{ref_installment:id1},
                  success:function(data){
                    $(".modalbody1").html(data);
                  }
                  });

            });
            });
        </script>
        ';
    }
    else{
        $output .= '
        <table class="teybol">
            <tr>
                                     <th>TRANSACTION NO.</th>
                                    <th>Total amount</th>
                                    <th>Amount tendered</th>
                                    <th>Change</th>
                                    <th>Date</th>
                                    <th>Type of Transaction</th>
                                    <th></th>
                                    <th></th>
            </tr>

        </table>
        <div class="notfound">
            NO TRANSACTION FOUND!
        </div>

        ';
    }
    echo $output;

}

if(isset($_POST['tran_no_rev'])){
    $id = $_POST['tran_no_rev'];
    $query = $mysqli->query("SELECT * FROM tbl_postransaction WHERE id_postran= $id");
    if(mysqli_num_rows($query) > 0){
        $row = $query->fetch_array();
        $rev = $row['totala'];
        echo number_format($rev, 2);
    }
    else{
        echo "No Transaction found";
    }

}
if(isset($_POST['tran_no_nos'])){
    $id = $_POST['tran_no_nos'];
    $get_ref = $mysqli->query("SELECT * FROM tbl_postransaction WHERE id_postran = $id");

    if(mysqli_num_rows($get_ref) > 0){
        $row_get_ref = $get_ref->fetch_array();
        $reference = $row_get_ref['ref_number'];
        $type = $row_get_ref['type'];
        if($type == 'CHECKOUT'){
            $num_sum = $mysqli->query("SELECT SUM(qty) AS numberr FROM tbl_positem WHERE id_item = $id AND amount != 0");
            $num_sum1 =  mysqli_fetch_assoc($num_sum);
            $number_sale=$num_sum1['numberr'];
            if($number_sale == '' || $number_sale == 0){
                echo "No Transaction found";
            }
            else{
                 echo $number_sale;
            }
        }
        elseif($type == 'INSTALLMENT'){

            echo "1";
        }

    }
    else{
        echo "No Transaction found";
    }



}
//filter by transaction type
if(isset($_POST['pos_tran_type_rev'])){
    $type = $_POST['pos_tran_type_rev'];
    if($type == 'All'){
        $num_sum = $mysqli->query("SELECT SUM(totala) AS numberr FROM tbl_postransaction");
    }
    else{
        $num_sum = $mysqli->query("SELECT SUM(totala) AS numberr FROM tbl_postransaction WHERE type = '$type'");
    }

    $num_sum1 =  mysqli_fetch_assoc($num_sum);
    $number_sale=$num_sum1['numberr'];
    if($number_sale == '' || $number_sale == 0){
        echo "No Transaction found";
    }
    else{
         echo number_format($number_sale, 2);
    }
}
if(isset($_POST['pos_tran_type_nos'])){
    $type = $_POST['pos_tran_type_nos'];
    if($type == 'All'){
        $num_sum = $mysqli->query("SELECT SUM(qty) AS numberr FROM tbl_positem WHERE amount != 0");
    }
    else{
         $num_sum = $mysqli->query("SELECT SUM(qty) AS numberr FROM tbl_positem WHERE type = '$type' AND amount != 0");
    }

    $num_sum1 =  mysqli_fetch_assoc($num_sum);
    $number_sale=$num_sum1['numberr'];
    if($number_sale == '' || $number_sale == 0){
        echo "No Transaction found";
    }
    else{
         echo $number_sale;
    }
}


if(isset($_POST['pos_tran_type'])){
    $type = $_POST['pos_tran_type'];
    $to = $_POST['type_to'];
    $from = $_POST['type_from'];
    if($to != '' && $from != ''){
        if($type == 'All'){
            $query = $mysqli->query("SELECT * FROM tbl_postransaction WHERE date BETWEEN '$from' AND '$to' ORDER BY date DESC");
        }
        else{
            $query = $mysqli->query("SELECT * FROM tbl_postransaction WHERE date BETWEEN '$from' AND '$to' AND type ='$type' ORDER BY date DESC");
        }
    }
    else{
        if($type == 'All'){
            $query = $mysqli->query("SELECT * FROM tbl_postransaction ORDER BY date DESC");
        }
        else{
            $query = $mysqli->query("SELECT * FROM tbl_postransaction WHERE type ='$type' ORDER BY date DESC");
        }
    }

    $output = '';
    if(mysqli_num_rows($query) > 0){
        $output .= '

                    <table class="teybol" id="teybol">
                                <thead>
                                    <th>TRANSACTION NO.</th>
                                    <th>Total amount</th>
                                    <th>Amount tendered</th>
                                    <th>Change</th>
                                    <th>Date</th>
                                    <th>Type of Transaction</th>
                                    <th></th>
                                    <th></th>
                                </thead>
                                <tbody>
        ';
        while($row = $query->fetch_assoc())
        {
            $output .= '

                <tr>
                    <td class="text-uppercase">'.$row['id_postran'].'</td>
                    <td class="text-uppercase">₱'.number_format($row['totala'], 2).'</td>
                    <td class="text-uppercase">₱'.number_format($row['amount'], 2).'</td>
                    <td class="text-uppercase">₱'.number_format($row['changee'], 2).'</td>
                    <td class="text-uppercase">'.$row['date'].'</td>
                    <td class="text-uppercase">'.$row['type'].'</td>
                    <td class="text-uppercase" style="display:none">'.$row['id_postran'].'</td>
                    <td><a class="remove1"><img src="images/delete.png" class="imgg" alt=""></a></td>';

                    if($row['type'] == 'INSTALLMENT'){
                        $output .='
                        <td class="text-uppercase">
                            <a style="text-design:none;float:right;margin-right:0px" class="open_ins" id="open"  data-toggle="modal" data-target="#mymodal2">
                            <img src="images/action.png" class="imgg"></a>
                        </td>';
                    }
                    else{
                    $output .='
                    <td class="text-uppercase">
                        <a style="text-design:none;float:right;margin-right:0px" class="open" id="open"  data-toggle="modal" data-target="#mymodal1">
                        <img src="images/action.png" class="imgg"></a>
                    </td>';
                    }

                    $output .='
                </tr>
            ';
        }
        $output .='
        </tbody>
        </table>
        <script>
        $(document).ready(function(){
            $("#teybol, tbody").on("click",".remove1", function(){
                  var currow =$(this).closest("tr");
                  var id = currow.find("td:eq(0)").text();
                  $(this).closest("tr").remove();
                  $.ajax({
                    url:"POSaction.php",
                    method:"POST",
                    data:{
                      transactionPOS_id:id
                    },
                    success:function(data){
                    }
                  });
            });
          });

        $(document).ready(function(){
            $(".teybol, tbody").on("click",".open",function(){

                var currow =$(this).closest("tr");
                var id =currow.find("td:eq(6)").text();
                $.ajax({
                url:"POSaction.php",
                method:"POST",
                data:{id:id},
                success:function(data){
                    $(".modalbody").html(data);
                }
                });
                });
        });
        $(document).ready(function(){
            $(".teybol, tbody").on("click",".open_ins",function(){

              var currow1 =$(this).closest("tr");
              var id1 =currow1.find("td:eq(6)").text();
              $.ajax({
                  url:"POSaction.php",
                  method:"POST",
                  data:{ref_installment:id1},
                  success:function(data){
                    $(".modalbody1").html(data);
                  }
                  });

            });
            });
        </script>
        ';
    }
    else{
        $output .= '
        <table class="teybol">
            <tr>
                                     <th>TRANSACTION NO.</th>
                                    <th>Total amount</th>
                                    <th>Amount tendered</th>
                                    <th>Change</th>
                                    <th>Date</th>
                                    <th>Type of Transaction</th>
                                    <th></th>
                                    <th></th>
            </tr>

        </table>
        <div class="notfound">
            NO TRANSACTION FOUND!
        </div>

        ';
    }
    echo $output;

}
//filter by transaction number
if(isset($_POST['tran_no'])){
    $output ='';
    $id = $_POST['tran_no'];
    $query = $mysqli->query("SELECT * FROM tbl_postransaction WHERE id_postran = $id");
    $row = $query->fetch_array();
    if(mysqli_num_rows($query) > 0){
        $output .='
        <table class="teybol" id="teybol">
            <tr>
                                    <th>TRANSACTION NO.</th>
                                    <th>Total amount</th>
                                    <th>Amount tendered</th>
                                    <th>Change</th>
                                    <th>Date</th>
                                    <th>Type of Transaction</th>
                                    <th></th>
                                    <th></th>
            </tr>';
            $output .= '

            <tr>
                <td class="text-uppercase">'.$row['id_postran'].'</td>
                <td class="text-uppercase">₱'.number_format($row['totala'], 2).'</td>
                <td class="text-uppercase">₱'.number_format($row['amount'], 2).'</td>
                <td class="text-uppercase">₱'.number_format($row['changee'], 2).'</td>
                <td class="text-uppercase">'.$row['date'].'</td>
                <td class="text-uppercase">'.$row['type'].'</td>
                <td class="text-uppercase" style="display:none">'.$row['id_postran'].'</td>
                <td><a class="remove1"><img src="images/delete.png" class="imgg" alt=""></a></td>';
                if($row['type'] == 'INSTALLMENT'){
                    $output .='
                    <td class="text-uppercase">
                        <a style="text-design:none;float:right;margin-right:0px" class="open_ins" id="open"  data-toggle="modal" data-target="#mymodal2">
                        <img src="images/action.png" class="imgg"></a>
                    </td>';
                }
                else{
                $output .='
                <td class="text-uppercase">
                    <a style="text-design:none;float:right;margin-right:0px" class="open" id="open"  data-toggle="modal" data-target="#mymodal1">
                    <img src="images/action.png" class="imgg"></a>
                </td>';
                }

                $output .='
            </tr>
        </table>

        <script>
        $(document).ready(function(){
            $("#teybol, tbody").on("click",".remove1", function(){
                  var currow =$(this).closest("tr");
                  var id = currow.find("td:eq(0)").text();
                  $(this).closest("tr").remove();
                  $.ajax({
                    url:"POSaction.php",
                    method:"POST",
                    data:{
                      transactionPOS_id:id
                    },
                    success:function(data){
                    }
                  });
            });
          });
        $(document).ready(function(){
            $(".teybol, tbody").on("click",".open",function(){

                var currow =$(this).closest("tr");
                var id =currow.find("td:eq(6)").text();
                $.ajax({
                url:"POSaction.php",
                method:"POST",
                data:{id:id},
                success:function(data){
                    $(".modalbody").html(data);
                }
                });
                });
        });
        $(document).ready(function(){
            $(".teybol, tbody").on("click",".open_ins",function(){

              var currow1 =$(this).closest("tr");
              var id1 =currow1.find("td:eq(6)").text();
              $.ajax({
                  url:"POSaction.php",
                  method:"POST",
                  data:{ref_installment:id1},
                  success:function(data){
                    $(".modalbody1").html(data);
                  }
                  });

            });
            });
        </script>
        ';

    }
    else{
        $output .='
        <table class="teybol">
            <tr>
                                    <th>TRANSACTION NO.</th>
                                    <th>Total amount</th>
                                    <th>Amount tendered</th>
                                    <th>Change</th>
                                    <th>Date</th>
                                    <th>Type of Transaction</th>
                                    <th></th>
                                    <th></th>
            </tr>
        </table>
        ';
    }
    echo $output;
}

//logout staff
if(isset($_POST['logout'])){
    unset($_SESSION['username']);
}
//log in staff
if(isset($_POST['staffid'])){
    $id = $_POST['staffid'];
    $validateid = $mysqli->query("SELECT * FROM  tbl_stuff WHERE id_code='$id'");
    $row = $validateid->fetch_array();
    if(mysqli_num_rows($validateid) == 1){
        $_SESSION['username'] = $row['name'];
        echo "login";
    }
    else{
        echo "<p>Invalid ID</p>";
    }
}
//POS transfer data MODAL
if(isset($_POST['item_name'])){
    $item_picture = $_POST['item_name'];
    $picture = $mysqli->query("SELECT * FROM tbl_inventory WHERE name = '$item_picture'");
    $pic = $picture->fetch_array();
    $output3 ='<img src="data:image/jpeg;base64,'.base64_encode($pic['picture'] ).'" height="100%" width="100%" class="img-thumbnail" />';
    echo $output3;

}
//POS referral reset
if(isset($_POST['name_referral'])){
    $name_referral = mysqli_real_escape_string($mysqli, $_POST['name_referral']);
    $result_refer = $mysqli->query("SELECT * FROM tbl_referral WHERE name='$name_referral'") or die($mysqli->error());
    $row_refer = $result_refer->fetch_array();
    $name_referral1 = $row_refer['referral_number'];
    $calculate = 0;
    $mysqli->query("UPDATE tbl_referral SET referral_number ='$calculate' WHERE name = '$name_referral'");
    $output4 = '';
    $output4 .='
    <table class="teybol teybola" id="teyboll">
    <thead>
        <th>Name</th>
        <th>Count of referral</th>
        <th></th>
    </thead>
    ';
    $result_referral4 = $mysqli->query("SELECT * FROM tbl_referral");
    while($row = mysqli_fetch_Array($result_referral4))
    {
        $output4 .= '
        <tr>
            <td>'.$row['name'].'</td>
            <td>'.$row['referral_number'].'</td>
            <td><a href="#" id="reset">Reset</a></td>
        <tr>
        ';
    }
    $output4 .='
    </table>
    <script>
    $(document).ready(function(){
        $("#teyboll, tbody").on("click","#reset",function(){
           var row =$(this).closest("tr");
           var name = row.find("td:eq(0)").text();
           $.ajax({
               url:"POSaction.php",
               method:"POST",
               data:{name_referral:name},
               success:function(data)
               {
                   $(".taas").html(data);
               }
           });
        });
     });
    </script>';
    echo $output4;
}
if(isset($_POST['item_name1'])){
    $profit1 = $_POST['item_name1'];
    $profit_1 = $mysqli->query("SELECT * FROM tbl_inventory WHERE name = '$profit1'");
    $profit_2 = $profit_1->fetch_array();

    echo $profit_2['profit'];
}
if(isset($_POST['getTransactionNumber'])){
    $query =  $mysqli->query("SELECT id as idd FROM tbl_postransaction ORDER BY id DESC limit 1");
    if(mysqli_num_rows($query) == 0){
    $query2 = 1;
    }
    else{
    $query1 = mysqli_fetch_assoc($query);
    $query2 = $query1['idd'];
    $query2 +=1;
    }
    echo $query2;
}
// POINT OF SALE
if(isset($_POST["qty"]))
{
    //TRANSACTION NUMBER
    $query =  $mysqli->query("SELECT id as idd FROM tbl_postransaction ORDER BY id DESC limit 1");
    if(mysqli_num_rows($query) == 0){
    $query2 = 1;
    }
    else{
    $query1 = mysqli_fetch_assoc($query);
    $query2 = $query1['idd'];
    $query2 +=1;
    }

    $qty = $_POST["qty"];
    $discount_item = $_POST['discount_item'];
    $itemname = $_POST["itemname"];
    $price = $_POST["price"];
    $inv_id = $_POST["inv_id"];
    $stock = $_POST["stock"];
    $date =  date("Y-m-d");
    $query ='';

    $cus = $_POST['cus_name1'];
    $ref1 = $_POST['ref_name1'];
    $data = array();
    for($count1 = 0; $count1 < count($qty); $count1++)
    {
        $validate = $mysqli->query("SELECT * FROM tbl_inventory WHERE name = '$itemname[$count1]'");
        $row_validate = $validate->fetch_array();
        $validate_stock = $row_validate['stock'];
        if($validate_stock <= 0){
            $myArray = 0;
            $data[$myArray] = $itemname;
            $myArray = $myArray + 1;
        }
    }
    if(empty($data)){
        $cus_name = mysqli_real_escape_string($connect, $_POST['cus_name1']);
        $ref_name = mysqli_real_escape_string($connect, $_POST['ref_name1']);
        $totalamount = mysqli_real_escape_string($connect, $_POST['totalamount1']);
        $change1 = mysqli_real_escape_string($connect, $_POST['change1']);
        $atendered = mysqli_real_escape_string($connect, $_POST['atendered1']);
        $user = mysqli_real_escape_string($connect, $_POST['user1']);
        $discount_item = mysqli_real_escape_string($connect, $_POST['discount_item']);
        $ref_num = 1;
        $ref_num1 = 1;

        $mysqli->query("INSERT INTO tbl_postransaction (id_postran, ref_name, cus_name, totala, amount, changee, date, admin, type, discount) VALUES
        ('$query2', '$ref_name', '$cus_name', '$totalamount', '$atendered', '$change1', '$date', '$user','CHECKOUT', $discount_item)") or die($mysqli->error);

        $validate = $mysqli->query("SELECT * FROM tbl_referral WHERE name = '$ref1'");
        $ref_get = $validate->fetch_array();
        $validate1 = $mysqli->query("SELECT * FROM tbl_referral WHERE name = '$cus'");
        $ref_get1 = $validate1->fetch_array();

        if($cus != '' || $ref1 != ''){
            if(mysqli_num_rows($validate1) >= 1){
                $ref_num1 +=  $ref_get1['referral_number'];
                $mysqli->query("UPDATE tbl_referral SET referral_number='$ref_num1' WHERE name='$cus'") or die($mysqli->error());
            }
            elseif($ref_num1 == ''){

            }
            else{
                $mysqli->query("INSERT INTO tbl_referral(name, referral_number) VALUES ('$cus','$ref_num1')");
            }

            if(mysqli_num_rows($validate) >= 1){

                $ref_num +=  $ref_get['referral_number'];
                $mysqli->query("UPDATE tbl_referral SET referral_number='$ref_num' WHERE name='$ref1'") or die($mysqli->error());
            }
            elseif($ref_get == ''){

            }
            else{
                $mysqli->query("INSERT INTO tbl_referral(name, referral_number) VALUES ('$ref1','$ref_num')");
            }
        }

        for($count = 0; $count < count($qty); $count++)
        {

            $item_qty_clean = mysqli_real_escape_string($connect, $qty[$count]);
            $item_itemname_clean = mysqli_real_escape_string($connect, $itemname[$count]);
            $item_price_clean = mysqli_real_escape_string($connect, $price[$count]);
            $item_stock_clean = mysqli_real_escape_string($connect, $stock[$count]);
            if($item_qty_clean != '' && $item_itemname_clean != '' &&
            $item_price_clean != '' &&  $item_stock_clean != 0)
            {
                //INSERT INTO TRANSACTION RECORD
                $query .= "INSERT INTO tbl_positem(id_item, itemname, qty, amount, date , type)
                VALUES ('$query2','$item_itemname_clean', '$item_qty_clean', '$item_price_clean', '$date', 'CHECKOUT');
                ";

            }
        }
        for($x = 0; $x < count($qty); $x++){
            $update_stock = $stock[$x] - $qty[$x];
            $id = $inv_id[$x];
            $mysqli->query("UPDATE tbl_inventory SET stock ='$update_stock' WHERE id = '$id'");
        }
        mysqli_multi_query($connect, $query);
    }
    else{
        echo "Can't proceed some of items is out of stock it might the other store sell it first";
    }
// ----

// sadasd
}

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $open = true;
    $opendata = $mysqli->query("SELECT * FROM tbl_positem WHERE id = $id");
}

if(isset($_POST["from_date2"], $_POST["to_date2"])){
    $to = $_POST["to_date2"];
    $from = $_POST["from_date2"];
    $cost_sum = $mysqli->query("SELECT SUM(amount) AS cost_sum FROM tbl_expense WHERE date BETWEEN '$from' AND '$to'");
    $cost_sum1 =  mysqli_fetch_assoc($cost_sum);
    $cost=$cost_sum1['cost_sum'];
    echo number_format($cost, 2);
}
if(isset($_POST['supplier_id'])){
    $id = $_POST['supplier_id'];
    $mysqli->query("DELETE FROM tbl_suppliertran WHERE id = $id");
}
if(isset($_POST["from_date3"], $_POST["to_date3"])){
    $output1 = '';
    $query = "SELECT * FROM tbl_suppliertran WHERE date BETWEEN '".$_POST["from_date3"]."' AND '".$_POST["to_date3"]."' ORDER BY date DESC";
    $result = mysqli_query($connect, $query);
    $output1 .='

                        <table class="teybol  table-striped">
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
                ';
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_Array($result))
        {
            $output1 .= '

                    <tr>
                        <td class="text-uppercase">'.$row['id'].'</td>
                        <td class="text-uppercase">'.$row['brand'].'</td>
                        <td class="text-uppercase">'.$row['name'].'</td>
                        <td class="text-uppercase">'.$row['quantity'].'</td>
                        <td class="text-uppercase">₱'.number_format($row['amount'], 2).'</td>
                        <td class="text-uppercase">'.$row['date'].'</td>

                        <td><a class="remove1"><img src="images/delete.png" class="imgg" alt=""></a></td>
                    </tr>

            ';
        }
        $output1 .="
        </tbody>
        </table>
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
        </script>
        ";
    }
    else{
        $output1 .= '
        </table>
        <div class="notfound">
        NO TRANSACTION FOUND!
        </div>
        </div>

        ';
    }
    echo $output1;

}
//FILTER SALES REPORT
if(isset($_POST['sale_report_to'])){
    $to = $_POST['sale_report_to'];
    $from = $_POST['sale_report_from'];
    $address = $mysqli->query("SELECT * FROM tbl_address");
    $add_row = $address->fetch_array();
    $addresss = $add_row['address'];

    $amount_sum = $mysqli->query("SELECT SUM(amount) AS amountt FROM tbl_POStransaction WHERE date BETWEEN '$from' AND '$to'");
    $amount_sum1 =  mysqli_fetch_assoc($amount_sum);
    $amountt=$amount_sum1['amountt'];

    $num_sum = $mysqli->query("SELECT SUM(qty) AS numberr FROM tbl_positem WHERE date BETWEEN '$from' AND '$to' AND amount != 0");
    $num_sum1 =  mysqli_fetch_assoc($num_sum);
    $number_sale=$num_sum1['numberr'];

    $output = '';
    $output .= '
    <h4 class="h4"><span class="jnr">JNR</span>  Motorcycle parts and Accessories</h4>
    <p class="address">'.$addresss.'</p>
    <img src="images/tubat-logo.jpg" class="img" alt="">
    <p class="datee">Sales Report From: <span id="from">'.$from.'</span> to: <span id="to">'.$to.'</span></p>
    <p class="lbl">Number of sales: <span id="number-sales">'.$number_sale.'</span></p>
    <p class="lbl">Revenue Profit: <span id="revenue">₱'.number_format($amountt, 2).'</span></p>

    <div class="table-responsive tbody1">
    <table class="teybol">
        <tr>
            <th>Customer Name</th>
            <th>Total Amount</th>
            <th>Date</th>
        </tr>


    ';
    $result = $mysqli->query("SELECT * FROM tbl_postransaction WHERE date BETWEEN '$from' AND '$to' ORDER BY date DESC");
    while($row_pos = $result->fetch_assoc()){
        $id = $row_pos['id_postran'];

        if($row_pos['cus_name'] == ''){
            $cus = "Unknown";

        }
        else{
            $cus = $row_pos['cus_name'];
        }

        $output .='
        <tr>
            <td class="td1">'.$cus.'</td>
            <td class="td">₱'.number_format($row_pos['totala'], 2).'</td>
            <td class="td2">'.$row_pos['date'].'</td>
        </tr>
        ';

            if($row_pos['type'] == 'INSTALLMENT'){

                $id_postran1 = $row_pos['ref_number'];
                $ins = $mysqli->query("SELECT * FROM tbl_positem WHERE id_item = $id_postran1");
                $ins_row = $ins->fetch_array();

                    $output .='
                    <tr>
                            <td class="td4 text-center">'.$row_pos['type'].'</td>
                            <td class="td3">'.$ins_row['itemname'].'</td>
                            <td class="td5">'.$row_pos['type_payment'].'</td>
                    </tr>
                    ';
            }
            else{
                $result_positem = $mysqli->query("SELECT * FROM tbl_positem WHERE id_item = $id");
                while($row_positem = $result_positem->fetch_assoc()){

                    $output .='
                    <tr>
                                <td class="td4 text-center">'.$row_positem['qty'].'</td>
                                <td class="td3">'.$row_positem['itemname'].'</td>
                                <td class="td5">₱'.number_format($row_positem['amount'], 2).'</td>
                    </tr>
                            ';
                }

            }

    $output .='
            <tr  class="tr">
                <td class="td6"></td>
                <td></td>
                <td class="td7"></td>
            </tr>
    ';
    }

    $output .='
    </table>
    </div>
    ';


    echo $output;
}
if(isset($_POST['expense_id'])){
    $id = $_POST['expense_id'];
    $mysqli->query("DELETE FROM tbl_expense WHERE id = $id");
}
if(isset($_POST["from_date1"], $_POST["to_date1"])){
    $output1 = '';
    $query = "SELECT * FROM tbl_expense WHERE date BETWEEN '".$_POST["from_date1"]."' AND '".$_POST["to_date1"]."' ORDER BY date DESC";
    $result = mysqli_query($connect, $query);
    $output1 .='

                        <table class="teybol  table-striped table-bordered" id="crud_table">
                                            <thead>
                                                <th class="text-uppercase">Expense ID</th>
                                                <th>Expense</th>
                                                <th>Amount</th>
                                                <th>date</th>
                                                <th></th>


                                            </thead>

                                            <tbody>
                ';
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_Array($result))
        {
            $output1 .= '

                    <tr>
                        <td data-label="Expense" class="text-uppercase">'.$row['id'].'</td>
                        <td class="text-uppercase">'.$row['name'].'</td>
                        <td class="text-uppercase">₱'.number_format($row['amount'], 2).'</td>
                        <td class="text-uppercase">'.$row['date'].'</td>
                        <td><a class="remove1"><img src="images/delete.png" class="imgg" alt=""></a></td>
                    </tr>

            ';
        }
        $output1 .="
        </tbody>
        </table>
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
                        expense_id:id
                        },
                        success:function(data){
                        }
                    });
                });
            });
        </script>
        ";
    }
    else{
        $output1 .= '
        </table>
        </div>

        ';
    }
    echo $output1;

}

if(isset($_POST['aname'])){
    $name = $_POST['aname'];
    $result = $mysqli->query("SELECT * FROM tbl_inventory WHERE name='$name'") or die($mysqli->error());
    $row = $result->fetch_array();
    echo $row['price'];
}
if(isset($_POST['feee'])){
    $area = $_POST['feee'];
    $result = $mysqli->query("SELECT * FROM tbl_area WHERE area='$area'") or die($mysqli->error());
    $row = $result->fetch_array();
    echo $row['fee'];
}
if(isset($_POST['delete_area'])){
    $id = $_POST['delete_area'];
    $mysqli->query("DELETE FROM tbl_area WHERE id=$id") or die($mysqli->error());
    $query1 = "SELECT * FROM tbl_area";
    $result1 = mysqli_query($connect, $query1);

    $delete = '';
    $delete .= '
    <table class="teybol  table-striped ">
                        <thead>
                            <th>Area</th>
                            <th>Fee</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
    ';
    while($row = mysqli_fetch_Array($result1))
    {
        $delete .= '

                <tr>
                    <td class="text-uppercase">'.$row['area'].'</td>
                    <td class="text-uppercase">'.$row['fee'].'</td>
                    <td data-label="Brand" class="text-uppercase"><p class="hiden">'.$row['id'].'</p></td>

                    <td data-label="Action" class="text-uppercase">

                        <a style="text-design:none;float:right;margin-right:10px" class="btn_delete">
                       <img src="images/delete.png" class="imgg"></a>
                     </td>
                </tr>

        ';
    }
    $delete .='
    </tbody>
    </table>
    <script>
    $(document).ready(function(){
        $(".teybol, tbody").on("click",".btn_delete",function(){
       var currow =$(this).closest("tr");
       var col1 =currow.find("td:eq(2)").text();
       $.ajax({
                           url: "POSaction.php",
                           method: "POST",
                           data: {
                               delete_area:col1
                           },
                           success: function (data) {
                             $(".bod").html(data);
                           }
       });
       });
       });
    </script>
    ';
    echo $delete;
}
if(isset($_POST['area1'])){
    $area1 = $_POST['area1'];
    $va = $mysqli->query("SELECT * FROM  tbl_area WHERE area='$area1'");
    // if(mysqli_num_rows($va) >= 1){
    //     echo "Area already Registered";
    // }
}


if(isset($_POST['area'])){
    $fee = mysqli_real_escape_string($mysqli,$_POST['fee']);
    $area = mysqli_real_escape_string($mysqli,  $_POST['area']);
    $validatedd = $mysqli->query("SELECT * FROM  tbl_area WHERE area='$area'");
    if(mysqli_num_rows($validatedd) >= 1){
        $output2 = '';
        $query1 = "SELECT * FROM tbl_area";
        $result1 = mysqli_query($connect, $query1);
        $output2 .='

        <table class="teybol  table-striped">
                            <thead>
                                <th>Area</th>
                                <th>Fee</th>
                                <th></th>
                                        <th></th>
                            </thead>
                            <tbody> ';
                            while($row = mysqli_fetch_Array($result1))
                            {
                                $output2 .= '

                                        <tr>
                                            <td class="text-uppercase">'.$row['area'].'</td>
                                            <td class="text-uppercase">'.$row['fee'].'</td>
                                            <td data-label="Brand" class="text-uppercase"><p class="hiden">'.$row['id'].'</p></td>

                                            <td data-label="Action" class="text-uppercase">

                                                <a style="text-design:none;float:right;margin-right:10px" class="btn_delete">
                                               <img src="images/delete.png" class="imgg"></a>
                                             </td>
                                        </tr>

                                ';
                            }
                            $output2 .='
                            </tbody>
                            </table>
                            <script>
                                $(document).ready(function(){
                                    $(".teybol, tbody").on("click",".btn_delete",function(){
                                var currow =$(this).closest("tr");
                                var col1 =currow.find("td:eq(2)").text();
                                $.ajax({
                                                    url: "POSaction.php",
                                                    method: "POST",
                                                    data: {
                                                        delete_area:col1
                                                    },
                                                    success: function (data) {
                                                        $(".bod").html(data);
                                                    }
                                });
                                });
                                });
                                </script>
                            ';
                            echo $output2;
    }
    else{
    $mysqli->query("INSERT INTO tbl_area (area, fee) VALUES ('$area', '$fee')") or die($mysqli->error);
    $output2 = '';
    $query1 = "SELECT * FROM tbl_area";
    $result1 = mysqli_query($connect, $query1);
    $output2 .='

    <table class="teybol  table-striped">
                        <thead>
                            <th>Area</th>
                            <th>Fee</th>
                            <th></th>
                                    <th></th>
                        </thead>
                        <tbody> ';
                        while($row = mysqli_fetch_Array($result1))
                        {
                            $output2 .= '

                                    <tr>
                                        <td class="text-uppercase">'.$row['area'].'</td>
                                        <td class="text-uppercase">'.$row['fee'].'</td>
                                        <td data-label="Brand" class="text-uppercase"><p class="hiden">'.$row['id'].'</p></td>

                                        <td data-label="Action" class="text-uppercase">

                                            <a style="text-design:none;float:right;margin-right:10px" class="btn_delete">
                                           <img src="images/delete.png" class="imgg"></a>
                                         </td>
                                    </tr>

                            ';
                        }
                        $output2 .='
                        </tbody>
                        </table>
                        <script>
                            $(document).ready(function(){
                                $(".teybol, tbody").on("click",".btn_delete",function(){
                            var currow =$(this).closest("tr");
                            var col1 =currow.find("td:eq(2)").text();
                            $.ajax({
                                                url: "POSaction.php",
                                                method: "POST",
                                                data: {
                                                    delete_area:col1
                                                },
                                                success: function (data) {
                                                    $(".bod").html(data);
                                                }
                            });
                            });
                            });
                            </script>
                        ';
                        echo $output2;
    }



}

// TRANSACTION DELETE
if(isset($_POST['transactionPOS_id'])){
    $id = $_POST['transactionPOS_id'];
    $mysqli->query("DELETE FROM tbl_postransaction WHERE id_postran = $id");
}






?>