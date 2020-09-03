<?php

require_once __DIR__ . '/config.php';

$image = new Imagick($image['path']);
$layer = new Imagick('img/layer.png');

// composite one image onto another
$image->setImageVirtualPixelMethod(Imagick::VIRTUALPIXELMETHOD_TRANSPARENT);
$image->compositeImage($layer, Imagick::COMPOSITE_MATHEMATICS, 0, 0);

// give image a format
$image->setImageFormat('png');

// output the image with headers
header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Transfer-Encoding: binary');
header('Content-type: image/png');
echo $image->getImagesBlob();
