if(document.getElementById('routage').value != "index"){
    document.getElementById('menuderoulant').addEventListener('change', function(e) {        
        if(document.getElementById('menuderoulant') !== null) {
            document.getElementById('routage').value = document.getElementById('menuderoulant').value;
            document.getElementById('mainForm').submit();
        }
    }); 
}

    function colordeladivhaugauche() {
    let switchedcolor = document.getElementById('routage').value;
        switch(switchedcolor){
            case 'chat' : 
            document.getElementById('Hautgauche').style.backgroundColor = "#ffc107";
            break
            case 'forum' : 
            document.getElementById('Hautgauche').style.backgroundColor = "rgb(7, 124, 7)";
            break
            case 'jeux' : 
            document.getElementById('Hautgauche').style.backgroundColor = "rgb(250, 11, 11)";
            let jeulent = document.getElementById('basgauche').getElementsByTagName('a').length;
            for(var i=0 ; i<jeulent  ; i++ ){
                document.getElementById('basgauche').getElementsByTagName('a')[i].style.color = "rgb(250, 11, 11)";
            }
            break
            case 'videos' : 
            document.getElementById('Hautgauche').style.backgroundColor = "rgb(11, 11, 243)";
            let videolent = document.getElementById('basgauche').getElementsByTagName('a').length;
            for(var i=0 ; i<videolent  ; i++ ){
                document.getElementById('basgauche').getElementsByTagName('a')[i].style.color = "rgb(11, 11, 243)";
            }
            break
            case 'creepyPasta' : 
            document.getElementById('Hautgauche').style.backgroundColor = "rgb(124, 7, 124)";
            let histoirlinklent = document.getElementById('basgauche').getElementsByTagName('a').length;
            for(var i=0 ; i<histoirlinklent  ; i++ ){
                document.getElementById('basgauche').getElementsByTagName('a')[i].style.color = "rgb(124, 7, 124)";
            }
            break

            case 'selectedjeux':
            document.getElementById('Hautgauche').style.backgroundColor = "rgb(250, 11, 11)";
            let lenlenggth = document.getElementById('basgauche').getElementsByTagName('a').length;
            for(var i=0 ; i<lenlenggth  ; i++ ){
                document.getElementById('basgauche').getElementsByTagName('a')[i].style.color = "rgb(250, 11, 11)";
            }
            break
            case 'videoselected':
            document.getElementById('Hautgauche').style.backgroundColor = "rgb(11, 11, 243)";
            let videosellent = document.getElementById('basgauche').getElementsByTagName('a').length;
            for(var i=0 ; i<videosellent  ; i++ ){
                document.getElementById('basgauche').getElementsByTagName('a')[i].style.color = "rgb(11, 11, 243)";
            }
            break
        }
    }
    colordeladivhaugauche();
