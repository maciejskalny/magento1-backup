<?php
/**
 * This file supports Customers Csv configuration in admin panel.
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
 * Class Virtua_CustomersCsv_Model_Adminhtml_System_Config_Backend_Model_CustomersCsv
 */
class Virtua_CustomersCsv_Model_Adminhtml_System_Config_Backend_Model_CustomersCsv extends Mage_Core_Model_Config_Data
{
    /**
     * Constance which holds path to CustomersCsv crontab job.
     */
    const CRON_STRING_PATH = 'crontab/jobs/customerscsv_cron_task/schedule/cron_expr';

    /**
     * @return Mage_Core_Model_Abstract|void
     * @throws Exception
     */
    protected function _afterSave()
    {
        $this->setCron();

        $this->importCustomers();
    }

    public function setCron()
    {
        $time = $this->getData('groups/customerscsv_group/fields/time/value');
        $frequency = $this->getValue();

        $frequencyWeekly = Mage_Adminhtml_Model_System_Config_Source_Cron_Frequency::CRON_WEEKLY;
        $frequencyMonthly = Mage_Adminhtml_Model_System_Config_Source_Cron_Frequency::CRON_MONTHLY;

        $cronExprArray = [
            intval($time[1]),
            intval($time[0]),
            ($frequency == $frequencyMonthly) ? '1' : '*',
            '*',
            ($frequency == $frequencyWeekly) ? '1' : '*',
        ];
        $cronExprString = join(' ', $cronExprArray);

        try {
            Mage::getModel('core/config_data')
                ->load(self::CRON_STRING_PATH, 'path')
                ->setValue($cronExprString)
                ->setPath(self::CRON_STRING_PATH)
                ->save();
        } catch (Exception $e) {
            throw new Exception(Mage::helper('cron')->__('Unable to save the cron expression.'));
        }
    }

    public function importCustomers()
    {
        $importFile =  $this->getData('groups/customerscsv_import/fields/file/value');
        $importFileExtension = strrchr($importFile, '.');

        if ($importFileExtension == '.csv') {
            $fileName = Mage::getBaseDir('var') . DS . 'import' . DS . 'customers.csv';
            $fileContent = file_get_contents($fileName);

            foreach (file($fileName) as $line) {
                $array = explode(',', $line);
                $this->saveCustomer($array);
            }
        } else {
            Mage::getSingleton('core/session')->addError('Error! Wrong file extension!');
        }

        Mage::log($importFileExtension, null, 'system.log', true);
    }

    public function saveCustomer($customer)
    {
        $model = Mage::getModel('customer/customer');
        $websiteId = Mage::app()->getWebsite()->getId();
        $store = Mage::app()->getStore();

        $model
            ->setWebsiteId($websiteId)
            ->setStore($store)
            ->setFirstname($customer[0])
            ->setLastname($customer[1])
            ->setEmail($customer[2])
            ->setPassword($customer[3]);
        try {
            $model->save();
        } catch (Exception $e) {
            Mage::log($e->getMessage(), null, 'system.log', true);
        }
    }
}
