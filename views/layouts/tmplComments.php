<div class="comments row offset-by-three nine columns">
    <?php if (!is_array($commentsById) && count($commentsById) === 0): $commentsById = Comments::getCommentsByMessageId(); ?>
<?php else :?>
<?php foreach ($commentsById as $comment): ?>
    <ul class="comment <?= $comment['cid']; ?>" id="<?= $comment['cid']; ?>" >
        <li class="row">
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
        </li>
        <li class="row">
            <div class="twelve columns">
                    <blockquote class="comment-desc"><?= $comment['cdesc']; ?></blockquote>
            </div>

            <div class="replys">
                <button data-id="<?= $comment['cid']; ?>" class="replyFormBtn btn2 <?= $comment['cid']; ?>">reply</button>

                <?php echo "
            <form style= 'display:none' id='replyForm' class='replyForm' method='post' data-id= " . $comment['cid'] . " enctype='multipart/form-data'>
                <div class='twelve columns'>
                  
                    <label for='comment'>Reply :</label>
                    <textarea data-validation='required' class='reply u-full-width' placeholder='Hi, " . Sessions::get('id') . "! You can reply comment here ) ' id='reply' name='reply'></textarea>
                    <div class='row'>
                        <input onclick='checkReply()' class='btn2' type='submit' value='Send' name='addReply' id='addReply'>
                    </div>

            </form>
        ";

                ?>

            </div>
        </li>
    </ul>
<?php endforeach; ?>
<?php endif;?>
</div>