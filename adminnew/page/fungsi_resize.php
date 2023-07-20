<?php 
function upload_resize_image($postvars){
ini_set("memory_limit","50M");
$max_dimension = 800; //  Max  width & height image, tidak boleh melebihi nilai ini..
$valid_exts = array("jpg","jpeg","gif","png"); // Array eksetensi file yang valid
$pecah = explode(".",strtolower($postvars["image_name"])); // Select the extension from the file.
for($i=0;$i<=count($pecah)-1;$i++)
     {$ext = $pecah[$i];}
if($postvars["image_size"] <= 5120000){ // Check tidak lebih besar dari 5MB .
   if(in_array($ext,$valid_exts)){ // Check is valid extension.
      if($ext == "jpg" || $ext == "jpeg") 
	  $image = imagecreatefromjpeg($postvars["image_tmp"]);
      else if($ext == "gif") $image = imagecreatefromgif($postvars["image_tmp"]);
      else if($ext == "png") $image = imagecreatefrompng($postvars["image_tmp"]);
      list($width,$height) = getimagesize($postvars["image_tmp"]); // Ambil lebar dan tinggi gambar.
      // If the max width input is greater than max height we base the new image off of that, otherwise we use the max height input.We get the other      dimension by multiplying the quotient of the new width or height divided by the old width or height.
      if($postvars["image_max_width"] > $postvars["image_max_height"])
      {
        if($postvars["image_max_width"] > $max_dimension) $newwidth = $max_dimension;
        else $newwidth = $postvars["image_max_width"];
        $newheight = ($newwidth / $width) * $height;
      } else {
      if($postvars["image_max_height"] > $max_dimension) $newheight = $max_dimension;
         else $newheight = $postvars["image_max_height"];
         $newwidth = ($newheight / $height) * $width;
      }
      $tmp = imagecreatetruecolor($newwidth,$newheight); // Create temporary image file.
      imagecopyresampled($tmp,$image,0,0,0,0,$newwidth,$newheight,$width,$height); // Copy the image to one with the new width and height.
      imagejpeg($tmp,$postvars["filename"],95); // Create image file with 95% quality.
      imagedestroy($image);
      imagedestroy($tmp);
      return "sukses";
   }  else 
   { return "Upload GAGAL: File terlalu besar. Besar maksimal file yang diijinkan 5MB.";}
} 
else 
{ return "Upload GAGAL: Tipe file yang diijinkan hanya file gambar (jpg, jpeg, gif, png).";}

}
?>