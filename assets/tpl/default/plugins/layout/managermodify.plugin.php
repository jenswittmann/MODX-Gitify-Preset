<?php
# add parent id class to body
// $resource = $modx->controller->resource;
// if ($resource) {
//     $templateId = $resource->get("template");
//     $script = '
//         <script>
//             window.addEventListener("load", function(event) {
//                 document.querySelector("body").classList.add("template-id-' . $templateId . '");
//             });
//         </script>
//     ';
//     $modx->regClientStartupHTMLBlock($script);
// }

# add custom css
if (!$modx->user->isMember("Administrator")) {
    $modx->regClientCSS(
        MODX_BASE_URL .
            $modx->getOption("tplPath") .
            "frontend/styleguide/css/modx.css"
    );
}