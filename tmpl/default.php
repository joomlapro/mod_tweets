<?php
/**
 * @package     Tweets
 * @subpackage  mod_tweets
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;
?>
<!-- Twitter Widget -->
<div class="twitter-widget<?php echo $moduleclass_sfx; ?>">
	<ul class="tweet_list">
		<?php foreach ($tweets as $tweet): ?>
			<li>
				<a class="tweet_avatar" href="https://twitter.com/<?php echo $tweet->screen_name; ?>" title="<?php echo $tweet->name; ?>" target="<?php echo $link_target; ?>">
					<img src="<?php echo $tweet->avatar; ?>" alt="<?php echo $tweet->name; ?>" width="<?php echo $avatar_size; ?>" />
				</a>
				<span class="tweet_text">
					<?php echo $tweet->text; ?>
				</span>
				<span class="tweet_time">
					<a href="https://twitter.com/<?php echo $tweet->screen_name; ?>" title="<?php echo JText::_('MOD_TWEETS_TEXT_VIEW_TWEET_ON_TWITTER'); ?>" target="<?php echo $link_target; ?>"><?php echo $tweet->time; ?></a>
				</span>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
<!-- End Twitter Widget -->