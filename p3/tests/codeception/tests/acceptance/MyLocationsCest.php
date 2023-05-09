<?php

class MyLocationsCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/test/refresh-database');
    }

    // tests
    public function ListPageLoads(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/list');

        // $I->seeElement('[test=Location-header]');

        // $I->amOnPage('/login');

        // $I->fillField('[name=email]', 'jill@harvard.edu');
        // $I->fillField('[name=password]', 'asdfasdf');
        // $I->click('[test=login-button]');

        // $I-see('Jill Harvard');

        // $I->click('[test=locations-button]');

        // $I->amOnPage('/list');

        // $I->see('My Locations');
    }
}