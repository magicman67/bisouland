Feature: Logout
    In order to free the access to the application
    As a user
    I need to be able to logout

    Scenario: Successfully logout
        Given I am logged in as "to.logout"
        And I am on homepage

        When I follow "menu.logged_in.logout"

        Then I should see "menu.logged_out.login"
