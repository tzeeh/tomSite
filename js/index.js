// page init
$(function () {
  // load navbar
  $("#navigation").load("html/navigation.html");
  // load footer
  $("#footer").load("html/footer.html", function () {
    // when footer is loaded add date to footer
    var currentYear = (new Date).getFullYear();
    if (currentYear != "2017") {
      currentYear = "2017 - " + currentYear;
    }
    $("#year").text(currentYear);
  });
});