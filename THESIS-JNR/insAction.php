<?php
require_once 'connect.php';

 $itemname1 = '';
 $icc1 = '';
 $price1 = '';
 $area1 = '';
 $fee1 = '';
 $total1 ='';
 $cus_name1 = '';
 $ref1='';
 $date_down = '';
 $price_down = '';
 $frst_down = '';
 //FILTER INSTALLMENT REPORT
 if(isset($_POST['installment_report_to'])){
    $to = $_POST['installment_report_to'];
    $from = $_POST['installment_report_from'];
    $address = $mysqli->query("SELECT * FROM tbl_address");
    $add_row = $address->fetch_array();
    $addresss = $add_row['address'];
    $result = $mysqli->query("SELECT * FROM tbl_installmentaccount WHERE date BETWEEN '$from' AND '$to' ORDER BY date DESC") or die($mysqli->error());
    $output = '';
    $output .='
    <h4 class="h4"><span class="jnr">JNR</span>  Motorcycle parts and Accessories</h4>
    <p class="address">'.$addresss.'</p>
    <img src="images/tubat-logo.jpg" class="img" alt="">
    <p class="datee">Installment contract report between:</p>
    <p class="datee"><span id="from">'.$from.'</span> and: <span id="to">'.$to.'</span></p>
    <div class="table-responsive tbody1">
    <table class="teybol">
        <tr>
            <th>ITEM</th>
            <th>Purchaser</th>
            <th>Status</th>
            <th>Penalty Fee</th>
            <th>Total contract price</th>
            <th>Total price</th>
            <th>Balance</th>
            <th>Date of contract</th>
        </tr>
        <tbody>
    ';
    while($row = $result->fetch_assoc()){
        if($row['penalty_date'] == ''){
            $dateTo = $row['due_date'];
        }
        else{
            $dateTo = $row['penalty_date'];
        }
        $output .= '
            <tr>
                <td style="text-transform:capitalize">'.$row['item_name'].'</td>
                <td style="text-transform:capitalize">'.$row['customer_name'].'</td>
                <td style="text-transform:capitalize">'.$row['statuss'].'</td>
                <td>₱'.number_format($row['penalty_fee'], 2).'</td>
                <td>₱'.number_format($row['total_amount'], 2).'</td>
                <td>₱'.number_format($row['total'], 2).'</td>
                <td>₱'.number_format($row['balance'], 2).'</td>
                <td>'.$row['date'].' to '.$dateTo.'</td>
            </tr>
        ';
    }
    $output .= '
    </table>
    </div>
    ';

    echo $output;
 }
//ADDRESS_ACCOUNT
if(isset($_POST['trigger'])){
    $address =mysqli_real_escape_string($mysqli, $_POST['trigger']);
    $validate = $mysqli->query("SELECT * FROM tbl_address") or die($mysqli->error());
    if(mysqli_num_rows($validate) < 1){
        $mysqli->query("INSERT INTO tbl_address (address) VALUE ('$address')");
    }
    else{
        $mysqli->query("UPDATE tbl_address SET address = '$address'") or die($mysqli->error());
    }

    $result = $mysqli->query("SELECT * FROM tbl_address") or die($mysqli->error());
    $row = $result->fetch_array();
    echo $row['address'];
}
//BANK
//addd bank
if(isset($_POST['bank_name'])){
    $a = mysqli_real_escape_string($mysqli, $_POST['bank_name']);
    $b = mysqli_real_escape_string($mysqli, $_POST['bank_number']);
    $mysqli->query("INSERT INTO tbl_bank (bank_name, account_num) VALUES ('$a','$b')") or die($mysqli->error());
}
//delete bank
if(isset($_POST['bank_num_del'])){
    $a = $_POST['bank_num_del'];
    $b = $_POST['bank_name_del'];
    $mysqli->query("DELETE FROM tbl_bank WHERE bank_name = '$b' AND account_num = '$a'") or die($mysqli->error());
}

// CONTACT NUMBER
//CONTACT AADD
if(isset($_POST['cont_name'])){
    $cont_name = mysqli_real_escape_string($mysqli, $_POST['cont_name']);
    $cont_number = mysqli_real_escape_string($mysqli, $_POST['cont_number']);
    $mysqli->query("INSERT INTO tbl_contact_number (name, number) VALUES ('$cont_name','$cont_number')") or die($mysqli->error());
}

//CONTACT DELETE
if(isset($_POST['del_num'])){
    $del = $_POST['del_num'];
    $mysqli->query("DELETE FROM tbl_contact_number WHERE number = '$del'");
}
//END


