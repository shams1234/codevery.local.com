<?php foreach ($allMessages as $message): ?>
    <li class="shortMessage" id="<?= $message['MID']; ?>">
        <div class="row">
            <div class="six columns">
                <p class="message"><span class="message-title">Title: </span><?= $message['mtitle']; ?></p>
            </div>
            <div class="five columns">
                <span class="message-date">Created at: </span><?= $message['mdate']; ?>
                <p class="message-author">Author : <span><?= $message['mauthor']; ?></span></p>
            </div>
            <div class="one columns">
                <a id="<?= $message['MID']; ?>" href="#"><i class="fa fa-plus-circle fa-3x"></i></a>
            </div>
        </div>
        <?php include ROOT . '/views/layouts/tmplComments.php'; ?>
    </li>

    <li class="messages <?= $message['MID']; ?>" id="<?= $message['MID']; ?>">
        <div class="message-id"><span><?= $message['MID']; ?></span></div>
        <div class="row">
            <div class="three columns">
                <div class="user-avatar-small">
                    <img src="<?= $message['mpic']; ?>" alt="">
                </div>
            </div>
            <div class="nine columns">
                <p class="message-desc-header">Description: </p>
                <p class="message-desc"><?= $message['mdesc']; ?></p>

            </div>
        </div>
    <?php if (Sessions::get('id') && Sessions::get('id') === 'Anonymous') {
         } else {


        echo "
            <form class='commentForm' method='post' enctype='multipart/form-data'>
                <div class='row offset-by-three nine columns'>
                  
                    <label for='comment'>Please live a comment :</label>
                    <textarea data-validation='required' class='comment u-full-width' placeholder='Hi, " . Sessions::get('id') . "! You can type comment here ) ' id='comment' name='comment'></textarea>
                    <div class='row'>
                        <input onclick='checkComments()' class='button' type='submit' value='Add Comment' name='addComment' id='addComment'>
                    </div>

            </form>
        ";}

        ?>

    </li>

    <hr>
<?php endforeach; ?>

<?php $from = $message['MID'] ?>