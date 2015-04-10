/**
 * Created by ian on 11/16/2014.
 */

function preparePage() {

    var req2;

    function getRequestObject() {

        if(window.XMLHttpRequest) {
            req2 = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            req2 = new ActiveXObject("Microsoft.XMLHTTP");
        }

        return req2;
    }

    document.getElementById("statediv").onchange = function() {

        document.getElementById("city").innerHTML="FUCK";

    };

}




window.onload = function() {
    preparePage();
};
