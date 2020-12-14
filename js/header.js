//https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_mobile_navbar

document.querySelector("#test").addEventListener('click', function (e) {
    myFunction();
})


function myFunction() {
    var x = document.getElementById("mylinks");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}