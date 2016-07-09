/**
 * Setup env variables which makes packaging and deployment easy
 */
(function (window) {
	window.__env = (window.__env || {});

	window.__env.siteTitle = '';
	/* Site title */
	window.__env.siteDescription = '';
	/* Site description */
	window.__env.apiUrl = 'http://localhost/prasadnevase/wp-json/wp/v2/';
	/* Change above to your API url. For production site it will be like http://example.com/wp-json/wp/v2/ */
	window.__env.baseUrl = '/prasadnevase/';
	/* Change above to your base url. For production site it will be: / */
	window.__env.siteUrl = 'http://localhost/prasadnevase/';
	/* Change above to yoru site url. For production site it will be like http://example.com/ */
	window.__env.defaultHeaderImg = window.__env.siteUrl + 'wp-content/themes/cleanblog/img/home-bg.jpg';
	/* Default header image */
	window.__env.loaderImg = window.__env.siteUrl + 'wp-content/themes/cleanblog/img/loader.gif';
	/* Default loader image */

	/* Use traditional javascript ajax as AngularJS env is not available here.
	*  Set up site title and site description as in WordPress
	* */
	var xmlhttp = new XMLHttpRequest();
	var url = "http://localhost/prasadnevase/wp-json/";
	/* Change above to appropriate URL in your case. For production site it will be like http://example.com/wp-json/ */
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var site = JSON.parse(xmlhttp.responseText);
			window.__env.siteTitle = __decodeHtmlEntity(site.name);
			window.__env.siteDescription = __decodeHtmlEntity(site.description);
		}
	};
	xmlhttp.open("GET", url, true);
	xmlhttp.send();

	function __decodeHtmlEntity(str) {
		return str.replace(/&#(\d+);/g, function (match, dec) {
			return String.fromCharCode(dec);
		});
	};

	/* Whether or not to enable debug mode
	*  Setting this to false will disable console output
	*/
	window.__env.enableDebug = true;
}(this));
