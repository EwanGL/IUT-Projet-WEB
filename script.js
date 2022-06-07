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

// function sendAjax(args){
//     alert(arguments[0]);

//     var req_ajax = null;
//     if (window.XMLHttpRequest){
//         req_ajax = new XMLHttpRequest();
//     }

//     else{
//         if (typeof ActiveXObject != "undifined"){
//             req_ajax = new ActiveXObject("Microsoft.XMLHTTP");
//         }
//         if (req_ajax){
//             req_ajax.onreadychange = function(){
//                 answerProcess(req_ajax);
//             };
//             req_ajax.open("GET", "index.php?action=marche", true);
//             req_ajax.send(null);
//         }
//         else{
//             alert("Pas de XMLHTTP") 
//         }
//     }
    
// };

// function answerProcess(args){
//     var ready = arguments[0].readyState;
//     if (ready == 4){
//         var index_tab = document.getElementById("index_tab");
//         var status = arguments[0].status;
//         if (status == 200){
//             var data = arguments[0].responseText;
//             index_tab.innerHTML=data;
//         }
//         else{
//             index_tab.innerHTML = "server error, code :" + status; 
//         }
//     }
// }