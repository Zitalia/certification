$(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })


function checkField(inputToCheck, eventName, scriptName, errorField, min,  ) {
            if(inputToCheck !== ''){
                document.getElementById(inputToCheck).addEventListener(eventName, function(e) {
                    let inputToCheckV = document.getElementById(inputToCheck).value;
                    if(document.getElementById(inputToCheck).value.length < min){
                        pseudoinviterror.innerHTML = "Votre pseudo doit contenir au moin 4 charactères.";
                    }else{
                        pseudoinviterror.innerHTML = "";
                        $.ajax({
                            url: "src/ajaxScript/"+scriptName+".php?"+inputToCheck+"="+ inputToCheckV, 
                            
                            success: function(html){
                                $(errorField).html(html);
                            }
                        });
                    }
                });
            }
        }

        function checkSubmit(e) {
            if(
                document.getElementById('erreurpseudo').value !== ""
                && document.getElementById('erreurpseudo').value !== ""
                ) {
                e.preventDefault();
            }
        }
    

    function sicpasbon(var1, var2, var3, min, bouton){
        var1.addEventListener('focusout', function(e) {
            if (var1.value.length < min && var1.value.length > 0){
                var2.innerHTML = var3;
                checkSubmit(e);


            }else{
                var2.innerHTML = "";
            }
        });
    }
    function passwordsameshitdude(var1, var1bis, var2, var3, bouton) {
        var1bis.addEventListener('focusout', function(e) {
            if (var1.value !== var1bis.value){
                var2.innerHTML = var3;
                ouiounon=true;
                if(ouiounon==true){
                    bouton.addEventListener('click', function(e) {
                        var2.style.color = "red";
                        e.preventDefault();
                    });
                }
            }else{
                var2.innerHTML = "";
            }
        });
    }
    let erreurpseudo = document.getElementById('erreurpseudo');
    let erreurpassword = document.getElementById('erreurpassword');
    let erreurpassword2 = document.getElementById('erreurpassword2');
    let erreurage = document.getElementById('erreurage');

    if(document.getElementById('btnInscription') !== null) {
        checkRegister();
        let registerpseudo = document.getElementById('registerpseudo');
        let registerpassword1 = document.getElementById('registerpassword1');
        let registeage = document.getElementById('registeage');
        let registemail = document.getElementById('registemail');
        document.getElementById('btnInscription').addEventListener('click', function(e) {
            if(erreurpseudo.textContent === ""
            && erreurpassword.textContent === ""
            && erreurpassword2.textContent === ""
            && erreurage.textContent === ""
            && registerpseudo.value !== ""
            && registerpassword1.value !== ""
            && registeage.value !== ""
            && registemail.value !== ""
            ) {
                alert("vous etes inscrit, Connectez vous ! :)");
                document.getElementById('routage').value = 'inscription';
                document.getElementById('mainForm').submit();
            } else {
                e.preventDefault();
            }
        });
        checkField('registerpseudo', 'focusout', 'verifypseudoinscrip', '#erreurpseudo', 3);
        checkField('registemail', 'focusout', 'verifymail', '#erreurmail', 6);
        checkField('invitpseudo', 'focusout', 'verifypseudoinvit', '#pseudoinviterror', 4,);

        function ilfautseconnecter(){
            var userName = document.getElementById('pseudoco').value;
            var mdp = document.getElementById('Passwordconnection').value;
            $.ajax({
                url: "src/ajaxScript/connection.php?Username="+ userName+"&Passwordconnection="+mdp, 
                
                success: function(html){
                    $("#passerror").html(html);
                    if(document.getElementById("passerror").innerHTML === "") {
                        document.getElementById('routage').value = 'accueil';
                        document.getElementById('mainForm').submit();
                    }
                }
            });
        }

        //submit la co
        document.getElementById('btnsident').addEventListener('click', function(e) {
            e.preventDefault();
            ilfautseconnecter();
        });

        function validezlaco(input){
            input.addEventListener("keydown", function(e) {
                if (event.key === "Enter") {
                    e.preventDefault();
                    ilfautseconnecter();
                }
            });
        }
        let zonedetextepassco = $("#Passwordconnection")[0];
        validezlaco(zonedetextepassco);
        let zonedetexteidentco = $("#pseudoco")[0];
        validezlaco(zonedetexteidentco);

        let invitage = document.getElementById('invitage');
        let ageerrorinvit = document.getElementById('ageerrorinvit');
        let subinvit = document.getElementById('submitvisit');
        let pseudoinviterror = document.getElementById('pseudoinviterror');
        subinvit.addEventListener('click', function(e) {
            if(pseudoinviterror.textContent === ""){
                if(invitage.value < 12){
                    e.preventDefault();
                    ageerrorinvit.innerHTML = "Vous devez avoir au moin 12 ans.";
                }else{
                    ageerrorinvit.innerHTML = "";
                    document.getElementById('routage').value = 'accueil';
                    document.getElementById('mainForm').submit();
                }
            }else{
                e.preventDefault();
            }
        });

        //les modals
        document.getElementById('bbwbtnins').addEventListener('click', function(e){
            $('#loginmodal').modal('hide');
        });
    }

    

    

    function checkRegister() {
        let subbtn= document.getElementById('btnInscription');
        let registerpseudo = document.getElementById('registerpseudo');
        let erreurpseudo = document.getElementById('erreurpseudo');
        let msgerreurpseudo = "votre pseudo doit contenir au moins 3 charactères.";

        sicpasbon(registerpseudo, erreurpseudo, msgerreurpseudo, 3, subbtn);
    
        let registerpassword1 = document.getElementById('registerpassword1');
        let erreurpassword = document.getElementById('erreurpassword');
        let msgerreurpassword= "Minimum 6 charactères.";
        sicpasbon(registerpassword1, erreurpassword, msgerreurpassword, 6, subbtn);
        
        let registerpassword2 = document.getElementById('registerpassword2');
        let erreurpassword2 = document.getElementById('erreurpassword2');
        let msgerreurpassword2= "Minimum 6 charactères.";
        let msgerreursamepass = "Vos mots de passes sont differents."
        sicpasbon(registerpassword2, erreurpassword2, msgerreurpassword2, 6, subbtn);
        passwordsameshitdude(registerpassword1, registerpassword2, erreurpassword2, msgerreursamepass, subbtn);
        
        let registeage = document.getElementById('registeage');
        let erreurage = document.getElementById('erreurage');
        let msgerreurage= "Vous devez avoir 12 ans pour acceder a Je m'ennuie.fr .";
        let ouiounon = false ;
        //function sicpasbon adapté pour l'age
        registeage.addEventListener('focusout', function(e) {
            if (registeage.value < 12){
                erreurage.innerHTML = msgerreurage;
                ouiounon= true ; 
                if(ouiounon == true){
                    registeage.addEventListener('focusout', function(e) {
                        erreurage.style.color = "red";
                        e.preventDefault();
                    });
                }
            }else{
                erreurage.innerHTML = "";
            }
        });
    }


    var ttt = document.getElementsByClassName('storylinkgjgj');
    for(var i = 0; i < ttt.length ; i++) {
        ttt[i].addEventListener('click', function(e){
            let inputToCheckH = this.dataset.cequejeveux
            $.ajax({
                url: "index.php?routage=creepyPasta&menuderoulant=creepyPasta&histoireId="+ inputToCheckH, 
                success: function(data){
                    $('#modalBodyReplace').empty();
                    $('#modalBodyReplace').append(data);
                }
            });
        }, this);
    }

    // routes
    function route(element, event, route) {
        if(document.getElementById(element) !== null) {
            document.getElementById(element).addEventListener(event, function(e) {
                document.getElementById('routage').value = route;
                document.getElementById('mainForm').submit();
            });
        }
    }

    // systeme de like
    function leslikes(routage, dataname, idjeu) {
            $.ajax({
                url: "index.php?routage="+routage+"&menuderoulant=" + routage,
                type : 'POST',
                data : dataname + "=" + idjeu , 
                success: function(){

                }
            });
    }

    function lesdislikes(routage, dataname, idjeudisl) {
            $.ajax({
                url: "index.php?routage="+routage+"&menuderoulant=" + routage, 
                type : 'POST',
                data : dataname + "=" + idjeudisl , 
                success: function(){
                    
                }
            });
    }
    
    if(document.getElementById('routage').value == "selectedjeux" ){
        idjeulike = document.getElementById('likejeu').dataset.idjeu;
        var temp=false;
        var tempdislike=false;
            document.getElementById('likejeu').addEventListener('click', function(e){
                if(temp == true){
                    e.preventDefault();
                }else {
                    leslikes('selectedjeux', 'idjeulike', idjeulike);
                    this.style.color= 'green';
                    temp=true;
                }
            });
        idjeudisl = document.getElementById('dislikejeu').dataset.dislikeid;
            document.getElementById('dislikejeu').addEventListener('click', function(e){
                if(tempdislike == true){
                    e.preventDefault();
                }else {
                    lesdislikes('selectedjeux', 'idjeudisl', idjeudisl);
                    this.style.color= 'black';
                    tempdislike = false;
                }
            });
    }
    
    if(document.getElementById('routage').value == "videoselected" ){
        idvidlike = document.getElementById('vidlike').dataset.idvid;
        var tempvid=false;
        var tempviddislike=false;
            document.getElementById('vidlike').addEventListener('click', function(e){
                if(tempvid == true){
                    e.preventDefault();
                }else {
                    leslikes('videoselected', 'idvidlike', idvidlike);
                    this.style.color= 'green';
                    tempvid=true
                }
            });
        idviddisl = document.getElementById('viddislike').dataset.idvidkf;
            document.getElementById('viddislike').addEventListener('click', function(e){
                if(tempviddislike == true){
                    e.preventDefault();
                }else {
                    lesdislikes('videoselected', 'idviddisl', idviddisl);
                    this.style.color= 'black';
                    tempviddislike=true;
                }
            });
    }
    
    if(document.getElementById('routage').value === "creepyPasta" ){
        var tempcreep=false;
        var tempcreepdislike=false;
            document.getElementById('likehistoire').addEventListener('click', function(e){
                if(tempcreep == true){
                    e.preventDefault();
                }else {
                    idhist = document.getElementById('storyModaltitle').dataset.idstororory;
                    leslikes('creepyPasta', 'idhistlik', idhist);
                    this.style.color= 'green';
                    tempcreep = true;
                }
            });
            document.getElementById('dislikehistoire').addEventListener('click', function(e){
                if(tempcreepdislike == true){
                    e.preventDefault();
                }else {
                idhist = document.getElementById('storyModaltitle').dataset.idstororory;
                lesdislikes('creepyPasta', 'idhistdislik', idhist);
                this.style.color= 'white';
                tempcreepdislike = true;
                }
            });
    }

    if(document.getElementById('routage').value === "videoselected" ){
        function setvideopoints(){
            let nomprpoint = document.getElementById("sessionname").innerHTML ; 
            setTimeout( function(){
                $.ajax({
                    url: "index.php?routage=videoselected&menuderoulant=videos" , 
                    type : 'POST',
                    data :  "pluspoint=" + nomprpoint , 
                    success: function(){
                        swal({
                            title: "Tu a gagné un points vidéos 👍",
                            icon: "success",
                        });
                    }
                });
            setvideopoints(); // on relance la fonction
            }, 900000); // on exécute le chargement toutes les 3 secondes
        }
        setvideopoints();
    };

    if(document.getElementById('routage').value === "selectedjeux" ){
        function setjeuxpoints(){
            let nomprpoint = document.getElementById("sessionname").innerHTML ; 
            setTimeout( function(){
                $.ajax({
                    url: "index.php?routage=selectedjeux&menuderoulant=jeux" , 
                    type : 'POST',
                    data :  "pluspointjeu=" + nomprpoint , 
                    success: function(){
                        swal({
                            title: "Tu a gagné un points jeu 👍",
                            icon: "success",
                        });
                    }
                });
                setjeuxpoints(); // on relance la fonction
            }, 900000); // on exécute le chargement toutes les 3 secondes
        }
        setjeuxpoints();
    };

    if(document.getElementById('routage').value === "chat" ){
        function setchatpoints(){
            let nomprpoint = document.getElementById("sessionname").innerHTML ; 
            setTimeout( function(){
                $.ajax({
                    url: "index.php?routage=chat&menuderoulant=chat" , 
                    type : 'POST',
                    data :  "pluspointchat=" + nomprpoint , 
                    success: function(){
                        swal({
                            title: "et 1 points de plus 👍",
                            icon: "success",
                        });
                    }
                });
                setchatpoints(); // on relance la fonction
            }, 900000); // on exécute le chargement toutes les 3 secondes
        }
        setchatpoints();
    };
    
    if(visualViewport.height>600){
        var divs = document.getElementsByClassName('contenuedecartelalalerje');
        for(var i=0; i<divs.length; i++){
            divs[i].style.paddingTop = '6%'
        };
    };




