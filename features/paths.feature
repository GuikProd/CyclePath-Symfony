Feature: I want to ensure that every user can access the paths page
  and perform actions.

  Scenario: [Good case] I want to test the paths base page
    When I go to "/fr/paths"
    Then the response status code should be 200

  Scenario: [Good case] I want to test the paths base page
    When I am on "/fr/paths"
    Then the response status code should be 200
