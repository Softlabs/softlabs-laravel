<?php namespace Softlabs\Util;

class Util
{
	/**
	 * Retrieves an avatar image for the specified email. (Gravatar)
	 * @param  string $email The email of the gravatar user.
	 * @param  integer $size  The size of the image to display.
	 * @return string        URL to the user's gravatar image.
	 */
    public function avatar($email=null, $size=null)
    {
    	// Set a default size if none or an invalid was provided.
    	if ( ! isset($size) or ! is_numeric($size)) {
    		$size = 120;
    	}

        $md5Email = md5(strtolower(trim($email)));

        if (isset($email)) {
            return "http://www.gravatar.com/avatar/$md5Email?s=$size";
        }

        // Return a default gravatar image.
        return "http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=$size";
    }
	/**
	 * Retrieves a user's gravatar page.
	 * @param  string $email The email of the gravatar user.
	 * @return string        URL to the user's gravatar page.
	 */
    public function gravatar($email=null)
    {
        if(isset($email)) {
            return 'http://www.gravatar.com/'.md5(strtolower(trim($email)));
        }

        return 'https://en.gravatar.com/site/signup';
    }

    /**
     * Clamps the specified value between two values.
     * @param  integer  $value The value to clamp.
     * @param  integer $min   The minimum value that can be achieved.
     * @param  integer $max   The maximum value that can be achieved.
     * @return integer         Clamped value
     */
    public function clamp($value, $min=1, $max=100)
    {
        return $value < $min ? $min : ($value > $max ? $max : $value);
    }

    /**
     * Retrieves a priority label based on the given value.
     * @param  integer  $value     The value to test
     * @param  array  $priorities An array of priorites (leave null
     * for default: 'no', 'low', 'medium' and 'high')
     * @return string priority string
     */
    public function priority($value, $priorities=null)
    {
        if ( ! is_null($priorities) and is_array($priorities)) {
            foreach ($priorities as $key => $value) {
                if ( ! is_int($key)) {
                    throw new \InvalidArgumentException(
                        'The priorities array must have numerical keys.'
                    );
                }

                if ( ! is_string($value)) {
                    throw new \InvalidArgumentException(
                        'The priorities array must have string values.'
                    );
                }
            }
        }

        $min = 0;
        $max = count($priorities) - 1;
        $priorities = $priorities ?: [
            0 => 'no',
            1 => 'low',
            2 => 'medium',
            3 => 'high'
        ];

        $index = round(self::clamp($value, $min, $max));

        return $priorities[$index] ?: 'no';
    }
}