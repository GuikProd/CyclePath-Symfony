Feature: I want to ensure that every security endpoint is available.

  Scenario: [Bad case] I want to test the login form with good credentials
    When I am on "/fr/"
    And I go to "/fr/login"
    Then I fill in "_username" with "Toto"
    And I fill in "_password" with "Ie1FDLTOTO"
    And I press "login"
    Then the response status code should be 200

  Scenario: [Good case] I want to see my personal dashboard with bad credentials
    When I am on "/fr/"
    And I go to "/fr/login"
    Then I fill in "_username" with "Toto"
    And I fill in "_password" with "Toto"
    And I press "login"
    Then the response status code should be 200
    Then I go to "/fr/dashboard"
    And I should be on "/fr/login"
    Then the response status code should be 200
