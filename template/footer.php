</div>

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" />
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
	$(document).ready(function(){
			$("#no_hp").autocomplete({
					source:"autocomplete.php",
					minLength:2,
					select:function(event,data){
							$('input[name=nama]').val(data.item.nama);
							$('input[name=alamat]').val(data.item.alamat);
					}
			});
	});

	var hitung=0;
	$(document).ready(function(){
		$("#alamat").hide();
		$("#kirim_pesanan").click(function(){
			$("#alamat").show();
		});
		$("#cod").click(function(){
			$("#alamat").hide();
		});
		
		// $("#cari_produk").on("submit", function(e) {
		// e.preventDefault();
		// 	$.ajax({
		// 			url: 'cari_produk.php',
		// 			type: 'post',
		// 			data: $(this).serialize(),
		// 			success: function(response) {
		// 				if (response.trim()=='berhasil'){
		// 					$('#cekout_keranjang').modal('hide');
		// 					$('#notif').modal('show');
		// 				} else {
		// 					alert(response);
		// 				}	
							
		// 			}
		// 	});
		// });

	});

</script>
</body>
</html>