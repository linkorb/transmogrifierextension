# Transmogrifier Behat Extension
<img src="http://www.linkorb.com/d/online/linkorb/upload/transmogrifier.gif" align="right" />

Transmogrifier is a tool to help setup your database fixtures before running your tests.

This is repository contains the Transmogrifier Extension for Behat.

This allows you to use Transmogrifier directly from your Behat `.feature` files!

Adding the extension will activate a few new Gherkin commands to help you initialize your database testing fixtures.

## Installing the extension through composer

Open your `composer.json` file, and add this to the `require` section:

```json
"linkorb/transmogrifierextension": "dev-master"
```

## Enabling the Behat extension

Edit your `features/bootstrap/FeatureContext.php` file, and add the following line to the `__construct` method:
```php
$this->useContext(
    'transmogrifier',
    new \LinkORB\TransmogrifierExtension\TransmogrifierContext($parameters)
);
```

### How to use the extension in your .feature files

You can use the following new syntax in your `.feature` files:

```gherkin
    Scenario: Applying a yml dataset to the `test` database
        Given I connect to database "test"
        When I apply dataset "user.yml"
        Then I should have "2" records in the "user" table
```

This example scenario will tell Behat to connect to the database `test`, load dataset `user.yml`, and apply it.
After that it will verify the `user` table contains 2 records (just like the yml file).

### Configuring the extension in behat.yml

For this to work, you will need to tell Behat and Transmogrifier where to find your datasets,
and where to find your database config files.

Edit your `behat.yml` file, and add the following:

```yml
default:
    extensions:
        LinkORB\TransmogrifierExtension\Extension:
            dbconf_dir: /share/config/database/
            dataset_dir: example/
```

These paths can be either absolute or relative from the directory where you start Behat.

## Behat example

The `features/` directory in this repository contains a fully functional `transmogrifier.feature` file.

# More info?

Check the Transmogrifier repo for more information:
[http://www.github.com/linkorb/transmogrifier/](http://www.github.com/linkorb/transmogrifier/)

## Brought to you by the LinkORB Engineering team

<img src="http://www.linkorb.com/d/meta/tier1/images/linkorbengineering-logo.png" width="200px" /><br />
Check out our other projects at [linkorb.com/engineering](http://www.linkorb.com/engineering).

Btw, we're hiring!
