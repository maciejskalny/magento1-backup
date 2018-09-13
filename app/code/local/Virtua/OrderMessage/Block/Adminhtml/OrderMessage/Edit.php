<?php

class Virtua_OrderMessage_Block_Adminhtml_OrderMessage_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::_construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'ordermessage';

        $this->_controller = 'adminhtml_ordermessage';
        $this->_updateButton('save', 'label', Mage::helper('ordermessage')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('ordermessage')->__('Delete Item'));
    }

    public function getHeaderText()
    {
        if(Mage::registry('ordermessage_data') && Mage::registry('ordermessage_data')->getId()) {
            return Mage::helper('ordermessage')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('ordermessage_data')->getTitle()));
        } else {
            return Mage::helper('ordermessage')->__('Add Item');
        }
    }
}
