// ------modale modif bouteille--------
if (".btn-up" !== null && ".btn-up" !== "") {
  $(".btn-up").on("click", function () {
    var yearID = $(this).data("id");
    $.post(
      "ajax_php/display_up_bottle_post.php",
      {
        yearID: yearID,
      },
      function (data) {
        window.scrollTo(0, 0);
        $(".modal-up-bottle-container").removeClass("hidden");

        $("#name-up").val(data.nom);
        $("#year-up>option[value='" + data.annee + "']").prop("selected", true);
        $("#grapes-up").val(data.cepage);
        $("#country-up").val(data.pays);
        $("#region-up").val(data.region);
        $("#description-up").val(data.descri);

        if (data.type === "rouge") {
          data.type = 1;
        } else if (data.type === "blanc") {
          data.type = 2;
        } else if (data.type === "rosé") {
          data.type = 3;
        }
        $("#type-up>option[value='" + data.type + "']").prop("selected", true);

        $("#container-photo").html(
          '<img src="./assets/img/photos/' +
            data.photo +
            '" alt="photo d\'une bouteille de: ' +
            data.nom +
            '" class="content-photo">'
        );
        $("#stock-up").val(data.stock);
        $("#current_picture").val(data.photo);
        $("#current_id").val(data.id_year);
        $("#current_id_bottle").val(data.id_estate);
      },
      "json"
    );
  });
}

//Ferme le modal créa : clic, touche Echap
$(".close-modal-up").on("click", function () {
  $(".modal-up-bottle-container").addClass("hidden");
});
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") {
    $(".modal-up-bottle-container").addClass("hidden");
  }
});

// envoi des données ds DB

$("#form-up-bottle").submit(function (e) {
  e.preventDefault();
  var form = $(this);
  var url = form.attr("action");
  var method = form.attr("method");
  var formdata = new FormData(form[0]);
  var data = formdata !== null ? formdata : form.serialize();
  var msg = $("#resultUp");
  msg.removeClass("red green");
  msg.empty();
  $(".field").on("input", function () {
    $(this).removeClass("border_red");
  });
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
        var field = data.field;
        if (field === 1) {
          $("#name").addClass("border_red");
        } else if (field === 2) {
          $("#photo").addClass("border_red");
        }
      } else {
        msg.html(data.msg).addClass("green");
        setTimeout(function () {
          window.location.reload();
        }, 800);
      }
    },
  });
});
