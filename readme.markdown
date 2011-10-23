# API STATIC SITE FRONT END
A simple front-end structure for websites based on the DAVE Api methodology.

This is a framework website which is meant to be used in conjunction with a remote JSON API.  The philosophy behind this type of website is that it is entirely composed of static assets and js which can be rendered by the browser.  Transactions are decoupled from the front-end and processed via a well-formed API.  This example site is a single static HTML page with HTML partials which are loaded as needed (via the jQuery load() method).

`app.js` includes the main application files.  Example JSON actions can be found throughout this project, but they all make use of the `app.apiRequest(Action, Callback, Params)` method.  

I also employ ajax-friendly deep linking.

This type of website can be served by even the simplest of servers (S3 objects, even [GitHub static pages!](http://evantahler.github.com/api-static-site-frontend)), and work great behind load-balancers, as there is no server-side rendering done per-user.

Example of loosely-coupled APIs for a user login form:


	<form id="userLoginForm" action="#">
		screenName: <input type="Text" id="screenName"></input><br />
		password: <input type="Password" id="password"></input><br />
		<input id="userLoginSubmit" type="submit" value="sign in"></input>
	</form>


	<script>
	app.page = {};
	$('#userLoginForm').bind("submit", function(e){
		params = {};
		params.password = $('#userLoginForm > #password').val();
		params.screenName = $('#userLoginForm > #screenName').val();
		app.apiRequest("userLogIn", "app.page.processUserLoginResponse", params);
		event.preventDefault();
	});
	app.page.processUserLoginResponse = function(api){
		if(api.error != "OK"){ 
			app.showError(api.error); 
		}else{
			$.cookie('userID', api.userID);
			$.cookie('sessionKey', api.sessionKey);
			$.cookie('screenName', api.screenName);
			$.cookie('image', api.image);
			window.location.href = window.location.href; //reload
		}
	}
	</script>