<?php Sessions::start(); ?>
<?php include (ROOT . '/views/layouts/header.php'); ?>

    <div class="container">
        <div class="row">

            <div class="one-half column" style="margin-top: 15%">

                <h2>The Wall)</h2>
            </div>

            <div class="one-half column" style="margin-top: 15%">
                <div class='welcome'>Welcome, <span><?= Sessions::get('id'); ?></span><p><span><?= Sessions::get('email'); ?></span></p>
                    <p><a href='/logout' style="float:right;" class='button' name='addMessage' id='logout'>Logout</a></p>
                </div>

            </div>
        </div>

        <?php if (Sessions::get('id') && Sessions::get('id') === 'Anonymous') {
            echo "

             <div>
                <p>Sorry, You must be logged in to add message! You can do this <a href='/'>Here</a>!</p>
            </div>
            ";

        } else {

            echo "
            <div>

                <form id='messageForm' method='post' enctype='multipart/form-data'>
                    <div class='row'>
                    <label for='title'>Title :</label>
                      <input data-validation='required' class='u-full-width' type='text' id='title' name='title' placeholder='Enter the title here'> 
                        <label for='message'>Message :</label>
                        <textarea data-validation='required' class='u-full-width' placeholder='Hi, " . Sessions::get('id') . "! You can type message here ) ' id='message' name='message'></textarea>
                        <div class='row'>
                        <input onclick='checkMessage()' class='button' type='submit' value='Add Post' name='addMessage' id='addMessage'>
                    </div>
                       
                </form>
              
            </div>
            
            ";

        }
        ?>

    </div>
    <div class="container ">
    <h3 class="section-heading">Messages: <?= count($allMessages);?> </h3>
    <ul class="messages-list">

        <hr>

        <?php include (ROOT . '/views/layouts/tmplMsg.php'); ?>
    </ul>

           <button class="button loadmore" data-val="<?= $from ;?>">Load More</button>

    </div>

<?php include (ROOT . '/views/layouts/footer.php'); ?>