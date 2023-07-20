function removeCommas(nilai){
	var hasil='';
	hasil=nilai.replace(/[^\d\.\-\ ]/g, '');  
	return hasil;	  
}
  
function removeDots(nilai){
  var hasil='';
  hasil =nilai.split(',').join("");
  return hasil;	  
}
function eksekusi(){		
	var kode=$("#vouchcode").val();
	var data=$("#fv").serialize(); 
	alert(kode);
	if (kode!=''){
					$.post("vervo.php",data,function(response){ 
					alert(response);
					if (response.trim()=='kosong'){
							$(".notif").hide();
						$("#notif_kosong").show();
							} else if (response.trim()=='expired'){
							$(".notif").hide();
								$("#notif_expired").show();
						} else if (response.trim()=='terpakai'){
							$(".notif").hide();
								$("#notif_terpakai").show();
						} else if (response.trim()=='kode_promo_berhasil'){
							alert("selamat,, anda mendapat potongan harga");
							location.reload(); 
						}
					});
	
	} else {
		$(".notif").hide();
			$("#notif_null").show();	
	}
}



function hitungTotal(){
	var total=0;
	var nilai=0;
	try{
		$.each($(".checkItem:checked"), function(){  
					total+=Number(removeDots($('#'+this.id).val()));
		});
		console.log(total);
		$('#total').text('Rp. '+ format('#,##0.##',total));

	}catch(e){
		
	}
}


function del(sku,store){
	console.log('del '+ sku +' '+ store);
	try{
		$.ajax({
			url:"cartP.php",
			type:"POST",
			cache: false,
			dataType:'json',
			data:{j:'delP',sku:sku,io:store},
			success: function(data) {	
			   var sisa=$('#ss_'+sku+'_'+store).text();
			   sisa++;	
				try{				
					console.log('total : '+ data.qty);
					$('#q_'+sku+'_'+store).val(data.qty);
					$('#ss_'+sku+'_'+store).text(sisa);
					$('#am_'+sku+'_'+store).val(format('#,##0.#',data.amount));
					$('#cek_'+sku+'_'+store).attr('data-id',format('#,##0.#',data.amount));
					$('#dc_'+sku+'_'+store).text(data.disc+' %');
					hitungTotal();
					
				}catch(e){
					console.log(e.message);
				}				
			
			}				
		});
	}catch(ex){
		console.log(ex.message);
	}
	
}

function add(sku,store){
	console.log('add '+ sku +' '+ store);
	try{
		$.ajax({
			url:"cartP.php",
			type:"POST",
			cache: false,
			dataType:'json',
			data:{j:'addP',sku:sku,io:store},
			success: function(data) {	
			   var sisa=$('#ss_'+sku+'_'+store).text();
			   sisa--;
				try{						
					console.log('total : '+ data.qty);
					$('#q_'+sku+'_'+store).val(data.qty);
					$('#ss_'+sku+'_'+store).text(sisa);
					$('#am_'+sku+'_'+store).val(format('#,##0.#',data.amount));
					$('#cek_'+sku+'_'+store).attr('data-id',format('#,##0.#',data.amount));
					$('#dc_'+sku+'_'+store).text(data.disc+' %');
					console.log('diskon : '+ data.disc);
					
					hitungTotal();
					// location.reload();
					
				}catch(e){
					console.log(e.message);
				}				
			
			}				
		});
	}catch(ex){
		console.log(ex.message);
	}
}



function pesan() {
	$.ajax({
		url: 'checkoutP.php',
		type: 'post',
		data: $(this).serialize(),
		success: function (data) {
				alert(data);
		}
	});
}
function hapus_item(id){
	$.ajax({
		url:"konfirmasi_hapus.php",
		type:"POST",
		cache:false,
		dataType:'text',
		data:{i:'satu_item',id:id},
		success: function(response) {	
			if (response.trim()=='berhasil'){
				// $("#table-cart").load("table-cart.php");
				location.reload();
			} else {
				alert(response);
			}		 	
		}				
	});
}

$(document).ready(function(){
	$('.checkItem').change(function(){
		var total = 0;
		var id='';
		$.each($(".checkItem:checked"), function(){ 
			total+=Number(removeDots($(this).val()));
			id=id +"-"+ ($(this).data('id'));
		});
		$('#total').text('Rp. '+ format('#,##0.##',total));
		
		$("#d1").val(id);
		$("#btn-hapus-semua").val(id);
	});

	// Check or Uncheck All Item
	$("#checkAll").change(function(){
		var checked = $(this).is(':checked');
		if(checked){
				var total = 0;
				var id='';
			$(".checkItem").each(function(){
				$(this).prop("checked",true);
				total+=Number(removeDots($(this).val()));
				id=id +"-"+ ($(this).data('id'));
			});
				// $("#show_price").html(total);
				$('#total').text('Rp. '+ format('#,##0.##',total));
				$("#d1").val(id);
				$("#btn-hapus-semua").val(id);
		}else{
			$(".checkItem").each(function(){
				$(this).prop("checked",false);
			});
			$('#total').text('Rp. 0');
			$("#d1").val('');
			$("#btn-hapus-semua").val('');
		}
	});

 // Changing state of CheckAll checkItem 
	$(".checkItem").change(function(){
		if($(".checkItem").length == $(".checkItem:checked").length) {
			$("#checkAll").prop("checked", true);
		} else {
			$("#checkAll").prop("checked", false);
		}
	});

	// tombol cekout
	$('#d1').click(function(){
		var value = $(this).val();
		var outlet = $("#outlet").val();
		if(value){
			$.ajax({
				url:"cart_cekout.php",
				type:"POST",
				cache:false,
		    dataType:'text',
				data:{j:'cekout', dt:value, o:outlet},
				success: function(response) {	
					$('#barang_cekout').html(response);			
				}				
			});
			$('#cekout_keranjang').modal('show');
		}
	});

	// proses pembelian keranjang
	$("#formAdd").on("submit", function(e) {
		e.preventDefault();
		$("#lanjut_pembelian").val('Please wait ...')
      .attr('disabled','disabled');
		$.ajax({
				url: 'checkoutP.php?action=cekoutKeranjang',
				type: 'post',
				data: $(this).serialize(),
				success: function(response) {
					if (response.trim()=='berhasil'){
						$('#cekout_keranjang').modal('hide');
						$('#notif').modal('show');
						
					} else {
						alert(response);
					}	
						
				}
		});
	});
	$('#back_to_menu').click(function(){
		// document.location="toko-NILAWATI-z75tdEv4O-KDFbxBPTE0";
		var outlet_id = $('#outlet_id').val();
		var outlet_name = $('#outlet_name').val();
		document.location="toko-"+outlet_name+"-"+outlet_id;
		// location.reload();
	});
	//hapus all item
	$('#btn-hapus-semua').click(function(){
		var value = $(this).val();
		if(value){
			$.ajax({
				url:"konfirmasi_hapus.php",
				type:"POST",
				cache:false,
		    dataType:'text',
				data:{i:'all_item', id:value},
				success: function(response) {	
					location.reload();
					// if (response.trim()=='berhasil'){
					// 	document.location="cart.php";
					// } else {
					// 	alert(response);
					// }		 				
				}				
			});
		}
	});

});
