<?php

class Virtua_OrderMessage_Block_Adminhtml_OrderMessage extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function _construct()
    {
        parent::_construct();

        $this->_blockGroup = 'ordermessage';
        $this->_controller = 'adminhtml_ordermessage';
        $this->_headerText = Mage::helper('ordermessage')->__('Item Manager');
    }

    public function getCreateUrl()
    {
        return $this->getUrl('virtua_ordermessage_admin/ordermessage/edit');
    }
}
