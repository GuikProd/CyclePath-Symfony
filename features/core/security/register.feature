@register
Feature: I want to ensure that every security endpoint is available.
  First, I need to test that the register form throw an error if the username is too long.
  Second, I need to test that the register form throw an error if the username is too short.
  Third, I need to test that the register form throw an error if the username is empty (managed by HTML).
  Fourth, I need to test that the register form throw an error if the email is too long.
  Fifth, I need to test that the register form thrown an error if the email is invalid (managed by HTML).
  Sixth, I need to test that the register form throw an error if the email is empty (managed by HTML).
  Seventh, I need to test that the register form thrown an error if the password is too long.
  Eight, I need to test that the register form thrown an error if the password is too short.
  Ninth, I need to test that the register form thrown an error if the password is empty (managed by HTML).
  Tenth, I need to test that the register form thrown an error if the credentials already exists.
  Eleventh, I need to test that the register form is processed if the user send valid data.

  Background:
    Given I load following users:
      | username     | plainPassword | firstname | lastname | email           | validationToken | validated | active |
      | HelloWorld   | Ie1FDLGHW     | Hello     | World    | hello@gmail.com | AZERTYQWERTY    | true      | true   |
    When I am on "/fr/"
    And I go to "/fr/register"

  Scenario: First, I need to test that the register form throw an error if the username is too long
    Then I fill in "register_username" with "tititititititititititititi"
    And I fill in "register_email" with "ti@gmail.com"
    And I fill in "register_plainPassword" with "totooto"
    And I press "Créer un compte"
    Then I should be on "/fr/register"
    And I should see "This value is too long"
    Then the response status code should be 200

  Scenario: Second, I need to test that the register form throw an error if the username is too short.
    Then I fill in "register_username" with "ti"
    And I fill in "register_email" with "ti@gmail.com"
    And I fill in "register_plainPassword" with "totooto"
    And I press "Créer un compte"
    Then I should be on "/fr/register"
    And I should see "This value is too short"
    Then the response status code should be 200

  Scenario: Third, I need to test that the register form throw an error if the username is empty (managed by HTML).
    Then I fill in "register_username" with ""
    And I fill in "register_email" with "titi.com"
    And I fill in "register_plainPassword" with "to"
    And I press "Créer un compte"
    Then I should be on "/fr/register"
    And I should see "The required fields must be filled !"
    Then the response status code should be 200

  Scenario: Fourth, I need to test that the register form throw an error if the email is too long.
    Then I fill in "register_username" with "titi"
    And I fill in "register_email" with "titititititititititititititititititititititititititi@gmail.com"
    And I fill in "register_plainPassword" with "to"
    And I press "Créer un compte"
    Then I should be on "/fr/register"
    And I should see "This value is too long"
    Then the response status code should be 200

  Scenario: Fifth, I need to test that the register form thrown an error if the email is invalid (managed by HTML).
    Then I fill in "register_username" with "titi"
    And I fill in "register_email" with "titi.com"
    And I fill in "register_plainPassword" with "to"
    And I press "Créer un compte"
    Then I should be on "/fr/register"
    Then the response status code should be 200

  Scenario: Sixth, I need to test that the register form throw an error if the email is empty (managed by HTML).
    Then I fill in "register_username" with "Titi"
    And I fill in "register_email" with ""
    And I fill in "register_plainPassword" with "to"
    And I press "Créer un compte"
    Then I should be on "/fr/register"
    And I should see "The required fields must be filled !"
    Then the response status code should be 200

  Scenario: Seventh, I need to test that the register form thrown an error if the password is too long.
    Then I fill in "register_username" with "titi"
    And I fill in "register_email" with "ti@gmail.com"
    And I fill in "register_plainPassword" with "titititititititititi"
    And I press "Créer un compte"
    Then I should be on "/fr/register"
    And I should see "This value is too long"
    Then the response status code should be 200

  Scenario: Eight, I need to test that the register form thrown an error if the password is too short.
    Then I fill in "register_username" with "titi"
    And I fill in "register_email" with "ti@gmail.com"
    And I fill in "register_plainPassword" with "ti"
    And I press "Créer un compte"
    Then I should be on "/fr/register"
    And I should see "This value is too short"
    Then the response status code should be 200

  Scenario: Ninth, I need to test that the register form thrown an error if the password is empty (managed by HTML).
    Then I fill in "register_username" with "titi"
    And I fill in "register_email" with "ti@gmail.com"
    And I fill in "register_plainPassword" with ""
    And I press "Créer un compte"
    Then I should be on "/fr/register"
    And I should see "The required fields must be filled !"
    Then the response status code should be 200

  Scenario: Tenth, I need to test that the register form thrown an error if the credentials already exists.
    Then I fill in "register_username" with "HelloWorld"
    And I fill in "register_email" with "hello@gmail.com"
    And I fill in "register_plainPassword" with "Ie1FDLGHW"
    And I press "Créer un compte"
    Then I should be on "/fr/register"
    And I should see "This credentials already exist !"
    Then the response status code should be 200

  Scenario: Eleventh, I need to test that the register form is processed if the user send valid data.
    Then I fill in "register_username" with "Eksi"
    And I fill in "register_email" with "eksi@gmail.com"
    And I fill in "register_plainPassword" with "Ie1FDLEKSI"
    And I press "Créer un compte"
    Then I should be on "/fr/"
    And I should see "Votre profil a été créé ! Veuillez vérifier votre boîte mail afin de valider ce dernier."
    And the response status code should be 200
