$(document).ready(function(e) {
		
		 $("#ssc_cgpa").attr('disabled','disabled');     
		 $("#hsc_cgpa").attr('disabled','disabled'); 
		 $("#ug_cgpa").attr('disabled','disabled'); 
		 $("#pg_cgpa").attr('disabled','disabled'); 
		 $("#others_cgpa").attr('disabled','disabled'); 
		 $("#ssc_out_of").attr('disabled','disabled');     
		 $("#hsc_out_of").attr('disabled','disabled'); 
		 $("#ug_out_of").attr('disabled','disabled'); 
		 $("#pg_out_of").attr('disabled','disabled'); 
		 $("#others_out_of").attr('disabled','disabled'); 
		 	
		
		
		$(".datepicker2").datepicker({
			dateFormat: 'yy-mm-dd',
			changeYear: true,
			changeMonth: true,
			yearRange: "1950:2017",
			
			
		});
	
	 $('#image_uploder').change( function( e ){
		$('#photo').html('<img src="images/ajax_loader.gif" />');
		$.ajax({
			url: 'picture/photo_uploder.php',
			type: 'POST',
			data: new FormData( this ),
			processData: false,
			contentType: false,
			success: function(data) 
			{
			 if(data==6){ alert('Sorry, only JPG, JPEG & PNG files are allowed.'); $('#photo').html('Sorry, only JPG, JPEG & PNG files are allowed.'); return;}
			 if(data==5){
				   alert('Photo Invalid! Photo must be 300 X 300 pixel (width X height) and file size not more than 100KB.');
				   $('#photo').html('Photo Invalid! Photo must be 300 X 300 pixel <br/>(width X height) and file size not more than 100KB.');
				   return;
				 }
				 else{
			       $('#photo').html('<img src="picture/'+data+'" style="width:150px; height:160px; border: 1px solid gray;" />');
				   //alert('Successfull Uploded.');
				   //$('#photo').html('<font color="green">Upload Successfully. </font>');
				   $('#picture_file_data').val(data);
				 }
			}
		});
		e.preventDefault();
	  });	
	
	});
	
	
	
function fnc_validator()
 {
		var picture_file_data= document.getElementById('picture_file_data').value;
		if(picture_file_data.length<5){ alert('Warning: Please Upload Photo First.\n\n Photo Invalid! Photo must be 300 X 300 pixel (width X height) and file size not more than 100KB.'); return false; }
		if(fn_validation("applicant_name*fathers_name*mothers_name*year_id*month_id*date_id*mobile*email*blood_group*gender*Meritarial_status*religion*care1*road1*district1*ps1*po1*care2*road2*district2*ps2*po2*ssc_degree*ssc_sub*ssc_board*ssc_equavalate_grade_type*ssc_duration*ssc_passing_year*hsc_degree*hsc_sub*hsc_board*hsc_equavalate_grade_type*hsc_duration*hsc_passing_year*ug_degree*ug_sub*ug_board*ug_equavalate_grade_type*ug_duration*ug_passing_year")==0)return false;

 }




function fnc_ssc_equavalate_grade_type(val)
{

   if(val==4){ $("#ssc_cgpa").removeAttr('disabled'); $("#ssc_cgpa").attr("required", true); }     
   if(val!=4){ $("#ssc_cgpa").attr('disabled','disabled'); $("#ssc_cgpa").attr("required", false);  }     
   if(val==4){ $("#ssc_out_of").removeAttr('disabled');  $("#ssc_out_of").attr("required", true); }     
   if(val!=4){ $("#ssc_out_of").attr('disabled','disabled');  $("#ssc_out_of").attr("required", false); } 
}


function fnc_hsc_equavalate_grade_type(val)
{

   if(val==4){ $("#hsc_cgpa").removeAttr('disabled'); $("#hsc_cgpa").attr("required", true); }     
   if(val!=4){ $("#hsc_cgpa").attr('disabled','disabled');  $("#hsc_cgpa").attr("required", false); }     
   if(val==4){ $("#hsc_out_of").removeAttr('disabled'); $("#hsc_out_of").attr("required", true); }     
   if(val!=4){ $("#hsc_out_of").attr('disabled','disabled'); $("#hsc_out_of").attr("required", false); }
     
}

function fnc_degree_equavalate_grade_type(val)
{

   if(val==4){ $("#ug_cgpa").removeAttr('disabled');  $("#ug_cgpa").attr("required", true);}     
   if(val!=4){ $("#ug_cgpa").attr('disabled','disabled');  $("#ug_cgpa").attr("required", false);}     
   if(val==4){ $("#ug_out_of").removeAttr('disabled'); $("#ug_out_of").attr("required", true); }     
   if(val!=4){ $("#ug_out_of").attr('disabled','disabled'); $("#ug_out_of").attr("required", false); } 
    
}


function fnc_masters_equavalate_grade_type(val)
{

   if(val==4){ $("#pg_cgpa").removeAttr('disabled');  $("#pg_cgpa").attr("required", true); }     
   if(val!=4){ $("#pg_cgpa").attr('disabled','disabled');  $("#pg_cgpa").attr("required", false); }     
   if(val==4){ $("#pg_out_of").removeAttr('disabled');   $("#pg_out_of").attr("required", true);}     
   if(val!=4){ $("#pg_out_of").attr('disabled','disabled');  $("#pg_out_of").attr("required", false); } 
     
}


