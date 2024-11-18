<?php
$cssPath = MODX_BASE_URL . $modx->getOption("tplPath") . "frontend/styleguide/css/modx.css";

switch($modx->event->name) {
    case 'OnManagerPageBeforeRender':
        $modx->regClientCSS($cssPath);
        break;

    case 'OnManagerLoginFormPrerender':
        $modx->event->output('<link rel="stylesheet" href="' . $cssPath . '">');
        break;
}