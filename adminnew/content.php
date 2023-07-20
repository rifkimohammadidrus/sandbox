<?php
include("connect.php");
switch($_GET['menu']){
	case'modul_user':include("page/user.php");break;
	case'modul_kategori':include("page/kategori.php");break;
	case'login':include("login.php");break;
	case'modul_katalog':include("page/katalog.php");break;
	case'modul_outlet':include("page/outlet.php");break;
	case'outlet_kurir':include("page/outlet_kurir.php");break;
	case'produk':include("page/produk.php");break;
	case'masterproduk':include("page/masterproduk.php");break;
	case'masterproduk_entry':include("page/masterproduk_entry.php");break;
	case'size':include("page/size.php");break;
	case'warna':include("page/warna.php");break;
	case'slide':include("page/slide_home.php");break;
	case'kurir':include("page/masterkurir.php");break;
	case'kurir_detail':include("page/masterkurir_detail.php");break;
	// Tambahan by ione 2020-05-16 marketplace bani batuta

	// order for outlet
	case'modul_order':include("page/order.php");break;
	case'modul_order_confirm':include("page/order.php");break; 
    case'modul_order_approve':include("page/order.php");break;
    case'modul_order_detail':include("page/order_detail.php");break;
    case'modul_detailbayar':include("page/detailbayar.php");break;


    // order for pusat
    case'modul_order_pusat':include("page/order_pusat.php");break;
	case'modul_order_confirm_pusat':include("page/order_pusat.php");break; 
    case'modul_order_approve_pusat':include("page/order_pusat.php");break;
    case'modul_order_detail_pusat':include("page/order_detail_pusat.php");break;
  
	case'tracking':include("page/tracking.php");break;
	case'crm_customer':include("page/crm_order.php");break;
	case'crm_customer_detail':include("page/crm_order_detail.php");break;
	case'crm_area':include("page/crm_order_area.php");break;
	case'crm_area_detail':include("page/crm_order_area_detail.php");break;
	case'crm_barang':include("page/crm_barang.php");break;
	case'crm_email':include("page/crm_kirim_email.php");break;
	case'laporantransaksi':include("page/laporantransaksi.php");break;
	case'laporantransaksidetail':include("page/laporantransaksidetail.php");break;

	case'disc':include("page/discount.php");break;
	case'disc_tambah':include("page/discount_tambah.php");break;
	case'disc_edit':include("page/discount_edit.php");break;
	case'disc_perproduk':include("page/discount_perproduk.php");break;
	case'disc_import':include("page/diskon_import_produk.php");break;

	case'sc':include("page/size_chart.php");break;
	case'scp':include("page/size_chart_proses.php");break;
	case'scpe':include("page/size_chart_proses_excel.php");break;

	case'member':include("page/modul_member.php");break;
	case'import_master':include("page/import_master.php");break;

	case'chatting':include("monitoring_chat_admin.php");break;
	
	default:include("home.php");break;
}
?>