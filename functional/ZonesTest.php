<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
require_once 'common.php';

class ZonesTest extends PHPUnit_Extensions_SeleniumTestCase {

	protected function setUp() {
		$this->setBrowserUrl(BROWSER_URL);
	}

	public function testEmptyZoneList() {
		Common::doLogin();

        $this->clickAndWait("link=List zones");
        $this->verifyTextPresent('There are no zones to show in this listing.');
	}

    public function testAddMasterZone() {
        Common::doLogin();
        Common::doAddMasterZone('poweradmin.org');
        $this->verifyTextPresent("poweradmin.org - Zone has been added successfully.");
    }

    public function testRemoveZone() {
        Common::doLogin();
        Common::doRemoveZone('poweradmin.org');
        $this->verifyTextPresent("Zone has been deleted successfully.");
    }

    public function testAddSlaveZone() {
        Common::doLogin();

        $this->clickAndWait("link=Add slave zone");
        $this->type("domain", "poweradmin.org");
        $this->type("slave_master", "127.0.0.1");
        $this->clickAndWait("submit");

        $this->verifyTextPresent("Zone has been added successfully.");

        Common::doRemoveZone("poweradmin.org");
    }

    public function testNonEmptyZoneList() {
        Common::doLogin();

        Common::doAddMasterZone('poweradmin.org');
        Common::doAddMasterZone('poteradmin.org');

        $this->clickAndWait("link=List zones");
        $this->verifyTextPresent('poweradmin.org');
        $this->verifyTextPresent('poteradmin.org');

        Common::doRemoveZone('poweradmin.org');
        Common::doRemoveZone('poteradmin.org');
    }

    public function testAddMultipleMasterZones() {
        Common::doLogin();

        $this->clickAndWait("link=Add master zone");
        $this->type("domain_1", "poweradmin.org");
        $this->click("css=input.button");
        $this->type("domain_2", "poteradmin.org");
        $this->clickAndWait("submit");

        $this->verifyTextPresent("poweradmin.org - Zone has been added successfully.");
        $this->verifyTextPresent("poteradmin.org - Zone has been added successfully.");

        Common::doRemoveZone('poweradmin.org');
        Common::doRemoveZone('poteradmin.org');
    }

    public function testBulkRegistrationSingleZone() {
        Common::doLogin();

        $this->clickAndWait("link=Bulk registration");
        $this->type("domains", "poweradmin.org");
        $this->clickAndWait("submit");

        $this->verifyTextPresent("poweradmin.org - Zone has been added successfully.");

        Common::doRemoveZone('poweradmin.org');
    }

    public function testBulkRegistrationMultipleZones() {
        Common::doLogin();

        $this->clickAndWait("link=Bulk registration");
        $this->type("domains", "poweradmin.org\npoteradmin.org\n");
        $this->clickAndWait("submit");

        $this->verifyTextPresent("poweradmin.org - Zone has been added successfully.");
        $this->verifyTextPresent("poteradmin.org - Zone has been added successfully.");

        Common::doRemoveZone('poweradmin.org');
        Common::doRemoveZone('poteradmin.org');
    }

    public function testBulkRegistrationWrongZone() {
        Common::doLogin();

        $this->clickAndWait("link=Bulk registration");
        $this->type("domains", "poweradmin.dot");
        $this->clickAndWait("submit");

        $this->verifyTextPresent("Error: You are using an invalid top level domain.");
        $this->verifyTextPresent("Error: poweradmin.dot failed - Invalid hostname.");
    }

    public function testBulkRegistrationCorrectAndWrongZone() {
        Common::doLogin();

        $this->clickAndWait("link=Bulk registration");
        $this->type("domains", "poweradmin.dot\npoweradmin.org");
        $this->clickAndWait("submit");

        $this->verifyTextPresent("Error: You are using an invalid top level domain.");
        $this->verifyTextPresent("Error: poweradmin.dot failed - Invalid hostname.");
        $this->verifyTextPresent("poweradmin.org - Zone has been added successfully.");

        Common::doRemoveZone('poweradmin.org');
    }
} 

?>
