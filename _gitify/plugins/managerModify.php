id: 12
source: 2
name: managerModify
category: 9
plugincode: "if (!$modx->user->isMember(\"Administrator\")) {\n    $modx->regClientCSS(\n        MODX_BASE_URL .\n            $modx->getOption(\"tplPath\") .\n            \"frontend/styleguide/css/modx.css\"\n    );\n}"
properties: 'a:0:{}'
static: 1
static_file: /plugins/layout/managermodify.plugin.php

-----


if (!$modx->user->isMember("Administrator")) {
    $modx->regClientCSS(
        MODX_BASE_URL .
            $modx->getOption("tplPath") .
            "frontend/styleguide/css/modx.css"
    );
}