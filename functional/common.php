<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class Common {

    public static function doLogin($selenium, $password = 'admin', $script = '') {
        $selenium->open(SERVER_PATH . $script);
        $selenium->type('username', 'admin');
        $selenium->type('password', $password);
        $selenium->click('authenticate');
        $selenium->waitForPageToLoad('30000');
    }

    public static function doChangePassword($selenium, $old, $new) {
        $selenium->click('link=Change password');
        $selenium->waitForPageToLoad('30000');
        $selenium->type('currentpass', $old);
        $selenium->type('newpass', $new);
        $selenium->type('newpass2', $new);
        $selenium->clickAndWait('submit');
    }

    public static function doAddMasterZone($selenium, $zone) {
        $selenium->clickAndWait('link=Add master zone');
        $selenium->type('domain_1', $zone);
        $selenium->clickAndWait('submit');
    }

    public static function doAddZoneRecord($selenium, $zone, $name, $content) {
        $selenium->clickAndWait('link=List zones');
        $selenium->clickAndWait("css=img[alt=\"[ View zone $zone ]\"]");
        $selenium->type('name', $name);
        $selenium->type('content', $content);
        $selenium->clickAndWait("xpath=(//input[@name='commit'])[2]");
        $selenium->verifyTextPresent('The record was successfully added.');
    }

    public static function doRemoveZone($selenium, $zone) {
        $selenium->open(SERVER_PATH . 'list_zones.php');
        $selenium->clickAndWait('css=img[alt="[ Delete zone '.$zone.' ]"]');
        $selenium->clickAndWait('css=input.button');
    }

}
