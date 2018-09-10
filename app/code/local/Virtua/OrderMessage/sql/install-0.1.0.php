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

if (!$installer->tableExists('customerpoll/customerpoll')) {
    $table = $installer->getConnection()->newTable($installer->getTable('customerpoll'))
        ->addColumn('option_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11,
            array(
                'unsigned' => true,
                'nullable' => false,
                'primary' => true,
                'identity' => true,
            ), 'Option ID')
        ->addColumn('customerpoll_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11,
            array(
                'nullable' => false,
            ), 'Poll ID')
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
}

if (!$installer->tableExists('customerpoll/customerpollquestions')) {
    $table = $installer->getConnection()->newTable($installer->getTable('customerpollquestions'))
        ->addColumn('customerpoll_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11,
            array(
                'unsigned' => true,
                'nullable' => false,
                'primary' => true,
                'identity' => true,
            ), 'Poll ID')
        ->addColumn('question', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255,
            array(
                'nullable' => false,
                'default' => '',
            ), 'Question');

    $installer->getConnection()->createTable($table);
}

$installer->endSetup();