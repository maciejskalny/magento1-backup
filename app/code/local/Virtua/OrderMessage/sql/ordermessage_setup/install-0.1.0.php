<?php
/**
 * Installing module, creating tables in database.
 *
 * PHP version 7.1.21
 *
 * @category  Installer
 * @package   Virtua_Internship
 * @author    Maciej Skalny <contact@wearevirtua.com>
 * @copyright 2018 Copyright (c) Virtua (http://wwww.wearevirtua.com)
 * @license   GPL http://opensource.org/licenses/gpl-license.php
 * @link      https://bitbucket.org/wearevirtua/magento1ms/
 */

$installer = $this;
$installer->startSetup();

if (!$installer->tableExists('ordermessage/ordermessage')) {
    $table = $installer->getConnection()->newTable($installer->getTable('ordermessage'))
        ->addColumn('message_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11,
            array(
                'unsigned' => true,
                'nullable' => false,
                'primary' => true,
                'identity' => true,
            ), 'Message ID')
        ->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11,
            array(
                'nullable' => false,
            ), 'Order ID')
        ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11,
            array(
                'nullable' => false,
            ), 'Customer ID')
        ->addColumn('topic_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11,
            array(
                'nullable' => false,
            ), 'Topic ID')
        ->addColumn('message', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255,
            array(
                'nullable' => false,
                'default' => '',
            ), 'Message');

    $installer->getConnection()->createTable($table);
}

if (!$installer->tableExists('ordermessage/ordermessagetopic')) {
    $table = $installer->getConnection()->newTable($installer->getTable('ordermessagetopic'))
        ->addColumn('topic_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11,
            array(
                'unsigned' => true,
                'nullable' => false,
                'primary' => true,
                'identity' => true,
            ), 'Message ID')
        ->addColumn('topic', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255,
            array(
                'nullable' => false,
                'default' => '',
            ), 'Topic');

    $installer->getConnection()->createTable($table);
}

$installer->endSetup();