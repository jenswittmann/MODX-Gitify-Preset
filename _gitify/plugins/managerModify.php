id: 10
source: 2
name: managerModify
category: Layout
properties: 'a:0:{}'
static_file: /plugins/layout/managermodify.plugin.php

-----

/*
jQuery(function($) {
    var checkCB = setInterval(function() {
        if (ContentBlocks.initialized) {
            $("#contentblocks .contentblocks-field-wrap").addClass("prevent-drag");
            $("#contentblocks .contentblocks-repeater-wrapper").parents(".prevent-drag").removeClass("prevent-drag");
            clearInterval(checkCB);
        }
    }, 50);
});
*/

$script = '
	<script>
	window.addEventListener("load", function(event) {
    	document.querySelector("body").classList.add("template-id-'.print_r($modx->controller->resource->get('template'), true).'");
    });
	</script>
';

if ( !$modx->user->isMember('Administrator') ) {
	$modx->regClientCSS( MODX_BASE_URL . $modx->getOption('tplPath') . 'frontend/styleguide/css/modx.css' );
	$modx->regClientStartupHTMLBlock($script);
}