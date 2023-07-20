<?php
$data_global['isBlockMultiAccess']='1'; //block konsumen jika ingin belanja lebih dari 1 gudang dalam 1 transaksi

//inject cookie ke session



#echo "global :  $_SESSION[email]";

if(empty($_SESSION['email'])){

	if(!empty($_COOKIE['usbn'])){

		$_SESSION['email']=$_COOKIE['usbn'];

		$_SESSION['namamember']=$_COOKIE['unmm'];

		$_SESSION['kode_beli']=$_COOKIE['usbn'];

	}

}



 //1 untuk mengaktifkan tombol beli, 0 untuk menonaktifkan tombol beli

 $data_global['status_beli']=1;



 //1 untuk mengaktifkan fitur chat, 0 untuk menonaktifkan fitur chat

 $data_global['status_chatt']=1;

?>