<?php
/**
 * @package     Tweets
 * @subpackage  mod_tweets
 *
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

require_once __DIR__ . '/libraries/twitteroauth/twitteroauth.php';
require_once __DIR__ . '/libraries/twitter-text-php/Autolink.php';

/**
 * Tweets module helper.
 *
 * @package     Condos
 * @subpackage  mod_tweets
 * @since       3.1
 */
abstract class ModTweetsHelper
{
	/**
	 * Get a list of the tweet items.
	 *
	 * @param   JRegistry  &$params  The module options.
	 *
	 * @return  object
	 *
	 * @since   3.1
	 */
	public static function getTweets(& $params)
	{
		$oauth = new TwitterOAuth(
			trim($params->get('consumer_key')),
			trim($params->get('consumer_secret')),
			trim($params->get('access_token')),
			trim($params->get('access_secret'))
		);

		if ($params->get('type', 1))
		{
			$items = $oauth->get(
				'statuses/user_timeline',
				array(
					'screen_name' => trim($params->get('username', 'joomla')),
					'count' => trim($params->get('count', 5)),
				)
			);
		}
		else
		{
			$items = $oauth->get(
				'search/tweets',
				array(
					'q' => trim($params->get('query')),
					'count' => trim($params->get('count', 5)),
				)
			);

			if (!isset($items->errors))
			{
				$items = $items->statuses;
			}
		}

		if (!isset($items->errors))
		{
			foreach ($items as $item)
			{
				$tweet              = new stdClass;
				$tweet->id          = $item->id_str;
				$tweet->text        = Twitter_Autolink::create($item->text)->setNoFollow(false)->addLinks();
				$tweet->time        = JHtml::_('date.relative', $item->created_at);
				$tweet->name        = $item->user->name;
				$tweet->screen_name = $item->user->screen_name;
				$tweet->avatar      = $item->user->profile_image_url_https;

				$tweets[] = $tweet;
			}

			self::setCache($tweets);

			return $tweets;
		}
		else
		{
			return self::getCache();
		}
	}

	/**
	 * Method to set the cache.
	 *
	 * @param   string  $data  The data.
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	private static function setCache($data)
	{
		// Initialiase variables.
		$file = JPATH_CACHE . '/twitter';
		$data = serialize($data);

		JFile::write($file, $data);
	}

	/**
	 * Method to get the file cache.
	 *
	 * @return  mixed
	 *
	 * @since   3.1
	 */
	private static function getCache()
	{
		// Initialiase variables.
		$file = JPATH_CACHE . '/twitter';

		if (JFile::exists($file))
		{
			return unserialize(JFile::read($file));
		}

		return false;
	}
}
