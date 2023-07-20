<?php
 
// tentukan lebar, tinggi, file yang mau diresize, format nama file, dan penempatan foto setelah di resize
 
function resizeImage($nw, $nh, $source, $stype, $dest) 
{
    $size = getimagesize($source); // ukuran gambar
    $w = $size[0];
    $h = $size[1];
    switch($stype) 
    { // format gambar
        case 'gif':
            $simg = imagecreatefromgif($source);
            break;
        case 'jpg':
            $simg = imagecreatefromjpeg($source);
            break;
        case 'png':
            $simg = imagecreatefrompng($source);
            break;
    }
    $dimg = imagecreatetruecolor($nw, $nh); // menciptakan image baru
    $wm = $w/$nw;
    $hm = $h/$nh;
    $h_height = $nh/2;
    $w_height = $nw/2;
    if($w> $h) 
    {
        $adjusted_width = $w / $hm;
        $half_width = $adjusted_width / 2;
        $int_width = $half_width - $w_height;
        imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
    }
    elseif(($w <$h) || ($w == $h)) 
    {
        $adjusted_height = $h / $wm;
        $half_height = $adjusted_height / 2;
        $int_height = $half_height - $h_height;
        imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);
    }
    else
    {
        imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
    }
    imagejpeg($dimg,$dest,100);
}
 
$gambar = "bg.jpg";
$gambar_resize = "fotocrop.jpg";
 
// jalankan fungsi resize gambar
// lebar, tinggi, file yang di resize, format gambar, nama file setelah di resize
//resizeImage(200, 150, "$gambar", 'jpg', "$gambar_resize");
//print "Image sebelum di resize : <img src=\"$gambar\"><br /><br />";
//print "Image setelah di resize : <img src=\"$gambar_resize\">";
?>
