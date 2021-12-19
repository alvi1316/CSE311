function validateId() {
    var id = document.getElementById("idInput").value
    if(id == ""){
        document.getElementById("idError").style.display = "inline"
        return false
    }else{
        document.getElementById("idError").style.display = "none"
        return true
    }
}

function validatePassword() {
    var password = document.getElementById("passwordInput").value
    if(password==""){
        document.getElementById("passwordError").style.display = "inline"
        return false
    }else{
        document.getElementById("passwordError").style.display = "none"
        return true
    }
}

document.getElementById("signInForm").addEventListener("submit",login)

function login(event) {
    event.preventDefault();
    if(validateId() && validatePassword()){
        var id = document.getElementById("idInput").value
        var password = document.getElementById("passwordInput").value

        var data = JSON.stringify({'requestType':'adminLogin',id:id,password:password})

        fetch(
            './API/POST/',
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
                body: data, // body data type must match "Content-Type" header
            },
        ).then(res => {
            //res.clone().text().then(function(data) {console.log(data)})
            return res.json()
        }).then(
            (res) => {
                if(res.data){
                    window.location.replace("adminpanel.php");
                }else{
                    document.getElementById("error").style.display = "inline"
                }
            }
        );
    }
}