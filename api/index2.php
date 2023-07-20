<?php
require_once "koneksi.php";
class Produk {
 
   public function get_produk($customer=0)
   {
      global $mysqli;
      $query="SELECT
          `b`.`customer`
          , `bd`.`barcode`
          , `bd`.`qty`
          , `bd`.`harga`
      FROM
          `beli` AS `b`
          INNER JOIN `beli_detail` AS `bd` 
              ON (`b`.`kode` = `bd`.`kode`)";
  
      if($customer != 0)
      {
         $query.=" WHERE b.customer='$customer'";
      }
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
            'status' => 1,
            'message' =>'Get Produk Successfully.',
            'data' => $data
        );
      header('Content-Type: application/json');
      echo json_encode($response);
        
   }
 
}
 
 ?>