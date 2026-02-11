<?php
/**
 * ThematicBreadcrumbs
 * 
 * Outputs Semantic UI formatted breadcrumbs
 *
 * @package themantic
 * @var modX $modx
 * @var array $scriptProperties
 */

$showHome = $modx->getOption('showHome', $scriptProperties, true);
$homeText = $modx->getOption('homeText', $scriptProperties, 'Home');
$showCurrent = $modx->getOption('showCurrent', $scriptProperties, true);
$containerClass = $modx->getOption('containerClass', $scriptProperties, 'ui breadcrumb');
$divider = $modx->getOption('divider', $scriptProperties, '/');

$crumbs = array();

// Get the current resource trail
$parents = $modx->getParentIds($modx->resource->id);
$parents = array_reverse($parents);

// Add home if needed
if ($showHome && $modx->resource->id != $modx->getOption('site_start')) {
    $homeId = $modx->getOption('site_start');
    $crumbs[] = '<a class="section" href="' . $modx->makeUrl($homeId) . '">' . $homeText . '</a>';
}

// Add parent pages
foreach ($parents as $parentId) {
    if ($parentId == 0 || $parentId == $modx->getOption('site_start')) continue;
    
    $parent = $modx->getObject('modResource', $parentId);
    if ($parent) {
        $crumbs[] = '<div class="divider"> ' . $divider . ' </div>';
        $crumbs[] = '<a class="section" href="' . $modx->makeUrl($parentId) . '">' . $parent->get('pagetitle') . '</a>';
    }
}

// Add current page
if ($showCurrent && $modx->resource->id != $modx->getOption('site_start')) {
    $crumbs[] = '<div class="divider"> ' . $divider . ' </div>';
    $crumbs[] = '<div class="active section">' . $modx->resource->get('pagetitle') . '</div>';
}

$output = '<div class="' . $containerClass . '">' . "\n";
$output .= implode("\n", $crumbs);
$output .= "\n" . '</div>';

return $output;
