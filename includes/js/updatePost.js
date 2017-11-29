function selectChange() {
  if ($("#inputPost").val() != "insert") {
    $.ajax({
      url: "../../includes/get_post_data.php",
      method: "get",
      dataType: "json",
      data: {
        "id": $("#inputPost").val()
      },
      success: function (data) {
        if (data.success) {
          $("#inputTitle").val(data.entries[0].post_title);
          $("#inputName").val(data.entries[0].post_name);
          $("#inputContent").val(data.entries[0].post_content);
          $("#inputTags").val(data.entries[0].tags);
          $("#id").val(data.entries[0].ID);
        } else {
          console.log(data.error);
        }
      }
    })
  } else {
    $("#inputTitle").val("");
    $("#inputName").val("");
    $("#inputContent").val("");
    $("#inputTags").val("");
    $("#id").val("");
  }
}