/**
 * SyncWall
 * A jQuery-powered version of Syncronex's javascript paywall code
 *
 * @author Micky Hulse
 * @link http://hulse.me
 * @docs https://github.com/registerguard/syncwall
 * @copyright Copyright (c) 2013 Micky Hulse.
 * @license Released under the Released under the MIT license..
 * @version 0.1.0
 * @date 2013/04/30
 */

/*jshint jquery:true */

// http://codereview.stackexchange.com/questions/19799/a-jquery-utility-plugin-template-looking-for-peer-pro-feedback
// https://gist.github.com/mhulse/3068831

(function($, window, document, undefined) {
	
	'use strict';
	
	var console = window.console || { log : function() {}, warn : function() {} },
	
	defaults = {
		
		api      : 'https://stage.syncaccess.net:443/po/rg/api/svcs/meter', // JSONP API.
		cb       : (Math.round(Math.random() * 10000000000000000)), // Cache busting string.
		category : '', // Content category.
		session  : 'syncwall-sessionid'
		
		// Callbacks.
		// Other options.
		
	},
	
	methods = {
		
		init : function(options) {
			
			var settings,
			    meta,
			    cookie1,
			    cookie2,
			    loc,
			    refer,
			    uri;
			
			//$('#modal').omniWindow(); // Move elsewhere.
			
			if ($.cookie) {
				
				settings = $.extend({}, defaults, options);
				
				if (settings.api) {
					
					meta = $('meta[name=__sync_contentCategory]').attr('content');
					
					if (meta) {
						
						cookie1 = $.cookie('syncwall-sessionid') || '';
						cookie2 = $.cookie('sess') || '';
						
						loc = window.location;
						
						refer = referringDomain(document.referrer);
						
						//callServer(f, c, a, e, d, "serverCallback");
						//callServer(cookie1, meta, cookie2, refer, loc, 'serverCallback');
						
						//var uri = settings.api + (settings.parent ? settings.parent + ':' : '') + settings.section + '/' + (settings.page ? settings.page + '/' : '') + '?callback=?';
						
						//"?sessionId=" + p + "&contentId=" + d + "&externalId=" + f + "&referrer=" + l + "&page=" + i + "&callback=" + c + "&nocache=" + new Date().getTime();
						
						uri = settings.api +
						      '?callback=?' +
						      '&sessionId=' + encodeURI(cookie1) +
						      '&contentId=' + encodeURIComponent(meta) +
						      '&externalId=' + encodeURIComponent(cookie2) +
						      '&referrer=' + encodeURIComponent(refer) +
						      '&page=' + encodeURIComponent(loc) +
						      '&nocache=' + defaults.cb +
						      '&formfactor=mobile';
						
						$.getJSON(uri, function (json) {
							success(settings, json);
						});
						
					} else {
						
						console.warn('Meta tag __sync_contentCategory is required.');
						
					}
					
				} else {
					
					console.warn('Options "api" and "section" are requried.');
					
				}
				
			} else {
				
				console.warn('jQuery Cookie plugin is requried.');
				
			}
			
		}
		
	},
	
	success = function(settings, json) {
		
		if (json.authorized !== 'true') {
			
			$('.modal')
				.html(json.overlayContent)
				.trigger('show');
			
		}
		
		$.cookie('syncwall-sessionid', json.sessionIdentifier, { expires: 36500, path: '/' });
		
	},
	
	// Need public function to allow for the user to personalize the modal window plugin init.
	
	referringDomain = function(uri) {
		
		var host = uri.split('/');
		
		return (host.length > 2) ? host[2] : '';
		
	};
	
	$.syncwall = function(method) {
		
		if (methods[method]) {
			
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
			
		} else if ((typeof method === 'object') || ( ! method)) {
			
			return methods.init.apply(this, arguments);
			
		} else {
			
			$.error('Method ' + method + ' does not exist on jQuery.ad_manager.');
			
		}
		
	};
	
}(jQuery, window, document));
