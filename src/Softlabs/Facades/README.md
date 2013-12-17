Facades
=======

### Using the custom JSON Response facade

A custom JSON response facade has been created [here](https://github.com/Softlabs/softlabs-laravel/tree/master/src/Softlabs/Facades/Response.php) to fix an issue appearing on IE9 where JSON responses are triggered as a file download by the browser, as oppose to being treated as JSON objects. This custom facade will enforce a JSON response (accessed by `Response::json`) to have a 'text/html' header which will partly fix the issue.

To start using this custom response facade, you must replace the facade alias found in `app/config/app.php` as shown below:

```php
// 'Response' => 'Illuminate\Support\Facades\Response',
'Response' => 'Softlabs\Facades\Response',
```

Finally, any JQuery code you have written which uses the `$.ajax` method must have `dataType: 'json'` specified to ensure the returning data is parsed as JSON (as the response is now 'text/html' it may not be recognised as JSON by JQuery and cause unusual errors).
