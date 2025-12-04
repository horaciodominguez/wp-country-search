document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector(".csb-search-form");
    if (!form) return;

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        const country = form.querySelector(".csb-country-selector").value;
        const search  = form.querySelector(".csb-search-field").value;

        const params = new URLSearchParams();
        params.set("post_type", "product");

        if (country) params.set("product_country", country);
        if (search)  params.set("s", search);

        // always redirect to home URL
        window.location.href = CSB_VARS.home_url + "?" + params.toString();
    });

});
