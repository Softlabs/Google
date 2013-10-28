Google
======

This package is a simple laravel 4 wrapper for Softlabs/google-api-php-client package.

Usage
-----

    // Instantiate google AIP client
    $googleAPIClient = new \Google();
    // Create Google_CalendarService object
    $calendarService = $googleAPIClient->createService("Calendar");

_Google::createService($serviceName)_ method will create a "Google_{$serviceName}Service" object. For example

    Google::createService("YouTube") // creates a Google_YouTubeService object

All services can be used as [API documentation](https://code.google.com/p/google-api-php-client/wiki/Samples) describes.


Configuration
-------------

Sample app/config/google.php file:

    return array(
        'client-id'            => '????????????.apps.googleusercontent.com',
        'service-account-name' => '????????????@developer.gserviceaccount.com',
        'key-file'             => '../app/config/packages/thujohn/analytics/????????????????????????????????????????-privatekey.p12',
        'scope'                => ['https://www.googleapis.com/auth/calendar.readonly', 'https://www.googleapis.com/auth/calendar']
    );

You can generate client-id, service-account-name and key-file using [Google API Console](https://code.google.com/apis/console).

1. If you have no projects yet, click on 'CREATE PROJECT' button and name your new project. (Project ID field will be filled automatically.)
- If you already have existing projects, but you want to create a new one, click on the left top dropdown (it will show one of your existing projects) and select _Create…_ from the dropdown menu
- If you want to use one of your existing projects, just select it from the list
- Select _API Access_ from the left menu
- Click on _Create an OAuth 2.0 client ID…_ button and input branding data then click on _Next_
- Select _Service account_ radio button, then on _Create client ID_ button
- Click on _Download private key_ button and save your private key to a safe location
- Close the popup

Now you can set your config values:

- _client-id_: Client ID under the Service account title
- _service-account-name_: Email address under the Service account title
- _key-file_: the path where you saved your private key in step 7.
- _scope_: an array of scopes that you will use in your application. you can find the required scopes for every service in [API documentation](https://code.google.com/p/google-api-php-client/wiki/Samples).

To be able to use google services for a google account __you have to share__ items with the service account (_service-account-name_). For example if you want to handle google calendars of somebody@gmail.com, then somebody@gmail.com should share its calendars with ????????????@developer.gserviceaccount.com.



