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

const modal = document.querySelector(".connexion-modal-container");
const closeModalBtn = document.querySelector(".close-modal");
const connexionBtn = document.getElementById("btn-con");

function showModal() {
  modal.classList.remove("hidden");
}

function closeModal() {
  modal.classList.add("hidden");
}

//ouvre modal connexion
connexionBtn.addEventListener("click", showModal);

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
