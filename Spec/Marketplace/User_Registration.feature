Feature: User Registration
    In order to gain access to more marketplace functionality
    As a user
    I want to register an account

    Scenario: Register user
        Given Filled out registration form
        When All required information is filled and valid
        Then Marketplace user and account is created
    
    