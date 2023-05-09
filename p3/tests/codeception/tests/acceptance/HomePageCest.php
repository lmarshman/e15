<?php

class HomePageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function showHomePage(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/');

        $I->see('CityRoutes');
        $I->see('View your Locations');

        $I->click('[test=locations-button]');
        $I->amOnPage('/list');

    }

    public function homePageDiscover(AcceptanceTester $I)
    {

        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/');

        $I->see('CityRoutes');

        $I->click('[test=discover-link]');
        $I->amOnPage('/pages/discover/cities');

    }
    public function homePageAdd(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/');

        $I->click('[test=add-link]');
        $I->amOnPage('/pages//addLocation/new');

    }
}
