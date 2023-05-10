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

        $I->seeElement('[test=Location-header]');

        $I->see('My Locations');

        $I->see('Museum of Fine Arts Boston');
    }
    public function DeleteListItem(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/list');

        $I->click('Delete Museum of Fine Arts Boston from your List');

        $I->see('Are you sure you want to delete Museum of Fine Arts Boston from your list?');

        $I->click('Yes, Delete Museum of Fine Arts Boston from my locations');

        $I->see('The location Museum of Fine Arts Boston was removed from your list');
    }
}
