# marmalade-symf
symfony project

Code Review:

1. SOLID:
    - addRecipient method seems to be breaking Interface Segregation rule as it is not necessary as we have access to email address property anyway
    - SimpleMailer class does not comply to Single Responsibility rule as it is doing many things apart from just sending mail
    (it gets DB)
    - getDbName method looks like it does not comply with Open-Close Principle
    this code cannot be easily extended and is written in a way that would need to be modified in the future (if we added another department)
    - high level PersonNotificationService class depends on low level module
    
 2. PSR12 
    - there should be blank line between the methods in MailerInterface
    - in notify method we should put curly brace on new line
    - in the same method we need to remove empty spaces from the method calls
    - also getEmailAddress method call in notify is missing argument
