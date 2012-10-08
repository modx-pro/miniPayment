<?php
/**
 * Remove an Item.
 * 
 * @package minipayment
 * @subpackage processors
 */
class miniPaymentItemRemoveProcessor extends modObjectRemoveProcessor  {
	public $checkRemovePermission = true;
	public $classKey = 'mpOperation';
	public $languageTopics = array('minipayment');

}
return 'miniPaymentItemRemoveProcessor';