<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?> - Book Deals</title>
        <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>css/login.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>css/icons.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/styler.js"></script>
    </head>
    <body>
        <?php if (isset($message) && !empty($message)) { ?>
            <div class="popup_wrap" id="popup">
                <div class="popup_box">
                    <?php echo $message; ?>
                </div>
            </div>
            <?php
        }
        