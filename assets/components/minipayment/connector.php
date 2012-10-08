<?php
/**
 * miniPayment Connector
 *
 * @package minipayment
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';

$corePath = $modx->getOption('minipayment.core_path',null,$modx->getOption('core_path').'components/minipayment/');
require_once $corePath.'model/minipayment/minipayment.class.php';
$modx->minipayment = new miniPayment($modx);

$modx->lexicon->load('minipayment:default');

/* handle request */
$path = $modx->getOption('processorsPath',$modx->minipayment->config,$corePath.'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));