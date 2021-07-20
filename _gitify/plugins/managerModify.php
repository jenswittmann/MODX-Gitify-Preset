id: 10
source: 2
name: managerModify
category: Layout
properties: 'a:0:{}'
static_file: /plugins/layout/managermodify.plugin.php

-----

$resource = $modx->controller->resource;

if ($resource) {
    $script = '
    	<script>
    	window.addEventListener("load", function(event) {
        	document.querySelector("body").classList.add("template-id-'.$resource->get('template').'");
        });
    	</script>
    ';
}

if ( !$modx->user->isMember('Administrator') ) {
	$modx->regClientCSS( MODX_BASE_URL . $modx->getOption('tplPath') . 'frontend/styleguide/css/modx.css' );
	$modx->regClientStartupHTMLBlock($script);
}
