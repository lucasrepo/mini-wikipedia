<?php session_start();
/* FUNCION AUXILIAR */
	include("functions.php");
/*dontBack();*/
if(!empty($_GET['error'])) (alert(htmlspecialchars($_GET['error'])));
if(isset($_SESSION['ban'])){
    header("HTTP/1.1 301 Moved Permanently"); 
    header("Location: https://en.wikipedia.org/wiki/Remember_the_sabbath_day,_to_keep_it_holy"); exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<base href="/index" />
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Crea, actualiza y carga contenido anónimo en segundos, desde cualquier dispositivo">
    <meta name="target" content="all"/>
    <meta name="audience" content="all"/>    
    <meta name="keywords" content="landho, mywiki, epizy">
    <?php 
    if(isset($_SESSION['admin'])) {
        echo "<meta http-equiv='refresh' content='50' />";
    }?>
    <meta name="author" content="senocoseno, makemeceleron@protonmail.com">
    <link rel="icon" href="http://www.landho.epizy.com/img/favicon.ico?v=2" />
    <link rel="preload" crossorigin="anonymous" href="img/starsbg.gif" as="image">
    <link rel="preload" crossorigin="anonymous" href="img/favicon.ico" as="image">
    <link rel="preload" crossorigin="anonymous" href="img/eye.png" as="image">
    <link rel="preload" crossorigin="anonymous" href="img/eyeslash.png" as="image">
    <style type="text/css">
        * { padding: 0px; margin: 0px; font-family: Trattatello Verdana; }
        body { background-color: black; ; color: white; }
        textarea { border: 1px solid white; overflow: scroll; max-width:1500px; max-height: 300px; min-width: 250px; min-height: 250px; width:100%; height:100%; outline: none; font-family: Blippo Verdana; letter-spacing: 1px; scrollbar-arrow-color: #000066; scrollbar-base-color: #000033; scrollbar-dark-shadow-color: #336699; scrollbar-track-color: #666633; scrollbar-face-color: #cc9933; scrollbar-shadow-color: #DDDDDD; scrollbar-highlight-color: #CCCCCC; }
        h1, h2, h3, h4 { text-align: center; }

        a:link { color: white; text-decoration: none; } a:visited { color: white; text-decoration: none; } a:hover { color: gold; text-decoration: none; } a:active { color: white; text-decoration: none; }
        .header { padding: 30px;  background: #00003F; color: white; font-size: medium; position: relative; }
        .header a { text-align: left; font-family: papyrus Verdana; }
        #grad { background-image: linear-gradient(0deg, #00003F, #00008F); }

        .home { display: flex; flex-wrap: wrap; }
        .in-flex { flex: 1; min-width: 300px; }
        .in-flex:first-child { flex: 2; margin: 0; }
        .in-flex div { background: #00003F; padding: 5px; margin: 5px; }
        .in-flex h4 { font-size: x-small; }
        #grad2 { background-image: linear-gradient(to right, #00002F, #00005F); }
        #name::placeholder { color: blue; }
        .center {vertical-align: center; text-align: center; -webkit-box-sizing:border-box; -moz-box-sizing: border-box; box-sizing: border-box; }
        input { text-align: center; border: 2px solid #00008F; margin: 0; padding: 5px 5px; border-radius: 5px; width:50%; max-width: 900px; }
        /*.bottomright { position: fixed; bottom: 8px; right: 16px; opacity: 0.5; }*/
        #togglePassword { cursor: pointer; margin-left: -30px; }
        #eye { width: 20px; height: 15px; }
        .btn input { cursor: pointer; }
        #recent textarea { color: white; background-color: #00003F; border-color: #00003F; min-height: 150px; }
    </style>
    <script>
        function showPassword() {
        var image = document.getElementById('eye');
        var x = document.getElementById("psw");
        if (x.type === "password") {
            x.type = "text";
            image.src = "img/eyeslash.png";
        } else {
            x.type = "password";
            image.src = "img/eye.png";
        }
        
        } 
        function gfg_Run() {
            el_down.innerHTML = generateP();
        }

        var TxtRotate = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
        };

        TxtRotate.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
            this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
            this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 300 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
            delta = this.period;
            this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
            this.isDeleting = false;
            this.loopNum++;
            delta = 500;
        }

        setTimeout(function() {
            that.tick();
        }, delta);
        };

        window.onload = function() {
        var elements = document.getElementsByClassName('txt-rotate');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-rotate');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
            new TxtRotate(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".txt-rotate > .wrap { border-right: 0.08em solid black }";
        document.body.appendChild(css);
        };
    </script>
	<?php title(htmlspecialchars($_GET['name']), $_SESSION['name']) ?>
</head>
