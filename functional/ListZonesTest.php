<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
require_once 'common.php';

class ListZonesTest extends PHPUnit_Extensions_SeleniumTestCase {

	protected function setUp() {
		$this->setBrowserUrl(BROWSER_URL);
	}

	public function testEmptyZoneList() {
		Common::doLogin();

        $this->clickAndWait("link=List zones");
        $this->verifyTextPresent('There are no zones to show in this listing.');
	}

    public function testNonEmptyZoneList() {
        Common::doLogin();

        Common::doAddMasterZone('poweradmin.org');
        Common::doAddMasterZone('poteradmin.org');

        $this->clickAndWait("link=List zones");
        $this->verifyTextPresent('poweradmin.org');
        $this->verifyTextPresent('poteradmin.org');
    }

} 

?>
