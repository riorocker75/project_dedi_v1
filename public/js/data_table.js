$(function () {
    $("#data1").DataTable();
    $("#data2").DataTable();
    $("#data3").DataTable();
    $("#data4").DataTable();
    $("#data5").DataTable();
    $("#data6").DataTable();

    $('#data-notab').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });