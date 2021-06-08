// ------modale ajout bouteille--------

const modalAddCont = document.querySelector(".modal-add-bottle-container");
const closeModalAddBtn = document.querySelector(".close-modal-add");
const addBtn = document.getElementById("icon-bottle-bx");
const addBtnWhite = document.getElementById("icon-bottle-white");

function showModalCrea() {
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
