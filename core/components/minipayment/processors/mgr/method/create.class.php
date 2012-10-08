<?php
/**
 * Create an Method
 * 
 * @package minipayment
 * @subpackage processors
 */
class miniPaymentItemCreateProcessor extends modObjectCreateProcessor {
	public $classKey = 'mpMethod';
	public $languageTopics = array('minipayment');
	public $permission = 'new_document';
	
	public function beforeSet() {
		$name = $this->getProperty('name');
		if (!$name) {
			$this->modx->error->addField('name', $this->modx->lexicon('field_required'));
		}
		else {
			if ($this->modx->getCount('mpMethod',array('name' => $name))) {
				$this->modx->error->addField('name',$this->modx->lexicon('minipayment.method_err_ae'));
			}
		}
		return !$this->hasErrors();
	}
}

return 'miniPaymentItemCreateProcessor';