<?php
require_once "index2.php";
$produk = new Produk();
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
         if(!empty($_GET["customer"]))
         {
            $customer=intval($_GET["customer"]);
            $produk->get_produk($customer);
         }
         
            break;
   default:
      // Invalid Request Method
         header("HTTP/1.0 405 Method Not Allowed");
         break;
      break;
}
 
 
 
 
?>