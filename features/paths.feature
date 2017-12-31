Feature: I want to ensure that every user can access the paths page
  and perform actions.

  Scenario: [Bad case] I want to test the paths base page with bad route.
    When I go to "/fr/path"
    Then the response status code should be 404

  Scenario: [Good case] I want to test the paths base page with good route.
    When I am on "/fr/paths"
    Then the response status code should be 200
