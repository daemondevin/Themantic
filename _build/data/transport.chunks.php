<?php
/**
 * Themantic
 *
 * @package themantic
 * @subpackage build
 */

$chunks = array();

$chunks[0] = $modx->newObject('modChunk');
$chunks[0]->fromArray(array(
    'id' => 0,
    'name' => 'thematicHead',
    'description' => 'Header HTML and CSS includes for Themantic',
    'snippet' => file_get_contents($sources['chunks'] . 'thematichead.chunk.tpl'),
),'',true,true);

$chunks[1] = $modx->newObject('modChunk');
$chunks[1]->fromArray(array(
    'id' => 0,
    'name' => 'thematicFooter',
    'description' => 'Footer HTML and JavaScript includes for Themantic',
    'snippet' => file_get_contents($sources['chunks'] . 'thematicfooter.chunk.tpl'),
),'',true,true);

$chunks[2] = $modx->newObject('modChunk');
$chunks[2]->fromArray(array(
    'id' => 0,
    'name' => 'thematicNavigation',
    'description' => 'Semantic UI navigation menu',
    'snippet' => file_get_contents($sources['chunks'] . 'thematicnavigation.chunk.tpl'),
),'',true,true);

$chunks[3] = $modx->newObject('modChunk');
$chunks[3]->fromArray(array(
    'id' => 0,
    'name' => 'thematicHero',
    'description' => 'Hero section for landing pages',
    'snippet' => file_get_contents($sources['chunks'] . 'thematichero.chunk.tpl'),
),'',true,true);

$chunks[4] = $modx->newObject('modChunk');
$chunks[4]->fromArray(array(
    'id' => 0,
    'name' => 'thematicCard',
    'description' => 'Semantic UI card component',
    'snippet' => file_get_contents($sources['chunks'] . 'thematiccard.chunk.tpl'),
),'',true,true);

return $chunks;
