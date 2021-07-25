/* Makes hidden payment input and submit button visible */
function show(elementId) { 
    document.getElementById("payment").style.display="show";
    document.getElementById("showpaybtn").style.display="none";
    document.getElementById(elementId).style.display="block";
}