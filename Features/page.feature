Feature:
    As an editor
    I want to create a new page
    So I can publish content
    
    Scenario:
        As an editor
        If I fill in all required fields
        I create a new page successfully
        
        Given I go to "/admin/zorbus/page/page/list"
        Then I should see "Page List"