<?php 
// function encrypt($s) {
// 	$cryptKey    ='d';
// 	$qEncoded    =rtrim(strtr(base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $s, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) )), '+/', '-_'), '=');
// 	return($qEncoded);
// }
// function decrypt($s) {
// 	$cryptKey    ='d';
// 	$namaoutlet     = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode(str_pad(strtr( $s, '-_', '+/'), strlen( $s) % 4, '=', STR_PAD_RIGHT) ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
// 	return($namaoutlet);
// }
// function encrypt($s) {
// 	$encoded    =rtrim(strtr(base64_encode( $s), '+/', '-_'), '=');
// 	return($encoded);
// }
// function decrypt($s) {
// 	$namaoutlet     = rtrim(base64_decode(str_pad(strtr( $s, '-_', '+/'), strlen( $s) % 4, '=', STR_PAD_RIGHT)  ), "\0");
// 	return($namaoutlet);
// }

function encrypt($s)
{
	$ciphering = "AES-128-CTR";
	$iv_length = openssl_cipher_iv_length($ciphering);
	$options = 0;
	$encryption_iv = '1234567891011121';
	$encryption_key = "abcdefghijklmnopqrstuvwxyz";
	
	$encryption = openssl_encrypt($s, $ciphering,$encryption_key, $options, $encryption_iv);
	$o=strtr( $encryption, "+", "-" );
	return $o;
}
function decrypt($s)
{
	$o=strtr( $s, "-", "+" );
	$ciphering = "AES-128-CTR";
	$iv_length = openssl_cipher_iv_length($ciphering);
	$options = 0;
	$decryption_iv = '1234567891011121';
	$decryption_key = "abcdefghijklmnopqrstuvwxyz";
	
	$decryption=openssl_decrypt ($o, $ciphering, $decryption_key, $options, $decryption_iv);
	return $decryption;
}

