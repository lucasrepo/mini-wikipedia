<body style="background-image: url('img/starsbg.gif')">
<div class="header" id="grad">
    <h1><a href="http://www.landho.epizy.com/index">MyWiki<span class="txt-rotate" data-period="3000" data-rotate='["!", "++;", "?", "--;"]'></span></a><p style="font-size:small;"> <a href="http://www.landho.epizy.com/random/faq.html">FAQ</a> || <a href="http://www.landho.epizy.com/random/about">About</a> || <a href="http://www.landho.epizy.com/includes/admin.php">Admin</a></p></h1>
</div>
<section class="home">
    <div class="in-flex">
        <form action="scripts/save" method="post">
            <div id="grad2">
                <textarea 
                name="t-area"
                class="textinput"
                rows="40" 
                cols="100" 
                maxlength="3000"
                minlength="10" 
                placeholder="Carga, actualiza o crea una publicación..." 
                autofocus><?php echo showInfo("information"); ?></textarea>
            </div>
            <div class="center" id="grad2">
                <?php
                notification();
                ?>
                <div>
                    <input type="text" name="name" id="name" maxlength="30" placeholder="Título" <?php echo value(showInfo("name")); ?>>
                    <input type="password" name="pass" maxlength="30" placeholder="[Contraseña]" id="psw" <?php echo setPassword(); ?>><i onclick="showPassword()" id="togglePassword" alt="Show/Hide Password"><img src="img/eye.png" id="eye"></i>
                </div>
                <div class="btn">
                    <div>
                        <input type="submit" name="load" value="Cargar"><input type="submit" name="update" value="Actualizar">
                    </div>
                    <div>
                        <input type="submit" name="new" value="Nuevo"><input type="submit" name="add" value="Añadir a favoritos">
                    </div>
                </div>
                <?php if(isset($_SESSION['admin'])){ ?>
                    <div class="btn" style="background-color: gold">
                        <input type="submit" style="width: 100%; border-color: black" name="ban" value="Ban">
                    </div>
                <?php } ?>
            </div>
            <div>
            	<div style="background-color: black;">
            		<h2>FAVORITOS</h2>
            	</div>
                <?php showFavs(); ?>
            </div>
        </form>
    </div>
    <div class="in-flex" id="recent">
    	<div style="background-color: black;">
        	<h2>PUBLICACIONES RECIENTES</h2>
        </div>
<?php include("scripts/auth.php"); otherPost(); ?>
    <!---
    <div class="bottomright"><a href="#"><img src="img/favicon.ico" alt="UP"></a></div>
        --->
    </div>
</section>
</body>
</html>