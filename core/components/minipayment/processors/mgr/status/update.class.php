<?php
/**
 * Update an Method
 * 
 * @package minipayment
 * @subpackage processors
 */
class miniPaymentItemUpdateProcessor extends modObjectUpdateProcessor {
	public $classKey = 'mpStatus';
	public $languageTopics = array('minipayment');
	public $permission = 'update_document';
	
	public function beforeSet() {
		$name = $this->getProperty('name');
		$id = $this->getProperty('id');
		if (!$name) {
			$this->modx->error->addField('name', $this->modx->lexicon('field_required'));
		}
		else {
			if ($this->modx->getCount('mpStatus',array('name' => $name, 'id:!=' => $id))) {
				$this->modx->error->addField('name',$this->modx->lexicon('minipayment.status_err_ae'));
			}
		}
		return !$this->hasErrors();
	}
}

return 'miniPaymentItemUpdateProcessor';