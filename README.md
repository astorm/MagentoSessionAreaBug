MagentoSessionAreaBug
=====================

A module demonstrating Magento's problems with sessions, areas, and early events.

After installing the module load the following URL in your system

    http://magento.example.com/index.php/pulsestorm_sessionareabug

After loading the above URL, take a look at your session cookie names.  You should see the default PHP cookie name and **not** a cookie named `frontend` or `adminhtml`.  While seemingly innocent, this effectivly combines the admin area and frontend area session cookies, which will lead to other, hard to track down problems with Magento (such as not being able to log in to backend area without clearing cookies)
