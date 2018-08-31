<?php

class Mage_CustomerEmailOrder_Model_Observer
{
    /**
     * Joins extra tables for adding custom columns to Mage_Adminhtml_Block_Sales_Order_Grid
     * @param Varien_Object $observer
     * @return Mage_CustomerEmailOrder_Model_Observer
     */
    public function salesOrderGridCollectionLoadBefore($observer)
    {
        $collection = $observer->getOrderGridCollection();
        $select = $collection->getSelect();
        $select->joinLeft(array('payment' => $collection->getTable('sales/order_payment')), 'payment.parent_id=main_table.entity_id', array('payment_method' => 'method'));
        $select->join('sales_flat_order_item', '`sales_flat_order_item`.order_id=`main_table`.entity_id', array('skus' => new Zend_Db_Expr('group_concat(`sales_flat_order_item`.sku SEPARATOR ", ")')));
        $select->group('main_table.entity_id');
    }

    /**
     * callback function used to filter collection
     * @param $collection
     * @param $column
     * @return $this
     */
    public function filterSkus($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return $this;
        }
        $collection->getSelect()->having(
            "group_concat(`sales_flat_order_item`.sku SEPARATOR ', ') like ?", "%$value%");
        return $this;
    }
}
