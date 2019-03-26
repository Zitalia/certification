window.onload = function() {
    function loadFile(script) {
        let imported = document.createElement('script');
        imported.type= 'text/javascript';
        imported.src = 'src/js/' + script + '.js';
        document.head.appendChild(imported);
    }
    loadFile('index');
    loadFile('masterpage');
    loadFile('accueil');
    loadFile('chat');
}