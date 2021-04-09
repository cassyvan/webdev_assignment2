document.addEventListener("DOMContentLoaded", function () {

    const companiesAPI = "api-companies.php";
    const companyList = document.querySelector(".companiesList");

    
    fetchCompanies();

    function fetchCompanies() {
        fetch(companiesAPI)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                outputCompanyList(data);
        })
            .catch((error) => {
                console.log(error);
        });
    }

       
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