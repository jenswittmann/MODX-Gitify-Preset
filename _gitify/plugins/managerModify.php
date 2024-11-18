id: 12
source: 2
name: managerModify
category: 9
plugincode: "$cssPath = MODX_BASE_URL . $modx->getOption(\"tplPath\") . \"frontend/styleguide/css/modx.css\";\n\nswitch($modx->event->name) {\n    case 'OnManagerPageBeforeRender':\n        $modx->regClientCSS($cssPath);\n        break;\n\n    case 'OnManagerLoginFormPrerender':\n        $modx->event->output('<link rel=\"stylesheet\" href=\"' . $cssPath . '\">');\n        break;\n}"
properties: 'a:0:{}'
static: 1
static_file: /plugins/layout/managermodify.plugin.php

-----


$cssPath = MODX_BASE_URL . $modx->getOption("tplPath") . "frontend/styleguide/css/modx.css";

switch($modx->event->name) {
    case 'OnManagerPageBeforeRender':
        $modx->regClientCSS($cssPath);
        break;

    case 'OnManagerLoginFormPrerender':
        $modx->event->output('<link rel="stylesheet" href="' . $cssPath . '">');
        break;
}