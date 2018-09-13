<?php

class Virtua_OrderMessage_Block_Adminhtml_OrderMessage_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setId('ordermessageGrid');
        $this->setDefaultSort('topic_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('ordermessage/ordermessagetopic')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('topic_id', array(
           'header' => Mage::helper('ordermessage')->__('Topic ID'),
           'index' => 'topic_id'
        ));

        $this->addColumn('topic', array(
            'header' => Mage::helper('ordermessage')->__('Topic'),
            'index' => 'topic'
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
