<?php

class AddBookInvalidCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/books/create');

        $I->fillField('[name=slug]', 'test-wrong-test');
        $I->fillField('[name=title]', 'Test Wrong Test');
        $I->selectOption('[name=author_id]', '1');
        $I->fillField('[name=published_year]', 'nineteen');
        $I->fillField('[name=cover_url]', 'cover_url.com');
        $I->fillField('[name=info_url]', 'info_url.com');
        $I->fillField('[name=purchase_url]', 'purchase_url.com');
        $I->fillField('[name=description]', 'Lorem vestibulum.');
        $I->click('[test=create-book-link]');

        $I->see('The published year must be 4 digits.');
        $I->see('The description must be at least 100 characters.');

    }
}
