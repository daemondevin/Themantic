<?php
/**
 * Themantic Plugin
 * 
 * Core functionality for Themantic
 *
 * @package themantic
 * @var modX $modx
 * @var array $scriptProperties
 */

$eventName = $modx->event->name;

switch ($eventName) {
    case 'OnDocFormRender':
        // Add custom CSS/JS to manager for Themantic templates
        if ($modx->resource && $modx->resource->get('template')) {
            $template = $modx->getObject('modTemplate', $modx->resource->get('template'));
            if ($template && strpos($template->get('templatename'), 'Themantic') !== false) {
                $modx->controller->addCss($modx->getOption('assets_url') . 'components/themantic/css/manager.css');
                $modx->controller->addJavascript($modx->getOption('assets_url') . 'components/themantic/js/manager.js');
            }
        }
        break;
        
    case 'OnLoadWebDocument':
        // Add any front-end initialization here
        // For example, auto-inject Semantic UI if Themantic template is used
        if ($modx->resource && $modx->resource->get('template')) {
            $template = $modx->getObject('modTemplate', $modx->resource->get('template'));
            if ($template && strpos($template->get('templatename'), 'Themantic') !== false) {
                // Any initialization logic for Themantic templates
            }
        }
        break;
}

return;
