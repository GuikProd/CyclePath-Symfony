@login
Feature: I want to ensure that an user can log itself.
  First, I want to test the login form with wrong username
  Second, I want to test the login form with good username
  Third, I want to test the login form with wrong email
  Fourth, I want to test the login form with good email
  Fifth, I want to test the login form with wrong password
  Sixth, I want to test the login form with good password
  Seventh, I want to test the login form without password.
  Eighth, I want to test the login form without username or email.

  Background:
    Given I load following users:
      | username     | plainPassword | firstname | lastname | email           | validationToken    | resetToken     | validated  | active |
      | HelloWorld   | Ie1FDLGHW     | Hello     | World    | hello@gmail.com | AZERTYQWERTY       | Ie1FDLGTITHU   | true       | true   |
      | Titi         | Ie1FDLTITI    | Titi      | Titi     | titi@gmail.com  | helloworldfromTiti | LBGELTIJD?AOA  | false      | false  |
    When I am on "/fr/"
    And I go to "/fr/login"
    Given I should see "Pseudonyme ou email"
    And I should see "Mot de passe"
    And I should see "Créer un compte"

  Scenario: First, I want to test the login form with wrong username
    Then I fill in "_username" with "HelloWorld"
    Then I fill in "_password" with "ttata"
    And I press "Se connecter"
    Then I should be on "/fr/login"
    And the response status code should be 200

  Scenario: Second, I want to test the login form with good username
    Then I fill in "_username" with "HelloWorld"
    And I fill in "_password" with "Ie1FDLGHW"
    And I press "Se connecter"
    Then I should be on "/fr/"
    And the response status code should be 200
    Then I go to "/fr/logout"
    And I should be on "/fr/"
    Then the response status code should be 200

  Scenario: Third, I want to test the login form with wrong email
    Then I fill in "_username" with "hello@gmail.co"
    Then I fill in "_password" with "Ie1FDLGHW"
    And I press "Se connecter"
    Then I should be on "/fr/login"
    And the response status code should be 200

  Scenario: Fourth, I want to test the login form with good email
    Then I fill in "_username" with "hello@gmail.com"
    And I fill in "_password" with "Ie1FDLGHW"
    And I press "Se connecter"
    Then I should be on "/fr/"
    And the response status code should be 200
    Then I go to "/fr/logout"
    And I should be on "/fr/"
    Then the response status code should be 200

  Scenario: Fifth, I want to test the login form with wrong password
    Then I fill in "_username" with "HelloWorld"
    Then I fill in "_password" with "Ie1FDLG"
    And I press "Se connecter"
    Then I should be on "/fr/login"
    And the response status code should be 200

  Scenario: Sixth, I want to test the login form with good password
    Then I fill in "_username" with "HelloWorld"
    And I fill in "_password" with "Ie1FDLGHW"
    And I press "Se connecter"
    Then I should be on "/fr/"
    And the response status code should be 200
    Then I go to "/fr/logout"
    And I should be on "/fr/"
    Then the response status code should be 200

  Scenario: Seventh, I want to test the login form without password
    Then I fill in "_username" with "HelloWorld"
    And I fill in "_password" with ""
    And I press "Se connecter"
    Then I should be on "/fr/login"
    And I should see "Identifiants invalides."
    And the response status code should be 200

  Scenario: Eighth, I want to test the login form without username or email
    Then I fill in "_username" with ""
    And I fill in "_password" with "Ie1FDLGHW"
    And I press "Se connecter"
    Then I should be on "/fr/login"
    And I should see "Identifiants invalides."
    And the response status code should be 200
