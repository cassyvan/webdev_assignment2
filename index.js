document.addEventListener("DOMContentLoaded", function () {

    const hamburgerIcon = document.querySelector(".hamburgerIcon");
    const navLinks = document.querySelector("#navLinks");
    const companiesAPI = "api-companies.php";
    const companyList = document.querySelector(".companiesList");

    // display hamburger menu was found in https://www.w3schools.com/howto/howto_js_mobile_navbar.asp
    navLinks.style.display = "none";
    hamburgerIcon.addEventListener("click", () => {
        if (navLinks.style.display === "none") {
            navLinks.style.display = "block";
        } else {
            navLinks.style.display = "none";
        }
    })

    fetch(companiesAPI)
        .then(data => data.json())
        .then(data => outputCompanyList(data))
        .catch(err => console.log(err))

    function outputCompanyList(companies) {
        for (let c of companies) {
            let newItem = document.createElement("li");
            newItem.textContent = c.name;
            companyList.appendChild(newItem);
            newItem.addEventListener("click", () => {
                // page redirection found on https://www.codegrepper.com/code-examples/html/javascript+onclick+redirect+to+url
                location.href = `single-company.php?symbol=${c.symbol}`
            })
        }
    }
})