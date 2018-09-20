<?php

class Virtua_GuestBook_Model_Observer
{
    public function crontask()
    {
        //foreach dla wszystkich maili pobranych z bazy

        $test = 'Cos dziadlsadpmasokdpasmdopamsiodpmasimdmasiod';
        Mage::log($test, null, 'crontest.log', true);
        $mail = Mage::getModel('core/email')
            ->setToEmail('m.skalny@wearevirtua.com')
            ->setBody('Testowa wiadomosc')
            ->setSubject('Jakis temat')
            ->setFromEmail('office@magentoms.com')
            ->setFromName('Magentoms')
            ->setType('html');

        $mail->send();
    }
}