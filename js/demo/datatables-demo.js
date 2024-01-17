// Call the dataTables jQuery plugin
$(document).ready(function() {
  console.log("Script datatables-demo.js loaded.");
  $('#dataTable').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [[10, 25, 100, 500, 1000], [10, 25, 100, 500, 1000, "All"]], // Define las opciones de cantidad de registros por página
  });
});
