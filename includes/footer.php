
<div class="header">
    <h1><a href="http://www.landho.epizy.com/index">SUCKLESS<span class="txt-rotate" data-period="3000" data-rotate='["!", "++;", "?", "--;"]'></span></a></h1>
</div>
<section class="home">
    <div class="in-flex">
        <form action="scripts/save" method="post">
            <div>
                <textarea 
                name="t-area"
                class="textinput"
                rows="40" 
                cols="100" 
                maxlength="5000"
                minlength="10" 
                placeholder="Write your things here..." 
                autofocus><?php echo $_SESSION['information'] ?></textarea>
            </div>
            <div class="center">
                <div>
                    <input
                        type="text"
                        name="name" 
                        maxlength="30" 
                        class="name-input" 
                        placeholder="[Name of file]" 
                        <?php echo value($_SESSION['name'])?>><br>
                </div>
                <div>
                    <input type="submit" class="btn" name="load" value="Load">
                    <input type="submit" class="btn" name="update" value="Update">
                    <input type="submit" class="btn" name="new" value="New">
                </div>
            </div>
        </form>
    </div>
    <div class="in-flex">
        <h2>RECENT POST</h2>
<?php include("scripts/auth.php"); otherPost(); ?>
    </div>
</section>
</body>
</html>