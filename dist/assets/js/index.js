// -------btn burger-------

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

// ------modale connexion--------

const modalCont = document.querySelector(".connexion-modal-container");
const closeModalBtn = document.querySelector(".close-modal");
const connexionBtn = document.getElementById("btn-con");

function showModal() {
  modalCont.classList.remove("hidden");
}

function closeModal() {
  modalCont.classList.add("hidden");
}

if (connexionBtn !== null && connexionBtn !== "") {
  //ouvre modal connexion
  connexionBtn.addEventListener("click", showModal);
}

//Ferme le modal connexion : clic, touche Echap
closeModalBtn.addEventListener("click", closeModal);
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") closeModal();
});

// boutons oeil password
(function ($) {
  $(document).ready(function () {
    $(".pass_btn").on("click", function () {
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

$("#submit").click(function () {
  var login = $("#login").val();
  var password = $("#password").val();
  $.post(
    "ajax_php/connexion_post.php",
    {
      login: login,
      password: password,
    },
    function (response) {
      $(".resultCon").html(response);
      console.log(response);
      if (
        response === '<p class="msg_success">Merci, vous êtes connecté!</p>'
      ) {
        setTimeout(function () {
          window.location.reload();
        }, 800);
      }
    }
  );
});
