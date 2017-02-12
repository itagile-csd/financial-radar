Feature: Asset flows
  Scenario:
    Given multiple asset flows
    When I ask for all asset flows
    Then I get a complete list of revenues and expenses
