<?php

/**
 * This file is responsible for joining email column to orders grid.
 *
 * PHP version 7.1.21
 *
 * @category  Module
 * @package   Virtua_Internship
 * @author    Maciej Skalny <contact@wearevirtua.com>
 * @copyright 2018 Copyright (c) Virtua (http://wwww.wearevirtua.com)
 * @license   GPL http://opensource.org/licenses/gpl-license.php
 * @link      https://bitbucket.org/wearevirtua/magento1ms/
 */

/**
 * Class Virtua_MailModule_Test_Block_Adminhtml_Order_Grid
 */
class Virtua_MailModule_Test_Block_Adminhtml_Order_Grid extends Mage_Adminhtml_Block_Sales_Order_Grid
{
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel($this->_getCollectionClass());

        $collection->getSelect()->join('customer_entity', 'main_table.customer_id = customer_entity.entity_id',array('customer_name' => 'email'));

        $this->setCollection($collection);

        return Mage_Adminhtml_Block_Widget_Grid::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        if (Mage::getStoreConfig('mailmodule_config/mailmodule_group/mailmodule_select', Mage::app()->getStore()) == true) {

            $this->addColumnAfter('thumbnail', array(
                'header' => Mage::helper('Sales')->__('Email'),
                'width' => '100px',
                'index' => 'customer_name',
                'type' => 'text',
                'filter_index' => 'customer_entity.email',
            ), 'shipping_name');
        }

        return parent::_prepareColumns();
    }
}