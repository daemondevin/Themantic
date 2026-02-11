<?php
/**
 * ThematicGallery
 * 
 * Outputs a Semantic UI formatted image gallery
 *
 * @package themantic
 * @var modX $modx
 * @var array $scriptProperties
 */

$images = $modx->getOption('images', $scriptProperties, '');
$columns = $modx->getOption('columns', $scriptProperties, 4);
$containerClass = $modx->getOption('containerClass', $scriptProperties, 'ui images');

if (empty($images)) {
    return '';
}

$imageArray = explode(',', $images);
$output = '<div class="ui ' . $columns . ' column grid">' . "\n";

foreach ($imageArray as $image) {
    $image = trim($image);
    if (empty($image)) continue;
    
    $output .= '<div class="column">' . "\n";
    $output .= '    <div class="ui fluid image">' . "\n";
    $output .= '        <img src="' . $image . '" alt="">' . "\n";
    $output .= '    </div>' . "\n";
    $output .= '</div>' . "\n";
}

$output .= '</div>';

return $output;
