<?php
# vars
$name = $modx->getOption( 'n', $scriptProperties, $input );
$scaleStroke = $modx->getOption( 'scalestroke', $scriptProperties, false );
$path = $modx->getOption('base_path') . $modx->getOption( 'filePath', $scriptProperties, $modx->getOption( 'tplPath' ). 'frontend/styleguide/icon/' );
$extension = $modx->getOption( 'extension', $scriptProperties, '.svg' );
$fullPath = $path . $name . $extension;

# get file and modify
if ( file_exists( $fullPath ) ) {
    
    $svg = file_get_contents( $fullPath );
    $svg = str_replace( '<svg', '<svg focusable="false" aria-hidden="true"', $svg );
    
    if ( $scaleStroke ) {
        $svg = str_replace( 'path', 'path vector-effect="non-scaling-stroke"', $svg );
    }
    
    return $svg;
    
}
