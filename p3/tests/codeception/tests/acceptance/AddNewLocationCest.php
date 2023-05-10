<?php

class AddNewLocationCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/test/refresh-database');
    }

    // tests

    public function AddNewLocation(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/pages/addLocation/new');

        $I->see('Add a new location');

        $I->fillField('[test=add-name]', 'The Emerald Necklace Boston');
        $I->fillField('[test=add-address]', '73 Park Dr');
        $I->fillField('[test=add-city]', 'Boston');
        $I->fillField('[test=add-state]', 'MA');
        $I->fillField('[test=add-country]', 'United States');
        $I->fillField('[test=add-picture_url]', 'testurl.com');
        $I->fillField('[test=add-loc_url]', 'testurl.com');
        $I->fillField('[test=add-description]', 'The Emerald Necklace consists of a 1,100-acre chain of parks linked by parkways and waterways in Boston and Brookline, Massachusetts. It was designed by landscape architect Frederick Law Olmsted, and gets its name from the way the planned chain appears to hang from the "neck" of the Boston peninsula.');


        $I->click('[test=add-button]');

        $I->see('The location The Emerald Necklace Boston was added.');
    }

    public function AddNewLocationValidation(AcceptanceTester $I)
    {

        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/pages/addLocation/new');

        $I->see('Add a new location');

        $I->fillField('[test=add-name]', 'Fenway Park');
        $I->click('[test=add-button]');
        $I->see('The name has already been taken.');

    }
    public function AddNewLocationWholeFormValidation(AcceptanceTester $I)
    {

        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/pages/addLocation/new');

        $I->see('Add a new location');

        $I->fillField('[test=add-name]', '');
        $I->fillField('[test=add-address]', '');
        $I->fillField('[test=add-city]', '');
        $I->fillField('[test=add-state]', '');
        $I->fillField('[test=add-country]', '');
        $I->fillField('[test=add-picture_url]', '');
        $I->fillField('[test=add-loc_url]', '');
        $I->fillField('[test=add-description]', '');


        $I->click('[test=add-button]');

        $I->see('The name field is required.');
        $I->see('The address field is required.');
        $I->see('The city field is required.');
        $I->see('The country field is required.');
        $I->see('The picture url field is required.');
        $I->see('The loc url field is required.');
        $I->see('The picture url field is required.');
        $I->see('The description field is required.');
    }

    public function AddNewLocationStateValidation(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/pages/addLocation/new');

        $I->see('Add a new location');

        $I->fillField('[test=add-state]', 'Massachusetts');

        $I->click('[test=add-button]');

        $I->see('The state field must not be greater than 2 characters.');

    }
}