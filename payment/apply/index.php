<?php 
//echo "hello world"; die();

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);


include("config.php");
if(!isset($_REQUEST['invid'])){
	  header("location:http://convocation.du.ac.bd/convocation");
}
$invoiceID=$_REQUEST['invid'];
$sql=mysqli_query($con,"SELECT * FROM invoice WHERE invoice_id='$invoiceID'");
$count=mysqli_num_rows($sql);
if($count<1){
	 header("location:http://convocation.du.ac.bd/convocation");
}
$rows=mysqli_fetch_assoc($sql); 

$totalPayableAmount=$rows['total_amount'];
$InVoiceID=$rows['invoice_id'];
if($rows['payment_status']==1){
  header("location:http://convocation.du.ac.bd/convocation");
} else{
$amount_details=$rows['amount_datail'];	
$jData=(!empty($amount_details))?json_decode($amount_details,true):'';

?>
<script src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" 
                    crossorigin="anonymous"></script>
<script src="extra/jquery-ui.js"></script>
<script>
   function fnc_back_to_home()
   {
    window.location='http://convocation.du.ac.bd/convocation';
   }
</script>
<section>
    <div class="container">
      <div class="row">
       <div class="container">
      <br/><br/>
      <?php //include("process/uppermenu.php"); ?>  
       <div class="col-md-12" style="padding:0px; margin:0px;">
         <div class="widget">
              
 <p align="right"><button type="button" onclick="fnc_back_to_home()" class="btn btn-warning">Back to Home</button></p>
 
         
     <div class="panel panel-primary">
        
          <div class="panel-heading">
            <h3 class="panel-title" style="color:white;">Name:  <?php echo $rows['applicant_name']; ?></h3>
          </div>
       
          <div class="panel-body">
 
         <?php if($rows['payment_status']==1){ ?>
            <div class="alert alert-success warning_big" style="text-align:left;">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button> <strong>
              <span style="color: red;"> <h1>আপনার পেমেন্ট- টি সফলভাবে সম্পন্ন হয়েছে।</span>   </strong></h1>
             
            </div>
         
         <?php } else { ?>
            <div class="alert alert-warning warning_big" style="text-align:left;">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button> <strong>
              <span style="color: red;"><u> কিভাবে বিকাশ এবং সোনালী ব্যাংকের সোনালী সেবার মাধ্যমে পেমেন্ট করবেন </u></span>   </strong><br/><br/>
                
              <h4 style="font-size: 15px; font-weight: bolder; color:red;">bKash-এর মাধ্যমে  পেমেন্ট প্রক্রিয়া  :</h4>              
                        
              <ul style="text-align:left; font-size:15px; list-style: none;" >
                      <li>১) প্রথমে  bKash Logo বাটনে ক্লিক করুন।  </li>
                      <li>২)  স্ক্রিনে আপনার বিকাশ একাউন্টের নাম্বার দিন এবং শর্তাবলীতে সম্মতি দিয়ে পরবর্তী ধাপে যান ।  </li>
                      <li>৩) বিকাশ আপনার একাউন্ট নাম্বারে ৬ সংখ্যার একটি ভেরিফিকেশন কোড পাঠাবে। কোডটি পেমেন্ট স্ক্রিনে দিয়ে পরবর্তী ধাপে যান ।    </li>
                      <li>৪) এরপর আপনার বিকাশ একাউন্টের পিন দিন এবং পেমেন্ট <span style="color: red;"><?php echo eng2bnNumber(number_format($rows['total_amount'],2)); ?> টাকা </span> সম্পন্ন করুন। পেমেন্ট সফল হবার সাথে সাথেই আপনি একটি কনফার্মেশন এসএমএস পাবেন এবং আপনি নিবন্ধন প্রক্রিয়ার ৪র্থ ধাপে পৌছে যাবেন।       </li>
                      <li>৫)  ৪র্থ ধাপে আপনি ফি জমাদানের রশিদের PDF ডাউনলোড করতে পারবেন যা পরবর্তী ধাপে ব্যবহার করতে হবে। </li>
              </ul>


              <h3 style="font-size: 15px; font-weight: bolder; color:red;">সোনালী ব্যাংকের সোনালী সেবার মাধ্যমে পেমেন্ট প্রক্রিয়া  :</h3>  
                <ul style="text-align:left; font-size:15px; list-style: none;" >
                      <li>১) প্রথমে  Sonali Bank Logo বাটনে ক্লিক করুন।   </li>
                      <li>২) একটি পে-স্লিপ জেনারেট হবে।  পে-স্লিপ টি ডাউনলোড করুন।  ডাউনলোডকৃত  পে-স্লিপ  টি  প্রিন্ট নিয়ে সোনালী ব্যাংকের যে কোন শাখার  (ঢাকা বিশ্ববিদ্যালয় শাখা ব্যতিত)  আগামী ১৯-০৮-২০১৯ তারিখ সোমবার ব্যাংকিং সময়ের মধ্যে  <span style="color: red;"><?php echo eng2bnNumber(number_format($rows['total_amount'],2)); ?> টাকা </span> জমা দিতে হবে।
                      </li>
                      <li>৩)   ব্যাংকে ফি  জমা দেয়ার দুই কার্যদিবসের মধ্যে স্বয়ংক্রিয়ভাবে আপনি নিবন্ধন প্রক্রিয়ার ৪র্থ ধাপে পৌছে যাবেন।   </li>
					  <li>৪) নিবন্ধনের পরবর্তী ধাপে ব্যবহারের জন্য পে-স্লিপের আবেদনকারীর অংশটি  <span style="color:blue"> (Applicant's Copy) </span> যত্ন সহকারে সংরক্ষণ করুন।  </li>
              </ul>            
                       
            </div>
          <?php } ?>
            
            <table class="table table-striped table-bordered table-hover table-responsive">
                           
                         
                           <tr>
                             <th style="color:orange;" colspan='2'>Please note down your Invoice No.  for future reference.</th>
                           </tr>
                          
                            <tr>
                             <th style="color:white; background:blue;" colspan='2'>Invoice Info.</th>
                            </tr>
							
                           <tr>
                              <th>Invoice No.</th>
                              <th><?php echo $rows['invoice_id']; ?></th>
                           </tr>
						   <?php
							foreach ($jData as $vals)
							{
							?>
							<tr>
								<td style="font-size:15px; font-weight:bolder; "> <?php echo $vals['head']; ?></td>
								<td style="font-size:15px; font-weight:bolder;"> <?php echo $vals['fees']; ?>.00 </td>
							</tr>

							<?php } ?>
                           <tr>
                              <th style="font-size:15px;">Total Payable  Amount</th>
                              <th style="font-size:20px;">BDT <?php echo $rows['total_amount']; ?> </th>
                           </tr>
                       
                         
                        </table>
             <div class=" table-responsive">  
           
            <?php if($rows['payment_status']==0){ ?>
            <table class="table table-striped table-bordered table-hover">
              <tr>
                <td align='center' style='color:red;' width="50%">
                    <b> Click here for bKash Payment <b/> <br/>
                    <button id="bKash_button"  style=' border-radius:3px;'><img src="bkashpay.gif" style='width:150px; height:80px;'/></button>
                    <br/>
                      Transaction Fee :  <?php echo number_format(20,2); ?>
                 </td>
              <td align='center' style='color:red;' width="50%">
               <b> Click here to Download Sonali Bank (Sonali Sheba) Pay Slip. <b/> <br/>
              <a href="pdf/sblpayslip.php?pslip=<?php echo $_REQUEST['invid']; ?>" target="_blank"><button id=""  style=' border-radius:3px;'><img src="sbl.jpg" style='width:150px; height:80px;'/></button></a>
               <br/> <br/>
                 Transaction Fee :  <?php echo number_format(20,2); ?>

                 </td>
               

              </tr>
            </table>
          <?php } ?>
            
              <input type="hidden" name="amount" id="amount" value="<?php echo $totalPayableAmount ?>"/>
              <input type="hidden" name="aid" id="aid" value="<?php echo $InVoiceID; ?>"/>
     
                 </div>
         </div>
      </div>
     </div>
  </div>
  </div>
