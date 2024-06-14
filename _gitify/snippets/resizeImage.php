id: 18
source: 2
name: resizeImage
category: 9
snippet: "# vars\n$lib = $modx->getOption(\"lib\", $scriptProperties, \"Imagick\");\n$libPath = $modx->getOption(\"libPath\", $scriptProperties, \"/Applications/MAMP/Library/bin/convert\");\n$mode = $modx->getOption(\"mode\", $scriptProperties, \"\");\n$type = $modx->getOption(\"type\", $scriptProperties, \"image\");\n$input = $modx->getOption(\"input\", $scriptProperties, \"\");\n$sizes = $modx->getOption(\"options\", $scriptProperties, \"\");\n$quality = $modx->getOption(\"quality\", $scriptProperties, 70);\n$fileExtension = $modx->getOption(\"fileExtension\", $scriptProperties, \"webp\");\n$setRatio = $modx->getOption(\"setRatio\", $scriptProperties, true);\n$cachePath = $modx->getOption(\"cachePath\", $scriptProperties, \"assets/image-cache/\");\n$cultureKey = $modx->getOption(\"cultureKey\");\n$basePath = $modx->getOption(\"base_path\");\n$filePath = preg_replace(\"/^\\/?\" . $cultureKey . \"\\//i\", \"\", $input);\n$filePathLast = $filePath;\n$filePatheIsRemote = str_starts_with($filePath, 'https');\n$srcsets = [];\n$src = [];\n\n# if svg return\nif (mime_content_type($basePath . $filePath) === \"image/svg+xml\") {\n    return '=\"' . $input . '\" width=\"1\" height=\"1\"';\n}\n\n# if remote image\nif ($filePatheIsRemote) {\n    $basePath = '';\n}\n\n# original image not exists\nif (empty($filePath) || ( !file_exists($basePath . $filePath) && !$filePatheIsRemote )) {\n    if ($mode == \"json\") {\n        return \"'\" . $input . \"'\";\n    }\n    if (!empty($input)) {\n        return '=\"' . $input . '\"';\n    }\n    return false;\n}\n\n# loop sizes\n$sizes = explode(\",\", $sizes);\nnatsort($sizes);\nforeach (array_reverse($sizes) as $size) {\n    $dimensions = explode(\"x\", $size);\n    $width = isset($dimensions[0]) ? $dimensions[0] : \"\";\n    $height = isset($dimensions[1]) ? $dimensions[1] : \"\";\n    $filePathInfo = pathinfo($filePath);\n    $savePathFilename = $modx->filterPathSegment($filePathInfo[\"filename\"]);\n    $savePathExtension = \".\" . substr(md5($filePathLast), 0, 8) . \".\" . $width . \"x\" . $height . \"-\" . $quality . \".\" . $fileExtension;\n    $savePath = $cachePath . $savePathFilename . $savePathExtension;\n   \n    # check if base image exists\n    if (!file_exists($basePath . $filePathLast) || filesize($basePath . $filePathLast) < 1) {\n        $filePathLast = $filePath;\n    }\n   \n    # cached image not found\n    if (!file_exists($basePath . $savePath)) {\n        # check if cache dir exists\n        if (!is_dir($basePath . $cachePath)) {\n            mkdir($basePath . $cachePath, 0755);\n        } else {\n        \n            # cleanup cache\n            foreach (glob($basePath . $cachePath . \"*.\" . $fileExtension) as $file) {\n                if (filemtime($file) < time() - (60 * 60 * 24 * 30)) {\n                    unlink($file);\n                }\n            }\n        \n        }\n    \n        # generate image\n        if ($lib == \"cli\") {\n            \n            if ($type == \"video\") {\n                \n                $cmd = $libPath . \" -ss 00:00:00 -i '\" . $basePath . $filePathLast . \"' -filter:v scale=\\\"\" . ( $width ?? \"-1\" ) . \":\" . ( $height ?? \"-1\" ) . \"\\\" \" . $basePath . $savePath;\n            \n            } else {\n            \n                $resize = \"-resize \" . ( $width ?? \"\" ) . \"x\" . ( $height ?? \"\" );\n                \n                if ($width && $height) {\n                    $resize = \"-resize \" . $width . \"x\" . $height . \"^ -gravity center -extent \" . $width . \"x\" . $height;\n                }\n                \n                $cmd = \"export OMP_NUM_THREADS=1;\"; // bugfixes IONOS resize large images, thanks to https://stackoverflow.com/a/69133237\n                $cmd .= $libPath . \" '\" . $basePath . $filePathLast . \"' \" . $resize . \"  -quality \" . $quality . \" '\" . $basePath . $savePath . \"'\";\n           \n            }\n            \n            shell_exec($cmd);\n        \n        } else {\n            \n            $image = new Imagick($basePath . $filePathLast);\n            \n            if ($width && $height) {\n                $image->cropThumbnailImage((int) $width, (int) $height);\n            } else {\n                $image->thumbnailImage((int) $width, (int) $height);\n            }\n            \n            $image->setImageCompressionQuality($quality);\n            $image->writeImage($basePath . $savePath);\n        \n        }\n    \n    }\n        \n    # get generated image    \n    if (file_exists($basePath . $savePath)) {\n        list($width, $height) = getimagesize($basePath . $savePath);\n        $srcsets[] = [\n            \"url\" => $savePath,\n            \"width\" => $width,\n            \"height\" => $height\n        ];\n        \n        # use image for next loop\n        $filePathLast = $savePath;\n    }\n}\n\n# no srcsets, maybe video is converting in the background i.e.\nif (!count($srcsets)) {\n    return $input;\n}\n\n# generate srcset\nforeach ($srcsets as $srcset) {\n    $src[] = $srcset[\"url\"] . \" \" . $srcset[\"width\"] .\"w\";\n}\n\n# set width and height ratio\n$width = $srcsets[0][\"width\"];\n$height = $srcsets[0][\"height\"];\n\n# output as json\nif ($mode == \"json\") {\n    return json_encode([\n        \"url\" => $input,\n        \"src\" => implode(\",\", $src),\n        \"width\" => $width ?? 0,\n        \"height\" => $height ?? 0\n    ]);\n}\n\n# output as base64\n$srcs = implode(\",\", $src);\nif ($mode == \"base64\") {\n    $srcs = \"data:image/\" . $fileExtension . \";base64,\" . base64_encode(file_get_contents($srcsets[0][\"url\"]));\n}\n\n$o = '=\"' . $srcs . '\" width=\"' . $width . '\" height=\"' . $height . '\"';\n\nif ($setRatio) {\n    $o .= ' style=\"aspect-ratio: ' . $width . '/' . $height . '\"';\n}\n\nreturn $o;"
properties: 'a:0:{}'
static: 1
static_file: /snippets/layout/resizeimage.snippet.php

