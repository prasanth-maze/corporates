$(document).ready(function($) {
	CurrencyInt(85177825461110);
  // Monthwise Column Header increment variable for set colspan
  Increment = 0;

  var cview = 'chart';
   var ddclick = 0;
   CL = null;
   CE = null;
   MC = null;
  var filterArr = [];
  var currentfiter = null;
  var cegclick = 'no';
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
	      var FilterAction={};
	      FilterAction["Action"]="getCostElement";

	      var PDvsn = $("#pdivision").val();
	      var Dvsn = $("#division").val(); 
	      var Rgn = $("#region").val(); 
	      
	      FilterAction["Dvsn[]"]=Dvsn;
	      FilterAction["PDvsn[]"]=PDvsn;
	      FilterAction["Dept[]"]=$("#FiltrtDep").val();
	      FilterAction["Rgn[]"]=Rgn;
	      FilterAction["terr[]"]=$("#terriotry").val()
	     
	      
	       FilterAction["ElemGroup[]"]=ElemGroup;
	      
		genFilter(FilterAction);
	     
    });	 


	 

	 // Product Division Ajax
	 $("#pdivision").on("change",function(event) {
	     var PDvsn = $(this).val(); 
	     var FilterAction={};
	      FilterAction["Action"]="getDepartment";
	      
	      	FilterAction["PDvsn[]"]=PDvsn;	
	      
	     	genFilter(FilterAction);
    });

	 function genFilter(FilterAction){
	 	$.ajax({
	           	url: 'BudgetSelectBoxFilter.php',
	           	type: 'POST',
	           	dataType: 'JSON',
	           	data: FilterAction,
	           	async:false,
	           	success:function(res){
	            	//console.log(res);

	            	$.each(res,function(index, el) {
	            		var opt = '';
	            		if(index=='BusinessDivision'){
	            			$.each(el,function(index1, el1) {
	            				opt+='<option selected="selected" value="'+el1+'">'+el1+'</option>';
	            			});
	            			$('#pdivision').html(opt);
		            		$('#pdivision').multiselect("rebuild");
		            	}else if(index=='DepartmentName'){
	            			$.each(el,function(index1, el1) {
	            				opt+='<option selected="selected" value="'+el1+'">'+el1+'</option>';
	            			});
	            			$('#FiltrtDep').html(opt);
		            		$('#FiltrtDep').multiselect("rebuild");
	            		}else if(index=='Division'){
	            			$.each(el,function(index1, el1) {
	            				opt+='<option selected="selected" value="'+el1+'">'+el1+'</option>';
	            			});
	            			$('#division').html(opt);
		            		$('#division').multiselect("rebuild");
	            		}else if(index=='Region'){
	            			$.each(el,function(index1, el1) {
	            				opt+='<option selected="selected" value="'+el1+'">'+el1+'</option>';
	            			});
	            			$('#region').html(opt);
		            		$('#region').multiselect("rebuild");
	            		}else if(index=='Territory'){
	            			$.each(el,function(index1, el1) {
	            				opt+='<option selected="selected" value="'+el1+'">'+el1+'</option>';
	            			});
	            			$('#terriotry').html(opt);
		            		$('#terriotry').multiselect("rebuild");
	            		}else if(index=='CostElementGroup'){
	            			$.each(el,function(index1, el1) {
	            				opt+='<option selected="selected" value="'+el1+'">'+el1+'</option>';
	            			});
	            			$('#expgroup').html(opt);
		            		$('#expgroup').multiselect("rebuild");
	            		}else if(index=='CostElementName'){
	            			$.each(el,function(index1, el1) {
	            				opt+='<option selected="selected" value="'+el1+'">'+el1+'</option>';
	            			});
	            			$('#costElement').html(opt);
		            		$('#costElement').multiselect("rebuild");
	            		}

	            	});
	            }
	        });
	 }

	 //Department wise Ajax
	  $("#FiltrtDep").on("change",function(event) {
	  	var Dept = $(this).val();
	     var FilterAction={};
	      FilterAction["Action"]="getDivision";
	      FilterAction["PDvsn"]=$("#pdivision").val();

	      	FilterAction["Dept[]"]=Dept;	
	     
	   	 genFilter(FilterAction);
	     	
    })
	 // Division Ajax
	 $("#division").on("change",function(event) {
	 	var PDvsn = $("#pdivision").val(); 
	    var Dvsn = $(this).val(); 
	      FilterAction={};
	      FilterAction["Action"]="getRegion";
	      FilterAction["PDvsn[]"]=PDvsn;
	      FilterAction["Dept[]"]=$("#FiltrtDep").val();
	      
	     
	        FilterAction["Dvsn[]"]=Dvsn
	      
	     
	         		genFilter(FilterAction);
	     	
    });
	 // Region Ajax
	 $("#region").on("change",function(event) { 
	      var PDvsn = $("#pdivision").val();
	      var Dvsn = $("#division").val(); 
	      var Rgn = $(this).val(); 
	      var FilterAction={};
	      FilterAction["Action"]="getTerritory";
	      FilterAction["Dvsn[]"]=Dvsn;
	      FilterAction["PDvsn[]"]=PDvsn;
	      FilterAction["Dept[]"]=$("#FiltrtDep").val();
	      FilterAction["Rgn[]"]=Rgn;

	     
	        FilterAction["Rgn[]"]=Rgn;
	      
	     	genFilter(FilterAction);
    });


	 // terriotry Ajax
	 $("#terriotry").on("change",function(event) { 
	      var PDvsn = $("#pdivision").val();
	      var Dvsn = $("#division").val(); 
	      var Rgn = $("#region").val(); 
	      var FilterAction= {};
	      FilterAction["Action"]="getCostElementgroup";
	      FilterAction["Dvsn[]"]=Dvsn;
	      FilterAction["PDvsn[]"]=PDvsn;
	      FilterAction["Dept[]"]=$("#FiltrtDep").val();
	      FilterAction["Rgn[]"]=Rgn;
	     
	      
	        FilterAction["terr[]"]=$(this).val(); 
	      
	     	genFilter(FilterAction);
    });

