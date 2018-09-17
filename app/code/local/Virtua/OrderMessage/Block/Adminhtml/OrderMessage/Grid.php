<?php
/**
 * This file is preparing columns for orders grid.
 *
 * PHP version 7.1.21
 *
 * @category  Grid
 * @package   Virtua_Internship
 * @author    Maciej Skalny <contact@wearevirtua.com>
 * @copyright 2018 Copyright (c) Virtua (http://wwww.wearevirtua.com)
 * @license   GPL http://opensource.org/licenses/gpl-license.php
 * @link      https://bitbucket.org/wearevirtua/magento1ms/
 */

/**
 * Class Virtua_OrderMessage_Block_Adminhtml_OrderMessage_Grid
 */
class Virtua_OrderMessage_Block_Adminhtml_OrderMessage_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('ordermessage/ordermessagetopic')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * @param $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('virtua_ordermessage_admin/ordermessage/edit', array('id' => $row->getId()));
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     * @throws Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumn('topic_id', array(
            'header' => Mage::helper('ordermessage')->__('ID'),
            'index'  => 'topic_id'
        ));

        $this->addColumn('topic', array(
            'header' => Mage::helper('ordermessage')->__('Topic'),
            'index'  => 'topic'
        ));

        return parent::_prepareColumns();
    }
}
