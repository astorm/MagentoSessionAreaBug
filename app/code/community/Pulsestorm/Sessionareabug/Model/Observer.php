<?php
class Pulsestorm_Sessionareabug_Model_Observer
{
    public function earlySession($observer)
    {
        if(strpos(implode($_SERVER), 'pulsestorm_sessionareabug/index/special') !== false)
        {
            Mage::getSingleton('core/session');
        }
    }
}    