var defaultDrillView = {'ceg':"EGwisebudget",'ce':"CEwisebudget",'bdiv':"BDwisebudget","dept":"DEPTwisebudget",'div':"Divwisebudget",'reg':"Regwisebudget",'terr':"Terrwisebudget"};
//Below array is for Every column last element hide and show
var AllColumnClass = ["ElemGrouprow","costElementrow","BusinessDivrow","Departmentrow","Divisionrow","Regionrow","Territoryrow"]
	 $("body").on("submit",".filter-form",function(event){
	 	 
	 	var res = null;
	 	$(".cpath").html('');
	 	$(".sticky").css('display', 'none');
		/* if($("#pdivision").val().length==1){
		 	$(".GeoChartAction").val('DEPTwisebudget');
		 }else if($("#FiltrtDep").val().length==1){
		 	$(".GeoChartAction").val('Divwisebudget');
		 }else if($("#division").val().length==1){
		 	$(".GeoChartAction").val('Regwisebudget');
		 }else if($("#region").val().length==1){
		 	$(".GeoChartAction").val('Terrwisebudget');
		 }else if($("#terriotry").val().length==1){
		 	$(".GeoChartAction").val('Terrwisebudget');
		 }*/

		 /*if($("#expgroup").val().length==1){
		 	$(".ExpChartAction").val('CEwisebudget');
		 }else if($("#costElement").val().length==1){
		 	$(".ExpChartAction").val('CEwisebudget');
		 }*/

	 	var sdata = $(".filter-form").serializeObject();
	 	fsdata = sdata;

	 	if(CL==null){
	 		CL = 'PDIV';
	 	}


	 	if(CE==null){
		 	CE = 'CEG';
		 }

		 if(MC==null){
		 	MC = 'ALL';
		 }

		fsdata['MC'] = MC;
	 	fsdata['CL'] = CL;
	 	fsdata['CE'] = CE;

	 	fsdata['GeoChartAction'] = $(".GeoChartAction").val();
	 	fsdata['ExpChartAction'] = $(".ExpChartAction").val();
	 	filterArr[ddclick] = fsdata;

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
	 			var BRENmonths = res['BRE@Nmonths'];	 			
	 			var totmdata = 0;
	 			var theads1='';
	 			var bgcls = 'dhbg'
	 			var theads  = "<tr class='TableHeads'><th class='fixed freeze scrolling_table_1' id='colspanhead' colspan='1'><div class='sticky'><ol class='breadcrumb breadcrumb-arrow cpath' style='margin-left: -10px'></ol></div></th>";
	 			for (var im in BRENmonths){
	 				theads +="<th class='fixed freeze_vertical scrolling_table_1 MonthsColspan "+bgcls+"' colspan='4' >"+BRENmonths[im]+"</th>";
	 				theads1 +="<th class='fixed freeze_vertical scrolling_table_1 plan "+bgcls+"' >Plan</th><th class='fixed freeze_vertical scrolling_table_1 actual "+bgcls+"'>Actual</th><th class='fixed freeze_vertical scrolling_table_1 var "+bgcls+"'>Variance</th><th class='fixed freeze_vertical scrolling_table_1 varp "+bgcls+"'>Variance%</th>"
	 				if(bgcls=='dhbg'){
	 						bgcls = 'dhnbg';
	 					}else{
	 						bgcls = 'dhbg';
	 					}
	 				totmdata++;
	 			}
	 			theads1 +="<th class='fixed freeze_vertical scrolling_table_1 plan totdbg'>Plan</th><th class='fixed freeze_vertical scrolling_table_1 actual totdbg'>Actual</th><th class='fixed freeze_vertical scrolling_table_1 var totdbg' >Variance</th><th class='fixed freeze_vertical scrolling_table_1 varp totdbg'>Variance%</th>"
	 			theads +="<th class='fixed freeze_vertical scrolling_table_1 totdbg' id='colspan' colspan='4'>Total</th></tr><tr class='TableHeads'><th class='fixed freeze scrolling_table_1 ElemGroupCol' style='font-weight:bold;color:#000066;' >Element Group</th><th class='fixed freeze scrolling_table_1 costElementCol' style='font-weight:bold;color:#000066;display:none'>Cost Element</th><th class='fixed freeze scrolling_table_1 businessDivisionCol' style='font-weight:bold;color:#000066;display:none' >Business Division</th><th class='fixed freeze scrolling_table_1 departmentCol' style='font-weight:bold;color:#000066;display:none'>Department</th> 	<th class='fixed freeze scrolling_table_1 DivisionCol' style='font-weight:bold;color:#000066;display:none'>Division</th> 	<th class='fixed freeze scrolling_table_1 RegionCol' style='font-weight:bold;color:#000066;display:none'>Region</th> 	<th class='fixed freeze scrolling_table_1 TerritoryCol' style='font-weight:bold;color:#000066;display:none'>Territory</th>"+theads1+"</tr>";

	 			$("#t_head").html(theads);
	 			var BRERowTot = res['BRE@RowTot'];
	 			delete res['BRE@Nmonths'];
	 			delete res['BRE@RowTot'];
	 			totmdata = totmdata+1;
	 			
	 			var rowrews = '';
	 			var crow = 1;
	 			$("#t_body").html("");
	 			$.each(res,function(index,el){
	 				rowrews = "<tr class='ElemGrouprow'><td class='fixed freeze_horizontal scrolling_table_1 drilldown ElemGroup ElemGroup"+crow+"' data-class='ElemGroup' data-click='ce' data-colval='"+index+"' data-drilldown='CEwisebudget' data-cellindex='"+crow+"'>"+index+"</td><td class='fixed freeze_horizontal scrolling_table_1 costElementCol'></td><td class='fixed freeze_horizontal scrolling_table_1 businessDivisionCol'></td>	<td class='fixed freeze_horizontal scrolling_table_1 departmentCol'></td><td class='fixed freeze_horizontal scrolling_table_1 DivisionCol'></td><td class='fixed freeze_horizontal scrolling_table_1 RegionCol'></td><td class='fixed freeze_horizontal scrolling_table_1 TerritoryCol'>";
	 				var bgcls = 'dwbg';
	 				var cdc = 1;
	 				$.each(el,function(didx,data){
	 					if(cdc==totmdata){
	 						bgcls = "totdbg";
	 					}
	 					rowrews += "<td class='plan "+bgcls+"' >"+CurrencyInt(data.PLAN)+"</td><td class='actual "+bgcls+"'>"+CurrencyInt(data.ACTUAL)+"</td><td class='var "+bgcls+"'>"+CurrencyInt(data.VARIANCE)+"</td><td class='varp "+bgcls+"'>"+data.VARIANCEP+"</td>";
	 					if(bgcls==''){
	 						bgcls = 'dwbg';
	 					}else{
	 						bgcls = '';
	 					}
	 					cdc++;
	 				});


	 				rowrews+="</tr>";
					$("#t_body").append(rowrews);
	 				crow++;
	 			});
	 			var totrowres = '';
	 			
	 			$.each(BRERowTot,function(ix,data){
	 				totrowres+="<td class='plan' >"+CurrencyInt(data.PLAN)+"</td><td class='actual'>"+CurrencyInt(data.ACTUAL)+"</td><td class='var'>"+CurrencyInt(data.VARIANCE)+"</td><td class='varp'>"+data.VARIANCEP+"</td>";
	 			})
	 			res['BRE@Nmonths'] = BRENmonths;
	 			res['BRE@RowTot'] = BRERowTot;
	 			rowrews ="<tr class='TableTotal' style='background-color:lightgreen;font-weight:bold;color:#000066;'><td class='fixed freeze_horizontal scrolling_table_1'>Total</td><td class='fixed freeze_horizontal scrolling_table_1 costElementCol'></td><td class='fixed freeze_horizontal scrolling_table_1 businessDivisionCol'></td><td class='fixed freeze_horizontal scrolling_table_1 departmentCol'></td><td class='fixed freeze_horizontal scrolling_table_1 DivisionCol'></td><td class='fixed freeze_horizontal scrolling_table_1 RegionCol'></td><td class='fixed freeze_horizontal scrolling_table_1 TerritoryCol'></td>"+totrowres+"</tr>";
	 			$("#t_body").append(rowrews);
	 			// Hide empty columns
		          $('.colspanhead').attr('colspan','2');
		          $('.costElementCol').css('display','none');
		          $('.businessDivisionCol').css('display','none');
		          $('.departmentCol').css('display','none');
		          $('.DivisionCol').css('display','none');
		          $('.RegionCol').css('display','none');
		          $('.TerritoryCol').css('display','none');
		          // Plan,Actual,Variance,VariancePer CheckedOnly
				  PlanActVarVarP_CheckedOnly();
				  $(".MonthsColspan").attr('colspan',Increment);
	 		}else if(i=='ce'){
	 			sdata1['Action'] = drilldown[i];
	 			var res = getresult(sdata1);
	 		}
	 	}

	 	/*if(cview=='chart'){*/
	 			genMonthwiseBudgetChart(res);
	 			sdata['Action'] = $(".GeoChartAction").val();
		 		genGeowiseBudgetChart(sdata);
		 		sdata['Action'] = $(".ExpChartAction").val();
		 		genExpenseChart(sdata,res);
	 		
	 /*	}*/

	 	

	 		$("td:first-child").each(function(index, el) {
	 			$(this).addClass('freezeClass');
	 		});
	 		$("th:first-child").each(function(index, el) {
	 			$(this).addClass('freezeClass');
	 		});
	 	   $("#loader-wrapper").css('display','none'); 
	 	 return false;
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
	 /*		planArr.push(parseInt(mdata[c]['PLAN'].replace(/,/g,'')));
	 		actualArr.push(parseInt(mdata[c]['ACTUAL'].replace(/,/g,'')));
	 		varArr.push(parseInt(mdata[c]['VARIANCE'].replace(/,/g,'')));*/
	 		planArr.push(parseInt(mdata[c]['PLAN']));
	 		actualArr.push(parseInt(mdata[c]['ACTUAL']));
	 		varArr.push(parseInt(mdata[c]['VARIANCE']));
	 	}

	 /*	console.log(category);
	 	console.log(mdata);
	 	console.log(planArr);
	 	console.log(actualArr);
	 	console.log(varArr);*/
	 	
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

	 mc.xAxis[0].labelGroup.element.childNodes.forEach(function(label){
	 	if(MC!='ONE'){
	 		label.style.cursor = "pointer";
	 	}
	 			
	 		 label.onclick = function(events){
	 		 	if(MC!='ONE'){
	 		 	var myName = $(this).find('tspan:eq(0)').text();
	 		 	var my = $(this).find('tspan:eq(1)').text();
	 		 	$("#fromMY").val(my);
	 		 	$("#toMY").val(my);
	 		 	ddclick = ddclick+1;
	 		 	if(MC=='ALL'){
	 		 		MC ='ONE';
	 		 	}
	 		 	$("#myBudgettitle").text(myName);

	 		 	$(".filter-form").submit();
	 			 }
	 		 }
      	});
}

