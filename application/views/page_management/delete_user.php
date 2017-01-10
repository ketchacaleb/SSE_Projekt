<div class="container">
    <div class = "row">
        <div >
            <h1 class="col-md-offset-4">Benutzer löschen </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="FeldEmail1">Email-Adresse</label>
                        <input type="email" class="form-control" id="dEmail1" placeholder="Email-Adresse">
                    </div>
                    <button id="dSend" class="btn btn-primary">Abschicken</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#dSend').click(function(){
            $.ajax({
                type: 'POST',
                data:{
                    email:$('#dEmail1').val()
                },
                url:'<?=base_url();?>index.php/new_user/delete_user',
                success: function(msg) {
                    switch(msg){
                        case 'success':
                            window.location.href = '<?=base_url();?>index.php/managementPlatform/home';
                            break;
                        case 'failed':
                            window.alert('dieser Benutzer ist nicht vorhanden');
                            break;
                    }
                }
            });
        })
    })
</script>