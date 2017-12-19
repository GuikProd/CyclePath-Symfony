Feature:
  In order to test the main pages of the application, I need to test the entrypoints.

  Scenario: I go to the homepage
    When I am on "/"
    Then the response status code should be 200

  Scenario: I want to see the French version
    When I am on "/fr/"
    Then the response status code should be 200

  Scenario: I want to see the English version
    When I am on "/en/"
    Then the response status code should be 404
