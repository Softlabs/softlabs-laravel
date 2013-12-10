Softlabs Packages
================

Softlabs Packages

- [Base](https://github.com/Softlabs/softlabs-laravel/tree/master/src/Softlabs/Base)
- [Cur](https://github.com/Softlabs/softlabs-laravel/tree/master/src/Softlabs/Cur)
- [Date](https://github.com/Softlabs/softlabs-laravel/tree/master/src/Softlabs/Date)
- [Util](https://github.com/Softlabs/softlabs-laravel/tree/master/src/Softlabs/Util)
- [Validator](https://github.com/Softlabs/softlabs-laravel/tree/master/src/Softlabs/Validator)
- [Pagination](https://github.com/Softlabs/softlabs-laravel/tree/master/src/Softlabs/Pagination)

## Installation

#### Step 1
Add the following to the attribute to the `composer.json` file. This will allow the package to be discovered (as it is private)
```json
"repositories": [
	{ "type": "vcs", "url": "http://github.com/softlabs/softlabs-laravel" }
],
```

#### Step 2
Add `"softlabs/packages": "*"` to the `require` attribute of `composer.json` (This will be reflected when the `composer update` command has been run).

#### Step 3
Add a service provider for each of the sub-packages you wish to use in the application to the `app/config/app.php` file like so: `'Softlabs\Currency\CurrencyServiceProvider'`

Currently available service providers:

```php
'Softlabs\Currency\CurrencyServiceProvider',
'Softlabs\Date\DateServiceProvider',
'Softlabs\Util\UtilServiceProvider',
```

#### Step 4
Add an alias for each of the service providers you added in `Step 2` and prefix them with `SL` like so: `'SLCurrency' => 'Softlabs\Facades\SLCurrency'`.

Currently available aliases:

```php
'SLCurrency' => 'Softlabs\Facades\SLCurrency',
'SLDate' => 'Softlabs\Facades\SLDate',
'SLUtil' => 'Softlabs\Facades\SLUtil',
```


You can now use the packages!

------

## Updating Packages

If you are updating the package - be it refactoring, fixing bugs or implementing new features, make sure you follow the [Softlabs Coding Standards](https://github.com/Softlabs/Softlabs/blob/master/Coding_Standards/Softlabs%20Coding%20Standards.md).
Commit messages should reflect the sub-package being updated eg.

```
  Updated 'Logic' class on `Base` package
```

<blockquote>
<h3>TODO</h3>
<ul>
<li>Each sub-package need an informative README.md which outlines all methods in the sub-package with usage examples and clear descriptions</li>
<li>Unit testing needs written for each package</li>
<li><strong>Once these have been completed, the package can have its first release made.</strong></li>
</ul>
</blockquote>
