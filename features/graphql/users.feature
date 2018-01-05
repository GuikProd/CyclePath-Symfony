@graphql_users
Feature: I want to test the user endpoint.
  First, I want to test if I can see all the users.
  Second, I want to test if I can see a single user using his email.


  Background:
    Given I load following users:
      | username     | plainPassword | firstname | lastname | email           | validationToken | validated | active |
      | HelloWorld   | Ie1FDLGHW     | Hello     | World    | hello@gmail.com | AZERTYQWERTY    | true      | true   |

  Scenario: First, I want to test if I can see all the users.
    Given I send the following GraphQL request:
    """
    {
        user {
            id
            firstname
            lastname
            email
        }
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"

  Scenario: Second, I want to test if I can see a single user using his email.
    Given I send the following GraphQL request:
    """
    {
        user(email: 'hello@gmail.com') {
            id
            firstname
            lastname
            email
        }
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
