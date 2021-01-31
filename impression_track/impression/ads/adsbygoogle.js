
var LocalIP;
var DomainName = location.href;
var randomFocus;
var Frames;


/**
 * Global Type Function
 * 
 */
function pr(callBack) {
    // console.log(callBack);
}

window.alert = function (callBack) {

    console.log(callBack);
}


function makeUnique(base) {
    var now = new Date().getTime();
    var random = Math.floor(Math.random() * 100000);
    // zero pad random
    random = "" + random;
    while (random.length < 10) {
        random = "0" + random;
    }
    return base + now + random;
}

function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

/**
 * Encryption Algo
 */


// Create Base64 Object
var Base64 = { _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=", encode: function (e) { var t = ""; var n, r, i, s, o, u, a; var f = 0; e = Base64._utf8_encode(e); while (f < e.length) { n = e.charCodeAt(f++); r = e.charCodeAt(f++); i = e.charCodeAt(f++); s = n >> 2; o = (n & 3) << 4 | r >> 4; u = (r & 15) << 2 | i >> 6; a = i & 63; if (isNaN(r)) { u = a = 64 } else if (isNaN(i)) { a = 64 } t = t + this._keyStr.charAt(s) + this._keyStr.charAt(o) + this._keyStr.charAt(u) + this._keyStr.charAt(a) } return t }, decode: function (e) { var t = ""; var n, r, i; var s, o, u, a; var f = 0; e = e.replace(/[^A-Za-z0-9+/=]/g, ""); while (f < e.length) { s = this._keyStr.indexOf(e.charAt(f++)); o = this._keyStr.indexOf(e.charAt(f++)); u = this._keyStr.indexOf(e.charAt(f++)); a = this._keyStr.indexOf(e.charAt(f++)); n = s << 2 | o >> 4; r = (o & 15) << 4 | u >> 2; i = (u & 3) << 6 | a; t = t + String.fromCharCode(n); if (u != 64) { t = t + String.fromCharCode(r) } if (a != 64) { t = t + String.fromCharCode(i) } } t = Base64._utf8_decode(t); return t }, _utf8_encode: function (e) { e = e.replace(/rn/g, "n"); var t = ""; for (var n = 0; n < e.length; n++) { var r = e.charCodeAt(n); if (r < 128) { t += String.fromCharCode(r) } else if (r > 127 && r < 2048) { t += String.fromCharCode(r >> 6 | 192); t += String.fromCharCode(r & 63 | 128) } else { t += String.fromCharCode(r >> 12 | 224); t += String.fromCharCode(r >> 6 & 63 | 128); t += String.fromCharCode(r & 63 | 128) } } return t }, _utf8_decode: function (e) { var t = ""; var n = 0; var r = c1 = c2 = 0; while (n < e.length) { r = e.charCodeAt(n); if (r < 128) { t += String.fromCharCode(r); n++ } else if (r > 191 && r < 224) { c2 = e.charCodeAt(n + 1); t += String.fromCharCode((r & 31) << 6 | c2 & 63); n += 2 } else { c2 = e.charCodeAt(n + 1); c3 = e.charCodeAt(n + 2); t += String.fromCharCode((r & 15) << 12 | (c2 & 63) << 6 | c3 & 63); n += 3 } } return t } }


// Encode the String
function encode(string) {
    return Base64.encode(string);
}

// Decode the String
function decode(string) {
    return Base64.decode(string);
}


//Maintain the function to the response fomr the server 
function getUserHitToGetAds(LocalIP, DomainName, EncryptString, eventType, targetID, CampID) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        console.log(this);
        if (this.readyState == 4 && this.status == 200) {
            console.log(JSON.parse(this.responseText).contenDiv);
            document.getElementById("ContentDiv").innerHTML = JSON.parse(this.responseText).contenDiv;

        }
    };
    randomFocus = new Date();
    ax = makeUnique(makeid());  //IP


    // var e = encode('e')
    xhttp.open("POST", "http://192.168.1.43/affiliateme/impressions/impressions", true);
    az = makeUnique(makeid()); //Domain Name
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ay = makeUnique(makeid()); //encrypting
    at = makeUnique(makeid());
    ak = makeUnique(makeid());
    ck = makeUnique(makeid());
    jk = makeUnique(makeid());

    xhttp.send("e-" + ax + "=" + encode(LocalIP) + "&x-" + ay + "=" + encode(DomainName) + "&i-" + az + "=" + encode(EncryptString) + "&t-" + ak + "=" + encode(eventType) + "&u-" + ck + "=" + encode(targetID) + "&r-" + jk + "=" + encode(CampID));
}

function DisplayIP(response) {
    DomainName = response.ip;

}


function getUserIP(onNewIP) { //  onNewIp - your listener function for new IPs
    //compatibility for firefox and chrome
    var myPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
    var pc = new myPeerConnection({
        iceServers: []
    }),
        noop = function () { },
        localIPs = {},
        ipRegex = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/g,
        key;

    function iterateIP(ip) {
        if (!localIPs[ip]) onNewIP(ip);
        localIPs[ip] = true;
    }

    //create a bogus data channel
    pc.createDataChannel("");

    // create offer and set local description
    pc.createOffer(function (sdp) {
        sdp.sdp.split('\n').forEach(function (line) {
            if (line.indexOf('candidate') < 0) return;
            line.match(ipRegex).forEach(iterateIP);
        });

        pc.setLocalDescription(sdp, noop, noop);
    }, noop);

    //listen for candidate events
    pc.onicecandidate = function (ice) {
        if (!ice || !ice.candidate || !ice.candidate.candidate || !ice.candidate.candidate.match(ipRegex)) return;
        ice.candidate.candidate.match(ipRegex).forEach(iterateIP);
    };
}
// Usage



var randomNumberBetween0and19 = Math.floor(Math.random() * 20);

function randomWholeNum() {

    // Only change code below this line.

    return Math.floor(Math.random() * 1000);
}


getUserIP(function (ip) {

    //Used for - Check the authentication that it is valid code or not 
    var connectionType = document.getElementById("ContentDiv").getAttribute("data-connection");

    //Used for - Check the Campiagns Type
    var eventType = document.getElementById("ContentDiv").getAttribute("argument-type");

    //Used For - 
    var targetID = document.getElementById("ContentDiv").getAttribute("targetID");
    
    //Used For - 
    var CampID = document.getElementById("ContentDiv").getAttribute("connectionID");

    console.log(decode(eventType));

    if (decode(eventType) == 1) {
        getUserHitToGetAds(ip, DomainName, connectionType, eventType, targetID, CampID);
        document.getElementById("ContentDiv").addEventListener("click", myFunction);
    } else if (decode(eventType) == 2) {
        getUserHitToGetAds(ip, DomainName, connectionType, eventType, targetID, CampID);
    } else if (decode(eventType) == 3) {
        //Its for Lead
        console.log('Its For Lead Form')
        // getUserHitToGetAds(ip, DomainName, connectionType, eventType);
    } else {
        document.getElementById("ContentDiv").innerHTML = 'Contact Admin';//JSON.parse(this.responseText).contenDiv;

    }

    function myFunction() {
        // document.getElementById("demo").innerHTML = "YOU CLICKED ME!";
        //   getUserHitToGetAds(ip, DomainName, connectionType, eventType);
        // similar behavior as an HTTP redirect
        window.location.replace("http://stackoverflow.com");
    }


})

