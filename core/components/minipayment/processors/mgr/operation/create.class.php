<?php
/**
 * Create an Item
 * 
 * @package minipayment
 * @subpackage processors
 */
class miniPaymentItemCreateProcessor extends modObjectCreateProcessor {
	public $classKey = 'mpOperation';
	public $languageTopics = array('minipayment');
	public $beforeSaveEvent = 'mpOnBeforeOperationCreate';
	public $afterSaveEvent = 'mpOnOperationCreate';
	public $objectType = 'operation';
	//public $permission = 'new_document';
	
	public function beforeSet() {
		$this->object->set('uid', $this->modx->user->id);
		$this->object->set('status', 1);
		$this->object->set('createdon', date('Y-m-d H:i:s'));
		
		return !$this->hasErrors();
	}
	
}

return 'miniPaymentItemCreateProcessor';