Softlabs Packages
================

Softlabs Packages *(Implemented by [Matthew Erskine](https://github.com/matthewerskine))*

- [Base](https://github.com/Softlabs/softlabs-laravel/tree/master/src/Softlabs/Base)
- [Cur](https://github.com/Softlabs/softlabs-laravel/tree/master/src/Softlabs/Cur)
- [Date](https://github.com/Softlabs/softlabs-laravel/tree/master/src/Softlabs/Date)
- [Util](https://github.com/Softlabs/softlabs-laravel/tree/master/src/Softlabs/Util)
- [Validator](https://github.com/Softlabs/softlabs-laravel/tree/master/src/Softlabs/Validator)

## Installation

#### Step 1
Add `"softlabs/packages": "1.0.*"` to the `require` attribute of `composer.json` (This will be reflected when the `composer update` command has been run).

#### Step 2
Add a service provider for each of the sub-packages you wish to use in the application to the `app/config/app.php` file like so: `'Softlabs\Currency\CurrencyServiceProvider'`

#### Step 3
Add an alias for each of the service providers you added in `Step 2` and prefix them with `SL` like so: `'SLCurrency' => 'Softlabs\Facades\SLCurrency'`.

You can now use the packages!

------


<blockquote>
<h3>TODO</h3>
<ul>
<li>Each sub-package need an informative README.md which outlines all methods in the sub-package with usage examples and clear descriptions</li>
<li>Unit testing needs written for each package</li>
</ul>
</blockquote>
