<?php
	
	# Error reporting:
	ini_set('display_errors', 1);
	ini_set('log_errors', 1);
	ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
	error_reporting(E_ALL);
	
	# API URI:
	$endpoint = (isset($_POST['endpoint'])) ? $_POST['endpoint'] : 'https://stage.syncaccess.net/po/rg/api/svcs/meter/standard?format=json'; // https://stage.syncaccess.net/sync/demo2/api/svcs/meter/standard?format=json
	
	# Default session ID:
	$sessionid = (isset($_POST['sessionid'])) ? $_POST['sessionid'] : '';
	
	# Category of viewed content:
	$contentid = (isset($_POST['contentid'])) ? $_POST['contentid'] : 'premium_1';
	
	# Allowed referal site:
	$referer = (isset($_POST['referer'])) ? $_POST['referer'] : 'http://www.foo.com';
	
	# User Agent data:
	$clientinfo = (isset($_POST['clientinfo'])) ? $_POST['clientinfo'] : 'iPad Device';
	
	# Submit text:
	$submit = (isset($_POST['submit'])) ? 'Submit again' : 'Submit';
	
	if (isset($_POST['submit'])) {
		
		/**
		 * @see http://stackoverflow.com/a/16920588/922323
		 */
		
		# The data to send to the API:
		$post_data = array(
			'sessionId' => $sessionid,
			'contentId' => $contentid,
			'referrer' => $referer,
			'clientInfo' => $clientinfo,
		);
		
		# Setup cURL:
		$handle = curl_init($endpoint);
		curl_setopt_array(
			$handle,
			array(
				CURLOPT_POST => TRUE,
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json',
				),
				CURLOPT_POSTFIELDS => json_encode($post_data)
			)
		);
		
		# Send the request:
		$response = curl_exec($handle);
		
		# Check for errors:
		if($response !== FALSE){
			
			# Decode the response:
			$response_data = json_decode($response, TRUE);
			
			$sessionid = $response_data['sessionIdentifier'];
			
		} else {
			
			# Die with error message:
			die(curl_error($handle));
			
		}
		
		/*
		
		$post_data = array(
			'sessionId'  => 'YTliMzYyYTktMWMyZC00NTc0LWE4NWMtN2JkMTA2YjAyMGQ3',
			'contentId'  => 'demoContent',
			'referrer'   => 'http://www.facebook.com',
			'clientInfo' => 'iPad Device',
		);
		
		# Create the context for the request:
		$request_context = stream_context_create(
			array(
				'http' => array(
					// http://www.php.net/manual/en/context.http.php
					'method' => 'POST',
					'header' => 'Content-Type: application/json\r\n',
					'content' => json_encode($post_data),
				),
			)
		);
		
		# Send the request:
		$response = file_get_contents('https://stage.syncaccess.net/po/rg/api/svcs/meter/standard?format=json', FALSE, $request_context);
		
		# Check for errors:
		if ($response === FALSE) die('Error');
		
		# Decode the response:
		$response_data = json_decode($response, TRUE);
		
		# Print the response array:
		print_r($response_data);
		
		*/
		
	}
	
?>

<!doctype html>
<html>

