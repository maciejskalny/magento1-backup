<?php

class Virtua_OrderMessage_Block_Adminhtml_OrderMessage extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_ordermessage';
        $this->_blockGroup = 'ordermessage';
        $this->_headerText = Mage::helper('ordermessage')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('ordermessage')->__('Add Item');

        parent::_construct();
    }
}