var LocSelect = "option";
var cuLocSelect="";
var lctitle = pctitle = actitle = "";
var lctitlealg = 'center';
var CL = CP = CA = null;
var filterArr = [];
 var ddclick = 0;
 var currentfiter = null;
 $('.wsizebtn').click(function(e){
      var parent = $(this).parents("div.chartDiv");
     parent.toggleClass('fullscreen'); 
     if(parent.hasClass('fullscreen')){
          parent.removeClass('col-lg-6');
          parent.addClass('col-lg-12');
      }else{
          parent.removeClass('col-lg-12');
          parent.addClass('col-lg-6');
      }
});
   
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



  $("body").on('click', '.submitbtn', function(event) {
    ddclick = ddclick+1;
      $("#getCReport").val("All");
      filterArr = [];
      ddclick = 0;
  });
  
 var currentRequest = fcurrentRequest = null;    
  desgcode = '';
  var windowsonload = true;
  $("body").on("click",".fresetbtn",function(){
     window.location.reload();
  });

    $("body").on("submit",".filter-form",function(e){
    //$("#loader-wrapper").css('display','block');     
      var filterObj = {};
      var data = $(this).serialize();
      var addmore = "yes";
        filterObj["getCReport"] = $(".getCReport").val();
        if($(".poLocSelect").length>0){
            var poloc = $(".poLocSelect").val();
            filterObj["poLocSelect"] = poloc;
            if(poloc=='All'){
              var poall_code = sep ="";
                 $(".poLocSelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        poall_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                 
                  data = data+"&poall_code="+poall_code;
                  if($(".tmLocSelect").length>0){
                       var tmloc = $(".tmLocSelect").val();
                        if(tmloc!='All' && poloc=="All"){
                          lctitle =  "PO - "+$(".tmLocSelect option:selected").text();
                        }else{
                          ctitle =  $(".poLocSelect option:selected").text();
                        }
                  }else{
                    lctitle =  $(".poLocSelect option:selected").text()+"";
                  }
            }else{
               data = data+"&poall_code="+poloc;
               addmore = "no";
              lctitle =  $(".poLocSelect option:selected").text()+"";
            }
        }

         if($(".tmLocSelect").length>0){
            var tmloc = $(".tmLocSelect").val();
             filterObj["tmLocSelect"] = tmloc;

            if(tmloc=='All' && addmore=='yes'){
              var tmall_code = sep ="";
                 $(".tmLocSelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        tmall_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                 
                  data = data+"&tmall_code="+tmall_code;
                  lctitle = "Terriorty - All";
            }else{
              //data = data+"&tmall_code="+tmloc;
              addmore = "no";
              if($(".poLocSelect").val()=='All'){
               lctitle =  "PO - "+$(".tmLocSelect option:selected").text();
              }
            }
        }


        if($(".rbmLocSelect").length>0 && addmore=='yes'){
            var rbmloc = $(".rbmLocSelect").val();
            filterObj["rbmLocSelect"] = rbmloc;
            if(rbmloc=='All' && addmore=='yes'){
              var rbmall_code = sep ="";
                 $(".rbmLocSelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        rbmall_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                 
                  data = data+"&rbmall_code="+rbmall_code;
                  if($(".zmLocSelect").length>0){
                    if(zmloc!='All'){
                      lctitle = "Region - "+$(".zmLocSelect option:selected").text();
                    }
                  }else{
                    lctitle = "Region - All";
                  }
                  
            }else{
             // data = data+"&rbmall_code="+rbmloc;
             addmore = "no";
             lctitle =  "Terriotry - "+$(".rbmLocSelect option:selected").text();
            }
        }

        if($(".zmLocSelect").length>0 && addmore=='yes'){
            var zmloc = $(".zmLocSelect").val();
            filterObj["zmLocSelect"] = zmloc;
            if(zmloc=='All' && addmore=='yes'){
              var zmall_code = sep ="";
                 $(".zmLocSelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        zmall_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                 
                  data = data+"&zmall_code="+zmall_code;
                  lctitle = "Division - All"
            }else{
              //data = data+"&zmall_code="+zmloc;
              lctitle =  "Division - "+$(".zmLocSelect option:selected").text();
            }
        }
        
        lctitle ='';
        var sep ="";
        var addL ='yes';
        if($(".zmLocSelect").length>0){
          lctitle = "Division - "+$(".zmLocSelect option:selected").text();
          sep=",";
          if($(".zmLocSelect").val()=='All'){
              addL='no';
          }
        }
        if($(".rbmLocSelect").length>0  && addL=='yes'){
              lctitle += sep+"Region - "+$(".rbmLocSelect option:selected").text();  
              sep=",";
            if($(".rbmLocSelect").val()=='All'){
                addL='no';
            }
        }

        if($(".tmLocSelect").length>0  && addL=='yes'){
              lctitle += sep+"Terriorty - "+$(".tmLocSelect option:selected").text();  
              sep=",";
            if($(".tmLocSelect").val()=='All'){
                addL='no';
            }
        }

        if($(".poLocSelect").length>0  && addL=='yes'){
              lctitle += sep+"PO - "+$(".poLocSelect option:selected").text();  
        }
      

            var prodval = $(".productSelect").val();
            var hybval = $(".hybridsSelect").val();
            filterObj["productSelect"] = prodval;
            filterObj["hybridsSelect"] = hybval;
            if(prodval=='All'){
              var prodall_code = sep ="";
                 $(".productSelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        prodall_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                  
                  data = data+"&prodall_code="+prodall_code;
                 
            }else{
                

                if(hybval=='All'){
                  var hyball_code = sep ="";
                     $(".hybridsSelect option").each(function(index, el) {
                          if($(this).val()!="All") {
                            hyball_code +=sep+$(this).val();
                            sep=",";
                          }
                      });
                     
                      data = data+"&hyball_code="+hyball_code;
                }else{
                  data = data+"&hyball_code="+hybval;
                }
            }

            pctitle = "";
           if(prodval=="All"){
              pctitle ="All Products";
           }else{
              if(hybval=="All"){
                            pctitle = "Product - "+prodval+","+" All Hybrids";
              }else{
                pctitle = "Product - "+prodval+",Hybrid - "+$(".hybridsSelect option:selected").text();
              }

           }
    
       
            var actval = $(".activitySelect").val();
            var subactval = $(".subactivitySelect").val();
            filterObj["atype"] =$(".atype").val();
            filterObj["activitySelect"] = actval;
            filterObj["subactivitySelect"] = subactval;
            if(actval=='All'){
              var actall_code = sep ="";
                 $(".activitySelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        actall_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                 
                  data = data+"&actall_code="+actall_code;
            }else{
              
            if(subactval=='All'){
              var subactall_code = sep ="";
                 $(".subactivitySelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        subactall_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                 actitle ="Sub Activity - "+$(".activitySelect option:selected").text();
                  data = data+"&subactall_code="+subactall_code;
             } else{
                actitle =$(".subactivitySelect option:selected").text();
                 data = data+"&subactall_code="+subactval;
             }
            }

            actitle = "";
           if(actval=="All"){
              actitle ="All Activity";
           }else{
              if(subactval=="All"){
                    actitle = "Activity - "+actval+","+" All Sub activity";
              }else{
                actitle = "Activity - "+actval+",Sub activity - "+$(".subactivitySelect option:selected").text();
              }

           }
          
          filterArr.push(filterObj);
         
          currentfiter = data;
       currentRequest =  $.ajax({
          url: 'PDTrailChart.php',
          type: 'POST',
          dataType: 'json',
          data: data,
           beforeSend : function() {     
              if(currentRequest != null) {
                  currentRequest.abort();
              }
          },
          success:function(res){
            $(".restabs").each(function (){
              if($(this).hasClass('active')){
                $(this).removeClass('active');
              }
            });
            $(".restabpanel").removeClass('active');
            $(".restabs:eq(0)").addClass('active');
            $(".restabpanel:eq(0)").addClass('active');
            $(".dataTable").each(function(index, el) {
              var tblid = $(this).attr("id");             
              $(this).data("loaded","no");

          });

            $(".stage_sowing").text(res.stage_sowing);
            $(".stage_70_80").text(res.stage_70_80);
            $(".stage_120_130").text(res.stage_120_130);
            $(".stage_picking_yield").text(res.stage_picking_yield);
            $(".stage_closed").text(res.stage_closed);

            

            if(res.hasOwnProperty('locationWiseData')){
              genLocationWiseChart(res.locationWiseData);       
            }
            if(res.hasOwnProperty('productWisesData'))
              genProductWiseChart(res.productWisesData);
             if(res.hasOwnProperty('ActivityWisesData'))
              genActivityWiseChart(res.ActivityWisesData);
            if(res.hasOwnProperty('TrendChartData'))
                genTrendChart(res.TrendChartData);
              data = data+"&filter=PLANNED"
              //genReport(data,"plannedRestbl","PLANNED");
               //$("#loader-wrapper").css('display','none');
          }
           });
        
       return false;
      });

$("body").on("click",".cbackbtn",function(){
 
    filterArr.splice(ddclick,1);
   
    ddclick = ddclick-1;
    var cfilterobj = filterArr[ddclick];
    
    for(var cls in cfilterobj){
      if($("."+cls).length>0){
          if(cls=='getCReport'){
              $("."+cls).val(cfilterobj[cls]);
          }else{
            $("."+cls+" option[value='"+cfilterobj[cls]+"']").prop("selected",true);    
          }
        
        //$("."+cls).change();
      }
    }

    if(cfilterobj.hasOwnProperty('zmLocSelect')){
      $(".zmLocSelect").change();
    }
     if(cfilterobj.hasOwnProperty('rbmLocSelect')){
      $(".rbmLocSelect").change();
    }
     if(cfilterobj.hasOwnProperty('tmLocSelect')){
      $(".tmLocSelect").change();
    }

    if(cfilterobj.hasOwnProperty('activitySelect')){
      $(".activitySelect").change();
    }
     if(cfilterobj.hasOwnProperty('productSelect')){
      $(".productSelect").change();
    }

    $(".filter-form").submit();
});

 
    
function genLocationWiseChart(locationWiseData){
      var totfc = 0;
      var totvc = 0;
      var totdc = 0;
       var locSeriousdata = locationWiseData;
       //console.log(locationWiseData);
       CL = locationWiseData.CL;
       //return false;
       var  categoriesarr = [];
       var  categoriesidarr = [];
        var series1SOWINGobj = [] ;
        var series1STAGE_70_80obj = [];
        var series1STAGE_120_130obj = [];
        var series1STAGE_PYobj = [];
        var series1STAGE_CLOSEDobj = [];
        var fcarr = {};
        var vcarr = [];
        var dcarr = [];
       
       if(locSeriousdata.hasOwnProperty('series1')){
          var series1 = locSeriousdata.series1;
         
          if(series1.hasOwnProperty('SOWING')){
              series1SOWINGobj1 = series1.SOWING;
           
               for(var ri in series1SOWINGobj1){ 
                    var cobj = series1SOWINGobj1[ri];
                    var name = cobj.name;
                    var NID = cobj.NID;
                    series1SOWINGobj.push(series1SOWINGobj1[ri]);
                     if(!categoriesarr.includes(name)){
                        categoriesidarr.push(NID);
                        categoriesarr.push(name);
                         fcarr[NID]=0;
                         vcarr[NID]=0;
                         dcarr[NID]=0;
                     }
                  }

            
          }

          if(series1.hasOwnProperty('STAGE_70_80')){
              series1STAGE_70_80obj1 = series1.STAGE_70_80;
               for(var ri in series1STAGE_70_80obj1){ 
                    var cobj = series1STAGE_70_80obj1[ri];
                    var name = cobj.name;
                    var NID = cobj.NID;
                      series1STAGE_70_80obj.push(series1STAGE_70_80obj1[ri]);
                     if(!categoriesarr.includes(name)){
                        categoriesidarr.push(NID);
                        categoriesarr.push(name);
                         fcarr[NID]=0;
                         vcarr[NID]=0;
                         dcarr[NID]=0;
                     }
                  }
          }

        /*  if(series1.hasOwnProperty('STAGE_120_130')){
              series1STAGE_120_130obj1 = series1.STAGE_120_130;
              console.log(series1STAGE_120_130obj1);
               for(var ri in series1STAGE_120_130obj1){ 
                    var cobj = series1STAGE_120_130obj1[ri];
                    var name = cobj.name;
                    var NID = cobj.NID;
                      series1STAGE_120_130obj.push(series1STAGE_120_130obj1[ri]);
                     if(!categoriesarr.includes(name)){
                        categoriesidarr.push(NID);
                        categoriesarr.push(name);
                         fcarr[NID]=0;
                         vcarr[NID]=0;
                         dcarr[NID]=0;
                     }
                  }
          } 
          console.log(series1STAGE_120_130obj);*/

          if(series1.hasOwnProperty('STAGE_PICKING_YIELD')){
              series1STAGE_PYobj1 = series1.STAGE_PICKING_YIELD;
               for(var ri in series1STAGE_PYobj1){ 
                    var cobj = series1STAGE_PYobj1[ri];
                    var name = cobj.name;
                    var NID = cobj.NID;
                      series1STAGE_PYobj.push(series1STAGE_PYobj1[ri]);
                     if(!categoriesarr.includes(name)){
                        categoriesidarr.push(NID);
                        categoriesarr.push(name);
                         fcarr[NID]=0;
                         vcarr[NID]=0;
                         dcarr[NID]=0;
                     }
                  }
          }

          if(series1.hasOwnProperty('STAGE_CLOSED')){
              series1STAGE_CLOSEDobj1 = series1.STAGE_CLOSED;
               for(var ri in series1STAGE_CLOSEDobj1){ 
                    var  cobj = series1STAGE_CLOSEDobj1[ri];
                    var name = cobj.name;
                    var NID = cobj.NID;
                    series1STAGE_CLOSEDobj.push(cobj);
                    totfc +=cobj.fc;
                    totvc +=cobj.vc;
                    totdc +=cobj.dc;
                    fcarr[NID]=cobj.fc;
                    vcarr[NID]=cobj.vc;
                    dcarr[NID]=cobj.dc;
                     if(!categoriesarr.includes(name)){
                      categoriesidarr.push(NID);
                        categoriesarr.push(name);
                     }
                  }
          }
       }
      
       $(".fcovered").text(totfc);
       $(".vcovered").text(totvc);
       $(".dcovered").text(totdc);
       var fcarr1 = [];
       var vcarr1 = [];
       var dcarr1 = [];
    
       for(var cid in categoriesidarr){
          var cfid = categoriesidarr[cid];
          fcarr1.push(fcarr[cfid]);
          vcarr1.push(vcarr[cfid]);
          dcarr1.push(dcarr[cfid]);
       }
      

      
        var lc = new Highcharts.chart({
           credits: {
                    enabled: false
              },
          chart: {
                  renderTo: 'LocationWiseChartContainer',
                  type: 'column',
              },
        
        title: {
            text: lctitle
        },
        xAxis: {
            //type: 'category',
            categories:categoriesarr,
            labels: {
              style: {
                  color: 'black'
              }
          }
        },
        yAxis: [{
                min: 0,
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
            column : {
              cursor: 'pointer',
                stacking : 'normal',
                dataLabels: {
                enabled: true,
                  color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                },
                point: {
          events: {
            click: function() {
              //console.log(this.name);
              var act = this.act;
              var lname = this.tname;
              $("#getCReport").val(this.act);
              ddclick = ddclick+1;
              if(CL=="ZM"){
                //lctitle = lname+" - Region";
                $(".zmLocSelect option[value='"+this.NID+"']").attr("selected","selected");
                $(".zmLocSelect").change();
              }
              if(CL=="RBM"){
                //lctitle = lname+" - Terriotry";
                $(".rbmLocSelect option[value='"+this.NID+"']").attr("selected","selected");
                $(".rbmLocSelect").change();
              }
              if(CL=="TM"){
                //lctitle = lname+" - PO";
                $(".tmLocSelect option[value='"+this.NID+"']").attr("selected","selected");
                $(".tmLocSelect").change();
              }
              if(CL=="PO"){
                //lctitle =  lname;
                $(".poLocSelect option[value='"+this.NID+"']").attr("selected","selected");
                $(".poLocSelect").change();
              }
                $(".filter-form").submit();
            }
          }
        }
            }
        },
          series: [{
                  name: 'Sowing',
                  data: series1SOWINGobj
                },{
                   name: 'Stage 70-80',
                   data: series1STAGE_70_80obj
                },{
                   name: 'Stage 120-130',
                  data: series1STAGE_120_130obj
                },{
                   name: 'Picking And Yield',
                  data: series1STAGE_PYobj
                },{
                   name: 'Closed',
                  data: series1STAGE_CLOSEDobj
                },
                 /*{name: 'Farmers Covered',
                  type: 'spline',
                  yAxis:1,
                  data:fcarr1
                },
                {name: 'Villages Covered',
                  type: 'spline',
                  yAxis:1,
                  data:vcarr1
                },{name: 'Dealers Covered',
                  type: 'spline',
                  yAxis:1,
                  data:dcarr1
                }*/
              ],
              navigation: {
        buttonOptions: {
            enabled: true
        }
    },
        /*drilldown: {
          series:s2pendpdata
        }*/
    },function (chart) {
        if(ddclick>=1){
         chart.renderer.button(' < Back',490, 5)
            .attr({
                zIndex: 3,
                class:'btn btn-default cbackbtn'
            })
            .add();
        }
    });
        lc.xAxis[0].labelGroup.element.childNodes.forEach(function(label)
      {
       
        label.style.cursor = "pointer";
        label.onclick = function(events){
          ddclick =ddclick+1;
         /* alert($(this).find('tspan:eq(0)').text());
          alert($(this).find('tspan:eq(1)').text());*/
          var lname = $(this).find('tspan:eq(0)').text();
          var id = $(this).find('tspan:eq(1)').text();
            if($(this).find('tspan:eq(2)').length>0){
              var fopt = $(this).find('tspan:eq(2)').text();
              $(".atype option[value='"+fopt+"']").prop('selected', true);
            }
          if(CL=='ZM'){
            /*lctitle = lname+" - Region";*/
            $(".zmLocSelect option[value='"+id+"']").prop('selected', true);
            $(".zmLocSelect").change();
          }

          if(CL=='RBM'){
            /*lctitle = lname+" - Terriotry";*/
            $(".rbmLocSelect option[value='"+id+"']").prop('selected', true);
            $(".rbmLocSelect").change();
             
          }
          if(CL=='TM'){
            /*lctitle = lname+" - PO";*/
            $(".tmLocSelect option[value='"+id+"']").prop('selected', true);;
            $(".tmLocSelect").change();
          }
           
          if(CL=='PO'){
             /*lctitle =  lname;*/
            $(".poLocSelect option[value='"+id+"']").prop('selected', true);
             
          }
            
          $(".filter-form").submit();
         // console.log(this);
//          alert('You clicked on '+this.textContent);*/
        }
    });
  }



    function genProductWiseChart(productWisesData){
    //console.log(productWisesData);

       var locSeriousdata = productWisesData;
       CP = productWisesData.CP;
       //console.log(locSeriousdata);
       var series1 = locSeriousdata.series1;
       //return false;
        var series1SOWINGobj = [] ;
        var series1STAGE_70_80obj = [];
        var series1STAGE_120_130obj = [];
        var series1STAGE_PYobj = [];
        var series1STAGE_CLOSEDobj = [];
       
       if(series1.hasOwnProperty('SOWING')){
          series1SOWINGobj = series1.SOWING;
       }

        if(series1.hasOwnProperty('STAGE_70_80')){
          series1STAGE_70_80obj = series1.STAGE_70_80;
       }

       if(series1.hasOwnProperty('STAGE_120_130')){
          series1STAGE_120_130obj = series1.STAGE_120_130;
       }

       if(series1.hasOwnProperty('STAGE_PICKING_YIELD')){
          series1STAGE_PYobj = series1.STAGE_PICKING_YIELD;
       }

       if(series1.hasOwnProperty('STAGE_CLOSED')){
          series1STAGE_CLOSEDobj = series1.STAGE_CLOSED;
       }

        var s2pendpdata = [];
       if(productWisesData.hasOwnProperty('series2')){
          //console.log(locationWiseData.series2);
          var series2 = productWisesData.series2;
         
          if(series1.hasOwnProperty('SOWING')){
            series1SOWINGobj = series1.SOWING;
              if(series2.hasOwnProperty('PENDING')){                
               series2PENDobj1 = series2.PENDING;
               
                  for(var ri in series1PENDobj1){
                    var name = series1PENDobj1[ri].name;
                      var seriespendarr = [];
                      var rdobj = series2PENDobj1[name];
                      for(var ti in rdobj ){
                         var dataarr = rdobj[ti];
                         //console.log(dataarr);
                          //for(var ti1 in dataarr){
                            seriespendarr.push(dataarr);
                            
                          //}
                         
                      }
                     
                     s2pendpdata.push({
                        id:name+'PEND',
                        name:'PENDING',
                        data:seriespendarr
                     })
                  }
                  
              }

          }

          if(series1.hasOwnProperty('APPROVED')){
            series1APPobj1 = series1.APPROVED;
              if(series2.hasOwnProperty('APPROVED')){                
               series2APPobj1 = series2.APPROVED;
               
                  for(var ri in series1APPobj1){
                    var name = series1APPobj1[ri].name;
                      var seriespendarr = [];
                      var rdobj = series2APPobj1[name];
                      for(var ti in rdobj ){
                         var dataarr = rdobj[ti];
                         //console.log(dataarr);
                          //for(var ti1 in dataarr){
                            seriespendarr.push(dataarr);
                            
                          //}
                         
                      }
                     
                     s2pendpdata.push({
                        id:name+'APP',
                        name:'APPROVED',
                        data:seriespendarr
                     })
                  }
                  
              }

          }

           if(series1.hasOwnProperty('EXECUTED')){
            series1EXEobj1 = series1.EXECUTED;
              if(series2.hasOwnProperty('EXECUTED')){                
               series2EXEobj1 = series2.EXECUTED;
               
                  for(var ri in series1EXEobj1){
                    var name = series1EXEobj1[ri].name;
                      var seriespendarr = [];
                      var rdobj = series2EXEobj1[name];
                      for(var ti in rdobj ){
                         var dataarr = rdobj[ti];
                         //console.log(dataarr);
                          //for(var ti1 in dataarr){
                            seriespendarr.push(dataarr);
                            
                          //}
                      }
                     
                     s2pendpdata.push({
                        id:name+'EXEC',
                        name:'EXECUTED',
                        data:seriespendarr
                     })
                  }
                  
              }

          }
          
       }   

        var pc =  Highcharts.chart('ProductWiseChartContainer',{
           credits: {
                    enabled: false
              },
        chart: {
            type: 'column'
        },
        title: {
            text: pctitle
        },
        xAxis: {
            type: 'category',
            labels: {
              style: {
                  color: 'black'
              }
          }
        }, 
        yAxis: {
          min: 0,
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
                }
          },

        plotOptions: {
            column : {
              cursor: 'pointer',
                stacking : 'normal',
                dataLabels: {
                enabled: true,
                  color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                },
                point: {
                  events: {
                    click: function() {
                      //console.log(this);
                      var act = this.act;
                      var pname = this.tname;
                      ddclick = ddclick+1;
                      $("#getCReport").val(this.act);
                      if(CP=="PRODUCT"){
                        $(".productSelect option[value='"+this.NID+"']").attr("selected","selected");
                        $(".productSelect").change();
                      }
                      if(CP=="HYBRID"){
                        $(".hybridsSelect option[value='"+this.NID+"']").attr("selected","selected");
                      }
                        $(".filter-form").submit();
                    }
                  }
              }
            }
        },
        series: [{
                  name: 'Sowing',
                  data: series1SOWINGobj
                },{
                   name: 'Stage 70-80',
                   data: series1STAGE_70_80obj
                },{
                   name: 'Stage 120-130',
                  data: series1STAGE_120_130obj
                },{
                   name: 'Picking And Yield',
                  data: series1STAGE_PYobj
                },{
                   name: 'Closed',
                  data: series1STAGE_CLOSEDobj
                }
              ],
        /*drilldown: {
          series:s2pendpdata
        }*/
    },function (chart) {
        if(ddclick>=1){
         chart.renderer.button(' < Back',490, 5)
            .attr({
                zIndex: 3,
                class:'btn btn-default cbackbtn'
            })
            .add();
        }
    });

         pc.xAxis[0].labelGroup.element.childNodes.forEach(function(label)
      {
        
        label.style.cursor = "pointer";
        label.onclick = function(events){
          ddclick = ddclick+1;
          //console.log(this);
         /* alert($(this).find('tspan:eq(0)').text());
          alert($(this).find('tspan:eq(1)').text());*/
//          alert(this.textContent);
        var pname = sep = "";
      $(this).find("tspan").each(function(){
          pname +=sep+$(this).text(); 
          sep =" ";
      });
    
    if(pname=="")
      pname = this.textContent;
          
          if(CP=='PRODUCT'){
            $(".productSelect option[value='"+pname+"']").prop('selected', true);
            $(".productSelect").change();

          }

          if(CP=='HYBRID'){
            $(".hybridsSelect option[value='"+pname+"']").prop('selected', true);
          }
          
            
          $(".filter-form").submit();
         // console.log(this);
//          alert('You clicked on '+this.textContent);*/
        }
    });
       
    }

    
    function genActivityWiseChart(ActivityWisesData){

       
       CA = ActivityWisesData.CA;
       console.log(ActivityWisesData);
       var series1 = ActivityWisesData.series1;
       //return false;
       var series1SOWINGobj = [] ;
        var series1STAGE_70_80obj = [];
        var series1STAGE_120_130obj = [];
        var series1STAGE_PYobj = [];
        var series1STAGE_CLOSEDobj = [];
       
        if(series1.hasOwnProperty('SOWING')){
          series1SOWINGobj = series1.SOWING;
       }

        if(series1.hasOwnProperty('STAGE_70_80')){
          series1STAGE_70_80obj = series1.STAGE_70_80;
       }

       if(series1.hasOwnProperty('STAGE_120_130')){
          series1STAGE_120_130obj = series1.STAGE_120_130;
       }

       if(series1.hasOwnProperty('STAGE_PICKING_YIELD')){
          series1STAGE_PYobj = series1.STAGE_PICKING_YIELD;
       }

       if(series1.hasOwnProperty('STAGE_CLOSED')){
          series1STAGE_CLOSEDobj = series1.STAGE_CLOSED;
       }
        
       var ac =  Highcharts.chart('ActivityWiseChartContainer',{
           credits: {
                    enabled: false
              },
        chart: {
            type: 'column'
        },
        title: {
            text: actitle
        },
        xAxis: {
            type: 'category',
            labels: {
              style: {
                  color: 'black'
              }
          }
        },
         yAxis: {
          min: 0,
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
            }
          },

        plotOptions: {
            column : {
              cursor: 'pointer',
                stacking : 'normal',
                dataLabels: {
                enabled: true,
                  color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                },
                point: {
                  events: {
                    click: function() {
                      //console.log(this);
                      var act = this.act;
                     /* alert(this.NID);
                      alert(this.act);*/
                      ddclick = ddclick+1;
                      var pname = this.tname;
                      $("#getCReport").val(this.act);
                      if(CA=="ACTIVITY"){
                        $(".activitySelect option[value='"+this.NID+"']").attr("selected","selected");
                        $(".activitySelect").change();
                      }
                      if(CA=="SUBACTIVITY"){
                        $(".subactivitySelect option[value='"+this.NID+"']").attr("selected","selected");
                        //alert($(".subactivitySelect").val());
                      }
                        $(".filter-form").submit();
                    }
                  }
              }
            }
        },

        series: [{
                  name: 'Sowing',
                  data: series1SOWINGobj
                },{
                   name: 'Stage 70-80',
                   data: series1STAGE_70_80obj
                },{
                   name: 'Stage 120-130',
                  data: series1STAGE_120_130obj
                },{
                   name: 'Picking And Yield',
                  data: series1STAGE_PYobj
                },{
                   name: 'Closed',
                  data: series1STAGE_CLOSEDobj
                }
              ],
 
    },function (chart) {
        if(ddclick>=1){
         chart.renderer.button(' < Back',490, 5)
            .attr({
                zIndex: 3,
                class:'btn btn-default cbackbtn'
            })
            .add();
        }
    });

      ac.xAxis[0].labelGroup.element.childNodes.forEach(function(label)
      {
        
        label.style.cursor = "pointer";
        label.onclick = function(events){
          ddclick = ddclick+1;
          //console.log(this);
         /* alert($(this).find('tspan:eq(0)').text());
          alert($(this).find('tspan:eq(1)').text());*/
//          alert(this.textContent);
            var pname = sep = "";
        $(this).find("tspan").each(function(){
            pname +=sep+$(this).text(); 
            sep =" ";
        });
    
      if(pname=="")
        pname = this.textContent;
          
          if(CA=='ACTIVITY'){
            $(".activitySelect option[value='"+pname+"']").prop('selected', true);;
            $(".activitySelect").change();
          }

          if(CA=='SUBACTIVITY'){
            $(".subactivitySelect option[value='"+pname+"']").prop('selected', true);;
          }
          
          $(".filter-form").submit();
         // console.log(this);
//          alert('You clicked on '+this.textContent);*/
        }
    });
       
    } 
    
    function genTrendChart(TrendChartData){
      var data = TrendChartData.tdata;
    
        Highcharts.chart('TrendChart', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: 'Trend Chart'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
               allowDecimals:false,
                title: {
                    text: 'Count'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },
            credits: {
                    enabled: false
              },

            series: [{
                type: 'area',
                name: 'COUNT',
                data: data
            }]
        });
    }

    function genDetailedLocChart(DetlocationWiseData=null){
      var locseriesfor = DetlocationWiseData.locseriesfor;

      var series1for = series2for = series3for = '';
       if(locseriesfor.series1=="RBM"){
          $(".RBMDetLocationWiseChartarea").show();
          $(".TMDetLocationWiseChartarea").show();
          $(".PODetLocationWiseChartarea").show();
       }

       if(locseriesfor.series1=="TM"){
          $(".RBMDetLocationWiseChartarea").hide();
          $(".TMDetLocationWiseChartarea").show();
          $(".PODetLocationWiseChartarea").show();
       }

       if(locseriesfor.series1=="PO"){
          $(".RBMDetLocationWiseChartarea").hide();
          $(".TMDetLocationWiseChartarea").hide();
          $(".PODetLocationWiseChartarea").show();
       }

       var chartdata = [];

      if(DetlocationWiseData.hasOwnProperty('Detseries1')){
       
        var series = DetlocationWiseData.Detseries1;
        var s1planned = series.PLANNED;
        var s1approved = series.APPROVED;
        var s1pending = series.PENDING;
        var s1executed = series.EXECUTED;
        var categoriesarr = [];
        var planneddata = [];
        for(var s1i in s1planned){
          var data = s1planned[s1i];
          categoriesarr.push(data.name);
          planneddata.push(data.y);
        }
        var approveddata = [];
        for(var s1i in s1approved){
          var data = s1approved[s1i];
          approveddata.push(data.y);
        }
        var pendingdata = [];
        for(var s1i in s1pending){
          var data = s1pending[s1i];
          pendingdata.push(data.y);
        }
        var executeddata = [];
        for(var s1i in s1executed){
          var data = s1executed[s1i];
          executeddata.push(data.y);
        }

        var seriesdataarr = {
            'seriesfor':locseriesfor.series1+'DetLocationWiseChartContainer',
            'categories':categoriesarr,
            'planneddata':planneddata,
            'approveddata':approveddata,
            'pendingdata':pendingdata,
            'executeddata':executeddata
        }
          
        chartdata.push(seriesdataarr);
      }

         if(DetlocationWiseData.hasOwnProperty('Detseries2')){
       
        var series = DetlocationWiseData.Detseries2;
        var s1planned = series.PLANNED;
        var s1approved = series.APPROVED;
        var s1pending = series.PENDING;
        var s1executed = series.EXECUTED;
        var categoriesarr = [];
        var planneddata = [];
        for(var s1i in s1planned){
          var data = s1planned[s1i];
          categoriesarr.push(data.name);
          planneddata.push(data.y);
        }
        var approveddata = [];
        for(var s1i in s1approved){
          var data = s1approved[s1i];
          approveddata.push(data.y);
        }
        var pendingdata = [];
        for(var s1i in s1pending){
          var data = s1pending[s1i];
          pendingdata.push(data.y);
        }
        var executeddata = [];
        for(var s1i in s1executed){
          var data = s1executed[s1i];
          executeddata.push(data.y);
        }

        var seriesdataarr = {
            'seriesfor':locseriesfor.series2+'DetLocationWiseChartContainer',
            'categories':categoriesarr,
            'planneddata':planneddata,
            'approveddata':approveddata,
            'pendingdata':pendingdata,
            'executeddata':executeddata
        }
          
        chartdata.push(seriesdataarr);
      }  

      if(DetlocationWiseData.hasOwnProperty('Detseries3')){
       
        var series = DetlocationWiseData.Detseries3;
        //console.log(series);
        var s1planned = series.PLANNED;
        var s1approved = series.APPROVED;
        var s1pending = series.PENDING;
        var s1executed = series.EXECUTED;
        var categoriesarr = [];
        var planneddata = [];
        for(var s1i in s1planned){
          var data = s1planned[s1i];
          categoriesarr.push(data.name);
          planneddata.push(data.y);
        }
        var approveddata = [];
        for(var s1i in s1approved){
          var data = s1approved[s1i];
          approveddata.push(data.y);
        }
        var pendingdata = [];
        for(var s1i in s1pending){
          var data = s1pending[s1i];
          pendingdata.push(data.y);
        }
        var executeddata = [];
        for(var s1i in s1executed){
          var data = s1executed[s1i];
          executeddata.push(data.y);
        }

        var seriesdataarr = {
            'seriesfor':locseriesfor.series3+'DetLocationWiseChartContainer',
            'categories':categoriesarr,
            'planneddata':planneddata,
            'approveddata':approveddata,
            'pendingdata':pendingdata,
            'executeddata':executeddata
        }
          
        chartdata.push(seriesdataarr);
      }
       
        for(var ncd in chartdata){
          var chartdet = chartdata[ncd];
          var containerid = chartdet.seriesfor;
          console.log(containerid);
          var categoriesarr = chartdet.categories;
          var planneddata = chartdet.planneddata;
          var approveddata = chartdet.approveddata;
          var pendingdata = chartdet.pendingdata;
          var executeddata = chartdet.executeddata;
             Highcharts.chart(containerid, {
              credits: {
                    enabled: false
              },

              chart: {
                  type: 'column'
              },
              title:{
                  text:''
              },
              xAxis: {
                  categories:categoriesarr,
                  crosshair: true
              },
              yAxis: {
                  allowDecimals:false,
                  min: 0,
                  title: {
                      text: 'Count'
                  }
              },
              tooltip: {
                  headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                  pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                      '<td style="padding:0"><b>{point.y}</b></td></tr>',
                  footerFormat: '</table>',
                  shared: true,
                  useHTML: true
              },
              plotOptions: {
                  column: {
                      pointPadding: 0.2,
                      borderWidth: 0
                  }
              },
              series: [{
                  name: 'PLANNED',
                  data: planneddata

              }, {
                  name: 'APPROVED',
                  data: approveddata

              }, {
                  name: 'PENDING',
                  data: pendingdata

              }, {
                  name: 'EXECUTED',
                  data: executeddata

              }
              ]
          });
        }
  }


var coldef = {
                "targets": [ 19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36 ],
                "visible": false,
                "searchable": false
            }

     exeResTable =  $("#exeResTable").DataTable( {"columnDefs": [
            coldef
        ]});

    function genReport(filterData,tbl='plannedRes',resfor='PLANNED'){
      
      //$("#loader-wrapper").css('display','block');
      if(resfor!='EXECUTED'){
        var coldef1 = {};
      }else{
        var coldef1 = coldef;
      }

      var status = $('#'+tbl).data("loaded");
      if(status=='no'){
       $('#'+tbl).DataTable().destroy();
          $('#'+tbl).data("loaded","yes");
          if(tbl=="exeResTable"){
              exeResTable =  $('#'+tbl).DataTable({
                   "columnDefs": [coldef1
                    ],
                        "dom": 'Bfrtip',
                    "buttons": [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    "scrollX": true,
                        //"responsive": true,
                        "pageLength": 5,
                         "aProcessing": true,
                            "aServerSide": true,
                        "ajax": {
                           "url": "Ajax1.php",
                            "type": "POST",
                            "data" : {Action:'getresult',filterData:filterData}
                        },
                    });
            }else{
          
                 $('#'+tbl).DataTable({
                         "columnDefs": [coldef1
                    ],
                        "dom": 'Bfrtip',
                    "buttons": [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    "scrollX": true,
                        //"responsive": true,
                        "pageLength": 5,
                         "aProcessing": true,
                            "aServerSide": true,
                        "ajax": {
                           "url": "Ajax1.php",
                            "type": "POST",
                            "data" : {Action:'getresult',filterData:filterData}
                        },
                    });
            }
        
      }
       
           $("#loader-wrapper").css('display','none');
    }


    $("body").on("click",".restabs,.restabs1",function(){
       var filteropt = $(this).data("filter");
        var rdata = currentfiter+"&filter="+filteropt;
        var tbl = $(this).data("tbl");
         if($(this).hasClass('restabs1')){
          $(".restabpanel").removeClass('active');
          $(".restabs").removeClass('active');
          var tab  = $(this).data("tab");
            $("."+tab).trigger('click');
         }
     //genReport(rdata,tbl,filteropt);
    });

     $('#exeResTable tbody').on( 'click', 'tr', function () {
      $(".ptabs").removeClass('active');
      $(".popres-pane").removeClass('active');
      $(".exampleTabsOne").addClass('active');
      $("#exampleTabsOne").addClass('active');
    //console.log( TMexeResTable.row( this ).data() );
    var rowdata = exeResTable.row( this ).data() ;
    var crowdata = rowdata;
    //console.log(rowdata);
        $(".respopdata").each(function (){
            ctype = $(this).data('type');
            if(ctype=='image' || ctype=='map'){
              $(this).prop('src',"");
            }else{
                $(this).text("");
            }
        });       



       $(".respopdata1").text(rowdata[1]);
       $(".respopdata2").text(rowdata[2]);
       $(".respopdata3").text(rowdata[3]);
       $(".respopdata4").text(rowdata[4]);
       $(".respopdata5").text(rowdata[5]);
       $(".respopdata6").text(rowdata[6]);
       $(".respopdata7").text(rowdata[7]);
       $(".respopdata8").text(rowdata[8]);
       $(".respopdata9").text(rowdata[9]);
       $(".respopdata10").text(rowdata[10]);
       $(".respopdata11").text(rowdata[11]);
       $(".respopdata12").text(rowdata[12]);
       $(".respopdata13").text(rowdata[13]);
       $(".respopdata14").text(rowdata[14]);
       $(".respopdata15").text(rowdata[15]);
       $(".respopdata16").text(rowdata[16]);
       $(".respopdata17").text(rowdata[17]);
       $(".respopdata18").text(rowdata[18]);
       $(".respopdata19").text(rowdata[19]);
       $(".respopdata20").text(rowdata[20]);
       $(".respopdata21").text(rowdata[21]);
       $(".respopdata22").text(rowdata[31],rowdata[32]);
       $(".respopdata23").text(rowdata[33],rowdata[34]);
       $(".respopdata24").text(rowdata[35],rowdata[36]);
       $(".respopdata25").text(rowdata[28]);
       $(".respopdata26").text(rowdata[29]);
       $(".respopdata27").text(rowdata[30]);
       
        $(".eimage1").prop('src',rowdata[25]);
        $(".eimage2").prop('src',rowdata[26]);
        $(".eimage3").prop('src',rowdata[27]);
       
    $("#ResultModal").modal('show');
  });


/*0*/

    $("body").on("change",".pdivision",function(){
       //$("#loader-wrapper").css('display','block');
        dataAreaId = $(this).val();
         fcurrentRequest =  $.ajax({
            url: 'Ajax1.php',
            type: 'POST',
            dataType: 'json',
            async:false,
             beforeSend : function()   {           
              if(fcurrentRequest != null) {
                  fcurrentRequest.abort();
              }
             /* if(currentRequest != null) {
                  currentRequest.abort();
              }*/
          },
            data: {Action: 'GetFilterOptPDTrail',dataAreaId:dataAreaId},
            success:function(res){
              var Dcode = "";
              if($(".zmLocSelect").length>0){
                Dcode ="ZM";
              }else if($(".rbmLocSelect").length>0){
                Dcode ="RBM";
              }else if($(".tmLocSelect").length>0){
                Dcode ="TM";
              }else {
                Dcode ="PO";
              }
              GenSelectOpt(res,Dcode);
              $("#loader-wrapper").css('display','none');
            }
          });

         

    });
$(".pdivision").change();
    function GenSelectOpt(res,Dcode=""){

              var zmLocOpt =  rbmLocSelect = tmLocSelect = poLocCodeOpt =  popt = activityOpt = "";
               
              if(res.hasOwnProperty('zoneDet')){
                 zoneDet = res.zoneDet;
                 for(var zi in zoneDet ){
                      zmLocOpt +="<option value='"+zoneDet[zi].ZoneId+"'>"+zoneDet[zi].ZoneName+"</option>";
                 }
                 $(".zmLocSelect").html("");
                   $(".zmLocSelect").html(zmLocOpt);
              }

              if(res.hasOwnProperty('regionDet')){
                 regionDet = res.regionDet;
                 for(var ri in regionDet ){
                  rid  = regionDet[ri].RegionId;
                  rname  = regionDet[ri].RegionName;
                  var zone="";
                  if(regionDet[ri].hasOwnProperty('Zone')){
                    zone=regionDet[ri].Zone;
                  }
                  ridval = rname;
                  if(rid=="All"){
                    ridval = 'All';
                  }

                      rbmLocSelect +="<option value='"+rid+"' data-zone='"+zone+"' >"+ridval+"</option>";
                 }
                 $(".rbmLocSelect").html("");
                   $(".rbmLocSelect").html(rbmLocSelect);
              }
             

              if(res.hasOwnProperty('tmDet')){
                 tmDet = res.tmDet;
                 for(var ti in tmDet ){
                  tid  = tmDet[ti].TMID;
                  tmname  = tmDet[ti].TMName;
                  tidval = tmname;
                 
                  if(tid=="All"){
                    tidval = 'All';
                  }

                      tmLocSelect +="<option value='"+tid+"' >"+tidval+"</option>";
                 }
                  $(".tmLocSelect").html("");
                   $(".tmLocSelect").html(tmLocSelect);
              }
             
              if(res.hasOwnProperty('poDet')){
                  poDet = res.poDet;
                  for(var pi in poDet ){
                     poid  = poDet[pi].POHQCODE;
                    // console.log(poid);
                    poname  = poDet[pi].POHQNAME;
                    poval = poname;
                    if(poid=="All"){
                      poval = 'All';
                    }
                  poLocCodeOpt +="<option value='"+poid+"' >"+poval+"</option>";
                 }

                 $(".poLocSelect").html(poLocCodeOpt);

              } 
              
               if(res.hasOwnProperty('products')){
                    products = res.products;
                    for(var j in products ){
                      popt +="<option value='"+products[j]+"'>"+products[j]+"</option>";
                  }
                  $(".productSelect").html(popt);
               }

      

        if(Dcode=="ZM"){
          if($(".zmLocSelect").val()=="All"){
            $(".rbmLocSelect").prop("disabled",true);  
          }else{
            $(".rbmLocSelect").prop("disabled",false);  
          }
          $(".tmLocSelect").prop("disabled",true);
          $(".poLocSelect").prop("disabled",true);
        }else if(Dcode=="RBM"){
           if($(".rbmLocSelect").val()=="All"){
            $(".tmLocSelect").prop("disabled",true);  
          }else{
             $(".tmLocSelect").prop("disabled",false); 
          }
          $(".poLocSelect").prop("disabled",true);
        }else if(Dcode=="TM"){
            if($(".tmLocSelect").val()=="All"){
             $(".poLocSelect").prop("disabled",true);  
           }else{
             $(".poLocSelect").prop("disabled",false);
           }  
        }else{
          $(".poLocSelect").prop("disabled",false);  
        }
        

              if(windowsonload){
                $(".filter-form").submit();
                windowsonload = false;
               }
    }
$("body").on("change",".rbmLocSelect",function(){

     _this = $(this);
     var lcode = _this.val();
      var Dcode = _this.data("dcode");

      var dataAreaId = $(".pdivision").val();
        var fdata = {Action: 'GET_TM',subact:'getInvidualFilter',dataAreaId:dataAreaId,Dcode:Dcode,lcode:lcode};
        var sep ="";
         fdata.zmcode = _this.find(':selected').data('zone');
        var all_code = "";
          if(lcode=='All'){
              $(".tmLocSelect").prop("disabled",true);
              $(".poLocSelect").prop("disabled",true);
            $(".rbmLocSelect option").each(function(index, el) {
                if(_this.val()!="All") {
                  all_code +=sep+$(this).val();
                  sep=",";
                }
            });
            fdata.all_code = all_code;
          }else{

            $(".tmLocSelect").prop("disabled",false);
          }
          
        

            fcurrentRequest = $.ajax({
              url: 'Ajax1.php',
              type: 'POST',
              dataType: 'json',
              async:false,
              data: fdata,
               beforeSend : function()   {           
              if(fcurrentRequest != null) {
                  fcurrentRequest.abort();
              }

               if(currentRequest != null) {
                  currentRequest.abort();
              }
          },
              success:function(res){
                GenSelectOpt(res,Dcode);
                $("#loader-wrapper").css('display','none');
              }
            });
});

$("body").on("change",".tmLocSelect",function(){
     _this = $(this);
     var lcode = _this.val();
      var Dcode = _this.data("dcode");
      
      var dataAreaId = $(".pdivision").val();
        var fdata = {Action: 'GET_PO',subact:'getInvidualFilter',dataAreaId:dataAreaId,Dcode:Dcode,lcode:lcode};
        var sep ="";
      
                if(lcode=='All'){
                  var allcode = "";
                  $(".poLocSelect").prop("disabled",true);
                  $(".tmLocSelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        allcode +=sep+$(this).val();
                        sep=",";
                      }
                  });
                  fdata.allcode = allcode;
                }else{
                  $(".poLocSelect").prop("disabled",false);
                }
          
            fcurrentRequest = $.ajax({
              url: 'Ajax1.php',
              type: 'POST',
              dataType: 'json',
              async:false,
              data: fdata,
               beforeSend : function()   {           
              if(fcurrentRequest != null) {
                  fcurrentRequest.abort();
              }
               if(currentRequest != null) {
                  currentRequest.abort();
              }
          },
              success:function(res){
                GenSelectOpt(res,Dcode);
                $("#loader-wrapper").css('display','none');
              }
            });
});

    
    /*$("body").on("change",".LocSelect",function(){
      //$("#loader-wrapper").css('display','block');
      alert(LocSelect);
      alert(cuLocSelect);
      if(LocSelect=="chart"){
        _this = $("."+cuLocSelect);
      }else{
         _this = $(this);
      }
      LocSelect = "option";
        var Dcode = _this.data("dcode");
        desgcode = Dcode;
          if(Dcode!="PO"){
            var lcode = _this.val();
            var dataAreaId = $(".pdivision:checked").val();
            var fdata = {Action: 'GetFilterOpt',subact:'getInvidualFilter',dataAreaId:dataAreaId,Dcode:Dcode,lcode:lcode};
            var sep ="";
            if(Dcode=='RBM'){
              fdata.zmcode = _this.find(':selected').data('zone');
              var all_code = "";
                if(lcode=='All'){
                  $(".rbmLocSelect option").each(function(index, el) {
                      if(_this.val()!="All") {
                        all_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                  fdata.all_code = all_code;
                }
            }

            if(Dcode=='TM'){
              fdata.rbmcode = _this.find(':selected').data('region');
              var all_code = "";
                if(lcode=='All'){
                  $(".tmLocSelect option").each(function(index, el) {
                      if(_this.val()!="All") {
                        all_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                  fdata.all_code = all_code;
                }
            }


            currentRequest = $.ajax({
              url: 'Ajax1.php',
              type: 'POST',
              dataType: 'json',
              async:false,
              data: fdata,
               beforeSend : function()   {           
              if(currentRequest != null) {
                  currentRequest.abort();
              }
          },
              success:function(res){
                GenSelectOpt(res,Dcode);
                $("#loader-wrapper").css('display','none');
              }
            });
      }
    });*/
    var hybridsSelect = $(".hybridsSelect");
    var subactivitySelect = $(".subactivitySelect");

    $('body').on("change",".productSelect",function(){
      //$("#loader-wrapper").css('display','block');
      
      var product = $(this).val();
      if(product!="All"){
         fcurrentRequest = $.ajax({
          url: 'Ajax1.php',
          type: 'POST',
          dataType: 'json',
          async:false,
          data: {Action: 'GET_HYBIRDSPDTRAIL',crop:product},
           beforeSend : function()   {           
              if(fcurrentRequest != null) {
                  fcurrentRequest.abort();
              }
               if(currentRequest != null) {
                  currentRequest.abort();
              }
          },
          success:function(res){
            var opt =  "";
            for(var i in res){
              opt += "<option value='"+res[i]+"'>"+res[i]+"</option>";
            }
            hybridsSelect.html(opt);
            $("#loader-wrapper").css('display','none');
          }
        });
      }else{
        hybridsSelect.html('');
      }
    });

    $('body').on("change",".activitySelect",function(){
      //$("#loader-wrapper").css('display','block');
      var activity = $(this).val();
      if(activity!="All"){
         fcurrentRequest =  $.ajax({
          url: 'Ajax1.php',
          type: 'POST',
          dataType: 'json',
          async:false,
          data: {Action: 'GET_SUBACTIVITY',activity:activity},
          beforeSend : function()   {           
              if(fcurrentRequest != null) {
                  fcurrentRequest.abort();
              }
               if(currentRequest != null) {
                  currentRequest.abort();
              }
          },
          success:function(res){
            var opt =  "";
            for(var i in res){
              opt += "<option value='"+res[i]+"'>"+res[i]+"</option>";
            }
            subactivitySelect.html(opt);
            $("#loader-wrapper").css('display','none');
          }
        });
      }else{
        subactivitySelect.html('');
        $("#loader-wrapper").css('display','none');
      }
    });
    
$("body").on("change",".atype",function(e){
  //$("#loader-wrapper").css('display','block');
    var atype = $(this).val();
      fcurrentRequest =  $.ajax({
          url: 'Ajax1.php',
          type: 'POST',
          dataType: 'json',
          async:false,
          data: {Action: 'GET_ACTIVITY',atype:atype},
          beforeSend : function()   {           
              if(fcurrentRequest != null) {
                  fcurrentRequest.abort();
              }
               if(currentRequest != null) {
                  currentRequest.abort();
              }
          },
          success:function(res){
            var activityOpt =  "";
           
            if(res.hasOwnProperty('activity')){
                activity = res.activity;
                activityOpt+="<option value='All'>All</option>";
                for(var k in activity ){
                    activityOpt +="<option value='"+activity[k]+"'>"+activity[k]+"</option>";
                }
                $(".activitySelect").html(activityOpt);
              }else{
                $(".activitySelect").html("");
                subactivitySelect.html('');
              }

              $("#loader-wrapper").css('display','none');

          }
        });
});

$("body").on("change",".zmLocSelect",function(e){
  //$("#loader-wrapper").css('display','block');
  var zmall_code = sep ="";
    if($(this).val()=="All"){
        $(".rbmLocSelect").prop("disabled",true);
        $(".tmLocSelect").prop("disabled",true);
        $(".poLocSelect").prop("disabled",true);
         $(".zmLocSelect option").each(function(index, el) {
          if($(this).val()!="All") {
            zmall_code +=sep+$(this).val();
            sep=",";
          }
      });
     
      zmval = zmall_code;
    }else{
      $(".rbmLocSelect").prop("disabled",false);
      zmval = $(this).val();
    }
  
    
      fcurrentRequest =  $.ajax({
          url: 'Ajax1.php',
          type: 'POST',
          dataType: 'json',
          async:false,
          data: {Action: 'GET_RBM',ZMLOC:zmval,dataAreaId:$(".pdivision").val()},
          beforeSend : function()   {           
              if(fcurrentRequest != null) {
                  fcurrentRequest.abort();
              }
               if(currentRequest != null) {
                  currentRequest.abort();
              }
          },
          success:function(res){
            
            GenSelectOpt(res,"ZM");
              $("#loader-wrapper").css('display','none');
          }
        });
});

