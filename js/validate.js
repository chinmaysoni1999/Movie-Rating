window.onsubmit=validateForm;

function validateForm() {
    if (document.getElementById("pw").value != "" && !document.getElementById("pw").value.match(/\d+/g)) {
        alert("password must contain a number!");
        return false;
    } else {
        return true;
    }
}