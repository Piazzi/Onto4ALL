/**
 * Checks if the user is using Google Chrome or Firefox
 */
function isBrowserValid()
{
    /* Checks Browser */

		// Opera 8.0+
		var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;

		// Firefox 1.0+
		var isFirefox = typeof InstallTrigger !== 'undefined';

		// Safari 3.0+ "[object HTMLElementConstructor]"
		var isSafari = /constructor/i.test(window.HTMLElement) || (function(p) {
			return p.toString() === "[object SafariRemoteNotification]";
		})(!window['safari'] || (typeof safari !== 'undefined' && window['safari'].pushNotification));

		// Internet Explorer 6-11
		var isIE = /*@cc_on!@*/ false || !!document.documentMode;

		// Edge 20+
		var isEdge = !isIE && !!window.StyleMedia;

		// Chrome 1 - 79
		//var isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);

		// Edge (based on chromium) detection
		var isEdgeChromium = isChrome && (navigator.userAgent.indexOf("Edg") != -1);

		// Blink engine detection
		var isBlink = (isChrome || isOpera) && !!window.CSS;

		if (!isChrome && !isFirefox || isEdgeChromium)
            return false
        else
            return true;
}

if(!isBrowserValid())
{
    let overlay = document.getElementById('overlay');
    overlay.style.display = 'block';
}


