<?php
switch($modx->event->name) {
	case 'mpOnBeforeOperationCreate':
		$operation = $modx->event->params['operation'];
		//echo '<pre>';print_r($operation->toArray());echo '</pre>';die;
	break;

	case 'mpOnOperationCreate': 
		$operation = $modx->event->params['operation'];
		//echo '<pre>';print_r($operation->toArray());echo '</pre>';die;
	break;

	case 'mpOnBeforeOperationUpdate': 
		$operation = $modx->event->params['operation'];
		//echo '<pre>';print_r($operation->toArray());echo '</pre>';die;
	break;

	case 'mpOnOperationUpdate': 
		$operation = $modx->event->params['operation'];
		//echo '<pre>';print_r($operation->toArray());echo '</pre>';die;
	break;
}