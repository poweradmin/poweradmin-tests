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

    public function testAddRecordToZoneTemplate() {
        Common::doLogin();

        $this->clickAndWait("link=List zone templates");
        $this->clickAndWait("css=img[alt=\"[ Edit template ]\"]");
        $this->verifyTextPresent('This template zone does not have any records yet.');
        $this->clickAndWait("css=div.content > input.button");

        $this->type("name", "www");
        $this->type("content", "[ZONE]");
        $this->clickAndWait("commit");
        $this->verifyTextPresent('The record was successfully added.');
    }

    public function testUseZoneTemplate() {
        $this->markTestIncomplete();

        Common::doLogin();

        $this->clickAndWait("link=Add master zone");
        $this->type("domain_1", "poweradmin.org");
        $this->select("zone_template", "label=www");
        $this->clickAndWait("submit");

        $this->clickAndWait("link=List zones");
        $this->clickAndWait("css=img[alt=\"[ View zone poweradmin.org ]\"]");

        //TODO: how to check such dynamic field?
        //$this->verifyValue("name=record[190][content]", "poweradmin.org");

        Common::doRemoveZone('poweradmin.org');
    }

    public function testRecordFromZoneTemplate() {
        Common::doLogin();

        $this->clickAndWait("link=List zone templates");
        $this->clickAndWait("css=img[alt=\"[ Edit template ]\"]");
        $this->clickAndWait("css=img[alt=\"[ Delete record ]\"]");
        $this->clickAndWait("css=input.button");
        $this->verifyTextPresent('The record has been deleted successfully.');
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
