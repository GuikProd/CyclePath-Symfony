Feature:
  In order to prove that the GraphQL API is correctly installed and configured

  Scenario: I send a request to the GraphQL endpoint
    When i send a request to "/api/" with "GET" method.
    Then the response should be received
    Then the response status code should be 400

  Scenario: I send a request to the GraphiQL endpoint
    When i send a request to "/api/graphiql" with "GET" method.
    Then the response should be received
    Then the response status code should be 200

  Scenario: I send a request to the GraphQL Batch endpoint
    When i send a request to "/api/batch" with "GET" method.
    Then the response should be received
    Then the response status code should be 400

  Scenario: I send a request to the GraphiQL Query endpoint
    When i send a request to "/api/graphiql/Query" with "GET" method.
    Then the response should be received
    Then the response status code should be 200

  Scenario: I send a request to the GraphiQL Mutations endpoint
    When i send a request to "/api/graphiql/Mutations" with "GET" method.
    Then the response should be received
    Then the response status code should be 200

  Scenario: I send a request to the GraphQL Query endpoint
    When i send a request to "/api/graphql/Query" with "POST" method.
    Then the response should be received
    Then the response status code should be 400

  Scenario: I send a request to the GraphQL Mutations endpoint
    When i send a request to "/api/graphql/Mutations" with "POST" method.
    Then the response should be received
    Then the response status code should be 400
