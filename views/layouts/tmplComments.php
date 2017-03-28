<div class="comments row offset-by-three nine columns">
<?php foreach ($commentsById as $comment): ?>
    <div class="comment <?= $comment['cid']; ?>" id="<?= $comment['cid']; ?>" >
        <div class="row">
            <div class="twelve columns">
                <div class="info">
                    <div class="six columns">
                        <p class="comment-author"> Author: <span><?= $comment['author'] ;?></span></p>
                    </div>
                    <div class="six columns">
                        <p class="comment-date"> Date: <span><?= $comment['cdate'] ;?></span></p>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="twelve columns">
                    <blockquote class="comment-desc"><?= $comment['cdesc']; ?></blockquote>
            </div>
            </div>
            <div class="row replys">
                <button data-id="<?= $comment['cid']; ?>" class="replyFormBtn btn2 <?= $comment['cid']; ?>">reply</button>

                <?php echo "
            <form style= 'display:none' id='replyForm' class='replyForm' method='post' data-id= " . $comment['cid'] . " enctype='multipart/form-data'>
                <div class='row offset-by-three nine columns'>
                  
                    <label for='comment'>Reply :</label>
                    <textarea data-validation='required' class='reply u-full-width' placeholder='Hi, " . Sessions::get('id') . "! You can reply comment here ) ' id='reply' name='reply'></textarea>
                    <div class='row'>
                        <input onclick='checkReply()' class='btn2' type='submit' value='Reply' name='addReply' id='addReply'>
                    </div>

            </form>
        ";

                ?>

            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>