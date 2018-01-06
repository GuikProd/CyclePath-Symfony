Feature: As a normal user, I want to play with my profile.
  First, I want to test if I can update my personals information.

  Background:
    Given I load following users:
      | username     | plainPassword | firstname | lastname | email           | validationToken       | validated  | active |
      | HelloWorld   | Ie1FDLGHW     | Hello     | World    | hello@gmail.com | AZERTYQWERTY          | true       | true   |
      | Titi         | Ie1FDLTITI    | Titi      | Titi     | titi@gmail.com  | helloworldfromTiti    | false      | false  |

  Scenario: First, I want to test if I can update my personals information.

  Scenario: Final, I want to delete my account.
    When I send the following GraphQL request:
    """
    mutation DeleteUser {
        removeUser(id: 1) {
            id
        }
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "data.removeUser.id" should be null
