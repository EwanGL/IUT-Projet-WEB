import * as mdb from 'mdb-ui-kit'; // lib
import { Input } from 'mdb-ui-kit'; // module

function verifyPassword() {
    var not_empty = false;
    var maj = false;
    var sp_char = false;
    var pw = document.getElementById("password").value;  
    var alphabet_maj = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
    var special_char = ['/','[','!','@','#','$','%','^','&','*','(',')','_','+','-','=','[',']','{','}',';',':','.','<','>','/','?',']','+','/'];
    
    if(pw != "") {  
       not_empty = true ;
    }  

    for(var i= 0; i < pw.length; i++){
        if(alphabet_maj.includes(pw[i])){
            maj = true;
        }
        
        else if (special_char.includes(pw[i])){
            sp_char = true;
        }
    }
    
    // console.log(not_empty);
    // console.log(maj);
    // console.log(sp_char);
    // console.log(not_empty && maj && sp_char);
    
    return (not_empty && maj && sp_char);
};

function onSubmit(token) {
    document.getElementById("insert_form").submit();
};

function verifyInsertForm(){
    alert("function");
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

function myFunction() {
  alert("The form was submitted");
};