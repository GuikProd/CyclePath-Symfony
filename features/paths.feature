Feature: I want to ensure that every user can access the paths page
  and perform actions.

  Scenario: [Bad case] I want to test the paths base page with bad route.
    When I am on "/fr/"
    And I go to "/fr/path"
    Then the response status code should be 404

  Scenario: [Good case] I want to test the paths base page with good route.
    When I am on "/fr/"
    And I go to "/fr/paths"
    Then the response status code should be 200

  Scenario: [Bad case] I want to see my personal paths without log myself.
    When I am on "/fr/"
    And I go to "/fr/paths"
    Then the response status code should be 200

  Scenario: [Good case] I want to see my personal paths as a logged user.
    When I am on "/fr/"
    And I go to "/fr/login"
    Then I fill in "_username" with "Toto"
    And I fill in "_password" with "Ie1FDLTOTO"
    And I press "Login"
    Then I should be on "/fr/"
    And I go to "/fr/paths"
    Then I should see "Hello !"
    Then the response status code should be 200
