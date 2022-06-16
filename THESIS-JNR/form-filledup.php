<?php 
    require_once 'connect.php';
    require_once 'insAction.php';
?>
<!doctype html>
<html lang="en">
  <head>
  <link rel="icon" type="image/png" sizes="16x16" href="images/tubat-logo.jpg">
    <title>JNR Moto Form</title>
    <meta charset="utf-8">
    <link href="mycss/sidescrollbar.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="mycss/form-filledupa.css" media="screen">
    <link rel="stylesheet" href="mycss/form-filledups-print.css" media="print">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="mycss/loading.css">
    <style>
        p{
            color:#1b1b1b;
            font-weight:500;
            text-transform:uppercase;
            padding-left:15px
        }
        @media print{
            body * {
                visibility:hidden;
            }
            .div_to_print, .div_to_print *{
                visibility:visible;
            }
        }
    </style>


  </head>
  <body>

           <div class="form container div_to_print">
               <div class="row">
                    <div class="col-lg-12 head">
                    <img  class="img" src="images/tubat-logo.jpg" alt="JNR" id="print"  onclick="window.print();">
                    <header>
                        <span class="jnr">JNR</span> MOTORCYCLE PARTS AND ACCESSORIES
                    </header>

                    <h5 class="add"><?php $address = $mysqli->query("SELECT * FROM tbl_address"); 
                    if(mysqli_num_rows($address) == 0){

                    }
                    else{
                        $row_address = $address->fetch_array();
                        echo $row_address['address'];
                    }
                    ?>
                     </h5>
                    
                    


                    <?php $contact = $mysqli->query("SELECT * FROM tbl_contact_number");
                     while($row_contact = $contact->fetch_assoc()): ?>
                     <span class="contact"><?php echo $row_contact['number']; ?></span>
                    <?php endwhile;?>
                    </div>


                    <div class="row" id="hays">
                    <h4 class="col-lg-12 hed2"><?php echo $cus_name1; ?></h4>

                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Email address: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $maill; ?></span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-lg-6">
                        <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Contact number: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $contact1; ?></span>
                                </div>
                            </div>
                        
                            
                        </div>
                        <div class="col-lg-6">
                        <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Permanent Address: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"> <?php echo $per_address; ?></span>
                                </div>
                            </div>
                        
                        
                        </div>
                        <div class="col-lg-6">
                        <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Present Address: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $pre_address; ?></span>
                                </div>
                            </div>
                            
                        </div>

                        </div>
                    </div>
                    <div class="row">
                    <div class="col-4 firstlayer text-uppercase">
                        <span class="itemnem"><?php echo $itemname1; ?></span>
                    </div>
                    <div class="col-4 firstlayer">
                       <span class="ref">Reference Number: <?php echo $ref1; ?></span>
                    </div> 
                    <div class="col-4 firstlayer text-uppercase">
                   
                        <span class="feee"><?php echo $area1; ?>: ₱ <?php echo number_format($fee1, 2); ?></span>
                       
                    </div>
                    <div class="item_info1">
                    <input type="hidden" name="ref" value="<?php echo $ref1; ?>">
                    </div>
                    <div class="margin1"></div>


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
                                <td>₱ <?php echo number_format( $frst_down, 2); ?></td>
                            </tr>
                            <tr>
                                <td>2nd Payment</td>
                                <td><?php echo $from2; ?></td>
                                <td>₱ <?php echo number_format($frst_down, 2); ?></td>
                            </tr>
                            <tr>
                                <th colspan="2">Total Contract price</th>
                                <th>₱ <?php echo number_format($total1, 2); ?></th>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="agreement1">
                    <div class="row">
                            <div class="col-lg-6">
                                <p>
                                    *This Item are approved for <span class="datee">31</span> days terms must be paid on or before <spa class="datee"><?php echo $from2; ?></span>.
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
                    </div>
                    <div class="col-lg-12 head2" style="margin-top:150px">
                    <img  class="img" src="images/tubat-logo.jpg" alt="JNR" id="print"  onclick="window.print();">
                    <header>
                        <span class="jnr">JNR</span> MOTORCYCLE PARTS AND ACCESSORIES
                    </header>

                    <h5 class="add"><?php $address = $mysqli->query("SELECT * FROM tbl_address"); 
                    if(mysqli_num_rows($address) == 0){

                    }
                    else{
                        $row_address = $address->fetch_array();
                        echo $row_address['address']; 
                    }
                    ?>
                     </h5>
                    
                    


                    <?php $contact = $mysqli->query("SELECT * FROM tbl_contact_number");
                     while($row_contact = $contact->fetch_assoc()): ?>
                     <span class="contact"><?php echo $row_contact['number']; ?></span>
                    <?php endwhile;?>
                    </div>



                    


                    <div class="col-lg-12 cus_info">
                    <br>
                    <div class="row">
                    <h4 class="col-lg-12 hed"><?php echo $cus_name1; ?></h4>

                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Email address: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $maill; ?></span>
                                </div>
                            </div>
                            
                        </div>
                       <div class="col-lg-6">
                       <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Contact number: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $contact1; ?></span>
                                </div>
                            </div>
                           
                            
                       </div>
                       <div class="col-lg-6">
                       <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Permanent Address: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"> <?php echo $per_address; ?></span>
                                </div>
                            </div>
                          
                           
                       </div>
                        <div class="col-lg-6">
                        <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Present Address: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $pre_address; ?></span>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                     
                    </div>

                    <div class="col-lg-12 income">
                        <h5 class="hed">Source of income</h5>
                        <div class="row">
                        <div class="col-lg-6">
                        <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Company name: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $comp_name; ?></span>
                                </div>
                            </div>
                          
                            
                       </div>
                       <div class="col-lg-6">
                       <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Company Address: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $comp_address; ?></span>
                                </div>
                            </div>
                            
                       </div>
                       <div class="col-lg-6">
                       <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Position: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $comp_position; ?></span>
                                </div>
                            </div>
                            
                       </div>
                        </div>
                    </div>

                    <div class="col-lg-12 income">
                        <h5 class="hed">Home Reference</h5>
                        <div class="row">
                        <div class="col-lg-6">
                        <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Name: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $home_namea; ?></span>
                                </div>
                            </div>
                           
                            
                       </div>
                        <div class="col-lg-6">
                        <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Name: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $home_nameb; ?></span>
                                </div>
                            </div>
                           
                       </div>
                       <div class="col-lg-6">
                       <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Contact number: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $home_contacta; ?></span>
                                </div>
                            </div>
                            
                       </div>
                         <div class="col-lg-6">
                         <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Contact number: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $home_contactb; ?></span>
                                </div>
                            </div>
                          
                       </div>
                       <div class="col-lg-6">
                       <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Relationship: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $home_relationshipa; ?></span>
                                </div>
                            </div>
                           
                       </div>
                      
                     
                       <div class="col-lg-6">
                       <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Relationship: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $home_relationshipb; ?></span>
                                </div>
                            </div>
                           
                       </div>
                        </div>
                    </div>

                    <div class="col-lg-12 income">
                        <h5 class="hed">Work Reference</h5>
                        <div class="row">
                        <div class="col-lg-6">
                           
                            <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Name: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $work_namea; ?></span>
                                </div>
                            </div>
                       </div>
                        <div class="col-lg-6">
                        
                            <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Name: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $work_nameb; ?></span>
                                </div>
                            </div>
                       </div>
                       <div class="col-lg-6">
                       <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Contact number: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $work_contacta; ?></span>
                                </div>
                            </div>
                           
                       </div>
                         <div class="col-lg-6">
                         <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Contact number: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $work_contactb; ?></span>
                                </div>
                            </div>
                           
                       </div>
                       <div class="col-lg-6">
                       <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Relationship: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $work_rela; ?></span>
                                </div>
                            </div>
                        
                       </div>
                      
                     
                       <div class="col-lg-6">
                       <div class="row">
                                <div class="col-6">
                                    <p class="lbll">Relationship: </p>
                                </div>
                                <div class="col-6 overflow">
                                    <span class="value"><?php echo $work_relb; ?></span>
                                </div>
                            </div>
                        
                       </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 picture">
                    <div class="row">
                       

                        <div class="rowss">
                        <label class="lbl">Picture of yourself</label>
                          
                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($selfie).'" />'; ?>
                           
                        </div>

                        <div class="rows">
                        <label class="lbl">Lincense ID picture</label>
                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($license_pic).'" />'; ?>
                        </div>

                        <div class="rows">
                        <label class="lbl">Goverment ID picture</label>
                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($gov_id_pic).'" />'; ?>
                        </div>
                    </div>       
                    </div>

                    <div class="agreement">
                    <div class="row">
                            <div class="col-lg-6">
                                <p>
                                    *This Item are approved for <span class="datee">31</span> days terms must be paid on or before <spa class="datee"><?php echo $from2; ?></span>.
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
                    </div>


           </div>
           </div>
       
          
                      
 <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>