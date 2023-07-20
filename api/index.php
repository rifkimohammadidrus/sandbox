<?php
	// header("Content-Type:application/json");

	// $host = "156.67.212.223";
  // $user = "rabbanico_bani";
  // $pass = "matakhade2021";
  // $db   = "rabbanico_posnet";
  // $conn = mysqli_connect($host, $user, $pass, $db);

	$host = "localhost";
  $user = "root";
  $pass = "";
  $db   = "rabbanico_posnet";
  $conn = mysqli_connect($host, $user, $pass, $db);

	mysqli_set_charset($conn, 'utf8');
	$method = $_SERVER['REQUEST_METHOD'];
	$results = [];
	if (isset($_GET['customer'])) {
		$customer=$_GET['customer'];
	}else{
		$customer='';
	}
	if ($method == 'GET') {
    
		$sql ="SELECT
							`b`.`customer`
							, `bd`.`barcode`
							, `bd`.`qty`
							, `bd`.`harga`
					FROM
							`beli` AS `b`
							INNER JOIN `beli_detail` AS `bd` 
									ON (`b`.`kode` = `bd`.`kode`)";
		if($customer != '')
		{
			 $sql.=" WHERE b.customer='$customer'";
		}else{
			$sql.="LIMIT 100";
		}
    $query = mysqli_query($conn, $sql);
		// $i = 1;
		if (mysqli_num_rows($query) > 0) {
			while($row = mysqli_fetch_assoc($query)) {
				$results['Status']['success'] = true;
				$results['Status']['code'] = 200;
				$results['Status']['description'] = 'Request Valid';
				$results['Hasil'][] = [
					'customer' => $row['customer'],
					'barcode' => $row['barcode'],
					'qty' => $row['qty'],
					'harga' => $row['harga']
				];
				// $i = $i + 1;
			}
			//Menampilkan Data JSON dari Database

			// $data = ['Hasil' => $results];
			$json = json_encode($results);
			header("Content-type: application/json");
			print_r($json);
		}
		else{
			$results['Status']['code'] = 400;
			$results['Status']['description'] = 'Request Invalid';
		}
	}else{
		$results['Status']['code'] = 404;
	}

	
?>