$(document).ready(function($) {
  
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
      if($("#Planhs").prop("checked") == true){
        $('.plan').show();
      }else{
        $('.plan').each(function(index, el) {
            $(this).css('display','none');
        });
      }
      if($("#Actualhs").prop("checked") == true){
        $('.actual').show();
      }else{
        $('.actual').each(function(index, el) {
            $(this).css('display','none');
        });
      }
      if($("#Varhs").prop("checked") == true){
        $('.var').show();
      }else{
        $('.var').each(function(index, el) {
            $(this).css('display','none');
        });
      }
      if($("#Varphs").prop("checked") == true){
        $('.varp').show();
      }else{
        $('.varp').each(function(index, el) {
            $(this).css('display','none');
        });
      }
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

var defaultDrillView = {'ceg':"EGwisebudget",'ce':"CEwisebudget",'bdiv':"BDwisebudget","dept":"DEPTwisebudget",'div':"Divwisebudget",'reg':"Regwisebudget",'terr':"Terrwisebudget"};
//Below array is for Every column last element hide and show
var AllColumnClass = ["ElemGrouprow","costElementrow","BusinessDivrow","Departmentrow","Divisionrow","Regionrow","Territoryrow"]
	 $(".filter-form").submit(function(event) {
	 	$(".cpath").html('');
	 	$(".sticky").css('display', 'none');
		 // $("#loader-wrapper").css('display','block'); 
	 	var sdata = $(".filter-form").serializeObject();
		var	cdd = 'ceg';
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
	 			var res = getresult(sdata1);
	 			var lastRow = res.length-1;
	 			var budgetCalander = res[lastRow];
	 			$("#t_head").html(budgetCalander);
	 			//console.log(budgetCalander);
	 			delete res[lastRow];
	 			var rowrews = '';
	 			for(var j in res){
	 				rowrews +=res[j];
	 			}
	 			$("#t_body").html(rowrews);
	 			// Hide empty columns
		          $('.colspanhead').attr('colspan','2');
		          $('.costElementCol').css('display','none');
		          $('.businessDivisionCol').css('display','none');
		          $('.departmentCol').css('display','none');
		          $('.DivisionCol').css('display','none');
		          $('.RegionCol').css('display','none');
		          $('.TerritoryCol').css('display','none');
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
	 			});
	 		}
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
	 	  	var DrillVal = $(this).data("colval"); 
	 	  	var CellIndexVal = $(this).data("cellindex"); 
	 	  	var DataClick = $(this).data("click"); 
	 	  	var DataClass = $(this).data("class"); 
	 	  	var parentclass = $(this).parent().attr('class');
	 	  	var sdata = $(".filter-form").serializeObject();
			var drilldown ={};
			var ElemPass="";
			if(DataClick == 'ce'){
				sdata['expgroup[]'] = $(this).data("colval");
				cpath.push(cellText);
			}else if(DataClick == 'bdiv'){
				sdata['expgroup[]'] = $(this).data("elgroup");
				sdata['costElement[]'] = $(this).data("cecode");
				cpath.push($(this).data("elgroup"));
				cpath.push(cellText);
			}else if(DataClick == 'dept'){
				sdata['expgroup[]'] = $(this).data("elgroup");
				sdata['costElement[]'] = $(this).data("cecode");
				sdata['pdivision[]'] = $(this).data("colval");

				cpath.push($(this).data("elgroup"));
				ce = $(this).parent("tr").prevAll(".costElementrow:first").find(".drilldown").text();
				cpath.push(ce);
				cpath.push(cellText);

			}else if(DataClick == 'div'){
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

			var pathbreadcum = '';
			for(var pn in cpath){
				 pathbreadcum+='<li class="breadcrumb-item"><a href="javascript:void(0)">'+cpath[pn]+'</a></li>';
			}

			if(pathbreadcum!=""){
				$(".sticky").css('display', 'block');
			}else{
				$(".sticky").css('display', 'hide');
			}

			$(".cpath").html(pathbreadcum);

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
 				var rowrews = '';
 				// alert(res.length);
	 			for(var k in res){
	 				rowrews +=res[k];
	 			}
	 			// console.log(rowrews);
 				// $("."+DataClass+CellIndexVal).parent().after(rowrews);
 				$(this).parent().after(rowrews);
 				$(this).data('drillval','yes');
 					if(DataClick == 'ce'){	
						// Hide empty columns
				        if($('.costElementCol').css('display') == 'none'){
				        	$('.costElementCol').show();
				          	$('#colspanhead').attr('colspan','2');
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
					}else if(DataClick == 'bdiv'){
					// Hide empty columns
			        if($('.businessDivisionCol').css('display') == 'none'){
			        	$('.businessDivisionCol').show();
			          	$('#colspanhead').attr('colspan','3');
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
					}else if(DataClick == 'dept'){
						// Hide empty columns
				        if($('.departmentCol').css('display') == 'none'){
				        	$('.departmentCol').show();
				          	$('#colspanhead').attr('colspan','4');
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
					}else if(DataClick == 'div'){
						// Hide empty columns
				        if($('.DivisionCol').css('display') == 'none'){
				        	$('.DivisionCol').show();
				          	$('#colspanhead').attr('colspan','5');
				        }
				        if($('.RegionCol').css('display') == 'none'){
					        $('.RegionCol').css('display','none');
					    }
					    if($('.TerritoryCol').css('display') == 'none'){
					        $('.TerritoryCol').css('display','none');	
					    }		
					}else if(DataClick == 'reg'){
						// Hide empty columns
				        if($('.RegionCol').css('display') == 'none'){
				        	$('.RegionCol').show();
				          	$('#colspanhead').attr('colspan','6');
				        }
				        if($('.TerritoryCol').css('display') == 'none'){
					        	$('.TerritoryCol').css('display','none');	
					    }		
					}else if(DataClick == 'terr'){
						// Hide empty columns
				        if($('.TerritoryCol').css('display') == 'none'){
				        	$('.TerritoryCol').show();
				          	$('#colspanhead').attr('colspan','7');
				        }	
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
	 		type: 'GET',
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

	 
});