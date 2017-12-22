Feature:
  In order to test the main pages, I need to
  send multiples request using the locale and the correct methods.

  Scenario: I want to test the homepage
    When a demo scenario sends a request to "/"
    Then the response should be received

  Scenario: I want to test the homepage using the locale
    When a demo scenario sends a request to "/fr/"
    Then the response should be received

  Scenario: I want to test the contact page
    When a demo scenario sends a request to "/fr/contact"
    Then the response should be received
