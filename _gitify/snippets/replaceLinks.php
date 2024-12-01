id: 20
source: 2
name: replaceLinks
category: 9
snippet: "if (empty($input)) {\n    return;\n}\n    \n$dom = new DOMDocument();\n$dom->loadHTML(mb_convert_encoding($input, \"HTML-ENTITIES\", \"UTF-8\"));\nforeach ($dom->getElementsByTagName(\"a\") as $a) {\n    $a->setAttribute(\n        \"href\",\n        str_replace($modx->getOption(\"site_url\"), \"\", $a->getAttribute(\"href\"))\n    );\n    $a->setAttribute(\"class\", \"link\");\n    if (\n        substr($a->getAttribute(\"href\"), 0, 4) == \"http\" ||\n        substr($a->getAttribute(\"href\"), -3) == \"pdf\"\n    ) {\n        $a->setAttribute(\"target\", \"_blank\");\n        $a->setAttribute(\"rel\", \"noreferer\");\n    }\n}\n\nreturn preg_replace(\n    \"~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\\s*~i\",\n    \"\",\n    $dom->saveHTML()\n);"
properties: 'a:0:{}'
static: 1
static_file: snippets/layout/replacelinks.snippet.php

-----


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
        $a->setAttribute("title", "externer Link");
    }
}

return preg_replace(
    "~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i",
    "",
    $dom->saveHTML()
);
