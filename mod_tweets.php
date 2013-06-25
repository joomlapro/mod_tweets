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

// Include the tweets functions only once.
require_once __DIR__ . '/helper.php';

if (!function_exists('curl_init') || !is_callable('curl_init'))
{
	throw new RuntimeException(JText::_('MOD_TWEETS_ERROR_CURL_NOT_AVAILABLE'));
}

// Get module data.
$tweets = ModTweetsHelper::getTweets($params);

// Initialise variables.
$avatar_size     = htmlspecialchars($params->get('avatar_size', '35'));
$link_target     = htmlspecialchars($params->get('link_target', '_blank'));
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

// Render the module.
require JModuleHelper::getLayoutPath('mod_tweets', $params->get('layout', 'default'));
