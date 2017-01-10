<div class="container">
    <div class = "row">
        <div >
            <h1 class="col-md-offset-4">Neuer Benutzer anlegen </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="FeldEmail1"nam>Admine</label>
                        <input type="password" class="form-control" id="aName" placeholder="Adminname">
                    </div>
                    <div class="form-group">
                        <label for="FeldEmail1">Email-Adresse</label>
                        <input type="email" class="form-control" id="newEmail1" placeholder="Email-Adresse">
                    </div>
                    <div class="form-group">
                        <label for="FeldPasswort1">Passwort</label>
                        <input type="password" class="form-control" id="newPasswort1" placeholder="Passwort">
                    </div>
                    <button id="newSend" class="btn btn-primary">Abschicken</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#newSend').click(function(){
            $.ajax({
                type: 'POST',
                data:{
                    email:$('#newEmail1').val(),
                    passwort:$('#newPasswort1').val(),
                    admin:$('#aName').val()
                },
                url:'<?=base_url();?>index.php/users_management/add_user',
                success: function(msg) {
                    switch(msg){
                        case 'success':
                            window.location.href = '<?=base_url();?>index.php/page_management/home';
                            break;
                        case 'error':
                            window.alert('User bereits vorhanden');
                            break;
                        case 'failed':
                            window.alert('Adminname, Email und Passwort dürfen nicht leer sein');
                            break;
                        case 'pword failed':
                            window.alert('Passwort muss mindestens 6 Zeichnen beinhalten');
                            break;
                        case 'added failed':
                            window.alert('Sie duerfen nicht neue Benutzer hinzufuegen, wenden Sie an Ihren Admin');
                            break;
                    }
                }
            });
        })
    })
</script>