<!-- Modal -->
<div class="modal fade" id="afegir_curs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tancar</span></button>
        <h4 class="modal-title" id="myModalLabel">Afegir curs</h4>
      </div>
      <div class="modal-body">
        <form class="form" method="POST" name="form_afegir_curs" id="form_afegir_curs">
          <label for="nom_curs">Curs:</label>
            <input type="text" id="nom_curs" name="nom_curs" class="form-control" placeholder="1r, 2n de batxillerat..." maxlength="100">
          <label></label>  
      </div>
      <div class="modal-footer">
        <input type="submit" id="btn_afegir_curs" name="btn_afegir_curs" class="btn btn-primary" data-loading-text="Afegint..." value="Afegir curs">
      </form>
      </div>
    </div>
  </div>
</div>