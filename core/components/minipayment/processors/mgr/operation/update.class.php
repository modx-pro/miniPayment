<?php
/**
 * Update an Item
 * 
 * @package minipayment
 * @subpackage processors
 */
class miniPaymentItemUpdateProcessor extends modObjectUpdateProcessor {
	public $classKey = 'mpOperation';
	public $languageTopics = array('minipayment');
	public $beforeSaveEvent = 'mpOnBeforeOperationUpdate';
	public $afterSaveEvent = 'mpOnOperationUpdate';
	public $objectType = 'operation';
	//public $checkSavePermission = true;
	//public $permission = 'update_document';
	
	public function beforeSet() {
		$this->object->set('status', 2);
		$this->object->set('updatedon', date('Y-m-d H:i:s'));
		
		return !$this->hasErrors();
	}
}

return 'miniPaymentItemUpdateProcessor';