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
        Common::doAddMasterZone('poweradmin.com');
        $this->verifyTextPresent("poweradmin.com - Zone has been added successfully.");
    }

    public function testRemoveZone() {
        Common::doLogin();
        Common::doRemoveZone('poweradmin.com');
        $this->verifyTextPresent("Zone has been deleted successfully.");
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

} 

?>