</section>
<?php } ?>
<script type="text/javascript">
$(document).ready(function () {
            //Token
            $.ajax({
                        url: "process/token.php",
                        type: 'POST',
                        contentType: 'application/json',
                      //  data: JSON.stringify(request),
                        success: function (data) {
                            // alert('inside success : create mandate() :; bKash-direct-old.js');
                            console.log('got data from token  ..');
                        //    console.log('data ::=>');
                        //   console.log(data);
                        }
                    });
            //Token

            var paymentConfig= {
            createCheckoutURL: "process/createpayment.php",
            executeCheckoutURL: "process/executepayment.php",
            };


            var paymentRequest;
            paymentRequest = { amount: $('#amount').val(), invoice: $('#aid').val() };

            bKash.init({

                paymentMode: 'checkout',

                paymentRequest: paymentRequest,


                createRequest: function (request) {
                    if($('#aid').val()==0 ||$('#aid').val()==null){
                        
                        alert('Error: Invoice No. empty!'); 
                        window.location.href = "index.php";
                        return false;
                    }else{
                    //$('#bKash_button').html("<h5>Payment Processing...</h5>");
                    
                    console.log('=> createRequest (request) :: ');
                    console.log(request);


                    $.ajax({
                        url: paymentConfig.createCheckoutURL+"?amount="+paymentRequest.amount+"&invoice="+paymentRequest.invoice,
                        type: 'GET',
                        contentType: 'application/json',
                       // data: JSON.stringify(request),

                        success: function (data) {

                            // alert('inside success : create mandate() :; bKash-direct-old.js');
                            console.log('got data from create  ..');
                            console.log('data ::=>');
                            console.log(JSON.parse(data).paymentID);
                            data = JSON.parse(data);
                            if (data && data.paymentID != null) {
                                paymentID = data.paymentID;
                                bKash.create().onSuccess(data);
                           // console.log('data accepted');        
                            } else {
                                alert(data.merchantInvoiceNumber);
                                bKash.create().onError();//run clean up code
                              //  console.log('data not accepted');
                            }
                        },
                        error: function () {
                            bKash.create().onError();//run clean up code

                        }
                    });
                  };
                },
                executeRequestOnAuthorization: function () {

                    console.log('=> executeRequestOnAuthorization');
                    $.ajax({
                        url: paymentConfig.executeCheckoutURL+"?paymentID="+paymentID,
                        type: 'GET',
                        contentType: 'application/json',
                        // data: JSON.stringify({ "paymentID": paymentID }),

                        success: function (data) {

                            console.log('got data from execute  ..');
                            console.log('data ::=>');
                            console.log(JSON.stringify(data));
                            data = JSON.parse(data);
                            if (data && data.paymentID != null) {
                                
                                 //alert('[SUCCESS] data : ' + JSON.stringify(data));
                                  window.location.href = "http://convocation.du.ac.bd/convocation";

                            } else {
                                alert('Error : ' + data.errorMessage);
                                bKash.execute().onError();//run clean up code
                            }
                        },
                        error: function () {
                            bKash.execute().onError();//run clean up code
                        }
                    });
                }
            });
        });


</script>

