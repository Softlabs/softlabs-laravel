<?php namespace Softlabs\Date;

class Date
{
	/**
	 * Retrieves a date in D/M/Y format.
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
	 * Retrieves a date in M d format.
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
	 * @param  string $date The date to test.
	 * @return string       The formatted date string.
	 */
	public function timeAgo($date)
	{
	   $periods = array('Second', 'Minute', 'Hour', 'Day', 'Week', 'Month', 'Year', 'Decade');
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

	   return "$difference $periods[$j] Ago";
	}

	/**
	 * Displays how long ago a time was or an alternative string.
	 * @param  string $date The date string to test.
	 * @param  string $alternative The string to display if the time
	 * ago was never.
	 * @return string       How long ago or alternative string.
	 */
	public function timeAgoOrNever($date, $alternative="Never")
	{
		if ($date == '0000-00-00 00:00:00') {
			return $alternative;
		} else {
			return self::timeAgo($date);
		}
	}
}