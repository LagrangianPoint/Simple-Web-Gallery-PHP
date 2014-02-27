<?php

$arrImageFiles = array();

foreach (glob("*.*") as $strFileName) {
	if (preg_match("~\.(jpeg|jpg|png|gif)$~", $strFileName) ) {
		$arrImageFiles[] = $strFileName;
	}
}
$nTotal = count($arrImageFiles);


$strJsonFiles = json_encode($arrImageFiles);


if (isset($_GET['image'])) {
	$nCurImage = (integer) $_GET['image'];
} else {
	$nCurImage = 0;
}

$nPrev = max(0, $nCurImage - 1);
$nNext = min($nTotal - 1,  $nCurImage + 1);

?>


<<?php ?>?xml version="1.0" encoding="UTF-8"?<?php ?>>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Viewing Image: <?php echo $arrImageFiles[$nCurImage] ?></title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
    <script type="text/javascript">
		var arrFiles = <?php echo $strJsonFiles; ?>;
		var nCurImage = <?php echo $nCurImage; ?>;
		
		function redirectToImage(nImage) {
			window.location.href = "view-gallery.php?image=" + nImage
		}
		
		$(document).ready(function () {
			$("#prev").click(function (e) {
				var nImageId = $(this).val();
				redirectToImage(nImageId);
			});
			$("#next").click(function (e) {
				var nImageId = $(this).val();
				redirectToImage(nImageId);
			});
			$("#selectAllImages").change(function (e) {
				var nImageId = $(this).val();
				redirectToImage(nImageId);
			});
			
		});
	</script>
    
    <style type="text/css">
		#image-wrapper {
			margin-top:30px;
		}
		#nav {
			position:fixed;
			top:0px;
			font-size:20px;
		}
		
		
		
	</style>
    
  </head>
  <body>

	<div id="nav">
		<button id="prev" type="button" value="<?php echo $nPrev ?>" >Prev</button>
		<select id="selectAllImages">
			<?php foreach ($arrImageFiles as $i => $strImage): ?>
				<?php if ($i == $nCurImage): ?>
					<option value="<?php echo $i ?>" selected="selected"><?php echo $strImage ?></option>
				<?php else: ?>
					<option value="<?php echo $i ?>"><?php echo $strImage ?></option>
				<?php endif; ?>
			<?php endforeach; ?>
		</select>
		<button id="next" type="button" value="<?php echo $nNext ?>" >Next</button>
	</div>

	<div id="image-wrapper">
		<img src="<?php echo $arrImageFiles[$nCurImage] ?>" alt="<?php echo $arrImageFiles[$nCurImage] ?>" />
		
	</div>


  </body>
</html>

