id: 12
source: 2
name: managerModify
category: 9
plugincode: "# add parent id class to body\n$resource = $modx->controller->resource;\nif ($resource) {\n    $templateId = $resource->get(\"template\");   \n    $script = '\n        <script>\n            window.addEventListener(\"load\", function(event) {\n                document.querySelector(\"body\").classList.add(\"template-id-' . $templateId . '\");\n            });\n        </script>\n    ';\n    $modx->regClientStartupHTMLBlock($script);\n}\n\n# add custom css\nif (!$modx->user->isMember(\"Administrator\")) {\n    $modx->regClientCSS(\n        MODX_BASE_URL .\n            $modx->getOption(\"tplPath\") .\n            \"frontend/styleguide/css/modx.css\"\n    );\n}"
properties: 'a:0:{}'
static: 1
static_file: /plugins/layout/managermodify.plugin.php

-----


# add parent id class to body
$resource = $modx->controller->resource;
if ($resource) {
    $templateId = $resource->get("template");   
    $script = '
        <script>
            window.addEventListener("load", function(event) {
                document.querySelector("body").classList.add("template-id-' . $templateId . '");
            });
        </script>
    ';
    $modx->regClientStartupHTMLBlock($script);
}

# add custom css
if (!$modx->user->isMember("Administrator")) {
    $modx->regClientCSS(
        MODX_BASE_URL .
            $modx->getOption("tplPath") .
            "frontend/styleguide/css/modx.css"
    );
}