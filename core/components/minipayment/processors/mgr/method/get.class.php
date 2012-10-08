<?php
/**
 * Get an Item
 * 
 * @package minipayment
 * @subpackage processors
 */
class miniPaymentItemGetProcessor extends modObjectGetProcessor {
	public $classKey = 'mpMethod';
	public $languageTopics = array('minipayment:default');
	public $objectType = 'minipayment';
}

return 'miniPaymentItemGetProcessor';