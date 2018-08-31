<?php
/**
 * This file is a class which supports adding email field to orders grid.
 *
 * PHP version 7.1.21
 *
 * @category  Class
 * @package   Virtua_Internship
 * @author    Maciej Skalny <contact@wearevirtua.com>
 * @copyright 2018 Copyright (c) Virtua (http://wwww.wearevirtua.com)
 * @license   GPL http://opensource.org/licenses/gpl-license.php
 * @link      https://bitbucket.org/wearevirtua/magento1ms
 */

/**
 * Class Emailorder_ExtendedGrid_Model_Resource_Sales_Order_Grid_Collection
 */
class Emailorder_ExtendedGrid_Model_Resource_Sales_Order_Grid_Collection extends Mage_Sales_Model_Resource_Order_Grid_Collection
{
    /**
     * Get SQL for get record count
     *
     * @return Varien_Db_Select
     */
    public function getSelectCountSql()
    {
        $countSelect = parent::getSelectCountSql();
        if (Mage::app()->getRequest()->getControllerName() == 'sales_order') {
            $countSelect->reset(Zend_Db_Select::GROUP);
            $countSelect->reset(Zend_Db_Select::COLUMNS);
            $countSelect->columns("COUNT(DISTINCT main_table.entity_id)");
            $havingCondition = $countSelect->getPart(Zend_Db_Select::HAVING);
            if (count($havingCondition)) {
                $countSelect->where(
                    str_replace("group_concat(`sales_flat_order_address`.sku SEPARATOR ', ')", 'sales_flat_order_address.sku', $havingCondition[0])
                );
                $countSelect->reset(Zend_Db_Select::HAVING);
            }
        }
        return $countSelect;
    }
    /**
     * Init select
     * @return Mage_Core_Model_Resource_Db_Collection_Abstract
     */
    protected function _initSelect()
    {
        $this->addFilterToMap('store_id', 'main_table.store_id')
            ->addFilterToMap('created_at', 'main_table.created_at')
            ->addFilterToMap('updated_at', 'main_table.updated_at');
        return parent::_initSelect();
    }
}