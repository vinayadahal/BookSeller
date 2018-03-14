<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?> - Book Deals</title>
        <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>css/member.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>css/icons.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/styler.js"></script>
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
                        <li><a href="#">Posts</a></li>
                        <li><a href="#">Requested Book</a></li>
                        <li><a href="#">Order History</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hi, Admin<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container" id="container">