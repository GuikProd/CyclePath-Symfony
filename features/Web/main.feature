Feature:
  In order to prove that the application works
  and that every endpoints are available.

  Scenario: I send a request to the homepage
    When i send a request to "/" with "GET" method and Blackfire enabled
    Then the response should be received and the status code should be 301

  Scenario: I send a request to the homepage with the locale
    When i send a request to "/en/" with "GET" method and Blackfire enabled
    Then the response should be received and the status code should be 200
