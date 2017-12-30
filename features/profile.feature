Feature: An user must authenticate itself before seeing his profile
  and obtain access to the resources locked.

  Scenario: [Bad case] I want to test the login form with bad credentials and trying to gain access to my profile.
    When I am on "/fr/"
    And I go to "/fr/login"
    Then I fill in "_username" with "Toto"
    And I fill in "_password" with "Ie1FDLTOTO"
    And I press "login"
    Then the response status code should be 200
    And I go to "/fr/profile"
    Then the response status code should be 404

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
