$(document).ready(function () {
  var cardkatalog = $("#cardkatalog"); // Simpan elemen cardkatalog dalam variabel

  $("#search").keyup(function () {
    var keywords = $(this).val().split(" "); // Mengelompokkan kata kunci menjadi array

    if (keywords.length > 0) {
      $.ajax({
        url: "../ajax/ajax_cari_user.php",
        data: {
          keywords: keywords,
        },
        type: "GET",
        success: function (response) {
          cardkatalog.html(response);
        },
        error: function (error) {
          console.log(error);
        },
      });
    }
  });
});
