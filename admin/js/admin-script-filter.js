jQuery(document).ready(function () {
  jQuery("#myTable").DataTable({
    columnDefs: [
      { orderable: false, targets: -1 }, // Wyłącza sortowanie dla ostatniej kolumny
    ],
    paging: false,
    searching: false,
    info: false,
    lengthChange: false,
  });
});
