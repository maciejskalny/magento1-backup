<?php

class Virtua_OrderMessage_Block_Adminhtml_OrderMessage_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'ordermessage';
        $this->_controller = 'adminhtml_ordermessage';

        $this->_mode = 'edit';
        $newOrEdit = $this->getRequest()->getParam('id')
            ? $this->__('Edit')
            : $this->__('New');
        $this->_headerText = $newOrEdit . ' ' . $this->__('Topic');
    }
}
