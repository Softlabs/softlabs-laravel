<?php

interface FrameComposerInterface
{
	/**
	 * Called when attributes should be shared to a particular frame.
	 *
	 * @param  string $view       The view to share attributes with.
	 * @param  array  $attributes An array of attributes to share.
	 */
	public function shareAttributes($view, $attributes);
}