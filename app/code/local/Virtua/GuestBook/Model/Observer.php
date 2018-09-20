<?php

class Virtua_GuestBook_Model_Observer
{
    public function crontask()
    {
        $model = Mage::getModel('guestbook/guestbook');
        $emails = $model->getCollection()->getColumnValues('email');

        foreach ($emails as $email) {
            $mail = Mage::getModel('core/email')
                ->setToEmail('m.skalny@wearevirtua.com')
                ->setBody('Hello, have a nice day!')
                ->setSubject('Magento1ms guest book')
                ->setFromEmail('office@magentoms.com')
                ->setFromName('Magentoms')
                ->setType('html');
            $mail->send();
        }
    }
}