-----



# vars
$lib = $modx->getOption("lib", $scriptProperties, "Imagick");
$libPath = $modx->getOption("libPath", $scriptProperties, "/Applications/MAMP/Library/bin/convert");
$mode = $modx->getOption("mode", $scriptProperties, "");
$type = $modx->getOption("type", $scriptProperties, "image");
$input = $modx->getOption("input", $scriptProperties, "");
$sizes = $modx->getOption("options", $scriptProperties, "");
$quality = $modx->getOption("quality", $scriptProperties, 70);
$fileExtension = $modx->getOption("fileExtension", $scriptProperties, "webp");
$setRatio = $modx->getOption("setRatio", $scriptProperties, true);
$cachePath = $modx->getOption("cachePath", $scriptProperties, "assets/image-cache/");
$cultureKey = $modx->getOption("cultureKey");
$basePath = $modx->getOption("base_path");
$filePath = preg_replace("/^\/?" . $cultureKey . "\//i", "", $input);
$filePathLast = $filePath;
$filePatheIsRemote = str_starts_with($filePath, 'https');
$srcsets = [];
$src = [];

# if svg return
if (mime_content_type($basePath . $filePath) === "image/svg+xml") {
    return '="' . $input . '" width="1" height="1"';
}

# if remote image
if ($filePatheIsRemote) {
    $basePath = '';
}

