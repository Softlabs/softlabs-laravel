<?php namespace Softlabs\Date;

class Date
{
	/**
	 * Retrieves a date in D/M/Y format.
	 *
	 * @param  string $date The date string to format.
	 * @return string       The formatted date string.
	 */
	public function dmY($date)
	{
		if ( ! is_null($date)) {
			return date('d/m/Y', strtotime($date));
		}
	}

	/**
	 * Retrieves a date in D/M/Y H:i format.
	 *
	 * @param  string $date The date string to format.
	 * @return string       The formatted date string.
	 */
	public function dmYHi($date)
	{
		if ( ! is_null($date)) {
			return date('d/m/Y H:i', strtotime($date));
		}

	}

	/**
	 * Retrieves a date in jS M Y format.
	 *
	 * @param  string $date The date string to format.
	 * @return string       The formatted date string.
	 */
	public function jSMY($date)
	{
		if ( ! is_null($date)) {
			return date('jS M Y', strtotime($date));
		}

	}

	/**
	 * Retrieves a date in jS M Y H:i format.
	 *
	 * @param  string $date The date string to format.
	 * @return string       The formatted date string.
	 */
	public function jSMYHi($date)
	{
		if ( ! is_null($date)) {
			return date('jS M Y H:i', strtotime($date));
		}

	}

	/**
	 * Retrieves a date in M d format.
	 *
	 * @param  string $date The date string to format.
	 * @return string       The formatted date string.
	 */
	public function Md($date)
	{
		if ( ! is_null($date)) {
			return date('M d', strtotime($date));
		}
	}

	/**
	 * Retrieves a date in Y format.
	 *
	 * @param  string $date The date string to format.
	 * @return string       The formatted date string.
	 */
	public function Y($date)
	{
		if ( ! is_null($date)) {
			return date('Y', strtotime($date));
		}
	}

	/**
	 * Retrieves a date in h:i A format.
	 *
	 * @param  string $date The date string to format.
	 * @return string       The formatted date string.
	 */
	public function hiA($date)
	{
		if ( ! is_null($date)) {
			return date('h:i A', strtotime($date));
		}
	}

	/**
	 * Retrieves a date in H:i format.
	 *
	 * @param  string $date The date string to format.
	 * @return string       The formatted date string.
	 */
    public function Hi($date)
    {
        if ( ! is_null($date)) {
            return date('H:i', strtotime($date));
        }
    }

	/**
	 * Converts a date into a format which can be used as
	 * a MySQL entry.
	 *
	 * @param  string $date The date string to format.
	 * @return string       The formatted date string.
	 */
	public function toMysql($date)
	{
		if ( ! is_null($date)) {
			return date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $date)));
		}
	}

	/**
	 * Retrieves a date and time.
	 *
	 * @param  string $date The date string to format.
	 * @param  string $time The time string to format.
	 * @return string       The formatted date/time string.
	 */
	public function dateWithTime($date, $time)
	{
		if ( ! is_null($date)) {
			return date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $date) . ' ' . $time));
		}
	}

	/**
	 * Retrieves how long ago a specific time was from now.
	 *
	 * @param  string $date The date to test.
	 * @return string       The formatted date string.
	 */
	public function timeAgo($date, $suffix='ago')
	{
	   $periods = array('second', 'minute', 'hour', 'day', 'week', 'month', 'year', 'decade');
	   $lengths = array('60','60','24','7','4.35','12','10');

	   $time = strtotime($date);

	   $now = time();

	       $difference     = $now - $time;
	       $tense         = "ago";

	   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
	       $difference /= $lengths[$j];
	   }

	   $difference = round($difference);

	   if($difference != 1) {
	       $periods[$j].= "s";
	   }

	   return "$difference $periods[$j] $suffix";
	}

	/**
	 * Retrieves how far ahead a specific time is from now
	 *
	 * @param  string  $date
	 * @return string
	 */
	public function timeAhead($date)
	{
		$date = strtotime($date);

	    if ($date >= strtotime('today 00:00') and $date <= strtotime('tomorrow 00:00'))
	    {
	        return 'Today at ' . date('g:ia', $date);
	    }
	    elseif ($date >= strtotime('tomorrow 00:00') and $date <= strtotime('+2 day 00:00'))
	    {
	        return 'Tomorrow at ' . date('g:ia', $date);
	    }
	    elseif ($date >= strtotime('+2 day 00:00') and $date <= strtotime('+6 day 00:00'))
	    {
	    	return date('l \\a\\t g:ia', $date);
	    }
	    else
	    {
	    	return date('M j, Y g:ia', $date);
	    }
	}

	/**
	 * Displays how long ago a time was or an alternative string.
	 *
	 * @param  string $date The date string to test.
	 * @param  string $alternative The string to display if the time
	 * ago was never.
	 * @return string       How long ago or alternative string.
	 */
	public function timeAgoOrNever($date, $alternative="never")
	{
		if (empty($date) or is_null($date) or $date == '0000-00-00 00:00:00') {
			return $alternative;
		}
		else {
			return self::timeAgo($date);
		}
	}

    /**
     * Calculates the time zone offset between time zones.
     *
     * @param  string $remote_tz The remote time zone.
     * @param  string $origin_tz Origin time zone.
     * @return int       Time zone offset in seconds.
     */
    public function timezoneOffset($remote_tz, $origin_tz = null) {
        if ($origin_tz === null) {
            if( ! is_string($origin_tz = date_default_timezone_get())) {

                return false;
            }
        }

        $origin_dtz = new \DateTimeZone($origin_tz);
        $remote_dtz = new \DateTimeZone($remote_tz);
        $origin_dt = new \DateTime("now", $origin_dtz);
        $remote_dt = new \DateTime("now", $remote_dtz);
        $offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt);

        return $offset;
    }
}