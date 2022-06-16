<?php
    require_once 'connect.php';
    require_once 'insAction.php';
    if($statu == 'filled up'){
        header("location: viewstatus.php");
    }
    elseif($statu == 'unfilled'){

    }
    else{
        header("location: error404.php");
    }
?>
<!doctype html>
<html lang="en">
  <head>
  <link rel="icon" type="image/png" sizes="16x16" href="images/tubat-logo.jpg">
    <title>JNR Moto Form</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="mycss/form.css">
    <link href="mycss/sidescrollbar.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button{
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
  </head>
  <body>
           <div class="form container">

           <form method="post" id="image_form" enctype="multipart/form-data" autocomplete="off">

            <input type="hidden" name="itemname" value="<?php echo $itemname1; ?>">
            <input type="hidden" name="ref" value="<?php echo $ref1; ?>">
            <input type="hidden" name="customer" value="<?php echo $cus_name1; ?>">
            <input type="hidden" name="totalamount" value="<?php echo $total1; ?>">
            <input type="hidden" name="due_date" value="<?php echo $from2; ?>">

               <div class="row">
                    <div class="col-lg-12 head">
                    <img  class="img" src="images/tubat-logo.jpg" alt="JNR">
                    <header>
                       <span class="jnr">JNR</span> MOTORCYCLE PARTS AND ACCESSORIES
                    </header>
                    <p class="addresss"><?php $address = $mysqli->query("SELECT * FROM tbl_address");
                     $row_address = $address->fetch_array();
                     if(mysqli_num_rows($address) == 0){

                     }
                     else{
                          echo $row_address['address'];
                     }
                    ?></p>

                    <?php $contact = $mysqli->query("SELECT * FROM tbl_contact_number");
                     while($row_contact = $contact->fetch_assoc()): ?>
                     <span class="contact"><?php echo $row_contact['number']; ?></span>
                    <?php endwhile;?>

                    </div>

                    <div class="col-lg-4 firstlayer text-uppercase">
                        <span class="itemnem"><?php echo $itemname1; ?></span>
                    </div>
                    <div class="col-lg-4 firstlayer">
                       <span class="ref">Reference Number: <?php echo $ref1; ?></span>
                    </div>
                    <div class="col-lg-4 firstlayer text-uppercase">

                        <span class="feee"><?php echo $area1; ?>: ₱ <?php echo number_format($fee1, 2); ?></span>

                    </div>
                    <div class="item_info1">
                    <input type="hidden" name="ref" value="<?php echo $ref1; ?>">
                    </div>



                    <div class="teybol col-12">
                        <table>

                            <tr>
                                <td></td>
                                <td>Payment Schedule</td>
                                <td>Amount: ₱ <?php echo number_format($price1, 2); ?></td>
                            </tr>
                            <tr>
                                <td>Down payment</td>
                                <td><?php echo $from; ?></td>
                                <td>₱ <?php echo number_format($price_down, 2); ?></td>
                            </tr>
                            <tr>
                                <td>1st Payment</td>
                                <td><?php echo $from1; ?></td>
                                <td>₱ <?php echo number_format($frst_down, 2); ?></td>
                            </tr>
                            <tr>
                                <td>2nd Payment(Due Date)</td>
                                <td><?php echo $from2; ?></td>
                                <td>₱ <?php echo number_format($second_down, 2); ?></td>
                            </tr>
                            <tr>
                                 <th colspan="2">Total Contract price</th>
                                <th>₱ <?php echo number_format($total1, 2); ?></th>
                            </tr>
                        </table>
                    </div>






                    <div class="col-lg-12 cus_info">
                    <div class="row">
                    <h4 class="col-lg-12"><?php echo $cus_name1; ?></h4>

                        <div class="col-lg-6">
                            <label>Email address:</label>
                            <input type="email" name="mail" id="mail" class="input">
                        </div>
                       <div class="col-lg-6">
                            <label>Contact number:</label>
                            <input type="number" name="contact" id="contact" class="input">
                       </div>
                       <div class="col-lg-6">
                            <label>Permanent Address:</label>
                            <input type="text" name="per_add" id="per_add" class="input">
                       </div>
                        <div class="col-lg-6">
                            <label>Present Address:</label>
                            <input type="text" name="pre_add" id="pre_add" class="input">
                        </div>

                    </div>

                    </div>

                    <div class="col-lg-12 income">
                        <h5 align="center">Source of income</h5>
                        <div class="row">
                        <div class="col-lg-6">
                            <label>Company name:</label>
                            <input type="text" name="com_name" id="com_name" class="input">

                       </div>
                       <div class="col-lg-6">
                            <label>Company Address:</label>
                            <input type="text" name="com_add" id="com_add" class="input">
                       </div>
                       <div class="col-lg-6">
                            <label>Position:</label>
                            <input type="text" name="com_pos" id="com_pos" class="input">
                       </div>
                        </div>
                    </div>

                    <div class="col-lg-12 income">
                        <h5 align="center">Home Reference</h5>
                        <div class="row">
                        <div class="col-lg-6">
                            <label>Name 1:</label>
                            <input type="text" name="home_namea" id="home_namea" class="input">

                       </div>
                        <div class="col-lg-6">
                            <label>Name 2:</label>
                            <input type="text" name="home_nameb" id="home_nameb" class="input">

                       </div>
                       <div class="col-lg-6">
                            <label>Contact number 1:</label>
                            <input type="number" name="home_contacta" id="home_contacta" class="input">
                       </div>
                         <div class="col-lg-6">
                            <label>Contact number 2:</label>
                            <input type="number" name="home_contactb" id="home_contactb" class="input">
                       </div>
                       <div class="col-lg-6">
                            <label>Relationship 1:</label>
                            <input type="text" name="home_rela" id="home_rela" class="input">
                       </div>


                       <div class="col-lg-6">
                            <label>Relationship 2:</label>
                            <input type="text" name="home_relb" id="home_relb" class="input">
                       </div>
                        </div>
                    </div>

                    <div class="col-lg-12 income">
                        <h5 align="center">Work Reference</h5>
                        <div class="row">
                        <div class="col-lg-6">
                            <label>Name 1:</label>
                            <input type="text" name="work_namea" id="work_namea" class="input">

                       </div>
                        <div class="col-lg-6">
                            <label>Name 2:</label>
                            <input type="text" name="work_nameb" id="work_nameb" class="input">

                       </div>
                       <div class="col-lg-6">
                            <label>Contact number 1:</label>
                            <input type="number" name="work_contacta" id="work_contacta" class="input">
                       </div>
                         <div class="col-lg-6">
                            <label>Contact number 2:</label>
                            <input type="number" name="work_contactb" id="work_contactb" class="input">
                       </div>
                       <div class="col-lg-6">
                            <label>Relationship 1:</label>
                            <input type="text" name="work_rela" id="work_rela" class="input">
                       </div>


                       <div class="col-lg-6">
                            <label>Relationship 2:</label>
                            <input type="text" name="work_relb" id="work_relb" class="input">
                       </div>
                        </div>
                    </div>

                    <div class="col-lg-12 picture">
                    <div class="row">


                        <div class="rowss">
                        <label class="lbl">Picture of yourself</label>
                            <input type="file" name="form_file" id="form_file" />
                            <div id="uploadForm" class="">
                            </div>

                        </div>

                        <div class="rows">
                        <label class="lbl">Lincense ID picture</label>
                            <input type="file" name="form_file1" id="form_file1" />
                            <div id="uploadForm1">
                            </div>
                        </div>

                        <div class="rows">
                        <label class="lbl">Goverment ID picture</label>
                            <input type="file" name="form_file2" id="form_file2" />
                            <div id="uploadForm2">
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="agreement">
                        <div class="row">
                            <div class="col-lg-6">
                                <p>
                                    *This Item are approved for <span style="color:#dd0000">31</span> days terms must be paid on or before <span style="color:#dd0000"><?php echo $from2; ?></span>.
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <p>
                                    *5% penalty will be charge in case of payment failure.
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <p>
                                    *Damage item due to buyer's mishanding will not be subjected for replacement.
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <p>
                                    *Two times payment failure is a ground for item repossession.
                                </p>
                            </div>
                        </div>




                       <input type="checkbox" class="checkbox" id="checkbox" onclick="disable(this)">I agree
                    </div>
                    <br>
                    <br>

                    <div class="col-lg-12 banks">
                    <?php
                    $result13 = $mysqli->query("SELECT * FROM tbl_bank");
                    while($row = $result13->fetch_assoc()): ?>
                        <span class="span2"><?php echo $row['bank_name'];?>:  <?php echo $row['account_num'];?></span>
                    <?php endwhile; ?>
                    </div>

                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-success float-right" value="Submit" disabled="disabled" name="submit" id="submit-btn">


                    </div>
                    </form>

               </div>
           </div>
                        <p id="lol"></p>
    <script>

         $(document).ready(function(){
            $('#image_form').submit(function(event){
                event.preventDefault();
                document.getElementById('submit-btn').disabled = true;
                var a = document.getElementById('per_add').value;
                var b = document.getElementById('pre_add').value;


                var c = document.getElementById('contact').value;
                var d = document.getElementById('com_name').value;
                var e = document.getElementById('com_add').value;
                var f = document.getElementById('com_pos').value;


                var g = document.getElementById('home_namea').value;
                var h = document.getElementById('home_contacta').value;
                var i = document.getElementById('home_rela').value;
                var j = document.getElementById('home_nameb').value;
                var k = document.getElementById('home_contactb').value;
                var l = document.getElementById('home_relb').value;
                var m = document.getElementById('work_namea').value;
                var n = document.getElementById('work_nameb').value;
                var o = document.getElementById('work_contactb').value;
                var p = document.getElementById('work_relb').value;
                var q = document.getElementById('work_contacta').value;
                var r = document.getElementById('work_rela').value;
                var s = document.getElementById('mail').value;
                var image_name = $('#form_file').val();
                var image_name1 = $('#form_file1').val();
                var image_name2 = $('#form_file2').val();
                if( a !='' && b !='' && c !='' && d !='' && e !='' && f !='' && g !='' && h !='' &&
                    i  !='' && j !='' && k !='' && l !='' && m !='' && n !='' && o !='' && p !='' && q !='' && r !='' &&
                    s !='' && image_name !='' && image_name1 !='' && image_name2 !='')
                {
                            var extension = $('#form_file').val().split('.').pop().toLowerCase();
                            var extension1 = $('#form_file1').val().split('.').pop().toLowerCase();
                            var extension2 = $('#form_file2').val().split('.').pop().toLowerCase();
                            if(jQuery.inArray(extension, ['jpg','jpeg']) == -1 || jQuery.inArray(extension1, ['jpg','jpeg']) == -1 || jQuery.inArray(extension2, ['jpg','jpeg']) == -1)
                            {
                                alert("Invalid Image File. The extension of the image should be 'JPG' or 'JPEG'");
                                document.getElementById('submit-btn').disabled = false;
                                return false;
                            }
                            else{
                                alert('We are gonna send your reference number and more information. Please click "ok" to continue');
                                $.ajax({
                                url:"insAction.php",
                                method:"POST",
                                data:new FormData(this),
                                contentType:false,
                                processData:false,
                                success:function(data)
                                {
                                  alert("Account successfuly created, Check your email for more information");
                                  window.location = 'viewstatus.php';
                                }
                                });
                            }


                }
                else
                {
                      alert("Complete the form");
                      document.getElementById('submit-btn').disabled =false;
                      return false;
                }



        });
    });



        function disable(checkbox){
            var button = document.getElementById('submit-btn');
            button.disabled=checkbox.checked ? false : true;
            if(!button.disabled){
                button.focus();
            }
        }
        function filePreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#uploadForm + img').remove();
                    $('#uploadForm').after('<img src="'+e.target.result+'"/> id="lol"');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        function filePreview1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#uploadForm1 + img').remove();
                    $('#uploadForm1').after('<img src="'+e.target.result+'" id="lol1" width="450" height="300"/>');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        function filePreview2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#uploadForm2 + img').remove();
                    $('#uploadForm2').after('<img src="'+e.target.result+'" id="lol2" width="450" height="300"/>');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#form_file").change(function () {
            filePreview(this);
        });
        $("#form_file1").change(function () {
            filePreview1(this);
        });
        $("#form_file2").change(function () {
            filePreview2(this);
        });
    </script>
 <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>