//register staff
if(isset($_POST['random_id'])){
    $rand = rand(100000000, 999999999);
    echo $rand;
}
if(isset($_POST['staff_name'])){
    $name = mysqli_real_escape_string($mysqli, $_POST['staff_name']);
    $contact = mysqli_real_escape_string($mysqli, $_POST['staff_number']);
    $address = mysqli_real_escape_string($mysqli, $_POST['staff_address']);
    $date = mysqli_real_escape_string($mysqli, $_POST['staff_date']);
    $code = mysqli_real_escape_string($mysqli, $_POST['staff_code']);
    if($name != '' && $contact != '' && $address != '' && $date != '' && $code != ''){
        $validate = $mysqli->query("SELECT * FROM tbl_stuff WHERE id_code = '$code'");
        if(mysqli_num_rows($validate) == 1){
            echo "This (".$code.") ID number is already registered";
        }
        else{
            $mysqli->query("INSERT INTO tbl_stuff(name, address, date, id_code, contact) VALUES ('$name','$address','$date','$code','$contact')");
            echo "done";
        }
    }
    else{
        echo "Something is wrong please try again";
    }
}
if(isset($_POST['yes_to_delete'])){
    $id = $_POST['yes_to_delete'];
    $mysqli->query("DELETE FROM tbl_stuff WHERE id_code = '$id'");
}
//end

//PRINT FORM
if(isset($_GET['form'])){
    $reference_number = $_GET['form'];
    $result = $mysqli->query("SELECT * FROM tbl_form WHERE ref='$reference_number'") or die($mysqli->error());
        $row = $result->fetch_array();
        $maill = $row['mail'];
        $per_address = $row['per_address'];
        $pre_address = $row['pre_address'];
        $contact1 = $row['contact'];
        $comp_name = $row['comp_name'];
        $comp_address = $row['comp_address'];
        $comp_position = $row['position'];

        $home_namea = $row['home_namea'];
        $home_nameb = $row['home_nameb'];
        $home_contacta = $row['home_contacta'];
        $home_contactb = $row['home_contactb'];
        $home_relationshipa = $row['home_relationshipa'];
        $home_relationshipb = $row['home_relationshipb'];

        $work_namea = $row['work_namea'];
        $work_nameb = $row['work_nameb'];
        $work_contacta = $row['work_contacta'];
        $work_contactb = $row['work_contactb'];
        $work_rela = $row['work_rela'];
        $work_relb = $row['work_relb'];

        $selfie = $row['selfie'];
        $license_pic = $row['license_pic'];
        $gov_id_pic = $row['gov_id_pic'];

        $itemname1 = $row['name'];
        $price1 = $row['price'];
        $area1 = $row['area'];
        $fee1 = $row['fee'];
        $ref1 = $row['ref'];
        $total1 = $row['total'];
        $price_down = $row['downamount'];
        $frst_down = $row['firstamount'];
        $second_down = $row['secondamount'];
        $cus_name1 = $row['cus_name'];
        $from = $row['downpayment'];
        $from1 = $row['firstPayment'];
        $from2 = $row['secondPayment'];
        $statuss = $row['statuss'];
}
//END



//OPENING MODAL
if(isset($_POST['ref_balance'])){
   $ref = $_POST['ref_balance'];
   $result = $mysqli->query("SELECT * FROM tbl_installmentaccount WHERE referrence_number ='$ref'");
   $row = $result->fetch_array();
   $itemname1 = $row['item_name'];
   echo $itemname1;
}
//END
//RANDOM REFERRENCE NUMBER
if(isset($_POST['ref_no'])){
    $i = 1;
    while($i <= 1){
        $rand = rand(100000000, 999999999);
        $validate = $mysqli->query("SELECT * FROM tbl_installmentaccount WHERE referrence_number = '$rand'") or die($mysqli->error());
        if(mysqli_num_rows($validate) >= 1){
        }
        else{
            $i ++;
            echo $rand;
        }
    }
}