function genGeowiseBudgetChart(sdata){
		
		 sdata['datafor'] = 'chart';

		var res = getresult(sdata);
		var category = [];
	 	var planArr = [];
	 	var actualArr = [];
	 	var varArr = [];
	 	$.each(res,function(index, el) {
	 		//console.log(el);
 			category.push(index);
 			/*planArr.push(parseInt(el[totindex]['plan'].replace(/,/g,'')));
	 		actualArr.push(parseInt(el[totindex]['actual'].replace(/,/g,'')));
	 		varArr.push(parseInt(el[totindex]['var'].replace(/,/g,'')));*/
	 		planArr.push(parseInt(el.PLAN));
	 		actualArr.push(parseInt(el.ACTUAL));
	 		varArr.push(parseInt(el.VARIANCE));
	 	});

	 /*	console.log(category);
	 	console.log(planArr);
	 	console.log(actualArr);
	 	console.log(varArr);*/
	 	
	 	
	 	
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
	 	 	if(CL!='TERR1'){
	 			label.style.cursor = "pointer";
	 		}
	 			
	 		 label.onclick = function(events){
	 		 	if(CL!='TERR1'){
	 		 	var lname = $(this).text();
	 		 	ddclick = ddclick+1;
	 		 	
	 		 
	 		 	if(CL=='PDIV'){
	 		 		 $("#pdivision option").prop('selected', false);
	 		 		 $("#pdivision option[value='"+lname+"']").prop('selected', true);
	 		 		 $('#pdivision').multiselect("rebuild");
            		 $("#pdivision").change();
            		 CL = 'DEPT';
            		 $("#geoBudgettitle").text(geoBudgettitle['DEPTwisebudget']);
            		 //cdd = 'bdiv';
            
		 			$('.GeoChartAction').val('DEPTwisebudget');
		
	 		 	}else if(CL=='DEPT'){
	 		 		$("#FiltrtDep option").prop('selected', false);
	 		 		 $("#FiltrtDep option[value='"+lname+"']").prop('selected', true);
	 		 		 $('#FiltrtDep').multiselect("rebuild");
            		 $("#FiltrtDep").change();
            		 CL = 'DIV';
            		$("#geoBudgettitle").text(geoBudgettitle['Divwisebudget']);
            		 $('.GeoChartAction').val('Divwisebudget');
            		
            		 //cdd = 'dept';
	 		 	}else if(CL=='DIV'){
	 		 		 $("#division option").prop('selected', false);
	 		 		 $("#division option[value='"+lname+"']").prop('selected', true);
	 		 		 $('#division').multiselect("rebuild");
            		 $("#division").change();
            		 CL = 'REG';
            		 $("#geoBudgettitle").text(geoBudgettitle['Regwisebudget']);
            		 $('.GeoChartAction').val('Regwisebudget');
            		 //cdd = 'div';
	 		 	}else if(CL=='REG'){
	 		 		$("#region option").prop('selected', false);
	 		 		 $("#region option[value='"+lname+"']").prop('selected', true);
	 		 		 $('#region').multiselect("rebuild");
            		 $("#region").change();
            		 CL = 'TERR';
            		 $("#geoBudgettitle").text(geoBudgettitle['Terrwisebudget']);
            		 $('.GeoChartAction').val('Terrwisebudget');
            		 //cdd = 'reg';
	 		 	}else if(CL=='TERR'){
            		CL = 'TERR1';
            		//cdd = 'terr';
            		 $("#geoBudgettitle").text(geoBudgettitle['Terrwisebudget']);
            		 $("#terriotry option").prop('selected', false);
	 		 		 $("#terriotry option[value='"+lname+"']").prop('selected', true);
	 		 		 $('#terriotry').multiselect("rebuild");
	 		 	}

	 		 		//alert(CL);

	 		 	$(".filter-form").submit();
	 		 }
	 		 }
      	});
}
function genExpenseChart(sdata,cdata){	
		var category = [];
	 	var planArr = [];
	 	var actualArr = [];
	 	var varArr = [];
	 	var category =[];
	 	var planArr =[];
	 	var actualArr =[];
	 	var varArr =[];	
	if(sdata['Action']=='EGwisebudget'){
	 	var totindex = cdata['BRE@Nmonths'].length;
		delete cdata['BRE@Nmonths'];
		delete cdata['BRE@RowTot'];
		$.each(cdata,function(index, el) {
	 		category.push($.trim(index));
	 		/*planArr.push(parseInt(el[totindex]['plan'].replace(/,/g,'')));
	 		actualArr.push(parseInt(el[totindex]['actual'].replace(/,/g,'')));
	 		varArr.push(parseInt(el[totindex]['var'].replace(/,/g,'')));*/
	 		planArr.push(parseInt(el[totindex]['PLAN']));
	 		actualArr.push(parseInt(el[totindex]['ACTUAL']));
	 		varArr.push(parseInt(el[totindex]['VARIANCE']));
	 	});
	 }else if(sdata['Action']=='CEwisebudget') {
	 	//sdata['Action'] = 'CEwisebudget';
	 	var res = getresult(sdata);
	 	cdata = res;
	 	$.each(cdata,function(index, el) {
	 		category.push($.trim(index));
	 		planArr.push(parseInt(el['PLAN']));
	 		actualArr.push(parseInt(el['ACTUAL']));
	 		varArr.push(parseInt(el['VARIANCE']));
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
					if(ddclick>=1 ){
						chart.renderer.button(' < Back',1100,5)
						  .attr({
			                zIndex: 3,
			                class:'btn btn-default cbackbtn'
			            }).add();
					}
				});


	 	 ec.xAxis[0].labelGroup.element.childNodes.forEach(function(label){

	 	 	if(CE!='CE1'){
	 	 		label.style.cursor = "pointer";	
	 	 	}
	 		

	 		 label.onclick = function(events){
	 		 	if(CE!='CE1'){
		 		 	if($(this).find('.lname').length>0){
		 		 		var lname = $(this).find('.lname').text();
		 		 	}else{
		 		 		var lname = $(this).text();
		 		 	}
		 		 	
		 		 	ddclick = ddclick+1;
		 		 		 		 	
		 		 	if(CE=='CEG'){	 	
		 		 	$(".ExpChartAction").val('EGwisebudget');
		 		 		$("#expgroup option").prop('selected', false);
		 		 		 $("#expgroup option[value='"+lname+"']").prop('selected', true);
		 		 		 $('#expgroup').multiselect("rebuild");
	            		 $("#expgroup").change();
	            		CE = 'CE';
	            		 $("#elmBudgettitle").text(elmBudgettitle['CEwisebudget']);
	            		 $(".ExpChartAction").val("CEwisebudget");
	            		 //cdd = 'bdiv';
		 		 	}else if(CE=='CE' || CE=='CE1'){
		 		 		 $("#costElement option").prop('selected', false);
		 		 		 $("#costElement option:contains("+lname+")").prop('selected', true);
		 		 		 $('#costElement').multiselect("rebuild");    
		 		 		 $("#elmBudgettitle").text(elmBudgettitle['CEwisebudget']);		 
		 		 		 $(".ExpChartAction").val("CEwisebudget");
	            		 //cdd = 'dept';
	            		 	CE = 'CE1';
		 		 	}

		 		 	$(".filter-form").submit();
		 		 }
		 		}
      	});
}

$("body").on("click",".fresetbtn",function(){
     window.location.reload();
  });

	 // // $('.TableHeads').css('text-align','center');
	 // // $('.TableHeads').css('font-weight','bold');
	 // $('.TableHeads').css('color','#000066');

	 $("body").on('click',".bdataTable",function(){
	 		cview = 'table';
	 	  // $(".filter-form").submit();
	 });

var geoBudgettitle={BDwisebudget:"Business division",DEPTwisebudget:"Department",Divwisebudget:"Division",Regwisebudget:"Region",Terrwisebudget:"Territory"};
var elmBudgettitle={EGwisebudget:"Cost element group",CEwisebudget:"Cost element"};
	 var filterOrderArr = ['from','to','pdivision[]','division[]','department[]','region[]','terriotry[]','expgroup[]','costElement[]'];
$("body").on("click",".cbackbtn", async function(){	
    filterArr.splice(ddclick,1);
     ddclick = ddclick - 1;
     console.log(filterArr);
     console.log(ddclick);
     console.log(filterArr[ddclick]);
    var cfilterobj = filterArr[ddclick];    
    if(ddclick==0){

    }
    $("#myBudgettitle").text('Monthly budget');
    	 await $.each(cfilterobj,function(index, el) {
    		if(index=='Action')
    		{

    		}else if(index=='MC'){
    			MC = el;
    		}else if(index=='CL'){
    			CL = el;
    		}else if(index=='CE'){
    			CE = el;
    		}else if(index=='GeoChartAction'){
    			$("#geoBudgettitle").text(geoBudgettitle[el]);    			
    			$(".GeoChartAction").val(el);
    		}else if(index=='ExpChartAction'){
    				if(el=='EGwisebudget')
    					CE=null;
    			$(".ExpChartAction").val(el);
    			$("#elmBudgettitle").text(elmBudgettitle[el]);
    		}else if(index=='from'){
    			$("input[name='from']").val(el);
    		}else if(index=='to'){
    			$("input[name='to']").val(el);
    		}else if(index=='pdivision[]'){
    			 $("#pdivision option").prop('selected', false);
    			 if(typeof el=='string'){
    			 	$("#pdivision option[value='"+el+"']").prop('selected', true);
    			 }else{
    			 	$.each(el,function(pindex, pdiv) {
    					$("#pdivision option[value='"+pdiv+"']").prop('selected', true);
    				});
    			 }
    			
    			$('#pdivision').multiselect("rebuild");
    			$("#pdivision").change();        		 
    		}else if(index=='department[]'){
				$("#FiltrtDep option").prop('selected', false);
				if(typeof el=='string'){
						$("#FiltrtDep option[value='"+el+"']").prop('selected', true);	
				}else{
						$.each(el,function(deptindex, dept) {
							$("#FiltrtDep option[value='"+dept+"']").prop('selected', true);
						});
				}
				
				$('#FiltrtDep').multiselect("rebuild");
    			$("#FiltrtDep").change();       
    		}else if(index=='division[]'){
				$("#division option").prop('selected', false);
				if(typeof el=='string'){
					$("#division option[value='"+el+"']").prop('selected', true);
				}else{
					$.each(el,function(divindex, div) {
						$("#division option[value='"+div+"']").prop('selected', true);
					});
				}
				$('#division').multiselect("rebuild");
    			$("#division").change();       
    		}else if(index=='region[]'){
				$("#region option").prop('selected', false);
				if(typeof el=='string'){
					$("#region option[value='"+el+"']").prop('selected', true);
				}else{
					$.each(el,function(regindex,reg) {
						$("#region option[value='"+reg+"']").prop('selected', true);
					});
				}
				$('#region').multiselect("rebuild");
    			$("#region").change();       
    		}else if(index=='terriotry[]'){
				$("#terriotry option").prop('selected', false);
				if(typeof el=='string'){
					$("#terriotry option[value='"+el+"']").prop('selected', true);
				}else{
					$.each(el,function(terindex, terr) {
						$("#terriotry option[value='"+terr+"']").prop('selected', true);
					});
				}
				$('#terriotry').multiselect("rebuild");
    			$("#terriotry").change();       
    		}else if(index=='expgroup[]'){    			
				$("#expgroup option").prop('selected', false);
				if(typeof el=='string'){
					$("#expgroup option[value='"+el+"']").prop('selected', true);
				}else{
					$.each(el,function(ecegindex, exceg) {
						$("#expgroup option[value='"+exceg+"']").prop('selected', true);
					});
				}
				$('#expgroup').multiselect("rebuild");
    			$("#expgroup").change();       
    		}else if(index=='costElement[]'){
				$("#costElement option").prop('selected', false);
				if(typeof el=='string'){
					$('#costElement option[value="'+el+'"]').prop('selected', true);
				}else{
					$.each(el,function(ceindex, ce) {
						$('#costElement option[value="'+ce+'"]').prop('selected', true);
					});
				}
				$('#costElement').multiselect("rebuild");
				$("#costElement").change();     
    		}
    	});
    
    $(".filter-form").submit();
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
	          //$(this).parent("tr").css('background-color','#8ED1F7');
	          $(this).parent("tr").addClass('selectedRow');
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
					
					var Findlastelem = AllColumnClass.indexOf(DataClass+"row")-(-1);
					var findlastelem1 = AllColumnClass[Findlastelem];
					var nextcolval = $(this).parent().next("tr").attr('class');
					// below variable is for find last element of a row
					var rowexist = $('td').hasClass(DataClass+(CellIndexVal-(-1)));
					if(rowexist==false){						
						var showhideclass1 = "";
						parentclass = parentclass.split(" ");
						parentclass = parentclass[0];
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
							showhideclass1 = showhideclass1.split(" ");
							showhideclass1 = showhideclass1[0];
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
			 						
	 			if(i== DataClick && DataClick=='ce'){
	 					// //console.log(drilldown[i]);
			 			sdata['Action'] = drilldown[i];
		 				var res = getresult(sdata);
		 				//console.log(res);return false;
		 				var rowrews = '';
		 				// alert(res.length);
		 				var rno = 1;
		 				var bgcls = 'dwbg';
		 				$.each(res,function(ceg,cegdata){
	 						$.each(cegdata,function(cel,celdata){
	 							
	 								rowrews +='<tr class="costElementrow"><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1 drilldown costElementdd costElement'+rno+'" data-cecode="'+cel+'" data-click="bdiv" data-class="costElement" data-elgroup="'+ceg+'" data-colval="'+cel+'" data-drilldown="BDwisebudget" data-cellindex="'+rno+'" >'+cel+'</td><td class="fixed freeze_horizontal scrolling_table_1 businessDivisionCol" ></td><td class="fixed freeze_horizontal scrolling_table_1 departmentCol"></td><td class="fixed freeze_horizontal scrolling_table_1 DivisionCol"></td><td class="fixed freeze_horizontal scrolling_table_1 RegionCol"></td><td class="fixed freeze_horizontal scrolling_table_1 TerritoryCol"></td>'
	 								
	 								var cdc = 1;
	 								var bgcls = 'dwbg';	
		 							var totmdata = celdata.length;
	 								$.each(celdata,function(ix,data){
	 									if(cdc==totmdata){
				 							bgcls = "totdbg";
				 						}
	 									rowrews+='<td class="plan '+bgcls+'" >'+CurrencyInt(data.PLAN)+'</td>		<td class="actual '+bgcls+'">'+CurrencyInt(data.ACTUAL)+'</td><td class="var '+bgcls+'" >'+CurrencyInt(data.VARIANCE)+'</td><td class="varp '+bgcls+'">'+data.VARIANCEP+'</td>';
	 									if(bgcls==''){
				 						bgcls = 'dwbg';
					 					}else{
					 						bgcls = '';
					 					}
					 					cdc++;
	 								});
	 						rowrews+="</tr>";
	 								
	 							rno++;
	 						});
	 					});
		 		}else if(i== DataClick && DataClick=='bdiv'){
			 			sdata['Action'] = drilldown[i];
			 			console.log('bdiv param');
			 			console.log(sdata);
		 				var res = getresult(sdata);
		 				//console.log(res);return false;
		 				var rowrews = '';
		 				// alert(res.length);
		 				var rno = 1;
		 				var bgcls = 'dwbg';
		 				$.each(res,function(ceg,cegdata){
	 						$.each(cegdata,function(cel,celdata){
	 							$.each(celdata,function(bdix,bdivdata){
	 								console.log(bdix);
	 									rowrews +='<tr class="BusinessDivrow"><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1 drilldown BusinessDiv BusinessDiv'+rno+'" data-cecode="'+cel+'" data-click="dept" data-class="BusinessDiv" data-elgroup="'+ceg+'" data-colval="'+bdix+'" data-drilldown="Dwisebudget" data-cellindex="'+rno+'" >'+bdix+'</td><td class="fixed freeze_horizontal scrolling_table_1 departmentCol"></td><td class="fixed freeze_horizontal scrolling_table_1 DivisionCol"></td><td class="fixed freeze_horizontal scrolling_table_1 RegionCol"></td><td class="fixed freeze_horizontal scrolling_table_1 TerritoryCol"></td>'
	 								
	 								var cdc = 1;
	 								var bgcls = 'dwbg';	
		 							var totmdata = bdivdata.length;
	 								$.each(bdivdata,function(ix,data){
	 									if(cdc==totmdata){
				 							bgcls = "totdbg";
				 						}
	 									rowrews+='<td class="plan '+bgcls+'" >'+CurrencyInt(data.PLAN)+'</td>		<td class="actual '+bgcls+'">'+CurrencyInt(data.ACTUAL)+'</td><td class="var '+bgcls+'" >'+CurrencyInt(data.VARIANCE)+'</td><td class="varp '+bgcls+'">'+data.VARIANCEP+'</td>';
	 									if(bgcls==''){
				 						bgcls = 'dwbg';
					 					}else{
					 						bgcls = '';
					 					}
					 					cdc++;
	 								});
	 								rowrews+="</tr>";
	 								
	 								rno++;
	 							});
	 						});
	 					});
		 		}else if(i== DataClick && DataClick=='dept'){
		 				sdata['Action'] = drilldown[i];
		 				console.log('dept param');
			 			console.log(sdata);
		 				var res = getresult(sdata);
		 				var rowrews = '';
		 				var rno = 1;
		 				var bgcls = 'dwbg';

		 				$.each(res,function(ceg,cegdata){
	 						$.each(cegdata,function(cel,celdata){
	 							$.each(celdata,function(bdix,bdivdata){
	 									$.each(bdivdata,function(dptix,deptdata){
			 									rowrews +='<tr class="Departmentrow"><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1 drilldown departmentCol Department Department'+rno+'" data-cecode="'+cel+'" data-click="div" data-class="Department" data-busdiv="'+bdix+'" data-elgroup="'+ceg+'" data-colval="'+dptix+'" data-drilldown="fixed freeze_horizontal scrolling_table_1 Dwisebudget" data-cellindex="'+rno+'" >'+dptix+'</td><td class="fixed freeze_horizontal scrolling_table_1 DivisionCol"></td><td class="fixed freeze_horizontal scrolling_table_1 RegionCol"></td><td class="fixed freeze_horizontal scrolling_table_1 TerritoryCol"></td>'
			 								
			 								var cdc = 1;
			 								var bgcls = 'dwbg';	
				 							var totmdata = deptdata.length;
			 								$.each(deptdata,function(ix,data){
			 									if(cdc==totmdata){
						 							bgcls = "totdbg";
						 						}
			 									rowrews+='<td class="plan '+bgcls+'" >'+CurrencyInt(data.PLAN)+'</td>		<td class="actual '+bgcls+'">'+CurrencyInt(data.ACTUAL)+'</td><td class="var '+bgcls+'" >'+CurrencyInt(data.VARIANCE)+'</td><td class="varp '+bgcls+'">'+data.VARIANCEP+'</td>';
			 									if(bgcls==''){
						 						bgcls = 'dwbg';
							 					}else{
							 						bgcls = '';
							 					}
							 					cdc++;
			 								});
			 								rowrews+="</tr>";
			 								
			 								rno++;
			 							});
	 								});
	 						});
	 					});
		 		}else if(i== DataClick && DataClick=='div'){
		 				sdata['Action'] = drilldown[i];
		 				console.log('div param');
			 			console.log(sdata);
		 				var res = getresult(sdata);
		 				var rowrews = '';
		 				var rno = 1;
		 				var bgcls = 'dwbg';

		 				$.each(res,function(ceg,cegdata){
	 						$.each(cegdata,function(cel,celdata){
	 							$.each(celdata,function(bdix,bdivdata){
	 									$.each(bdivdata,function(dptix,deptdata){
	 										$.each(deptdata,function(divix,divdata){
				 									rowrews +='<tr class="Divisionrow"><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1 drilldown Division Division'+rno+' " data-cecode="'+cel+'" data-click="reg" data-class="Division" data-busdiv="'+bdix+'" data-dept="'+dptix+'" data-elgroup="'+ceg+'" data-colval="'+divix+'" data-drilldown="Dwisebudget" data-cellindex="'+rno+'" >'+divix+'</td><td class="fixed freeze_horizontal scrolling_table_1 RegionCol"></td><td class="fixed freeze_horizontal scrolling_table_1 TerritoryCol"></td>'
				 								
				 								var cdc = 1;
				 								var bgcls = 'dwbg';	
					 							var totmdata = divdata.length;
				 								$.each(divdata,function(ix,data){
				 									if(cdc==totmdata){
							 							bgcls = "totdbg";
							 						}
				 									rowrews+='<td class="plan '+bgcls+'" >'+CurrencyInt(data.PLAN)+'</td>		<td class="actual '+bgcls+'">'+CurrencyInt(data.ACTUAL)+'</td><td class="var '+bgcls+'" >'+CurrencyInt(data.VARIANCE)+'</td><td class="varp '+bgcls+'">'+data.VARIANCEP+'</td>';
				 									if(bgcls==''){
							 						bgcls = 'dwbg';
								 					}else{
								 						bgcls = '';
								 					}
								 					cdc++;
				 								});
				 								rowrews+="</tr>";
				 								
				 								rno++;
				 							});
	 									});	
	 							});
	 						});
	 					});
		 		}else if(i== DataClick && DataClick=='reg'){
		 				sdata['Action'] = drilldown[i];
		 				console.log('reg param');
			 			console.log(sdata);		 				
		 				var res = getresult(sdata);
		 				var rowrews = '';
		 				var rno = 1;
		 				var bgcls = 'dwbg';

		 				$.each(res,function(ceg,cegdata){
	 						$.each(cegdata,function(cel,celdata){
	 							$.each(celdata,function(bdix,bdivdata){
	 									$.each(bdivdata,function(dptix,deptdata){
	 										$.each(deptdata,function(divix,divdata){
	 												$.each(divdata,function(regix,regdata){
					 									rowrews +='<tr class="Regionrow"><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1 drilldown Region Region'+rno+' " data-elgroup="'+ceg+'" data-cecode="'+cel+'" data-busdiv="'+bdix+'" data-dept="'+dptix+'" data-div="'+divix+'"  data-click="terr" data-class="Region"  data-colval="'+regix+'" data-drilldown="Regwisebudget" data-cellindex="'+rno+'" >'+regix+'</td><td class="fixed freeze_horizontal scrolling_table_1 TerritoryCol"></td>'
					 								
					 								var cdc = 1;
					 								var bgcls = 'dwbg';	
						 							var totmdata = regdata.length;
					 								$.each(regdata,function(ix,data){
					 									if(cdc==totmdata){
								 							bgcls = "totdbg";
								 						}
					 									rowrews+='<td class="plan '+bgcls+'" >'+CurrencyInt(data.PLAN)+'</td>		<td class="actual '+bgcls+'">'+CurrencyInt(data.ACTUAL)+'</td><td class="var '+bgcls+'" >'+CurrencyInt(data.VARIANCE)+'</td><td class="varp '+bgcls+'">'+data.VARIANCEP+'</td>';
					 									if(bgcls==''){
								 						bgcls = 'dwbg';
									 					}else{
									 						bgcls = '';
									 					}
									 					cdc++;
					 								});
					 								rowrews+="</tr>";
					 								
					 								rno++;
				 								});
				 							});
	 									});	
	 							});
	 						});
	 					});
		 		}else if(i== DataClick && DataClick=='terr'){
		 				sdata['Action'] = drilldown[i];
		 				console.log('terr param');
			 			console.log(sdata);		 				
		 				var res = getresult(sdata);
		 				var rowrews = '';
		 				var rno = 1;
		 				var bgcls = 'dwbg';

		 				$.each(res,function(ceg,cegdata){
	 						$.each(cegdata,function(cel,celdata){
	 							$.each(celdata,function(bdix,bdivdata){
	 									$.each(bdivdata,function(dptix,deptdata){
	 										$.each(deptdata,function(divix,divdata){
	 												$.each(divdata,function(regix,regdata){
	 													$.each(regdata,function(terrix,terrdata){
		rowrews +='<tr class="Territoryrow"><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1"></td><td class="fixed freeze_horizontal scrolling_table_1 drilldown Territory'+rno+' "  data-elgroup="'+ceg+'" data-busdiv="'+bdix+'" data-div="'+divix+'" data-reg="'+regix+'" data-cecode="'+cel+'" data-class="Territory" data-colval="'+terrix+'" >'+terrix+'</td>'
						 								
						 								var cdc = 1;
						 								var bgcls = 'dwbg';	
							 							var totmdata = terrdata.length;
						 								$.each(terrdata,function(ix,data){
						 									if(cdc==totmdata){
									 							bgcls = "totdbg";
									 						}
						 									rowrews+='<td class="plan '+bgcls+'" >'+CurrencyInt(data.PLAN)+'</td>		<td class="actual '+bgcls+'">'+CurrencyInt(data.ACTUAL)+'</td><td class="var '+bgcls+'" >'+CurrencyInt(data.VARIANCE)+'</td><td class="varp '+bgcls+'">'+data.VARIANCEP+'</td>';
						 									if(bgcls==''){
									 						bgcls = 'dwbg';
										 					}else{
										 						bgcls = '';
										 					}
										 					cdc++;
						 								});
						 								rowrews+="</tr>";
						 								
						 								rno++;
					 								});
				 								});
				 							});
	 									});	
	 							});
	 						});
	 					});
		 		}
	 			/*for(var k in res){
	 				rowrews +=res[k];
	 			}*/

	 			// //console.log(rowrews);
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
				    	// Plan,Actual,Variance,VariancePer CheckedOnly
				    	PlanActVarVarP_CheckedOnly();
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
				    	// Plan,Actual,Variance,VariancePer CheckedOnly
				    	PlanActVarVarP_CheckedOnly();		
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
					    // Plan,Actual,Variance,VariancePer CheckedOnly	 
					    PlanActVarVarP_CheckedOnly();	
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
					    // Plan,Actual,Variance,VariancePer CheckedOnly	 
					    PlanActVarVarP_CheckedOnly();	
					}else if(DataClick == 'reg'){
						// Hide empty columns
				        if($('.RegionCol').css('display') == 'none'){
				        	$('.RegionCol').show();
				          	$('#colspanhead').attr('colspan','6');
				        }
				        if($('.TerritoryCol').css('display') == 'none'){
					        	$('.TerritoryCol').css('display','none');	
					    }
					    // Plan,Actual,Variance,VariancePer CheckedOnly	 
					    PlanActVarVarP_CheckedOnly();	
					}else if(DataClick == 'terr'){
						// Hide empty columns
				        if($('.TerritoryCol').css('display') == 'none'){
				        	$('.TerritoryCol').show();
				          	$('#colspanhead').attr('colspan','7');
				        }
				        // Plan,Actual,Variance,VariancePer CheckedOnly	 
				        PlanActVarVarP_CheckedOnly();
					}
	 		}
 		}
		// $("#loader-wrapper").css('display','none'); 
	});


	 function getresult(filerdata){
	 	////console.log("Ajax Data   "+JSON.stringify(filerdata));
	 	var result = '';
	 	$.ajax({
	 		url: 'budget_json.php',
	 		type: 'POST',
	 		data: filerdata,
	 		async:false,
	 		dataType:'json',
	 		success:function(data){
	 			result=data;
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

  var FilterAction={};
  FilterAction["Action"]="getBusinessdivision";
  genFilter(FilterAction);
  $(".filter-form").submit();
});