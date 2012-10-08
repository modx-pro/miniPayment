<?php
/**
 * Remove an Item.
 * 
 * @package minipayment
 * @subpackage processors
 */
class miniPaymentItemRemoveProcessor extends modObjectRemoveProcessor  {
	public $checkRemovePermission = true;
	public $classKey = 'mpMethod';
	public $languageTopics = array('minipayment');

}
return 'miniPaymentItemRemoveProcessor';