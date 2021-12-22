function validateId() {
    var id = document.getElementById("idInput").value
    if(!(/^\d{10}$/g.test(id))){
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

document.getElementById("signIn").addEventListener("click",login)

function login() {
    if(validateId() && validatePassword()){
        var id = document.getElementById("idInput").value
        var password = document.getElementById("passwordInput").value
        var userType = document.getElementById("usertype").value
        var requestType = (userType=='student')?'studentLogin':'facultyLogin'

        var data = JSON.stringify({'requestType':requestType,id:id,password:password})

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
        ).then(res => res.json())
        .then(
            (res) => {
                if(res.data){
                    window.location.replace("profile.php");
                }else{
                    document.getElementById("error").style.display = "inline"
                }
            }
        );
    }
}