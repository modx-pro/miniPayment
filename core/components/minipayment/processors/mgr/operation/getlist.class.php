<?php
/**
 * Get a list of Operations
 *
 * @package minipayment
 * @subpackage processors
 */
class miniPaymentItemGetListProcessor extends modObjectGetListProcessor {
	public $classKey = 'mpOperation';
	public $defaultSortField = 'id';
	public $defaultSortDirection  = 'DESC';
	public $renderers = '';
	
	public function prepareQueryBeforeCount(xPDOQuery $c) {
		return $c;
	}

	public function prepareRow(xPDOObject $object) {
		if ($tmp = $this->modx->getObject('modUser', $object->get('uid'))) {
			$user = $tmp->getOne('Profile')->get('fullname');
			if (empty($user)) {
				$user = $tmp->get('username');
			}
			$object->set('username', $user);
		}
		if ($tmp = $this->modx->getObject('mpStatus', $object->get('status'))) {
			$status = '<span style="color:#'.$tmp->get('color').';">'.$tmp->get('name').'</span>';
			$object->set('statusname', $status);
		}
		if ($tmp = $this->modx->getObject('mpMethod', $object->get('method'))) {
			$method = $tmp->get('name');
			$object->set('methodname', $method);
		}
	
		$array = $object->toArray();
		return $array;
	}
	
}

return 'miniPaymentItemGetListProcessor';