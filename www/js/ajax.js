/**
 * Created by user on 17.02.17.
 */

function getShortUrl() {
	"use strict";
	var longUrl = null;
    var longUrlElem = document.getElementById("longUrl");
    if (longUrlElem !== null) {
    	longUrl = longUrlElem.value;
	}
	if (typeof longUrl !== "string" || longUrl.length <= 0) {
    	console.log("Long Url wrong");
		return;
	}
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var shortUrl = JSON.parse(this.responseText).shortUrl;
			if (shortUrl != "") {
				document.getElementById("shortUrlBlock").style.visibility = "visible";
				document.getElementById("shortUrl").value = shortUrl;
				// document.getElementById("inputForm").onsubmit = function () {
				// 	return false;
				// };
			}
		}
	};
	var shortName = "";
	var shortNameElem = document.getElementById("shortName");
	if (shortNameElem !== null) {
        shortName = shortNameElem.value.trim();
        if (typeof shortName === "string" && shortName !== "") {
            shortName = "&short-name=" + shortName;
        } else {
        	shortName = "";
		}
	}
	xmlhttp.open("GET", "ajax.php?long-url=" + longUrl + shortName, true);
	xmlhttp.send();
}
