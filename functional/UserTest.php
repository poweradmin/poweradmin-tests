<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
require_once 'common.php';

class UserTest extends PHPUnit_Extensions_SeleniumTestCase {

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

	public function testChangePassword() {
		Common::doLogin();
		Common::doChangePassword('admin', 'nimda');

		$this->verifyTextPresent("Password has been changed, please login.");

		// restore default password
		// FIXME: use database fixtures
		Common::doLogin('nimda');
		Common::doChangePassword('nimda', 'admin');
	}

    public function testIncorrectChangePassword() {
        Common::doLogin();
        Common::doChangePassword('nimda', 'admin');

        $this->verifyTextPresent("Error: You did not enter the correct current password.");
    }

    public function testCommitChanges() {
        Common::doLogin();

        $this->clickAndWait("link=User administration");
        $this->type("user[1][descr]","Uberuser");
        $this->clickAndWait("commit");
        $this->verifyValue("user[1][descr]", "Uberuser");

        // Restore
        $this->type("user[1][descr]","Administrator with full rights.");
        $this->clickAndWait("commit");
    }

    public function testAddUser() {
        Common::doLogin();

        $this->clickAndWait("link=User administration");
        $this->clickAndWait("link=Add user");

        $this->type("username","user");
        $this->type("fullname","User");
        $this->type("password","user");
        $this->type("email","user@poweradmin.org");
        $this->clickAndWait("commit");
        $this->verifyTextPresent("The user has been created successfully.");
    }

    public function testRemoveUser() {
        Common::doLogin();

        $this->clickAndWait("link=User administration");
        $this->clickAndWait("css=img[alt=\"[ Delete user ]\"]");
        $this->clickAndWait("commit");
        $this->verifyTextPresent("The user has been deleted successfully.");
    }

}

?>
