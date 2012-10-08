<?php
/**
 * Package in plugins
 *
 * @package minipayment
 * @subpackage build
 */
$plugins = array();

/* create the plugin object */
$plugins[0] = $modx->newObject('modPlugin');
$plugins[0]->set('id',1);
$plugins[0]->set('name','miniPayment');
$plugins[0]->set('description','Example miniPayment plugin. Here you can change your payment operations. It will not overwritten on upgrades of a component.');
$plugins[0]->set('plugincode', getSnippetContent($sources['plugins'] . 'plugin.minipayment.php'));
$plugins[0]->set('category',0);
$plugins[0]->set('disabled',1);

$events = array();

$events[0]= $modx->newObject('modPluginEvent');
$events[0]->fromArray(array(
	'event' => 'mpOnBeforeOperationCreate',
	'priority' => 0,
	'propertyset' => 0,
),'',true,true);
$events[1]= $modx->newObject('modPluginEvent');
$events[1]->fromArray(array(
	'event' => 'mpOnOperationCreate',
	'priority' => 0,
	'propertyset' => 0,
),'',true,true);

$events[2]= $modx->newObject('modPluginEvent');
$events[2]->fromArray(array(
	'event' => 'mpOnBeforeOperationUpdate',
	'priority' => 0,
	'propertyset' => 0,
),'',true,true);
$events[3]= $modx->newObject('modPluginEvent');
$events[3]->fromArray(array(
	'event' => 'mpOnOperationUpdate',
	'priority' => 0,
	'propertyset' => 0,
),'',true,true);

if (is_array($events) && !empty($events)) {
	$plugins[0]->addMany($events);
	$modx->log(xPDO::LOG_LEVEL_INFO,'Packaged in '.count($events).' plugin events for miniPayment.'); flush();
} else {
	$modx->log(xPDO::LOG_LEVEL_ERROR,'Could not find plugin events for miniPayment!');
}
unset($events);

return $plugins;