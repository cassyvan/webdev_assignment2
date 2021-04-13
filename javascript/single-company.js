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

        displayImage(company);
        displayContent(company);
        displayButtons(company);
    }

    function displayImage(company) {
        let image = document.createElement("img");
        image.src = `logos/${company[0].symbol}.svg`;
        singleCompany.appendChild(image);
        console.log(image);
    }

    function displayContent(company) {
        let heading = document.createElement("h2");
        heading.innerHTML = `${company[0].name} (${company[0].symbol})</br>`;
        singleCompany.appendChild(heading);

        let info = document.createElement("div");

        const fields = [
            ["Sector", company[0].sector],
            ["Sub-Industry", company[0].subindustry],
            ["Address", company[0].address],
            ["Exchange", company[0].exchange],
            ["Description", company[0].description]
        ];

        fields.forEach((f) => {
            let subHeading = document.createElement("h3");
            subHeading.innerHTML = `${f[0]}: </br>`;
            let para = document.createElement("p");
            para.innerHTML = `${f[1]} </br>`;
            info.appendChild(subHeading);
            info.appendChild(para);
        })
        singleCompany.appendChild(info);

        let website = document.createElement("a");
        website.href = `${company[0].website}`;
        website.appendChild(document.createTextNode(`${company[0].website}`));
        console.log(website);
        singleCompany.appendChild(website);
    }

    function displayButtons(company) {

        let favoriteButton = document.createElement("button");
        favoriteButton.setAttribute("class", "favButton")
        let favLink = document.createElement("a");
        favLink.href = `favorites.php?company=${company[0].symbol}`;
        favLink.appendChild(document.createTextNode("Add to Favorites"));
        favoriteButton.appendChild(favLink);
        buttons.appendChild(favoriteButton);

        let historyButton = document.createElement("button");
        historyButton.setAttribute("class", "historyButton")
        let histLink = document.createElement("a");
        histLink.href = `history.php?symbol=${company[0].symbol}`;
        histLink.appendChild(document.createTextNode("Stock History Data"));
        historyButton.appendChild(histLink);
        buttons.appendChild(historyButton);
    }
})