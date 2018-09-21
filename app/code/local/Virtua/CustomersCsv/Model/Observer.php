<?php

class Virtua_CustomersCsv_Model_Observer
{
    public function export()
    {
        $customers = Mage::getModel('customer/customer')->getCollection()
            ->addAttributeToSelect('firstname')
            ->addAttributeToSelect('lastname')
            ->addAttributeToSelect('email');

        $filename = Mage::getBaseDir('var') . DS . 'log' . DS . 'customers.csv';
        $fh = fopen($filename, "w+");

        foreach ($customers as $customer) {
            $row = $customer['firstname'].' '.$customer['lastname'].' '.$customer['email'];
            fwrite($fh, $row."\n");
        }

        fclose($fh);
    }


}

//$filename = Mage::getBaseDir('var') . DS . 'log' . DS . 'customers.csv';
//$fh = fopen($filename, "a+");
//fwrite($filename, 'dasdasdasdsad');
//fclose($fh);