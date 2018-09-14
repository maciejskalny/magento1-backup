<?php

class Virtua_OrderMessage_Block_Adminhtml_OrderMessage_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'virtua_ordermessage_admin/ordermessage/save',
                array(
                    '_current' => true,
                    'continue' => 0,
                )
            ),
            'method' => 'post',
        ));

        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset('ordermessage_form', array('legend'=>Mage::helper('ordermessage')->__('Topic information')));
        $fieldset->addField('topic', 'text', array(
            'label' => Mage::helper('ordermessage')->__('Topic'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'topic',
        ));

        if (Mage::getSingleton('adminhtml/session')->getOrderMessageData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getOrderMessageData());
            Mage::getSingleton('adminhtml/session')->setOrderMessageData(null);
        } elseif (Mage::registry('ordermessage_data')) {
            $form->setValues(Mage::registry('ordermessage_data')->getData());
        }

        return parent::_prepareForm();
    }
}