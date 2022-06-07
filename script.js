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
}

function onSubmit(token) {
    document.getElementById("insert_form").submit();
}

function verifyInsertForm(){
    var name =  document.getElementById("validationCustom01");
    var last_name =  document.getElementById("validationCustom02");
    var phone =  document.getElementById("validationCustom03");
    var email =  document.getElementById("validationCustom04");

    if ((name != "" ) && ((last_name != "" ) && (typeof(phone) == "number") && (email.indexOf('@') > -1))){
        return true;
    }
    else{
        alert("Veuillez compléter correctement le formulaire !");
        return false;
    }

}

(() => {
    'use strict';
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation');
  
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms).forEach((form) => {
      form.addEventListener('submit', (event) => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();