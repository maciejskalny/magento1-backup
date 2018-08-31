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
    /**
     * Joins extra tables for adding custom columns to Mage_Adminhtml_Block_Sales_Order_Grid
     * @param $observer
     */
    public function salesOrderGridCollectionLoadBefore($observer)
    {
        $collection = $observer->getOrderGridCollection();
        $select = $collection->getSelect();
        $collection->getSelect()->join('sales_flat_order', 'main_table.entity_id = sales_flat_order.entity_id',array('customer_email'));
    }
}
