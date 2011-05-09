/**************************************************************/
/* DAVE API ACCESS */

var API_URL = "/API/";

function makeJSONCallback(URL)
{
    URL = URL.toString();
    var script = document.createElement('script');
    script.src = URL;
    document.body.appendChild(script);
}

function apiRequest(Action, Callback, Params)
{
    t = new Date();
    timestamp = t.getTime();
    param_string = "?";
    param_string += "OutputType=JSON";
    param_string += "&RAND=" + timestamp;
    param_string += "&Action=" + Action;
    if(Callback == null){ Callback = "console.log"; }
    param_string += "&Callback=" + Callback
    for(x in Params)
    {
	param_string += "&" + encodeURIComponent(x) + "=" + encodeURIComponent(Params[x]);
    }
    api_req = API_URL + param_string;
    console.log("requesting: " + api_req);
    makeJSONCallback(api_req);
}

/**************************************************************/
/* COOKIES */

function getCookie(c_name)
{
if (document.cookie.length>0)
  {
  c_start=document.cookie.indexOf(c_name + "=");
  if (c_start!=-1)
    {
    c_start=c_start + c_name.length+1;
    c_end=document.cookie.indexOf(";",c_start);
    if (c_end==-1) c_end=document.cookie.length;
    return unescape(document.cookie.substring(c_start,c_end));
    }
  }
return "";
}

function setCookie(c_name,value,expiredays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate()+expiredays);
document.cookie=c_name+ "=" +escape(value)+
((expiredays==null) ? "" : ";expires="+exdate.toUTCString());
}

function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}

/**************************************************************/
/* XHR */

function XHRRequest(URL,functionName)
{
	var xhr; 
    try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
    catch (e) 
    {
        try {   xhr = new ActiveXObject('Microsoft.XMLHTTP');    }
        catch (e2) 
        {
          try {  xhr = new XMLHttpRequest();     }
          catch (e3) {  xhr = false;   }
        }
     }
  
    xhr.onreadystatechange  = function()
    { 
         if(xhr.readyState  == 4)
         {
              if(xhr.status  == 200) 
              {
              		if (xhr.responseText.length > 0)
              		{
              			functionName(JSON.parse(xhr.responseText));
              		}
              }
              else 
              {
                 return 'ERROR';
              }
         }
    }; 	
    
    xhr.open("GET", URL, true); 
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");    
	xhr.send("");
}

/***************************************************************/
/* SLEEP */
	
this.sleep = function ZZzzzZZzzzzzzZZZz(naptime)
{
	naptime = naptime * 1000;
	var sleeping = true;
	var now = new Date();
	var alarm;
	var startingMSeconds = now.getTime();
	while(sleeping){
	    alarm = new Date();
	    alarmMSeconds = alarm.getTime();
	    if(alarmMSeconds - startingMSeconds > naptime){ sleeping = false; }
	}        
}