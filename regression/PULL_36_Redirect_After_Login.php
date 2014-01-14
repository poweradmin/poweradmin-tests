<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
require_once 'functional/common.php';

class PULL_36_Redirect_After_Login extends PHPUnit_Extensions_SeleniumTestCase {

    protected function setUp() {
        $this->setBrowserUrl(BROWSER_URL);
    }

    // https://github.com/internetjanitor/poweradmin/commit/d246af7425bb4b1cb3c2fbad7712cdd5e587214e
    public function testRedirect() {
        Common::doLogin('admin', 'list_zones.php');
        $this->verifyTextPresent('There are no zones to show in this listing.');
    }

    // https://github.com/internetjanitor/poweradmin/commit/96b217beb03d8313e0d34d2ae1cc9a2a25299232
    public function testRedirectWithParams() {
        Common::doLogin('admin', 'edit_user.php?id=1');
        $this->verifyTextPresent('Edit user "Administrator"');
    }

}
