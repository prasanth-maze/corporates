var toggle = false;

// $(".sidebar-icon").click(function () {



//   if (toggle) {
//     $(".sidebar-menu").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
//     $("#menu span").css({ "position": "absolute" });
//     $("#myDIV,#menu1,#menu2,#menu3").removeClass("menu-collapsed");
//   }
//   else {
//     $(".sidebar-menu").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
//     setTimeout(function () {
//       $("#menu span").css({ "position": "relative" });
//     }, 400);
//     $("#myDIV,#menu1,#menu2,#menu3").addClass("menu-collapsed");
//   }

//   toggle = !toggle;
// });
// custom js

$(".sidebar-menu ").hover(function () {



  if (toggle) {
    $(".sidebar-menu").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({ "position": "absolute" });
    $("#myDIV,#menu1,#menu2,#menu3").removeClass("menu-collapsed");
  }
  else {
    $(".sidebar-menu").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function () {
      $("#menu span").css({ "position": "relative" });
    }, 400);
    $("#myDIV,#menu1,#menu2,#menu3").addClass("menu-collapsed");
  }

  toggle = !toggle;
});