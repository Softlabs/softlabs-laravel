Softlabs Packages
================

This is the **first working version** of Softlabs Packages. It contains the following packages:

- Cur
- Date
- Util
- Validator

-----

## Cur
The Cur library provides methods for displaying currency formats. *(See source for listing of methods)*

-----

## Date
The Date library provides methods for displaying strings in date/time formats, aswell as several other helper methods. *(See source for listing of methods)*

-----

## Validator
The Validator library which extends illuminate is now fully implemented. 

### Usage
```php
<?php

use Softlabs\Validator\Validator;

class MyValidator extends Validator
{
	// Specify custom rules and messages!
	public $rules = [];
	public $messages = [];

	// You can also override the 'validate' method
	// to handle how your validator performs validation.
}

```

-----
## Util
The Util library now has two methods:
 - Gravatar
 - Avatar
