Feature: As a normal user, I want to register and log myself.
  First, I need to create an account.
  Second, I need to log as a recent registered user.

  Background:
    Given I load following users:
      | username     | plainPassword | firstname | lastname | email           | validationToken | validated | active |
      | HelloWorld   | Ie1FDLGHW     | Hello     | World    | hello@gmail.com | AZERTYQWERTY    | true      | true   |

  Scenario: First, I need to create an account.
    When I send the following GraphQL request:
    """
    {
        mutation Register {
          registerUser(email: "eyututu@test.fr", username: "tueiapa,", password: "OPPOP") {
            id
            username
            email
          }
        }
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "data.registerUser.id" should not be null
    And the JSON node "data.registerUser.username" should not be null
    And the JSON node "data.registerUser.email" should not be null

  Scenario: Second, I need to log as a recent registered user.
    When I send the following GraphQL request:
    """
    {
        mutation Login {
            login(email: "hello@gmail.com", password: "Ie1FDLGHW") {
                username
                email
                apiToken
            }
        }
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "data.login.username" should not be null
    And the JSON node "data.login.email" should not be null
    And the JSON node "data.login.apiToken" should not be null
