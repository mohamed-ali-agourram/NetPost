// notfications-dropdown
$(".notification_dropdown").click(function () {
 $(".notification_dropdown").hide();
 $(".notification").slideToggle(300);
});

$(".bell").click(function () {
 $(".notification_dropdown").toggle();
 $(".notification").slideToggle(300);
});

$("#close_notif").click(function () {
 $(".notif_model").slideToggle(250);
});

$(".comment_section").click(function () {
 $(this).find(".comment").slideToggle(200);
});

// $(".delete_comnt").click(function () {
//  $(this).parent(".notif").remove();
// });

// nav effects
$(".toggleNav").click(function () {
 $(".routes").css("left", 0);
 setTimeout(function () {
  $(".content").hide();
 }, 250);
});

$(".logo i").click(function () {
 $(".routes").css("left", "-120vw");
 $(".content").css("display", "block");
});

var prevScrollpos = window.pageYOffset;
window.onscroll = function () {
 var currentScrollPos = window.pageYOffset;
 if (prevScrollpos > currentScrollPos) {
  document.getElementById("navbar").style.top = "0";
  if (document.querySelector(".freinds_list")) {
   document.querySelector(".freinds_list").style.top = "13vh";
  }
  document.querySelector(".notification").style.top = "11vh";
 } else {
  document.getElementById("navbar").style.top = "-15vh";
  if (document.querySelector(".freinds_list")) {
   document.querySelector(".freinds_list").style.top = "1vh";
  }

  document.querySelector(".notification").style.top = "0vh";
 }
 prevScrollpos = currentScrollPos;
};

// filters
$("#filter_btn").click(function () {
 $(".filters").slideToggle(200);
});

// settings page
$(".gear").click(function () {
 $(".settings_routes").slideToggle(250);
});

// post-modal
$(".post_model_dropdown").click(function () {
 $(".post_model_dropdown").hide();
 $(".post_from_model").toggle(200);
});

$("#post").click(function () {
 $(".post_model_dropdown").toggle();
 $(".post_from_model").toggle(200);
});

