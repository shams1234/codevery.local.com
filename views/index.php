<?php


if (Sessions::get('id') && Sessions::get('id') !== 'Anonymous') {
    header("Location: /messages");
    Sessions::show();

}

?>

<?php include(ROOT . '/views/layouts/header.php'); ?>

    <div class="section registration">
        <div class="container">
            <h3 class="section-heading">Want getting started?</h3>
            <p class="section-description">It is an amazingly simple app. If you want to start, just Log In !</p>
            <pre><p><b>email:</b> codevery@support.com && <b>password: </b>123</p></pre>
            <form id="standardLogin" action="/login" method="post">
                <div class="row">
                    <div class="offset-by-three six columns">
                        <label for="email">Your email:</label>
                        <input class="u-full-width" type="email" placeholder="test@mailbox.com" data-validation="email" id="email" name="email">
                    </div>
                </div>
                <div class="row">
                    <div class="offset-by-three six columns">
                        <label for="pwd">Your password:</label>
                        <input class="u-full-width" type="password" data-validation="required" placeholder="password" id="pwd" name="pwd">
                    </div>
                </div>
                <div class="row">
                    <input onclick="checkUsersInput()" class="button" type="submit" value="Login" id="login">
                </div>

            </form>
        </div>
        <div class="container">
            <h1><b>OR</b></h1>
            <p><b>you can login with:</b></p>
            <div class="row"><div class="msgNoty offset-by-three six columns" id="status"></div></div><br/>
            <div class="row">

<!--                <input class="button" type="submit" value="facebook">-->

                <?php

                    echo '<div><a class="button" href="' . $loginUrl . '">Facebook</a></div>';
                    echo $googleLoginBtn;
                ?>


            </div>

        </div>
        <div class="container">
            <h1><b>OR</b></h1>
            <p><b>you can enter like 'Anonymous' user:</b></p>

            <div class="row">
                <div class="offset-by-three six columns">
                    <form id="anonumousForm" action="/anonymous" method="post">
                        <label for="license">License Agreement</label>
                        <textarea disabled class="u-full-width" placeholder="It's a license" id="license"></textarea>

                        <label class="check-license">
                            <input type="checkbox" id="license" name="license" data-validation="required">
                            <span class="label-body">Agree</span>
                        </label>
                        <input class="button" onClick="checkLisence()" type="submit" value="Enter" name="anonymous" id="anonymous">
                    </form>
                </div>
            </div>

        </div>
    </div>

<?php include(ROOT . '/views/layouts/footer.php'); ?>