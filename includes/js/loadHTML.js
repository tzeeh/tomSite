// page init
$(function () {
  // load header
  $("#commonSources").load("includes/html/commonSources.html");
  // load navbar
  $("#navigation").load("includes/html/navigation.html", function () {
    // when nav is loaded check which page loaded then add active to correct class
    var pathname = window.location.pathname;
    pathname = pathname.replace(/^.*[\\\/]/, '');
    if (pathname == "blog.html") {
      $("#blog").addClass("active");
    } else if (pathname == "resume.html") {
      $("#resume").addClass("active");
    } else {
      $("#index").addClass("active");
    }


  });
  // load footer
  $("#footer").load("includes/html/footer.html", function () {
    // when footer is loaded add date to footer
    var currentYear = (new Date).getFullYear();
    if (currentYear != "2017") {
      currentYear = "2017 - " + currentYear;
    }
    $("#year").text(currentYear);
  });
});