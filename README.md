Softlabs Packages
================

This is the **first working version** of Softlabs Packages. It contains the following sub-packages (these are all included when the repository is included through composer).

- Cur
- Date
- Util
- Validator

## Installation

#### Step 1
Add `"softlabs/packages": "1.0.*"` to the `require` attribute of `composer.json` (This will be reflected when the `composer update` command has been run).

#### Step 2
Add a service provider for each of the sub-packages you wish to use in the application like so: `'Softlabs\Currency\CurrencyServiceProvider'` to the `app/config/app.php` file.

#### Step 3
Add an alias for each of the service providers you added in `Step 2` and prefix them with `SL` like so: `'SLCurrency' => 'Softlabs\Facades\SLCurrency'`.

You can now use the packages!

```php
  echo SLCurrency::gbp(24.21); // Prints £24.21
