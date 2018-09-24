<?php
/**
 * This file is an event observer.
 *
 * PHP version 7.1.21
 *
 * @category  Module
 * @package   Virtua_Internship
 * @author    Maciej Skalny <contact@wearevirtua.com>
 * @copyright 2018 Copyright (c) Virtua (http://wwww.wearevirtua.com)
 * @license   GPL http://opensource.org/licenses/gpl-license.php
 * @link      https://bitbucket.org/wearevirtua/magento1ms/
 */

/**
 * Class Virtua_CustomersCsv_Model_Observer
 */
class Virtua_CustomersCsv_Model_Observer
{
    /**
     * Exports customers to csv file.
     */
    public function export()
    {
        if (Mage::getStoreConfig('customerscsv_config/customerscsv_group/enabling', Mage::app()->getStore()) == true) {
            $customers = Mage::getModel('customer/customer')->getCollection()
                ->addAttributeToSelect('firstname')
                ->addAttributeToSelect('lastname')
                ->addAttributeToSelect('email');

            $filename = Mage::getBaseDir('var') . DS . 'log' . DS . 'customers.csv';
            $fh = fopen($filename, "w+");

            foreach ($customers as $customer) {
                $row = $customer['firstname'] . ' ' . $customer['lastname'] . ' ' . $customer['email'];
                fwrite($fh, $row . "\n");
            }
            fclose($fh);
        }
    }
}
