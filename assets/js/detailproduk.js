function save_beli(kode){
	var size=$("#size").val();
	var warna=$("#temp_warna").val();

	  if (warna==''){
		$(".validasi_notif").show();
	  } else if (size==''){
	  	$(".validasi_notif").show();
	  } else {
	  	var data=$("#fbeli").serialize();       
	    $.post("beli.php",data,function(response){ 
			 	var msg=response.split("-");
					if (msg[0].trim()=='berhasil'){
						$("#tot_cart").text(msg[1]);
						$("#cart_thumb").load('cart_thumb.php');
						location.href="cart";
					} else {
						alert('stok habis atau sedang dipesan yang lain'); 
					}	
	    });  
    }
	}
	

	function pilihwarna(kode,kode_jenis,outlet){
		// alert(kode);
		// cek apakah sebelumnya sudah memilih warna
		var warnaTerpilih=$("#temp_warna").val();
		//jika warna terpilih tidak sama dengan yg sebelumnya dipilih
		if (warnaTerpilih!=kode){
			$(".list-warna").css("color","rgba(0,0,0,.8)");
			$(".list-warna").css("border-color","rgba(0,0,0,.09)");
			$(".list-warna").css("background-color","#ffffff");
			// $("#"+kode).css("color","#a9db67");
			$("#"+kode).css("color","#ffffff");
			$("#"+kode).css("background-color","#a9db67");
			$("#size_choise").show();
			$("#temp_warna").val(kode);
			$.ajax({
			   url:"proses_pilih_ukuran.php",
		       type:"POST",
		       cache:false,
		       dataType:'text',
		       data:{w:kode,o:outlet, k:kode_jenis },
		       success: function(data){
			      // alert(data);
			      $("#tampil_ukuran").html(data); 
						$("#size_choise").hide();  
			 }// end success 
		  }); // end ajax
	    } else {
	    	$("#"+kode).css("color","rgba(0,0,0,.8)");
			$("#"+kode).css("border-color","rgba(0,0,0,.09)");
			$("#temp_warna").val('');
			$("#size_choise").hide();
	    }
		// color: #a9db67;
	    // border-color: #a9db67;
		// x.style.color = "#FFFFFF";
		// x.style.background = "#a9db67";
	}

	function pilihsize(kode,kodebarang,outlet){
		// alert(kode+'-'+kodejenis+'-'+warna);
		console.log(kode);
		// var pilih = $("#"+kode).text();
		var sizeTerpilih=$("#size").val();
		// alert(sizeTerpilih);
		if (sizeTerpilih!=kode){
			$(".list-size").css("color","rgba(0,0,0,.8)");
			$(".list-size").css("border-color","rgba(0,0,0,.09)");
			$(".list-size").css("background-color","#ffffff");
			// $("#"+kode).css("color","#a9db67");
			// $("#"+kode).css("border-color","#a9db67");
			$("#"+kode).css("color","#ffffff");
			$("#"+kode).css("background-color","#a9db67");
			$("#size").val(kode);
			$.ajax({
			   url:"proses_tampil_harga.php",
		       type:"POST",
		       cache:false,
		       dataType:'text',
		       data:{kb:kodebarang, o:outlet },
		       success: function(data){
			      //alert(data);
			      $("#show_price").html("Rp. "+format('#,##0.##',data));
			      $("#harga1").val(data);
						$("#price_default").hide();
			      // $("#tampil_ukuran").html(data);   
					 }// end success 
		    }); // end ajax
		} else {
			$("#"+kode).css("color","rgba(0,0,0,.8)");
			$("#"+kode).css("border-color","rgba(0,0,0,.09)");
			$("#size").val('');
		}	
	}
	function masukanKeranjang(kode_jenis,outlet,sess_id){
		var warna = $('input[name="warna"]:checked').val();
		var size = $('input[name="size"]:checked').val();
		var qty = $("#qty").val();
		// alert (qty);
		if(warna && size){
			$.ajax({
				url:"beli.php",
					type:"POST",
					cache:false,
					dataType:'text',
					data:{kode_jenis, outlet, warna, size, qty, sess_id},
					success: function(response){
						if (response.trim()=='berhasil'){
							document.location="cart.php";
						} else {
							alert(response);
						}
					
					}// end success 
		 	});
		}else{
			$('#error').modal('show');
		}
	}

	function beliSekarang() {
		var warna = $('input[name="warna"]:checked').val();
		var warna1 = $('input[name="warna"]:checked').parent().text();
		var size = $('input[name="size"]:checked').val();
		var qty = $("#qty").val();
		var harga = $("#harga1").val();
		var total = Number(qty)*Number(harga);
		if(warna && size){
			$("#warna_terpilih").html(warna1);
			$("#size_terpilih").html(size);
			$("#qty_terpilih").html(qty);
			$("#total_harga").html("Rp. "+format('#,##0.##',total));
			$("#color_selected").val(warna);
			$("#size_selected").val(size);
			$("#qty_selected").val(qty);
			$("#total_selected").val(total);
			$("#harga").val(harga);
			$('#cekout').modal('show');
		}else{
			// $('#notif').modal('show');
			$('#error').modal('show');
		}
	}

$(document).ready(function(){
	// proses pembelian
	$("#formPesanLangsung").on("submit", function(e) {
		e.preventDefault();
		// $("#lanjut_pembelian").prop('disabled',true);
		// return true;
		$("#lanjut_pembelian").val('Please wait ...')
      .attr('disabled','disabled');
		$.ajax({
				url: 'checkoutP.php?action=cekoutLangsung',
				type: 'post',
				data: $(this).serialize(),
				success: function(response) {
					if (response.trim()=='berhasil'){
						$('#cekout').modal('hide');
						$('#notif').modal('show');
					} else {
						alert(response);
					}	
						
				}
		});
	});

	$('#back_to_menu').click(function(){
		// document.location="index.php";
		location.reload();
	});

});

	
	
