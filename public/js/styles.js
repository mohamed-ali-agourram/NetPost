$("notification").addClass("thin");
$("notification").mouseover(function(){
  $(this).removeClass("thin");
});
$("notification").mouseout(function(){
  $(this).addClass("thin");
});
$("notification").scroll(function () {
  $("notification").addClass("thin");
});