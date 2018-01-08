@graphql_users
Feature: I want to test the user endpoint.
  First, I want to test if I can see all the users.
  Second, I want to test if I can see a single user using his email.

  Background:
    Given I load following users:
      | username     | plainPassword | firstname | lastname | email           | validationToken    | resetToken     | validated  | active |
      | HelloWorld   | Ie1FDLGHW     | Hello     | World    | hello@gmail.com | AZERTYQWERTY       | Ie1FDLGTITHU   | true       | true   |
      | Titi         | Ie1FDLTITI    | Titi      | Titi     | titi@gmail.com  | helloworldfromTiti | LBGELTIJD?AOA  | false      | false  |

  Scenario: First, I want to test if I can see all the users.
    Given I send the following GraphQL request:
    """
    {
        user {
            id
            firstname
            lastname
            username
            email
        }
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "data.user" should not be null
    And the JSON node "data.user[0].id" should be equal to 1
    And the JSON node "data.user[0].firstname" should be equal to "Hello"
    And the JSON node "data.user[0].lastname" should be equal to "World"
    And the JSON node "data.user[0].username" should be equal to "HelloWorld"
    And the JSON node "data.user[0].email" should be equal to "hello@gmail.com"
    And the JSON node "data.user[1].id" should be equal to 2
    And the JSON node "data.user[1].firstname" should be equal to "Titi"
    And the JSON node "data.user[1].lastname" should be equal to "Titi"
    And the JSON node "data.user[1].username" should be equal to "Titi"
    And the JSON node "data.user[1].email" should be equal to "titi@gmail.com"

  Scenario: Second, I want to test if I can see a single user using his email.
    Given I send the following GraphQL request:
    """
    {
        user(email: "hello@gmail.com") {
            id
            firstname
            lastname
            username
            email
        }
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "data.user" should not be null
    And the JSON node "data.user[0].id" should be equal to 1
    And the JSON node "data.user[0].firstname" should be equal to "Hello"
    And the JSON node "data.user[0].lastname" should be equal to "World"
    And the JSON node "data.user[0].username" should be equal to "HelloWorld"
    And the JSON node "data.user[0].email" should be equal to "hello@gmail.com"
