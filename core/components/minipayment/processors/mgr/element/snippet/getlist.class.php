<?php
/**
 * Get a list of Statuses
 *
 * @package minipayment
 * @subpackage processors
 */
class miniPaymentItemGetListProcessor extends modObjectGetListProcessor {
	public $classKey = 'modSnippet';
	public $languageTopics = array('snippet','category');
	public $defaultSortField = 'id';
	public $defaultSortDirection  = 'ASC';
	
	public function prepareQueryBeforeCount(xPDOQuery $c) {
		if ($query = $this->getProperty('query')) {
			$c->where(array('name:LIKE' => "%$query%"));
		}
		return $c;
	}

	public function prepareRow(xPDOObject $object) {
		$array = $object->toArray();
		return $array;
	}
	
}

return 'miniPaymentItemGetListProcessor';