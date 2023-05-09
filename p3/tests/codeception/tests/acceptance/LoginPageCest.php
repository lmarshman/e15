<?php

class LoginPageCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/test/refresh-database');
    }

    // tests
    public function pageLoads(AcceptanceTester $I)
    {
        $I->amOnPage('/login');

        $I->see('Login');
        $I->seeElement('#email');
    }

    public function userCanRegister(AcceptanceTester $I)
    {
        # Act
        $name = 'Test User';
        $I->amOnPage('/register');
        $I->fillField('[test=name-input]', $name);
        $I->fillField('[test=email-input]', 'test@email.com');
        $I->fillField('[test=password-input]', 'asdfasdf');
        $I->fillField('[test=password-confirmation-input]', 'asdfasdf');
        $I->click('[test=register-button]');

        $I->amOnPage('/test/meta');
        $metaData = json_decode($I->grabPageSource(), true);

    }

    public function userCanLogIn(AcceptanceTester $I)
    {
        # Act
        $I->amOnPage('/login');

        $I->fillField('[name=email]', 'jill@harvard.edu');
        $I->fillField('[name=password]', 'asdfasdf');
        $I->click('[test=login-button]');

        $I->see('Jill Harvard');

        $I->seeElement('[test=user-welcome]');

        $I->see('Logout');
    }

    public function registrationIsValidated(AcceptanceTester $I)
    {
        # Act
        $name = 'Test User';
        $I->amOnPage('/register');
        $I->fillField('[test=name-input]', $name);
        $I->fillField('[test=email-input]', 'jill@harvard.edu');
        $I->fillField('[test=password-input]', 'asdfasdf');
        $I->fillField('[test=password-confirmation-input]', 'asdfasdf');
        $I->click('[test=register-button]');

        # Assert
        $I->see('The email has already been taken.');
    }

    public function userCanLogout(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/');
        $I->seeElement('[test=logout-button]');
        // $I->click('[test=logout-button]');
        // $I->seeElement('[test=login-link]');
    }
}