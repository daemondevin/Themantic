<?php
/**
 * Themantic
 *
 * @package themantic
 * @subpackage build
 */

$plugins = array();

$plugins[0] = $modx->newObject('modPlugin');
$plugins[0]->fromArray(array(
    'id' => 0,
    'name' => 'Themantic',
    'description' => 'Core plugin for Themantic functionality',
    'plugincode' => getSnippetContent($sources['plugins'] . 'themantic.plugin.php'),
),'',true,true);

$events = array();
$events['OnDocFormRender'] = $modx->newObject('modPluginEvent');
$events['OnDocFormRender']->fromArray(array(
    'event' => 'OnDocFormRender',
    'priority' => 0,
    'propertyset' => 0,
),'',true,true);

$events['OnLoadWebDocument'] = $modx->newObject('modPluginEvent');
$events['OnLoadWebDocument']->fromArray(array(
    'event' => 'OnLoadWebDocument',
    'priority' => 0,
    'propertyset' => 0,
),'',true,true);

if (is_array($events) && !empty($events)) {
    $plugins[0]->addMany($events);
}

return $plugins;
