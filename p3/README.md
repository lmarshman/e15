# Project 3
+ By: *Laura Marshman*
+ Production URL: p3.lauramarshman.com

# Feature Summary
+ Visitors can register/log in
+ Visitors can search for “locations” by city via the Discover page and add them to their lists.
    + The page will return results from the database (locations entered by the user) as well as locations returned from an API called [OpenTripMap API](https://opentripmap.io/product). I had originally chosen this API because its documentation looked like the API returned a picture and description for most results. Unfortunately, once I started working with the API, I realized that wasn’t the case. In order to get those details, I would have had to go subscribe to an additional API. This felt like perhaps I was overloading my project with API’s. To work around this, I created an additional form page that pre-fills the name and address information for the location. The user is then asked to add a picture url, location website, and a description.
    +  My database seeders provide examples for Boston, San Francisco, and Tokyo. At the moment, my app is optimized for US locations, but you can search internationally and I wanted to provide examples of what that might look like.
    + Users are able to leave reviews for locations via the Discover page. 
+•	Users can add locations directly to the site via the Add a new location page.
    + Currently the add page is optimized for US locations. As a development opportunity, the page can be expanded to better handle international locations.
+ Users can add and delete locations from their list of locations. Additionally, a user can add notes they’d like to remember about the location.

# Database Summary
+ My application has 3 tables in total (users, locations, and reviews)
    + There's a many-to-many relationship between users and locations
    + There's a one-to-many relationship between reviews and locations

# Outside Resources
(https://rapidapi.com/blog/google-maps-geocoding-api/)
(https://rapidapi.com/opentripmap/api/places1)
(https://opentripmap.io/examples)
(https://code.tutsplus.com/tutorials/how-to-use-curl-in-php--cms-36732)
(https://levelup.gitconnected.com/elegantly-consuming-apis-using-data-transfer-objects-in-php-38ac4d8225a8)
(https://stackoverflow.com/questions/24857012/php-curl-vs-pecl-http)
(https://stackoverflow.com/questions/66185760/attempt-to-read-property-name-on-null)
(https://www.webdevsplanet.com/post/access-json-data-in-php)
(https://stackoverflow.com/questions/4976624/looping-through-all-the-properties-of-object-php)
(https://stackoverflow.com/questions/2471605/php-warning-undefined-property-stdclass-fix)
(https://stackoverflow.com/questions/28431742/class-app-models-test-not-found-when-try-to-access-model)
(https://stackoverflow.com/questions/72875444/indirect-modification-of-overloaded-property-app-models-userprofile-has-no-ef)
(https://stackoverflow.com/questions/43449746/showing-dropdown-value-in-laravel-form-select-list)

# Notes for Instructor
As noted in our meeting last week, I had intended to include a function that would generate a route to visit several of the users saved location. Unfortunately, this did not end up working out as hoped. I got stuck on accessing the location information from a form I created. I created a form that allowed the user to select up to 4 locations to visit via drop down menus. While I was able to get the drop-down menus to populate with the correct data, the form on the backend was not recognizing the selected data and was instead continuously redirecting back to the form. By the time I realized it wasn’t going to work out, I had run out of time. I’m disappointed but, it also leaves room for me to further develop the app and continue my learning beyond the class.

# Tests

```root@HES:/var/www/e15/p3/tests/codeception# codecept run acceptance --steps
Codeception PHP Testing Framework v4.2.2 https://helpukrainewin.org
Powered by PHPUnit 8.5.28 #StandWithUkraine

Acceptance Tests (16) ------------------------------------------------------------------------------------------------------------------
AddNewLocationCest: Add new location
Signature: AddNewLocationCest:AddNewLocation
Test: tests/acceptance/AddNewLocationCest.php:AddNewLocation
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/pages/addLocation/new"
 I see "Add a new location"
 I fill field "[test=add-name]","The Emerald Necklace Boston"
 I fill field "[test=add-address]","73 Park Dr"
 I fill field "[test=add-city]","Boston"
 I fill field "[test=add-state]","MA"
 I fill field "[test=add-country]","United States"
 I fill field "[test=add-picture_url]","testurl.com"
 I fill field "[test=add-loc_url]","testurl.com"
 I fill field "[test=add-description]","The Emerald Necklace consists of a 1,100-acre chain of parks linked by parkways and waterway..."
 I click "[test=add-button]"
 I see "The location The Emerald Necklace Boston was added."
 PASSED 

AddNewLocationCest: Add new location validation
Signature: AddNewLocationCest:AddNewLocationValidation
Test: tests/acceptance/AddNewLocationCest.php:AddNewLocationValidation
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/pages/addLocation/new"
 I see "Add a new location"
 I fill field "[test=add-name]","Fenway Park"
 I click "[test=add-button]"
 I see "The name has already been taken."
 PASSED 

AddNewLocationCest: Add new location whole form validation
Signature: AddNewLocationCest:AddNewLocationWholeFormValidation
Test: tests/acceptance/AddNewLocationCest.php:AddNewLocationWholeFormValidation
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/pages/addLocation/new"
 I see "Add a new location"
 I fill field "[test=add-name]",""
 I fill field "[test=add-address]",""
 I fill field "[test=add-city]",""
 I fill field "[test=add-state]",""
 I fill field "[test=add-country]",""
 I fill field "[test=add-picture_url]",""
 I fill field "[test=add-loc_url]",""
 I fill field "[test=add-description]",""
 I click "[test=add-button]"
 I see "The name field is required."
 I see "The address field is required."
 I see "The city field is required."
 I see "The country field is required."
 I see "The picture url field is required."
 I see "The loc url field is required."
 I see "The picture url field is required."
 I see "The description field is required."
 PASSED 

AddNewLocationCest: Add new location state validation
Signature: AddNewLocationCest:AddNewLocationStateValidation
Test: tests/acceptance/AddNewLocationCest.php:AddNewLocationStateValidation
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/pages/addLocation/new"
 I see "Add a new location"
 I fill field "[test=add-state]","Massachusetts"
 I click "[test=add-button]"
 I see "The state field must not be greater than 2 characters."
 PASSED 

DiscoverPageCest: Discover review loads
Signature: DiscoverPageCest:DiscoverReviewLoads
Test: tests/acceptance/DiscoverPageCest.php:DiscoverReviewLoads
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/pages/discover/cities"
 I see "Discover new places"
 I fill field "[name=city]","Boston"
 I click "[test=discover-btn]"
 I see "Old North Church"
 I click "Check out Reviews for Old North Church"
 I see "Get here early to avoid the crouds!"
 PASSED 

DiscoverPageCest: Add review
Signature: DiscoverPageCest:AddReview
Test: tests/acceptance/DiscoverPageCest.php:AddReview
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/pages/discover/cities"
 I see "Discover new places"
 I fill field "[name=city]","Boston"
 I click "[test=discover-btn]"
 I see "Old North Church"
 I click "Check out Reviews for Old North Church"
 I fill field "[name=review]","I love old north church."
 I click "[test=create-review-button]"
 I see "Your Review has been added"
 I see "I love old north church."
 PASSED 

HomePageCest: Show home page
Signature: HomePageCest:showHomePage
Test: tests/acceptance/HomePageCest.php:showHomePage
Scenario --
 I am on page "/test/login-as/1"
 I am on page "/"
 I see "CityRoutes"
 I see "View your Locations"
 I click "[test=locations-button]"
 I am on page "/list"
 PASSED 

HomePageCest: Home page discover
Signature: HomePageCest:homePageDiscover
Test: tests/acceptance/HomePageCest.php:homePageDiscover
Scenario --
 I am on page "/test/login-as/1"
 I am on page "/"
 I see "CityRoutes"
 I click "[test=discover-link]"
 I am on page "/pages/discover/cities"
 PASSED 

HomePageCest: Home page add
Signature: HomePageCest:homePageAdd
Test: tests/acceptance/HomePageCest.php:homePageAdd
Scenario --
 I am on page "/test/login-as/1"
 I am on page "/"
 I click "[test=add-link]"
 I am on page "/pages//addLocation/new"
 PASSED 

LoginPageCest: Page loads
Signature: LoginPageCest:pageLoads
Test: tests/acceptance/LoginPageCest.php:pageLoads
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/login"
 I see "Login"
 I see element "#email"
 PASSED 

LoginPageCest: User can register
Signature: LoginPageCest:userCanRegister
Test: tests/acceptance/LoginPageCest.php:userCanRegister
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/register"
 I fill field "[test=name-input]","Test User"
 I fill field "[test=email-input]","test@email.com"
 I fill field "[test=password-input]","asdfasdf"
 I fill field "[test=password-confirmation-input]","asdfasdf"
 I click "[test=register-button]"
 I am on page "/test/meta"
 I grab page source 
 PASSED 

LoginPageCest: User can log in
Signature: LoginPageCest:userCanLogIn
Test: tests/acceptance/LoginPageCest.php:userCanLogIn
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/login"
 I fill field "[name=email]","jill@harvard.edu"
 I fill field "[name=password]","asdfasdf"
 I click "[test=login-button]"
 I see "Jill Harvard"
 I see element "[test=user-welcome]"
 I see "Logout"
 PASSED 

LoginPageCest: Registration is validated
Signature: LoginPageCest:registrationIsValidated
Test: tests/acceptance/LoginPageCest.php:registrationIsValidated
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/register"
 I fill field "[test=name-input]","Test User"
 I fill field "[test=email-input]","jill@harvard.edu"
 I fill field "[test=password-input]","asdfasdf"
 I fill field "[test=password-confirmation-input]","asdfasdf"
 I click "[test=register-button]"
 I see "The email has already been taken."
 PASSED 

LoginPageCest: User can logout
Signature: LoginPageCest:userCanLogout
Test: tests/acceptance/LoginPageCest.php:userCanLogout
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/"
 I see element "[test=logout-button]"
 I click "[test=logout-button]"
 I see element "[test=login-link]"
 PASSED 

MyLocationsCest: List page loads
Signature: MyLocationsCest:ListPageLoads
Test: tests/acceptance/MyLocationsCest.php:ListPageLoads
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/list"
 I see element "[test=Location-header]"
 I see "My Locations"
 I see "Museum of Fine Arts Boston"
 PASSED 

MyLocationsCest: Delete list item
Signature: MyLocationsCest:DeleteListItem
Test: tests/acceptance/MyLocationsCest.php:DeleteListItem
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/list"
 I click "Delete Museum of Fine Arts Boston from your List"
 I see "Are you sure you want to delete Museum of Fine Arts Boston from your list?"
 I click "Yes, Delete Museum of Fine Arts Boston from my locations"
 I see "The location Museum of Fine Arts Boston was removed from your list"
 PASSED 

----------------------------------------------------------------------------------------------------------------------------------------


Time: 19.43 seconds, Memory: 18.66 MB

OK (16 tests, 38 assertions)
