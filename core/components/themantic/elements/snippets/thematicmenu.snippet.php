<?php
/**
 * ThematicMenu
 * 
 * Outputs a Semantic UI formatted menu
 *
 * @package themantic
 * @var modX $modx
 * @var array $scriptProperties
 */

$startId = $modx->getOption('startId', $scriptProperties, $modx->resource->id);
$level = $modx->getOption('level', $scriptProperties, 1);
$classNames = $modx->getOption('classNames', $scriptProperties, 'item');
$activeClass = $modx->getOption('activeClass', $scriptProperties, 'active');
$showHidden = $modx->getOption('showHidden', $scriptProperties, false);
$excludeDocs = $modx->getOption('excludeDocs', $scriptProperties, '');

// Get child resources
$criteria = array(
    'parent' => $startId,
    'published' => 1,
    'deleted' => 0,
);

if (!$showHidden) {
    $criteria['hidemenu'] = 0;
}

if (!empty($excludeDocs)) {
    $exclude = explode(',', $excludeDocs);
    $criteria['id:NOT IN'] = $exclude;
}

$resources = $modx->getCollection('modResource', $criteria);

$output = '';
foreach ($resources as $resource) {
    $isActive = ($modx->resource->id == $resource->id) ? ' ' . $activeClass : '';
    $url = $modx->makeUrl($resource->id);
    $pagetitle = $resource->get('pagetitle');
    
    $output .= '<a href="' . $url . '" class="' . $classNames . $isActive . '">' . $pagetitle . '</a>' . "\n";
}

return $output;
