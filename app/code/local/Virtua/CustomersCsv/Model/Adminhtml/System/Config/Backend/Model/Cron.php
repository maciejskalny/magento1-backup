<?php
/**
 * This file supports cron configuration in admin panel.
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
 * Class Virtua_CustomersCsv_Model_Adminhtml_System_Config_Backend_Model_Cron
 */
class Virtua_CustomersCsv_Model_Adminhtml_System_Config_Backend_Model_Cron extends Mage_Core_Model_Config_Data
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
        $time = $this->getData('groups/customerscsv_group/fields/time/value');
        $frequency = $this->getValue();

        $frequencyWeekly = Mage_Adminhtml_Model_System_Config_Source_Cron_Frequency::CRON_WEEKLY;
        $frequencyMonthly = Mage_Adminhtml_Model_System_Config_Source_Cron_Frequency::CRON_MONTHLY;

        $cronExprArray = [
            intval($time[1]),                                   # Minute
            intval($time[0]),                                   # Hour
            ($frequency == $frequencyMonthly) ? '1' : '*',      # Day of the Month
            '*',                                                # Month of the Year
            ($frequency == $frequencyWeekly) ? '1' : '*',       # Day of the Week
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
}
