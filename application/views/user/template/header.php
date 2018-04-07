<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?> - Book Deals</title>
        <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>css/slider.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>css/user_style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>css/icons.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/slider.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/styler.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="header">
            <div class="menu">
                <ul class="menu_ul">
                    <a href="<?php echo base_url(); ?>"><li>Home</li></a>
                    <li><a id="dropDownCategory" href="javascript:void(0);">Categories <span class="caret"></span></a>
                        <div class="menu_list" id="dropDownItemCategory">
                            <?php
                            if (!empty($AllCategories)) {
                                foreach ($AllCategories as $category) {
                                    ?>
                                    <div><a href="<?php echo base_url() ?>searchByCategory/<?php echo str_replace(' ', '-', $category->name); ?>"><?php echo $category->name; ?></a></div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </li>
                    <a href="<?php echo base_url() ?>request"><li>User's Request</li></a>
                    <?php if (empty($user_id) && !isset($user_id)) { ?>
                        <a href="<?php echo base_url() ?>login"><li>Login</li></a>
                        <a href="<?php echo base_url() ?>register"><li>Register</li></a>
                    <?php } else { ?>
                        <a href="<?php echo base_url() ?>logout"><li>Logout</li></a>
                    <?php } ?>
                </ul>
                <div class="search_area">
                    <form method="get" action="<?php echo base_url() ?>search/">
                        <input type="text" placeholder="Search..." class="form-control search_box" name="keyword"/>
                        <button class="btn btn-default search_btn" type="submit">
                            <i class="fa fa-search" ></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
        <div class="container" id="container">
            <?php if (isset($message) && !empty($message)) { ?>
                <div class="popup_wrap" id="popup">
                    <div class="popup_box">
                        <?php echo $message; ?>
                    </div>
                </div>
                <?php
            }