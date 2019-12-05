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

How to run the application:

 1. clone this repo
 2. cd to the project
 3. composer install
 4. update mysql settings
 5. run updated quotation.sql
 6. I used symfony build in server ``php bin/console server:run``
 
How to make an api call
   - I used postman so this my vary
   - open postman, enter http://127.0.0.1:8000/api/get_premium
   - send a post request 
   - send payload for example 
   ``
   {
       "age": 20,
       "postcode": "PE3 8AF",
        "regNo": "PJ63 LXR"
    }
 ``
 - you should receive quote json back
 
 App talks to simple firebase api that has 3 car registration assigned to abi code
all the rest is rated at 1
``
{
  "KJ68JXR" : 52123803,
  "PJ63LXR" : 22529902,
  "YN63DJD" : 46545255
}
``
