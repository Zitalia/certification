if(document.getElementById('routage').value == "chat" ){
    

    function charger(){
        setTimeout( function(){
            let lastId = document.getElementById('chataffichage').lastElementChild.dataset.id ;
            $.ajax({
                url : "src/ajaxScript/chatreload.php",
                type : "GET",
                data : "lastmessageid=" + lastId,
                success : function(html){
                    $('#chataffichage').empty();
                    $('#chataffichage').append(html); 
                    affichChat = document.getElementById('chataffichage');
                    affichChat.scrollTop = affichChat.scrollHeight;
                }
            });
        charger(); 
        }, 3000); 
    }


    function lesmessagessapartetsarevienscestunlongfleuvesansfin(){
        var message = $('#entrezmessages')[0].emojioneArea.editor[0].outerText;
        if(message != ""){ // on vérifie que les variables ne sont pas vides
            $.ajax({
                url : "src/ajaxScript/chatgestion.php", // on donne l'URL du fichier de traitement
                type : "GET",
                data : "message=" + message, // et on envoie nos données
                success: function(html){
                    $('#chataffichage').append(html);
                    $('#entrezmessages')[0].emojioneArea.editor[0].innerHTML ="";
                }
            });
        }
        message = "";
    }


    $('#sendmessages').on("click", function(e){
        e.preventDefault(); 
        lesmessagessapartetsarevienscestunlongfleuvesansfin();
    });

    function entrertosend(event){
        if (event.key === "Enter") {
            // event.preventDefault();
            
        }
    }
    var el = $('#entrezmessages')[0].emojioneArea.editor[0];
    el.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            lesmessagessapartetsarevienscestunlongfleuvesansfin();   
        }
    });

    if(document.getElementById('routage').value == "chat"){
        charger();
        lalala = document.getElementById('chataffichage');
        lalala.scrollTop = lalala.scrollHeight;
    }
    

    // Tapez entrez pour envoyer sa marche poooooo
    // document.getElementById('emojiarenaleketextarea').addEventListener("keydown", function(event) {
    //     alert('press');
    //     if (event.keyCode === 13) {
    //       event.preventDefault();
    //       document.getElementById("sendmessages").click();
    //     }
    // });
}