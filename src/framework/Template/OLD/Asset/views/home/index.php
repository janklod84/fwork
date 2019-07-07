<h1>Welcome to Home page</h1>

<button id="send" class="btn btn-default"></button>

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
                    console.log(res);
                },
                error: function () {
                    alert('Error');
                }
            });
        });
    });
</script>
