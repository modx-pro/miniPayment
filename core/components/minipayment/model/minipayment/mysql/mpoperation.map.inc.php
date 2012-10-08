<?php
$xpdo_meta_map['mpOperation']= array (
  'package' => 'minipayment',
  'version' => '1.1',
  'table' => 'minipayment_operation',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'uid' => 0,
    'method' => 0,
    'sum' => 0,
    'status' => 0,
    'createdon' => '0000-00-00 00:00:00',
    'updatedon' => '0000-00-00 00:00:00',
    'description' => NULL,
    'data' => NULL,
  ),
  'fieldMeta' => 
  array (
    'uid' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'method' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'sum' => 
    array (
      'dbtype' => 'float',
      'precision' => '10,2',
      'phptype' => 'float',
      'null' => false,
      'default' => 0,
    ),
    'status' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'createdon' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => false,
      'default' => '0000-00-00 00:00:00',
    ),
    'updatedon' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => false,
      'default' => '0000-00-00 00:00:00',
    ),
    'description' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'data' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
  ),
);
