/**
 * Created by ian on 11/11/2014.
 */

function preparePage() {

    function getXMLHTTP() { //function to return the xml http object
        var xmlhttpRequest;

        if (window.XMLHttpRequest) {
            xmlhttpRequest = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            xmlhttpRequest = new ActiveXObject("Microsoft.XMLHTTP");
        }

        return xmlhttpRequest;
    }

    document.getElementById("country").onclick = function() {

        var strURL="includes/findState.php?country="+document.getElementById("country").value;
        var req = getXMLHTTP();
        if (req) {
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        document.getElementById('statediv').innerHTML=req.responseText;
                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            };

            req.open("GET", strURL, true);
            req.send(null);
        }

    }

}

window.onload = function() {
    preparePage();
};

