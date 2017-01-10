<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Controlling Group</title>
    <link rel="stylesheet" type="text/css" href="assets/css/backgroud_foto.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div class = "row">
        <div >
            <h1 class="col-md-offset-4">Herzlich Willkommen!</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Controlling Group</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="FeldEmail1">Email-Adresse</label>
                        <input type="email" class="form-control" id="Email1"
                               placeholder="Email-Adresse">
                    </div>
                    <div class="form-group">
                        <label for="FeldPasswort1">Password</label>
                        <input type="password" class="form-control" id="Passwort1"
                               placeholder="Passwort">
                    </div>
                    <button id="send" class="btn btn-primary">send</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('#send').click(function(){
            $.ajax({
                type: 'POST',
                data:{
                    email:$('#Email1').val(),
                    passwort:$('#Passwort1').val()
                },
                url:'<?=base_url();?>index.php/welcome/check_login',
                success: function(msg) {
                    switch(msg){
                        case 'success':
                            window.location.href = '<?=base_url();?>index.php/base/welcome';
                            break;
                        case 'error':
                            window.alert('you are not registered in the system');
                            break;
                        case 'failed':
                            window.alert('email and password may not empty');
                            break;
                        case 'pword failed':
                            window.alert('Password must contain at least 6 Draw');
                            break;
                    }
                }
            });
        })
    })
</script>
</body>
</html>