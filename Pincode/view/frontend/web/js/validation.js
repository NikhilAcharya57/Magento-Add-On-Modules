function CheckIndianZipCode(pincode){
    var pattern=/^\d{6}$/;
    if (!pattern.test(pincode))  {
        alert("Pin code should be 6 digits ");
        return false;
    }
}

function hideMessage1() {
    document.getElementById("true").style.display = "none";
};
setTimeout(hideMessage1, 5000);

function hideMessage2() {
    document.getElementById("false").style.display = "none";
};
setTimeout(hideMessage2, 5000);