function fnc_others_equavalate_grade_type(val)
{

   if(val==4){ $("#others_cgpa").removeAttr('disabled'); }     
   if(val!=4){ $("#others_cgpa").attr('disabled','disabled'); }     
   if(val==4){ $("#others_out_of").removeAttr('disabled'); }     
   if(val!=4){ $("#others_out_of").attr('disabled','disabled'); }   
    
}

function checkaccnumber(evt){
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }
    return true;
}



	
function  uperchASE(id) {$("#applicant_name").val(id.toUpperCase()); }
function  uperfname(id) { $("#fathers_name").val(id.toUpperCase());  }
function  upermname(id) { $("#mothers_name").val(id.toUpperCase()); }





function fnc_Upzila_Search_mailing(district1)
{
    $('#upzila_load_1').html('<img src="images/ajax_loader.gif" style="width:20px; height:20px; text-align:center;" />');
	var data ="action=seacrh_upzila_for_dist&district1="+district1;
	http.open( "POST","include/Search_Upzila.php",true);
	http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	http.onreadystatechange =fnc_Upzila_Search_mailing_response;
	http.send(data); 
 
}


function fnc_Upzila_Search_mailing_response()
{
	if(http.readyState == 4)
	{ 
		   var response=http.responseText;
		   $('#upzila_load_1').html(response);
	}
}



// for Permanent Address


function fnc_Upzila_Search_Permanent(district2)
{
   $('#upzila_load_2').html('<img src="images/ajax_loader.gif" style="width:20px; height:20px; text-align:center;" />');
	var data ="action=seacrh_upzila_for_dist_level_2&district1="+district2;
	http.open( "POST","include/Search_Upzila.php",true);
	http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	http.onreadystatechange =fnc_Upzila_Search_Permanent_response;
	http.send(data); 
 
}


function fnc_Upzila_Search_Permanent_response()
{
	if(http.readyState == 4)
	{ 
		   var response=http.responseText;
		   $('#upzila_load_2').html(response);
	}
}

function fnc_get_save_address(val)
{
	if(val.checked)
	{
		$('#care2').val($('#care1').val());
		$('#road2').val($('#road1').val());
		$('#district2').val($('#district1').val());
		$('#ps2').val($('#ps1').val());
		$('#po2').val($('#po1').val());
		$('#pc2').val($('#pc1').val());
	}
	else{
	   $('#care2').val('');
		$('#road2').val('');
		$('#district2').val('');
		$('#ps2').val('');
		$('#po2').val('');
		$('#pc2').val('');

	}
}


function year_month_select(){
	
var y=$('#year_id').val();
var m=$('#month_id').val();
if(y==0){ alert('Please select year first.'); $('#month_id').val('');}
	
}


function  getDateTime(){
	
	
	var y=$('#year_id').val();
	var d=$('#date_id').val();
	var m=$('#month_id').val();
    
	if(m==0 && y==0){ alert('Please select year first');  $('#date_id').val(''); } else if(m==0){ alert('Please select month first.'); $('#date_id').val(''); } else if(y==0){ alert('Please select year first.'); $('#month_id').val(''); $('#date_id').val('');}
	
	/*var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();

	if(dd<10) {
		dd='0'+dd
	} 

	if(mm<10) {
		mm='0'+mm
	} 

	today = yyyy+','+mm+','+dd;
	getday = y+','+m+','+d;
	var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
	var firstDate = new Date(getday);
	var secondDate = new Date(today);

	var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)))/365;
	//alert(diffDays);
	if(diffDays>30){ var a= confirm('আপনার বয়স ৩০ এর বেশি আপনার কি কোঁটা প্রযোজ্য?'); if(a==false){ var y=$('#year_id').val('');
	var d=$('#date_id').val('');
	var m=$('#month_id').val('');} }*/

}


function fnc_check_quata_dis(val){
	
	    if(val==1 || val==2 || val==4 || val==5 || val==6 || val==11 || val==13 || val==14 || val==16 || val==17 || val==19 || val==21 || val==24 || val==28 || val==32 || val==33 || val==34 || val==35 || val==40 || val==41 || val==43 || val==48 || val==56 ){
			
			var a= confirm('এই জেলাটি সাধারণ প্রাথিদের জন্য প্রযোজ্য নয় ।  আপনার কি কোঁটা প্রযোজ্য?');
			if(a==false){  $('#district').val(''); return; }
			
		}
	
}

  function tyearschool(){
	      
		   var ssc= $('#ssc_duration').val();
		   var hsc= $('#hsc_duration').val();
		   var ug= $('#ug_duration').val();
		   var pg= $('#pg_duration').val();
		   var others= $('#others_duration').val();
		   
		   $('#tschool').val(ssc*1+hsc*1+ug*1+pg*1+others*1);
	  }
function checkaccnumber(evt){
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }
    return true;
}
