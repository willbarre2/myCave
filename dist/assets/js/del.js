$(".btn-del").on("click", function () {
  var bottleID = $(this).data("id");
  var msgDel = $(".msgDel");
  $.post(
    "ajax_php/del_bottle_post.php",
    {
      bottleID: bottleID,
    },
    function (response) {
      if (response.error === false) {
        msgDel.html(response.msg).addClass("green");
      } else {
        msgDel.html(response.msg).addClass("red");
      }

      setTimeout(function () {
        window.location.reload();
      }, 800);
    }
  );
});
