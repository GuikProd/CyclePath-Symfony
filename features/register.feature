@register
Feature: I want to ensure that every security endpoint is available.
  First, I need to test that the register form throw an error if the username is too long.
  Second, I need to test that the register form throw an error if the email is too long.

  Scenario: [Bad case] I want to create a new account with long username
    When I am on "/fr/"
    And I go to "/fr/register"
    Then I fill in "register_username" with "titititititititititititititititititititititititititititititititititititititi"
    And I fill in "register_email" with "ti@gmail.com"
    And I fill in "register_plainPassword" with "totooto"
    And I press "Create an account"
    Then I should be on "/fr/register"
    And I should see "This value is too long"
    Then the response status code should be 200

  Scenario: [Bad case] I want to create a new account with long email
    When I am on "/fr/"
    And I go to "/fr/register"
    Then I fill in "register_username" with "titi"
    And I fill in "register_email" with "titititititititititititititititititititititititititititititititititititititititititititititititititititititititititititititititititititititititititititioauannaooduaneoehna@gmail.com"
    And I fill in "register_plainPassword" with "to"
    And I press "Create an account"
    Then I should be on "/fr/register"
    And I should see "This value is too long"
    Then the response status code should be 200

  Scenario: [Bad case] I want to create a new account with short password
    When I am on "/fr/"
    And I go to "/fr/register"
    Then I fill in "register_username" with "titi"
    And I fill in "register_email" with "ti@gmail.com"
    And I fill in "register_plainPassword" with "to"
    And I press "Create an account"
    Then I should be on "/fr/register"
    And I should see "This value is too short"
    Then the response status code should be 200

  Scenario: [Bad case] I want to create a new account with long password
    When I am on "/fr/"
    And I go to "/fr/register"
    Then I fill in "register_username" with "titi"
    And I fill in "register_email" with "ti@gmail.com"
    And I fill in "register_plainPassword" with "titititititititititititititititititititititititititititititititititititititi"
    And I press "Create an account"
    Then I should be on "/fr/register"
    And I should see "This value is too long"
    Then the response status code should be 200

  Scenario: [Good case] I want to create a new account with good credentials
    When I am on "/fr/"
    And I go to "/fr/register"
    Then I fill in "register_username" with "Eksi"
    And I fill in "register_email" with "eksi@gmail.com"
    And I fill in "register_plainPassword" with "Ie1FDLEKSI"
    And I press "Create an account"
    Then I should be on "/fr/"
    And the response status code should be 200
