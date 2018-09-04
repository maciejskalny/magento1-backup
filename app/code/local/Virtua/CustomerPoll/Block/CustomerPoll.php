<?php

class Virtua_CustomerPoll_Block_CustomerPoll extends Mage_Core_Block_Template
{
    public function myfunction()
    {
        $vote = Mage::app()->getRequest()->getParam('storepoll');

        if (!is_null($vote)) {
            if ($vote == "yes") {
            } else {
            }
        }
    }
}