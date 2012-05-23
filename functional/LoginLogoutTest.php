<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
require_once 'common.php';

class LoginLogoutTest extends PHPUnit_Extensions_SeleniumTestCase {

	protected function setUp() {
		$this->setBrowserUrl(BROWSER_URL);
	}

	public function testSuccessfulLogin() {
		Common::doLogin();

		$this->verifyTextPresent('Welcome Administrator');
	}

    public function testUnsuccessfulLogin() {
        $this->open(SERVER_PATH);
        $this->type('username', 'admin1');
        $this->type('password', 'admin');
        $this->click('authenticate');
        $this->waitForPageToLoad("30000");

        $this->verifyTextPresent('Authentication failed!');
    }

    public function testSuccessfulLogout() {
        Common::doLogin();
        $this->clickAndWait('link=Logout');
        $this->verifyTextPresent('You have logged out.');
    }

} 

?>
