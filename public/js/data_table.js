$(function () {
  $(document).ready(function () {
    $("#data1").DataTable({
      "columnDefs": [
        { "orderable": false, "targets": 0 }
      ],
      "bSort" : false,
      "ordering": false

     
    });
    $("#data2").DataTable({
      "columnDefs": [
        { "orderable": false, "targets": 0 }
      ],
      "bSort" : false,
      "ordering": false

    });
    $("#data3").DataTable({
      "columnDefs": [
        { "orderable": false, "targets": 0 }
      ],
      "bSort" : false,
      "ordering": false

    });
    $("#data4").DataTable({
      "columnDefs": [
        { "orderable": false, "targets": 0 }
      ],
      "bSort" : false,
      "ordering": false

    });
    $("#data5").DataTable({
      "columnDefs": [
        { "orderable": false, "targets": 0 }
      ],
      "bSort" : false,
      "ordering": false

    });
    $("#data6").DataTable({
      "columnDefs": [
        { "orderable": false, "targets": 0 }
      ],
      "bSort" : false,
      "ordering": false

    });
  });

    $('#data-notab').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "info": true,
      "autoWidth": false,
    });
  });