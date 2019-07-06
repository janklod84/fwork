<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= \Project\Template\View::getMeta() ?>

    <!-- styles -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div class="container">
    <h1>Admin</h1>
    <!-- show content -->
    <?= $content ?>

    <?php //debug(\Project\Database\DB::$countSql); ?>
    <?php // debug(\Project\Database\DB::$queries); ?>
</div>

<!-- scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<!--  Get scripts -->
<?php
// populates scripts [ variables $scripts definded inside view ]
foreach($scripts as $script) {
    echo $script;
}
?>


</body>
</html>