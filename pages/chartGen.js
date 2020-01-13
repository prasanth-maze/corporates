
$(document).ready(function() {
  chart = '';
var POCode = lastpo =  lasttype = laststatus = 'all';
CurrentLevel = 1;
var pcodeInput = $(".pocode");
var atypeInput = $(".type");
var astatusinput = $(".activitystatus");

var insdata =  {seriesdata: 'seriesdata',pocode:pcodeInput.val(),atype:atypeInput.val(),status:astatusinput.val()}

function chartGenfunc(insdata){

 $.ajax({
  url: 'getEventData.php',
  type: 'POST',
  //dataType: 'json',
  data: insdata,
  async:false,
  success:function (res){
    console.log(res);
    var Seriousdata = JSON.parse(res);
    var option = {
    chart: {
      renderTo: 'container',
      type: 'column',
      events: {
         drilldown: function (e) {
                if (!e.seriesOptions) {
                  console.log(e.point);
                    // e.point.name is info which bar was clicked
                    lastpo = lastpo;
                    lasttype = lasttype;
                    laststatus = laststatus;

                     chart.showLoading('Loading ...');
                     activitystatus = $(".activitystatus").val();
                     atype = $(".type").val();


                    
                    if(CurrentLevel==1){
                      POCode = e.point.name;
                      
                      $(".pocode option[value='"+POCode+"']").prop('selected', true);
                    }

                    if(CurrentLevel==2){
                      atype = e.point.name;
                      $(".type option[value='"+atype+"']").prop('selected', true);
                    }

                      CurrentLevel++;

                     postdata = {pocode:POCode,atype:atype,status:activitystatus,level:CurrentLevel};

                    var result = ProcessData(postdata);                 

                      
                chart.hideLoading();

                chart.addSeriesAsDrilldown(e.point, result);
               console.log(e.point);
                }
            },
          drillup:function(e){

              if(CurrentLevel==2)
              {
                $(".pocode option[value='"+lastpo+"']").prop('selected', true);
              }
               if(CurrentLevel==3){
                 $(".type option[value='"+lasttype+"']").prop('selected', true);
               }
                

                $(".activitystatus option[value='"+laststatus+"']").prop('selected', true);
            CurrentLevel--;
             console.log(this);
            console.log(this.options.series[0].name);
            console.log(this.options.series[0].data[0].name);
          }
      }
    },
    title: {
      text: 'Event Chart'
    },
    subtitle: {
      text: ''
    },
    xAxis: {
      type: 'category'
    },
    yAxis: [{
      title: {
        text: 'Event Count'
      },
      stackLabels: {
        enabled: true,
        style: {
          fontWeight: 'bold',
          color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
        }
      }
    }],
    legend: {
      align: 'right',
      x: -30,
      verticalAlign: 'top',
      y: 25,
      floating: true,
      backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
      borderColor: '#CCC',
      borderWidth: 1,
      shadow: false
    },
    plotOptions: {
      column: {
        stacking: 'normal',
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: '{point.y:1f}',
        }
      }
    },
    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:2f}</b> Event<br/>'
    },
    series: [{
      name: 'Event',
      colorByPoint: true,
      data: Seriousdata
    }],
    drilldown: {}

  };

   var drilldown = {series: []};
   option.drilldown = drilldown;
   chart = new Highcharts.Chart(option);
  }
});

}

chartGenfunc(insdata);


  $("body").on("change",".filterInputs",function (e){
      var pocode = $(".pocode").val();
      var type = $(".type").val();
      var status = $(".activitystatus").val();
       postdata = {pocode:pocode,level:CurrentLevel,atype:type,status:status};
        POCode = pocode;
        
         lastpo = POCode;
          lasttype = type;
          laststatus = status;
      if(CurrentLevel==1){
          postdata.seriesdata='seriesdata';
           chartGenfunc(postdata);
        }

         if(CurrentLevel==2){
           chart.showLoading('Loading ...');
            var result = ProcessData(postdata);
            chart.series[0].point[0].remove();
            chart.hideLoading();

         }

          if(CurrentLevel==3){
            ProcessData(postdata);
         }

       /* if(CurrentLevel==2){
          postdata = {activityType:type,pocode:pocode};
        } 

        ProcessData(postdata);*/
  });


  function ProcessData(pdata){
    var ret = {};
      $.ajax({
          url: 'getEventData.php',
          type: 'POST',
          data: postdata,
          dataType: 'json',
          async:false,
          success:function(resp){
            
            if(CurrentLevel==2){
                drdata = {
                  name: 'Activities',
                  colorByPoint: true,
                  data: []
                };

                for(var i in resp){
                  drdata.data.push(resp[i]);
                }

              }else if(CurrentLevel==3){

                drdata = {
                  name: 'Status',
                  colorByPoint: true,
                  data: []
                };

                for(var i in resp){
                  drdata.data.push(resp[i]);
                }
              }
              ret =  drdata;
          }
         
        });
      return ret;
    }
});
