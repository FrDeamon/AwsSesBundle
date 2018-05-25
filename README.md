AwsSesBundle
============

This bundle simply integrate the daniel-zahariev/php-aws-ses library into Symfony.
See https://github.com/daniel-zahariev/php-aws-ses.

Installation
------------

To install this library please follow the next steps:

First add the dependency:

```sh
composer require idci/aws-ses-bundle
```

Enable the bundle in your application kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new IDCI\Bundle\AwsSesBundle\AwsSesBundle(),
    );
}
```

Add the configuration in the config.yml file:


```yml
aws_ses:
    access_key: %aws_ses_access_key%
    secret_key: %aws_ses_secret_key%
    region_endpoint: %aws_ses_region_endpoint%
    message_from: %aws_ses_message_from%
```

then update your parameters.yml file :

```yml
aws_ses_access_key: ACCESS_KEY
aws_ses_secret_key: SECRET_KEY
aws_ses_region_endpoint: email.us-east-1.amazonaws.com
aws_ses_message_from: no-reply@mailbox.fr
```

Now the library is installed.

Optional configuration
----------------------

You can add one or several recipients by default.

```yml
aws_ses:
    ...
    message_to: [user1@gmail.com, user2@gmail.com]
```

```yml
aws_ses:
    ...
    message_to: user@gmail.com
```

Usage
-----

This example should be enough

```php
$mailer = $this->getContainer()->get('aws_ses');
$message = $this->getContainer()->get('aws_ses_message');

$message
    ->addTo('user@gmail.com')
    ->setSubject('Hello, world!')
    ->setMessageFromString('This is the message body.')
;
print_r($mailer->sendEmail($message));

// Successful response should print something similar to:
//Array(
//     [MessageId] => 0000012dc5e4b4c0-b2c566ad-dcd0-4d23-bea5-f40da774033c-000000
//     [RequestId] => 4953a96e-29d4-11e0-8907-21df9ed6ffe3
//)
```

See the daniel-zahariev/php-aws-ses library for more information.
