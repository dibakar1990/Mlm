$(function () {
    var per_page = $(document).find('.perRowPage').val();
    var first = [per_page, 25, 50, 100, -1];
    var second = [per_page, 25, 50, 100, "All"];
    var lengthMenu = [first,second];
    $('#dataTable').DataTable({
      "paging": true,
      //"pageLength": per_page,
      //"lengthMenu": lengthMenu,
    //"lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "order": [],
      //"bFilter": false,
      //"bInfo": false,
      "processing": true,
    });

  });