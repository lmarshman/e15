<?php

class AddBookCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/books/create');

        $I->fillField('[name=slug]', 'test-for-test');
        $I->fillField('[name=title]', 'Test for Test');
        $I->selectOption('[name=author_id]', '1');
        $I->fillField('[name=published_year]', '1989');
        $I->fillField('[name=cover_url]', 'cover_url.com');
        $I->fillField('[name=info_url]', 'info_url.com');
        $I->fillField('[name=purchase_url]', 'purchase_url.com');
        $I->fillField('[name=description]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem donec massa sapien faucibus et molestie ac feugiat sed. Sagittis aliquam malesuada bibendum arcu vitae elementum curabitur vitae nunc. Suscipit adipiscing bibendum est ultricies integer. Interdum velit euismod in pellentesque massa placerat duis ultricies lacus. Nulla aliquet enim tortor at. Blandit libero volutpat sed cras ornare arcu dui vivamus. Quisque non tellus orci ac. Sed viverra tellus in hac habitasse platea dictumst vestibulum.');
        $I->click('[test=create-book-link]');

        // $I->see('Your book was added.');
    }
}