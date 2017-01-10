<div>
    <h1 class="col-md-offset-1"> Welcome to my Website</h1>
</div>
<div id="create_dhr" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ajouter les informations de l'adherant</h4>
            </div>
            <div class="modal-body">
                <table class="table table-consended table-striped">
                    <tbody>
                        <tr>
                            <td colspan="4"><input type="text" class="form-control" id="nomAhr" placeholder="Nom"></td>
                        </tr>
                        <tr>
                            <td colspan="4"><input type="text" class="form-control" id="pmAhr" placeholder="Prenom"></td>
                        </tr>
                        <tr>
                            <td colspan="4"><input type="text" class="form-control" id="sAhr" placeholder="Statu"></td>
                        </tr>
                        <tr>
                            <td colspan="4"><input type="text" class="form-control" id="adAhr" placeholder="Annee d'adhesion"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="send">Enregistrer</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ferme</button>
            </div>
        </div>

    </div>
</div>
<div id="edit_dhr" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modifier les informations de l'adherant</h4>
            </div>
            <div class="modal-body" id="edit_member_body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="send_new_mber">Enregistrer</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ferme</button>
            </div>
        </div>

    </div>
</div>
<div>
    <?=$table;?>
</div>
<script>
    $(document).ready(function () {
        $('.edit_member').click(function () {
            var id_n = $(this).attr('$member_id');
            $.ajax({
                type:'POST',
                data:{
                    id:id_n
                },
                url:'<?= base_url();?>index.php/page_management/member_form',
                success:function(data) {
                    $('#edit_member_body').html(data);
                    $('#edit_dhr').modal('show');
                }
            });

        });
        $('#send_new_mber').click(function () {
            $.ajax({
                type:'POST',
                data:{
                    id:$('#eMid').text(),
                    name:$('#eName').val(),
                    vorname:$('#eVorname').val(),
                    statu:$('#eStatu').val(),
                    annee:$('#eAnnee').val()
                },
                url:'<?=base_url();?>index.php/page_management/update_member',
                success:function (data) {
                    location.reload();
                }
            })
        })
        $('#send').click(function () {
            $.ajax({
                type:'POST',
                data:{
                    name:$('#nomAhr').val(),
                    vorname:$('#pmAhr').val(),
                    statu:$('#sAhr').val(),
                    annee:$('#adAhr').val()
                },
                url:'<?=base_url();?>index.php/page_management/add_member',
                success:function (msg) {
                    location.reload();
                }
            })
        })
    });
</script>