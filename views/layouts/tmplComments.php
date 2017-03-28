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
        </div>
    </div>
<?php endforeach; ?>
</div>
