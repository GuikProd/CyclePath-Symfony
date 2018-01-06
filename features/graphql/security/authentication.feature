Feature: As a normal user, I want to register and log myself.
  First, I need to create an account.
  Second, I want to validate an account as a recent registered user.
  Third, I need to log as a recent registered user.

  Background:
    Given I load following users:
      | username     | plainPassword | firstname | lastname | email           | validationToken       | validated  | active |
      | HelloWorld   | Ie1FDLGHW     | Hello     | World    | hello@gmail.com | AZERTYQWERTY          | true       | true   |
      | Titi         | Ie1FDLTITI    | Titi      | Titi     | titi@gmail.com  | helloworldfromTiti    | false      | false  |

  Scenario: First, I need to create an account as a new user.
    When I send the following GraphQL request:
    """
    mutation Register {
        registerUser(email: "toto@test.fr", username: "toto", password: "toto") {
            id
            username
            email
        }
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "data.registerUser.id" should not be null
    And the JSON node "data.registerUser.username" should not be null
    And the JSON node "data.registerUser.email" should not be null
    And the JSON node "data.registerUser.id" should be equal to 3
    And the JSON node "data.registerUser.username" should be equal to "toto"
    And the JSON node "data.registerUser.email" should be equal to "toto@test.fr"

  Scenario: Second, I want to validate an account as a recent registered user.
    When I send the following GraphQL request:
    """
    mutation ValidateUser {
        validateUser(email: "titi@gmail.com", validationToken: "helloworldfromTiti") {
            id
            username
            validated
        }
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "data.validateUser.id" should be equal to 2
    And the JSON node "data.validateUser.username" should be equal to "Titi"
    And the JSON node "data.validateUser.validated" should be equal to true

  Scenario: Third, I need to log as a recent registered user.
    When I send the following GraphQL request:
    """
    mutation Login {
        login(email: "hello@gmail.com", password: "Ie1FDLGHW") {
            username
            email
            apiToken
        }
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "data.login.username" should not be null
    And the JSON node "data.login.email" should not be null
    And the JSON node "data.login.apiToken" should not be null
    And the JSON node "data.login.username" should be equal to "HelloWorld"
    And the JSON node "data.login.email" should be equal to "hello@gmail.com"
