document.addEventListener("DOMContentLoaded", function () {

    // grabbing query string in javascript found on https://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('symbol');
    const companyAPI = "api-companies.php?symbol=" + myParam;

    console.log("working");
    console.log(companyAPI);

    fetchSingleCompany();

    function fetchSingleCompany() {
        console.log("yes");
        fetch(companyAPI)
            .then(response => response.json())
            .then(data => {
                console.log(data);
        })
            .catch((error) => {
                console.log(error);
        });
    }

})