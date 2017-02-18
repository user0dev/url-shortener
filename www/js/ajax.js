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
            var result = JSON.parse(this.responseText);
            document.getElementById("shortUrl").value = result.shortUrl;
        }
    };
    xmlhttp.open("GET", "ajax.php?long-url=" + longUrl, true);
    xmlhttp.send();
}