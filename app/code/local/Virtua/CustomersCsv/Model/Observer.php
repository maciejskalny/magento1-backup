<?php

class Virtua_CustomersCsv_Model_Observer
{
    public function export()
    {
        $customers = Mage::getModel('customer/customer')->getCollection()
            ->addAttributeToSelect('firstname')
            ->addAttributeToSelect('lastname')
            ->addAttributeToSelect('email');

        foreach ($customers as $customer) {
            Mage::log('dsad', null, 'export.log', true);
        }
    }
}