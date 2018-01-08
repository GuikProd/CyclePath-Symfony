Feature: As a normal user, I want to register, validate my account and log myself.
  I need to see if I can create an account with missing email.
  I need to see if I can register an user with an existing email
  I need to see if I can register an user with an existing username
  I need to see if I can create an account with all the parameters.
  I want to validate an account with bad credentials.
  I want to validate an account with good credentials.
  I need to see if I can log with wrong credentials.
  I need to see if I can log with a wrong account.
  I need to see if I can log with good credentials.
  Background:
    Given I load following users:
      | username     | plainPassword | firstname | lastname | email           | validationToken    | resetToken     | validated  | active |
      | HelloWorld   | Ie1FDLGHW     | Hello     | World    | hello@gmail.com | AZERTYQWERTY       | Ie1FDLGTITHU   | true       | true   |
      | Titi         | Ie1FDLTITI    | Titi      | Titi     | titi@gmail.com  | helloworldfromTiti | LBGELTIJD?AOA  | false      | false  |

  Scenario: I need to see if I can create an account with missing email
    Given I send the following GraphQL request:
    """
    mutation RegisterWithoutEmail {
        registerUser(username: "HelloWorld", password: "Ie1FDLHEGW") {
            id
            username
            email
        }
    }
    """
    Then the response status code should be 400
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "error.code" should be equal to 400
    And the JSON node "error.message" should be equal to "The sent request is invalid, missing parameters !"

  Scenario: I need to see if I can register an user with an existing email
    Given I send the following GraphQL request:
    """
    mutation RegisterWithAnExistingEmailAndUsername {
        registerUser(email: "hello@gmail.com", username: "HelloWorld", password: "Ie1FDLGHW") {
            id
            username
            email
        }
    }
    """
    Then the response status code should be 400
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "error.code" should be equal to 400
    And the JSON node "error.message" should be equal to "Oops, this credentials already exist !"

  Scenario: I need to see if I can register an user with an existing username
    Given I send the following GraphQL request:
    """
    mutation RegisterWithAnExistingEmailAndUsername {
        registerUser(email: "test@gmail.com", username: "HelloWorld", password: "Ie1FDLGHW") {
            id
            username
            email
        }
    }
    """
    Then the response status code should be 400
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "error.code" should be equal to 400
    And the JSON node "error.message" should be equal to "Oops, this credentials already exist !"

  Scenario: I need to see if I can create an account with all the parameters.
    Given I send the following GraphQL request:
    """
    mutation RegisterWithAllParameters {
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

  Scenario: I want to validate an account with bad credentials.
    Given I send the following GraphQL request:
    """
    mutation ValidateUserWithWrongCredentials {
        validateUser(email: "titi@gmail.com", validationToken: "helloworl") {
            id
            username
            validated
        }
    }
    """
    Then the response status code should be 400
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "error.code" should be equal to 400
    And the JSON node "error.message" should be equal to "Oops, looks like this credentials aren't valid !"

  Scenario: I want to validate an account with good credentials.
    When I send the following GraphQL request:
    """
    mutation ValidateUserWithGoodCredentials {
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

  Scenario: I need to see if I can log with wrong credentials.
    When I send the following GraphQL request:
    """
    mutation LoginWithWrongCredentials {
        login (email: "hello@gmail.com", password: "titititi") {
            username
            email
            apiToken
        }
    }
    """
    Then the response status code should be 400
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "error.code" should not be null
    And the JSON node "error.message" should not be null
    And the JSON node "error.code" should be equal to 400
    And the JSON node "error.message" should be equal to "Oops, looks like this credentials aren't valid !"

  Scenario: I need to see if I can log with a wrong account.
    When I send the following GraphQL request:
    """
    mutation LoginWithWrongAccount {
        login (email: "tutut@gmail.com", password: "tutu") {
            username
            email
            apiToken
        }
    }
    """
    Then the response status code should be 400
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "error.code" should not be null
    And the JSON node "error.message" should not be null
    And the JSON node "error.code" should be equal to 400
    And the JSON node "error.message" should be equal to "Oops, looks like this credentials does not exist !"

  Scenario: I need to see if I can log with good credentials
    When I send the following GraphQL request:
    """
    mutation LoginWithGoodCredentials {
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
