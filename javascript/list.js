document.addEventListener("DOMContentLoaded", function () {

    const companiesAPI = "api-companies.php";
    const companiesList = document.querySelector(".companiesList")
    const loader1 = document.querySelector("#loader1");
    const companies = [];

    fetchCompanies();
    // fetches the list of companies from the API
    function fetchCompanies() {
        fetch(companiesAPI)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                storeDataIntoList(data);
                outputCompanyList(data);
            })
            .catch((error) => {
                console.log(error);
            });
    }

    function storeDataIntoList(data) {
        for (let d of data) {
            companies.push(d);
        }
    }

    //filters the list of companies displayed
    searchBox.addEventListener("keyup", event => {
        if (event.target.value.length >= 1) {
            const matches = companies.filter(c =>
                c.symbol.includes(event.target.value.toUpperCase())
            )
            companiesList.innerHTML = "";
            outputCompanyList(matches)
        }
    });

    // clears the search box and resets the company ListeningStateChangedEvent. Clearing input value was found on https://www.w3schools.com/howto/howto_html_clear_input.asp
    resetButton.addEventListener("click", () => {companiesList.textContent = ""; searchBox.value = ""; outputCompanyList(companies)});

    // outputs the list of companies sorted by symbol
    function outputCompanyList(companies) {
        companiesList.textContent - "";
        for (let c of companies) {

            let company = document.createElement("li");
            let logo = document.createElement("img");
            let symbol = document.createElement("a");
            let name = document.createElement("a");
            let singleCompanyPage = `single-company.php?symbol=${c.symbol}`;
            logo.src = `logos/${c.symbol}.svg`;
            symbol.href = singleCompanyPage;
            symbol.textContent = c.symbol;
            name.href = singleCompanyPage;
            name.textContent = c.name;
            company.appendChild(logo);
            company.appendChild(symbol);
            company.appendChild(name);
            companiesList.appendChild(company);
        }
        loader1.style.display = "none";
    }
})