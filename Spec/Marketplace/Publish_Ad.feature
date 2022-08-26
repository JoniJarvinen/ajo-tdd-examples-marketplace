Feature: Publish ad
    In order to control ads
    As a user
    I want to specify when an ad is published

    Scenario: Publish ad by specific date and time
        Given An existing ad
        When User submits publishing date and time
        Then Ad is scheduled to be published
    
    Scenario: Publish ad immediately
        Given An existing ad
        When User submits ad as submit now
        Then Ad is published