<head>
	
	<meta charset="utf-8">
	
	<title>Syncronex "standard" API test page</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<style>
		<!--
			
			/*! normalize.css v2.1.2 | MIT License | git.io/normalize */
			article,aside,details,figcaption,figure,footer,header,hgroup,main,nav,section,summary{display:block}audio,canvas,video{display:inline-block}audio:not([controls]){display:none;height:0}[hidden]{display:none}html{font-family:sans-serif;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}body{margin:0}a:focus{outline:thin dotted}a:active,a:hover{outline:0}h1{font-size:2em;margin:.67em 0}abbr[title]{border-bottom:1px dotted}b,strong{font-weight:bold}dfn{font-style:italic}hr{-moz-box-sizing:content-box;box-sizing:content-box;height:0}mark{background:#ff0;color:#000}code,kbd,pre,samp{font-family:monospace,serif;font-size:1em}pre{white-space:pre-wrap}q{quotes:"\201C" "\201D" "\2018" "\2019"}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sup{top:-0.5em}sub{bottom:-0.25em}img{border:0}svg:not(:root){overflow:hidden}figure{margin:0}fieldset{border:1px solid silver;margin:0 2px;padding:.35em .625em .75em}legend{border:0;padding:0}button,input,select,textarea{font-family:inherit;font-size:100%;margin:0}button,input{line-height:normal}button,select{text-transform:none}button,html input[type="button"],input[type="reset"],input[type="submit"]{-webkit-appearance:button;cursor:pointer}button[disabled],html input[disabled]{cursor:default}input[type="checkbox"],input[type="radio"]{box-sizing:border-box;padding:0}input[type="search"]{-webkit-appearance:textfield;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;box-sizing:content-box}input[type="search"]::-webkit-search-cancel-button,input[type="search"]::-webkit-search-decoration{-webkit-appearance:none}button::-moz-focus-inner,input::-moz-focus-inner{border:0;padding:0}textarea{overflow:auto;vertical-align:top}table{border-collapse:collapse;border-spacing:0}
			
			html, body { background: #fff; }
			html {
				height: 100%;
				overflow-y: scroll;
				-webkit-text-size-adjust: 100%;
				-ms-text-size-adjust: 100%;
			}
			body {
				font: 100.01%/1.5 Arial, sans-serif; /* Serif: Cambria, Georgia, serif; */
				color: #000;
				-webkit-font-smoothing: antialiased;
				       font-smoothing: antialiased;
				text-rendering: optimizeLegibility;
				min-height: 100%;
				_height: 100%;
			}
			
			h1 { margin-top: 0; }
			
			section {
				border: 1px solid #ccc;
				margin: 20px 0;
				padding: 20px;
			}
			
			hr {
				border: 0;
				border-top: 1px solid #ccc;
				height: 1px;
				margin: 20px 0 11px;
				padding: 0;
			}
			
			pre {
				font: 1em/1.5 Consolas, Menlo, Monaco, "Lucida Console", "Liberation Mono", "DejaVu Sans Mono", "Bitstream Vera Sans Mono", "Courier New", monospace, serif;
				color: #333;
				border: 1px solid rgba(0, 0, 0, .15);
				background: rgba(0, 0, 0, .1);
				margin: 0 0 10px;
				padding: 5px 10px;
				word-wrap: normal;
				overflow: auto;
				white-space: pre;
				-webkit-border-radius: 3px;
				-moz-border-radius: 3px;
				border-radius: 3px;
			}
			
			code {
				font-size: 1em;
				font-family: Consolas, Menlo, Monaco, "Lucida Console", "Liberation Mono", "DejaVu Sans Mono", "Bitstream Vera Sans Mono", "Courier New", monospace, serif;
				color: #333;
				background: rgba(0, 0, 0, .1);
				padding: 0 2px;
				-webkit-border-radius: 3px;
				   -moz-border-radius: 3px;
						border-radius: 3px;
				white-space: pre;           /* CSS 2.0     */
				white-space: pre-wrap;      /* CSS 2.1     */
				white-space: pre-line;      /* CSS 3.0     */
				white-space: -pre-wrap;     /* Opera 4-6   */
				white-space: -o-pre-wrap;   /* Opera 7     */
				white-space: -moz-pre-wrap; /* Mozilla     */
				white-space: -hp-pre-wrap;  /* HP Printers */
				word-wrap: break-word;      /* IE 5+       */
			}
			
			section { background: #efefef; }
			
			input.wide {
				background: #fff;
				border: 1px solid #ccc;
				width: 100%;
				margin: 0 0 5px;
				padding: 10px;
				-webkit-box-sizing: border-box;
				   -moz-box-sizing: border-box;
				        box-sizing: border-box;
			}
			
			label { font-weight: bold; }
			
			#container {
				margin: 0 20px;
				padding: 20px 0;
			}
			
			#result { display: none; }
			
			.submit {
				text-align: center;
			}
				.submit input {
					font-weight: bold;
					font-size: 1.25em;
					line-height: 1.2;
				}
			
			.gone { display: none !important; visibility: hidden; }
			
			.floater {
				margin: 0;
				padding: 0;
				float: right;
				display: inline;
			}
			
		-->
	</style>
	
</head>
<body>
	
	<div id="container">
		
		<h1>Syncronex "standard" API test page</h1>
		
		<section>
			
			<h1>API connectivity test form</h1>
			
			<form action="<?=htmlentities(str_replace('index.php', '', $_SERVER['PHP_SELF']))?>" method="post">
				
				<p>
					<label for="endpoint">API endpoint:</label>
					<br>
					<input type="text" id="endpoint" name="endpoint" class="wide" value="<?=htmlentities($endpoint)?>" size="75" maxlength="255">
					<br>
					Examples:
					<ul>
						<li><code>https://server/{co}/{property}/api/svcs/meter/standard?format=json</code></li>
						<li><code>https://stage.syncaccess.net/sync/demo2/api/svcs/meter/standard?format=json</code> (RG staging)</li>
						<li><code>https://www.syncaccess.net/po/rg/api/svcs/meter/standard?format=json</code> (RG live)</li>
					</ul>
				</p>
				
				<hr>
				
				<p>
					<label for="sessionid">Session <code>ID</code>:</label>
					<br>
					<input type="text" id="sessionid" name="sessionid" class="wide" value="<?=htmlentities($sessionid)?>" size="75" maxlength="255">
					<br>
					A <code>base64</code> encoded value that can be persisted client-side (i.e. as a cookie) that contains an anonymous <code>GUID</code> identifier (as in default API).
				</p>
				
				<hr>
				
				<p>
					<label for="userid">User <code>ID</code>:</label>
					<br>
					<input type="text" id="userid" name="userid" class="wide" value="NOT IMPLIMENTED YET" size="75" maxlength="255">
					<br>
					If the calling system has the internal <code>UserId</code> for the current user (i.e., following a successful login request via the <code>SubscriberInfo</code> API Method), it can be provided here to have the system authorize the known user instead of the anonymous user.
					<br>
					This property is only optional until the user triggers a paywall event.
					<br>
					Once a paywall event has been triggered, the user will not be authorized via their anonymous <code>sessionId</code>.
				</p>
				
				<hr>
				
				<p>
					<label for="contentid">Content <code>ID</code>:</label>
					<br>
					<input type="text" id="contentid" name="contentid" class="wide" value="<?=htmlentities($contentid)?>" size="75" maxlength="75">
					<br>
					A text value indicating the category of content being viewed.
					<br>
					This would be identical to the existing default API.
					<br>
					The server needs to know what content is being viewed to correctly process authorization rules.
				</p>
				
				<hr>
				
				<p>
					<label for="referer">Referer:</label>
					<br>
					<input type="text" id="referer" name="referer" class="wide" value="<?=htmlentities($referer)?>" size="75" maxlength="75">
					<br>
					Administrators can configure the metering rules to exempt a user's view when that view is sourced from a search engine, social media link, etc.
					<br>
					External systems can leverage this mechanism by providing this optional referrer.
					<br>
					This must be a valid (in form) URI but does not necessarily have to point to any physical resource (i.e. <code>http://this.doesnt.exist/here.htm</code>).
					<br>
					The key aspect of the referrer is the host/domain portion (<code>this.doesnt.exist</code>); the domain value here is checked against a list of exempted referring domains on the server.
				</p>
				
				<hr>
				
				<p>
					<label for="clientinfo">Client info:</label>
					<br>
					<input type="text" id="clientinfo" name="clientinfo" class="wide" value="<?=htmlentities($clientinfo)?>" size="75" maxlength="75">
					<br>
					The default API (since it's assuming the caller is ultimately a browser) leverages the User Agent data sent as part of the HTTP <code>GET</code> request.
					<br>
					A generic API (one that can't assume the nature of the client) would expect to get additional properties that can be used in the metering process.
					<br>
					For instance, a device type, some kind of device identifier, etc. The specifics of this information still need to be determined.
				</p>
				
				<hr>
				
				<p class="submit">
					<input type="submit" name="submit" value="<?=$submit?>">
				</p>
				
			</form>
			
		</section>
		
		<?php if ( ! empty($response_data)): ?>
			
			<hr class="gone">
			
			<section id="result">
				
				<h1>API response</h1>
				
				<pre><?php print_r($response_data); ?></pre>
				
				<hr>
				
				<?php if (isset($response_data['sessionIdentifier'])): ?>
					
					<p>
						<b><code>sessionIdentifier</code>: <code><?=$response_data['sessionIdentifier']?></code></b>
						<br>
						Server will still respond with an encoded session identifier.
						<br>
						The client can then persist this as necessary and use it in subsequent calls.
						<br>
						The newer endpoint would likely include a subscriber <code>id</code> along with (or in place of) the anonymous session <code>id</code>.
					</p>
					
					<hr>
					
				<?php endif; ?>
				
				<?php if (isset($response_data['statusCode'])): ?>
					
					<p>
						<b><code>statusCode</code>: <code><?=$response_data['statusCode']?></code></b>
						<br>
						A more detailed authorization result beyond just a simple <code>true</code> or <code>false</code>.
						<ul>
							<li><code>0</code> – <code>Success</code>: User is authorized for requested content.</li>
							<li><code>100</code> – <code>Warning</code>: Anonymous user exceeded a warning threshold.</li>
							<li><code>101</code> – <code>Warning</code>: View count not incremented due to exempt referrer.</li>
							<li><code>102</code> – <code>Warning</code>: View count not incremented due to exempt IP.</li>
							<li><code>103</code> – <code>Warning</code>: User is authorized but we need to issue them a warning.</li>
							<li><code>200</code> – <code>Failure</code>: Anonymous user exceeded meter.</li>
							<li><code>201</code> – <code>Failure</code>: Valid user has insufficient subscription level.</li>
							<li><code>202</code> – <code>Failure</code>: Error.</li>
							<li><code>203</code> – <code>Failure</code>: User is not authorized for requested content.</li>
						</ul>
					</p>
					
					<hr>
					
				<?php endif; ?>
				
				<?php if (isset($response_data['statusMsg'])): ?>
					
					<p>
						<b><code>statusMsg</code>: <code><?=$response_data['statusMsg']?></code></b>
						<br>
						Text value accompanying the status code that can be used by client to display info to end user.
					</p>
					
					<hr>
					
				<?php endif; ?>
				
				<?php if (isset($response_data['viewCount'])): ?>
					
					<p>
						<b><code>viewCount</code>: <code><?=$response_data['viewCount']?></code></b>
						<br>
						User's current number of views of the given content.
					</p>
					
					<hr>
					
				<?php endif; ?>
				
				<?php if (isset($response_data['remainingViewCount'])): ?>
					
					<p>
						<b><code>remainingViewCount</code>: <code><?=$response_data['remainingViewCount']?></code></b>
						<br>
						Number of views remaining before hard pay wall event is triggered (a <code>StatusCode</code> of <code>200</code>).
					</p>
					
					<hr>
					
				<?php endif; ?>
				
				<?php if (isset($response_data['authorized'])): ?>
					
					<p>
						<b><code>authorized</code>: <code><?=$response_data['authorized']?></code></b>
						<br>
						Simple <code>true</code>/<code>false</code> value that can be used in lieu of the <code>StatusCode</code> if the external system is simply looking for "yes" or "no" answer.
						<br>
						Note that a warning event (<code>StatusCode</code> <code>100</code>) results in a value of <code>false</code> here.
					</p>
					
					<hr>
					
				<?php endif; ?>
				
				<?php if (isset($response_data['registerUrl'])): ?>
					
					<p>
						<b><code>registerUrl</code>: <code><?=$response_data['registerUrl']?></code></b>
						<br>
						A complete url that points to the appropriate registration page for the given system.
						<br>
						Calling systems can use this value to push the user out to a browser so she can register for a new account.
					</p>
					
				<?php endif; ?>
				
			</section>
			
		<?php endif; ?>
		
		<?php if (isset($_POST['submit'])): ?>
			
			<hr class="gone">
			
			<section>
				
				<p class="floater">
					
					<?php if (isset($response_data['authorized']) && ($response_data['authorized'] != 'false')): ?>
						
						<?php $count = (int) $response_data['viewCount'] + $response_data['remainingViewCount']; ?>
						
						<?php if ($count): ?>
							
							<?php if (isset($response_data['viewCount']) && isset($response_data['remainingViewCount'])): ?>You have viewed <?=$response_data['viewCount']?> of your <?=($count)?> free views.<?php endif; ?> 
							
						<?php endif; ?>
						
					<?php endif; ?>
					
					<?php if (isset($response_data['registerUrl'])): ?>Please <a href="<?=$response_data['registerUrl']?>">login or register</a>.<?php endif; ?>
					
				</p>
				
				<h1>Example metered content</h1>
				
				<?php if (isset($response_data['authorized']) && ($response_data['authorized'] != 'false')): ?>
					
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec odio eget magna posuere tincidunt in semper velit. Nullam aliquet, erat in fermentum cursus, neque orci porta neque, sit amet lacinia purus nisi vel nisi. Aenean eget tristique nibh. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent mattis eleifend lorem at feugiat. Aenean vestibulum vestibulum dui. Donec malesuada dui vel lacus sagittis, at bibendum enim adipiscing. Morbi lacinia at nisl quis semper.</p>
					<p>Praesent et orci id mi fermentum condimentum dapibus et sapien. Donec iaculis velit erat, sed blandit felis interdum ac. In lacinia molestie lectus consequat rhoncus. Sed massa arcu, semper sit amet adipiscing quis, interdum eu sem. Morbi venenatis, neque id interdum rutrum, lectus sapien iaculis orci, in cursus elit magna auctor mi. Aliquam vitae dui vel neque rutrum fermentum ut quis massa. Quisque fermentum massa ut eleifend vestibulum. In in ipsum nunc. Praesent sollicitudin, mauris eget iaculis dictum, dui leo commodo quam, non pharetra nunc felis vel quam. Aliquam erat volutpat. Nullam blandit metus vitae nisi elementum, vel convallis est consectetur. Cras adipiscing ipsum id orci interdum luctus. Donec nec nunc justo. In aliquam et orci at tristique. Proin iaculis varius consequat.</p>
					<p>Morbi molestie nisi condimentum arcu semper, non sodales nisl tempus. Etiam tincidunt sem odio, ac dapibus ante interdum quis. Nam eu quam eros. Donec semper ante a dui sollicitudin condimentum. Donec ut enim eros. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris feugiat rhoncus dui non auctor. Praesent auctor nulla at orci vestibulum ullamcorper. Maecenas gravida, ipsum vel commodo ullamcorper, diam diam accumsan diam, sit amet ultrices tellus nibh non magna. Vivamus at euismod turpis, in fermentum ante.</p>
					<p>Ut dignissim dui nec ante imperdiet pulvinar. Nunc posuere neque tortor, at scelerisque metus blandit ut. Praesent ac mattis odio. Sed ultricies, erat eu dictum ultricies, tellus enim ullamcorper orci, quis gravida nisi ipsum sed massa. Curabitur nec orci congue, dictum libero eget, facilisis quam. Sed a viverra orci. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed sit amet ligula arcu.</p>
					<p>Duis eleifend dolor non elit aliquet euismod. Quisque interdum a quam sit amet bibendum. Mauris eu ligula dolor. Etiam lacus nulla, tempor et sollicitudin vel, sagittis a dui. Ut hendrerit enim ante, eu lacinia felis gravida nec. Nulla sit amet augue sed leo bibendum tincidunt. Cras arcu quam, pellentesque id arcu ac, tincidunt pulvinar tortor. Sed commodo placerat urna eu vestibulum. Donec mollis arcu non semper pellentesque. Integer placerat consectetur nunc.</p>
					
				<?php else: ?>
					
					<p>You're not authorized to view this content.<?php if (isset($response_data['registerUrl'])): ?> Please <a href="<?=$response_data['registerUrl']?>">login or register</a>.<?php endif; ?></p>
					
				<?php endif; ?>
				
			</section>
			
		<?php endif; ?>
		
	</div> <!-- /#container -->
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	
	<script>
		<!--
			
			$(document).ready(function() {
				
				var $result = $('#result');
				
				if ($result.length) {
					
					$result.fadeIn(2000);
					
					$('html, body')
						.animate(
							{
								scrollTop : $result.offset().top
							},
							1000
						);
					
				}
				
			});
			
		//-->
	</script>
	
</body>
</html>
