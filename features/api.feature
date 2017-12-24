Feature:
  In order to test GraphQL API, I need to test the entrypoints.

  Scenario: I want to test the API main entrypoint
    When a demo scenario sends a request to "/api/"
    Then the response should be received
    Then the status code equals 400

  Scenario: I want to test the GraphiQL entrypoint
    When a demo scenario sends a request to "/api/graphiql"
    Then the response should be received
    Then the status code equals 200

  Scenario: I want to test the batch entrypoint
    When a demo scenario sends a request to "/api/batch"
    Then the response should be received
    Then the status code equals 400
