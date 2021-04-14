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

    //filters the list of companies displayed, this was reused from assignment 1
    searchBox.addEventListener("keyup", event => {
        if (event.target.value.length >= 1) {
            toMatch = event.target.value.toUpperCase();
            const matches = companies.filter(c =>
                c.name.toUpperCase().includes(toMatch)
            )
            companiesList.innerHTML = "";
            outputCompanyList(matches)
        }
    });

    // clears the search box and resets the company ListeningStateChangedEvent. Clearing input value was found on https://www.w3schools.com/howto/howto_html_clear_input.asp
    resetButton.addEventListener("click", () => { companiesList.textContent = ""; searchBox.value = ""; outputCompanyList(companies) });

    // outputs the list of companies sorted by symbol
    function outputCompanyList(companies) {
        companiesList.textContent - "";
        for (let c of companies) {

            let company = document.createElement("li");
            let logoDiv = document.createElement("span");
            let logo = document.createElement("img");
            let logoOnMouse = document.createElement("img");
            let symbol = document.createElement("a");
            let name = document.createElement("a");
            let singleCompanyPage = `single-company.php?symbol=${c.symbol}`;
            logo.src = `logos/${c.symbol}.svg`;
            logo.id = "smallLogo";
            logoOnMouse.src = `logos/${c.symbol}.svg`;
            logoOnMouse.id = "logoOnMouseEvent";
            symbol.href = singleCompanyPage;
            symbol.textContent = c.symbol;
            symbol.id = "symbol";
            name.href = singleCompanyPage;
            name.textContent = c.name;
            name.id = "name";
            logoDiv.appendChild(logo);
            logoDiv.appendChild(logoOnMouse);
            company.appendChild(logoDiv);
            company.appendChild(symbol);
            company.appendChild(name);
            companiesList.appendChild(company);
            //handles the pop up function of each logo
            logoDiv.addEventListener("mouseenter", () => logoOnMouse.style.display = "block")
            logoDiv.addEventListener("mouseleave", () => logoOnMouse.style.display = "none")
            logoDiv.addEventListener("mousemove", (e) => moveLogoDiv(logoOnMouse, e));
        }
        loader1.style.display = "none";
    }

    // mouse event found on https://www.w3schools.com/jsref/tryit.asp?filename=tryjsref_onmousemove_addeventlistener as well as http://jsfiddle.net/q46Xz/187/
    function moveLogoDiv(logo, e) {
        let x = e.pageX;
        let y = e.pageY;
        logo.style.left = x + "px";
        logo.style.top = y + "px";
    }

})