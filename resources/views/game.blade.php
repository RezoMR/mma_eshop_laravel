@extends('layouts.app')
@vite(['resources/css/game.css'])

@section('content')

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Hra</title>
    </head>

<body>
<h1>Nahraj 1000 skóre a získaj zlavu</h1>
<p>Ovládanie klávesami <-,-> alebo a,d </p>
<div id="hra">
    <div id="gulicka"></div>
</div>

<script type="text/javascript">

    var gulicka = document.getElementById("gulicka");
    var hra = document.getElementById("hra");
    var interval;
    var stlacene = 0;
    var counter = 0;
    var aktivnePlosiny = [];
    var speed =0.5;
    var xhr = new XMLHttpRequest();
    /*CSRF Token Setup*/

    function ajax() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '{{url('/gameAjaxx')}}',
            data: { codee: generujNahodnyString() },
            success: function(response) {
                alert("nepokazilo sa");
                console.log('Code saved successfully!');
            },
            error: function(xhr) {
                alert("pokazilo sa");
                console.log('Error saving Code: ' + xhr.responseText);
            }
        });
    }

    function generujNahodnyString(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    function PohybDolava(){
        var left = parseInt(window.getComputedStyle(gulicka).getPropertyValue("left"));
        if(left>0){ //kontrola lavej hrany
            gulicka.style.left = left - (speed*4) + "px";
        }
    }
    function PohybDoprava(){
        var left = parseInt(window.getComputedStyle(gulicka).getPropertyValue("left"));
        if(left<380){ //kontrola pravej hrany
            gulicka.style.left = left + (speed*4) + "px";
        }
    }
    document.addEventListener("keydown", event => { //stlacenie tlacidla
        if(stlacene===0){
            stlacene++;
            if(event.key==="ArrowLeft" || event.key==="a"){
                interval = setInterval(PohybDolava, 1);
            }
            if(event.key==="ArrowRight" || event.key==="d"){
                interval = setInterval(PohybDoprava, 1);
            }
        }
    });
    document.addEventListener("keyup", event => { //pustenie tlacidla
        clearInterval(interval);
        stlacene=0;
    });

    var plosiny = setInterval(function(){

        var poslednaPlosina = document.getElementById("plosina"+(counter-1));
        var poslednaDiera = document.getElementById("diera"+(counter-1));
        if(counter>0){
            //ziskavanie pozícii od horneho okraja
            var poziciaPoslednejPlosiny = parseInt(window.getComputedStyle(poslednaPlosina).getPropertyValue("top"));
            var poziciaPoslednejDiery = parseInt(window.getComputedStyle(poslednaDiera).getPropertyValue("top"));
        }
        if(poziciaPoslednejPlosiny<400||counter===0){ //vytvára iba plosiny v hre nie mimo
            var plosina = document.createElement("div");
            var diera = document.createElement("div");
            plosina.setAttribute("class", "plosina");
            diera.setAttribute("class", "diera");
            plosina.setAttribute("id", "plosina"+counter);
            diera.setAttribute("id", "diera"+counter);

            plosina.style.top = poziciaPoslednejPlosiny + 100 + "px";
            diera.style.top = poziciaPoslednejDiery + 100 + "px";

            var random = Math.floor(Math.random() * 360);
            diera.style.left = random + "px";

            hra.appendChild(plosina);
            hra.appendChild(diera);
            aktivnePlosiny.push(counter);

            counter++;
        }
        var characterTop = parseInt(window.getComputedStyle(gulicka).getPropertyValue("top"));
        var characterLeft = parseInt(window.getComputedStyle(gulicka).getPropertyValue("left"));
        var drop = 0;
        if(characterTop <= 0){
            if((counter-9) > 5) {
                ajax();
            } else {
                alert("Prehral si! Tvoje Skóre je: "+(counter-9));
            }
            clearInterval(plosiny);
            //location.reload();
        }
        for(var i = 0; i < aktivnePlosiny.length; i++){
            let current = aktivnePlosiny[i];
            let iPlosina = document.getElementById("plosina"+current);
            let ihole = document.getElementById("diera"+current);
            let iPlosinatop = parseFloat(window.getComputedStyle(iPlosina).getPropertyValue("top"));
            let iholeLeft = parseFloat(window.getComputedStyle(ihole).getPropertyValue("left"));
            iPlosina.style.top = iPlosinatop - speed + "px";        //rychlost plosin
            ihole.style.top = iPlosinatop - speed + "px";
            if(iPlosinatop < -20){    //maze bloky z pola, ktoré sú nad vrchom
                aktivnePlosiny.shift();
                iPlosina.remove();
                ihole.remove();
            }
            if(iPlosinatop-20<characterTop && iPlosinatop>characterTop){
                drop++;
                if(iholeLeft<=characterLeft && iholeLeft+20>=characterLeft){
                    drop = 0;
                }
            }
        }
        if(drop===0){
            if(characterTop < 480){ //gulicka nepadne pod spodok hry
                gulicka.style.top = characterTop + 2 + "px";
            }
        }else{
            gulicka.style.top = characterTop - 0.5 + "px";
        }
    },1);


</script>
</body>


@endsection
