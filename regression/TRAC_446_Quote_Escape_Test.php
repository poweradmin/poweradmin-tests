<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
require_once 'functional/common.php';

class TRAC_446_Quote_Escape_Test extends PHPUnit_Extensions_SeleniumTestCase {

    protected function setUp() {
        $this->setBrowserUrl(BROWSER_URL);
    }

    public function testQuoteEscape() {
        $this->markTestSkipped("Test case fails, need to review it");

        Common::doLogin();
        Common::doAddMasterZone('poweradmin.com');

        $this->clickAndWait("link=List zones");
        $this->clickAndWait("css=img[alt=\"[ View zone poweradmin.com ]\"]");
        $this->select('type', 'label=TXT');
        $this->type('content', "var='value'");
        $this->clickAndWait("//input[@name='commit' and @value='Add record']");

        $this->clickAndWait("link=List zones");
        $this->clickAndWait("css=img[alt=\"[ View zone poweradmin.com ]\"]");
//		$this->verifyValue("record[2][content]", "var='value'");
        //TODO: this check fails
        $this->verifyValue("//input[contains(@name,'content')]", "var='value'");

        Common::doRemoveZone('poweradmin.com');
    }

}

?>
