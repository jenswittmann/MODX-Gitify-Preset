id: 19
source: 2
name: svg
category: 9
snippet: "# vars\n$name = $modx->getOption( 'n', $scriptProperties );\n$scaleStroke = $modx->getOption( 'scalestroke', $scriptProperties, false );\n$path = $modx->getOption( 'filePath', $scriptProperties, $modx->getOption( 'tplPath' ). 'frontend/styleguide/icon/' );\n$extension = $modx->getOption( 'extension', $scriptProperties, '.svg' );\n$fullPath = $path . $name . $extension;\n\n# get file and modify\nif ( file_exists( $fullPath ) ) {\n    \n    $svg = file_get_contents( $fullPath );\n    $svg = str_replace( '<svg', '<svg focusable=\"false\" aria-hidden=\"true\"', $svg );\n    \n    if ( $scaleStroke ) {\n        $svg = str_replace( 'path', 'path vector-effect=\"non-scaling-stroke\"', $svg );\n    }\n    \n    return $svg;\n    \n}"
properties: 'a:0:{}'
static: 1
static_file: snippets/layout/svg.snippet.php

-----


# vars
$name = $modx->getOption( 'n', $scriptProperties );
$scaleStroke = $modx->getOption( 'scalestroke', $scriptProperties, false );
$path = $modx->getOption( 'filePath', $scriptProperties, $modx->getOption( 'tplPath' ). 'frontend/styleguide/icon/' );
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