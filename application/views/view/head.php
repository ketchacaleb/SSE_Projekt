<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Controlling Group</title>
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>css/bootstrap.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Titel und Schalter werden für eine bessere mobile Ansicht zusammengefasst -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Navigation ein-/ausblenden</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><b>Controlling Group</b></a>
        </div>
        <div class="collapse navbar-collapse visible-sm visible-md visible-lg" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?=base_url();?>index.php/page_management/home">Home</a></li>
                <li><a href="<?=base_url();?>index.php/page_management/pay_area">Buy</a></li>
                <li><a href="<?=base_url();?>index.php/page_management/club">controlling Night Club</a></li>
                <li><a href="<?=base_url();?>index.php/page_management/health">Video_call</a></li>
                <li><a href="<?=base_url();?>index.php/page_management/event">Events</a></li>
                <li><a href="<?=base_url();?>index.php/page_management/info">Information</a></li>
                <li><a href="<?=base_url();?>index.php/page_management/borommee">Contact</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User Management<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=base_url();?>index.php/users_management/show_user">New User</a></li>
                        <li><a href="<?=base_url();?>index.php/users_management/show_delete_user">Delete User</a></li>
                        <li><a href="<?=base_url();?>index.php/users_management/show_change_pw">Edit Password</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?=base_url();?>index.php/welcome/login"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            </ul>
        </div>

    </div>
</nav>
<div class="container">