# original image not exists
if (empty($filePath) || ( !file_exists($basePath . $filePath) && !$filePatheIsRemote )) {
    if ($mode == "json") {
        return "'" . $input . "'";
    }
    if (!empty($input)) {
        return '="' . $input . '"';
    }
    return false;
}

# loop sizes
$sizes = explode(",", $sizes);
natsort($sizes);
foreach (array_reverse($sizes) as $size) {
    $dimensions = explode("x", $size);
    $width = isset($dimensions[0]) ? $dimensions[0] : "";
    $height = isset($dimensions[1]) ? $dimensions[1] : "";
    $filePathInfo = pathinfo($filePath);
    $savePathFilename = $modx->filterPathSegment($filePathInfo["filename"]);
    $savePathExtension = "." . substr(md5($filePathLast), 0, 8) . "." . $width . "x" . $height . "-" . $quality . "." . $fileExtension;
    $savePath = $cachePath . $savePathFilename . $savePathExtension;
   
    # check if base image exists
    if (!file_exists($basePath . $filePathLast) || filesize($basePath . $filePathLast) < 1) {
        $filePathLast = $filePath;
    }
   
    # cached image not found
    if (!file_exists($basePath . $savePath)) {
        # check if cache dir exists
        if (!is_dir($basePath . $cachePath)) {
            mkdir($basePath . $cachePath, 0755);
        } else {
        
            # cleanup cache
            foreach (glob($basePath . $cachePath . "*." . $fileExtension) as $file) {
                if (filemtime($file) < time() - (60 * 60 * 24 * 30)) {
                    unlink($file);
                }
            }
        
        }
    
        # generate image
        if ($lib == "cli") {
            
            if ($type == "video") {
                
                $cmd = $libPath . " -ss 00:00:00 -i '" . $basePath . $filePathLast . "' -filter:v scale=\"" . ( $width ?? "-1" ) . ":" . ( $height ?? "-1" ) . "\" " . $basePath . $savePath;
            
            } else {
            
                $resize = "-resize " . ( $width ?? "" ) . "x" . ( $height ?? "" );
                
                if ($width && $height) {
                    $resize = "-resize " . $width . "x" . $height . "^ -gravity center -extent " . $width . "x" . $height;
                }
                
                $cmd = "export OMP_NUM_THREADS=1;"; // bugfixes IONOS resize large images, thanks to https://stackoverflow.com/a/69133237
                $cmd .= $libPath . " '" . $basePath . $filePathLast . "' " . $resize . "  -quality " . $quality . " '" . $basePath . $savePath . "'";
           
            }
            
            shell_exec($cmd);
        
        } else {
            
            $image = new Imagick($basePath . $filePathLast);
            
            if ($width && $height) {
                $image->cropThumbnailImage((int) $width, (int) $height);
            } else {
                $image->thumbnailImage((int) $width, (int) $height);
            }
            
            $image->setImageCompressionQuality($quality);
            $image->writeImage($basePath . $savePath);
        
        }
    
    }
        
    # get generated image    
    if (file_exists($basePath . $savePath)) {
        list($width, $height) = getimagesize($basePath . $savePath);
        $srcsets[] = [
            "url" => $savePath,
            "width" => $width,
            "height" => $height
        ];
        
        # use image for next loop
        $filePathLast = $savePath;
    }
}

# no srcsets, maybe video is converting in the background i.e.
if (!count($srcsets)) {
    return $input;
}

# generate srcset
foreach ($srcsets as $srcset) {
    $src[] = $srcset["url"] . " " . $srcset["width"] ."w";
}

# set width and height ratio
$width = $srcsets[0]["width"];
$height = $srcsets[0]["height"];

# output as json
if ($mode == "json") {
    return json_encode([
        "url" => $input,
        "src" => implode(",", $src),
        "width" => $width ?? 0,
        "height" => $height ?? 0
    ]);
}

# output as base64
$srcs = implode(",", $src);
if ($mode == "base64") {
    $srcs = "data:image/" . $fileExtension . ";base64," . base64_encode(file_get_contents($srcsets[0]["url"]));
}

$o = '="' . $srcs . '" width="' . $width . '" height="' . $height . '"';

if ($setRatio) {
    $o .= ' style="aspect-ratio: ' . $width . '/' . $height . '"';
}

return $o;