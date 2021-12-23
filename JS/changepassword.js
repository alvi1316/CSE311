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

function validateOldPassword(){
    var oldPassword = document.getElementById("oldPassword").value
    if(oldPassword == ""){
        document.getElementById('oldPasswordError').style.display = "block"
        return false
    }else{
        document.getElementById('oldPasswordError').style.display = "none"
        return true
    }
}

function validateForm(){

    var oldPasswordIsValid = validateOldPassword()
    var newPasswordIsValid = validateInput("newPassword","newPasswordError",/^(?=.*[a-z])(?=.*\d)[a-zA-Z\d]{8,}$/g)

    return (oldPasswordIsValid && newPasswordIsValid)
}


document.getElementById("oldPassword").addEventListener("blur", function (){
    validateOldPassword()
})

document.getElementById("newPassword").addEventListener("blur", function (){
    validateInput("newPassword","newPasswordError",/^(?=.*[a-z])(?=.*\d)[a-zA-Z\d]{8,}$/g)
})

document.getElementById("logout").addEventListener("click",async function() {
    var response = await fetchData('./API/POST/', {'requestType': 'logout'})
    if(response.data){
        window.location.replace("index.php");
    }
});

document.getElementById("updatePasswordButton").addEventListener("click",async function (event){
    if(validateForm()){
        var oldPassword = document.getElementById("oldPassword").value
        var newPassword = document.getElementById("newPassword").value
        var userType = document.getElementById("userType").value
        var requestType = (userType=='student')?'studentUpdatePassword':'facultyUpdatePassword'
        
        var response = await fetchData('./API/POST/', {'requestType': requestType, 'oldPassword' : oldPassword, 'newPassword' : newPassword})      

        if(response.data){
            alert("Password Change Successful!")
            window.location.replace("profile.php")
        }else{
            document.getElementById("error").style.display = "inline"
        }
    }
})