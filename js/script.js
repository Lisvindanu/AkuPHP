function previewImage() {
  const gambar = document.querySelector(".gambar");
  const imgPreview = document.querySelector(".img-preview");

  const oFReader = new FileReader();
  oFReader.readAsDataURL(gambar.files[0]);

  oFReader.onload = function (oFREvent) {
    imgPreview.src = oFREvent.target.result;
  };
}

$(document).ready(function () {
  const tombolCari = $(".tombol-cari");
  const keyword = $(".keyword");
  const container = $(".admin-container");

  tombolCari.hide();

  //livesearch admin
  keyword.keyup(function () {
    var keywords = keyword.val().split(" "); // Mengelompokkan kata kunci menjadi array
    $.ajax({
      url: "../ajax/ajax_cari.php",
      data: {
        keywords: keywords, // Menggunakan array kata kunci
      },
      type: "get",
      success: function (response) {
        container.html(response);
      },
    });
  });
});

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
    } else {
      // Jika tidak ada keyword, tampilkan tampilan awal card
      $.ajax({
        url: "../ajax/ajax_awal_user.php", // Ganti dengan URL untuk tampilan awal card
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
