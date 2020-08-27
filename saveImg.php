<?php

if (isset($_POST['imagedata']) && $_POST['imagedata']) {
	$layerBase64 = preg_replace('#^data:image/[^;]+;base64,#', '', $_POST['imagedata']);
	$layerBlob = base64_decode($layerBase64);
	if (file_put_contents('img/layer.png', $layerBlob)) {
		echo 'Saved image data!';
	} else {
		echo 'Saving image data failed!';
	}
} else {
	echo 'Could not find image data!';
}