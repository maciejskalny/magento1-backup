<?php

class MailModule_Test_Block_Adminhtml_Order_Grid extends Mage_Adminhtml_Block_Sales_Order_Grid
{
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel($this->_getCollectionClass());

        //$collection->join('sales_flat_order', 'main_table.entity_id = sales_flat_order.entity_id',array('customer_email'=>'customer_email'));

        //$collection->getSelect()->join('customer_entity', 'main_table.customer_id = customer_entity.entity_id', array('customer_name' => 'email'));

        //$collection->join('sales/order_item', 'order_id=entity_id', array('email'=>'email', 'sku' =>'sku', 'qty_ordered'=>'qty_ordered' ), null,'left');

        $collection->getSelect()->join('customer_entity', 'main_table.customer_id = customer_entity.entity_id',array('customer_name' => 'email'));

        $this->setCollection($collection);

        return;
    }

    protected function _prepareColumns()
    {
        $this->addColumn('thumbnail', array(
            'header' => Mage::helper('Sales')->__('Email'),
            'width' => '100px',
            'index' => 'customer_name',
            'type' => 'text',
            'filter_index' => 'sales_flat_order.customer_email',
            //'filter_index' => 'customer_entity.email',
            //‘filter_index’ => ‘sales_flat_order.customer_email’,
            ));

        return parent::_prepareColumns();
    }
}