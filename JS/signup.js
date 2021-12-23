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

async function addDno(){
    var res = await fetchData('./API/POST/', {'requestType': 'getDno'})
    res.data.forEach(element => {
        document.getElementById("dept").innerHTML+=`<option value='${element.dno}'>${element.dname}</option>`
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

function validateNidBid(){
    var nid = document.getElementById("nidInput").value
    var bid = document.getElementById("bidInput").value
    if(nid == "" && bid == ""){
        document.getElementById('nidBidError').style.display = "block"
        return false
    }else{
        document.getElementById('nidBidError').style.display = "none"
        return true
    }
}

function validateForm(){
    var nameIsValid = validateInput("nameInput","nameError",/^[a-z A-Z]{1,40}$/g)
    var idIsValid = validateInput("idInput","idError",/^\d{10}$/g)
    var emailIsValid = validateInput("emailInput","emailError",/^(([a-z.\d])+\@northsouth.edu)$/gi)
    var passwordIsValid = validateInput("passwordInput","passwordError",/^(?=.*[a-z])(?=.*\d)[a-zA-Z\d]{8,}$/g)
    var password = document.getElementById("passwordInput").value
    var confirmPasswordIsValid = validateInput("confirmPasswordInput","confirmPasswordError",new RegExp(`^${password}$`,'g'))
    var nidBidIsValid = validateNidBid()
    return (nameIsValid && idIsValid && emailIsValid && passwordIsValid && confirmPasswordIsValid && nidBidIsValid)
}

addDno();

document.getElementById("nameInput").addEventListener("blur", function (){
    validateInput("nameInput","nameError",/^[a-z A-Z]{1,40}$/g)
})

document.getElementById("idInput").addEventListener("blur", function (){
    validateInput("idInput","idError",/^\d{10}$/g)
})

document.getElementById("emailInput").addEventListener("blur", function (){
    validateInput("emailInput","emailError",/^(([a-z.\d])+\@northsouth.edu)$/gi)
})

document.getElementById("nidInput").addEventListener("blur", function (){
    validateNidBid()
})

document.getElementById("bidInput").addEventListener("blur", function (){
    validateNidBid()
})

document.getElementById("passwordInput").addEventListener("blur", function (){
    validateInput("passwordInput","passwordError",/^(?=.*[a-z])(?=.*\d)[a-zA-Z\d]{8,}$/g)
})

document.getElementById("confirmPasswordInput").addEventListener("blur", function (){
    var password = document.getElementById("passwordInput").value
    validateInput("confirmPasswordInput","confirmPasswordError",new RegExp(`^${password}$`,'g'))
})

document.getElementById("signUpButton").addEventListener("click",async function (event){
    if(validateForm()){
        var name = document.getElementById("nameInput").value
        var id = document.getElementById("idInput").value
        var email = document.getElementById("emailInput").value
        var nid = document.getElementById("nidInput").value
        var bid = document.getElementById("bidInput").value
        var password = document.getElementById("passwordInput").value
        var gender = document.getElementById("gender").value
        var dept = document.getElementById("dept").value
        var userType = document.getElementById("usertype").value
        var requestType = (userType=='student')?'studentSignup':'facultySignup'
        nid = (nid=='')?'null':nid
        bid = (bid=='')?'null':bid
        
        var response = await fetchData('./API/POST/', {'requestType': requestType, 'name' : name, 'id' : id, 'email' : email, 'password' : password, 'gender' : gender, 'dno' : dept, 'nid' : nid, 'bid' : bid})      
        if(response.data){
            alert("Sign up successful! Please Login to continue")
            window.location.replace("index.php")
        }else{
            document.getElementById("error").style.display = "inline"
        }
    }
})