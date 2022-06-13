function verifyPassword() {

    var pw = document.getElementById("co_password").value;  
    
    // console.log(mdp);
    var spec_ok = false;
    var maj_ok = false;
    var chiffre_ok = false;
    var longueur_ok = mdp.length >= 7 ;
    var res = false;

    // console.log(spec_ok,'1');
    // console.log(maj_ok,'1');
    // console.log(chiffre_ok,'1');
    // console.log(longueurok,'1');

    let special =['/','[','!','@','#','$','%','^','&','*','(',')','','+','-','=','[',']','{','}',';',':','.','<','>','/','?',']','+','/'];
    let majs = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','T','Q','R','S','T','U','V','W','X','Y','Z'];
    let chiffres = ['1','2','3','4','5','6','7','8','9'];
    console.log(res,'1');
    for(var lettre in mdp){
        for(var spec in special){
            if(mdp[lettre]==special[spec]){
                // console.log('special ok');
                spec_ok = true;
            }
        }
        for(var maj in majs){
            if(mdp[lettre]==majs[maj]){
                maj_ok = true;
                // console.log('maj ok');
            }
        }

        for(var chiffre in chiffres){
            if(mdp[lettre]==chiffres[chiffre]){
                chiffre_ok = true;
                // console.log('chiffre ok');
            }
        }

    }
    // console.log((spec_ok== true) && (maj_ok== true) && (chiffre_ok== true) && (longueur_ok== true),'pre return');
    return (spec_ok== true) && (maj_ok== true) && (chiffre_ok== true) && (longueur_ok== true);

}

function onSubmit(token) {
    document.getElementById("formulairemodifjeu").submit();
}


function onSubmit(token) {
    document.getElementById("insert_form").submit();
};

function onSubmit(token) {
    document.getElementById("modif_form").submit();
};

function verifyInsertForm(){
    var name =  document.getElementById("validationCustom01").value;
    var last_name =  document.getElementById("validationCustom02").value;
    var phone =  document.getElementById("validationCustom03").value;
    var email =  document.getElementById("validationCustom04").value;
    
    if ((name != "" ) && ((last_name != "" ) && (typeof(phone) == "number") && (email.indexOf('@') > -1))){
        return true;
    }
    else{
        alert("Veuillez compléter correctement le formulaire !");
        return false;
    }
    
};

function ajaxModif(args){
    var name = document.getElementById("validationCustom05").value;
    var last_name = document.getElementById("validationCustom06").value;
    var phone_number = document.getElementById("validationCustom07").value;
    var email = document.getElementById("validationCustom08").value;

    var groups = document.getElementsByName('groups');
              
    for(i = 0; i < groups.length; i++) {
        if(groups[i].checked)
            var group = groups[i].value;
    };
    
    $.ajax({
        type: "POST",
        url: "modification.php",
        data: {
            action : "ajaxModif",
            name : name,
            last_name : last_name,
            phone_number: phone_number,
            email : email,
            group : group
        },
        dataType: "json",
        success: function(response){
            console.log(response);
        }
    });
    
    
    // console.log(name);
    // console.log(last_name);
    // console.log(phone_number);
    // console.log(email);
    // console.log(group);

    // document.getElementById("validationCustom05").innerHTML = name;
    // document.getElementById("validationCustom06").innerHTML = last_name;
    // document.getElementById("validationCustom07").innerHTML = phone_number;
    // document.getElementById("validationCustom08").innerHTML = email;

    // for(i = 0; i < groups.length; i++) {
    //     if(groups[i])
    //         if(groups[i].value == group){
    //             groups[i].checked
    //         }
    // };
}