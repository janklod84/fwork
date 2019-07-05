<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $meta['title'] ?></title>
    <meta name='description' content="<?= $meta['desc'] ?>">
    <meta name='keywords' content="<?= $meta['keywords'] ?>">

    <!-- styles -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
     <div class="container">
         <!-- show menu -->
         <?php if(!empty($menu)): // debug($menu); ?>
         <ul class="nav nav-pills">
             <li role="presentation">
                 <a href="page/about">About</a>
             </li>
             <?php foreach($menu as $item): ?>
                 <li role="presentation">
                     <a href="category/<?= $item['id'] ?>"><?= $item['title'] ?></a>
                 </li>
             <?php endforeach; ?>
         </ul>
         <?php endif; ?>

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