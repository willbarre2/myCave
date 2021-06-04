// ------modale création user--------

const modalCreaCont = document.querySelector(".connexion-modal-crea-container");
const closeModalCreaBtn = document.querySelector(".close-modal-crea");
const creaBtn = document.getElementById("btn-crea");
const creaBtnWhite = document.getElementById("btn-crea-white");

function showModalCrea() {
  modalCreaCont.classList.remove("hidden");
}

function closeModalCrea() {
  modalCreaCont.classList.add("hidden");
}

//ouvre modal création
if (creaBtn !== null && creaBtn !== "") {
  creaBtn.addEventListener("click", showModalCrea);
}

if (creaBtnWhite !== null && creaBtnWhite !== "") {
  creaBtnWhite.addEventListener("click", showModalCrea);
}

//Ferme le modal créa : clic, touche Echap
closeModalCreaBtn.addEventListener("click", closeModalCrea);
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") closeModalCrea();
});

// boutons oeil password
(function ($) {
  $(document).ready(function () {
    $(".pass_btn_crea").on("click", function () {
      var input = $(this).parent().children("input");
      var type = input.attr("type");
      if (type === "password") {
        input.attr("type", "text");
        $(this).hide();
        $(this).next().show();
      } else {
        input.attr("type", "password");
        $(this).hide();
        $(this).prev().show();
      }
    });
  });
})(jQuery);

//submit post

$("#submitCrea").click(function () {
  var login = $("#loginCrea").val();
  var password = $("#passwordCrea").val();
  var role = $("#role").val();
  $.post(
    "ajax_php/crea_post.php",
    {
      login: login,
      password: password,
      role: role,
    },
    function (response) {
      console.log(response);
      if (response.error) {
        msg.html(response.msg).addClass("red");
        var field = response.field;
        if (field === 1) {
          $(".field").each(function () {
            if ($(this).val() === "") {
              $(this).addClass("border_red");
            }
          });
        } else if (field === 2) {
          $("#loginCrea").addClass("border_red");
        } else if (field === 3) {
          $("#passwordCrea").addClass("border_red");
        } else if (field === 4) {
          $("#role").addClass("border_red");
        }
      } else {
        console.log("coucou");
        $("#resultCrea").html(response.msg).addClass("green");
        setTimeout(function () {
          window.location.reload();
        }, 800);
      }
    },
    "json"
  );
});
