function currentDate() {
    var options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    var today = new Date();

    var date = today.toLocaleDateString("en-US", options);

    document.getElementById("currentDate").innerHTML = date;
}