//UPDATING FORM AND CREATING INSTALLMENT ACCOUNT
if(isset($_POST["pre_add"]))
{
  $itemname = mysqli_real_escape_string($mysqli, $_POST['itemname']);
  $mail = mysqli_real_escape_string($mysqli, $_POST['mail']);
  $ref = mysqli_real_escape_string($mysqli, $_POST['ref']);
  $customer = mysqli_real_escape_string($mysqli, $_POST['customer']);
  $total = mysqli_real_escape_string($mysqli, $_POST['totalamount']);
  $due_date= mysqli_real_escape_string($mysqli, $_POST['due_date']);

  $status = "down payment";
  $status_form = "filled up";
  $date_now = date('Y-m-d');

  $per = mysqli_real_escape_string($mysqli, $_POST['per_add']);
  $pre= mysqli_real_escape_string($mysqli, $_POST['pre_add']);
  $contact = mysqli_real_escape_string($mysqli, $_POST['contact']);
  $com_name = mysqli_real_escape_string($mysqli, $_POST['com_name']);
  $com_add= mysqli_real_escape_string($mysqli, $_POST['com_add']);
  $com_position= mysqli_real_escape_string($mysqli, $_POST['com_pos']);
  $home_namea= mysqli_real_escape_string($mysqli, $_POST['home_namea']);
  $home_contacta= mysqli_real_escape_string($mysqli, $_POST['home_contacta']);
  $home_rela= mysqli_real_escape_string($mysqli, $_POST['home_rela']);
  $home_nameb = mysqli_real_escape_string($mysqli, $_POST['home_nameb']);
  $home_contactb= mysqli_real_escape_string($mysqli, $_POST['home_contactb']);
  $home_relb = mysqli_real_escape_string($mysqli, $_POST['home_relb']);
  $work_namea = mysqli_real_escape_string($mysqli, $_POST['work_namea']);
  $work_contacta = mysqli_real_escape_string($mysqli, $_POST['work_contacta']);
  $work_rela = mysqli_real_escape_string($mysqli, $_POST['work_rela']);
  $work_nameb = mysqli_real_escape_string($mysqli, $_POST['work_nameb']);
  $work_contactb = mysqli_real_escape_string($mysqli, $_POST['work_contactb']);
  $work_relb = mysqli_real_escape_string($mysqli, $_POST['work_relb']);

  $form_img = addslashes(file_get_contents($_FILES["form_file"]["tmp_name"]));
  $form_img1 = addslashes(file_get_contents($_FILES["form_file1"]["tmp_name"]));
  $form_img2 = addslashes(file_get_contents($_FILES["form_file2"]["tmp_name"]));
        $find_id = $mysqli->query("SELECT * FROM tbl_inventory WHERE name = '$itemname'");
        $get_id = $find_id->fetch_array();
        $inv_id = $get_id['id'];
        $mysqli->query("INSERT INTO tbl_installmentaccount (inv_id, total, balance, date, customer_name, referrence_number,total_amount, due_date,item_name, statuss)
        VALUES ('$inv_id', '$total', '$total', '$date_now', '$customer', '$ref', '$total','$due_date', '$itemname', '$status')") or die($mysqli->error());

        $mysqli->query("UPDATE tbl_form SET mail = '$mail', per_address ='$per', pre_address ='$pre', contact ='$contact', comp_name ='$com_name',comp_address ='$com_add',
        position ='$com_position', home_namea ='$home_namea', home_nameb ='$home_nameb',
        home_contacta ='$home_contacta', home_contactb ='$home_contactb', home_relationshipa ='$home_rela',
        home_relationshipb ='$home_relb', work_namea ='$work_namea',work_nameb ='$work_nameb',
        work_contacta ='$work_contacta', work_contactb ='$work_contactb', work_rela ='$work_rela', work_relb ='$work_contactb',
        selfie ='$form_img', license_pic ='$form_img1', gov_id_pic ='$form_img2', statuss ='$status_form' WHERE ref='$ref'") or die($mysqli->error());
        // $mysqli->query("INSERT INTO tbl_form_img (ref, imgOne, imgTwo, imgThree) VALUES ('$ref', '$form_img', '$form_img1', '$form_img2')");



        $email_password = "jnrmotorcyclebinan223";
        $bank_result = $mysqli->query("SELECT * FROM tbl_bank");

        $email_ng_pag_sesendan = $mail;
        $subj = 'JNR Installment';
        $headers = "From: jnrmoto.binan@gmail.com";
        $message ="";
        $message .="

        Thank you for transacting with us!
        We recommend to pay the downpayment immediately so you will not lose your transaction with us.
        Here is your reference number: ".$ref."
        Check your account status now:
        http://localhost/JNR/viewstatus.php
        Payment Method
        ";

        while($row_bank = $bank_result->fetch_assoc() ){
            $message .= $row_bank['bank_name'] . ": " . $row_bank['account_num'];
        }
        $mail_sent = mail($email_ng_pag_sesendan, $subj, $message, $headers);
}








    if(isset($_POST['insItem'])){
        $ref = $_POST['insItem'];
        $result = $mysqli->query("SELECT * FROM tbl_installmentaccount WHERE referrence_number = $ref");
        $row = $result->fetch_array();
        echo $row['item_name'];
    }

    if(isset($_POST['ref_bal'])){
    $ref_bal = $_POST['ref_bal'];
       $table1 = '';
       $table1 .= '
       <table class="table table-bordered">
        <tr>
            <th>Amount</th>
            <th>Date</th>
        </tr>


       ';
        $result14 = $mysqli->query("SELECT * FROM tbl_payment WHERE referrence_number ='$ref_bal'");
        while($row = $result14->fetch_assoc()){

            $table1 .= '
                <tr>
                    <td>₱ '.number_format($row['amount'], 2).'</td>
                    <td>'.$row['date'].'</td>
                </tr>
            ';

        }

       $table1 .= '
       </table>
       ';
       echo $table1;
    }
    //making payment for downpayment
    if(isset($_POST['down_action'])){
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

       $ref =mysqli_real_escape_string($mysqli, $_POST['down_action']);
       $a =mysqli_real_escape_string($mysqli, $_POST['a']);
       $d =mysqli_real_escape_string($mysqli, $_POST['d']);
       $cus_name =mysqli_real_escape_string($mysqli, $_POST['cus_name']);
       $user =mysqli_real_escape_string($mysqli, $_POST['user']);



       $result = $mysqli->query("SELECT * FROM tbl_installmentaccount WHERE referrence_number = '$ref'");
       $row = $result->fetch_array();
       $total_amount = $row['balance'];
       $item = $row['item_name'];
       $inv_id = $row['inv_id'];
       $totalamount = $row['total_amount'];

       $result1 = $mysqli->query("SELECT * FROM tbl_inventory WHERE id = '$inv_id'");
       $row1 = $result1->fetch_array();
       $stocks = $row1['stock'];
       if($stocks <= 0){
           echo 'outofitem';
       }
       else{
                        $stocks = $stocks - 1;
                        $mysqli->query("INSERT INTO tbl_payment(referrence_number, amount, date) VALUES ('$ref', '$a', '$d')");
                        $mysqli->query("UPDATE tbl_inventory SET stock = '$stocks' WHERE id = '$inv_id'");
                        $balance = $total_amount - $a;
                        $mysqli->query("INSERT INTO tbl_postransaction(admin, cus_name, id_postran, ref_number,totala, amount, date, type, type_payment) VALUES ('$user', '$cus_name', '$query2', '$ref','$a', '$a', '$d', 'INSTALLMENT', 'DOWN PAYMENT')");
                        $mysqli->query("INSERT INTO tbl_positem(type,id_item,itemname, amount, date, qty) VALUES ('INSTALLMENT', '$ref','$item', '$totalamount', '$d', 1)");

                        if($balance <= 0){
                            $mysqli->query("UPDATE tbl_installmentaccount SET paid_date ='$d', statuss = 'Paid', balance = $balance WHERE referrence_number = '$ref'");
                        }
                        else{
                            $mysqli->query("UPDATE tbl_installmentaccount SET statuss = 'balance', balance = $balance WHERE referrence_number = '$ref'");
                        }



       }

   }
    //end
//MAKING A PAYMENT/ BALANCE/ PENALTY
if(isset($_POST['ref_action'])){
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
   $ref =mysqli_real_escape_string($mysqli, $_POST['ref_action']);
   $a =mysqli_real_escape_string($mysqli, $_POST['a']);
   $d =mysqli_real_escape_string($mysqli, $_POST['d']);
   $cus_name =mysqli_real_escape_string($mysqli, $_POST['cus_name']);
   $user =mysqli_real_escape_string($mysqli, $_POST['user']);

   $mysqli->query("INSERT INTO tbl_payment(referrence_number, amount, date) VALUES ('$ref', '$a', '$d')");
   $result = $mysqli->query("SELECT * FROM tbl_installmentaccount WHERE referrence_number = '$ref'");
   $row = $result->fetch_array();
   $total_amount = $row['balance'];
   $balance = $total_amount - $a;
   $mysqli->query("INSERT INTO tbl_postransaction(admin, cus_name, id_postran, ref_number, totala, amount, date, type, type_payment) VALUES ('$user', '$cus_name', '$query2', '$ref','$a', '$a', '$d', 'INSTALLMENT', 'BALANCE')");

   if($balance <= 0){
       $mysqli->query("UPDATE tbl_installmentaccount SET paid_date ='$d', statuss = 'Paid', balance = 0 WHERE referrence_number = '$ref'");
   }
   else{
        $mysqli->query("UPDATE tbl_installmentaccount SET balance = $balance WHERE referrence_number = '$ref'");
   }
}
//END


//END


//BALANCE DELETE
if(isset($_POST['bal_ref'])){
    $ref = $_POST['bal_ref'];
    $mysqli->query("DELETE FROM tbl_installmentaccount WHERE referrence_number='$ref'");
    $mysqli->query("DELETE FROM tbl_payment WHERE referrence_number='$ref'");
    $mysqli->query("DELETE FROM tbl_installmentaccount_freebies WHERE ref=$id") or die($mysqli->error());
}
//END
//PENALTY DELETE
if(isset($_POST['penalty_delete'])){
    $ref = $_POST['penalty_delete'];
    $mysqli->query("DELETE FROM tbl_installmentaccount WHERE referrence_number='$ref'");
    $mysqli->query("DELETE FROM tbl_payment WHERE referrence_number='$ref'");
    $mysqli->query("DELETE FROM tbl_installmentaccount_freebies WHERE ref=$id") or die($mysqli->error());
}
//END



//DOWN PAYMENT DELETE
if(isset($_POST['down_ref'])){
    $ref = $_POST['down_ref'];
    $mysqli->query("DELETE FROM tbl_installmentaccount WHERE referrence_number='$ref'");
    $mysqli->query("DELETE FROM tbl_installmentaccount_freebies WHERE ref=$id") or die($mysqli->error());
}
//END

//FORM DELETE
if(isset($_POST['form_id'])){
    $id = $_POST['form_id'];
    $mysqli->query("DELETE FROM tbl_form WHERE ref=$id") or die($mysqli->error());
    $mysqli->query("DELETE FROM tbl_form_freebies WHERE ref=$id") or die($mysqli->error());
}
//END





//VALIDATING FORM REFERRENCE NUMBER
if(isset($_POST['ref1'])){
    $ref1 = mysqli_real_escape_string($mysqli, $_POST['ref1']);
    $validate1 = $mysqli->query("SELECT * FROM tbl_form WHERE ref = '$ref1'") or die($mysqli->error);
    if(mysqli_num_rows($validate1) >=1){
        echo "Referrence already Registered";
    }
    else{
        echo "Form created";
    }

    //END
}
//FORM LINK
if(isset($_GET['formss'])){
    $reference_number = $_GET['formss'];
    $result = $mysqli->query("SELECT * FROM tbl_form WHERE ref='$reference_number'") or die($mysqli->error());
        $row = $result->fetch_array();
        $itemname1 = $row['name'];
        $price1 = $row['price'];
        $area1 = $row['area'];
        $fee1 = $row['fee'];
        $ref1 = $row['ref'];
        $statu = $row['statuss'];
        $total1 = $row['total'];
        $price_down = $row['downamount'];
        $frst_down = $row['firstamount'];
        $second_down =$row['secondamount'];
        $cus_name1 = $row['cus_name'];
        $from = $row['downpayment'];
        $from1 = $row['firstPayment'];
        $from2 = $row['secondPayment'];
}
//END

//CREATING A FORM
if(isset($_POST['item'])){
        $item_freebies = $_POST['item_freebies'];
        if($item_freebies == 1){
            //------------ No Freebies
            $itemValidate = $_POST['item'];
            $secondValidate =$mysqli->query("SELECT * FROM tbl_inventory WHERE name = '$itemValidate'");
            if(mysqli_num_rows($secondValidate) == 0){
                echo "Can't Proceed Unit name might change by the admin Please refresh the page then continue";
            }
            else{
                    $downpaymentamount = mysqli_real_escape_string($mysqli, $_POST['downpaymentamount']);
                    $datedown = mysqli_real_escape_string($mysqli, $_POST['datedown']);
                    $firstpaymentamount = mysqli_real_escape_string($mysqli, $_POST['firstpaymentamount']);
                    $secondpaymentamount = mysqli_real_escape_string($mysqli, $_POST['secondpaymentamount']);
                    $date_it_made = date('Y-m-d');

                    $item = mysqli_real_escape_string($mysqli, $_POST['item']);
                    $ref = mysqli_real_escape_string($mysqli, $_POST['ref']);
                    $price = mysqli_real_escape_string($mysqli,$_POST['price']);
                    $area = mysqli_real_escape_string($mysqli,  $_POST['area']);
                    $fee = mysqli_real_escape_string($mysqli, $_POST['fee']);
                    $total = mysqli_real_escape_string($mysqli, $_POST['total']);
                    $customer = mysqli_real_escape_string($mysqli, $_POST['customer']);
                    $date1 = mysqli_real_escape_string($mysqli, $_POST['datefirst']);
                    $date2 = mysqli_real_escape_string($mysqli, $_POST['datesecond']);
                    $status = "unfilled";

                    $validate_ref = $mysqli->query("SELECT * FROM tbl_form WHERE ref = '$ref'") or die($mysqli->error);
                    if(mysqli_num_rows($validate_ref) >=1){
                        echo 'Reference number already register try again';
                    }
                    else{

                        $mysqli->query("INSERT INTO tbl_form(date_it_made, downpayment, downamount, firstamount, secondamount, statuss, name, ref, price, area, fee, total, cus_name, firstPayment, secondPayment)
                        VALUES ('$date_it_made', '$datedown','$downpaymentamount','$firstpaymentamount','$secondpaymentamount','$status','$item','$ref','$price','$area','$fee','$total','$customer','$date1','$date2')") or die($mysqli->error);
                    }
            }
            //------------ END
        }
        else{
            // ---------- insert with freebies
            $freebies_price = $_POST['freebies_price'];
            $freebies_qty = $_POST['freebies_qty'];

            for($count = 0; $count < count($item_freebies); $count++)
            {
                $validate = $mysqli->query("SELECT * FROM tbl_inventory WHERE name = '$item_freebies[$count]'");
                if(mysqli_num_rows($validate) == 0){
                    $myArray = 0;
                    $data[$myArray] = $item_freebies;
                    $myArray = $myArray + 1;
                }
            }

            if(empty($data)){
                $itemValidate = $_POST['item'];
                $secondValidate =$mysqli->query("SELECT * FROM tbl_inventory WHERE name = '$itemValidate'");
                if(mysqli_num_rows($secondValidate) == 0){
                    echo "Can't Proceed Unit name might change by the admin Please refresh the page then continue";
                }
                else{
                        $downpaymentamount = mysqli_real_escape_string($mysqli, $_POST['downpaymentamount']);
                        $datedown = mysqli_real_escape_string($mysqli, $_POST['datedown']);
                        $firstpaymentamount = mysqli_real_escape_string($mysqli, $_POST['firstpaymentamount']);
                        $secondpaymentamount = mysqli_real_escape_string($mysqli, $_POST['secondpaymentamount']);
                        $date_it_made = date('Y-m-d');

                        $item = mysqli_real_escape_string($mysqli, $_POST['item']);
                        $ref = mysqli_real_escape_string($mysqli, $_POST['ref']);
                        $price = mysqli_real_escape_string($mysqli,$_POST['price']);
                        $area = mysqli_real_escape_string($mysqli,  $_POST['area']);
                        $fee = mysqli_real_escape_string($mysqli, $_POST['fee']);
                        $total = mysqli_real_escape_string($mysqli, $_POST['total']);
                        $customer = mysqli_real_escape_string($mysqli, $_POST['customer']);
                        $date1 = mysqli_real_escape_string($mysqli, $_POST['datefirst']);
                        $date2 = mysqli_real_escape_string($mysqli, $_POST['datesecond']);
                        $status = "unfilled";

                        $validate_ref = $mysqli->query("SELECT * FROM tbl_form WHERE ref = '$ref'") or die($mysqli->error);
                        if(mysqli_num_rows($validate_ref) >=1){
                            echo 'Reference number already register try again';
                        }
                        else{
                            $mysqli->query("INSERT INTO tbl_form(date_it_made, downpayment, downamount, firstamount, secondamount, statuss, name, ref, price, area, fee, total, cus_name, firstPayment, secondPayment)
                            VALUES ('$date_it_made', '$datedown','$downpaymentamount','$firstpaymentamount','$secondpaymentamount','$status','$item','$ref','$price','$area','$fee','$total','$customer','$date1','$date2')") or die($mysqli->error);
                             for($count1 = 0; $count1 < count($item_freebies); $count1++)
                             {
                                $mysqli->query("INSERT INTO tbl_form_freebies(name, price, ref_num, qty) VALUES ('$item_freebies[$count1]', '$freebies_price[$count1]', '$ref', '$freebies_qty[$count1]')");
                             }
                        }
                    }






            }
            else{
                echo "Can't Proceed Freebies name might change by the admin Please refresh the page then continue";
            }
            // -------------- end
        }



}
//ENDD

//verify otp number for updating email
if(isset($_POST['email_update_otp'])){
    $otp = $_POST['email_update_otp'];
    $email = mysqli_real_escape_string($mysqli, $_POST['email_update']);
    $validate = $mysqli->query("SELECT * FROM tbl_account WHERE otp = $otp");
    if(mysqli_num_rows($validate) == 1){
        $mysqli->query("UPDATE tbl_account SET username = '$email'");
        $mysqli->query("UPDATE tbl_account SET otp = 0");
    }
    else{
        echo "INVALID OTP NUMBER";
    }

}
//send otp to verify for updating email
if(isset($_POST['verify_email_send_otp'])){
    $otp = rand(111111,999999);
    $mysqli->query("UPDATE tbl_account SET OTP = $otp");
    $result_send = $mysqli->query("SELECT * FROM tbl_account");
    $row_send = $result_send->fetch_array();

    $gmail = $row_send['username'];
    $subj = 'JNR OTP Number Change Email';
    $message = "OTP : ".$otp."";
    $headers = "From: jnrmoto.binan@gmail.com";

    mail($gmail, $subj, $message, $headers);
}
//change password
if(isset($_POST['crrent'])){
    $new = $_POST['newww'];
    $otp = $_POST['otp_nuumber'];
    $validate_otp = $mysqli->query("SELECT * FROM tbl_account WHERE otp = $otp");
    if(mysqli_num_rows($validate_otp) == 1){
        $confirm = mysqli_real_escape_string($mysqli, $_POST['confirrm']);
        $curr1 = $_POST['crrent'];

        $validate = $mysqli->query("SELECT * FROM tbl_account") or die($mysqli->error());
        $row = $validate->fetch_array();

        if(password_verify($curr1, $row['password'])){
            $confirm = password_hash($confirm, PASSWORD_DEFAULT);
            $mysqli->query("UPDATE tbl_account SET password = '$confirm'");
            $mysqli->query("UPDATE tbl_account SET otp = 0");
        }
        else{
            echo "Invalid Password";
        }
    }
    else{
        echo "INVALID OTP NUMBER";
    }
}
//send OTP Number for password
if(isset($_POST['curr'])){
    $otp = rand(111111,999999);
    $mysqli->query("UPDATE tbl_account SET OTP = $otp");
    $result_send = $mysqli->query("SELECT * FROM tbl_account");
    $row_send = $result_send->fetch_array();

    $gmail = $row_send['username'];
    $subj = 'JNR OTP Number Change Password';
    $message = "OTP : ".$otp."";
    $headers = "From: jnrmoto.binan@gmail.com";

    mail($gmail, $subj, $message, $headers);
}
//monitor stock of item in down payment section
if(isset($_POST['down_stock'])){
    $ref = $_POST['down_stock'];
    $find = $mysqli->query("SELECT * FROM tbl_installmentaccount WHERE referrence_number = $ref");
    $row = $find->fetch_array();
    $id = $row['inv_id'];

    $find2 = $mysqli->query("SELECT * FROM tbl_inventory WHERE id = $id");
    if(mysqli_num_rows($find2) == '' || mysqli_num_rows($find2) == 0){
        echo '0';
    }
    else{
        $row2 = $find2->fetch_array();
        echo $row2['stock'];
    }

}
if(isset($_POST['reference_item'])){
    $reference = $_POST['reference_item'];
    $find = $mysqli->query("SELECT * FROM tbl_installmentaccount WHERE referrence_number = $reference");
    $get = $find->fetch_array();
    echo $get['item_name'];
}
if(isset($_POST['reference_table'])){
    $reference = $_POST['reference_table'];
    $find = $mysqli->query("SELECT * FROM tbl_payment WHERE referrence_number = $reference");
    $string = '';
    $string .='
        <table class="table">
        <thead>
            <tr>
                <th>Amount</th>
                <th>Date</th>
            <tr>
        </thead>
        <tbody>
    ';
    while($get = $find->fetch_assoc()){
        $string .='
            <tr>
                <td>₱ '.number_format($get['amount'], 2).'</td>
                <td>'.$get['date'].'</td>
            <tr>
        ';
    }
    $string .='
        </tbody>
        </table>
    ';
    echo $string;

}


if(isset($_POST['form_status_filter'])){
    $status = $_POST['form_status_filter'];
    if($status === 'all'){
        $query = $mysqli->query("SELECT * FROM tbl_form ORDER BY date_it_made DESC");
    }else{
        $query = $mysqli->query("SELECT * FROM tbl_form WHERE statuss = '$status' ORDER BY date_it_made DESC");
    }
    $output = '';

    $output .='
    <table class="teybol" id="teybol">

        <thead>
            <th>Applicant name</th>
            <th>Reference number</th>
            <th>Date Created</th>
            <th>STATUS</th>
            <th class="text-right">action</th>
        </thead>

        <tbody>';
        while($row = $query->fetch_assoc()){
        $output .= '
                <tr class="tr">
                    <td>'.$row['cus_name'].'</td>
                    <td >'.$row['ref'].'</td>
                    <td >'.$row['date_it_made'].'</td>
                    <td>'.$row['statuss'].'</td>

                    <td class="text-uppercase">
        ';

                    if($row['statuss'] == 'filled up'){
                        $output .= '
                        <a style="text-design:none;float:right;margin-right:0px" target="form-filledup.php?print='.$row['ref'].'" href="form-filledup.php?form='.$row['ref'].'">
                        <img src="images/fillup.png" class="imggg"></a>
                        ';
                    }
                    else{
                        $output .= '
                        <a style="text-design:none;float:right;margin-right:0px" target="form.php?formss='.$row['ref'].'" href="form.php?formss='.$row['ref'].'">
                        <img src="images/fillup.png" class="imggg"></a>
                        ';
                    }
                    $output .= '
                        <a style="text-design:none;float:right;margin-right:10px" data-toggle="modal" data-target="#modal-delete" class="btn_delete2">
                        <img src="images/deletered.png" class="imggg"></a>

                            </td>
                        </tr>'
                        ;

            }
    $output .= '
        </tbody>

    </table>
    <script>
    $(document).ready(function(){
        $(".teybol, tbody").on("click",".btn_delete2",function(){
       var currow =$(this).closest("tr");
       var col1 =currow.find("td:eq(1)").text();
       document.getElementById("modal_delete").innerHTML = col1;



       });
       });
    </script>
    ';

    echo $output;
}


if(isset($_POST['filter_category_inventory'])){
    $category = $_POST['filter_category_inventory'];
    if($category === 'all'){
        $query = $mysqli->query("SELECT * FROM tbl_inventory WHERE category != 'freebies' ORDER BY date DESC");
    }
    else{
        $query = $mysqli->query("SELECT * FROM tbl_inventory WHERE category = '$category' AND category != 'freebies' ORDER BY date DESC");
    }
    $output = '';

    $output .= '
    <table class="table-striped" id="teybol">

        <tr>

            <th class="text-uppercase">Brand</th>
            <th class="text-uppercase">Model</th>
            <th class="text-uppercase">Stock</th>
            <th class="text-uppercase">Unit of measure</th>
            <th class="text-uppercase">Price</th>
            <th class="text-uppercase">Category</th>
            <th class="text-uppercase">Minimum</th>
            <th class="text-uppercase">Last Update</th>
            <th class="text-right"></th>
            <th class="text-right"></th>

        </tr>

        <tbody>';
        while($row = $query->fetch_assoc()){
        $output .= '
            <tr class="tr">

                <td data-label="Brand" class="text-uppercase">'.$row['brand'].'</td>
                <td data-label="Model" class="text-uppercase">'.$row['name'].'</td>
                <td data-label="Stock" class="text-uppercase">'.$row['stock'].'</td>
                <td data-label="Stock" class="text-uppercase">'.$row['unitmeasure'].'</td>
                <td data-label="Price" class="text-uppercase pricee">₱'.number_format($row['price'], 2).'</td>
                <td data-label="Category" class="text-uppercase">'.$row['category'].'</td>
                <td data-label="Stock" class="text-uppercase">'.$row['minimum'].'</td>
                <td data-label="Stock" class="text-uppercase">'.$row['date'].'</td>

                <td class="wid">
                    <a style="text-design:none;float:right;margin-right:0px" class="aktyon" href="inventory.php?main_action='.$row['id'].'">
                    <img src="images/action.png" class="pikyur"></a>
                </td>

                <td>
                    <a style="text-design:none;float:right;margin-right:10px" class="delit" id="delit">
                    <img src="images/delete.png" class="pikyur"></a>
                </td>

            </tr>';
        }


        $output .= "
            </tbody>

        </table>
        <script>
        $(document).ready(function(){
            $('.teybol, tbody').on('click','.delit',function(){
           var currow =$(this).closest('tr');
           var col1 =currow.find('td:eq(1)').text();
           var confirmation = confirm('Do you want delete this item: ' + col1 + '?');
           if(confirmation){
             $.ajax({
               url: 'PROCESS.php',
                               method: 'POST',
                               data: {
                                   inventory_Delete:col1
                               },
                               success: function (data) {
                                 alert(col1 + ' successfully deleted');
                                 window.location = 'mainitem.php';

                               }
             });
           }
           });
           });
        </script>
        ";

    echo $output;
}

if(isset($_POST['filter_brand_inventory'])){
    $brand = $_POST['filter_brand_inventory'];
    if($brand === 'all'){
        $query = $mysqli->query("SELECT * FROM tbl_inventory WHERE category != 'freebies' ORDER BY date DESC");
    }
    else{
        $query = $mysqli->query("SELECT * FROM tbl_inventory WHERE brand = '$brand' AND category != 'freebies' ORDER BY date DESC");
    }
    $output = '';

    $output .= '
    <table class="table-striped" id="teybol">

        <tr>

            <th class="text-uppercase">Brand</th>
            <th class="text-uppercase">Model</th>
            <th class="text-uppercase">Stock</th>
            <th class="text-uppercase">Unit of measure</th>
            <th class="text-uppercase">Price</th>
            <th class="text-uppercase">Category</th>
            <th class="text-uppercase">Minimum</th>
            <th class="text-uppercase">Last Update</th>
            <th class="text-right"></th>
            <th class="text-right"></th>

        </tr>

        <tbody>';
        while($row = $query->fetch_assoc()){
        $output .= '
            <tr class="tr">

                <td data-label="Brand" class="text-uppercase">'.$row['brand'].'</td>
                <td data-label="Model" class="text-uppercase">'.$row['name'].'</td>
                <td data-label="Stock" class="text-uppercase">'.$row['stock'].'</td>
                <td data-label="Stock" class="text-uppercase">'.$row['unitmeasure'].'</td>
                <td data-label="Price" class="text-uppercase pricee">₱'.number_format($row['price'], 2).'</td>
                <td data-label="Category" class="text-uppercase">'.$row['category'].'</td>
                <td data-label="Stock" class="text-uppercase">'.$row['minimum'].'</td>
                <td data-label="Stock" class="text-uppercase">'.$row['date'].'</td>

                <td class="wid">
                    <a style="text-design:none;float:right;margin-right:0px" class="aktyon" href="inventory.php?main_action='.$row['id'].'">
                    <img src="images/action.png" class="pikyur"></a>
                </td>

                <td>
                    <a style="text-design:none;float:right;margin-right:10px" class="delit" id="delit">
                    <img src="images/delete.png" class="pikyur"></a>
                </td>

            </tr>';
        }


        $output .= "
            </tbody>

        </table>
        <script>
        $(document).ready(function(){
            $('.teybol, tbody').on('click','.delit',function(){
           var currow =$(this).closest('tr');
           var col1 =currow.find('td:eq(1)').text();
           var confirmation = confirm('Do you want delete this item: ' + col1 + '?');
           if(confirmation){
             $.ajax({
               url: 'PROCESS.php',
                               method: 'POST',
                               data: {
                                   inventory_Delete:col1
                               },
                               success: function (data) {
                                 alert(col1 + ' successfully deleted');
                                 window.location = 'mainitem.php';

                               }
             });
           }
           });
           });
        </script>
        ";

    echo $output;
}


?>