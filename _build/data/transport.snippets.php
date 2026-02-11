<?php
/**
 * Themantic
 *
 * @package themantic
 * @subpackage build
 */

$snippets = array();

$snippets[0] = $modx->newObject('modSnippet');
$snippets[0]->fromArray(array(
    'id' => 0,
    'name' => 'ThematicMenu',
    'description' => 'Outputs a Semantic UI formatted menu',
    'snippet' => getSnippetContent($sources['snippets'] . 'thematicmenu.snippet.php'),
),'',true,true);

$snippets[1] = $modx->newObject('modSnippet');
$snippets[1]->fromArray(array(
    'id' => 0,
    'name' => 'ThematicBreadcrumbs',
    'description' => 'Outputs Semantic UI formatted breadcrumbs',
    'snippet' => getSnippetContent($sources['snippets'] . 'thematicbreadcrumbs.snippet.php'),
),'',true,true);

$snippets[2] = $modx->newObject('modSnippet');
$snippets[2]->fromArray(array(
    'id' => 0,
    'name' => 'ThematicGallery',
    'description' => 'Outputs a Semantic UI formatted image gallery',
    'snippet' => getSnippetContent($sources['snippets'] . 'thematicgallery.snippet.php'),
),'',true,true);

return $snippets;
