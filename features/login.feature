@login
Feature: I want to ensure that an user can log itself.
  First, I want to test the login form with bad credentials (using wrong username)
  Second, I want to test the login form with good credentials (using good username)
  Third, I want to test the login form with bad credentials (using wrong email)
  Fourth, I want to test the login form with good credentials (using good email)
  Fifth, I want to test the login form with bad credentials (using wrong password)
  Sixth, I want to test the login form with good credentials (using good password)
  Seventh, I want to test the login form without password.
  Eight, I want to test the login form without username or email.

  Background:
    Given I load following users:
      | username     | plainPassword | firstname | lastname | email           | validationToken | validated | active |
      | HelloWorld   | Ie1FDLGHW     | Hello     | World    | hello@gmail.com | AZERTYQWERTY    | true      | true   |
    When I am on "/fr/"
    And I go to "/fr/login"

  Scenario: [Bad case] First, I want to test the login form with bad credentials (using wrong username)
    Then I fill in "_username" with "HelloWorld"
    Then I fill in "_password" with "ttata"
    And I press "Login"
    Then I should be on "/fr/login"
    And the response status code should be 200

  Scenario: [Good case] Second, I want to test the login form with good credentials (using good username)
    Then I fill in "_username" with "HelloWorld"
    And I fill in "_password" with "Ie1FDLGHW"
    And I press "Login"
    Then I should be on "/fr/"
    And the response status code should be 200
    Then I go to "/fr/logout"
    And I should be on "/fr/"
    Then the response status code should be 200

  Scenario: [Bad case] Third, I want to test the login form with bad credentials (using wrong email)
    Then I fill in "_username" with "hello@gmail.co"
    Then I fill in "_password" with "Ie1FDLGHW"
    And I press "Login"
    Then I should be on "/fr/login"
    And the response status code should be 200

  Scenario: [Good case] Fourth, I want to test the login form with good credentials (using good email)
    Then I fill in "_username" with "hello@gmail.com"
    And I fill in "_password" with "Ie1FDLGHW"
    And I press "Login"
    Then I should be on "/fr/"
    And the response status code should be 200
    Then I go to "/fr/logout"
    And I should be on "/fr/"
    Then the response status code should be 200

  Scenario: [Bad case] Fifth, I want to test the login form with bad credentials (using wrong password)
    Then I fill in "_username" with "HelloWorld"
    Then I fill in "_password" with "Ie1FDLG"
    And I press "Login"
    Then I should be on "/fr/login"
    And the response status code should be 200

  Scenario: [Good case] Sixth, I want to test the login form with good credentials (using good password)
    Then I fill in "_username" with "HelloWorld"
    And I fill in "_password" with "Ie1FDLGHW"
    And I press "Login"
    Then I should be on "/fr/"
    And the response status code should be 200
    Then I go to "/fr/logout"
    And I should be on "/fr/"
    Then the response status code should be 200

  Scenario: [Bad case] Seventh, I want to test the login form without password
    Then I fill in "_username" with "HelloWorld"
    And I fill in "_password" with ""
    And I press "Login"
    Then I should be on "/fr/login"
    And I should see "Identifiants invalides."
    And the response status code should be 200

  Scenario: [Bad case] Seventh, I want to test the login form without username or email
    Then I fill in "_username" with ""
    And I fill in "_password" with "Ie1FDLGHW"
    And I press "Login"
    Then I should be on "/fr/login"
    And I should see "Identifiants invalides."
    And the response status code should be 200
