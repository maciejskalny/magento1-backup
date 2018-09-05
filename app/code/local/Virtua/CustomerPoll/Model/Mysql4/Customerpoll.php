<?php

class Virtua_CustomerPoll_Model_Mysql4_Customerpoll extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
       // parent::_construct();
        $this->_init('customerpoll/customerpoll', 'option_id');
    }
}