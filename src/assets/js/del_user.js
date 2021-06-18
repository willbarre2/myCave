// ------modale création user--------

const modaldelCont = document.querySelector(".modal-del-container");
const closeModaldelBtn = document.querySelector(".close-modal-del");
const delBtn = document.getElementById("btn-del");
const delBtnWhite = document.getElementById("btn-del-white");

function showModalDel() {
  modaldelCont.classList.remove("hidden");
}

function closeModalDel() {
  modaldelCont.classList.add("hidden");
}

//ouvre modal création
if (delBtn !== null && delBtn !== "") {
  delBtn.addEventListener("click", showModalDel);
}

if (delBtnWhite !== null && delBtnWhite !== "") {
  delBtnWhite.addEventListener("click", showModalDel);
}

//Ferme le modal créa : clic, touche Echap
closeModaldelBtn.addEventListener("click", closeModalDel);
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") closeModalDel();
});

// autocomplete du champ de saisie utilisateur

$("#autocomplete").on("input", function () {
  var inputValue = $(this).val();
  var contentResult = $(".result_ac"); // où je vais afficher les résultats
  if (inputValue.length > 1) {
    $.post(
      "ajax_php/search_user_post.php",
      {
        input: inputValue,
      },
      function (data) {
        contentResult.hide(); // à chaque appel j'efface la div
        // je le remets en array pour pouvoir l'analyser et le parcourir avec la boucle for
        // au cas où le retour du serveur en json n'est pas spécifié
        var array = JSON.parse(data);
        if (array.length > 0) {
          // je vérifie que j'ai bien des résultats
          contentResult.html('<div class="content_result_ac"></div>');
          var resultChoice = $(".content_result_ac");

          for (let user of array) {
            // boucle for...of pour parcourir un array
            contentResult.show();
            resultChoice.append(
              '<div data-id="' +
                user.id_user +
                '">' +
                user.identifiant +
                "</div>"
            );
          }
        } else {
          contentResult.show();
          contentResult.html("Pas de résultat");
        }
      }
    );
  }
});

//submit post

// $("#submitCrea").click(function () {
//   var login = $("#loginCrea").val();
//   var password = $("#passwordCrea").val();
//   var role = $("#role").val();
//   $.post(
//     "ajax_php/crea_post.php",
//     {
//       login: login,
//       password: password,
//       role: role,
//     },
//     function (response) {
//       if (response.error) {
//         msg.html(response.msg).addClass("red");
//         var field = response.field;
//         if (field === 1) {
//           $(".field").each(function () {
//             if ($(this).val() === "") {
//               $(this).addClass("border_red");
//             }
//           });
//         } else if (field === 2) {
//           $("#loginCrea").addClass("border_red");
//         } else if (field === 3) {
//           $("#passwordCrea").addClass("border_red");
//         } else if (field === 4) {
//           $("#role").addClass("border_red");
//         }
//       } else {
//         $("#resultCrea").html(response.msg).addClass("green");
//         setTimeout(function () {
//           window.location.reload();
//         }, 800);
//       }
//     },
//     "json"
//   );
// });
