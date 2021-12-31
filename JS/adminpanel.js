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
        window.location.replace("adminlogin.php");
    }
});

document.getElementById("deleteVaxButton").addEventListener("click",async function() {
    var vaxName = document.getElementById("deleteVaxName").value
    var response = await fetchData('./API/POST/', {'requestType': 'deleteVax', 'vaxName': vaxName})
    if(response.data){
        alert("Vaccine deleted!")
        window.location.replace("adminpanel.php")
    }else{
        alert("Delete failed!")
    }
})

document.getElementById("deleteDeptButton").addEventListener("click",async function() {
    var dname = document.getElementById("deleteDeptName").value
    var response = await fetchData('./API/POST/', {'requestType': 'deleteDept', 'dname': dname})
    if(response.data){
        alert("Department deleted!")
        window.location.replace("adminpanel.php")
    }else{
        alert("Delete failed!")
    }
})

document.getElementById("addVaxButton").addEventListener("click",async function() {
    var vaxName = document.getElementById("addVaxName").value
    var company = document.getElementById("addCompName").value

    if(vaxName != "" && company != ""){
        var response = await fetchData('./API/POST/', {'requestType': 'addVax', 'vaxName': vaxName, 'company': company})
        if(response.data){
            alert("Vaccine added!")
            window.location.replace("adminpanel.php")
        }else{
            alert("Failed!")
        }
    }else{
        alert("Please enter vaccine name and company name!")
    }

    
})

document.getElementById("addDeptNameButton").addEventListener("click",async function() {
    var dname = document.getElementById("addDeptName").value
    if(dname!=""){
        var response = await fetchData('./API/POST/', {'requestType': 'addDept', 'dname': dname})
        if(response.data){
            alert("Department Added!")
            window.location.replace("adminpanel.php")
        }else{
            alert("Failed!")
        }
    }else{
        alert("Please enter department name!")
    }
    
})

document.getElementById("addDesigButton").addEventListener("click",async function() {
    var desig = document.getElementById("addDesigName").value
    if(desig!=""){
        var response = await fetchData('./API/POST/', {'requestType': 'addDesig', 'desig': desig})
        if(response.data){
            alert("Designation Added!")
            window.location.replace("adminpanel.php")
        }else{
            alert("Failed!")
        }
    }else{
        alert("Please enter designation name!")
    }
    
})

document.getElementById("deleteDesigButton").addEventListener("click",async function() {
    var desig = document.getElementById("deleteDesigName").value
    var response = await fetchData('./API/POST/', {'requestType': 'deleteDesig', 'desig': desig})
    if(response.data){
        alert("Department deleted!")
        window.location.replace("adminpanel.php")
    }else{
        alert("Delete failed!")
    }
})