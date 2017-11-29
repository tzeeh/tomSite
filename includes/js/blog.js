var offset = 0;
var numOfPostLoad = 3;
$(function () {
  var post_name = getParameterByName("post");
  console.log(post_name);
  var data = {};
  data.offset = offset;
  data.numOfPostLoad = numOfPostLoad;
  data.post_name = post_name;

  $.ajax({
    url: "includes/get_blog_posts.php",
    method: "get",
    format: "html",
    data: data,
    success: function (data) {
      if (data.trim().length != 0) {
        $("#blogPosts").html(data);
        offset = offset + numOfPostLoad;
      }
    }
  })

})

function loadMorePosts() {
  var data = {};
  data.offset = offset;
  data.numOfPostLoad = numOfPostLoad;
  $.ajax({
    url: "includes/get_blog_posts.php",
    method: "get",
    format: "html",
    data: data,
    success: function (data) {
      console.log(data.trim().length);
      if (data.trim().length != 0) {
        console.log("works");
        offset = offset + numOfPostLoad;
        $("#blogPosts").append(data);
      } else {
        $("#btnLoadPosts").prop("disabled", true);
      }

    }

  })
}

function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}