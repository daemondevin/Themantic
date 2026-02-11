<?php
/**
 * Themantic
 *
 * @package themantic
 * @subpackage build
 */

$templates = array();

$templates[0] = $modx->newObject('modTemplate');
$templates[0]->fromArray(array(
    'id' => 0,
    'templatename' => 'ThematicBase',
    'description' => 'Base template for Themantic with Semantic UI integration',
    'content' => file_get_contents($sources['templates'] . 'thematicbase.template.tpl'),
),'',true,true);

$templates[1] = $modx->newObject('modTemplate');
$templates[1]->fromArray(array(
    'id' => 0,
    'templatename' => 'ThematicLanding',
    'description' => 'Landing page template with hero section',
    'content' => file_get_contents($sources['templates'] . 'thematiclanding.template.tpl'),
),'',true,true);

$templates[2] = $modx->newObject('modTemplate');
$templates[2]->fromArray(array(
    'id' => 0,
    'templatename' => 'ThematicBlog',
    'description' => 'Blog template with sidebar',
    'content' => file_get_contents($sources['templates'] . 'thematicblog.template.tpl'),
),'',true,true);

$templates[3] = $modx->newObject('modTemplate');
$templates[3]->fromArray(array(
    'id' => 0,
    'templatename' => 'ThematicEcommerce',
    'description' => 'E-commerce product listing template',
    'content' => file_get_contents($sources['templates'] . 'thematicecommerce.template.tpl'),
),'',true,true);

return $templates;
