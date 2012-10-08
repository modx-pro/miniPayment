<?php
/**
 * Add miniPayment events for plugins to build
 * 
 * @package minipayment
 * @subpackage build
 */
$events = array();

$events[0]= $modx->newObject('modEvent');
$events[0]->fromArray(array (
  'name' => 'mpOnBeforeOperationCreate',
  'service' => 6,
  'groupname' => 'miniPayment',
), '', true, true);

$events[1]= $modx->newObject('modEvent');
$events[1]->fromArray(array (
  'name' => 'mpOnOperationCreate',
  'service' => 6,
  'groupname' => 'miniPayment',
), '', true, true);

$events[2]= $modx->newObject('modEvent');
$events[2]->fromArray(array (
  'name' => 'mpOnBeforeOperationUpdate',
  'service' => 6,
  'groupname' => 'miniPayment',
), '', true, true);

$events[3]= $modx->newObject('modEvent');
$events[3]->fromArray(array (
  'name' => 'mpOnOperationUpdate',
  'service' => 6,
  'groupname' => 'miniPayment',
), '', true, true);


return $events;