function get_form_data(form_id)
{
	var fill_value='';
	 var inputs = $('#'+form_id+' :input');
	 //alert(inputs);
	 inputs.each(function (index)
	 {
		var iId=$(this).attr('id');
		var ivalue= $("#"+iId).val();
		fill_value+="&"+iId+'='+ivalue;
	 });
	 
	 return fill_value;
	 
}//end get_form_data;

function createObject() {
	var request_type;
	var browser = navigator.appName;
	if(browser == "Microsoft Internet Explorer"){
	request_type = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
	request_type = new XMLHttpRequest();
	}
	return request_type;
	}
var http = createObject();
// end createObject;

function change_color(id,origColor) {
	var x=document.getElementById("tr_"+id);
	var newColor = 'Khaki';
	if ( x.style ) {
		x.style.backgroundColor = ( newColor == x.style.backgroundColor )? origColor : newColor;
	}
}
		
/*function fn_validation(id)
{
	var id=id.split("*");	
	for(var i=0; i<id.length; i++)
	{
		var x=document.getElementById(id[i]);
		if(x.value=="" || x.value==0)
		{
		x.style.border = "1px solid red";
		x.focus();
		return 0;	
		}
		
	}
	
}*/


function fn_validation(id)
{
	var id=id.split("*");
	
	for(var i=0; i<id.length; i++)
	{
		
		var x=document.getElementById(id[i]);
		if(x.value=="" || x.value==0)
		{
            /*$("#msg").fadeTo( 200, 0.1, function() {
			$(this).text('Validating......').addClass('messagebox_ok').fadeTo(900,1);
			$(this).fadeOut(2000);});
;	*/
			x.style.border = "1px solid red";
			x.style.background = "#E5E6E5";
            $("#"+id[i]).focus();		    
			return 0;	
		}else{
		     x.style.border = "1px solid #E2E2E2";
			x.style.background = "#FFFFFF";
		}
		
	}
	
}

/*

function topCenter(sms){
         //alert(sms);
			$.messager.show({
				title:'Massage Box!',
				msg:sms,
				showType:'slide',
				style:{
					right:'',
					top:document.body.scrollTop+document.documentElement.scrollTop,
					bottom:''
		}
	}); 
}


*/
function topCenter(sms){

            $("#msg").fadeTo( 200, 0.1, function() {
			$(this).html(sms).addClass('messagebox_ok').fadeTo(900,1);
			$(this).fadeOut(2000);});
		  
}

function checkaccnumber(evt){
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }
    return true;
}

