<script type="text/javascript">
$(document).on("blur change",".required_for_valid",function(){
    var val = "";
       val = $(this).val();
      if (val.trim() == "") {
           $(this).parent("div").find(".error_lable").remove();
           $(this).parent("div").append('<label class="error_lable" style="display: inline-block;color: red;font-size: small;font-size: 12px;font-weight: 500;margin: auto;padding: unset;">This field is required.</label>');
       } else {
           $(this).parent("div").find(".error_lable").remove();
       }
});

function validation(){
  var error_count=0;
  $(".required_for_valid").each(function () {
     var val = $(this).val();
       if (val.trim() == "") {
           $(this).parent("div").find(".error_lable").remove();
           $(this).parent("div").append('<label class="error_lable" style="display: inline-block;color: red;font-size: small;font-size: 12px;font-weight: 500;margin: auto;padding: unset;">This field is required.</label>');
           error_count++;
       } else {
           $(this).parent("div").find(".error").remove();
       }
   });
   return error_count;
}
// entering amount  on the screen
$(document).on("keyup", ".entering_amt", function() {
    var sum = 0;
    var max_amount      = $(this).closest('tr').find('.max_amount').text();    // MAX amount in the screen to check the condition
    var entering_amt    = $(this).val(); // Enter amount in the Filed 
    var max_amounts = parseFloat(max_amount);
    var entered_amounts = parseFloat(entering_amt);
    if(max_amounts < entered_amounts){ 
        max_amt = (max_amounts).toFixed(2)
        $(this).closest('tr').find('.entering_amt').val(max_amt);
    }    
    $(".entering_amt").each(function(){
        sum += +$(this).val();
	});	
    var num = parseFloat(sum).toFixed(2);
	$(".entered_total_amt").html(num);	
});

// entering amount  on the screen
$(document).on("keyup", ".entering_amt1", function() {
    var sum = 0;
    var max_amount      = $(this).closest('tr').find('.max_amount1').text();    // MAX amount in the screen to check the condition
    var entering_amt    = $(this).val(); // Enter amount in the Filed 
    var max_amounts = parseFloat(max_amount);
    var entered_amounts = parseFloat(entering_amt);
    if(max_amounts < entered_amounts){ 
        max_amt = (max_amounts).toFixed(2)
        $(this).closest('tr').find('.entering_amt1').val(max_amt);
    }    
    $(".entering_amt1").each(function(){
        sum += +$(this).val();
	});	
    var num = parseFloat(sum).toFixed(2);
	$(".entered_total_amt1").html(num);	
});

// entering amount  on the screen
$(document).on("keyup", ".entering_amt2", function() {
    var sum = 0;
    var max_amount      = $(this).closest('tr').find('.max_amount2').val();    // MAX amount in the screen to check the condition
    var entering_amt    = $(this).val(); // Enter amount in the Filed 
    var max_amounts = parseFloat(max_amount);
    var entered_amounts = parseFloat(entering_amt);
    if(max_amounts < entered_amounts){ 
        max_amt = (max_amounts).toFixed(2)
        $(this).closest('tr').find('.entering_amt2').val(max_amt);
    }    
    $(".entering_amt2").each(function(){
        sum += +$(this).val();
	});	
    var num = parseFloat(sum).toFixed(2);
	$(".entered_total_amt2").html(num);	
});

/* Start the sum of amputn in Claim Page */
$(document).on("keyup", ".each_sum_amt1", function() {
    var sum = 0;
    $(".each_sum_amt1").each(function(){
        sum += +$(this).val();
	});	
    var num = parseFloat(sum).toFixed(2);
	$(".total_sum_amt1").html(num);	
    total1_total2();
});
$(document).on("keyup", ".each_sum_amt2", function() {
    var sum = 0;
    $(".each_sum_amt2").each(function(){
        sum += +$(this).val();
	});	
    var num = parseFloat(sum).toFixed(2);
	$(".total_sum_amt2").html(num);	
    total1_total2();
});
$(document).on("keyup", ".each_adv_tot1", function() {
    var sum = 0;
    $(".each_adv_tot1").each(function(){
        sum += +$(this).val();
	});	
    var num = parseFloat(sum).toFixed(2);
	$(".tot_adv_tot1").html(num);	
});
function total1_total2(){
    var t1 = $(".total_sum_amt1").text();
    var t2 = $(".total_sum_amt2").text();
    var cls_amt1=t1!="" ? t1 : 0;
    var cls_amt2=t2!="" ? t2 : 0;
    var num = parseFloat(cls_amt1) + parseFloat(cls_amt2);
    var totals = parseFloat(num).toFixed(2);
	$(".over_all_total").html(totals);	
}
/* END  */

// In this page only call this function for total the on load screen 

function entering_amt(){
    var sum = 0;
    $(".entering_amt").each(function(){
        sum += +$(this).val();
	});	
    var num = parseFloat(sum).toFixed(2);
	$(".entered_total_amt").html(num);	
}
function entering_amt1(){
    var sum = 0;
    $(".entering_amt1").each(function(){
        sum += +$(this).val();
	});	
    var num = parseFloat(sum).toFixed(2);
	$(".entered_total_amt1").html(num);	
}

$(document).on("keypress",".only_allow_alp_num_dot_com_amp",function(e)
{
    var regex = new RegExp("^[a-zA-Z0-9.,& ]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
     e.preventDefault();
    return false;
});

$(document).on("keypress",".only_numbers",function(e)
{
    var regex = new RegExp("^[0-9]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
     e.preventDefault();
    return false;
});

$(document).on("keypress",".only_numbers_alpha",function(e)
{
    var regex = new RegExp("^[a-zA-Z0-9]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
     e.preventDefault();
    return false;
});

$(document).ready(function() {
    entering_amt();
    entering_amt1();
    $('.js-example-basic-single').select2();
});

var max_chars = 7;
$(document).on("keyup",".max_charater",function(e)
{
    if ($(this).val().length >= max_chars) { 
        $(this).val($(this).val().substr(0, max_chars));
    }
});

/* function denomination($num) {
    $explrestunits = "" ;
    if(strlen($num)>3) {
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++) {
        // creates each of the 2's group and adds a comma to the end
        if($i==0) {
        $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
        } else {
        $explrestunits .= $expunit[$i].",";
        }
        }
        $thecash = $explrestunits.$lastthree;
        } else {
        $thecash = $num;
        }
        return $thecash; // writes the final format where $currency is the currency symbol.
   } */
$(document).keypress(function(event){
    if (event.which == '13') {
     return false;
    }
});

$(document).ready(function(){
    $( document ).on( 'focus', ':input', function(){
      $( this ).attr( 'autocomplete', 'off' );
    });
});
</script>