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

        $yes = $model->load('yes', 'option')->getOrigData();
        $no = $model->load('no', 'option')->getOrigData();

        $answers = array(
            'yes' => $yes['count'],
            'no' => $no['count']
        );

        return $answers;
    }
}
