<div class="container">
    <div class = "row">
        <div >
            <h1 class="col-md-offset-4">Passwort ändern </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="FeldEmail1">Email</label>
                        <input type="email" class="form-control" id="Nemail" placeholder="Email-Adresse">
                    </div>
                    <div class="form-group">
                        <label for="FeldEmail1">Altes Passwort</label>
                        <input type="password" class="form-control" id="oldPw" placeholder="Altes Passwort">
                    </div>
                    <div class="form-group">
                        <label for="FeldEmail1">Neues Passwort</label>
                        <input type="password" class="form-control" id="newPw" placeholder="Neues Passwort">
                    </div>
                    <div class="form-group">
                        <label for="FeldPasswort1">Neues Passwort wiederholen</label>
                        <input type="password" class="form-control" id="rNewPw" placeholder="Wiederhole neues Passwort">
                    </div>
                    <button id="newPwSend" class="btn btn-primary">Abschicken</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#newPwSend').click(function(){
            $.ajax({
                type: 'POST',
                data:{
                    email:$('#Nemail').val(),
                    oldpw:$('#oldPw').val(),
                    newpw:$('#newPw').val(),
                    rnewpw:$('#rNewPw').val()
                },
                url:'<?=base_url();?>index.php/new_user/change_password',
                success: function(msg) {
                    switch(msg){
                        case 'success':
                            window.location.href = '<?=base_url();?>index.php/managementPlatform/home';
                            break;
                        case 'failed':
                            window.alert('altes Passwort nicht bekannt');
                            break;
                        case 'error':
                            window.alert('Beide neue Passwörter stimmen nicht überein');
                            break;
                    }
                }
            });
        });
    })
</script>