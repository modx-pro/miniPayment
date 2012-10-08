<?php
/**
 * Adds modActions and modMenus into package
 *
 * @package minipayment
 * @subpackage build
 */
$action= $modx->newObject('modAction');
$action->fromArray(array(
	'id' => 1,
	'namespace' => 'minipayment',
	'parent' => 0,
	'controller' => 'index',
	'haslayout' => 1,
	'lang_topics' => 'minipayment:default',
	'assets' => '',
),'',true,true);

/* load action into menu */
$menu= $modx->newObject('modMenu');
$menu->fromArray(array(
	'text' => 'minipayment',
	'parent' => 'components',
	'description' => 'minipayment.menu_desc',
	'icon' => 'images/icons/plugin.gif',
	'menuindex' => 0,
	'params' => '',
	'handler' => '',
),'',true,true);
$menu->addOne($action);
unset($action);

return $menu;