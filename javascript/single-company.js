document.addEventListener("DOMContentLoaded", function () {

    // grabbing query string in javascript found on https://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('symbol');
    const companyAPI = "api-companies.php?symbol=" + myParam;
    const singleCompany = document.querySelector(".singleCompany");
    const buttons = document.querySelector(".button");

    console.log(companyAPI);

    fetchSingleCompany();

    function fetchSingleCompany() {
        fetch(companyAPI)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                outputSingleCompany(data);
        })
            .catch((error) => {
                console.log(error);
        });
    }

    function outputSingleCompany(company) {

        const fields = [
            ["Symbol", company[0].symbol], 
            ["Name", company[0].name], 
            ["Sector", company[0].sector], 
            ["Sub-Industry", company[0].subindustry], 
            ["Address", company[0].address],
            ["Exchange", company[0].exchange],
            ["Website", company[0].website],
            ["Description", company[0].description]
        ];

        let image = document.createElement("img");
        image.src = `logos/${company[0].symbol}.svg`;
        singleCompany.appendChild(image);
        console.log(image);

        fields.forEach((f) => {
            let divi = document.createElement("div");
            singleCompany.appendChild(divi);
            divi.innerHTML = `${f[0]}: ${f[1]}`;
        })
        let favButton = document.createElement("button")
        let favLink = document.createElement("a");
        favLink.href = "favorites.php";
        favLink.appendChild(document.createTextNode("Add to Favorites"));
        favButton.appendChild(favLink);
        buttons.appendChild(favButton);
    
    
        let historyButton = document.createElement("button");
        let histLink = document.createElement("a");
        histLink.href = `history.php?symbol=${company[0].symbol}`;
        histLink.appendChild(document.createTextNode("Stock History Data"));
        historyButton.appendChild(histLink);
        buttons.appendChild(historyButton);
    }
})