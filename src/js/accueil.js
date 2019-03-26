if(document.getElementById('routage').value != "index"){
    document.getElementById('menuderoulant').addEventListener('change', function(e) {        
        if(document.getElementById('menuderoulant') !== null) {
            document.getElementById('routage').value = document.getElementById('menuderoulant').value;
            document.getElementById('mainForm').submit();
        }
    });  
}


function roadtogrosseimagetolesite(element, valeur){
    if(document.getElementById(element) !== null) {
        document.getElementById(element).style.cursor = "pointer";
        document.getElementById(element).addEventListener('click', function(e) {
            document.getElementById('routage').value = valeur;
            document.getElementById('menuderoulant').value = valeur;
            document.getElementById('mainForm').submit();
        });
    }
}
roadtogrosseimagetolesite('jeux', "jeux");
roadtogrosseimagetolesite('video', "videos");
roadtogrosseimagetolesite('histoire', "creepyPasta");
roadtogrosseimagetolesite('chat', "chat");
roadtogrosseimagetolesite('forum', "forum");