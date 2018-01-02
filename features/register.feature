@register
Feature: I want to ensure that every security endpoint is available.
  First, I need to test that the register form throw an error if the username is too long.
  Second, I need to test that the register form throw an error if the username is too short.
  Third, I need to test that the register form throw an error if the email is too long.
  Fourth, I need to test that the register form thrown an error if the email is invalid (managed by HTML).
  Fifth, I need to test that the register form thrown an error if the password is empty.
  Sixth, I need to test that the register form thrown an error if the password is too long.
  Seventh, I need to test that the register form thrown an error if the password is too short.
  Eighth, I need to test that the register form is processed if the user send valid data.

  Scenario: [Bad case] First, I need to test that the register form throw an error if the username is too long
    When I am on "/fr/"
    And I go to "/fr/register"
    Then I fill in "register_username" with "titititititititititititititititititititititititititititititititititititititi"
    And I fill in "register_email" with "ti@gmail.com"
    And I fill in "register_plainPassword" with "totooto"
    And I press "Create an account"
    Then I should be on "/fr/register"
    And I should see "This value is too long"
    Then the response status code should be 200

  Scenario: [Bad case] Second, I need to test that the register form throw an error if the username is too short.
    When I am on "/fr/"
    And I go to "/fr/register"
    Then I fill in "register_username" with "ti"
    And I fill in "register_email" with "ti@gmail.com"
    And I fill in "register_plainPassword" with "totooto"
    And I press "Create an account"
    Then I should be on "/fr/register"
    And I should see "This value is too short"
    Then the response status code should be 200

  Scenario: [Bad case] Third, I need to test that the register form throw an error if the email is too long.
    When I am on "/fr/"
    And I go to "/fr/register"
    Then I fill in "register_username" with "titi"
    And I fill in "register_email" with "titititititititititititititititititititititititititititititititititititititititititititititititititititititititititititititititititititititititititititioauannaooduaneoehna@gmail.com"
    And I fill in "register_plainPassword" with "to"
    And I press "Create an account"
    Then I should be on "/fr/register"
    And I should see "This value is too long"
    Then the response status code should be 200

  Scenario: [Bad case] Fourth, I need to test that the register form thrown an error if the email is invalid (managed by HTML).
    When I am on "/fr/"
    And I go to "/fr/register"
    Then I fill in "register_username" with "titi"
    And I fill in "register_email" with "titi.com"
    And I fill in "register_plainPassword" with "to"
    And I press "Create an account"
    Then I should be on "/fr/register"
    Then the response status code should be 200

  Scenario: [Bad case] Fifth, I need to test that the register form thrown an error if the password is empty.
    When I am on "/fr/"
    And I go to "/fr/register"
    Then I fill in "register_username" with "titi"
    And I fill in "register_email" with "ti@gmail.com"
    And I fill in "register_plainPassword" with ""
    And I press "Create an account"
    Then I should be on "/fr/register"
    And I should see "This entry must be valid !"
    Then the response status code should be 200

  Scenario: [Bad case] Sixth, I need to test that the register form thrown an error if the password is too long.
    When I am on "/fr/"
    And I go to "/fr/register"
    Then I fill in "register_username" with "titi"
    And I fill in "register_email" with "ti@gmail.com"
    And I fill in "register_plainPassword" with "titititititititititititititititititititititititititititititititititititititi"
    And I press "Create an account"
    Then I should be on "/fr/register"
    And I should see "This value is too long"
    Then the response status code should be 200

  Scenario: [Bad case] Seventh, I need to test that the register form thrown an error if the password is too short.
    When I am on "/fr/"
    And I go to "/fr/register"
    Then I fill in "register_username" with "titi"
    And I fill in "register_email" with "ti@gmail.com"
    And I fill in "register_plainPassword" with "ti"
    And I press "Create an account"
    Then I should be on "/fr/register"
    And I should see "This value is too short"
    Then the response status code should be 200

  Scenario: [Good case] Eighth, I need to test that the register form is processed if the user send valid data.
    When I am on "/fr/"
    And I go to "/fr/register"
    Then I fill in "register_username" with "Eksi"
    And I fill in "register_email" with "eksi@gmail.com"
    And I fill in "register_plainPassword" with "Ie1FDLEKSI"
    And I press "Create an account"
    Then I should be on "/fr/"
    And the response status code should be 200
