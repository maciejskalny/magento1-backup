<?php
/**
 * This file is responsible for joining topic and message columns to orders grid.
 *
 * PHP version 7.1.21
 *
 * @category  Grid
 * @package   Virtua_Internship
 * @author    Maciej Skalny <contact@wearevirtua.com>
 * @copyright 2018 Copyright (c) Virtua (http://wwww.wearevirtua.com)
 * @license   GPL http://opensource.org/licenses/gpl-license.php
 * @link      https://bitbucket.org/wearevirtua/magento1ms/
 */

/**
 * Class Virtua_OrderMessage_Test_Block_Adminhtml_Order_Grid
 */
class Virtua_OrderMessage_Test_Block_Adminhtml_Order_Grid extends Mage_Adminhtml_Block_Sales_Order_Grid
{
    protected function _prepareCollection()
    {
        $collection   = Mage::getResourceModel($this->_getCollectionClass());
        $itemModel    = Mage::getModel('sales/order_item');
        $itemResource = $itemModel->getResource();
        $ordermessage = $itemResource->getTable('ordermessage/ordermessage');

        $collection
            ->getSelect()
            ->joinLeft(
                array('ordermessage' => $ordermessage),
                'main_table.entity_id = ordermessage.order_id',
                array(
                    'order_message' => 'message',
                    'topic'         => 'topic_id'
                )
            );

        $this->setCollection($collection);

        return Mage_Adminhtml_Block_Widget_Grid::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumnAfter('topic', array(
            'header' => Mage::helper('Sales')->__('Topic'),
            'width'  => '100px',
            'index'  => 'topic',
            'type'   => 'text',
            'filter_index' => 'ordermessage.topic',
        ), 'shipping_name');

        $this->addColumnAfter('message', array(
            'header' => Mage::helper('Sales')->__('Message'),
            'width'  => '100px',
            'index'  => 'order_message',
            'type'   => 'text',
            'filter_index' => 'ordermessage.message',
        ), 'topic');

        return parent::_prepareColumns();
    }
}
