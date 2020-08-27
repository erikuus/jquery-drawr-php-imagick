<?php

$image = new Imagick("img/image.jpg");

$imagedata = file_get_contents('img/layer.txt');
$layerBase64 = preg_replace('#^data:image/[^;]+;base64,#', '', $imagedata);
$layerBlob = base64_decode($layerBase64);
$layer = new Imagick();
$layer->readImageBlob($layerBlob);

// composite one image onto another
$image->setImageVirtualPixelMethod(Imagick::VIRTUALPIXELMETHOD_TRANSPARENT);
$image->setImageArtifact('compose:args', "1,0,-0.5,0.5");
$image->compositeImage($layer, Imagick::COMPOSITE_MATHEMATICS, 0, 0);

// give image a format
$image->setImageFormat('png');
//$image->writeImage("img/output.jpg");

// output the image with headers
header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Transfer-Encoding: binary');
header('Content-type: image/png');
echo $image->getImagesBlob();
