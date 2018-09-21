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
     * Returns results of choosen poll
     * @param $question
     * @return array
     */
    public function getResults($question)
    {
        $collectionAnswers = Mage::getModel('customerpoll/customerpoll')->getCollection();
        $count = $collectionAnswers
            ->addFieldToFilter('customerpoll_id', $question)
            ->addFieldToFilter('option', ['in' => ['yes','no']])
            ->getColumnValues('count');

        $answers = [
            'yes' => $count[0],
            'no' => $count[1]
        ];

        return $answers;
    }

    /**
     * Returns array of all questions
     * @return array
     */
    public function getQuestions()
    {
        $questions = Mage::getModel('customerpoll/customerpollquestions')->getCollection()->getData();
        return $questions;
    }
}
