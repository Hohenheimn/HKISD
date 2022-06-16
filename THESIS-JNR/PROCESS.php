<?php
require_once 'connect.php';
$itemname="";
$measure="";
$stock="";
$minimum="";
$update= false;
$category ="~~SELECT~~";
$companyname ="";
$contactnumber ="";
$address ="";
$brand = "~~SELECT~~";
$profitprice = "";
$save = '';
$unitmeasure = '';
$dagdagstock = 0;
$amount=0;



//FREEBIES
if(isset($_POST["itemname2"]))
 {
    $freebies_price = 0;
    $free_itemname = $_POST['itemname2'];
    $free_pfs101 = $_POST['pfs2'];
    $free_brand = $_POST['brand2'];
    $free_stock101 = $_POST['stock2'];
    $free_minimum = $_POST['minimum2'];
    $free_date = $_POST['dateee2'];
    $free_amount = $_POST['amountt2'];
    $free_unitmeasure = $_POST['unitofmeasure'];

    $free_category = "freebies";

    $count1_item = $mysqli->query("SELECT COUNT(name) AS i FROM tbl_inventory WHERE name='$free_itemname'") or die(mysqli_error($mysqli));
    $count1 =  mysqli_fetch_assoc($count1_item);
    $item_num=$count1['i'];
    if ($item_num >= 1){
        echo "This item (", $free_itemname,") is already registered";
    }
    else{
        $file = addslashes(file_get_contents($_FILES["image2"]["tmp_name"]));
        $mysqli->query("INSERT INTO tbl_inventory (price, unitmeasure, picture, name, category, supplierprice, brand, stock, minimum, date)
        VALUES ('$freebies_price', '$free_unitmeasure', '$file', '$free_itemname', '$free_category', '$free_pfs101', '$free_brand', '$free_stock101', '$free_minimum', '$free_date')")
         or die($mysqli->error);

       $mysqli->query("INSERT INTO tbl_suppliertran (name, quantity, supplierprice, brand, amount, date)
       VALUES ('$free_itemname', '$free_stock101', '$free_pfs101', '$free_brand', '$free_amount', '$free_date')") or die($mysqli->error);

       $mysqli->query("INSERT INTO tbl_expense (name, amount, date) VALUES ('$free_itemname', '$free_amount', '$free_date')");
       echo "Item registered";
    }
 }


if(isset($_GET['free_delete'])){
    $id = $_GET['free_delete'];
    $mysqli->query("DELETE FROM tbl_inventory WHERE id=$id") or die($mysqli->error());
    header("location: freebies.php");
}
if (isset($_GET['free_action'])){
    $id = $_GET['free_action'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM tbl_inventory WHERE id=$id") or die($mysqli->error());
        $row = $result->fetch_array();
        $itemname = $row['name'];
        $brand = $row['brand'];
        $stock = $row['stock'];
        $minimum = $row['minimum'];
        $supplierprice = $row['supplierprice'];
        $unitmeasure = $row['unitmeasure'];
        $priceFreebies = $row['price'];
}

if(isset($_POST['free_update_name'])){

    $free_update_id = $_POST['free_update_id'];
    $free_update_name = $_POST['free_update_name'];
    $free_update_pfs = $_POST['free_update_pfs'];
    $free_update_brand = $_POST['free_update_brand'];
    $free_update_unitofmeasure = $_POST['free_update_unitofmeasure'];
    $free_update_minimum = $_POST['free_update_minimum'];
    $free_update_stock = $_POST['free_update_stock'];
    $free_update_stock1 = $_POST['free_update_stock1'];
    $free_update_amount = $_POST['free_update_amount'];
    $free_update_date = $_POST['free_update_date'];

    $freebies_price = $_POST['freebies_price'];
    if($freebies_price == ''){
        $freebies_price = 0;
    }

    if($free_update_stock == '' || $free_update_stock == 0 && $free_update_date == ''){
        // update changing image
        if(!empty($_FILES["free_update_image"]["tmp_name"]))
        {
            $image = $_FILES['free_update_image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));
            $mysqli->query("UPDATE tbl_inventory SET price ='$freebies_price', stock ='$free_update_stock1',
            name ='$free_update_name',
            supplierprice = '$free_update_pfs',
            brand = '$free_update_brand', minimum = '$free_update_minimum',
            unitmeasure = '$free_update_unitofmeasure', picture = '$imgContent'
            WHERE id = $free_update_id");

        }
        // update no changing image
        else{
            $mysqli->query("UPDATE tbl_inventory SET price ='$freebies_price', stock ='$free_update_stock1', name ='$free_update_name', supplierprice = '$free_update_pfs',
            brand = '$free_update_brand', minimum = '$free_update_minimum',
            unitmeasure = '$free_update_unitofmeasure'
            WHERE id = $free_update_id");

        }
        echo 'UPDATED NO TRANSACTION MADE';
    }
    else{

        if(!empty($_FILES["free_update_image"]["tmp_name"]))
        {
            $image = $_FILES['free_update_image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));
            $mysqli->query("UPDATE tbl_inventory SET price ='$freebies_price', name ='$free_update_name',
            supplierprice = '$free_update_pfs',
            brand = '$free_update_brand', minimum = '$free_update_minimum',
            unitmeasure = '$free_update_unitofmeasure', picture = '$imgContent'
            WHERE id = $free_update_id");

        }
        // update no changing image
        else{
            $mysqli->query("UPDATE tbl_inventory SET price ='$freebies_price', name ='$free_update_name', supplierprice = '$free_update_pfs',
            brand = '$free_update_brand', minimum = '$free_update_minimum',
            unitmeasure = '$free_update_unitofmeasure'
            WHERE id = $free_update_id");

        }

        $select_all = $mysqli->query("SELECT * FROM tbl_inventory WHERE id = $free_update_id");
        $get_stock = $select_all->fetch_array();
        $stock = $get_stock['stock'];
        $new_stock = $stock + $free_update_stock;

        $mysqli->query("UPDATE tbl_inventory SET stock ='$new_stock' WHERE id= $free_update_id") or die($mysqli->error());

        $mysqli->query("INSERT INTO tbl_suppliertran (name, quantity, supplierprice, brand, amount, date) VALUES
        ('$free_update_name', '$free_update_stock', '$free_update_pfs', '$free_update_brand', '$free_update_amount', '$free_update_date')") or die($mysqli->error);

        $mysqli->query("INSERT INTO tbl_expense (name, amount, date) VALUES ('$free_update_name', '$free_update_amount', '$free_update_date')");

        echo 'UPDATED STOCK ADDED';

    }

}

//end

//end PoS
//EXPENSE
if(isset($_POST['addexpense'])){
    $name= $_POST['expense'];
    $mysqli->query("INSERT INTO tbl_addexpense (name) VALUES ('$name')");
    header("location: expense.php");
}
if(isset($_GET['expensedelete'])){
    $id = $_GET['expensedelete'];
    $mysqli->query("DELETE FROM tbl_addexpense WHERE id=$id") or die($mysqli->error());
    header("location: expense.php");
}
if(isset($_POST['examount'])){
    $ako = $_POST['exname'];
    $amount = $_POST['examount'];
    $date= $_POST['exdate'];
    $mysqli->query("INSERT INTO tbl_expense (name, amount, date) VALUES ('$ako', '$amount', '$date')");
}

//END EXPENSE
//MAIN ITEM
if(isset($_POST["uitemname"]))
 {
    $itemname = $_POST['uitemname'];
    $category = $_POST['cat'];
    $invprice = $_POST['ip'];
    $invprice_supplier = $_POST['pfs'];
    $profitprice = $_POST['pop'];
    $brand = $_POST['brand'];
    $stock = $_POST['stock'];
    $minimum = $_POST['minimum'];
    $amount = $_POST['amountt'];
    $date =   $_POST['dateee'];
    $unitmeasure = $_POST['unitofmeasure'];
    $count1_item = $mysqli->query("SELECT COUNT(name) AS a FROM tbl_inventory WHERE name='$itemname'") or die(mysqli_error($mysqli)) or die($mysqli->error);
    $count1 =  mysqli_fetch_assoc($count1_item);
    $item_num=$count1['a'];
    if ($item_num >= 1){
        echo "This item (", $itemname,") is already registered";
    }
    else{
        $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
        $mysqli->query("INSERT INTO tbl_inventory (unitmeasure, picture, name, category, price, supplierprice, brand, stock, minimum, date, profit) VALUES ('$unitmeasure','$file', '$itemname', '$category', '$invprice', '$invprice_supplier', '$brand', '$stock', '$minimum', '$date', '$profitprice')") or die($mysqli->error);
        $mysqli->query("INSERT INTO tbl_suppliertran (name, quantity, supplierprice, brand, amount, date) VALUES ('$itemname', '$stock', '$invprice_supplier', '$brand', '$amount', '$date')") or die($mysqli->error);
        $mysqli->query("INSERT INTO tbl_expense (name, amount, date) VALUES ('$itemname', '$amount', '$date')");
        echo "Item registered";
    }
 }
if(isset($_POST['inventory_Delete'])){
    $name_inv = $_POST['inventory_Delete'];
    $mysqli->query("DELETE FROM tbl_inventory WHERE name = '$name_inv'");
}
if (isset($_GET['main_action'])){
    $id = $_GET['main_action'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM tbl_inventory WHERE id=$id") or die($mysqli->error());
        $row = $result->fetch_array();
        $itemname = $row['name'];
        $invprice = $row['price'];
        $brand = $row['brand'];
        $stock = $row['stock'];
        $minimum = $row['minimum'];
        $supplierprice = $row['supplierprice'];
        $category = $row['category'];
        $profitprice = $row['profit'];
        $unitmeasure = $row['unitmeasure'];
}

if(isset($_POST['update_itemname'])){
    $update_id = $_POST['update_id'];
    $update_category  = $_POST['update_category'];
    $update_itemname  = $_POST['update_itemname'];
    $update_pfs  = $_POST['update_pfs'];
    $update_pop  = $_POST['update_pop'];
    $update_ip  = $_POST['update_ip'];
    $update_brand  = $_POST['update_brand'];
    $update_unitofmeasure  = $_POST['update_unitofmeasure'];
    $update_minimum  = $_POST['update_minimum'];
    $update_stock1  = $_POST['update_stock1'];

    $update_stock  = $_POST['update_stock'];
    $date_update  = $_POST['date_update'];
    $update_amountt  = $_POST['update_amountt'];
    $update_date = date('Y-m-d');

// update with no transaction
    if($update_stock == '' || $update_stock == 0 && $date_update == ''){
        // update changing image
        if(!empty($_FILES["update_image"]["tmp_name"]))
        {
            $image = $_FILES['update_image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));
            $mysqli->query("UPDATE tbl_inventory SET stock = '$update_stock1', name ='$update_itemname', category = '$update_category ', price = '$update_ip', supplierprice = '$update_pfs',
            profit = '$update_pop', brand = '$update_brand', minimum = '$update_minimum', unitmeasure = '$update_unitofmeasure', picture = '$imgContent' WHERE id = $update_id");

        }
        // update no changing image
        else{
            $mysqli->query("UPDATE tbl_inventory SET stock = '$update_stock1', name ='$update_itemname', category = '$update_category ', price = '$update_ip', supplierprice = '$update_pfs',
            profit = '$update_pop', brand = '$update_brand', minimum = '$update_minimum', unitmeasure = '$update_unitofmeasure' WHERE id = $update_id");

        }
        echo 'UPDATED NO TRANSACTION MADE';
    }
// update with transaction
    else{

        if(!empty($_FILES["update_image"]["tmp_name"]))
        {
            $image = $_FILES['update_image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));
            $mysqli->query("UPDATE tbl_inventory SET name ='$update_itemname', category = '$update_category ', price = '$update_ip', supplierprice = '$update_pfs',
            profit = '$update_pop', brand = '$update_brand', minimum = '$update_minimum', unitmeasure = '$update_unitofmeasure', picture = '$imgContent' WHERE id = $update_id");

        }
        // update no changing image
        else{
            $mysqli->query("UPDATE tbl_inventory SET name ='$update_itemname', category = '$update_category ', price = '$update_ip', supplierprice = '$update_pfs',
            profit = '$update_pop', brand = '$update_brand', minimum = '$update_minimum', unitmeasure = '$update_unitofmeasure' WHERE id = $update_id");
        }

        $select_all = $mysqli->query("SELECT * FROM tbl_inventory WHERE id = $update_id");
        $get_stock = $select_all->fetch_array();
        $stock = $get_stock['stock'];
        $new_stock = $stock + $update_stock;


        $mysqli->query("UPDATE tbl_inventory SET stock ='$new_stock', date = '$update_date' WHERE id= $update_id") or die($mysqli->error());

        $mysqli->query("INSERT INTO tbl_suppliertran (name, quantity, supplierprice, brand, amount, date) VALUES
        ('$update_itemname', '$update_stock', '$update_pfs', '$update_brand', '$update_amountt', '$date_update')") or die($mysqli->error);

        $mysqli->query("INSERT INTO tbl_expense (name, amount, date) VALUES ('$update_itemname', '$update_amountt', '$date_update')");
        echo 'UPDATED STOCK ADDED';


    }

}
//CATEGORY
if(isset($_POST['addcategory'])){
    $category = mysqli_real_escape_string($mysqli, $_POST['category']);

    $date =  date("Y-m-d");
    $mysqli->query("INSERT INTO tbl_category (name, date) VALUES ('$category', '$date')");
    header("location: mainitem.php");
}
if(isset($_GET['categorydelete'])){
    $id = $_GET['categorydelete'];
    $mysqli->query("DELETE FROM tbl_category WHERE id=$id") or die($mysqli->error());
    header("location: mainitem.php");
}

//CATEGORY END
//SUPPLIER
if(isset($_POST['deletesupplier'])){
    $id = $_POST['deletesupplier'];
    $mysqli->query("DELETE FROM tbl_supplier WHERE id=$id") or die($mysqli->error());
    header("location: supplier.php");
}
if (isset($_GET['actionsupplier'])){
    $id = $_GET['actionsupplier'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM tbl_supplier WHERE id=$id") or die($mysqli->error());
        $row = $result->fetch_array();
        $companyname = $row['name'];
        $contactnumber = $row['contactnumber'];
        $address = $row['address'];
}
if(isset($_POST['sname'])){
    $names = $_POST['sname'];
    $numbers = $_POST['scontact'];
    $addresss = $_POST['saddress'];
    $count_supplier = $mysqli->query("SELECT * FROM tbl_supplier WHERE name = '$names'");
    if(mysqli_num_rows($count_supplier) >= 1){
        echo "This company is already registered";
    }
    else{
        $mysqli->query("INSERT INTO tbl_supplier (name, contactnumber, address) VALUES ('$names', '$numbers', '$addresss')") or die($mysqli->error);
        echo "Data saved";
    }

}
if(isset($_POST['pname'])){
    $id = $_POST['pid'];
    $companyname = $_POST['pname'];
    $contactnumber = $_POST['pcontact'];
    $address = $_POST['paddress'];
    $mysqli->query("UPDATE tbl_supplier SET name='$companyname', contactnumber='$contactnumber', address='$address' WHERE id=$id") or die($mysqli->error());
    echo "Updated";
}
//END SUPPLIER


?>