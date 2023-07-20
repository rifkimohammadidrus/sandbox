<?php 
include("connect.php");
$notrans=$_GET['no'];
$no_resi=$_GET['r'];


?>
<input type="text" id="inputresi_<?php echo $notrans;?>" placeholder="Input lalu enter" size="12" 
onkeydown="input_resi('<?php echo $notrans?>')" value="<?php echo $no_resi?>" >
