function toggleSwitcher() {
    var t = document.getElementById("style-switcher");
    "-165px" === t.style.left ? t.style.left = "-0px" : t.style.left = "-165px"
}

function setColor(t) {
    document.body.setAttribute("data-theme", t)
}

function setColorGreen() {
    document.body.setAttribute("data-theme", "purple")
}
var btn = document.getElementById("mode"),
    mybutton = (btn.addEventListener("click", function (t) {
        var e = localStorage.getItem("theme");
        "light" == e || "" == e ? (document.body.setAttribute("data-bs-theme", "dark"), localStorage.setItem("theme", "dark")) : (document.body.removeAttribute("data-bs-theme"), localStorage.setItem("theme", "light"))
    }), localStorage.setItem("theme", "light"), document.getElementById("back-to-top"));

function scrollFunction() {
    100 < document.body.scrollTop || 100 < document.documentElement.scrollTop ? mybutton.style.display = "block" : mybutton.style.display = "none"
}

function topFunction() {
    document.body.scrollTop = 0, document.documentElement.scrollTop = 0
}
window.onscroll = function () {
    scrollFunction()
};
for (var preloader = document.getElementById("preloader"), favouriteBtn = (window.addEventListener("load", function () {
        preloader.style.opacity = "0", preloader.style.visibility = "hidden"
    }), document.getElementsByClassName("bookmark-btn")), i = 0; i < favouriteBtn.length; i++) {
    var favouriteBtns = favouriteBtn[i];
    favouriteBtns.onclick = function () {
        favouriteBtns.classList.toggle("active")
    }
}
