<?php

class Virtua_CustomerPoll_Block_CustomerPoll extends Mage_Core_Block_Template
{
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
//
//        public function indexxAction()
//    {
//        $this->loadLayout();
//        $this->renderLayout();
//
//        $model = Mage::getModel('customerpoll/customerpoll');
//        $vote = Mage::app()->getRequest()->getParam('storepoll');
//
//        if ($vote == 'yes' || $vote == 'no') {
//            if (empty($model->load($vote, 'option')->getOrigData())) {
//                $data = array(
//                    'option' => $vote,
//                    'count' => 1
//                );
//                $model->setData($data)->save();
//            } else {
//                $count = (int)$model->load($vote, 'option')->getOrigData()['count'];
//                $count = $count + 1;
//                $model->load($vote, 'option')->setData('count', $count)->save();
//            }
//        }
//    }

}