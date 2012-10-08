<?php
/**
 * Properties for the miniPayment snippet.
 *
 * @package minipayment
 * @subpackage build
 */
$properties = array(
	array(
		'name' => 'tplForm',
		'desc' => 'prop_minipayment.tplForm',
		'type' => 'textfield',
		'options' => '',
		'value' => 'tpl.Payment.form',
		'lexicon' => 'minipayment:properties',
	),
	array(
		'name' => 'tplMethod',
		'desc' => 'prop_minipayment.tplMethod',
		'type' => 'textfield',
		'options' => '',
		'value' => 'tpl.Payment.method.row',
		'lexicon' => 'minipayment:properties',
	),
	array(
		'name' => 'action',
		'desc' => 'prop_minipayment.action',
		'type' => 'list',
		'options' => array(
			array('text' => 'getForm','value' => 'getForm'),
			array('text' => 'createOperation','value' => 'createOperation'),
			array('text' => 'getOperation','value' => 'getOperation'),
			array('text' => 'updateOperation','value' => 'updateOperation'),
		),
		'value' => 'getForm',
		'lexicon' => 'minipayment:properties',
	),
);

return $properties;