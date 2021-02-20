id: 18
source: 2
name: toWebp
category: Layout
properties: 'a:0:{}'
static_file: /snippets/layout/towebp.snippet.php

-----

# vars
$file = $modx->getOption("input", $scriptProperties);
$quality = $modx->getOption("options", $scriptProperties, 75);
$savePath = str_replace(".jpg", ".webp", $file);

if (!file_exists(MODX_BASE_PATH . $savePath)) {
    # open JPG
    $image = imagecreatefromstring(file_get_contents(MODX_BASE_PATH . $file));
    ob_start();
    imagejpeg($image, null, $quality);
    $cont = ob_get_contents();
    ob_end_clean();
    imagedestroy($image);
    $content = imagecreatefromstring($cont);

    # convert to WebP
    imagewebp($content, MODX_BASE_PATH . $savePath, $quality);
    imagedestroy($content);
}

return $savePath;