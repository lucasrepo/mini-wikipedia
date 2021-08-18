<?php session_start();
/* FUNCION AUXILIAR */
	include("functions.php");
/*dontBack();*/
if(!empty($_GET['error'])) alert($_GET['error']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<base href="/index" />
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="http://www.landho.epizy.com/img/favicon.ico?v=2" />
	<link rel="stylesheet" type="text/css" href="css/style.css?v=3">
    <link rel="preload" href="img/starsbg.gif" as="image">
    <link rel="preload" href="img/favicon.ico" as="image">
    <link rel="preload" href="img/eye.png" as="image">
    <link rel="preload" href="img/eyeslash.png" as="image">
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
	<?php title($_GET['name'], $_SESSION['name']) ?>
</head>
