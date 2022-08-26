Feature: Post an ad
    In order to present my item/service to potential buyers
    As a user
    I want to post an ad

Scenario: Post an ad as an authenticated user
    Given Filled out ad form
    When All required fields are filled and valid
    Then It is saved into database

Scenario: Post an ad as a non-authenticated user
    Given Filled out ad form
    When All required fields are filled and valid
    Then Authentication is required
    And User is redirected to authenticate
    When Authentication is completed
    Then User is asked to confirm the posting of an ad
    And The ad is persisted into database
    
Scenario: New ad was posted successfully
    Given Posted Ad
    When Looking up information
    Then It should include: Unique ID
    And Lifecycle place that is marked as initial
    And Unique ID of the Account that the Ad belongs to