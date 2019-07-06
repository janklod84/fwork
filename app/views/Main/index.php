<!-- show answer from json -->
<div id="answer"></div>
<button class="btn btn-default" id="send">Кнопка</button>
<!-- end show answer from json -->

<!-- widgets menu -->
<?php new \Project\Widgets\Menu([


]); ?>
<br>
<!-- end widgets menu -->

<!-- rendering posts -->
<?php if(!empty($posts)): ?>
  <?php foreach($posts as $post): ?>
    <div class="panel panel-default">
        <div class="panel-heading"><?= $post['title'] ?></div>
        <div class="panel-body"><?= $post['text'] ?></div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>
<!-- end rendering posts -->

<!-- Add scripts only in this page -->
<script src="/assets/js/test.js"></script>
<script>
    $(function () {
        $('#send').click(function () {
            $.ajax({
                url: '/main/test',
                type: 'post',
                data: {'id': 2},
                success: function (res) {

                    $('#answer').html(res);

                    // show answer from server to view
                    // var data = JSON.parse(res);
                    // $('#answer').html('<p>Message: '+ data.message +' | Code: '+ data.code +'</p>');

                    // show answer in console
                    // console.log(res);
                },
                error: function () {
                    alert('Error');
                }
            });
        });
    });
</script>
<!-- end scripts -->