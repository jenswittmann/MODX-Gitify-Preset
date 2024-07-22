<?php
if (empty($input)) {
    return;
}
    
$dom = new DOMDocument();
$dom->loadHTML(mb_convert_encoding($input, "HTML-ENTITIES", "UTF-8"));
foreach ($dom->getElementsByTagName("a") as $a) {
    $a->setAttribute(
        "href",
        str_replace($modx->getOption("site_url"), "", $a->getAttribute("href"))
    );
    $a->setAttribute("class", "link");
    if (
        substr($a->getAttribute("href"), 0, 4) == "http" ||
        substr($a->getAttribute("href"), -3) == "pdf"
    ) {
        $a->setAttribute("target", "_blank");
        $a->setAttribute("rel", "noreferer");
    }
}

return preg_replace(
    "~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i",
    "",
    $dom->saveHTML()
);
