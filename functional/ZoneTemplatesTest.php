<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
require_once 'common.php';

class ZoneTemplatesTest extends PHPUnit_Extensions_SeleniumTestCase {

	protected function setUp() {
		$this->setBrowserUrl(BROWSER_URL);
	}

	public function testAddZoneTemplate() {
		Common::doLogin();

        $this->clickAndWait("link=List zone templates");
        $this->clickAndWait("link=Add zone template");
        $this->type("templ_name", "www");
        $this->type("templ_descr", "www");
        $this->clickAndWait("commit");
        $this->verifyTextPresent('Zone template has been added successfully.');
	}

    public function testRemoveZoneTemplate() {
        Common::doLogin();

        $this->clickAndWait("link=List zone templates");
        $this->clickAndWait("css=img[alt=\"[ Delete template ]\"]");
        $this->clickAndWait("css=input.button");
        $this->verifyTextPresent('Zone template has been deleted successfully.');
    }

} 

?>
