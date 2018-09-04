<?php

//die('SETUP');

$installer = $this;
$installer->startSetup();
//$installer->run("-- DROP TABLE IF EXISTS {$this->getTable('customerpoll')};
//CREATE TABLE {$this->getTable('customerpoll')} (
//    'option_id' int(11) unsigned NOT NULL auto_increment,
//    'option' varchar(255) NOT NULL,
//    'count' int(11) NOT NULL,
//    PRIMARY KEY ('option_id')
//    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
//");
$table = $installer->getConnection()->newTable($installer->getTable('customerpoll'))
    ->addColumn('option_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11,
        array(
         'unsigned' => true,
         'nullable' => false,
         'primary' => true,
         'identity' => true,
        ), 'Option ID')
    ->addColumn('option', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255,
        array(
        'nullable' => false,
        'default' => '',
            ), 'Option')
    ->addColumn('count', Varien_Db_Ddl_Table::TYPE_INTEGER, 11,
        array(
            'nullable' => false,
            'default' => '0',
        ), 'Count');

$installer->getConnection()->createTable($table);
$installer->endSetup();