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
}