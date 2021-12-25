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
        res.clone().text().then(function(data) {console.log(data)})
        return res.json()
    });

}

function validateInput(input,error,regex) {
    var id = document.getElementById(input).value
    if(!(regex.test(id))){
        document.getElementById(error).style.display = "block"
        return false
    }else{
        document.getElementById(error).style.display = "none"
        return true
    }
}

document.getElementById("resetButton").addEventListener("click",async function (){
    if(validateInput("emailInput","emailError",/^(([a-z.\d])+\@northsouth.edu)$/gi)){
        var email = document.getElementById('emailInput').value
        var response = await fetchData('./API/POST/', {'requestType': 'resetPassword', 'email' : email})
        if(response.data){
            alert("Your new password is sent to your email!")
        }else{
            alert("Password reset failed!")
        }
    }
})

