## About PasswordGenerator

Password generator class generates random string based on two parameters length and strength. Length parameter
determines length of string generated and strength parameter has three options each option will generate password with
according rules.

## Requirements

<ul>
<li>PHP >= 7.3</li>
</ul>

## Installation
Install Composer
```
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```
Add to composer.json require and repositories and run composer install command:
```
"require": {
    "fitpass/generator": "dev-master"
},
"repositories": [
    {
        "type": "vcs",
        "url":  "git@github.com:nika-gelashvili/password-generator.git"
    }
]
```

## Simple Usage

```php
$generator = new PasswordGenerator(10, PasswordGenerator::STRENGTH_ONE);
$generator->generatePassword();
```

This bit of code is enough to generate password; First PasswordGenerator parameter is length and second is the strength
of password. It is possible to set parameters after calling class using setters.

```php 
$generator = new PasswordGenerator();
$generator->setLength(10);
$generator->setStrength(PasswordGenerator::STRENGTH_ONE);
$generator->generatePassword();
```

If no parameters are set PasswordGenerator will use default parameters and set length to 6 and strength to one;

## Testing
To run tests for password generator navigate to project root and run command:
```
vendor/bin/phpunit vendor/fitpass/generator/Tests/
```
