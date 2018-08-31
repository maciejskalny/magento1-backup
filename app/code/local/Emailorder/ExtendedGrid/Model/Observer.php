<?php
/**
 * This file is an observer, which is responsible for adding email field to orders grid.
 *
 * PHP version 7.1.21
 *
 * @category  Class, Observer
 * @package   Virtua_Internship
 * @author    Maciej Skalny <contact@wearevirtua.com>
 * @copyright 2018 Copyright (c) Virtua (http://wwww.wearevirtua.com)
 * @license   GPL http://opensource.org/licenses/gpl-license.php
 * @link      https://bitbucket.org/wearevirtua/magento1ms
 */

/**
 * Class Emailorder_ExtendedGrid_Model_Observer
 */
class Emailorder_ExtendedGrid_Model_Observer
{
    /**
     * Joins customer email field to orders grid.
     * @param $observer
     */
    public function salesOrderGridCollectionLoadBefore($observer)
    {
        $collection = $observer->getOrderGridCollection();
        $select = $collection->getSelect();
        $select->join('sales_flat_order', 'main_table.entity_id = sales_flat_order.entity_id',array('customer_email'));
    }
}