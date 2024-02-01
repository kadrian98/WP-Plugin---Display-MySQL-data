jQuery(document).ready(function ($) {
  $(".btn").on("click", function () {
    var recordId = $(this).data("id");
    if (confirm("Czy na pewno chcesz usunąć ten rekord?")) {
      $.ajax({
        url: ajax_object.ajaxurl, // ajaxurl jest globalnie zdefiniowanym URL-em przez WordPress
        type: "POST",
        data: {
          action: "delete_record",
          id: recordId,
          nonce: ajax_object.nonce, // Przekazany przez wp_localize_script
        },
        success: function (response) {
          if (response.success) {
            // Usuń wiersz z tabeli lub odśwież stronę
            $("#row-" + recordId).remove();
          } else {
            alert("Błąd podczas usuwania rekordu.");
          }
        },
      });
    }
  });
});
