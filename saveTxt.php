<?php

if (isset($_POST['imagedata']) && $_POST['imagedata']) {
	if (file_put_contents('img/layer.txt', $_POST['imagedata'])) {
		echo 'Saved image data!';
	} else {
		echo 'Saving image data failed!';
	}
} else {
	echo 'Could not find image data!';
}
