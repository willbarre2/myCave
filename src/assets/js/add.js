// ------modale ajout bouteille--------

const modalAddCont = document.querySelector(".modal-add-bottle-container");
const closeModalAddBtn = document.querySelector(".close-modal-add");
const addBtn = document.getElementById("icon-bottle-bx");
const addBtnWhite = document.getElementById("icon-bottle-white");

function showModalCrea() {
  window.scrollTo(0, 0);
  modalAddCont.classList.remove("hidden");
}

function closeModalCrea() {
  modalAddCont.classList.add("hidden");
}

//ouvre modal création
if (addBtn !== null && addBtn !== "") {
  addBtn.addEventListener("click", showModalCrea);
}

if (addBtnWhite !== null && addBtnWhite !== "") {
  addBtnWhite.addEventListener("click", showModalCrea);
}

//Ferme le modal créa : clic, touche Echap
closeModalAddBtn.addEventListener("click", closeModalCrea);
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") closeModalCrea();
});

// envoi des données ds DB

$("#form-add-bottle").submit(function (e) {
  e.preventDefault();
  var form = $(this);
  var url = form.attr("action");
  var method = form.attr("method");
  var formdata = new FormData(form[0]);
  var data = formdata !== null ? formdata : form.serialize();
  var msg = $("#resultAdd");
  msg.removeClass("red green");
  msg.empty();
  $(".field").on("input", function () {
    $(this).removeClass("border_red");
  });
  $(".field-re").on("input", function () {
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
