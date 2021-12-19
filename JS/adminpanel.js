async function fetchData(url, request){
    return await fetch(
        url,
        {
            method: "POST", // *GET, POST, PUT, DELETE, etc.
            mode: "same-origin", // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: "same-origin", // include, *same-origin, omit
            headers: {
            "Content-Type": "application/json",  // sent request
            "Accept":       "application/json"   // expected data sent back
            },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            body: JSON.stringify(request), // body data type must match "Content-Type" header
        },
    ).then(res => {
        //res.clone().text().then(function(data) {console.log(data)})
        return res.json()
    });

}

document.getElementById("logout").addEventListener("click",async function() {
    var response = await fetchData('./API/POST/', {'requestType': 'logout'})
    if(response.data){
        window.location.replace("index.php");
    }
});
