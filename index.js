document.addEventListener("DOMContentLoaded", function () {

    const hamburgerIcon = document.querySelector(".hamburgerIcon");
    const navLinks = document.querySelector("#navLinks");
    const companiesAPi = "http://localhost/webdev_assignment2/api-companies.php";
    console.log(companiesAPi);
    console.log("pooop");

    // display hamburger menu was found in https://www.w3schools.com/howto/howto_js_mobile_navbar.asp
    navLinks.style.display = "none";
    hamburgerIcon.addEventListener("click", () => {
        if (navLinks.style.display === "none") {
            navLinks.style.display = "block";
        } else {
            navLinks.style.display = "none";
        }
    })
    fetchCompanies();

    function fetchCompanies() {
        if (localStorage.length === 0) {
            fetch(companiesAPI)
                .then(response => response.json())
                .then(data => {
                    updateStorage(data);
                })
                .catch((error) => {
                    console.log(error);
                });
        }
        generateCompanyList();
        displayCompanyList();
    }

    function updateStorage(data) {
        for (let i = 0; i < data.length; i++) {
            localStorage.setItem(data[i].name, JSON.stringify(data[i]))
            nameKeys.push(data[i].name);
        }
        console.log(nameKeys);
    }

    function generateCompanyList() {

        for (let k of nameKeys) {
            let company = JSON.parse(localStorage.getItem(k))
            companyList.push(company);
        }
        companyList.sort(sortAlphaName);
    }

    function displayCompanyList() {
        document.querySelector("#loader1").style.display = "none";
        createListElements(companyList)
    }


    function createListElements(list) {
        for (let li of list) {
            let newItem = document.createElement("li");
            newItem.textContent = li.name;
            companyListElement.appendChild(newItem);
            newItem.addEventListener("click", () => {
                addCompanyInfoElementSections(li);
                populateCompanyInfo(li);
                updateMap(li);
                let stockDataToRetrieve = stockDataAPI + li.symbol
                console.log(stockDataToRetrieve)
                retrieveStockData(stockDataToRetrieve);
            })
        }
        console.log("list elements created");
    }


})