@testing_js
Feature:
  In order to test the main pages, I need to
  send multiples request using the locale and the correct methods.

  Scenario: I want to test the homepage
    When a demo scenario sends a request to "/"
    Then the response should be received
    Then the status code equals 301

  Scenario: I want to test the homepage using the locale
    When a demo scenario sends a request to "/fr/"
    Then the response should be received
    Then the status code equals 200

  Scenario: I want to test the contact page
    When a demo scenario sends a request to "/fr/contact"
    Then the response should be received
    Then the status code equals 200

  Scenario: Admit I want to go to the register page
    When I am on "/fr/register"
    When I fill in "register_username" with "Tata"
    Then I press "Create an account"
    And the response status code should be 200 
    Then I should be on "/fr/"
