<?php $clients = (new Source\Models\Person())->find(null, null, 'id,name')->fetch(true); ?>
<?php $properties = (new Source\Models\Realty())->find(null, null, 'id,street')->fetch(true); ?>
<?php $status = Source\Models\Business::STATUS; ?>

<div id="app_modal" class="app_modal" data-modalclose="false">
  <div class="app_modal_box app_modal_business">
      <p class="title icon-suitcase">Novo Negócio</p>
      <form class="app_form" action="<?= url("/negocios/salvar"); ?>" method="post">
          <input type="hidden" name="id" value=""/>
          <label>
            <span class="field icon-user">Cliente:</span>
            <select class="select_chosen" name="client" required>
              <option value="" disabled selected>Selecione</option>
              <?php foreach ($clients as $client): ?>
                <option value="<?= $client->id ?>"><?= $client->name ?></option>
              <?php endforeach; ?>
            </select>
          </label>

          <label>
              <span class="field icon-leanpub">Título:</span>
              <input class="radius" type="text" name="title" required/>
          </label>

          <label>
            <span class="field icon-home">Imóvel:</span>
            <select class="select_chosen" name="realty" required>
              <option value="" disabled selected>Selecione</option>
              <?php foreach ($properties as $realty): ?>
                <option value="<?= $realty->id ?>"><?= $realty->street ?></option>
              <?php endforeach; ?>
            </select>
          </label>

          <div class="label_group">
            <label>
                <span class="field icon-filter">Etapa:</span>
                <select name="status" required>
                  <option disabled selected value="">Selecione</option>
                  <?php foreach ($status as $key => $value): ?>
                    <option value="<?= $key ?>"><?= $value ?></option>
                  <?php endforeach; ?>
                </select>
            </label>

            <label>
                <span class="field icon-calendar-check-o">Fechamento Esperado:</span>
                <input class="radius masc-date" type="date" name="expected_closure" required/>
            </label>
          </div>

          <div class="label_check">
            <span class="field icon-leanpub">Anotações:</span>
            <textarea name="annotations" rows="8" cols="80"></textarea>
          </div>

          <button class="btn radius transition icon-check-square-o">Salvar</button>
      </form>
  </div>
</div>
