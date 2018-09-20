<?php
/**
 * This file is an event observer.
 *
 * PHP version 7.1.21
 *
 * @category  Observer
 * @package   Virtua_Internship
 * @author    Maciej Skalny <contact@wearevirtua.com>
 * @copyright 2018 Copyright (c) Virtua (http://wwww.wearevirtua.com)
 * @license   GPL http://opensource.org/licenses/gpl-license.php
 * @link      https://bitbucket.org/wearevirtua/magento1ms/
 */

/**
 * Class Virtua_GuestBook_Model_Observer
 */
class Virtua_GuestBook_Model_Observer
{
    /**
     * Sending emails to guests in guest book.
     */
    public function welcomeEmail()
    {
        $model = Mage::getModel('guestbook/guestbook');
        $guests = $model->getCollection()->getData();

        foreach ($guests as $guest) {
            if ($guest['welcome_email_send'] == 'no') {
                $mail = Mage::getModel('core/email')
                    ->setToEmail($guest['email'])
                    ->setBody('Hello, have a nice day!')
                    ->setSubject('Magento1ms guest book')
                    ->setFromEmail('office@magentoms.com')
                    ->setFromName('Magentoms')
                    ->setType('html');
                $mail->send();
                $guest['is_welcome_email_send'] = 'yes';
            }
        }
    }
}
