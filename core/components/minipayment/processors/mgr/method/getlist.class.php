<?php
/**
 * Get a list of Statuses
 *
 * @package minipayment
 * @subpackage processors
 */
class miniPaymentItemGetListProcessor extends modObjectGetListProcessor {
	public $classKey = 'mpMethod';
	public $defaultSortField = 'id';
	public $defaultSortDirection  = 'ASC';
	public $renderers = '';
	
	public function prepareQueryBeforeCount(xPDOQuery $c) {
		if ($active = $this->getProperty('active')) {
			$c->where(array('active' => 1));
		}
		return $c;
	}

	public function prepareRow(xPDOObject $object) {
		$array = $object->toArray();
		if ($snippet = $this->modx->getObject('modSnippet', $array['send'])) {
			$array['snippet_send'] = $snippet->get('name');
		}
		if ($snippet = $this->modx->getObject('modSnippet', $array['receive'])) {
			$array['snippet_receive'] = $snippet->get('name');
		}
		return $array;
	}
	
}

return 'miniPaymentItemGetListProcessor';