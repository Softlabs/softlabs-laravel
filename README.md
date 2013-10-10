Softlabs Packages
================

This is the **first working version** of Softlabs Packages. It contains the following packages:

- Validator
- Util

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
