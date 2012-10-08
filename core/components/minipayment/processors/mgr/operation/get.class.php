<?php
/**
 * Get an Item
 * 
 * @package minipayment
 * @subpackage processors
 */
class miniPaymentItemGetProcessor extends modObjectGetProcessor {
	public $classKey = 'mpOperation';
	public $languageTopics = array('minipayment:default');
	public $objectType = 'minipayment';
	
	public function beforeOutput() {
		if ($tmp = $this->modx->getObject('modUser', $this->object->get('uid'))) {
			$user = $tmp->getOne('Profile')->get('fullname');
			if (empty($user)) {
				$user = $tmp->get('username');
			}
			$this->object->set('username', $user);
		}
		if ($tmp = $this->modx->getObject('mpStatus', $this->object->get('status'))) {
			$status = '<span style="color:#'.$tmp->get('color').';">'.$tmp->get('name').'</span>';
			$this->object->set('statusname', $status);
		}
		if ($tmp = $this->modx->getObject('mpMethod', $this->object->get('method'))) {
			$method = $tmp->get('name');
			$this->object->set('methodname', $method);
		}
	
	}
}

return 'miniPaymentItemGetProcessor';