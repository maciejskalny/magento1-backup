<?php
/**
 * Module block which supports admin panel.
 *
 * PHP version 7.1.21
 *
 * @category  Block
 * @package   Virtua_Internship
 * @author    Maciej Skalny <contact@wearevirtua.com>
 * @copyright 2018 Copyright (c) Virtua (http://wwww.wearevirtua.com)
 * @license   GPL http://opensource.org/licenses/gpl-license.php
 * @link      https://bitbucket.org/wearevirtua/magento1ms/
 */

/**
 * Class Virtua_OrderMessage_Block_Adminhtml_OrderMessage_Edit_Form
 */
class Virtua_OrderMessage_Block_Adminhtml_OrderMessage_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form([
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'virtua_ordermessage_admin/ordermessage/save',
                [
                    '_current' => true,
                    'continue' => 0,
                ]
            ),
            'method' => 'post',
        ]);

        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset(
            'ordermessage_form',
            ['legend'=>Mage::helper('ordermessage')->__('Topic information')]
        );
        $fieldset->addField('topic', 'text', [
            'label'    => Mage::helper('ordermessage')->__('Topic'),
            'class'    => 'required-entry',
            'required' => true,
            'name'     => 'topic',
        ]);

        if (Mage::getSingleton('adminhtml/session')->getOrderMessageData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getOrderMessageData());
            Mage::getSingleton('adminhtml/session')->setOrderMessageData(null);
        } elseif (Mage::registry('ordermessage_data')) {
            $form->setValues(Mage::registry('ordermessage_data')->getData());
        }

        return parent::_prepareForm();
    }
}
