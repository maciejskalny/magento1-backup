<?php
/**
 * Customer Poll Questions model
 *
 * PHP version 7.1.21
 *
 * @category  Model
 * @package   Virtua_Internship
 * @author    Maciej Skalny <contact@wearevirtua.com>
 * @copyright 2018 Copyright (c) Virtua (http://wwww.wearevirtua.com)
 * @license   GPL http://opensource.org/licenses/gpl-license.php
 * @link      https://bitbucket.org/wearevirtua/magento1ms/
 */

/**
 * Class Virtua_CustomerPoll_Model_CustomerPollQuestions
 */
class Virtua_CustomerPoll_Model_CustomerPollQuestions extends Mage_Core_Model_Abstract
{
    /**
     * Class constructor
     */
    protected function _construct()
    {
        $this->_init('customerpoll/customerpollquestions');
    }
}