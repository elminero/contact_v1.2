/**
 * Created by Ian on 9/4/2015.
 */

function preparePage() {
    document.getElementById("delete").onclick = function()
    {
        if (!confirm('Delete ?')) {
            return false;
        }
    };

    document.getElementById("update").onclick = function()
    {
        if (!confirm('Update ?')) {
            return false;
        }
    };

}

window.onload = function() {
    preparePage();
};

