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
         <!-- show menu -->
         <ul class="nav nav-pills">
             <li role="presentation">
                 <a href="/">Home</a>
             </li>
             <li role="presentation">
                 <a href="page/about">About</a>
             </li>
             <li role="presentation">
                 <a href="/admin">Admin</a>
             </li>
             <li role="presentation">
                 <a href="/user/signup">Sign Up</a>
             </li>
             <li role="presentation">
                 <a href="/user/login">Login</a>
             </li>
             <li role="presentation">
                 <a href="/user/logout">Logout</a>
             </li>

         </ul>
         <!-- end menu -->

         <!-- show messages -->
         <?php if(isset($_SESSION['error'])): ?>
             <div class="alert alert-danger">
                 <?= $_SESSION['error']; unset($_SESSION['error']); ?>
             </div>
         <?php endif; ?>
         <?php if(isset($_SESSION['success'])): ?>
             <div class="alert alert-success">
                 <?= $_SESSION['success']; unset($_SESSION['success']); ?>
             </div>
         <?php endif; ?>
         <!-- end show messages -->

         <?php debug($_SESSION); ?>

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