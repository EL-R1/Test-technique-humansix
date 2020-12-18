<?php
include_once  "../Mise_en_page/header.php";
include_once  "../Mise_en_page/footer.php";
session_unset();
mon_header_login("Index");


?>


<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <form method="post" action="../actions/Log_in.php">
            <div class="mb-3 row">
                <label for="Email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="email">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="mot_de_passe">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </div>
    <div class="col-sm-4"></div>

</div>

</body>
</html>

<?php mon_footer(); ?>
