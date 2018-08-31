<?php
/**
 * Atwix
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category    Emailorder
 * @package     Emailorder_ExtendedGrid
 * @author      Maciej Skalny <m.skalny@wearevirtua.com>
 * @copyright   Copyright (c) 2014 Atwix (http://www.atwix.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Emailorder_ExtendedGrid_Model_Observer
{

    public function coreBlockAbstractToHtmlBefore(Varien_Event_Observer $observer) {
        /** @var $block Mage_Core_Block_Abstract */
        $block = $observer->getEvent()->getBlock();
        if ($block->getId() == 'sales_order_grid') {
            $block->addColumnAfter('email', array(
                'header' => Mage::helper('Sales')->__('Email'),
                'width' => '110px',
                'index' => 'email',
                'type' => 'text',
            ), 'full_address');
        }
    }

    public function salesOrderGridCollectionLoadBefore(Varien_Event_Observer $observer) {
        $collection = $observer->getEvent()->getOrderGridCollection();
        $select = $collection->getSelect();
        $select->joinLeft(array('mail' => $collection->getTable('sales/order_address')), 'mail.entity_id=main_table.entity_id', array('email' => 'email'));
    }

//    /**
//     * Joins extra tables for adding custom columns to Mage_Adminhtml_Block_Sales_Order_Grid
//     * @param Varien_Object $observer
//     * @return Emailorder_Exgrid_Model_Observer
//     */
////    public function salesOrderGridCollectionLoadBefore($observer)
////    {
////        $collection = $observer->getOrderGridCollection();
////        $select = $collection->getSelect();
////        $select->joinLeft(array('payment' => $collection->getTable('sales/order_payment')), 'payment.parent_id=main_table.entity_id', array('payment_method' => 'method'));
////        $select->join('sales_flat_order_item', '`sales_flat_order_item`.order_id=`main_table`.entity_id', array('skus' => new Zend_Db_Expr('group_concat(`sales_flat_order_item`.sku SEPARATOR ", ")')));
////        $select->group('main_table.entity_id');
////    }
//
//    public function salesOrderGridCollectionLoadBefore($observer)
//    {
//        $collection = $observer->getOrderGridCollection();
//        $select = $collection->getSelect();
//        $select->joinLeft(array('mail' => $collection->getTable('sales/order_address')), 'mail.entity_id=main_table.entity_id', array('email' => 'email'));
//        $collection->getSelect()
//            ->join(
//                'customer_entity',
//                'main_table.customer_id = customer_entity.entity_id',
//                array('customer_name' => 'email')
//            );
//        //$select->join('sales_flat_order_item', '`sales_flat_order_item`.order_id=`main_table`.entity_id', array('skus' => new Zend_Db_Expr('group_concat(`sales_flat_order_item`.sku SEPARATOR ", ")')));
//        //$select->group('main_table.entity_id');
//    }
//
////    public function salesOrderGridCollectionLoadBefore($observer)
////    {
////        $collection = $observer->getOrderGridCollection();
////        $select = $collection->getSelect();
////        //$select->join('customer_entity', 'main_table.customer_id = customer_entity.entity_id', array('customer_name' => 'email'));
////        $select->joinLeft(array('payment' => $collection->getTable('custommer_entity')), 'main_table.customer_id=customer_id.entity_id', array('customer_name' => 'email'));
////        $select->join(
////            'sales_flat_order_address',
////            '`sales_flat_order_address`.email=`customer_id`.email',
////            array(
////                'skus' => new Zend_Db_Expr('group_concat(`sales_flat_order_address`.sku SEPARATOR ", ")')
////            )
////        );
////        $select->group('customer_id.entity_id');
////    }
//
//    /**
//     * callback function used to filter collection
//     * @param $collection
//     * @param $column
//     * @return $this
//     */
//    public function filterSkus($collection, $column)
//    {
//        if (!$value = $column->getFilter()->getValue()) {
//            return $this;
//        }
//        $collection->getSelect()->having(
//            "group_concat(`sales_flat_order_address`.sku SEPARATOR ', ') like ?", "%$value%");
//        return $this;
//    }
}