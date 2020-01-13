<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Tooltip - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  	$(document).ready(function($) {
  		
  	
  $('.tb').tooltip({
    items: 'td.var',
    content: 'Loading…xczxczxczxczxxczxc',
    show: null, // show immediately
    open: function(event, ui)
    {
     
        ui.tooltip.css("max-width", "40px");
          ui.tooltip.css("min-height", "100px");
          ui.tooltip.css("overflow-x", "scroll");
  
        if (typeof(event.originalEvent) === 'undefined')
        {
            return false;
        }
        
        var $id = $(ui.tooltip).attr('id');
        
        // close any lingering tooltips
        $('div.ui-tooltip').not('#' + $id).remove();
        
        // ajax function to pull in data and add it to the tooltip goes here
    },
    close: function(event, ui)
    {
        ui.tooltip.hover(function()
        {
            $(this).stop(true).fadeTo(400, 1); 
        },
        function()
        {
            $(this).fadeOut('400', function()
            {
                $(this).remove();
            });
        });
    }
});
  });
  </script>
  <style>
  label {
    display: inline-block;
    width: 5em;
  }
  </style>
</head>
<body>
<table class="tb table">
<tbody>
  <tr>
    <td class="var">hi</td>
    <td class="var">hello</td>
    <td class="var">welcome</td>
  </tr>
</tbody>
</table>
 
 
</body>
</html>