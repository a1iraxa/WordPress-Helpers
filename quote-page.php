<?php

/**
 * Template Name: Quote
 */
    get_header();
?>
<div  class="container">
<div class="row">
  <?php
  /* Don't remove this line. */
    require($_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php');
//if "email" variable is filled out, send email
  if (isset($_POST['submit']))  {
    $to = "info@acecarandvanhire.co.uk";
    $subject = "Acecarandvanhire Quote";
    $name = $_POST['qname'];
    $companyname = $_POST['company_name'];
    $TELEPHONE = $_POST['telephone'];
    $from = $_POST['email'];
    $POSTCODE = $_POST['postcode'];
    $AGE_ABOVE25 = $_POST['age'];
    $PICKUP_LOCATION_AIRPORT_CODE = $_POST['location_code'];
    $CATEGORY_OF_VEHICLE = $_POST['cartype'];
    $TYPE_OF_VEHICLE_PREFERRED = $_POST['vehiclepreferred'];
    $pickup_location = $_POST['PICKUPLOCATION'];
    
    //Date and time format
    $pickup_date = date("d-M-Y",strtotime($_POST['pickupdate']));
    $pickup_time = $_POST['pickuphour'];    
    $RETURN_DATE = date("d-M-Y",strtotime($_POST['returndate']));
    $returnhour = $_POST['returnhour'];
    
    $SPECIAL_REQUESTS = $_POST['special_request'];
    $HOW_DID_YOU_FIND_US = $_POST['howfindus'];
    $WHATS_YOUR_BEST_QUOTE_SO_FAR = $_POST['bestquote'];
    
    $message = "Name: ".$name."\n\n COMPANY NAME: ".$companyname."\n\n TELEPHONE: ".$TELEPHONE."\n\n Post Code: ".$POSTCODE."\n\n AGE ABOVE 25: ".$AGE_ABOVE25."\n\n PICKUP LOCATION: ".$pickup_location."\n\n CATEGORY OF VEHICLE: ".$CATEGORY_OF_VEHICLE."\n\n TYPE OF VEHICLE PREFERRED: ".$TYPE_OF_VEHICLE_PREFERRED."\n\n PICKUP DATE: ".$pickup_date."\n\n Pick Up Time: ".$pickup_time."\n\n RETURN DATE: ".$RETURN_DATE."\n\n Return Time: ".$returnhour."\n\n SPECIAL REQUESTS? EG. ONE WAY, ABROAD: ".$SPECIAL_REQUESTS."\n\n HOW DID YOU FIND US: ".$HOW_DID_YOU_FIND_US."\n\n WHATS YOUR BEST QUOTE SO FAR?: ".$WHATS_YOUR_BEST_QUOTE_SO_FAR;
   // $from = "info@acecarandvanhire.co.uk";
    $headers = "From:" . $from;
   mail($to, $subject, $message, $headers);
    //echo "Mail Sent.";
    ?>
        <!--<script>alert('Mail Sent.');</script>-->
        <script>window.location="http://www.acecarandvanhire.co.uk/thank-you/";</script>
    <?php

  }
  else{?> 
    <!--<script>alert('Mail not  Sent.');</script> 
    <script>widow.location="http://www.acecarandvanhire.co.uk/quote";</script>-->
  <?php }
  ?> 
 </div>
 </div> 
    <div class="container">        
        <!-- Row Start -->
        <div class="row">
        <div class="col-md-12">
            <h2>Quote</h2>
            <?php //echo $_SERVER['REQUEST_URI']; ?>
                    <form action="" method="post">
                        <div class="row">
                            
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="vim">NAME:</label>
                                    <input type="text" name="qname" required="required" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="made">COMPANY NAME:</label>
                                    <input type="text" name="company_name"  class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label for="price">TELEPHONE:</label>
                                    <input type="text" class="form-control" name="telephone" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="price">EMAIL ADDRESS:</label>
                                    <input type="email" class="form-control"  required="required" name="email">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="model">AGE ABOVE 25?</label>
                                    <select class="form-control" id="age" name="age" required="required">
                                        <option value="">-SELECT-</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="mileage">PICKUP LOCATION / AIRPORT CODE:</label>
                                    <input type="text" class="form-control" value="<?php echo $_GET['location_code'];?>" name="PICKUPLOCATION" required="required">
                                </div>

                                <div class="form-group">
                                    <label for="model">CATEGORY OF VEHICLE</label>
                                    <?php if(!empty($_GET['cartype'])){?>
                                                <input class="form-control" id="location_code" value="<?php echo $_GET['cartype'];?>" name="cartype" required="required">
                                    <?php }else{?>
                                    <select class="form-control" id="cartype" name="cartype"  required="required">
                                       <option value="">-SELECT-</option>
                                       <option value=" Car Hire" selected="">Car Hire</option>
                                        <option value="Van Hire">Van Hire</option>
                                        <option value="Trailer Hire">Trailer Hire</option>
                                        <option value="Minibus Hire">Minibus Hire</option>
                                        <option value="Recovery Service">Recovery Service</option>
                                    </select> 
                                    <?php }?>  
                                    
                                </div>

                                <div class="form-group">
                                    <label for="mileage">TYPE OF VEHICLE PREFERRED?</label>
                                    <input type="text" class="form-control" id="vehiclepreferred" name="vehiclepreferred">
                                </div>  
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                
                                    <label for="year2">RETURN DATE AND TIME:</label>
                                    <span style="position: relative;">
                             <?php if($_GET['returndate']){?>        
                                    
                            <input type="text" class="form-control date-picker" name="returndate" id="returndate" required="required" value=" placeholder="Month-Day-Year"  <?php echo $_GET['returndate'] ?>" style="width:70% !important; float:left !important;" globalnumber="489">
                     <?php } else{ ?>
                     <input type="text" class="form-control date-picker" id="returndate" name="returndate" required="required"  value="" style="width:70% !important; float:left !important;" globalnumber="489">
                              <?php }?>
                              
                            </span>
           <?php if($_GET['returnhour']){?>
            <input type="text" name="returnhour" value="<?php echo $_GET['returnhour'];?>"  style="width:30% !important;float:right">
          <?php } else{?>
        <select class="form-control" name="returnhour" style="width:30% !important;"  required="required">
        <option value="00:00">00:00</option><option value="00:15">00:15</option><option value="00:30">00:30</option><option value="00:45">00:45</option>
        <option value="01:00">01:00</option><option value="01:15">01:15</option><option value="01:30">01:30</option><option value="01:45">01:45</option>
        <option value="02:00">02:00</option><option value="02:15">02:15</option><option value="02:30">02:30</option><option value="02:45">02:45</option>
        <option value="03:00">03:00</option><option value="03:15">03:15</option><option value="03:30">03:30</option><option value="03:45">03:45</option>
        <option value="04:00">04:00</option><option value="04:15">04:15</option><option value="04:30">04:30</option><option value="04:45">04:45</option>
        <option value="00:00">05:00</option><option value="00:00">05:15</option><option value="05:30">05:30</option><option value="05:45">05:45</option>
        <option value="06:00">06:00</option><option value="06:15">06:15</option><option value="06:30">06:30</option><option value="06:45">06:45</option>
        <option value="07:00">07:00</option><option value="07:15">07:15</option><option value="07:30">07:30</option><option value="07:45">07:45</option>
        <option value="08:00">08:00</option><option value="08:15">08:15</option><option value="08:30">08:30</option><option value="08:45">08:45</option>
        <option value="09:00">09:00</option><option value="09:15">09:15</option><option value="09:30">09:30</option><option value="09:45">09:45</option>
        <option value="10:00">10:00</option><option value="10:15">10:15</option><option value="10:30">10:30</option><option value="10:45">10:45</option>
        <option value="11:00">11:00</option>
        <option value="11:15">11:15</option>
        <option value="11:30">11:30</option>
        <option value="11:45">11:45</option>
        <option value="12:00">12:00</option>
        <option value="12:15">12:15</option>
        <option value="12:30">12:30</option>
        <option value="12:45">12:45</option>
        <option value="13:00">13:00</option>
        <option value="13:15">13:15</option>
        <option value="13:30">13:30</option>
        <option value="13:45">13:45</option>
        <option value="14:00">14:00</option>
        <option value="14:15">14:15</option>
        <option value="14:30">14:30</option>
        <option value="14:45">14:45</option>
        <option value="15:00">15:00</option>
        <option value="15:15">15:15</option>
        <option value="15:30">15:30</option>
        <option value="15:45">15:45</option>
        <option value="16:00">16:00</option>
        <option value="16:15">16:15</option>
        <option value="16:30">16:30</option>
        <option value="16:45">16:45</option>
        <option value="17:00">17:00</option>
        <option value="17:15">17:15</option>
        <option value="17:30">17:30</option>
        <option value="17:45">17:45</option>
        <option value="18:00">18:00</option>
        <option value="18:15">18:15</option>
        <option value="18:30">18:30</option>
        <option value="18:45">18:45</option>
        <option value="19:00">19:00</option>
        <option value="19:15">19:15</option>
        <option value="19:30">19:30</option>
        <option value="19:45">19:45</option>
        <option value="20:00">20:00</option>
        <option value="20:15">20:15</option>
        <option value="20:30">20:30</option>
        <option value="20:45">20:45</option>
        <option value="21:00">21:00</option>
        <option value="21:15">21:15</option>
        <option value="21:30">21:30</option>
        <option value="21:45">21:45</option>
        <option value="22:00">22:00</option>
        <option value="22:15">22:15</option>
        <option value="22:30">22:30</option>
        <option value="22:45">22:45</option>
        <option value="23:00">23:00</option>
        <option value="23:15">23:15</option>
        <option value="23:30">23:30</option>
        <option value="23:45" selected="selected">23:45</option>    
     </select>
           <?php }?>        
                                </div>
                                <div class="form-group">
                                    <label for="year2">SPECIAL REQUESTS? EG. ONE WAY, ABROAD, TOWBAR</label>
                                    <input type="text" class="form-control" name="special_request">
                                </div>
                                <div class="form-group">
                                    <label for="model2">HOW DID YOU FIND US:</label>
                                    <select class="form-control" name="howfindus">
                                        <option>-SELECT-</option>
                                        <option value="Flyer / Word Of Mouth">Flyer / Word Of Mouth</option>
                                        <option value="Google">Google</option>
                                        <option value="Bing">Bing</option>
                                        <option value="AOL">AOL</option>
                                    <option value="Yahoo">Yahoo</option>
                                      <option value="Other Search Engines">Other Search Engines</option>               
<option value="Yell">Yell</option>
<option value="Thomson">Thomson</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">WHATS YOUR BEST QUOTE SO FAR?</label>
                                    <input type="text" class="form-control" name="bestquote">
                                </div>  
                            </div>
                            </div>
                            <div class="row">       
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">POSTCODE:</label>
                                    <input type="text" class="form-control" id="postcode" name="postcode" required="required">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="surname">PICKUP DATE AND TIME:</label>
                                    <span style="position: relative;">
                                   <?php if($_GET['pickupdate']){?>
                                    <input type="text" name="pickupdate" id="pickupdate" class="form-control date-picker"   required="required" value="<?php echo $_GET['pickupdate']?>" style="width:70% !important; float:left !important;">
                                    <?php } else { ?> 
                                <input type="text"  name="pickupdate" id="pickupdate" class="form-control date-picker"  required="required" style="width:70% !important; float:left !important;"><?php }?></span>
          <?php if($_GET['pickupdate']){?>
            <input type="text" name="pickupdate" value="<?php echo $_GET['pickuphour'];?>"  style="width:30% !important;float:right">
          <?php } else{?>
        <select class="form-control" name="pickuphour" style="width:30% !important;"  required="required">
        <option value="00:00">00:00</option>
        <option value="00:15">00:15</option>
        <option value="00:30">00:30</option>
        <option value="00:45">00:45</option>
        <option value="01:00">01:00</option>
        <option value="01:15">01:15</option>
        <option value="01:30">01:30</option>
        <option value="01:45">01:45</option>
        <option value="02:00">02:00</option>
        <option value="02:15">02:15</option>
        <option value="02:30">02:30</option>
        <option value="02:45">02:45</option>
        <option value="03:00">03:00</option>
        <option value="03:15">03:15</option>
        <option value="03:30">03:30</option>
        <option value="03:45">03:45</option>
        <option value="04:00">04:00</option>
        <option value="04:15">04:15</option>
        <option value="04:30">04:30</option>
        <option value="04:45">04:45</option>
        <option value="00:00">05:00</option>
        <option value="00:00">05:15</option>
        <option value="05:30">05:30</option>
        <option value="05:45">05:45</option>
        <option value="06:00">06:00</option>
        <option value="06:15">06:15</option>
        <option value="06:30">06:30</option>
        <option value="06:45">06:45</option>
        <option value="07:00">07:00</option>
        <option value="07:15">07:15</option>
        <option value="07:30">07:30</option>
        <option value="07:45">07:45</option>
        <option value="08:00">08:00</option>
        <option value="08:15">08:15</option>
        <option value="08:30">08:30</option>
        <option value="08:45">08:45</option>
        <option value="09:00">09:00</option>
        <option value="09:15">09:15</option>
        <option value="09:30">09:30</option>
        <option value="09:45">09:45</option>
        <option value="10:00">10:00</option>
        <option value="10:15">10:15</option>
        <option value="10:30">10:30</option>
        <option value="10:45">10:45</option>
        <option value="11:00">11:00</option>
        <option value="11:15">11:15</option>
        <option value="11:30">11:30</option>
        <option value="11:45">11:45</option>
        <option value="12:00">12:00</option>
        <option value="12:15">12:15</option>
        <option value="12:30">12:30</option>
        <option value="12:45">12:45</option>
        <option value="13:00">13:00</option>
        <option value="13:15">13:15</option>
        <option value="13:30">13:30</option>
        <option value="13:45">13:45</option>
        <option value="14:00">14:00</option>
        <option value="14:15">14:15</option>
        <option value="14:30">14:30</option>
        <option value="14:45">14:45</option>
        <option value="15:00">15:00</option>
        <option value="15:15">15:15</option>
        <option value="15:30">15:30</option>
        <option value="15:45">15:45</option>
        <option value="16:00">16:00</option>
        <option value="16:15">16:15</option>
        <option value="16:30">16:30</option>
        <option value="16:45">16:45</option>
        <option value="17:00">17:00</option>
        <option value="17:15">17:15</option>
        <option value="17:30">17:30</option>
        <option value="17:45">17:45</option>
        <option value="18:00">18:00</option>
        <option value="18:15">18:15</option>
        <option value="18:30">18:30</option>
        <option value="18:45">18:45</option>
        <option value="19:00">19:00</option>
        <option value="19:15">19:15</option>
        <option value="19:30">19:30</option>
        <option value="19:45">19:45</option>
        <option value="20:00">20:00</option>
        <option value="20:15">20:15</option>
        <option value="20:30">20:30</option>
        <option value="20:45">20:45</option>
        <option value="21:00">21:00</option>
        <option value="21:15">21:15</option>
        <option value="21:30">21:30</option>
        <option value="21:45">21:45</option>
        <option value="22:00">22:00</option>
        <option value="22:15">22:15</option>
        <option value="22:30">22:30</option>
        <option value="22:45">22:45</option>
        <option value="23:00">23:00</option>
        <option value="23:15">23:15</option>
        <option value="23:30">23:30</option>
        <option value="23:45" selected="selected">23:45</option>    
     </select>
     <?php }?>
    </div>
    </div>
    </div>
    <div class="row">
    </div>
        <div class="row">
                                <div class="col-xs-12">
                                    <!--<button type="submit" class="btn info">Send Information</button>-->
                    <input type="submit" name="submit" class="submit" value="Submit">
                                </div>
                            </div>
                        </form>
                       </div>
            </div>
    </div>
<style>
select, textarea, input[type=date], input[type=datetime], input[type=datetime-local], input[type=email], input[type=month], input[type=number], input[type=password], input[type=range], input[type=search], input[type=tel], input[type=text], input[type=time], input[type=url], input[type=week]{
        border: 1px solid #ccc!important;
            background: #f9f9f9!important;
    }
    .page-template-quote-page #main-content{ overflow:visible!important;}
    .form-control{ border-radius:0px;}
    
</style>
<script>
  jQuery(document).ready(function() {
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
    
        jQuery('#returndate').datepicker({
          dateFormat: 'mm-dd-yy',
          startDate: today
        });
    
        jQuery('#pickupdate').datepicker({
          dateFormat: 'mm-dd-yy',
          startDate: today
        });
    
    });
</script>
<?php
get_footer();
