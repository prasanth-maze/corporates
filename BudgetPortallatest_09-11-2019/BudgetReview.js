$(document).ready(function($) {
  // Monthwise Column Header increment variable for set colspan
  Increment = 0;
  var ddclick = 0;
  var CL = CE = null;
  var ddclick = 0;
  var filterArr = [];
  var currentfiter = null;
  $('#menu-id,#filter').click(function () {
      
  if($('#myDIV').css('display') == 'none')
        {
         $('#myDIV').css('display','block');
        }
        else
        {
         $('#myDIV').css('display','none'); 
        }
});
	// hided and show function
    $(".ChangeStatus").click(function(){
    var MonthsColspan = $(".MonthsColspan").attr('colspan');
    // Plan,Actual,Variance,VariancePer CheckedOnly
	PlanActVarVarP_CheckedOnly();
      if($(this).prop("checked") == false){
      $(".MonthsColspan").each(function(index, el) {
            $(".MonthsColspan").attr('colspan',MonthsColspan-1);
        });
      }else{
        $(".MonthsColspan").each(function(index, el) {
            $(".MonthsColspan").attr('colspan',MonthsColspan-(-1));
        });
      }
    });
// Common For All SelectBox
	$('.MulSel').multiselect({    
		includeSelectAllOption: true,
	});
	// Element Group Ajax
	 $("#expgroup").on("change",function(event) {
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
	            	CeOptions+='<option selected="selected" value="'+ElemData[i]["CeCode"]+'">'+ElemData[i]["CeName"]+'</option>';
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
    });	 
	 // Product Division Ajax
	 $("#pdivision").on("change",function(event) {
	      var Pdvsn = $(this).val(); 
	      
	     var FilterAction={};
	      FilterAction["Action"]="getDepartment";
	      if($("#pdivision option:selected").length>0){
	      	FilterAction["Pdvsn"]=Pdvsn;	
	      }else{
	      	FilterAction["Pdvsn[]"]=""	;
	      }
	      
	     
	         	$.ajax({
	           	url: 'BudgetSelectBoxFilter.php',
	           	type: 'GET',
	           	dataType: 'JSON',
	           	data: FilterAction,
	           	async:false,
	           	success:function(ElemData){
	            var DvOptions='';
		           for(var i=0;i<ElemData.length;i++){
		            	//console.log(ElemData[i]);
		            	DvOptions+='<option selected="selected" value="'+ElemData[i]+'">'+ElemData[i]+'</option>';
		            }
		            $('#FiltrtDep').html(DvOptions);
		            $('#FiltrtDep').multiselect("rebuild");
		            $('#FiltrtDep').change();
		            /*$('#division').html(DvOptions);
		            $('#division').multiselect("rebuild");
		            $('#division').change();
		             $('#region').change();*/
		          	}
	        	})
	     	
    });

	 //Department wise Ajax
	  $("#FiltrtDep").on("change",function(event) {
	  	var Dept = $(this).val();
	     var FilterAction={};
	      FilterAction["Action"]="getDivision";
	      FilterAction["Pdvsn"]=$("#pdivision").val();
	      

	      if($("#FiltrtDep option:selected").length>0){
	      	FilterAction["Dept"]=Dept;	
	      }else{
	      	FilterAction["Dept[]"]="";
	      }
	   	
	         	$.ajax({
	           	url: 'BudgetSelectBoxFilter.php',
	           	type: 'GET',
	           	dataType: 'JSON',
	           	data: FilterAction,
	           	async:false,
	           	success:function(ElemData){
	            var DvOptions='';
		           for(var i=0;i<ElemData.length;i++){
		            	//console.log(ElemData[i]);
		            	DvOptions+='<option selected="selected" value="'+ElemData[i]+'">'+ElemData[i]+'</option>';
		            }
		           
		           console.log(DvOptions);
		            $('#division').html(DvOptions);
		            $('#division').multiselect("rebuild");
		            $('#division').change();
		          	}
	        	});
	     	
    })
	 // Division Ajax
	 $("#division").on("change",function(event) {
	 	var PDvsn = $("#pdivision").val(); 
	    var Dvsn = $(this).val(); 
	      FilterAction={};
	      FilterAction["Action"]="getRegion";
	      FilterAction["PDvsn"]=PDvsn;
	      FilterAction["Dept"]=$("#FiltrtDep").val();
	    

	      if($("#division option:selected").length>0){
	        FilterAction["Dvsn"]=Dvsn
	      }else{
	      	FilterAction["Dvsn[]"]="";
	      }
	     
	         	$.ajax({
	           	url: 'BudgetSelectBoxFilter.php',
	           	type: 'GET',
	           	dataType: 'JSON',
	           	data: FilterAction,
	           	async:false,
	           	success:function(ElemData){
	            var DvOptions='';
		           for(var i=0;i<ElemData.length;i++){
		            	//console.log(ElemData[i]);
		            	DvOptions+='<option selected="selected" value="'+ElemData[i]+'">'+ElemData[i]+'</option>';
		            }
		            $('#region').html(DvOptions);
		            $('#region').multiselect("rebuild");
		            $('#region').change();
		          	}

	        	})
	     	
    });
	 // Region Ajax
	 $("#region").on("change",function(event) { 
	      var PDvsn = $("#pdivision").val();
	      var Dvsn = $("#division").val(); 
	      var Rgn = $(this).val(); 
	      var FilterAction={};
	      FilterAction["Action"]="getTerritory";
	      FilterAction["Dvsn"]=Dvsn;
	      FilterAction["PDvsn"]=PDvsn;
	      FilterAction["Dept"]=$("#FiltrtDep").val();
	      FilterAction["Rgn"]=Rgn;

	      if($("#region option:selected").length>0){
	        FilterAction["Rgn"]=Rgn;
	      }else{
	      	FilterAction["Rgn[]"]="";
	      }
	     
	      
	         	$.ajax({
	           	url: 'BudgetSelectBoxFilter.php',
	           	type: 'GET',
	           	dataType: 'JSON',
	           	data: FilterAction,
	           	success:function(ElemData){
	            var DvOptions='';
		           for(var i=0;i<ElemData.length;i++){
		            	//console.log(ElemData[i]);
		            	DvOptions+='<option selected="selected" value="'+ElemData[i]+'">'+ElemData[i]+'</option>';
		            }
		            $('#terriotry').html(DvOptions);
		            $('#terriotry').multiselect("rebuild");
		          	}
	        	})
	     	
    });

var	cdd = 'ceg';

var defaultDrillView = {'ceg':"EGwisebudget",'ce':"CEwisebudget",'bdiv':"BDwisebudget","dept":"DEPTwisebudget",'div':"Divwisebudget",'reg':"Regwisebudget",'terr':"Terrwisebudget"};
//Below array is for Every column last element hide and show
var AllColumnClass = ["ElemGrouprow","costElementrow","BusinessDivrow","Departmentrow","Divisionrow","Regionrow","Territoryrow"];

$("body").on("submit",".filter-form",function(event){
	 	var res = null;
	 	$(".cpath").html('');
	 	$(".sticky").css('display', 'none');
		 // $("#loader-wrapper").css('display','block'); 
	 	var sdata = $(".filter-form").serializeObject();
		
		var drilldown ={};
		for(var i in defaultDrillView){
			drilldown[i]=defaultDrillView[i];
			if(i==cdd){
				break;
			}
		}
	 	for(var i in drilldown){
	 		var sdata1 = sdata;

	 		if(i=="ceg"){
	 			sdata1['Action'] = drilldown[i];
	 			filterArr.push(sdata1);
	 			var res = getresult(sdata1);
	 			
	 			 DataClick = "eg";
	 			 DrillVal = "";
	 			 CurEleGroup = "";
	 			 CurCECode = "";
	 			 CurBuisDiv = "";
	 			 CurDep = "";
	 			 CurDiv = "";
	 			 CurRgn = "";
	 			 var DrillObj = {"DataClick":DataClick,"DrillVal":DrillVal,"CurEleGroup":CurEleGroup,"CurCECode":CurCECode,"CurBuisDiv":CurBuisDiv,"CurDep":CurDep,"CurDiv":CurDiv,"CurRgn":CurRgn};
	 			 console.log("DrillObj"+DrillObj);
	 			$("#t_body").html(TableDynamicRowsBuilding(DrillObj,res));
	 			// Hide empty columns
		          // $('.colspanhead').attr('colspan','2');
		          $('.costElementCol').css('display','none');
		          $('.businessDivisionCol').css('display','none');
		          $('.departmentCol').css('display','none');
		          $('.DivisionCol').css('display','none');
		          $('.RegionCol').css('display','none');
		          $('.TerritoryCol').css('display','none');
		          // Plan,Actual,Variance,VariancePer CheckedOnly
				  PlanActVarVarP_CheckedOnly();
				  // +1 is for Remark column
				  $(".MonthsColspan").attr('colspan',Increment-(-1));
				  // Variance Tooltip
				  VarianceTooltip();
	 		}else if(i=='ce'){
	 			sdata1['Action'] = drilldown[i];
	 			// alert(expgroup);
	 			delete sdata1['expgroup[]'];	 			
	 			$(".ElemGroup").each(function (){	 				
	 				sdata1['expgroup[]'] = $(this).data("colval");
	 				 var res = getresult(sdata);
	 				 var rowrews = '';
		 			 for(var k in res){
		 			 	rowrews +=res[k];
		 			 }
	 				$(this).parent().after(rowrews);
	 				// Plan,Actual,Variance,VariancePer CheckedOnly
				    PlanActVarVarP_CheckedOnly();
				    $(".MonthsColspan").attr('colspan',Increment);
	 			});
	 			
	 		}else if(i=='bdiv'){
	 			sdata1['Action'] = drilldown[i];
	 			delete sdata['expgroup[]'];
	 			delete sdata['costElement[]'];
	 			$(".costElementdd").each(function() {
	 				var expgroup = $(this).data('elgroup');
	 				var costElement = $(this).data('cecode');
	 				sdata1['expgroup[]'] = expgroup;
	 				sdata1['costElement[]'] = costElement;
	 				 var res = getresult(sdata1);
	 				var rowrews = '';
	 				for(var k in res){
		 			 	rowrews +=res[k];
		 			 }
	 				
	 				 $(this).parent().after(rowrews);
	 				 // Plan,Actual,Variance,VariancePer CheckedOnly
				     PlanActVarVarP_CheckedOnly();
				     $(".MonthsColspan").attr('colspan',Increment);
	 			});
	 			
	 		}else if(i=='div'){
	 			sdata['Action'] = drilldown[i];
	 			delete sdata['expgroup[]'];
	 			delete sdata['costElement[]'];
	 			delete sdata['pdivision[]'];
	 			$(".BusinessDiv").each(function() {
	 				sdata1['expgroup[]'] = $(this).data('elgroup');
	 				sdata1['costElement[]'] = $(this).data('cecode');
	 				sdata1['pdivision[]'] = $(this).data('colval');
	 				 var res = getresult(sdata1);
	 				var rowrews = '';
	 				for(var k in res){
		 			 	rowrews +=res[k];
		 			 }
	 				 $(this).parent().after(rowrews);
	 				// Plan,Actual,Variance,VariancePer CheckedOnly
				    PlanActVarVarP_CheckedOnly();
				    $(".MonthsColspan").attr('colspan',Increment);
	 			});
	 		}else if(i=='reg'){
	 			sdata['Action'] = drilldown[i];
	 			delete sdata['expgroup[]'];
	 			delete sdata['costElement[]'];
	 			delete sdata['pdivision[]'];
	 			delete sdata['division[]'];
	 			$(".Division").each(function() {
	 				sdata1['expgroup[]'] = $(this).data('elgroup');
	 				sdata1['costElement[]'] = $(this).data('cecode');
	 				sdata1['pdivision[]'] = $(this).data("busdiv");
	 				sdata1['division[]'] = $(this).data("colval");
	 				// sdata1['region[]'] = $(this).data('colval');
	 				 var res = getresult(sdata1);
	 				var rowrews = '';
	 				for(var k in res){
		 			 	rowrews +=res[k];
		 			 }
	 				 $(this).parent().after(rowrews);
	 				// Plan,Actual,Variance,VariancePer CheckedOnly
				    PlanActVarVarP_CheckedOnly();
				    $(".MonthsColspan").attr('colspan',Increment);
	 			});
	 		}
	 		else if(i=='terr'){
	 			sdata['Action'] = drilldown[i];
	 			delete sdata['expgroup[]'];
	 			delete sdata['costElement[]'];
	 			delete sdata['pdivision[]'];
	 			delete sdata['division[]'];
	 			delete sdata['region[]'];
	 			$(".Region").each(function() {
	 				sdata1['expgroup[]'] = $(this).data('elgroup');
	 				sdata1['costElement[]'] = $(this).data('cecode');
	 				sdata1['pdivision[]'] = $(this).data("busdiv");
	 				sdata1['division[]'] = $(this).data("div");
	 				sdata1['region[]'] = $(this).data('colval');
	 				 var res = getresult(sdata1);
	 				var rowrews = '';
	 				for(var k in res){
		 			 	rowrews +=res[k];
		 			 }
	 				 $(this).parent().after(rowrews);
	 				// Plan,Actual,Variance,VariancePer CheckedOnly
				    PlanActVarVarP_CheckedOnly();
				    $(".MonthsColspan").attr('colspan',Increment);
	 			});
	 		}
	 	}

	 	if(res!=null){
	 		genMonthwiseBudgetChart(res);
	 		genGeowiseBudgetChart(sdata);
	 		genExpenseChart(sdata,res);
	 	}
	 	
	 		$("td:first-child").each(function(index, el) {
	 			$(this).addClass('freezeClass');
	 		});
	 		$("th:first-child").each(function(index, el) {
	 			$(this).addClass('freezeClass');
	 		});
	 	  // $("#loader-wrapper").css('display','none'); 
	 	 return false;
	 });
	 // // $('.TableHeads').css('text-align','center');
	 // // $('.TableHeads').css('font-weight','bold');
	 // $('.TableHeads').css('color','#000066');
		
	 $(".filter-form").submit();

var filterOrderArr = ['from','to','pdivision[]','division[]','department[]','region[]','terriotry[]','expgroup[]','costElement[]'];
$("body").on("click",".cbackbtn",function(){
    filterArr.splice(ddclick,1);
   	
    ddclick = ddclick-1;
    var cfilterobj = filterArr[ddclick];
    	$.each(cfilterobj,function(index, el) {
    		console.log(index);
    		if(index=='Action'){

    		}else if(index=='from'){
    			$("input[name='from']").val(el);
    		}else if(index=='to'){
    			console.log(el);
    			$("input[name='to']").val(el);
    		}else if(index=='pdivision[]'){
    			console.log(el);
    			 $("#pdivision option").prop('selected', false);
    			$.each(el,function(pindex, pdiv) {
    				$("#pdivision option[value='"+pdiv+"']").prop('selected', true);
    			});
    			$('#pdivision').multiselect("rebuild");
    			$("#pdivision").change();        		 
    		}else if(index=='department[]'){
				$("#FiltrtDep option").prop('selected', false);
				$.each(el,function(deptindex, dept) {
					$("#FiltrtDep option[value='"+dept+"']").prop('selected', true);
				});
				$('#FiltrtDep').multiselect("rebuild");
    			$("#FiltrtDep").change();       
    		}else if(index=='division[]'){
				$("#division option").prop('selected', false);
				$.each(el,function(divindex, div) {
					$("#division option[value='"+div+"']").prop('selected', true);
				});
				$('#division').multiselect("rebuild");
    			$("#division").change();       
    		}else if(index=='region[]'){
				$("#region option").prop('selected', false);
				$.each(el,function(regindex, reg) {
					$("#region option[value='"+reg+"']").prop('selected', true);
				});
				$('#region').multiselect("rebuild");
    			$("#region").change();       
    		}else if(index=='terriotry[]'){
				$("#terriotry option").prop('selected', false);
				$.each(el,function(terindex, terr) {
					$("#terriotry option[value='"+terr+"']").prop('selected', true);
				});
				$('#terriotry').multiselect("rebuild");
    			$("#terriotry").change();       
    		}else if(index=='expgroup[]'){
				$("#expgroup option").prop('selected', false);
				$.each(el,function(ecegindex, exceg) {
					$("#expgroup option[value='"+exceg+"']").prop('selected', true);
				});
				$('#expgroup').multiselect("rebuild");
    			$("#expgroup").change();       
    		}else if(index=='costElement[]'){
				$("#costElement option").prop('selected', false);
				$.each(el,function(ceindex, ce) {
					$('#costElement option[value="'+ce+'"]').prop('selected', true);
				});
				$('#costElement').multiselect("rebuild");
    			$("#costElement").change();       
    		}
    	});
    
    $(".filter-form").submit();
});

$("body").on('click', '.submitbtn', function(event) {
      filterArr = [];
      ddclick = 0;
 });

	 
	 	//Dynamic ON click Function
	 	DynamicInc=1;
	 	  $("#newTable").on("click", ".drilldown", function() {
	 	  	var cpath = [];
	 	  	var cellText = $(this).text();
			  // $("#loader-wrapper").css('display','block'); 
	 	  	if(typeof $(this).data('cview')!== 'undefined'){
         		$(this).attr('data-cview="hide"');
      		}
        	var cview = $(this).data('cview');
	        if(cview=='hide'){
	          $(this).data('cview','show');
	          $(this).parent("tr").css('font-weight','normal');
	          $("tr").css('background-color','white');
	          $(this).parent("tr").css('background-color','#8ED1F7');
	          $(this).css('color','black');
	        }else{
	          $(this).data('cview','hide');
	          $(this).parent("tr").css('font-weight','bold');
	          $("tr").css('background-color','white');
	          $(this).parent("tr").css('background-color','#8ED1F7');
	          $(this).css('color','blue');
	        }
	        // ElemGroupCol,costElementCol,businessDivisionCol,DivisionCol,RegionCol,TerritoryCol
	        CurEleGroup = "";
 			CurCECode = "";
 			CurBuisDiv = "";
 			CurDep = "";
 			CurDiv = "";
 			CurRgn = "";
	 	  	var DrillVal = $(this).data("colval"); 
	 	  	var CellIndexVal = $(this).data("cellindex"); 
	 	  	var DataClick = $(this).data("click"); 
	 	  	var DataClass = $(this).data("class");  
	 	  	var parentclass = $(this).parent().attr('class');
	 	  	var sdata = $(".filter-form").serializeObject();
			var drilldown ={};
			var ElemPass="";
			if(DataClick == 'ce'){
				CurEleGroup = $(this).data("elgroup");
				sdata['expgroup[]'] = $(this).data("colval");
				cpath.push(cellText);
			}else if(DataClick == 'bdiv'){
				CurEleGroup = $(this).data("elgroup"); 
	 	  		CurCECode = $(this).data("cecode"); 
	 	  		CurBuisDiv = $(this).data("colval");
				sdata['expgroup[]'] = $(this).data("elgroup");
				sdata['costElement[]'] = $(this).data("cecode");
				cpath.push($(this).data("elgroup"));
				cpath.push(cellText);
			}else if(DataClick == 'dept'){
				CurEleGroup = $(this).data("elgroup"); 
	 	  		CurCECode = $(this).data("cecode"); 
	 	  		CurBuisDiv = $(this).data("colval"); 
				sdata['expgroup[]'] = $(this).data("elgroup");
				sdata['costElement[]'] = $(this).data("cecode");
				sdata['pdivision[]'] = $(this).data("colval");
				cpath.push($(this).data("elgroup"));
				ce = $(this).parent("tr").prevAll(".costElementrow:first").find(".drilldown").text();
				cpath.push(ce);
				cpath.push(cellText);

			}else if(DataClick == 'div'){
				CurEleGroup = $(this).data("elgroup");
				CurCECode = $(this).data("cecode");
				CurBuisDiv = $(this).data("busdiv");
				CurDep = $(this).data("colval");
				sdata['expgroup[]'] = $(this).data("elgroup");
				sdata['costElement[]'] = $(this).data("cecode");
				sdata['pdivision[]'] = $(this).data("busdiv");
				sdata['department[]'] = $(this).data("colval");
				cpath.push($(this).data("elgroup"));
				ce = $(this).parent("tr").prevAll(".costElementrow:first").find(".drilldown").text();
				cpath.push(ce);
				cpath.push($(this).data('busdiv'));
				cpath.push(cellText);
			}else if(DataClick == 'reg'){
				CurEleGroup = $(this).data("elgroup");
				CurCECode = $(this).data("cecode");
				CurBuisDiv = $(this).data("busdiv");
				CurDep = $(this).data("dept");
				CurDiv = $(this).data("colval");
				sdata['expgroup[]'] = $(this).data("elgroup");
				sdata['costElement[]'] = $(this).data("cecode");
				sdata['pdivision[]'] = $(this).data("busdiv");
				sdata['department[]'] = $(this).data("dept");
				sdata['division[]'] = $(this).data("colval");
				cpath.push($(this).data("elgroup"));
				ce = $(this).parent("tr").prevAll(".costElementrow:first").find(".drilldown").text();
				cpath.push(ce);
				cpath.push($(this).data('busdiv'));
				cpath.push($(this).data('dept'));
				cpath.push(cellText);
			}else if(DataClick == 'terr'){
				CurEleGroup = $(this).data("elgroup");
				CurCECode = $(this).data("cecode");
				CurBuisDiv = $(this).data("busdiv");
				CurDep = $(this).data("dept");
				CurDiv = $(this).data("div");
				CurRgn = $(this).data("colval");
				sdata['expgroup[]'] = $(this).data("elgroup");
				sdata['costElement[]'] = $(this).data("cecode");
				sdata['pdivision[]'] = $(this).data("busdiv");
				sdata['department[]'] = $(this).data("dept");
				sdata['division[]'] = $(this).data("div");
				sdata['region[]'] = $(this).data("colval");

				cpath.push($(this).data("elgroup"));
				ce = $(this).parent("tr").prevAll(".costElementrow:first").find(".drilldown").text();
				cpath.push(ce);
				cpath.push($(this).data('busdiv'));
				cpath.push($(this).data('dept'));
				cpath.push($(this).data('div'));
				cpath.push(cellText);
			}
			CurrentDrilldownRootPath(CellIndexVal,DataClick,cpath);
			for(var i in defaultDrillView){
				drilldown[i]=defaultDrillView[i];
				if(i==DataClick){
					break;
				}
			}
			if(typeof $(this).data('drillval')!== 'undefined'){
         		$(this).attr('data-drillval="no"');
      			}
			if($(this).data('drillval') == 'yes'){
				if($(this).parent().attr('class')!=$(this).parent().next("tr").attr('class')){
					// if()
					var Findlastelem = AllColumnClass.indexOf(DataClass+"row")-(-1);
					var findlastelem1 = AllColumnClass[Findlastelem];
					var nextcolval = $(this).parent().next("tr").attr('class');
					// below variable is for find last element of a row
					var rowexist = $('td').hasClass(DataClass+(CellIndexVal-(-1)));
					if(rowexist==false){
						var showhideclass1 = "";
						var lastelem_hs = AllColumnClass.indexOf(parentclass);
						if(lastelem_hs == 0){
							// alert();
							$(this).parent().next().nextUntil("."+AllColumnClass[lastelem_hs-1]).prev().toggle();
						}else{
							lastelem_hs = AllColumnClass.indexOf(parentclass);
							for(var l=lastelem_hs;l<AllColumnClass.length;l++){
								$(this).parent().nextAll("."+AllColumnClass[l]).toggle();
							}
						}
					}else{
							showhideclass1 = $(this).parent().attr('class');
					}
					if(typeof $(this).data('drillstatus')!== 'undefined'){
		         		$(this).attr('data-drillstatus="hide"');
			      		}
			        	var drillstatus = $(this).data('drillstatus');
				        if(drillstatus=='hide'){
				        $(this).data('drillstatus','show');
				        $(this).parent().nextUntil("."+showhideclass1).show();
				        }else{
				        $(this).data('drillstatus','hide');
				        $(this).parent().nextUntil("."+showhideclass1).hide();
				        }
				}
			}else{
			 	for(var i in drilldown){
			 		// console.log(drilldown[i]);
	 			if(i== DataClick){
	 			sdata['Action'] = drilldown[i];
 				var res = getresult(sdata);
 				var DrillObj = {"DataClick":DataClick,"DrillVal":DrillVal,"CurEleGroup":CurEleGroup,"CurCECode":CurCECode,"CurBuisDiv":CurBuisDiv,"CurDep":CurDep,"CurDiv":CurDiv,"CurRgn":CurRgn};
 				$(this).parent().after(TableDynamicRowsBuilding(DrillObj,res));
 				$(this).data('drillval','yes');
 					if(DataClick == 'ce'){	
						// Hide empty columns
				        if($('.costElementCol').css('display') == 'none'){
				        	$('.costElementCol').show();
				          	// $('#colspanhead').attr('colspan','2');
				        }
				        if($('.businessDivisionCol').css('display') == 'none'){
				        	$('.businessDivisionCol').css('display','none');
				    	}
				    	if($('.departmentCol').css('display') == 'none'){
				        	$('.departmentCol').css('display','none');
				    	}
				        if($('.DivisionCol').css('display') == 'none'){
				        	$('.DivisionCol').css('display','none');
				    	}
				        if($('.RegionCol').css('display') == 'none'){
				        	$('.RegionCol').css('display','none');
				    	}
				        if($('.TerritoryCol').css('display') == 'none'){
				        	$('.TerritoryCol').css('display','none');	
				    	}
				    	// Plan,Actual,Variance,VariancePer CheckedOnly
				    	PlanActVarVarP_CheckedOnly();
				    	// Variance Tooltip
				  		VarianceTooltip();
					}else if(DataClick == 'bdiv'){
						// Hide empty columns
				        if($('.businessDivisionCol').css('display') == 'none'){
				        	$('.businessDivisionCol').show();
				          	// $('#colspanhead').attr('colspan','3');
				        }
				        if($('.departmentCol').css('display') == 'none'){
					        	$('.departmentCol').css('display','none');
				    	}
				        if($('.DivisionCol').css('display') == 'none'){
				        	$('.DivisionCol').css('display','none');
				    	}
				        if($('.RegionCol').css('display') == 'none'){
				        	$('.RegionCol').css('display','none');
				    	}
				        if($('.TerritoryCol').css('display') == 'none'){
				        	$('.TerritoryCol').css('display','none');	
				    	}
				    	// Plan,Actual,Variance,VariancePer CheckedOnly
				    	PlanActVarVarP_CheckedOnly();
				    	// Variance Tooltip
				  		VarianceTooltip();		
					}else if(DataClick == 'dept'){
						// Hide empty columns
				        if($('.departmentCol').css('display') == 'none'){
				        	$('.departmentCol').show();
				          	// $('#colspanhead').attr('colspan','4');
				        }
				        if($('.DivisionCol').css('display') == 'none'){
					        $('.DivisionCol').css('display','none');
					    }
					    if($('.RegionCol').css('display') == 'none'){
					        $('.RegionCol').css('display','none');
					    }
					    if($('.TerritoryCol').css('display') == 'none'){
					        $('.TerritoryCol').css('display','none');	
					    }
					    // Plan,Actual,Variance,VariancePer CheckedOnly	 
					    PlanActVarVarP_CheckedOnly();	
					    // Variance Tooltip
				  		VarianceTooltip();
					}else if(DataClick == 'div'){
						// Hide empty columns
				        if($('.DivisionCol').css('display') == 'none'){
				        	$('.DivisionCol').show();
				          	// $('#colspanhead').attr('colspan','5');
				        }
				        if($('.RegionCol').css('display') == 'none'){
					        $('.RegionCol').css('display','none');
					    }
					    if($('.TerritoryCol').css('display') == 'none'){
					        $('.TerritoryCol').css('display','none');	
					    }
					    // Plan,Actual,Variance,VariancePer CheckedOnly	 
					    PlanActVarVarP_CheckedOnly();
					    // Variance Tooltip
				  		VarianceTooltip();	
					}else if(DataClick == 'reg'){
						// Hide empty columns
				        if($('.RegionCol').css('display') == 'none'){
				        	$('.RegionCol').show();
				          	// $('#colspanhead').attr('colspan','6');
				        }
				        if($('.TerritoryCol').css('display') == 'none'){
					        	$('.TerritoryCol').css('display','none');	
					    }
					    // Plan,Actual,Variance,VariancePer CheckedOnly	 
					    PlanActVarVarP_CheckedOnly();
					    // Variance Tooltip
				  		VarianceTooltip();	
					}else if(DataClick == 'terr'){
						// Hide empty columns
				        if($('.TerritoryCol').css('display') == 'none'){
				        	$('.TerritoryCol').show();
				          	// $('#colspanhead').attr('colspan','7');
				        }
				        // Plan,Actual,Variance,VariancePer CheckedOnly	 
				        PlanActVarVarP_CheckedOnly();
				        // Variance Tooltip
				  		VarianceTooltip();
					}
	 			}
	 		}
 		}
		// $("#loader-wrapper").css('display','none'); 
});

	 //generate Month wise budget chart
function genMonthwiseBudgetChart(cdata){
	 	//console.log(cdata);
	 	var category = cdata['BRE@Nmonths'];
	 	var mdata = cdata['BRE@RowTot'];
	 	var planArr = [];
	 	var actualArr = [];
	 	var varArr = [];
	 	for(var c in category){
	 		planArr.push(parseInt(mdata[c]['plan'].replace(/,/g,'')));
	 		actualArr.push(parseInt(mdata[c]['actual'].replace(/,/g,'')));
	 		varArr.push(parseInt(mdata[c]['var'].replace(/,/g,'')));
	 	}
	 	
	 var mc = Highcharts.chart('monthWiseBudgetChart', {
	 		credits: {
                    enabled: false
              },
				    chart: {
				        type: 'column'
				    },
				    title: {
				        text: ''
				    },
				    xAxis: {
				        categories: category,
				       labels: {
			              style: {
			                  color: 'black'
			              }
			          }
				    },
				    yAxis: [{
				                allowDecimals: false,
				                title: {
				                    text: 'Count'
				                },
				                stackLabels: {
				                    enabled: true,
				                    style: {
				                        fontWeight: 'bold',
				                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
				                    }
				                }},
				              {
				                opposite: true

				                }],
				                 legend: {
				                align: 'center',
				                verticalAlign: 'bottom',
				                
				                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
				                borderColor: '#CCC',
				                borderWidth: 1,
				                shadow: false
				            },
				    tooltip: {
				        formatter: function() {
				            return '<b>' + this.x + '</b><br/>' + this.series.name + ': ' + this.y + '<br/>';
				        }
				    },
				    plotOptions: {
				        column: {
				        	cursor: 'pointer',
				            dataLabels: {
				                enabled: true,
				                  color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'Red'
				                }
				        }
				    },
				    series: [{
				        name: 'Plan',
				        data: planArr

				    }, {
				        name: 'Actual',
				        data: actualArr

				    },{
				      name: 'Variance',
				      type: 'spline',
				      yAxis:1,
				      data:varArr
				    }], navigation: {
				        buttonOptions: {
				            enabled: true
				        }
				    }
				},function (chart) {
					if(ddclick>=1){
			         chart.renderer.button(' < Back',500, 5)
			            .attr({
			                zIndex: 3,
			                class:'btn btn-default cbackbtn'
			            })
			            .add();
			        }
		    });
}


function genGeowiseBudgetChart(sdata){
		
		if(CL==null){
		 	sdata['Action'] = 'BDwisebudget';
		 }else if(CL=='DEPT') {
		 	sdata['Action'] = 'DEPTwisebudget';
		 }else if(CL=='DIV') {
		 	sdata['Action'] = 'Divwisebudget';
		 }else if(CL=='REG') {
		 	sdata['Action'] = 'Regwisebudget';
		 }else if(CL=='TERR') {
		 	sdata['Action'] = 'Terrwisebudget';
		 }
		var res = getresult(sdata);

		var category = [];
	 	var planArr = [];
	 	var actualArr = [];
	 	var varArr = [];
	 	$.each(res,function(index, el) {
	 		var totindex = el.length-1;
 			category.push(index);
 			planArr.push(parseInt(el[totindex]['plan'].replace(/,/g,'')));
	 		actualArr.push(parseInt(el[totindex]['actual'].replace(/,/g,'')));
	 		varArr.push(parseInt(el[totindex]['var'].replace(/,/g,'')));
	 	});
	 	
	 	
	 	
	 	var gc = new Highcharts.chart({
	 		credits: {
                    enabled: false
              },
				    chart: {
				    	renderTo: 'geoBudgetChart',
				        type: 'column'
				    },
				    title: {
				        text: ''
				    },
				    xAxis: {
				        categories: category,
				        labels: {
			              style: {
			                  color: 'black'
			              }
			          }
				},
				    yAxis: [{
				                allowDecimals: false,
				                title: {
				                    text: 'Count'
				                },
				                stackLabels: {
				                    enabled: true,
				                    style: {
				                        fontWeight: 'bold',
				                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
				                    }
				                }},
				              {
				                opposite: true

				                }],
				                 legend: {
				                align: 'center',
				                verticalAlign: 'bottom',
				                
				                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
				                borderColor: '#CCC',
				                borderWidth: 1,
				                shadow: false
				            },
				    tooltip: {
				        formatter: function() {
				            return '<b>' + this.x + '</b><br/>' + this.series.name + ': ' + this.y + '<br/>';
				        }
				    },
				    plotOptions: {
				        column: {
				        	cursor: 'pointer',
				            dataLabels: {
				                enabled: true,
				                  color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'Red'
				                }
				        }
				    },
				    series: [{
				        name: 'Plan',
				        data: planArr

				    }, {
				        name: 'Actual',
				        data: actualArr

				    },{
				      name: 'Variance',
				      type: 'spline',
				      yAxis:1,
				      data:varArr
				    }], navigation: {
				        buttonOptions: {
				            enabled: true
				        }
				    }
				},function(chart){
					if(ddclick>=1){
						chart.renderer.button(' < Back',500,5)
						  .attr({
			                zIndex: 3,
			                class:'btn btn-default cbackbtn'
			            }).add();
					}
				});

	 	 gc.xAxis[0].labelGroup.element.childNodes.forEach(function(label){
	 		label.style.cursor = "pointer";
	 			
	 		 label.onclick = function(events){
	 		 	var lname = $(this).text();
	 		 	console.log(lname);
	 		 	 ddclick =ddclick+1;
	 		 	if(CL==null){
	 		 		CL = 'PDIV';
	 		 	}

	 		 	if(CL=='PDIV'){
	 		 		$("#pdivision option").prop('selected', false);
	 		 		 $("#pdivision option[value='"+lname+"']").prop('selected', true);
	 		 		 $('#pdivision').multiselect("rebuild");
            		 $("#pdivision").change();
            		 CL = 'DEPT';
            		 $("#geoBudgettitle").text("Department");
            		 //cdd = 'bdiv';
	 		 	}else	if(CL=='DEPT'){
	 		 		$("#FiltrtDep option").prop('selected', false);
	 		 		 $("#FiltrtDep option[value='"+lname+"']").prop('selected', true);
	 		 		 $('#FiltrtDep').multiselect("rebuild");
            		 $("#FiltrtDep").change();
            		 CL = 'DIV';
            		 $("#geoBudgettitle").text("Division");
            		 //cdd = 'dept';
	 		 	}else if(CL=='DIV'){
	 		 		$("#division option").prop('selected', false);
	 		 		 $("#division option[value='"+lname+"']").prop('selected', true);
	 		 		 $('#division').multiselect("rebuild");
            		 $("#division").change();
            		 CL = 'REG';
            		 $("#geoBudgettitle").text("Region");
            		 //cdd = 'div';
	 		 	}else if(CL=='REG'){
	 		 		$("#region option").prop('selected', false);
	 		 		 $("#region option[value='"+lname+"']").prop('selected', true);
	 		 		 $('#region').multiselect("rebuild");
            		 $("#region").change();
            		 CL = 'TERR';
            		 $("#geoBudgettitle").text("Territory");
            		 //cdd = 'reg';
	 		 	}else if(CL=='TERR'){
            		CL = 'TERR';
            		//cdd = 'terr';
            		 $("#geoBudgettitle").text("Territory");
            		 $("#terriotry option").prop('selected', false);
	 		 		 $("#terriotry option[value='"+lname+"']").prop('selected', true);
	 		 		 $('#terriotry').multiselect("rebuild");
	 		 	}

	 		 		//alert(CL);

	 		 	$(".filter-form").submit();
	 		 }
      	});
}
var ddceg = null;
function genExpenseChart(sdata,cdata){

		var category = [];
	 	var planArr = [];
	 	var actualArr = [];
	 	var varArr = [];
	 	var category =[];
	 	var planArr =[];
	 	var actualArr =[];
	 	var varArr =[];
	if(CE==null){
	 	var totindex = cdata['BRE@Nmonths'].length;
		delete cdata['BRE@Nmonths'];
		delete cdata['BRE@RowTot'];
		$.each(cdata,function(index, el) {
	 		category.push($.trim(index));
	 		planArr.push(parseInt(el[totindex]['plan'].replace(/,/g,'')));
	 		actualArr.push(parseInt(el[totindex]['actual'].replace(/,/g,'')));
	 		varArr.push(parseInt(el[totindex]['var'].replace(/,/g,'')));
	 	});
	 }else if(CE=='CE') {
	 	sdata['Action'] = 'CEwisebudget';
	 	var res = getresult(sdata);
	 	delete res[ddceg];
	 	cdata = res;
	 	$.each(cdata,function(index, el) {
	 		var totindex = el.length-1;
	 		/*console.log(index);
	 		console.log(totindex);
	 		console.log(el[totindex]);*/
	 		category.push($.trim(index));
	 		planArr.push(parseInt(el[totindex]['plan'].replace(/,/g,'')));
	 		actualArr.push(parseInt(el[totindex]['actual'].replace(/,/g,'')));
	 		varArr.push(parseInt(el[totindex]['var'].replace(/,/g,'')));
	 	});
	 } 	
	 	
	 	
	 	var ec = new Highcharts.chart({
	 		credits: {
                    enabled: false
              },
				    chart: {
				    	renderTo: 'expenseChart',
				        type: 'column'
				    },
				    title: {
				        text: ''
				    },
				    xAxis: {
				        categories: category,
				        labels: {
			              style: {
			                  color: 'black'
			              }
			          }
				},
				    yAxis: [{
				                allowDecimals: false,
				                title: {
				                    text: 'Count'
				                },
				                stackLabels: {
				                    enabled: true,
				                    style: {
				                        fontWeight: 'bold',
				                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
				                    }
				                }},
				              {
				                opposite: true

				                }],
				                 legend: {
				                align: 'center',
				                verticalAlign: 'bottom',
				                
				                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
				                borderColor: '#CCC',
				                borderWidth: 1,
				                shadow: false
				            },
				    tooltip: {
				        formatter: function() {
				            return '<b>' + this.x + '</b><br/>' + this.series.name + ': ' + this.y + '<br/>';
				        }
				    },
				    plotOptions: {
				        column: {
				        	cursor: 'pointer',
				            dataLabels: {
				                enabled: true,
				                  color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'Red'
				                }
				        }
				    },
				    series: [{
				        name: 'Plan',
				        data: planArr

				    }, {
				        name: 'Actual',
				        data: actualArr

				    },{
				      name: 'Variance',
				      type: 'spline',
				      yAxis:1,
				      data:varArr
				    }], navigation: {
				        buttonOptions: {
				            enabled: true
				        }
				    }
				},function(chart){
					if(ddclick>=1){
						chart.renderer.button(' < Back',1200,5)
						  .attr({
			                zIndex: 3,
			                class:'btn btn-default cbackbtn'
			            }).add();
					}
				});

	 	 ec.xAxis[0].labelGroup.element.childNodes.forEach(function(label){
	 		label.style.cursor = "pointer";
	 			
	 		 label.onclick = function(events){
	 		 	var lname = $(this).text();
	 		 	console.log(lname);
	 		 	ddclick =ddclick+1;
	 		 	if(CE==null){
	 		 		CE = 'CEG';
	 		 	}

	 		 	if(CE=='CEG'){
	 		 		ddceg = lname;
	 		 		$("#expgroup option").prop('selected', false);
	 		 		 $("#expgroup option[value='"+lname+"']").prop('selected', true);
	 		 		 $('#expgroup').multiselect("rebuild");
            		 $("#expgroup").change();
            		 CE = 'CE';
            		 //cdd = 'bdiv';
	 		 	}else if(CE=='CE'){
	 		 		$("#costElement option").prop('selected', false);
	 		 		 $("#costElement option:contains("+lname+")").prop('selected', true);
	 		 		 $('#costElement').multiselect("rebuild");            		 
            		 //cdd = 'dept';
	 		 	}

	 		 	$(".filter-form").submit();
	 		 }
      	});
}

	 
	 	//Dynamic ON click Function
	 	DynamicInc=1;
	 	  $("#newTable").on("click", ".drilldown", function() {
	 	  	var cpath = [];
	 	  	var cellText = $(this).text();
			  // $("#loader-wrapper").css('display','block'); 
	 	  	if(typeof $(this).data('cview')!== 'undefined'){
         		$(this).attr('data-cview="hide"');
      		}
        	var cview = $(this).data('cview');
	        if(cview=='hide'){
	          $(this).data('cview','show');
	          $(this).parent("tr").css('font-weight','normal');
	          $("tr").css('background-color','white');
	          $(this).parent("tr").css('background-color','#8ED1F7');
	          $(this).css('color','black');
	        }else{
	          $(this).data('cview','hide');
	          $(this).parent("tr").css('font-weight','bold');
	          $("tr").css('background-color','white');
	          $(this).parent("tr").css('background-color','#8ED1F7');
	          $(this).css('color','blue');
	        }
	        // ElemGroupCol,costElementCol,businessDivisionCol,DivisionCol,RegionCol,TerritoryCol
	        CurEleGroup = "";
 			CurCECode = "";
 			CurBuisDiv = "";
 			CurDep = "";
 			CurDiv = "";
 			CurRgn = "";
	 	  	var DrillVal = $(this).data("colval"); 
	 	  	var CellIndexVal = $(this).data("cellindex"); 
	 	  	var DataClick = $(this).data("click"); 
	 	  	var DataClass = $(this).data("class");  
	 	  	var parentclass = $(this).parent().attr('class');
	 	  	var sdata = $(".filter-form").serializeObject();
			var drilldown ={};
			var ElemPass="";
			if(DataClick == 'ce'){
				CurEleGroup = $(this).data("elgroup");
				sdata['expgroup[]'] = $(this).data("colval");
				cpath.push(cellText);
			}else if(DataClick == 'bdiv'){
				CurEleGroup = $(this).data("elgroup"); 
	 	  		CurCECode = $(this).data("cecode"); 
	 	  		CurBuisDiv = $(this).data("colval");
				sdata['expgroup[]'] = $(this).data("elgroup");
				sdata['costElement[]'] = $(this).data("cecode");
				cpath.push($(this).data("elgroup"));
				cpath.push(cellText);
			}else if(DataClick == 'dept'){
				CurEleGroup = $(this).data("elgroup"); 
	 	  		CurCECode = $(this).data("cecode"); 
	 	  		CurBuisDiv = $(this).data("colval"); 
				sdata['expgroup[]'] = $(this).data("elgroup");
				sdata['costElement[]'] = $(this).data("cecode");
				sdata['pdivision[]'] = $(this).data("colval");
				cpath.push($(this).data("elgroup"));
				ce = $(this).parent("tr").prevAll(".costElementrow:first").find(".drilldown").text();
				cpath.push(ce);
				cpath.push(cellText);

			}else if(DataClick == 'div'){
				CurEleGroup = $(this).data("elgroup");
				CurCECode = $(this).data("cecode");
				CurBuisDiv = $(this).data("busdiv");
				CurDep = $(this).data("colval");
				sdata['expgroup[]'] = $(this).data("elgroup");
				sdata['costElement[]'] = $(this).data("cecode");
				sdata['pdivision[]'] = $(this).data("busdiv");
				sdata['department[]'] = $(this).data("colval");
				cpath.push($(this).data("elgroup"));
				ce = $(this).parent("tr").prevAll(".costElementrow:first").find(".drilldown").text();
				cpath.push(ce);
				cpath.push($(this).data('busdiv'));
				cpath.push(cellText);
			}else if(DataClick == 'reg'){
				CurEleGroup = $(this).data("elgroup");
				CurCECode = $(this).data("cecode");
				CurBuisDiv = $(this).data("busdiv");
				CurDep = $(this).data("dept");
				CurDiv = $(this).data("colval");
				sdata['expgroup[]'] = $(this).data("elgroup");
				sdata['costElement[]'] = $(this).data("cecode");
				sdata['pdivision[]'] = $(this).data("busdiv");
				sdata['department[]'] = $(this).data("dept");
				sdata['division[]'] = $(this).data("colval");
				cpath.push($(this).data("elgroup"));
				ce = $(this).parent("tr").prevAll(".costElementrow:first").find(".drilldown").text();
				cpath.push(ce);
				cpath.push($(this).data('busdiv'));
				cpath.push($(this).data('dept'));
				cpath.push(cellText);
			}else if(DataClick == 'terr'){
				CurEleGroup = $(this).data("elgroup");
				CurCECode = $(this).data("cecode");
				CurBuisDiv = $(this).data("busdiv");
				CurDep = $(this).data("dept");
				CurDiv = $(this).data("div");
				CurRgn = $(this).data("colval");
				sdata['expgroup[]'] = $(this).data("elgroup");
				sdata['costElement[]'] = $(this).data("cecode");
				sdata['pdivision[]'] = $(this).data("busdiv");
				sdata['department[]'] = $(this).data("dept");
				sdata['division[]'] = $(this).data("div");
				sdata['region[]'] = $(this).data("colval");

				cpath.push($(this).data("elgroup"));
				ce = $(this).parent("tr").prevAll(".costElementrow:first").find(".drilldown").text();
				cpath.push(ce);
				cpath.push($(this).data('busdiv'));
				cpath.push($(this).data('dept'));
				cpath.push($(this).data('div'));
				cpath.push(cellText);
			}
			CurrentDrilldownRootPath(CellIndexVal,DataClick,cpath);
			for(var i in defaultDrillView){
				drilldown[i]=defaultDrillView[i];
				if(i==DataClick){
					break;
				}
			}
			if(typeof $(this).data('drillval')!== 'undefined'){
         		$(this).attr('data-drillval="no"');
      			}
			if($(this).data('drillval') == 'yes'){
				if($(this).parent().attr('class')!=$(this).parent().next("tr").attr('class')){
					// if()
					var Findlastelem = AllColumnClass.indexOf(DataClass+"row")-(-1);
					var findlastelem1 = AllColumnClass[Findlastelem];
					var nextcolval = $(this).parent().next("tr").attr('class');
					// below variable is for find last element of a row
					var rowexist = $('td').hasClass(DataClass+(CellIndexVal-(-1)));
					if(rowexist==false){
						var showhideclass1 = "";
						var lastelem_hs = AllColumnClass.indexOf(parentclass);
						if(lastelem_hs == 0){
							// alert();
							$(this).parent().next().nextUntil("."+AllColumnClass[lastelem_hs-1]).prev().toggle();
						}else{
							lastelem_hs = AllColumnClass.indexOf(parentclass);
							for(var l=lastelem_hs;l<AllColumnClass.length;l++){
								$(this).parent().nextAll("."+AllColumnClass[l]).toggle();
							}
						}
					}else{
							showhideclass1 = $(this).parent().attr('class');
					}
					if(typeof $(this).data('drillstatus')!== 'undefined'){
		         		$(this).attr('data-drillstatus="hide"');
			      		}
			        	var drillstatus = $(this).data('drillstatus');
				        if(drillstatus=='hide'){
				        $(this).data('drillstatus','show');
				        $(this).parent().nextUntil("."+showhideclass1).show();
				        }else{
				        $(this).data('drillstatus','hide');
				        $(this).parent().nextUntil("."+showhideclass1).hide();
				        }
				}
			}else{
			 	for(var i in drilldown){
			 		// console.log(drilldown[i]);
	 			if(i== DataClick){
	 			sdata['Action'] = drilldown[i];
 				var res = getresult(sdata);
 				var DrillObj = {"DataClick":DataClick,"DrillVal":DrillVal,"CurEleGroup":CurEleGroup,"CurCECode":CurCECode,"CurBuisDiv":CurBuisDiv,"CurDep":CurDep,"CurDiv":CurDiv,"CurRgn":CurRgn};
 				$(this).parent().after(TableDynamicRowsBuilding(DrillObj,res));
 				$(this).data('drillval','yes');
 					if(DataClick == 'ce'){	
						// Hide empty columns
				        if($('.costElementCol').css('display') == 'none'){
				        	$('.costElementCol').show();
				          	// $('#colspanhead').attr('colspan','2');
				        }
				        if($('.businessDivisionCol').css('display') == 'none'){
				        	$('.businessDivisionCol').css('display','none');
				    	}
				    	if($('.departmentCol').css('display') == 'none'){
				        	$('.departmentCol').css('display','none');
				    	}
				        if($('.DivisionCol').css('display') == 'none'){
				        	$('.DivisionCol').css('display','none');
				    	}
				        if($('.RegionCol').css('display') == 'none'){
				        	$('.RegionCol').css('display','none');
				    	}
				        if($('.TerritoryCol').css('display') == 'none'){
				        	$('.TerritoryCol').css('display','none');	
				    	}
				    	// Plan,Actual,Variance,VariancePer CheckedOnly
				    	PlanActVarVarP_CheckedOnly();
				    	// Variance Tooltip
				  		VarianceTooltip();
					}else if(DataClick == 'bdiv'){
						// Hide empty columns
				        if($('.businessDivisionCol').css('display') == 'none'){
				        	$('.businessDivisionCol').show();
				          	// $('#colspanhead').attr('colspan','3');
				        }
				        if($('.departmentCol').css('display') == 'none'){
					        	$('.departmentCol').css('display','none');
				    	}
				        if($('.DivisionCol').css('display') == 'none'){
				        	$('.DivisionCol').css('display','none');
				    	}
				        if($('.RegionCol').css('display') == 'none'){
				        	$('.RegionCol').css('display','none');
				    	}
				        if($('.TerritoryCol').css('display') == 'none'){
				        	$('.TerritoryCol').css('display','none');	
				    	}
				    	// Plan,Actual,Variance,VariancePer CheckedOnly
				    	PlanActVarVarP_CheckedOnly();
				    	// Variance Tooltip
				  		VarianceTooltip();		
					}else if(DataClick == 'dept'){
						// Hide empty columns
				        if($('.departmentCol').css('display') == 'none'){
				        	$('.departmentCol').show();
				          	// $('#colspanhead').attr('colspan','4');
				        }
				        if($('.DivisionCol').css('display') == 'none'){
					        $('.DivisionCol').css('display','none');
					    }
					    if($('.RegionCol').css('display') == 'none'){
					        $('.RegionCol').css('display','none');
					    }
					    if($('.TerritoryCol').css('display') == 'none'){
					        $('.TerritoryCol').css('display','none');	
					    }
					    // Plan,Actual,Variance,VariancePer CheckedOnly	 
					    PlanActVarVarP_CheckedOnly();	
					    // Variance Tooltip
				  		VarianceTooltip();
					}else if(DataClick == 'div'){
						// Hide empty columns
				        if($('.DivisionCol').css('display') == 'none'){
				        	$('.DivisionCol').show();
				          	// $('#colspanhead').attr('colspan','5');
				        }
				        if($('.RegionCol').css('display') == 'none'){
					        $('.RegionCol').css('display','none');
					    }
					    if($('.TerritoryCol').css('display') == 'none'){
					        $('.TerritoryCol').css('display','none');	
					    }
					    // Plan,Actual,Variance,VariancePer CheckedOnly	 
					    PlanActVarVarP_CheckedOnly();
					    // Variance Tooltip
				  		VarianceTooltip();	
					}else if(DataClick == 'reg'){
						// Hide empty columns
				        if($('.RegionCol').css('display') == 'none'){
				        	$('.RegionCol').show();
				          	// $('#colspanhead').attr('colspan','6');
				        }
				        if($('.TerritoryCol').css('display') == 'none'){
					        	$('.TerritoryCol').css('display','none');	
					    }
					    // Plan,Actual,Variance,VariancePer CheckedOnly	 
					    PlanActVarVarP_CheckedOnly();
					    // Variance Tooltip
				  		VarianceTooltip();	
					}else if(DataClick == 'terr'){
						// Hide empty columns
				        if($('.TerritoryCol').css('display') == 'none'){
				        	$('.TerritoryCol').show();
				          	// $('#colspanhead').attr('colspan','7');
				        }
				        // Plan,Actual,Variance,VariancePer CheckedOnly	 
				        PlanActVarVarP_CheckedOnly();
				        // Variance Tooltip
				  		VarianceTooltip();
					}
	 			}
	 		}
 		}
		// $("#loader-wrapper").css('display','none'); 
});


	 function getresult(filerdata){
	 	//console.log("Ajax Data   "+JSON.stringify(filerdata));
	 	var result = '';
	 	$.ajax({
	 		url: 'budget_json.php',
	 		type: 'POST',
	 		data: filerdata,
	 		async:false,
	 		dataType:'json',
	 		success:function(data){
	 			result=data;
	 			//console.log(result.length);
	 		}
	 	});
	 	return result;	 	
	 }
	 // Plan,Actual,Variance,VariancePer Selected Only DrillDown
	 function PlanActVarVarP_CheckedOnly(){
	 	Increment = 0;
	 	if($("#Planhs").prop("checked") == true){
	        $('.plan').show();
	        Increment++;
	    }else{
	        $('.plan').each(function(index, el) {
	            $(this).css('display','none');
	        });
	    }
	    if($("#Actualhs").prop("checked") == true){
	        $('.actual').show();
	        Increment++;
	    }else{
	        $('.actual').each(function(index, el) {
	            $(this).css('display','none');
	        });
	    }
	    if($("#Varhs").prop("checked") == true){
	        $('.var').show();
	        Increment++;
	    }else{
	        $('.var').each(function(index, el) {
	            $(this).css('display','none');
	        });
	    }
	    if($("#Varphs").prop("checked") == true){
	        $('.varp').show();
	        Increment++;
	    }else{
	        $('.varp').each(function(index, el) {
	            $(this).css('display','none');
	        });
	    }
	    // $('.ChangeStatus').trigger('click');
	 } 
	 // Tooltip
	var prvsbgclr = "";
	var prvsclr = "";
	 function VarianceTooltip(){
		$('.var').mouseover(function(event) { 
			var RmResult = '<div style="font-weight:bold">Territory Manager:</div>'+'<br>'+'  Expenses done for Diwali Gift.'+'<br>'+''+'<br>'+'<div style="font-weight:bold">Regional Manager:</div>'+'<br>'+'  Multiple expenses incurrsed for diwali Gifts across region.'+'<br>'+''+'<br>'+'<div style="font-weight:bold">Finance Head:</div>'+'<br>'+'Justification for deviation accepted.'+'<br>'+''+'<br>'+'';
		 	$.ajax({
		 		url: 'ReviewRemarkResult.php',
		 		type: 'POST',
		 		dataType:'json',
		 		success:function(data){
		 			for(var i=0;i<data.length;i++){
		 				RmResult+=+i-(-1)+":"+data[i]+"<br>";
		 			}
		 			// console.log("Remark Result"+RmResult);
		 			$('#BudgetRemarkdiv').show();
			        $('#BudgetRemarkdiv').val("");
			        $('#BudgetRemarkdiv').html(RmResult);
			        $('#BudgetRemarkdiv').css('top', event.pageY-50);
					$('#BudgetRemarkdiv').css('left', event.pageX-(-30));
		 		}

		 	});
		 	 prvsbgclr = $(this).css("background-color");
		 	 prvsclr = $(this).css("color");
		 	$(this).css("background-color","#ff6699");
		 	$(this).css("color","white");
	    });
	    $('.var').mouseout(function() {
	        $('#BudgetRemarkdiv').hide();
	        $(this).css("background-color",prvsbgclr);
		 	$(this).css("color",prvsclr);
	    });
	 //    $(".var").mouseleave(function() {
  //       	$('#BudgetRemarkdiv').hide();
		// });
	}
	$('tbody').scroll(function(e) { //detect a scroll event on the tbody
	    /*
	    Setting the thead left value to the negative valule of tbody.scrollLeft will make it track the movement
	    of the tbody element. Setting an elements left value to that of the tbody.scrollLeft left makes it maintain             it's relative position at the left of the table.    
	    */
	    $('thead').css("left", -$("tbody").scrollLeft()); //fix the thead relative to the body scrolling
	    $('tbody tr:nth-child(1)').css("top", $("tbody").scrollTop());
	    $('tbody tr:nth-child(2)').css("top", $("tbody").scrollTop());
	    $('thead th:nth-child(1)').css("left", $("tbody").scrollLeft()); //fix the first cell of the header
	    $('tbody td:nth-child(1)').css("left", $("tbody").scrollLeft()); //fix the first column of tdbody
	    $('thead th:nth-child(2)').css("left", $("tbody").scrollLeft()); //fix the first cell of the header
	    $('tbody td:nth-child(2)').css("left", $("tbody").scrollLeft()); //fix the first column of tdbody
	    $('thead th:nth-child(3)').css("left", $("tbody").scrollLeft()); //fix the first cell of the header
	    $('tbody td:nth-child(3)').css("left", $("tbody").scrollLeft()); //fix the first column of tdbody
	    $('thead th:nth-child(4)').css("left", $("tbody").scrollLeft()); //fix the first cell of the header
	    $('tbody td:nth-child(4)').css("left", $("tbody").scrollLeft()); //fix the first column of tdbody
	    $('thead th:nth-child(5)').css("left", $("tbody").scrollLeft()); //fix the first cell of the header
	    $('tbody td:nth-child(5)').css("left", $("tbody").scrollLeft()); //fix the first column of tdbody
	    $('thead th:nth-child(6)').css("left", $("tbody").scrollLeft()); //fix the first cell of the header
	    $('tbody td:nth-child(6)').css("left", $("tbody").scrollLeft()); //fix the first column of tdbody
	    $('thead th:nth-child(7)').css("left", $("tbody").scrollLeft()); //fix the first cell of the header
	    $('tbody td:nth-child(7)').css("left", $("tbody").scrollLeft()); //fix the first column of tdbody
  	});
  	// Function Current Drilldown Root Path
  	function CurrentDrilldownRootPath(CellIndexVal,DataClick,cpath){
  		// Root Path code start		
			if(DataClick == 'ce'){	
				// DrilldownPath
				$('.feg1').html("");
				$('.fce1').html("");
				$('.fbd1').html("");
				$('.fdep1').html("");
				$('.fdv1').html("");
				$('.frgn1').html("");
				$('.feg1').css("background-color","#02cf92");
				$('.fce1').css("background-color","#02cf92");
				$('.fbd1').css("background-color","#02cf92");
				$('.fdep1').css("background-color","#02cf92");
				$('.fdv1').css("background-color","#02cf92");
				$('.frgn1').css("background-color","#02cf92");
				$('.fter1').css("background-color","#02cf92");
				var cview = $('.ElemGroup'+CellIndexVal).data('cview');
				if(cview=='hide'){
					$('.feg1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[0]+'&nbsp;<span>&#187;</span></ol>');
	          		
		        }else{
		          	$('.feg1').html("");
	          		$('.feg1').css("background-color","white");
	          		$('.fce1').css("background-color","white");
					$('.fbd1').css("background-color","white");
					$('.fdep1').css("background-color","white");
					$('.fdv1').css("background-color","white");
					$('.frgn1').css("background-color","white");
					$('.fter1').css("background-color","white");
		        }
		    	
			}else if(DataClick == 'bdiv'){
				// DrilldownPath
				$('.fce1').html("");
				$('.fbd1').html("");
				$('.fdep1').html("");
				$('.fdv1').html("");
				$('.frgn1').html("");
				$('.feg1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[0]+'&nbsp;<span>&#187;</span></ol>');
		    	$('.fce1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[1]+'&nbsp;<span>&#187;</span></ol>');		
			}else if(DataClick == 'dept'){
				// DrilldownPath
				$('.fbd1').html("");
				$('.fdep1').html("");
				$('.fdv1').html("");
				$('.frgn1').html("");
				$('.feg1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[0]+'&nbsp;<span>&#187;</span></ol>');
		    	$('.fce1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[1]+'&nbsp;<span>&#187;</span></ol>');
		    	$('.fbd1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[2]+'&nbsp;<span>&#187;</span></ol>');
			}else if(DataClick == 'div'){
				// DrilldownPath
				$('.fdep1').html("");
				$('.fdv1').html("");
				$('.frgn1').html("");
				$('.feg1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[0]+'&nbsp;<span>&#187;</span></ol>');
		    	$('.fce1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[1]+'&nbsp;<span>&#187;</span></ol>');
		    	$('.fbd1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[2]+'&nbsp;<span>&#187;</span></ol>');
		    	$('.fdep1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[3]+'&nbsp;<span>&#187;</span></ol>');	
			}else if(DataClick == 'reg'){
				// DrilldownPath
				$('.fdv1').html("");
				$('.frgn1').html("");
				$('.feg1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[0]+'&nbsp;<span>&#187;</span></ol>');
		    	$('.fce1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[1]+'&nbsp;<span>&#187;</span></ol>');
		    	$('.fbd1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[2]+'&nbsp;<span>&#187;</span></ol>');
		    	$('.fdep1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[3]+'&nbsp;<span>&#187;</span></ol>');
		    	$('.fdv1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[4]+'&nbsp;<span>&#187;</span></ol>');	
			}else if(DataClick == 'terr'){
				// DrilldownPath
				$('.frgn1').html("");
				$('.feg1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[0]+'&nbsp;<span>&#187;</span></ol>');
		    	$('.fce1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[1]+'&nbsp;<span>&#187;</span></ol>');
		    	$('.fbd1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[2]+'&nbsp;<span>&#187;</span></ol>');
		    	$('.fdep1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[3]+'&nbsp;<span>&#187;</span></ol>');
		    	$('.fdv1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[4]+'&nbsp;<span>&#187;</span></ol>');
		    	$('.frgn1').html('<ol class="breadcrumb breadcrumb-arrow cpath " style="margin-left: -10px">'+cpath[5]+'&nbsp;<span>&#187;</span></ol>');
			}//Root Path code ending
  	}
  	// Function For Dynamic Row Building 
	function TableDynamicRowsBuilding(DrillObj,JsnObj){
		var DynamicRows = "";
		var RevTableHeader = "";
		var TableBody = "";
		var RevTableFooter = "";
		var Column_Colspan = "";
		var Column_Hdngs = "";
		var FontClrAndWt = "font-weight:bold;color:#000066;text-align:center;";
		var CeCode = "";
		var bgclrr="";
		var rowno = 0;
		$.each(JsnObj, function(key, value) {
		if(DrillObj["DataClick"]=="eg"){
			if(key =="BRE@Nmonths"){
				var bgnum = 2;
				for(var mon=0;mon<value.length;mon++){
					// Alternative Background Color
					if (bgnum % 2 == 0) {
						bgclrr="#e6eeff";
					}else {
						bgclrr="";
					}
					Column_Colspan+="<td colspan='5' style='"+FontClrAndWt+"background-color:"+bgclrr+"'>"+value[mon]+"</td>";
					Column_Hdngs+="<td class='plan' style='"+FontClrAndWt+"background-color:"+bgclrr+"'>Plan</td><td class='actual' style='"+FontClrAndWt+"background-color:"+bgclrr+"'>Actual</td><td class='var' style='"+FontClrAndWt+"background-color:"+bgclrr+"'>Variance</td><td class='varp' style='"+FontClrAndWt+"background-color:"+bgclrr+"'>Variance%</td><td class='class='ReviewRemark'' style='"+FontClrAndWt+"background-color:"+bgclrr+"'>Remark</td>";
					bgnum++;
				}
				RevTableHeader+="<tr class='TableHeads' ><td class='freezeClass1 ElemGroupCol feg1'></td><td class='freezeClass1 costElementCol fce1'></td><td class='freezeClass1 businessDivisionCol fbd1'></td><td class='freezeClass1 departmentCol fdep1'></td><td class='freezeClass1 DivisionCol fdv1'></td><td class='freezeClass1 RegionCol frgn1'></td><td class='freezeClass1 TerritoryCol fter1'></td>"+Column_Colspan+"<td id='colspan' colspan='4' style='"+FontClrAndWt+"background-color:lightgreen'>Total</td></tr><tr class='TableHeads'><td class='ElemGroupCol' style='"+FontClrAndWt+"' >Element Group</td><td class='costElementCol' style='"+FontClrAndWt+"'>Cost Element</td><td class='businessDivisionCol' style='"+FontClrAndWt+"' >Business Division</td><td class='departmentCol' style='"+FontClrAndWt+"'>Department</td><td class='DivisionCol' style='"+FontClrAndWt+"'>Division</td><td class='RegionCol' style='"+FontClrAndWt+"'>Region</td><td class='TerritoryCol' style='"+FontClrAndWt+"'>Territory</td>"+Column_Hdngs+"<td class='plan' style='"+FontClrAndWt+"background-color:lightgreen'>Plan</td><td class='actual' style='"+FontClrAndWt+"background-color:lightgreen'>Actual</td><td class='var' style='"+FontClrAndWt+"background-color:lightgreen'>Variance</td><td class='varp' style='"+FontClrAndWt+"background-color:lightgreen'>Variance%</td></tr>";
			}else{
				if(key =="BRE@RowTot"){
					RevTableFooter+="<tr class='TableTotal' style='"+FontClrAndWt+"'><td style='"+FontClrAndWt+"background-color:lightgreen'>Total</td><td class='costElementCol'></td><td class='businessDivisionCol'></td><td class='departmentCol'></td><td class='DivisionCol'></td><td class='RegionCol'></td><td class='TerritoryCol'></td>"+MonthWiseCalculation(rowno,key,value)+"</tr>";
				}else{
					// alert(style='position:absolute;')
					DynamicRows+="<tr class='ElemGrouprow'><td  class='drilldown ElemGroup ElemGroup"+rowno+"' data-class='ElemGroup' data-click='ce' data-colval='"+key+"' data-drilldown='CEwisebudget' data-cellindex='"+rowno+"'>"+key+"</td><td class='costElementCol'></td><td class='businessDivisionCol' ></td><td class='departmentCol'></td><td class='DivisionCol'></td><td class='RegionCol'></td><td class='TerritoryCol'></td>"+MonthWiseCalculation(rowno,key,value)+"</tr>";
				}
			}
		}else if(DrillObj["DataClick"]=="ce"){
			if(key == DrillObj["DrillVal"]){
				// Cost Element Code
				CeCode = value;
			}else{
				DynamicRows+='<tr class="costElementrow"><td></td><td  class="drilldown costElementdd costElement'+rowno+'" data-cecode="'+CeCode+'" data-click="bdiv" data-class="costElement" data-elgroup="'+DrillObj["DrillVal"]+'" data-colval="'+key+'" data-drilldown="BDwisebudget" data-cellindex="'+rowno+'" >'+key+'</td><td class="businessDivisionCol" ></td><td class="departmentCol"></td><td class="DivisionCol"></td><td class="RegionCol"></td><td class="TerritoryCol"></td>'+MonthWiseCalculation(rowno,key,value)+'</tr>';
			}
		}else if(DrillObj["DataClick"]=="bdiv"){
			DynamicRows+='<tr class="BusinessDivrow"><td></td><td></td><td class="drilldown BusinessDiv BusinessDiv'+rowno+'" data-cecode="'+DrillObj["CurCECode"]+'" data-click="dept"  data-elgroup="'+DrillObj["CurEleGroup"]+'"  data-class="BusinessDiv" data-colval="'+key+'" data-cellindex="'+rowno+'" data-drilldown="Dwisebudget" >'+key+'</td><td class="departmentCol"><td class="DivisionCol"></td><td class="RegionCol"></td><td class="TerritoryCol"></td>'+MonthWiseCalculation(rowno,key,value)+'</tr>';
		}else if(DrillObj["DataClick"]=="dept"){
			DynamicRows+='<tr class="Departmentrow"><td></td><td></td><td></td><td class="drilldown departmentCol Department Department'+rowno+'" data-cecode="'+DrillObj["CurCECode"]+'" data-click="div" data-elgroup="'+DrillObj["CurEleGroup"]+'"  data-class="Department" data-busdiv="'+DrillObj["CurBuisDiv"]+'" data-colval="'+key+'" data-cellindex="'+rowno+'" data-drilldown="Dwisebudget" >'+key+'</td><td class="DivisionCol"></td><td class="RegionCol"></td><td class="TerritoryCol"></td>'+MonthWiseCalculation(rowno,key,value)+'</tr>';
		}else if(DrillObj["DataClick"]=="div"){
			DynamicRows+='<tr class="Divisionrow"><td></td><td></td><td></td><td></td><td class="drilldown Division Division'+rowno+'" data-cecode="'+DrillObj["CurCECode"]+'" data-click="reg" data-elgroup="'+DrillObj["CurEleGroup"]+'"  data-busdiv="'+DrillObj["CurBuisDiv"]+'" data-dept="'+DrillObj["CurDep"]+'" data-class="Division" data-cellindex="'+rowno+'" data-colval="'+key+'" data-drilldown="Regwisebudget" >'+key+'</td><td class="RegionCol"></td><td class="TerritoryCol"></td>'+MonthWiseCalculation(rowno,key,value)+'</tr>';
		}else if(DrillObj["DataClick"]=="reg"){
			DynamicRows+='<tr class="Regionrow"><td></td><td></td><td></td><td></td><td></td><td class="drilldown Region Region'+rowno+'" data-cecode="'+DrillObj["CurCECode"]+'" data-elgroup="'+DrillObj["CurEleGroup"]+'" data-busdiv="'+DrillObj["CurBuisDiv"]+'" data-dept="'+DrillObj["CurDep"]+'" data-div="'+DrillObj["CurDiv"]+'" data-click="terr" data-class="Region" data-cellindex="'+rowno+'" data-colval="'+key+'" data-drilldown="Regwisebudget" >'+key+'</td><td class="TerritoryCol"></td>'+MonthWiseCalculation(rowno,key,value)+'</tr>';
		}else if(DrillObj["DataClick"]=="terr"){
			DynamicRows+='<tr class="Territoryrow"><td></td><td></td><td></td><td></td><td></td><td></td><td class="drilldown Territory'+rowno+'" data-elgroup="'+DrillObj["CurEleGroup"]+'" data-busdiv="'+DrillObj["CurBuisDiv"]+'" data-dept="'+DrillObj["CurDep"]+'" data-div="'+DrillObj["CurDiv"]+'" data-reg="'+DrillObj["CurRgn"]+'" data-cecode="'+DrillObj["CurCECode"]+'"  data-class="Territory" data-colval="'+key+'" >'+key+'</td>'+MonthWiseCalculation(rowno,key,value)+'</tr>';
		}
		rowno++;		
		});
		if(DrillObj["DataClick"]=="eg"){
			// Append ColumnWise Total AS Table Last Row
			DynamicRows+=RevTableFooter;
			// Append Table Hader AS Table First Row
			DynamicRows = RevTableHeader+=DynamicRows;
		}
		return DynamicRows;
	}
	// Monthwise Plan,Actual,variance,Variance Per Rows build
	function MonthWiseCalculation(rowno,JsKey,MonWiseArrVal){
		var MonthWiseData = "";
		var bgnum = 2;
		var CmntNUm = 1;
		var BudRemark = "";
		var bgclrr="";
		for(var i=0;i<MonWiseArrVal.length;i++){
			// Alternative Background Color
			if (bgnum % 2 == 0) {
				// Color For Total
				if(i == MonWiseArrVal.length-1){
					bgclrr = "lightgreen";
				}else{
					bgclrr="#e6eeff";
				}
			}else {
				bgclrr="";
			}
			if(i == MonWiseArrVal.length-1){
				BudRemark = "";
			}else{
				if(JsKey == "BRE@RowTot"){
					BudRemark = '<td class="ReviewRemark BudgetRemark" style="background-color:'+bgclrr+'"></td>';
				}else{
					// Comment modal popup
					BudRemark = '<td class="ReviewRemark BudgetRemark" style="background-color:'+bgclrr+'"><div><button class="btn" style="color:white;background-color:#02cf92" data-toggle="modal" data-target="#ReviewCommentCG'+rowno+''+CmntNUm+'">Comment</button><div class="modal fade" id="ReviewCommentCG'+rowno+''+CmntNUm+'" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header" style="background-color:#02cf92"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title" style="color:white;background-color:#02cf92">Enter Your Comment:</h4></div><div class="modal-body"><textarea class="ReviewCommentCG'+rowno+''+CmntNUm+' form-control" rows="5" name=""></textarea></div><div class="modal-footer" style="background-color:#02cf92"><button type="button" class="RevCommentReset btn btn-default" onclick="ReviemRemarkReset(this)">Reset</button><button type="button" class="RevCommentSave btn btn-default" onclick="ReviemRemarkSave(this)">Save</button><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></div></div></td>';
				}
			}
			$.each(MonWiseArrVal[i], function(key, value) {
				if(key == "plan"){
					// alert("plan");
					MonthWiseData +="<td class='plan' style='background-color:"+bgclrr+"'>"+value+"</td>";
				}else if(key =="actual"){
					// alert("act");
					MonthWiseData +="<td class='actual' style='background-color:"+bgclrr+"'>"+value+"</td>";
				}else if(key =="var"){
					// alert("var");
					MonthWiseData +="<td class='var' style='background-color:"+bgclrr+"'>"+value+"</td>";
				}else if(key =="varp"){
					// alert("varp");
					MonthWiseData +="<td class='varp' style='background-color:"+bgclrr+"'>"+value+"</td>"+BudRemark+"";
				}
			});
			bgnum++;
			CmntNUm++;
		}
		return MonthWiseData;
	}
});