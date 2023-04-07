var botToTopBtn = document.getElementById("botToTopBtn");
$('#botToTopBtn').hide();
window.onscroll = function() {handleScroll()};
function handleScroll() {
    if (document.documentElement.scrollTop >= 755) {
        botToTopBtn.style.display = "block";
    } else {
        botToTopBtn.style.display = "none";
    }
}

function botToTop() {
    window.scrollTo({top: 0, behavior: 'smooth'});
}