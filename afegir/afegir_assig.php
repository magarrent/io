<!-- Modal -->
<div class="modal fade" id="afegir_assig" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tancar</span></button>
        <h4 class="modal-title" id="myModalLabel">Afegir assignatures</h4>
      </div>
      <div class="modal-body">
        <form class="form" method="POST" name="form_afegir_assig" id="form_afegir_assig">
          <label for="nom_assig">Nom de la assignatura:</label>
            <input type="text" id="nom_assig" name="nom_assig" class="form-control" placeholder="Català, Història..." maxlength="100">
          <label></label>  
      </div>
      <div class="modal-footer">
        <input type="submit" id="btn_afegir_assig" name="btn_afegir_assig" class="btn btn-primary" data-loading-text="Afegint..." value="Afegir assignatura">
      </form>
      </div>
    </div>
  </div>
</div>