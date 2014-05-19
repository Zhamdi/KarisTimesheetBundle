Getting Started With KarisTimesheetBundle
==================================

## Prerequisites

This version of the bundle requires Symfony 2.3+.

## Installation

4 step process:

1. Download KarisTimesheetBundle using composer
2. Enable the Bundle
3. Import KarisTimesheetBundle routing
4. Update your database schema

### Step 1: Download KarisTimesheetBundle using composer

Add KarisTimesheetBundle in your composer.json:

```js
{
    "require": {
        "karis/timesheet-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update karis/timesheet-bundle
```

Composer will install the bundle to your project's `vendor/karis` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Karis\TimesheetBundle\KarisTimesheetBundle(),
    );
}
```

### Step 3: Import KarisTimesheetBundle routing files

Now that you have activated and configured the bundle, all that is left to do is
import the KarisTimesheetBundle routing files.

By importing the routing files you will have ready made pages for things such as
creating projects, creating timesheet, etc.

In YAML:

``` yaml
# app/config/routing.yml
karis_timesheet:
    resource: "@KarisTimesheetBundle/Resources/config/routing.yml"
```

Or if you prefer XML:

``` xml
<!-- app/config/routing.xml -->
<import resource="@KarisTimesheetBundle/Resources/config/routing.yml"/>
```

### Step 4: Update your database schema

Now that the bundle is configured, the last thing you need to do is update your
database schema because you have added new entities.

For ORM run the following command.

``` bash
$ php app/console doctrine:schema:update --force
```

You now can login at `http://app.com/app_dev.php/karis/timesheet`!
