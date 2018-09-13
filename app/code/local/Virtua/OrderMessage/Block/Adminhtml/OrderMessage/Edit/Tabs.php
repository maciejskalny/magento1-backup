<?php

class Virtua_OrderMessage_Block_Adminhmtl_OrderMessage_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::_construct();
        $this->setId('ordermessage_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('ordermessage')->__('News Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
           'label' => Mage::helper('ordermessage')->__('Item Information'),
           'title' => Mage::helper('ordermessage')->__('Item Information'),
           'content' => $this->getLayout()->createBlock('ordermessage/adminhtml_ordermessage_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}
