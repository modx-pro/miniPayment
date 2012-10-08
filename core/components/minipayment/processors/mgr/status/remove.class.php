<?php
/**
 * Remove an Item.
 * 
 * @package minipayment
 * @subpackage processors
 */
class miniPaymentItemRemoveProcessor extends modObjectRemoveProcessor  {
	public $checkRemovePermission = true;
	public $classKey = 'mpStatus';
	public $languageTopics = array('minipayment');

}
return 'miniPaymentItemRemoveProcessor';