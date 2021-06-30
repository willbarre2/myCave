// ------modale effacement bouteille--------
$(".btn-del").on("click", function () {
  window.scrollTo(0, 0);
  $(".modal-del-bottle-container").removeClass("hidden");
  var yearID = $(this).data("idy");
  $("#current_year_del_id").val(yearID);
  var bottleID = $(this).data("idb");
  $("#current_bottle_del_id").val(bottleID);
});

//Ferme le modal créa : clic, touche Echap
$(".close-modal-del-bottle").on("click", function () {
  $(".modal-del-bottle-container").addClass("hidden");
});
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") {
    $(".modal-del-bottle-container").addClass("hidden");
  }
});

// effacement bouteille

$("#submitDelBottle").on("click", function () {
  var yearId = $("#current_year_del_id").val();
  var bottleId = $("#current_bottle_del_id").val();
  var msgDel = $("#resultDelBottle");
  $.post(
    "ajax_php/del_bottle_post.php",
    {
      yearId: yearId,
      bottleId: bottleId,
    },
    function (response) {
      if (response.error === false) {
        msgDel.html(response.msg).addClass("green");
      } else {
        msgDel.html(response.msg).addClass("red");
      }

      setTimeout(function () {
        window.location.reload();
      }, 800);
    }
  );
});

// effacement année

$("#submitDelYear").on("click", function () {
  var yearId = $("#current_year_del_id").val();
  var bottleId = $("#current_bottle_del_id").val();
  var msgDel = $("#resultDelBottle");
  $.post(
    "ajax_php/del_year_post.php",
    {
      yearId: yearId,
      bottleId: bottleId,
    },
    function (response) {
      if (response.error === false) {
        msgDel.html(response.msg).addClass("green");
      } else {
        msgDel.html(response.msg).addClass("red");
      }

      setTimeout(function () {
        window.location.reload();
      }, 800);
    }
  );
});
