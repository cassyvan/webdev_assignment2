document.addEventListener("DOMContentLoaded", function () {

    const hamburgerIcon = document.querySelector(".hamburgerIcon");
    const navLinks = document.querySelector("#navLinks");

    // display hamburger menu was found in https://www.w3schools.com/howto/howto_js_mobile_navbar.asp
    navLinks.style.display = "none";
    hamburgerIcon.addEventListener("click", () => {
        console.log("yes");
        if (navLinks.style.display === "none") {
            navLinks.style.display = "block";
        } else {
            navLinks.style.display = "none";
        }
    })
})