<?php
/**
 * Get a list of Statuses
 *
 * @package minipayment
 * @subpackage processors
 */
class miniPaymentItemGetListProcessor extends modObjectGetListProcessor {
	public $classKey = 'mpStatus';
	public $defaultSortField = 'id';
	public $defaultSortDirection  = 'ASC';
	public $renderers = '';
	
	public function prepareQueryBeforeCount(xPDOQuery $c) {
		return $c;
	}

	public function prepareRow(xPDOObject $object) {
		$array = $object->toArray();
		return $array;
	}
	
}

return 'miniPaymentItemGetListProcessor';