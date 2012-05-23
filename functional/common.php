<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class Common {

	public function doLogin($password='admin') {
		$this->open(SERVER_PATH);
		$this->type('username', 'admin');
		$this->type('password', $password);
		$this->click('authenticate');
		$this->waitForPageToLoad("30000");
	}

	public function doChangePassword($old, $new) {
		$this->click("link=Change password");
		$this->waitForPageToLoad("30000");
		$this->type('currentpass', $old);
		$this->type('newpass', $new);
		$this->type('newpass2', $new);
		$this->clickAndWait("submit");
	}

	public function doAddMasterZone($zone) {
		$this->clickAndWait("link=Add master zone");
		$this->type('domain_1', $zone);
		$this->clickAndWait("submit");
	}

    public function doAddZoneRecord($zone, $name, $content) {
        $this->clickAndWait("link=List zones");
        $this->clickAndWait("css=img[alt=\"[ View zone $zone ]\"]");
        $this->type('name', $name);
        $this->type('content', $content);
        $this->clickAndWait("xpath=(//input[@name='commit'])[2]");
        $this->verifyTextPresent("The record was successfully added.");
    }

	public function doRemoveZone($zone) {
		$this->open(SERVER_PATH.'list_zones.php');
		$this->clickAndWait("css=img[alt=\"[ Delete zone $zone ]\"]");
		$this->clickAndWait("css=input.button");
	}
}

?>
