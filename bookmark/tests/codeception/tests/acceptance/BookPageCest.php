<?php

class BookPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function individualBookPage(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/books/harry-potter-and-the-philosophers-stone');

        $I->see('Harry Potter and the Philosopher’s Stone');

        $I->seeElement('#title');

    }
}
