<?php 
 $mysqli = new mysqli('localhost', 'root', '', 'jnr_moto') or die(mysqli_error($mysqli));
 $connection = new mysqli('localhost', 'root', '', 'jnr_moto');
 $connect = mysqli_connect("localhost", "root", "", "jnr_moto");

//PENALTY INSTALLMENT
$installment_date_now = date('Y-m-d');
$installment_date_now = strtotime($installment_date_now);

$installment_penalty = $mysqli->query("SELECT * FROM tbl_installmentaccount");
  while($row_penalty = $installment_penalty->fetch_assoc()){
    $bal = $row_penalty['balance'];
    $ref = $row_penalty['referrence_number'];
    $penalty_fee = $row_penalty['penalty_fee'];

    $due_date = $row_penalty['due_date'];
    $due_date = strtotime($due_date);

    $penalty_date = $row_penalty['penalty_date'];
    $penalty_date = strtotime($penalty_date);

    $total_amount = $row_penalty['total_amount'];// contract price
    $status_penalty = $row_penalty['statuss'];
    $total_with_penalty = $row_penalty['total'];// balance + fee
   
   

          if($status_penalty == "balance")
          {
            if($installment_date_now > $due_date)
            {
                $feee = $total_amount * 0.05;
                $total = $total_amount + $feee;
                $bal = $bal + $feee;

                $date_now = date('Y-m-d');
                $to_penalty = date('Y-m-d', strtotime($date_now . "+ 15 days"));

                $mysqli->query("UPDATE tbl_installmentaccount SET penalty_date = '$to_penalty', balance = $bal, statuss = 'penalty', penalty_fee = $feee, total = $total 
                WHERE referrence_number ='$ref'");
            }
          }

          if($status_penalty == "penalty")
          {
                if($installment_date_now > $penalty_date){
                    $feee = $total_amount * 0.05;
                    $total = $total_with_penalty + $feee;
                    $bal = $bal + $feee;

                    $feee = $penalty_fee + $feee;

                    $date_now = date('Y-m-d');
                    $to_penalty = date('Y-m-d', strtotime($date_now . "+ 15 days"));
    
                    $mysqli->query("UPDATE tbl_installmentaccount SET penalty_date = '$to_penalty', balance = $bal, statuss = 'penalty', penalty_fee = $feee, total = $total 
                    WHERE referrence_number ='$ref'");
                }
            }
    }
//END

// search for freebies
if (isset($_POST['search2_free'])) {
  $q1_free = $connection->real_escape_string($_POST['q1_free']);

    $sql = $connection->query("SELECT name FROM tbl_inventory WHERE name LIKE '%$q1_free%' AND category = 'freebies' AND stock > 0");
    if ($sql->num_rows > 0) {
      $response_free = "
      <div class='serthayt' id='hiddeee'>
        <ul class='ull_free'>";

      while ($data = $sql->fetch_array())
        $response_free .= "<li id='li_free' class='lii_free'>" . $data['name'] . "</li>";

      $response_free .= "
        </ul>
      </div>";
    }
    else{
      $response_free = "
      <div class='serthayt' id='hiddeee'>
        <ul class='ull_free'><li class='lii_free'>No records to show</li></ul>
      </div>";
    }
    exit($response_free);
}

//SEARCH FOR ITEM IN INSTALLMENT FORM
if (isset($_POST['search'])) {
    $q = $connection->real_escape_string($_POST['q']);

      $sql = $connection->query("SELECT name FROM tbl_inventory WHERE name LIKE '%$q%' AND category != 'freebies' AND stock > 0");
      if ($sql->num_rows > 0) {
        $response = "<div class='serthayt' id='hidde'><ul class='ull'>";

        while ($data = $sql->fetch_array())
          $response .= "<li id='li' class='lii'>" . $data['name'] . "</li>";

        $response .= "</ul>
        </div>";
      }
      else{
        $response = "<div class='serthayt' id='hidde'>
        <ul class='ull'><li class='lii'>No records to show</li></ul>
        </div>";
      }
      exit($response);
}



//SEARCH FOR LOCATION IN INSTALLMENT FORM
if (isset($_POST['search1'])) {
  $zx = $connection->real_escape_string($_POST['z']);

  $sql = $connection->query("SELECT area FROM tbl_area WHERE area LIKE '%$zx%'");
  if ($sql->num_rows > 0) {
    $response = "<div class='serthaytt' id='hiddee'><ul class='ulll'>";

    while ($data = $sql->fetch_array())
      $response .= "<li id='lii' class='liii'>" . $data['area'] . "</li>";

    $response .= "</ul>
    </div>";
  }
  else{
    $response = "<div class='serthaytt' id='hiddee'>
  <ul class='ulll'><li class='liii'>No location to show</li></ul></div>";

  }


  exit($response);
}




?>