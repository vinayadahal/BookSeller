<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?> - Book Deals</title>
        <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>css/member.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>css/icons.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/styler.js"></script>
        <script type='text/javascript' src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>member"><i class="fa fa-book"></i> Book Deals</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url(); ?>member">Home</a></li>
                        <li><a href="<?php echo base_url(); ?>member/my-books">My Books</a></li>
                        <li><a href="<?php echo base_url(); ?>member/my-posts">Posts</a></li>
                        <li>
                            <a href="<?php echo base_url(); ?>member/matches">Matching Books <?php
                                if (!empty($books)) {
                                    echo "<span style='color:#f00;'>(" . count($books) . ")</span>";
                                }
                                ?>
                            </a></li>
                        <li><a href="#">Settings</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hi, <?php echo ucwords($user->name); ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Settings</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo base_url() ?>logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container" id="container">