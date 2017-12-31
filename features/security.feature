Feature: I want to ensure that every security endpoint is available.

  Scenario: [Bad case] I want to test the login form with bad credentials
    When I am on "/fr/"
    And I go to "/fr/login"
    Then I fill in "_username" with "Toto"
    Then I fill in "_password" with "Toto"
    And I press "login"
    Then the response status code should be 200

  Scenario: [Good case] I want to test the login form with good credentials
    When I am on "/fr/"
    And I go to "/fr/login"
    Then I fill in "_username" with "Toto"
    And I fill in "_password" with "Ie1FDLTOTO"
    And I press "login"
    Then the response status code should be 200
    Then I should be on "/fr/"

  Scenario: [Bad case] I want to create a new account with bad credentials
    When I am on "/fr/"
    And I go to "/fr/register"
    Then I fill in "register_username" with "ti"
    And I fill in "register_email" with "ti@gmail.com"
    And I fill in "register_plainPassword" with "to"
    And I press "Create an account"
    Then I should be on "/fr/register"
    And I should see "This value is too short"

  Scenario: [Good case] I want to create a new account with good credentials
    When I am on "/fr/"
    And I go to "/fr/register"
    Then I fill in "register_username" with "Eksi"
    And I fill in "register_email" with "eksi@gmail.com"
    And I fill in "register_plainPassword" with "Ie1FDLEKSI"
    And I press "Create an account"
    Then I should be on "/fr/"
    And the response status code should be 200
