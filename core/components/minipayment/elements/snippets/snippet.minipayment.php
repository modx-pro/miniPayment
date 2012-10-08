<?php
$modx->miniPayment = $modx->getService('minipayment','miniPayment',$modx->getOption('minipayment.core_path',null,$modx->getOption('core_path').'components/minipayment/').'model/minipayment/',$scriptProperties);
if (!($modx->miniPayment instanceof miniPayment)) return '';


if (!empty($_REQUEST['action'])) {
	// Only these methods are can override action parameter of snippet through $_REQUEST
	switch($_REQUEST['action']) {
		case 'createOperation': $action = 'createOperation'; break;
	}
}

// Running action!
switch($action) {
	case 'createOperation': $output = $modx->miniPayment->createOperation($_REQUEST); break;
	case 'getOperation': $output = $modx->miniPayment->getOperation($scriptProperties['id']); break;
	case 'updateOperation': $output = $modx->miniPayment->updateOperation($scriptProperties['id'], $scriptProperties['status']); break;
	
	default: $output = $modx->miniPayment->getForm();
}

// Returning result
if (is_array($output)) {
	return json_encode($output);
}
else {
	return $output;
}