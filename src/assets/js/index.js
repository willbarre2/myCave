$(document).ready(function () {
  $("#btn-burger").click(function () {
    $("header").toggleClass("isOpen");
  });

  $("#btn-burger").click(function (e) {
    e.preventDefault();
    $this = $(this);
    if ($this.hasClass("is-opened")) {
      $this.addClass("is-closed").removeClass("is-opened");
    } else {
      $this.removeClass("is-closed").addClass("is-opened");
    }
  });
});
