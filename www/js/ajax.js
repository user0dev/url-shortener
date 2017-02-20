/**
 * Created by user on 17.02.17.
 */

function getShortUrl() {
	"use strict";
	var longUrl = document.getElementById("longUrl").value;
	if (typeof longUrl !== "string" || longUrl.length <= 0) {
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
	var shortName = document.getElementById("shortName").value.trim();
	if (shortName !== "") {
		shortName = "&short-name=" + shortName;
	}
	xmlhttp.open("GET", "ajax.php?long-url=" + longUrl + shortName, true);
	xmlhttp.send();
}
