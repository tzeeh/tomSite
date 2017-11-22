$(function () {
  $.ajax({
      url: "sudo/data.php",
      method: "get",
      format: "json",
    })
    .done(function (data) {
      console.log(data);
      if (data) {
        $("#blogPosts").html(data);
      }

    })

})