
<div class="header" id="grad">
    <h1><a href="http://www.landho.epizy.com/index">MyWiki<span class="txt-rotate" data-period="3000" data-rotate='["!", "++;", "?", "--;"]'></span></a><p style="font-size:small;"> <a href="http://www.landho.epizy.com/random/faq.html">FAQ</a> || <a href="http://www.landho.epizy.com/random/about">About</a></p></h1>
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
                placeholder="Write your things here..." 
                autofocus><?php echo showInfo("information"); ?></textarea>
            </div>
            <div class="center" id="grad2">
                <?php
                notification();
                ?>
                <div>
                    <input type="text" name="name" id="name" maxlength="30" placeholder="Title" <?php echo value(showInfo("name")); ?>>
                    <input type="password" name="pass" maxlength="30" placeholder="[Password]" id="psw" <?php echo setPassword(); ?>><i onclick="showPassword()" id="togglePassword" alt="Show/Hide Password"><img src="img/eye.png" id="eye"></i>
                </div>
                <div>
                    <div>
                        <input type="submit" name="load" value="Load"><input type="submit" name="update" value="Update">
                    </div>
                    <div>
                        <input type="submit" name="new" value="New"><input type="submit" name="add" value="Add">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="in-flex">
        <h2>RECENT POST</h2>
<?php include("scripts/auth.php"); otherPost(); ?>
    <div class="bottomright"><a href="#"><img src="img/favicon.ico" alt="UP"></a></div>
    </div>
</section>
</body>
</html>