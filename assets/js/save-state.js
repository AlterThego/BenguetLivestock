
// Save scroll position to sessionStorage before the page reloads
window.onbeforeunload = function () {
    sessionStorage.setItem("scrollPos", window.scrollY);
};


// Restore scroll position from sessionStorage on page load
window.onload = function () {
    var scrollPos = sessionStorage.getItem("scrollPos");
    if (scrollPos !== null) {
        window.scrollTo(0, scrollPos);
        sessionStorage.removeItem("scrollPos");
    }
};
