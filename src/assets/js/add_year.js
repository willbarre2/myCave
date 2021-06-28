// ------modale modif bouteille--------
if (".btn-add-year" !== null && ".btn-add-year" !== "") {
  $(".btn-add-year").on("click", function () {
    window.scrollTo(0, 0);
    $(".modal-add-year-container").removeClass("hidden");
    var bottleID = $(this).data("id");
    $("#current_id_bottle").val(bottleID);
  });
}

//Ferme le modal créa : clic, touche Echap
$(".close-modal-add-year").on("click", function () {
  $(".modal-add-year-container").addClass("hidden");
});
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") {
    $(".modal-add-year-container").addClass("hidden");
  }
});

// envoi des données ds DB

$("#form-add-year").submit(function (e) {
  e.preventDefault();
  var form = $(this);
  var url = form.attr("action");
  var method = form.attr("method");
  var formdata = new FormData(form[0]);
  var data = formdata !== null ? formdata : form.serialize();
  var msg = $("#resultAddYear");
  var btnSubmit = $(this).children("button");
  btnSubmit.prop("disabled", true);
  $.ajax({
    url: url,
    data: data,
    method: method,
    dataType: "JSON",
    contentType: false,
    processData: false,
    status: 200,
    success: function (data) {
      if (data.error) {
        msg.html(data.msg).addClass("red");
        btnSubmit.prop("disabled", false);
      } else {
        msg.html(data.msg).addClass("green");
        setTimeout(function () {
          window.location.reload();
        }, 800);
      }
    },
  });
});
