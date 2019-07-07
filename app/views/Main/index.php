<?php if(!empty($posts)): ?>
<!-- show posts/articles-->
 <?php foreach ($posts as $post): ?>
        <div class="content-grid">
            <div class="content-grid-info">
                <img src="/blog/images/post1.jpg" alt=""/>
                <div class="post-info">
                    <h4><a href="<?= $post->id ?>"><?= $post->title ?></a>  July 30, 2014 / 27 Comments</h4>
                    <p><?= $post->excerpt ?></p>
                    <a href="<?= $post->id ?>"><span></span>READ MORE</a>
                </div>
            </div>
        </div>
 <?php endforeach; ?>
<!-- end show posts/articles -->
    <!--  show pagination-->
    <div class="text-center">
        <p>Статей: <?= count($posts); ?> из <?= $total ?></p>
        <?php if($pagination->countPages > 1): ?>
            <?= $pagination ?>
        <?php endif; ?>
    </div>
   <!-- end show pagination -->
<?php else: ?>
 <h3>Posts not found...</h3>
<?php endif; ?>
