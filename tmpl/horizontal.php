<?php
/**
 * @package     Tweets
 * @subpackage  mod_tweets
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Initialiase variables.
$app = JFactory::getApplication();

if (!JPluginHelper::isEnabled('system', 'flexslider'))
{
	$app->enqueueMessage(JText::_('MOD_TWEETS_ERROR_ENABLE_FLEXSLIDER'), 'notice');
	return false;
}

// Add JavaScript Frameworks.
JHtml::_('jquery.framework');

// Load the tweet and flexslider jquery script.
JHtml::_('jquery.flexslider');
?>
<!-- Ticker -->
<div id="ticker" class="tweet">
	<ul class="tweet_list">
		<?php foreach ($tweets as $tweet): ?>
			<li>
				<span class="label"><i class="icon-twitter"></i> Twitter</span> <?php echo $tweet->time; ?> <?php echo $tweet->text; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#ticker').flexslider({
			selector: '.tweet_list > li',
			animation: 'slide',
			direction: 'vertical',
			controlNav: false,
			prevText: '<i class="icon-chevron-left"></i>',
			nextText: '<i class="icon-chevron-right"></i>'
		});
	});
</script>
<!-- End Ticker -->