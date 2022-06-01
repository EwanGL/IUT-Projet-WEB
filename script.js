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