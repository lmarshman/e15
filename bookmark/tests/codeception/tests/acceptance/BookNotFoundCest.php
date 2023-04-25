<?php

class BookNotFoundCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/books/harry-potter-and-the-philosophers-dillemma');

        $I->see('Book not found');

        $I->click('Check out the other books in our library...');
        $I->see('All Books');

        $resultCount = count($I->grabMultiple('[test=new-book-link]'));
        $I->assertEquals(3, $resultCount);
    }
}
