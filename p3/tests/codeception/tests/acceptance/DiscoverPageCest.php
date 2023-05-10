<?php

class DiscoverPageCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/test/refresh-database');
    }

    // tests
    public function DiscoverReviewLoads(AcceptanceTester $I)
    {

        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/pages/discover/cities');

        $I->see('Discover new places');

        $city = 'Boston';
        $I->fillField('[name=city]', $city);
        $I->click('[test=discover-btn]');

        $I->see('Old North Church');

        $I->click('Check out Reviews for Old North Church');

        $I->see('Get here early to avoid the crouds!');
    }
    public function AddReview(AcceptanceTester $I)
    {

        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/pages/discover/cities');

        $I->see('Discover new places');

        $city = 'Boston';
        $I->fillField('[name=city]', $city);
        $I->click('[test=discover-btn]');

        $I->see('Old North Church');

        $I->click('Check out Reviews for Old North Church');

        $review="I love old north church.";
        $I->fillField('[name=review]', $review);

        $I->click('[test=create-review-button]');

        $I->see('Your Review has been added');

        $I->see('I love old north church.');
    }
}