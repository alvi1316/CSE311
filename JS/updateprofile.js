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

function validateDose(){
    var dofd = document.getElementById("dofdInput").value
    var dosd = document.getElementById("dosdInput").value
    var vax = document.getElementById("vaxInput").value
    var dofd1 = new Date(dofd)
    var dosd1 = new Date(dosd)  
    var result = true;

    if(dofd == "" && dosd != ""){
        document.getElementById('doseError1').style.display = "block"
        document.getElementById('doseError2').style.display = "none"
        document.getElementById('doseError3').style.display = "none"
        document.getElementById('doseError4').style.display = "none"
        result =  false
    }
    if(dofd1.getTime() >= dosd1.getTime()){
        document.getElementById('doseError1').style.display = "none"
        document.getElementById('doseError2').style.display = "block"
        document.getElementById('doseError3').style.display = "none"
        document.getElementById('doseError4').style.display = "none"        
        result =  false
    }
    if(vax == '0' && dofd != ""){
        document.getElementById('doseError1').style.display = "none"
        document.getElementById('doseError2').style.display = "none"
        document.getElementById('doseError3').style.display = "block"
        document.getElementById('doseError4').style.display = "none" 
        result =  false
    }
    if(vax != '0' && dofd == ''){
        document.getElementById('doseError1').style.display = "none"
        document.getElementById('doseError2').style.display = "none"
        document.getElementById('doseError3').style.display = "none"
        document.getElementById('doseError4').style.display = "block"
        result =  false
    }
    if(result){
        document.getElementById('doseError1').style.display = "none"
        document.getElementById('doseError2').style.display = "none"
        document.getElementById('doseError3').style.display = "none"
        document.getElementById('doseError4').style.display = "none"
        return true
    }else{
        return false
    }
}

document.getElementById("nameInput").addEventListener("blur", function (){
    validateInput("nameInput","nameError",/^[a-z A-Z]{1,40}$/g)
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

document.getElementById("dofdInput").addEventListener("blur", function (){
    validateDose()
})

document.getElementById("dosdInput").addEventListener("blur", function (){
    validateDose()
})

document.getElementById("vaxInput").addEventListener("blur", function (){
    validateDose()
})

document.getElementById("logout").addEventListener("click",async function() {
    var response = await fetchData('./API/POST/', {'requestType': 'logout'})
    if(response.data){
        window.location.replace("index.php");
    }
});

document.getElementById("deleteAccountButton").addEventListener("click",async function() {

    if(confirm("Do you really want to delete your account?")){

        var userType = document.getElementById("userType").value
        var requestType = (userType=='student')?'deleteStudentAccount':'deleteFacultyAccount'

        var response = await fetchData('./API/POST/', {'requestType': requestType})
        if(response.data){
            alert("Account Deleted!")
            window.location.replace("index.php");
        }

    }    
});

document.getElementById("updateButton").addEventListener("click",async function (event){
    var nameIsValid = validateInput("nameInput","nameError",/^[a-z A-Z]{1,40}$/g)
    var emailIsValid = validateInput("emailInput","emailError",/^(([a-z.\d])+\@northsouth.edu)$/gi)
    var nidBidIsValid = validateNidBid()
    var doseIsValid = validateDose()
    if(nameIsValid && emailIsValid && nidBidIsValid && doseIsValid){
        var name = document.getElementById("nameInput").value
        var email = document.getElementById("emailInput").value
        var phone = document.getElementById("phoneInput").value
        phone = (phone=='')?null:phone
        var city = document.getElementById("cityInput").value
        city = (city=='')?null:city
        var dob = document.getElementById("dobInput").value
        dob = (dob=='')?null:dob
        var gender = document.getElementById("genderInput").value
        var nid = document.getElementById("nidInput").value
        nid = (nid=='')?'null':nid
        var bid = document.getElementById("bidInput").value
        bid = (bid=='')?'null':bid
        var dept = document.getElementById("deptInput").value
        var vax = document.getElementById("vaxInput").value
        var dofd = document.getElementById("dofdInput").value
        dofd = (dofd=='')?null:dofd
        var dosd = document.getElementById("dosdInput").value
        dosd = (dosd=='')?null:dosd
        var userType = document.getElementById("userType").value
        var requestType = (userType=='student')?'studentUpdate':'facultyUpdate'
        var desig = (userType=='student')?'null':document.getElementById("desig").value
        
        var response = await fetchData('./API/POST/', {'requestType': requestType, 'name' : name, 'desig' : desig, 'email' : email, 'phone' : phone, 'city' : city, 'dob' : dob, 'gender' : gender, 'nid' : nid, 'bid' : bid, 'dno' : dept, 'vax' : vax, 'dofd' : dofd, 'dosd' : dosd})      

        if(response.data){
            alert("Update Successful!")
            window.location.replace("profile.php");
        }else{
            alert("Update Failed!")
        }
    }

    
})

