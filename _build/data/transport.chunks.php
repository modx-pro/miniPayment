<?php
/**
 * Add chunks to build
 * 
 * @package minipayment
 * @subpackage build
 */
$chunks = array();

$chunks[0]= $modx->newObject('modChunk');
$chunks[0]->fromArray(array(
	'id' => 0,
	'name' => 'tpl.Payment.form',
	'description' => 'Chunk with payment form.',
	'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/payment_form.chunk.tpl'),
),'',true,true);

$chunks[1]= $modx->newObject('modChunk');
$chunks[1]->fromArray(array(
	'id' => 0,
	'name' => 'tpl.Payment.row',
	'description' => 'Chunk for templatimg one payment method in form',
	'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/method_row.chunk.tpl'),
),'',true,true);

return $chunks;