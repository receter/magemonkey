<?php

/**
 * Cron controller
 *
 * @category   Ebizmarts
 * @package    Ebizmarts_MageMonkey
 * @author     Ebizmarts Team <info@ebizmarts.com>
 * @license    http://opensource.org/licenses/osl-3.0.php
 */
class Ebizmarts_MageMonkey_CronController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $delay = rand(5, 60);

        sleep($delay);
        $numberResponse = rand(0, 1);
        if($numberResponse == 0){
            $responseCode = 500;
        }else{
            $responseCode = 200;
        }
        $data = array();
        $data['code'] = $responseCode;
        $data['delay'] = $delay;

        $this->getResponse()
            ->setHeader('Content-Type', 'application/json', true)
            ->setHttpResponseCode($responseCode)
            ->setBody(json_encode($data));
    }
}