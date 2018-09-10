<?php
/**
 * This file is a block, which supports customer poll.
 *
 * PHP version 7.1.21
 *
 * @category  Block
 * @package   Virtua_Internship
 * @author    Maciej Skalny <contact@wearevirtua.com>
 * @copyright 2018 Copyright (c) Virtua (http://wwww.wearevirtua.com)
 * @license   GPL http://opensource.org/licenses/gpl-license.php
 * @link      https://bitbucket.org/wearevirtua/magento1ms/
 */

/**
 * Class Virtua_CustomerPoll_Block_CustomerPoll
 */
class Virtua_CustomerPoll_Block_CustomerPoll extends Mage_Core_Block_Template
{
    /**
     * Returns poll results
     * @return array
     */
    public function getResults()
    {
        $model = Mage::getModel('customerpoll/customerpoll');
        $collection = $model->getCollection();

        $count = $collection->addFieldToFilter('customerpoll_id', 1)->addFieldToFilter('option', array('in' => array('yes','no')))->getColumnValues('count');

        $answers = array(
            'yes' => $count[0],
            'no' => $count[1]
        );

        return $answers;
    }
}
