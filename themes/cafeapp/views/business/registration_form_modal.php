<?php
  $idUser = user()->id;

  $clients = (new Source\Models\Person())->find(
      "user_id = :u and profile = :p",
      "u={$idUser}&p=customer",
      "id,name"
  )->fetch(true);

  $properties = (new Source\Models\Realty())->find(
      "user_id = :u",
      "u={$idUser}",
      "id,finality,kind,price"
  )->fetch(true);
  $status = Source\Models\Business::STATUS;
?>


<div id="app_modal" class="app_modal">
  <div class="app_modal_box app_modal_business">
      <p id="title_business" class="title icon-suitcase">Novo Negócio</p>
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
                <option value="<?= $realty->id ?>"><?= "{$realty->finality} de {$realty->kind} por " . str_price($realty->price) ?></option>
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
            <textarea name="annotations" rows="6" cols="80"></textarea>
          </div>

          <div class="al-center">
              <div class="app_formbox_actions">
                  <a class="btn_remove transition icon-error"
                     data-businessdelete="<?= url("/negocios/excluir/"); ?>">Excluir</a>
                  <button id="btn_update_business" class="btn btn_inline radius transition icon-pencil-square-o">Atualizar</button>
                  <button id="btn_save_business" class="btn btn_inline radius transition icon-check-square-o">Salvar</button>
                  <a class="btn_back transition radius icon-sign-in click_back_business_form" title="Voltar">Voltar</a>
              </div>
          </div>


      </form>
  </div>
</div>
