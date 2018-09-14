<?php

class Virtua_OrderMessage_Block_Adminhtml_OrderMessage_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('ordermessage/ordermessagetopic')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('virtua_ordermessage_admin/ordermessage/edit', array('id' => $row->getId()));
    }

    protected function _prepareColumns()
    {
        $this->addColumn('topic_id', array(
            'header' => Mage::helper('ordermessage')->__('ID'),
            'index' => 'topic_id'
        ));

        $this->addColumn('topic', array(
            'header' => Mage::helper('ordermessage')->__('Topic'),
            'index' => 'topic'
        ));

        return parent::_prepareColumns();
    }
}
