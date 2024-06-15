<?php

if (!$modx->user->isMember("Administrator")) {
    $modx->regClientCSS(
        MODX_BASE_URL .
            $modx->getOption("tplPath") .
            "frontend/styleguide/css/modx.css"
    );
}