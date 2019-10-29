# Anderson HTML5 Assets
Simple Laravel 5.8 application that gives you the ability to create a public link for an uploaded HTML5 banner. Your uploaded zip file must contain an index.html file and all assets used for the ad.

## Installation
1. Clone or fork this repository on your system
2. run `composer install`
3. run `php artisan storage:link`

## User Registration
Registration for the app is handled via the command line using `php artisan user:create`. You will be asked for the email and password for the user. If the email is already registered the user will be updated with the password provided.

## Documentation
Once registered you can login to the application and use the form to upload your zip file and create the public link to the HTML5 banner ad.

## Going Forward
This is a quick MVP that was created for our agency to help us with HTML5 banner ad approvals. We may continue to add features to this application.