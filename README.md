MoneyTransfer Demo Application
==============================

A demo application with CLI suitable as a backend task.
It is based on Symfony/Doctrine framework.

## Configuration
Database connection should be set in the file _app/config/parameters.yml[.dist]_

## Usage
Run the following command in console:
    
    php app/console moneytransfer:transfer "<money_sender>" "<money_receiver>" <amount_of_money>

## Notes
    
* **_PHP 5.4_** and **_Symfony 2_** have been used due to the PHP limited
support for Windows XP which runs on my home PC:

        [PHP For Windows](http://windows.php.net/):
        PHP 5.4 series will be the last versions to support Windows XP and Windows 2003.
        We will not provide binary packages for these Windows versions anymore after PHP 5.4.

        symfony/symfony v3.1.0 requires php >=5.5.9 -> your PHP version (5.4.45) does not satisfy that requirement.

* TODO

    * Debugging/logging mode instead of printing on console
    * Create mocking tests
    * Adding more commands such as cancelling money transfer, etc. 
    
## Author
[Yevgeny Gorbachev](yevgor@gmail.com)
