// I am a collection of useful scripts...

var app = app || {};

app.config = {
	"apiURL" : "http://search.twitter.com/search.json",
};

app.partialMap = {
	"header" : "partials/header.html",
	"footer" : "partials/footer.html",
	"main" : "partials/main.html",
	"about" : "partials/about.html",
	"apiTest" : "partials/apiTest.html"
};

app.init = function(){
	$('#header > #container').load(app.partialMap.header);
	if(window.location.hash != null){
		var hash = window.location.hash.replace(/#/gm,"");
		if(app.partialMap[hash] == undefined){
			alert("I'm sorry, but I can't find the "+hash+" page.");
			$('#main > #container').load(app.partialMap.main);
		}else{
			$('#main > #container').load(app.partialMap[hash]);
		}
	}else{
		$('#main > #container').load(app.partialMap.main);
	}
	$('#footer > #container').load(app.partialMap.footer);
}

app.fadingPartialChange = function(div, partial, duration){
	if(app.partialMap[partial] == undefined){
		alert("I'm sorry, but I can't find the "+partial+" page.");
	}else{
		t = new Date();
	    timestamp = t.getTime();
		window.location.hash = partial;
		if(duration == null){duration = 200;}
		$(div + " > #container").fadeOut(duration, function(){
			$('#main > #container').load(app.partialMap[partial] + "?rand=" + timestamp, function(){
				$(div + " > #container").fadeIn(duration, function(){
					return(true);
				});	
			});
		});
	}
}

app.showError = function(errorString){
	$("#errorAlertBox").stop().animate({opacity:'100'});
	$("#errorAlertBox").html(errorString);
	$("#errorAlertBox").show();
	$("#errorAlertBox").fadeOut(3000);
}

app.makeJSONCallback = function(URL){
    URL = URL.toString();
    var script = document.createElement('script');
    script.src = URL;
    document.body.appendChild(script);
}

app.apiRequest = function(Action, Callback, Params){
    t = new Date();
    timestamp = t.getTime();
    param_string = "?";
    param_string += "&RAND=" + timestamp;
    param_string += "&action=" + Action;
    if(Callback == null && console){ Callback = "console.log"; }
    param_string += "&callback=" + Callback
    for(x in Params)
    {
		param_string += "&" + encodeURIComponent(x) + "=" + encodeURIComponent(Params[x]);
    }
    api_req = app.config.apiURL + param_string;
    if (console) { console.log("requesting: " + api_req); }
    app.makeJSONCallback(api_req);
}

app.deleteAllCookies = function() {
    var cookies = document.cookie.split(";");
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}