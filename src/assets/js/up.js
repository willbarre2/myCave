// ------modale modif bouteille--------
if (".btn-up" !== null && ".btn-up" !== "") {
  $(".btn-up").on("click", function () {
    var bottleID = $(this).data("id");
    $.post(
      "ajax_php/display_up_bottle_post.php",
      {
        bottleID: bottleID,
      },
      function (data) {
        window.scrollTo(0, 0);
        $(".modal-up-bottle-container").removeClass("hidden");
        console.log(data);

        $("#name-up").val(data.nom);
        $("#year-up>option[value='" + data.annee + "']").prop("selected", true);
        $("#grapes-up").val(data.cepage);
        $("#country-up").val(data.pays);
        $("#region-up").val(data.region);
        $("#description-up").val(data.descri);
        $("#photo-up").val(data.photo);

        if (data.type === "rouge") {
          data.type = "1";
        } else if (data.type === "blanc") {
          data.type = "2";
        } else if (data.type === "rose") {
          data.type = "3";
        }
        $("#type-up>option[value='" + data.type + "']").prop("selected", true);

        if (data.photo) {
          $(".container-photo").html(
            '<img src="../img/photos/' +
              data.photo +
              '" alt="photo d\'une bouteille de: ' +
              data.nom +
              '" class="content-photo">'
          );
        }
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
        var field = data.field;
        if (field === 1) {
          $("#name").each(function () {
            if ($(this).val() === "") {
              $(this).addClass("border_red");
            }
          });
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
