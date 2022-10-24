(function ($) {
	//    "use strict";


	/*  Data Table
	-------------*/

	// $('#bootstrap-data-table').DataTable();


	$('#bootstrap-data-table').DataTable({
		lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
	});



	$('#bootstrap-data-table-export').DataTable({
		dom: 'lBfrtip',
		lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		]
	});

	$('#row-select').DataTable({
		language: {
			"lengthMenu": "Hiển thị _MENU_ kết quả mỗi trang",
            "zeroRecords": "Không tìm thấy kết quả",
            "info": "Hiển thị trang _PAGE_ của _PAGES_",
            "infoEmpty": "Không tìm thấy kết quả",
            "infoFiltered": "(Được lọc từ _MAX_ total số bản ghi)",
			"sSearch": '<i class="fa fa-search"></i>',
			paginate: {
				next: 'Trang sau',
				previous: 'Trang trước'
			}
		},
		initComplete: function () {
			this.api().columns().every(function () {
				var column = this;
				var select = $('<select class="form-control"><option value=""></option></select>')
					.appendTo($(column.footer()).empty())
					.on('change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
						);

						column
							.search(val ? '^' + val + '$' : '', true, false)
							.draw();
					});

				column.data().unique().sort().each(function (d, j) {
					select.append('<option value="' + d + '">' + d + '</option>')
				});
			});
		}
	});






})(jQuery);