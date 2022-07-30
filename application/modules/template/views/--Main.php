<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Latihan Template</title>
	<!--untuk memanggil css-->
	<span style="color: #ff0000;"><link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/style.css"></span>
</head>
<body>

<div id="header">
	<!-- $header diambil dari core-->
	<?php 
	echo $header; ?>
</div>

<div id="content">
	<!-- $isi diambil dari core-->
	<?php 
	echo $isi; ?>
</div>

<div id="footer">
	<!-- $footer diambil dari core-->
	<?php 
	echo $footer; ?>
</div>
</body>
</html>