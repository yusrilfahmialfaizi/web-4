<!--   Core JS Files   -->
	<script src="<?php echo base_url('assets/js/core/jquery.3.2.1.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/core/popper.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/core/bootstrap.min.js')?>"></script>

	<!-- jQuery UI -->
	<script src="<?php echo base_url('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')?>"></script>

	<!-- jQuery Scrollbar -->
	<script src="<?php echo base_url('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')?>"></script>


	<!-- Chart JS -->
	<script src="<?php echo base_url('assets/js/plugin/chart.js/chart.min.js')?>"></script>

	<!-- jQuery Sparkline -->
	<script src="<?php echo base_url('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')?>"></script>

	<!-- Chart Circle -->
	<script src="<?php echo base_url('assets/js/plugin/chart-circle/circles.min.js')?>"></script>

	<!-- Datatables -->
	<script src="<?php echo base_url('assets/js/plugin/datatables/datatables.min.js')?>"></script>

	<!-- Bootstrap Notify -->
	<script src="<?php echo base_url('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')?>"></script>

	<!-- jQuery Vector Maps -->
	<script src="<?php echo base_url('assets/js/plugin/jqvmap/jquery.vmap.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/plugin/jqvmap/maps/jquery.vmap.world.js')?>"></script>

	<!-- Sweet Alert -->
	<script src="<?php echo base_url('assets/js/plugin/sweetalert/sweetalert.min.js')?>"></script>

	<script src="<?php echo base_url('assets/js/select2.js')?>"></script>

	<!-- Atlantis JS -->
	<script src="<?php echo base_url('assets/js/atlantis.min.js')?>"></script>
	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
					]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			// var data = $('#notification').val();
			// $("#notification").load(tampil());
			// $.getJSON("<?php echo base_url('user/agen/notifikasi/jumlah_notif') ?>",function(data){
			// 	$.each(data.result, function(){
			// 		window.alert(this['jumlah']);
			// 	})
			// })
			tampil();
		});
			function tampil(){

				// $.get("<?php echo base_url('user/agen/notifikasi/jumlah_notif') ?>", {}, function(response){
				// 	if (""+response+"" > 0 )
				// 	 {		
				// 		$("#notification").text(""+response+"");
				// 		// $("#notifikasion").append("<span class='notification' id='notification'>"+response+"</span>");
				// 		// $("#punya").prepend("<div class='dropdown-title' >You have "+response+" new notification</div>");
				// 		setTimeout("tampil()",1000);
				// 	}else{
				// 		$("#notification").remove();
				// 		setTimeout("tampil()",0);
				// 	}
				// },'json');
				$.ajax({
					url :"<?php echo base_url('user/agen/notifikasi/jumlah_notif') ?>",
					type : "GET",
					dataType : "JSON",
					success : function(response){
						if (""+response+"" > 0 ){		
							document.getElementById('notification').style.display="inline";
							$("#notification").text(""+response+"");
							setTimeout("tampil()",1000);
						}else if (""+response+"" < 1){
						// $("#notification").remove();
							document.getElementById('notification').style.display="none";
							setTimeout("tampil()",0);
						}
					}
				});
				$.ajax({
					url :"<?php echo base_url('user/agen/notifikasi/getnotif') ?>",
					type : "POST",
					// dataType : "JSON",
					success : function(data){
						// $.each(JSONparse(data), function(judul){
								console.log(data);
								$("#not").html(data);

						// // 	// for (var i = 0; i < data.length; i++) {
						// // 		// $("#judul").text(data.judul);
						// // 		// $("#isi").text(data.isi);
						// // 		// $("#url").text("base_url()"data.id_notifikasi"");
						// // 	// }
						// })
						// $("#notification").text(""+response+"");
						// setTimeout("tampil()",1000);
					}
				});
			}
	</script>

