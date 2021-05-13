id: 20
source: 2
name: replaceLinks
category: Layout
snippet: "$dom = new DOMDocument();\n$dom->loadHTML(mb_convert_encoding($input, \"HTML-ENTITIES\", \"UTF-8\"));\nforeach ($dom->getElementsByTagName(\"a\") as $a) {\n    $a->setAttribute(\n        \"href\",\n        str_replace($modx->getOption(\"site_url\"), \"\", $a->getAttribute(\"href\"))\n    );\n    $a->setAttribute(\"class\", \"link\");\n    if (\n        substr($a->getAttribute(\"href\"), 0, 4) == \"http\" ||\n        substr($a->getAttribute(\"href\"), -3) == \"pdf\"\n    ) {\n        $a->setAttribute(\"target\", \"_blank\");\n        $a->setAttribute(\"rel\", \"noreferer\");\n        $nodeValWords = explode(\" \", $a->nodeValue);\n        $nodeValLastWord = array_pop($nodeValWords);\n        $a->nodeValue = implode(\" \", $nodeValWords) . \" \";\n        $lastWordWrapper = $dom->createElement(\"span\");\n        $lastWordWrapper->setAttribute(\"class\", \"dib nowrap\");\n        $lastWordWrapper->nodeValue = $nodeValLastWord;\n        $iconWrapper = $dom->createElement(\"span\");\n        $iconWrapper->setAttribute(\"class\", \"dib ml2 mr2\");\n        $icon = $dom->createElement(\"span\", \"[[svg?n=`external`]]\");\n        $icon->setAttribute(\"class\", \"icon icon-font\");\n        $iconWrapper->appendChild($icon);\n        $lastWordWrapper->appendChild($iconWrapper);\n        $a->appendChild($lastWordWrapper);\n    }\n}\n\nreturn preg_replace(\n    \"~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\\s*~i\",\n    \"\",\n    $dom->saveHTML()\n);"
properties: 'a:0:{}'
static: 1
static_file: /snippets/layout/replacelinks.snippet.php
content: "$dom = new DOMDocument();\n$dom->loadHTML(mb_convert_encoding($input, \"HTML-ENTITIES\", \"UTF-8\"));\nforeach ($dom->getElementsByTagName(\"a\") as $a) {\n    $a->setAttribute(\n        \"href\",\n        str_replace($modx->getOption(\"site_url\"), \"\", $a->getAttribute(\"href\"))\n    );\n    $a->setAttribute(\"class\", \"link\");\n    if (\n        substr($a->getAttribute(\"href\"), 0, 4) == \"http\" ||\n        substr($a->getAttribute(\"href\"), -3) == \"pdf\"\n    ) {\n        $a->setAttribute(\"target\", \"_blank\");\n        $a->setAttribute(\"rel\", \"noreferer\");\n        $nodeValWords = explode(\" \", $a->nodeValue);\n        $nodeValLastWord = array_pop($nodeValWords);\n        $a->nodeValue = implode(\" \", $nodeValWords) . \" \";\n        $lastWordWrapper = $dom->createElement(\"span\");\n        $lastWordWrapper->setAttribute(\"class\", \"dib nowrap\");\n        $lastWordWrapper->nodeValue = $nodeValLastWord;\n        $iconWrapper = $dom->createElement(\"span\");\n        $iconWrapper->setAttribute(\"class\", \"dib ml2 mr2\");\n        $icon = $dom->createElement(\"span\", \"[[svg?n=`external`]]\");\n        $icon->setAttribute(\"class\", \"icon icon-font\");\n        $iconWrapper->appendChild($icon);\n        $lastWordWrapper->appendChild($iconWrapper);\n        $a->appendChild($lastWordWrapper);\n    }\n}\n\nreturn preg_replace(\n    \"~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\\s*~i\",\n    \"\",\n    $dom->saveHTML()\n);"

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
        $nodeValWords = explode(" ", $a->nodeValue);
        $nodeValLastWord = array_pop($nodeValWords);
        $a->nodeValue = implode(" ", $nodeValWords) . " ";
        $lastWordWrapper = $dom->createElement("span");
        $lastWordWrapper->setAttribute("class", "dib nowrap");
        $lastWordWrapper->nodeValue = $nodeValLastWord;
        $iconWrapper = $dom->createElement("span");
        $iconWrapper->setAttribute("class", "dib ml2 mr2");
        $icon = $dom->createElement("span", "[[svg?n=`external`]]");
        $icon->setAttribute("class", "icon icon-font");
        $iconWrapper->appendChild($icon);
        $lastWordWrapper->appendChild($iconWrapper);
        $a->appendChild($lastWordWrapper);
    }
}

return preg_replace(
    "~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i",
    "",
    $dom->saveHTML()
);
