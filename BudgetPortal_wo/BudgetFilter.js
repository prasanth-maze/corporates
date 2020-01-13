$(document).ready(function($) {
// Common For All SelectBox
	$('.MulSel').multiselect({    
		includeSelectAllOption: true,
	});
	 // Element Group Ajax
	 $("#expgroup").on("change",function(event) {
		 $("#loader-wrapper").css('display','block');     
	      var ElemGroup = $(this).val(); 
	      FilterAction={};
	      // FilterAction["ElemGroup"]=ElemGroup;
	       FilterAction["Action"]="getCostElement";
	      FilterAction["ElemGroup"]=ElemGroup;
	      if(ElemGroup != ""){
	         $.ajax({
	           url: 'BudgetSelectBoxFilter.php',
	           type: 'GET',
	           dataType: 'JSON',
	           data: FilterAction,
	           async:false,
	           success:function(ElemData){
	           var CeOptions='';

	           for(var i=0;i<ElemData.length;i++){
	            	//console.log(ElemData[i]);
	            	CeOptions+="<option selected='selected' value='"+ElemData[i]["CeCode"]+"'>"+ElemData[i]["CeName"]+"</option>";
	            }
	            $('#costElement').html(CeOptions);
	            $('#costElement').multiselect("rebuild");
	            $('#costElement').change();
	          }
	        })
	     }else{
		     	$('#costElement').html(ElemGroup);
		        $('#costElement').multiselect("rebuild");
		        $('#costElement').change();
	     }
		  $("#loader-wrapper").css('display','none');    
    });	 
	 // Product Division Ajax
	 $("#pdivision").on("change",function(event) {
		 $("#loader-wrapper").css('display','block');    
	      var Pdvsn = $(this).val(); 
	      FilterAction={};
	      FilterAction["Pdvsn"]=Pdvsn;
	      if(Pdvsn != ""){
	         	$.ajax({
	           	url: 'BudgetSelectBoxFilter.php',
	           	type: 'GET',
	           	dataType: 'JSON',
	           	data: FilterAction,
	           	success:function(ElemData){
	            var DvOptions='';
		           for(var i=0;i<ElemData.length;i++){
		            	console.log(ElemData[i]);
		            	DvOptions+='<option selected="selected" value="'+ElemData[i]+'">'+ElemData[i]+'</option>';
		            }
		            $('#division').html(DvOptions);
		            $('#division').multiselect("rebuild");
		          	}
	        	})
	     	}else{
	     		$('#division').html(Pdvsn);
		        $('#division').multiselect("rebuild");
	     }
		 
		 $("#loader-wrapper").css('display','none');    
    });
	 // Division Ajax
	 $("#division").on("change",function(event) {
		 $("#loader-wrapper").css('display','block');    
	      var Dvsn = $(this).val(); 
	      FilterAction={};
	      FilterAction["Dvsn"]=Dvsn;
	      if(Dvsn != ""){
	         	$.ajax({
	           	url: 'BudgetSelectBoxFilter.php',
	           	type: 'GET',
	           	dataType: 'JSON',
	           	data: FilterAction,
	           	success:function(ElemData){
	            var DvOptions='';
		           for(var i=0;i<ElemData.length;i++){
		            	console.log(ElemData[i]);
		            	DvOptions+='<option selected="selected" value="'+ElemData[i]+'">'+ElemData[i]+'</option>';
		            }
		            $('#region').html(DvOptions);
		            $('#region').multiselect("rebuild");
		          	}
	        	})
	     	}else{
	     		$('#region').html(Dvsn);
		        $('#region').multiselect("rebuild");
	     }
		 $("#loader-wrapper").css('display','none');    
    });
	 // Region Ajax
	 $("#region").on("change",function(event) {
		 $("#loader-wrapper").css('display','block');    
	      var Terr = $(this).val(); 
	      FilterAction={};
	      FilterAction["Terr"]=Terr;
	      if(Terr != ""){
	         	$.ajax({
	           	url: 'BudgetSelectBoxFilter.php',
	           	type: 'GET',
	           	dataType: 'JSON',
	           	data: FilterAction,
	           	success:function(ElemData){
	            var DvOptions='';
		           for(var i=0;i<ElemData.length;i++){
		            	console.log(ElemData[i]);
		            	DvOptions+='<option selected="selected" value="'+ElemData[i]+'">'+ElemData[i]+'</option>';
		            }
		            $('#terriotry').html(DvOptions);
		            $('#terriotry').multiselect("rebuild");
		          	}
	        	})
	     	}else{
	     		$('#terriotry').html(Terr);
		        $('#terriotry').multiselect("rebuild");
	     }
		 $("#loader-wrapper").css('display','none');    
    });
});