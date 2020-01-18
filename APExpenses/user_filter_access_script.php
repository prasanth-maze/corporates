<script type="text/javascript">   
/* Region level login disable for Division */
$(document).ready(function(){
    var login_type = $(".login_type").val();
      if(login_type =='RBM'){
          region_dets();
          division_dets(); 
      }else if(login_type =='TM'){
        division_dets();
        region_dets();
      }else{
        division_dets();
        region_dets();
      }
  });

function division_dets(){
  var val        = $(".cls_division").val();
  var login_type = $(".login_type").val();
  var id         = $(".reg_text").val();
 $.ajax 
  ({
    type: "POST",
    url: "ajax.php",
    data:'division_id='+val+'&&action_type=GET_REG',			 
    success: function(data){
        $('.cls_region').html(data);
        $('.cls_region').val(id);

        $(".div_select").removeAttr("disabled", "disabled");
        $(".div_text").removeAttr("disabled", "disabled");
        if(login_type == "RBM"){
          $(".div_select").attr("disabled", "disabled");
          $(".div_text").removeAttr("disabled", "disabled");
        }else{
          $(".div_text").attr("disabled", "disabled");
          $(".div_select").removeAttr("disabled", "disabled");
        }
      }
  });
}

/* Territory level login disable for region and Division */
function region_dets(){
    var val = $(".reg_text").val();
    var login_type = $(".login_type").val();
    $.ajax 
        ({
        type: "POST",
        url: "ajax.php",
        data:'region_id='+val+'&&action_type=GET_TM',			 
        success: function(data){
                    $('.cls_teritory').html(data);
                    $(".div_select").removeAttr("disabled", "disabled");
                    $(".div_text").removeAttr("disabled", "disabled");
                    $(".reg_select").removeAttr("disabled", "disabled");
                    $(".reg_text").removeAttr("disabled", "disabled");
                if(login_type == "TM"){
                $(".div_select").attr("disabled", "disabled");
                    $(".div_text").removeAttr("disabled", "disabled");
                    $(".reg_select").attr("disabled", "disabled");
                    $(".reg_text").removeAttr("disabled", "disabled");
                }else{
                    $(".div_select").removeAttr("disabled", "disabled");
                    $(".div_text").attr("disabled", "disabled");
                    $(".reg_select").removeAttr("disabled", "disabled");
                    $(".reg_text").attr("disabled", "disabled");
                }
            }
        });
}

function get_region(val) {  
  var action_type = 'GET_REG';
  $.ajax 
    ({
      type: "POST",
      url: "ajax.php",
      data:'division_id='+val+'&&action_type='+action_type,			 
      success: function(data){
          $('.cls_region').html(data);
           get_employee(action_type,val);
        }
    });
}

function get_teritory(val) {  
var action_type = 'GET_TM';
$.ajax 
    ({
    type: "POST",
    url: "ajax.php",
    data:'region_id='+val+'&&action_type='+action_type,			 
    success: function(data){
        $('.cls_teritory').html(data);
        get_employee(action_type,val);
        }
    });
}

function get_employee(action_type,val) { 
  $.ajax 
    ({
    type: "POST",
    url: "ajax.php",
    data:'teritory_id='+val+'&&action_type='+action_type+'&&action_emp=GET_EMP_DETAILS',			 
    success: function(data){
        $('.cls_adv_to').append(data);
        }
    });
}
 </script>