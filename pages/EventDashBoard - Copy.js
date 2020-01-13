var LocSelect = "option";
var cuLocSelect="";
var lctitle = pctitle = actitle = "";
var CL = CP = CA = null;
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
      $("#getCReport").val("All");
  });
     /*  (function (H) {
                
        //For X-axis labels
        H.wrap(H.Point.prototype, 'init', function (proceed, series, options, x) {
          
          
            var point = proceed.call(this, series, options, x),
                chart = series.chart,
                tick = series.xAxis && series.xAxis.ticks[x],
                tickLabel = tick && tick.label;
            
            if (point.drilldown) {
                console.log('point drill down');
                if (tickLabel) {
                    if (!tickLabel._basicStyle) {
                        tickLabel._basicStyle = tickLabel.element.getAttribute('style');
                    }
                    tickLabel.addClass('highcharts-drilldown-axis-label').css({
                        'text-decoration': 'none',
                        'font-weight': 'normal',
                        'cursor': 'auto'
                        }).on('click', function () {
                            if (point.doDrilldown) {
                             
                                return false;
                            }
                        });//remove this "on" block to make axis labels clickable
                }
            } 
            else if (tickLabel && tickLabel._basicStyle) 
            {
             console.log(tickLabel.textStr);
            }
             
            return point;
        });
    })(Highcharts);*/
 var currentRequest = fcurrentRequest = null;    
  desgcode = '';
  var windowsonload = true;

    $("body").on("submit",".filter-form",function(e){
    $("#loader-wrapper").css('display','block');     
     
        var data = $(this).serialize();
      var addmore = "yes";

        if($(".poLocSelect").length>0){
            var poloc = $(".poLocSelect").val();

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
                          lctitle =  $(".tmLocSelect option:selected").text()+" - PO";
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

            if(tmloc=='All' && addmore=='yes'){
              var tmall_code = sep ="";
                 $(".tmLocSelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        tmall_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                 
                  data = data+"&tmall_code="+tmall_code;
                  lctitle = "All Terriorty";
            }else{
              //data = data+"&tmall_code="+tmloc;
              addmore = "no";
              if($(".poLocSelect").val()=='All'){
               lctitle =  $(".tmLocSelect option:selected").text()+" - PO";
              }
            }
        }


        if($(".rbmLocSelect").length>0 && addmore=='yes'){
            var rbmloc = $(".rbmLocSelect").val();

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
                      lctitle =  $(".zmLocSelect option:selected").text()+" - Region";
                    }
                  }else{
                    lctitle = "All Region";
                  }
                  
            }else{
             // data = data+"&rbmall_code="+rbmloc;
             addmore = "no";
             lctitle =  $(".rbmLocSelect option:selected").text()+" - Terriotry";
            }
        }

        if($(".zmLocSelect").length>0 && addmore=='yes'){
            var zmloc = $(".zmLocSelect").val();

            if(zmloc=='All' && addmore=='yes'){
              var zmall_code = sep ="";
                 $(".zmLocSelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        zmall_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                 
                  data = data+"&zmall_code="+zmall_code;
                  lctitle = "All Division"
            }else{
              //data = data+"&zmall_code="+zmloc;
              lctitle =  $(".zmLocSelect option:selected").text()+" - Region";
            }
        }
      

            var prodval = $(".productSelect").val();

            if(prodval=='All'){
              var prodall_code = sep ="";
                 $(".productSelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        prodall_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                  
                  data = data+"&prodall_code="+prodall_code;
                  if($(".hybridsSelect").val()!="All"){
                    pctitle =" All Products ";  

                  }
            }else{
                var hybval = $(".hybridsSelect").val();

                if(hybval=='All'){
                  var hyball_code = sep ="";
                     $(".hybridsSelect option").each(function(index, el) {
                          if($(this).val()!="All") {
                            hyball_code +=sep+$(this).val();
                            sep=",";
                          }
                      });
                     
                      data = data+"&hyball_code="+hyball_code;
                      pctitle =$(".productSelect option:selected").text()+" - Hybrids ";
                }else{
                  data = data+"&hyball_code="+hybval;
                  pctitle =$(".hybridsSelect option:selected").text();
                }
            }
    
       
            var actval = $(".activitySelect").val();

            if(actval=='All'){
              var actall_code = sep ="";
                 $(".activitySelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        actall_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                 if($(".subactivitySelect").val()!="All"){
                  actitle =" All Activity"; 
                 }
                 
                  data = data+"&actall_code="+actall_code;
            }else{
                var subactval = $(".subactivitySelect").val();

            if(subactval=='All'){
              var subactall_code = sep ="";
                 $(".subactivitySelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        subactall_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                 actitle =$(".activitySelect option:selected").text()+" - Sub Activity ";
                  data = data+"&subactall_code="+subactall_code;
             } else{
                actitle =$(".subactivitySelect option:selected").text();
                 data = data+"&subactall_code="+subactval;
             }
            }
        
            


       currentRequest =  $.ajax({
          url: 'EventChart.php',
          type: 'POST',
          dataType: 'json',
          data: data,
           beforeSend : function() {     
              if(currentRequest != null) {
                  currentRequest.abort();
              }
          },
          success:function(res){
            $(".evtplanned").text(res.evtplanned);
            $(".evtexec").text(res.evtexec);
            $(".evtapproved").text(res.evtapproved);
            $(".evtpending").text(res.evtpending);

            $(".evtexecpend").text(res.evtapproved-res.evtexec);

            if(res.hasOwnProperty('locationWiseData')){
              genLocationWiseChart(res.locationWiseData);       
              //genDetailedLocChart(res.locationWiseData);
            }
            if(res.hasOwnProperty('productWisesData'))
              genProductWiseChart(res.productWisesData);
             if(res.hasOwnProperty('ActivityWisesData'))
              genActivityWiseChart(res.ActivityWisesData);
            if(res.hasOwnProperty('TrendChartData'))
                genTrendChart(res.TrendChartData);
              genReport(data);
             
               //$("#loader-wrapper").css('display','none');
          }
           });
        
       return false;
      });

  /* function genLocationWiseChart(locationWiseData){
           var locSeriousdata = locationWiseData;
           var sfor = locationWiseData.locseriesfor;
           var series1for = series2for = series3for = '';
           //console.log(sfor);
           if(sfor.hasOwnProperty('series1')){
            series1for= sfor.series1;
           } if(sfor.hasOwnProperty('series2')){
            series2for= sfor.series2;
           } if(sfor.hasOwnProperty('series3')){
            series3for= sfor.series3;
           }
           

            
           series1 = locSeriousdata.series1;
           drilldown = {};
           var s2dataarr = {};
           if(locSeriousdata.hasOwnProperty('series2')){
              var series2arr = [];
              var series2 = locSeriousdata.series2;
              series3found = 'no';
              if(locSeriousdata.hasOwnProperty('series3')){
                  var series3 = locSeriousdata.series3;
                  series3found = 'yes';
                }

               for(s1 in series1){
                var s1name =  series1[s1].name;
                var s2dataarr = []
                if(series2.hasOwnProperty(s1name)){
                    var sdataarr = series2[s1name];
                    for(i in sdataarr){
                        var s2name = sdataarr[i].name;
                        var s2data = sdataarr[i];
                       if(series3found=='yes'){
                          var s3dataarr = series3[s2name];
                          var series3arr = [];
                          for(j in s3dataarr){
                            series3arr.push(s3dataarr[j]);
                          }
                          
                           series2arr.push({
                                      id: s2name,
                                      name: series3for,
                                      y:s2data.y,
                                      drilldown:s2name,
                                      data:series3arr
                              });
                       }else{
                             series2arr.push({
                                      id: s2name,
                                      name: series3for,
                                      y:s2data.y
                              });
                        }

                       s2dataarr.push(s2data);
                      
                    }
                  }
                  series2arr.push({
                          id: s1name,
                          name: series2for,
                          data:s2dataarr
                  });
               }
               drilldown.series = series2arr;
           }
        
           var option = {
                  chart: {
                      type: 'column',
                       renderTo: 'LocationWiseChartContainer',
                  },
                  title: {
                      text: 'Location Wise Event Count'
                  },
                  xAxis: {
                      type: 'category'
                  },

                  legend: {
                      enabled: true
                  },

                  plotOptions: {
                      series: {
                          borderWidth: 0,
                          dataLabels: {
                              enabled: true,
                          }
                      }
                  },
                  series: [{
                  name: series1for,
                  colorByPoint: true,
                  data: series1
                }],
                drilldown:{}
              }
              option.drilldown = drilldown;
            chart = new Highcharts.Chart(option);
    }*/
    
  /*  function genLocationWiseChart(locationWiseData){
       var locSeriousdata = locationWiseData;
       //console.log(locSeriousdata);
       var series1 = locSeriousdata.series1;
       //return false;
       var series1PENDobj = series1APPobj = series1EXECobj =  {};
       
       if(series1.hasOwnProperty('PENDING')){
          series1PENDobj = series1.PENDING;
       }

        if(series1.hasOwnProperty('APPROVED')){
          series1APPobj = series1.APPROVED;
       }

       if(series1.hasOwnProperty('EXECUTED')){
          series1EXECobj = series1.EXECUTED;
       }
        var s2pendpdata = [];
       if(locationWiseData.hasOwnProperty('series2')){
          //console.log(locationWiseData.series2);
          var series2 = locationWiseData.series2;
         
          if(series1.hasOwnProperty('PENDING')){
            series1PENDobj1 = series1.PENDING;
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

        $('#LocationWiseChartContainer').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
          allowDecimals: false,
          title: {
                    text: 'Count'
                }
        },
        plotOptions: {
            column : {
                stacking : 'normal',
                dataLabels: {
                enabled: true,
                  color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },

        series: [{
                  name: 'PENDING',
                  data: series1PENDobj
              },{
                 name: 'APPROVED',
                 data: series1APPobj
              },{
                 name: 'EXECUTED',
                 data: series1EXECobj
              }
              ],
        drilldown: {
          //series:s2pendpdata
        }
    });
    }*/

    
    
function genLocationWiseChart(locationWiseData){
      
       var locSeriousdata = locationWiseData;
       //console.log(locationWiseData);
       CL = locationWiseData.CL;
       //return false;
       var categoriesarr = [];
       var categoriesidarr = [];
        var series1PENDobj = [] ;
        var  series1APPobj = [];
        var series1EXECobj = [];
        var fcarr = {};
        var vcarr = [];
        var dcarr = [];
       
       if(locSeriousdata.hasOwnProperty('series1')){
          var series1 = locSeriousdata.series1;
         
          if(series1.hasOwnProperty('PENDING')){
              series1PENDobj1 = series1.PENDING;
           
               for(var ri in series1PENDobj1){ 
                    var cobj = series1PENDobj1[ri];
                    var name = cobj.name;
                    var NID = cobj.NID;
                    series1PENDobj.push(series1PENDobj1[ri]);
                     if(!categoriesarr.includes(name)){
                        categoriesidarr.push(NID);
                        categoriesarr.push(name);
                         fcarr[NID]=0;
                         vcarr[NID]=0;
                         dcarr[NID]=0;
                     }
                  }

                // /console.log(series1PENDobj);  
          }

          if(series1.hasOwnProperty('APPROVED')){
              series1APPobj1 = series1.APPROVED;
               for(var ri in series1APPobj1){ 
                    var cobj = series1APPobj1[ri];
                    var name = cobj.name;
                    var NID = cobj.NID;
                      series1APPobj.push(series1APPobj1[ri]);
                     if(!categoriesarr.includes(name)){
                        categoriesidarr.push(NID);
                        categoriesarr.push(name);
                         fcarr[NID]=0;
                         vcarr[NID]=0;
                         dcarr[NID]=0;
                     }
                  }
          }

          if(series1.hasOwnProperty('EXECUTED')){
              series1EXECobj1 = series1.EXECUTED;
               for(var ri in series1EXECobj1){ 
                    var  cobj = series1EXECobj1[ri];
                    var name = cobj.name;
                    var NID = cobj.NID;
                    series1EXECobj.push(cobj);
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
                  type: 'column'
              },
        
        title: {
            text: lctitle
        },
        xAxis: {
            //type: 'category',
            categories:categoriesarr
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
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
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
                  name: 'PENDING',
                  data: series1PENDobj
                },{
                   name: 'APPROVED',
                   data: series1APPobj
                },{
                   name: 'EXECUTED',
                  data: series1EXECobj
                },
                 {name: 'Farmers Covered',
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
                }
              ],
        /*drilldown: {
          series:s2pendpdata
        }*/
    });
        lc.xAxis[0].labelGroup.element.childNodes.forEach(function(label)
      {
        label.style.cursor = "pointer";
        label.onclick = function(events){
         
         /* alert($(this).find('tspan:eq(0)').text());
          alert($(this).find('tspan:eq(1)').text());*/
          var lname = $(this).find('tspan:eq(0)').text();
          var id = $(this).find('tspan:eq(1)').text();
            
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


    /*function genProductWiseChart(productWisesData){
           var locSeriousdata = productWisesData;
           var sfor = productWisesData.pdseriesfor;
           var series1for = series2for = '';
           console.log(sfor);
           if(sfor.hasOwnProperty('series1')){
            series1for= sfor.series1;
           } if(sfor.hasOwnProperty('series2')){
            series2for= sfor.series2;
           }

           series1 = locSeriousdata.series1;
           drilldown = {};
           var s2dataarr = {};
           if(locSeriousdata.hasOwnProperty('series2')){
              var series2arr = [];
              var series2 = locSeriousdata.series2;
              series3found = 'no';
              if(locSeriousdata.hasOwnProperty('series3')){
                  var series3 = locSeriousdata.series3;
                  series3found = 'yes';
                }

               for(s1 in series1){
                var s1name =  series1[s1].name;
                var s2dataarr = []
                if(series2.hasOwnProperty(s1name)){
                    var sdataarr = series2[s1name];
                    for(i in sdataarr){
                        var s2name = sdataarr[i].name;
                        var s2data = sdataarr[i];
                       if(series3found=='yes'){
                          var s3dataarr = series3[s2name];
                          var series3arr = [];
                          for(j in s3dataarr){
                            series3arr.push(s3dataarr[j]);
                          }
                          
                           series2arr.push({
                                      id: s2name,
                                      name: 'none',
                                      y:s2data.y,
                                      drilldown:s2name,
                                      data:series3arr
                              });
                       }else{
                             series2arr.push({
                                      id: s2name,
                                      name: 'none',
                                      y:s2data.y
                              });
                        }

                       s2dataarr.push(s2data);
                      
                    }
                  }
                  series2arr.push({
                          id: s1name,
                          name: series2for,
                          data:s2dataarr
                  });
               }
               drilldown.series = series2arr;
           }
        
           var option = {
                  chart: {
                      type: 'column',
                       renderTo: 'ProductWiseChartContainer',
                  },
                  title: {
                      text: 'Produt Wise Event Count'
                  },
                  xAxis: {
                      type: 'category'
                  },

                  legend: {
                      enabled: true
                  },

                  plotOptions: {
                      series: {
                          borderWidth: 0,
                          dataLabels: {
                              enabled: true,
                          }
                      }
                  },
                  series: [{
                  name: series1for,
                  colorByPoint: true,
                  data: series1
                }],
                drilldown:{}
              }
              option.drilldown = drilldown;
            productChart = new Highcharts.Chart(option);
    }*/
    function genProductWiseChart(productWisesData){

       var locSeriousdata = productWisesData;
       CP = productWisesData.CP;
       //console.log(locSeriousdata);
       var series1 = locSeriousdata.series1;
       //return false;
       var series1PENDobj = series1APPobj = series1EXECobj =  {};
       
       if(series1.hasOwnProperty('PENDING')){
          series1PENDobj = series1.PENDING;
       }

        if(series1.hasOwnProperty('APPROVED')){
          series1APPobj = series1.APPROVED;
       }

       if(series1.hasOwnProperty('EXECUTED')){
          series1EXECobj = series1.EXECUTED;
       }
        var s2pendpdata = [];
       if(productWisesData.hasOwnProperty('series2')){
          //console.log(locationWiseData.series2);
          var series2 = productWisesData.series2;
         
          if(series1.hasOwnProperty('PENDING')){
            series1PENDobj1 = series1.PENDING;
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
            type: 'category'
        }, 
        yAxis: {
          allowDecimals: false,
          title: {
                    text: 'Count'
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
                  name: 'PENDING',
                  data: series1PENDobj
              },{
                 name: 'APPROVED',
                 data: series1APPobj
              },{
                 name: 'EXECUTED',
                 data: series1EXECobj
              }
              ],
        /*drilldown: {
          series:s2pendpdata
        }*/
    });

         pc.xAxis[0].labelGroup.element.childNodes.forEach(function(label)
      {
        label.style.cursor = "pointer";
        label.onclick = function(events){
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

    /*function genActivityWiseChart(ActivityWisesData){
           var locSeriousdata = ActivityWisesData;
           var sfor = ActivityWisesData.actseriesfor;
           var series1for = series2for = '';
           if(sfor.hasOwnProperty('series1')){
            series1for= sfor.series1;
           } if(sfor.hasOwnProperty('series2')){
            series2for= sfor.series2;
           }
           series1 = locSeriousdata.series1;
           drilldown = {};
           var s2dataarr = {};
           if(locSeriousdata.hasOwnProperty('series2')){
              var series2arr = [];
              var series2 = locSeriousdata.series2;
              series3found = 'no';
              if(locSeriousdata.hasOwnProperty('series3')){
                  var series3 = locSeriousdata.series3;
                  series3found = 'yes';
                }

               for(s1 in series1){
                var s1name =  series1[s1].name;
                var s2dataarr = []
                if(series2.hasOwnProperty(s1name)){
                    var sdataarr = series2[s1name];
                    for(i in sdataarr){
                        var s2name = sdataarr[i].name;
                        var s2data = sdataarr[i];
                       if(series3found=='yes'){
                          var s3dataarr = series3[s2name];
                          var series3arr = [];
                          for(j in s3dataarr){
                            series3arr.push(s3dataarr[j]);
                          }
                          
                           series2arr.push({
                                      id: s2name,
                                      name: 'NONE',
                                      y:s2data.y,
                                      drilldown:s2name,
                                      data:series3arr
                              });
                       }else{
                             series2arr.push({
                                      id: s2name,
                                      name: 'NONE',
                                      y:s2data.y
                              });
                        }

                       s2dataarr.push(s2data);
                      
                    }
                  }
                  series2arr.push({
                          id: s1name,
                          name: series2for,
                          data:s2dataarr
                  });
               }
               drilldown.series = series2arr;
           }
        
           var option = {
                  chart: {
                      type: 'column',
                       renderTo: 'ActivityWiseChartContainer',
                  },
                  title: {
                      text: 'Activity Wise Event Count'
                  },
                  xAxis: {
                      type: 'category'
                  },

                  legend: {
                      enabled: true
                  },

                  plotOptions: {
                      series: {
                          borderWidth: 0,
                          dataLabels: {
                              enabled: true,
                          }
                      }
                  },
                  series: [{
                  name: series1for,
                  colorByPoint: true,
                  data: series1
                }],
                drilldown:{}
              }
              option.drilldown = drilldown;
            ActivityWiseChart = new Highcharts.Chart(option);

    } */ 

    function genActivityWiseChart(ActivityWisesData){

       var locSeriousdata = ActivityWisesData;
       CA = ActivityWisesData.CA;
       //console.log(locSeriousdata);
       var series1 = locSeriousdata.series1;
       //return false;
       var series1PENDobj = series1APPobj = series1EXECobj =  {};
       
       if(series1.hasOwnProperty('PENDING')){
          series1PENDobj = series1.PENDING;
       }

        if(series1.hasOwnProperty('APPROVED')){
          series1APPobj = series1.APPROVED;
       }

       if(series1.hasOwnProperty('EXECUTED')){
          series1EXECobj = series1.EXECUTED;
       }
        var s2pendpdata = [];
       if(locSeriousdata.hasOwnProperty('series2')){
          //console.log(locationWiseData.series2);
          var series2 = locSeriousdata.series2;
         
          if(series1.hasOwnProperty('PENDING')){
            series1PENDobj1 = series1.PENDING;
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
            type: 'category'
        },
         yAxis: {
          allowDecimals: false,
          title: {
                    text: 'Count'
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
                  name: 'PENDING',
                  data: series1PENDobj
              },{
                 name: 'APPROVED',
                 data: series1APPobj
              },{
                 name: 'EXECUTED',
                 data: series1EXECobj
              }
              ],
        /*drilldown: {
          series:s2pendpdata
        }*/
    });

      ac.xAxis[0].labelGroup.element.childNodes.forEach(function(label)
      {
        label.style.cursor = "pointer";
        label.onclick = function(events){
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


   ReportTable =  $("#ReportTable").DataTable( {"columnDefs": [
            {
                "targets": [ 19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36 ],
                "visible": false,
                "searchable": false
            }
        ]});
    function genReport(filterData){
      $("#loader-wrapper").css('display','block');
       $('#ReportTable').DataTable().destroy();
          ReportTable =  $('#ReportTable').DataTable({
             "columnDefs": [
            {
                "targets": [ 19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36 ],
                "visible": false,
                "searchable": false
            }
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
           $("#loader-wrapper").css('display','none');
    }

     $('#ReportTable tbody').on( 'click', 'tr', function () {
      $(".ptabs").removeClass('active');
      $(".tab-pane").removeClass('active');
      $(".exampleTabsOne").addClass('active');
    //console.log( TMReportTable.row( this ).data() );
    var rowdata = ReportTable.row( this ).data() ;
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

    $("body").on("click",".pdivision",function(){

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
            data: {Action: 'GetFilterOpt',dataAreaId:dataAreaId},
            success:function(res){
              GenSelectOpt(res,"DIV");
              $("#loader-wrapper").css('display','none');
            }
          });
    });
$(".pdivision:checked").trigger('click');
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
                
                  ridval = rname;
                  if(rid=="All"){
                    ridval = 'All';
                  }

                      rbmLocSelect +="<option value='"+rid+"' >"+ridval+"</option>";
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

               if(windowsonload){
                $(".filter-form").submit();
                windowsonload = false;
               }
    }
$("body").on("change",".rbmLocSelect",function(){
     _this = $(this);
     var lcode = _this.val();
      var Dcode = _this.data("dcode");

      var dataAreaId = $(".pdivision:checked").val();
        var fdata = {Action: 'GET_TM',subact:'getInvidualFilter',dataAreaId:dataAreaId,Dcode:Dcode,lcode:lcode};
        var sep ="";
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
      
      var dataAreaId = $(".pdivision:checked").val();
        var fdata = {Action: 'GET_PO',subact:'getInvidualFilter',dataAreaId:dataAreaId,Dcode:Dcode,lcode:lcode};
        var sep ="";
      
                if(lcode=='All'){
                  var allcode = "";
                  $(".tmLocSelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        allcode +=sep+$(this).val();
                        sep=",";
                      }
                  });
                  fdata.allcode = allcode;
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
          data: {Action: 'GET_HYBIRDS',crop:product},
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

    var zmval = $(this).val();
      fcurrentRequest =  $.ajax({
          url: 'Ajax1.php',
          type: 'POST',
          dataType: 'json',
          async:false,
          data: {Action: 'GET_RBM',ZMLOC:zmval,dataAreaId:$(".pdivision:checked").val()},
          beforeSend : function()   {           
              if(fcurrentRequest != null) {
                  fcurrentRequest.abort();
              }
               if(currentRequest != null) {
                  currentRequest.abort();
              }
          },
          success:function(res){
            
            GenSelectOpt(res);
              $("#loader-wrapper").css('display','none');
          }
        });
});

