Feature: As a registered User, I want to manage my account credentials.
  As a normal user, I want to ask for a reset token in order to reset my password with bad credentials.
  As a normal user, I want to ask for a reset token in order to reset my password with good credentials.
  As a normal user, I want to reset my password using wrong email.
  As a normal user, I want to reset my password using wrong reset token.
  As a normal user, I want to reset my password using good credentials.

  Background:
    Given I load following users:
      | username     | plainPassword | firstname | lastname | email           | validationToken    | resetToken     | validated  | active |
      | HelloWorld   | Ie1FDLGHW     | Hello     | World    | hello@gmail.com | AZERTYQWERTY       | Ie1FDLGTITHU   | true       | true   |
      | Titi         | Ie1FDLTITI    | Titi      | Titi     | titi@gmail.com  | helloworldfromTiti | LBGELTIJD?AOA  | false      | false  |

  Scenario: As a normal user, I want to ask for a reset token in order to reset my password with bad credentials.
    Given I send the following GraphQL request:
    """
    mutation resetTokenPasswordWithBadCredentials {
        forgot_password(username: "HelloW", email: "hello@gmail.com") {
            username
            email
            resetToken
        }
    }
    """
    Then the response status code should be 400
    And the response should be in JSON
    And the JSON node "error.code" should be equal to 400
    And the JSON node "error.message" should be equal to "Oops, looks like this crendetials aren't valid ! Please check your entries."

  Scenario: As a normal user, I want to ask for a reset token in order to reset my password with good credentials.
    Given I send the following GraphQL request:
    """
    mutation resetTokenPasswordWithGoodCredentials {
        forgot_password(username: "HelloWorld", email: "hello@gmail.com") {
            username
            email
            resetToken
        }
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node "data.forgot_password.username" should be equal to "HelloWorld"
    And the JSON node "data.forgot_password.email" should be equal to "hello@gmail.com"
    And the JSON node "data.forgot_password.resetToken" should not be null

  Scenario: As a normal user, I want to reset my password using wrong email.
    Given I send the following GraphQL request:
    """
    mutation resetPasswordWithWrongEmail {
        reset_password(email: "hello@gmail.co", resetToken: "Ie1FDLGTITHU", password: "Ie1FDLTHU") {
            username
            email
        }
    }
    """
    Then the response status code should be 400
    And the response should be in JSON
    And the JSON node "error.code" should be equal to 400
    And the JSON node "error.message" should be equal to "Oops, looks like this crendetials aren't valid ! Please check your entries."

  Scenario: As a normal user, I want to reset my password using wrong resetToken.
    Given I send the following GraphQL request:
    """
    mutation resetPasswordWithWrongEmail {
        reset_password(email: "hello@gmail.com", resetToken: "Ie1FDLGT", password: "Ie1FDLTHU") {
            username
            email
        }
    }
    """
    Then the response status code should be 400
    And the response should be in JSON
    And the JSON node "error.code" should be equal to 400
    And the JSON node "error.message" should be equal to "Oops, looks like this crendetials aren't valid ! Please check your entries."

  Scenario: As a normal user, I want to reset my password using good credentials.
    Given I send the following GraphQL request:
    """
    mutation resetPasswordWithWrongEmail {
        reset_password(email: "hello@gmail.com", resetToken: "Ie1FDLGTITHU", password: "Ie1FDLTHU") {
            username
            email
        }
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node "data.reset_password.username" should be equal to "HelloWorld"
    And the JSON node "data.reset_password.email" should be equal to "hello@gmail.com"
