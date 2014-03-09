<?php
class Pulsestorm_Sessionareabug_IndexController extends Mage_Core_Controller_Front_Action {
    public function _getMainContent()
    {
        $url = '/pulsestorm_sessionareabug/index/special';
        $url_admin = '/admin';
        $string = <<<CONTENT
<h1>Reproduction Steps</h1>        
<p><strong>Step 1</strong>: Clear all the cookies for your domain.</p>

<p><img src="http://alanstorm.com/2014/images/early-session-harmful/extension/step-1.png" border="0" width="800" height="398" /></p>

<p><strong>Step 2</strong>: Reload this page, and then view your cookies.  You should have a cookie named <code>frontend</code></p>

<p><img src="http://alanstorm.com/2014/images/early-session-harmful/extension/step-1.png" border="0" width="800" height="398" /></p>

<p><strong>Step 3</strong>: Load the <a href="$url_admin">admin login form</a>
 login form, and then view your cookies.  You should have a cookie named <code>adminhtml</code></p>

<p><img src="http://alanstorm.com/2014/images/early-session-harmful/extension/step-1.png" border="0" width="800" height="398" /></p>

<p><strong>Step 4</strong>: Load the <a href="$url">special page</a>.  There's an event observer configured for the "early" event.  In this observer, a <code>core/session</code> object is instantiated if the url matches the <a href="$url">special page</a>.  Now, view your cookies.</p>

<p><img src="http://alanstorm.com/2014/images/early-session-harmful/extension/step-1.png" border="0" width="800" height="398" /></p>

<p>A cookie named <code>PHPSESSID</code> is set.  The use of a session before Magento can determine the area (<code>frontend</code> or <code>adminhtml</code>) means the default session name is used, and so this special page ends up reading and writing from a different session ID.         </p>

<h2>Dumped <code>session_id()</code></h2>
CONTENT;
        $string .= '<pre>' . session_id() . '</pre>';
        return $string;
    }
    public function indexAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('content')->insert($this->getLayout()->createBlock('core/text')
            ->setText($this->_getMainContent()));
            
        $this->getLayout()->getBlock('root')->setTemplate('page/1column.phtml');            
        $this->renderLayout();
    }
    
    public function specialAction()
    {
        $session_id = session_id();
        $this->loadLayout();
        $this->getLayout()->getBlock('content')->insert($this->getLayout()->createBlock('core/text')
            ->setText('<p>An early observer instantiates a session on this page, which makes 
            Magento pull content from the <code>PHPSESSID</code> session instead of the 
            <code>frontend</code> session. </p>
            
            <h2>Dumped <code>session_id()</code></h2>
            <code>' . $session_id. ' </code>
            '));
        $this->renderLayout();    
    }
    
}