id: 12
source: 2
name: managerModify
category: 9
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