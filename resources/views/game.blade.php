@extends('layouts.app')
@vite(['resources/css/game.css'])

@section('content')

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

<body>
<h1>Nahraj 1000 skóre a získaj zlavu</h1>
<div id="game">
    <div id="character"></div>
</div>

<script type="text/javascript">

    var character = document.getElementById("character");
    var game = document.getElementById("game");
    var interval;
    var doOboch = 0;
    var counter = 0;
    var currentBlocks = [];

    /*CSRF Token Setup*/
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function ajax() {

        $.ajax({
            type: 'POST',
            url: '/game/score',
            data: { codee: generateRandomString() },
            success: function(response) {
                alert("nedojebalo sa");
                console.log('Score saved successfully!');
            },
            error: function(xhr) {
                alert("dojebalo sa");
                console.log('Error saving score: ' + xhr.responseText);
            }
        });
    }

    function generateRandomString(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    function PohybDolava(){
        var left = parseInt(window.getComputedStyle(character).getPropertyValue("left"));
        if(left>0){
            character.style.left = left - 2 + "px";
        }
    }
    function PohybDoprava(){
        var left = parseInt(window.getComputedStyle(character).getPropertyValue("left"));
        if(left<380){
            character.style.left = left + 2 + "px";
        }
    }
    document.addEventListener("keydown", event => {
        if(doOboch==0){
            doOboch++;
            if(event.key==="ArrowLeft"){
                interval = setInterval(PohybDolava, 1);
            }
            if(event.key==="ArrowRight"){
                interval = setInterval(PohybDoprava, 1);
            }
        }
    });
    document.addEventListener("keyup", event => {
        clearInterval(interval);
        doOboch=0;
    });

    var blocks = setInterval(function(){
        /*Get Site URL*/
        var SITEURL = "{{ url('/') }}";

        var blockLast = document.getElementById("block"+(counter-1));
        var holeLast = document.getElementById("hole"+(counter-1));
        if(counter>0){
            var blockLastTop = parseInt(window.getComputedStyle(blockLast).getPropertyValue("top"));
            var holeLastTop = parseInt(window.getComputedStyle(holeLast).getPropertyValue("top"));
        }
        if(blockLastTop<400||counter==0){
            var block = document.createElement("div");
            var hole = document.createElement("div");
            block.setAttribute("class", "block");
            hole.setAttribute("class", "hole");
            block.setAttribute("id", "block"+counter);
            hole.setAttribute("id", "hole"+counter);
            block.style.top = blockLastTop + 100 + "px";
            hole.style.top = holeLastTop + 100 + "px";
            var random = Math.floor(Math.random() * 360);
            hole.style.left = random + "px";
            game.appendChild(block);
            game.appendChild(hole);
            currentBlocks.push(counter);
            counter++;
        }
        var characterTop = parseInt(window.getComputedStyle(character).getPropertyValue("top"));
        var characterLeft = parseInt(window.getComputedStyle(character).getPropertyValue("left"));
        var drop = 0;
        if(characterTop <= 0){
            if((counter-9)> 5){
                alert("skoreee");
                ajax();
            } else {
                alert("Ste slabý");
            }
            clearInterval(blocks);
            location.reload();
        }
        for(var i = 0; i < currentBlocks.length;i++){
            let current = currentBlocks[i];
            let iblock = document.getElementById("block"+current);
            let ihole = document.getElementById("hole"+current);
            let iblockTop = parseFloat(window.getComputedStyle(iblock).getPropertyValue("top"));
            let iholeLeft = parseFloat(window.getComputedStyle(ihole).getPropertyValue("left"));
            iblock.style.top = iblockTop - 0.5 + "px";
            ihole.style.top = iblockTop - 0.5 + "px";
            if(iblockTop < -20){
                currentBlocks.shift();
                iblock.remove();
                ihole.remove();
            }
            if(iblockTop-20<characterTop && iblockTop>characterTop){
                drop++;
                if(iholeLeft<=characterLeft && iholeLeft+20>=characterLeft){
                    drop = 0;
                }
            }
        }
        if(drop==0){
            if(characterTop < 480){
                character.style.top = characterTop + 2 + "px";
            }
        }else{
            character.style.top = characterTop - 0.5 + "px";
        }
    },1);


</script>
</body>




@endsection
