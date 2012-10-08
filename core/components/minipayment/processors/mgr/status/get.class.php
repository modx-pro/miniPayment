<?php
/**
 * Get an Item
 * 
 * @package minipayment
 * @subpackage processors
 */
class miniPaymentItemGetProcessor extends modObjectGetProcessor {
	public $classKey = 'mpStatus';
	public $languageTopics = array('minipayment:default');
	public $objectType = 'minipayment';
}

return 'miniPaymentItemGetProcessor';