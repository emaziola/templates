<?php
	/* Our Twitter handle */
	$handle = "AgileIM";

	echo '<h3 id="twitter-feed-title" class="news-feed-title">';
		echo '<a href="https://twitter.com/AgileIM" title="Follow us on Twitter!">';
			echo '<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 26.006" xml:space="preserve">
				<use xlink:href="#agi-twitter-o"></use>
			</svg>

			<span class="text">@' . $handle . '</span>';
		echo '</a>';
	echo '</h3>';

	/* Latest Twitpics & Latest Tweets */
	$settings = array(
	 				'oauth_access_token' => "418042265-c5uGepiEfyTmpfZOSx36yKTxWtrIFAoZMBOPxhfI",
	 				'oauth_access_token_secret' => "r99az3I3t92rcWT99QKNpnYc13jDH5Beeuhpl6XE",
					'consumer_key' => "X12i8kjTl8cPelZ4L5TQA",
	 				'consumer_secret' => "UvXzdxcgvRa8p3q8BCqfZD7ReP67LfUmKtp5BqGX0eQ"
	 			);

	/***
	* URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ 
	* Note: Set the GET field BEFORE calling buildOauth();
	***/
	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$getfield = '?screen_name=' . $handle . '&count=4&include_entities=true';
	$requestMethod = 'GET';

	$twitter_response = getTweets($settings, $url, $getfield, $requestMethod);
	$twitter_array = json_decode($twitter_response, $assoc = TRUE);

	if($twitter_array != null){
		echo '<div id="twitter-feed-list-wrap" class="flexslider flexslider-xs">';
			echo '<ul id="twitter-feed-list" class="slides">';
				foreach($twitter_array as $key=>$tweet){
					$tweet_username = $tweet['user']['name'];
					$tweet_avatar_url = $tweet['user']['profile_image_url']; /* https version available also */
					$tweet_id = $tweet['id_str'];
					$tweet_date = $tweet['created_at']; /* Timestamp: 'Tue Jul 19 09:17:10 +0000 2016' */
					$tweet_date_formatted = date('M d', strtotime($tweet_date));
					$tweet_favourite_count = $tweet['favorite_count'];
					$tweet_content = $tweet['text'];
					$tweet_content = preg_replace("/http[s]?:\/\/([^\s]+)/", "<a href=\"http://$1\">$0</a>", $tweet_content); // Wrap any URL's in <a> tags
					$tweet_content = preg_replace("/@([^\s]+)/", "<a href=\"https://twitter.com/$1\">@$1</a>", $tweet_content); // Make @ interactions links to the @<user>'s profile
					$tweet_content = preg_replace("/#([^\s]+)/", "<a href=\"https://twitter.com/hashtag/$1?src=hash\">#$1</a>", $tweet_content); // Make hashtags hyperlinks to the hashtag on twitter
					$tweet_url = 'https://twitter.com/' . $handle . '/status/' . $tweet_id;

					echo '<li id="tweet-' . $tweet_id . '" class="tweet row">';
						echo '<div class="tweet-avatar image-wrap col-xs-3 col-md-2">';
							echo '<a href="https://twitter.com/' . $handle . '" title="' . $tweet_username . '"><img src="' . $tweet_avatar_url . '" alt="' . $tweet_username . ' Profile Image" title="' . $tweet_username . '"></a>';
						echo '</div>';

						echo '<div id="tweet-' . $tweet_id . '-content" class="tweet-content col-xs-9 col-md-10">';
							echo '<header class="tweet-header">';
								echo '<span class="twitter-name"><a href="https://twitter.com/' . $handle . '" title="' . $tweet_username . '">' . $tweet_username . '</a></span>';
								echo '<span class="tweet-handle"><a href="https://twitter.com/' . $handle . '" title="' . $tweet_username . '">@' . $handle . '</a></span>';
								echo '<span class="tweet-date"><a href="https://twitter.com/' . $handle . '/status/' . $tweet_id . '" title="View Tweet!">' . $tweet_date_formatted . '</a></span>';
							echo '</header>';

							echo $tweet_content;

							echo '<ul id="tweet-' . $tweet_id . '-meta" class="tweet-meta">';
								echo '<li id="tweet-' . $tweet_id . '-view-tweet" class="view-tweet">';
									echo '<a href="https://twitter.com/' . $handle . '/status/' . $tweet_id . '" title="View Tweet">';
										echo '<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 26.006" xml:space="preserve">
											<use xlink:href="#agi-twitter-o"></use>
										</svg>';
										echo '<span class="sr-only">View Tweet</span>';
									echo '</a>';
								echo '</li>';

								echo '<li id="tweet-' . $tweet_id . '-tweet-us" class="tweet-us">';
									echo '<a href="https://twitter.com/intent/tweet?text=@' . $handle . '" title="Tweet us!">';
										echo '@';
										echo '<span class="sr-only">Tweet Us</span>';
									echo '</a>';
								echo '</li>';

								echo '<li id="tweet-' . $tweet_id . '-retweet" class="retweet">';
									echo '<a href="https://twitter.com/intent/retweet?tweet_id=' . $tweet_id . '" title="Retweet">';
										echo '<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 19.201" xml:space="preserve">
											<use xlink:href="#agi-retweet-o"></use>
										</svg>';
										echo '<span class="sr-only">Retweet</span>';
									echo '</a>';
								echo '</li>';

								echo '<li id="tweet-' . $tweet_id . '-favourites" class="favourites">';
									echo '<span class="tweet-favourite-count" title="Tweet favourited ' . $tweet_favourite_count . ' times">';
										echo '<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 28" xml:space="preserve">
											<use xlink:href="#agi-heart-o"></use>
										</svg>';
										echo '<span class="count">' . $tweet_favourite_count . '</span>';
										echo '<span class="sr-only">' . $tweet_favourite_count . 'Favourites</span>';
									echo '</span>';
								echo '</li>';
							echo '</ul>';
						echo '</div>';
					echo '</li>';
				}
			echo '</ul>';
		echo '</div>';
	}
	else{
		echo '<p>No tweets could be shown at this time. Alternatively, you can browse our Twitter account at: https://twitter.com/' . $handle . '</p>';
	}
?>