<!-- Modal -->
<div class="modal fade" id="afegir_apunts" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tancar</span></button>
        <h4 class="modal-title" id="myModalLabel">Afegir apunts</h4>
      </div>
      <div class="modal-body">
        <form class="form" method="POST" name="form_afegir_apunts" id="form_afegir_apunts" enctype="multipart/form-data">
        <input type="hidden" name="assig" class='agafar_id_assig'>
          <label for="nom_apunts">Títol</label>
            <input type="text" id="titol" name="titol" class="form-control" placeholder="Àlgebra, Literatura tema 8, etc..." maxlength="100"><br/>
          <label for="nom_apunts">Contingut</label>
            <textarea name="contingut" id="contingut" rows="10" maxlenght="30000"></textarea><br/>
          <label for="nom_apunts">Arxiu adjunt</label>
            <input type="file" name="arxiu" id="arxiu">
      </div>
      <div class="modal-footer">
        <input type="submit" id="btn_afegir_apunts" name="btn_afegir_apunts" class="btn btn-primary" data-loading-text="Afegint..." value="Afegir apuntsnatura">
      </form>
      </div>
    </div>
  </div>
</div>