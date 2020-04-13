<div class="app_modal_box app_modal_<?= $type; ?>">
    <p class="title icon-suitcase">Novo Negócio</p>
    <form class="app_form" action="<?= url("/app/launch"); ?>" method="post">
        <input type="hidden" name="id" value=""/>
        <label>
          <span class="field icon-user">Cliente:</span>
          <select class="select_box_customer" name="customer" required>
            <option value="" disabled selected>Selecione</option>
            <?php foreach ($owners as $owner): ?>
              <option <?= ($realty ? ($realty->proprietary == $owner->id ? 'selected' : '') : '') ?> value="<?= $owner->id ?>"><?= $owner->name ?></option>
            <?php endforeach; ?>
          </select>
        </label>

        <label>
            <span class="field icon-leanpub">Título:</span>
            <input class="radius" type="text" name="description" required/>
        </label>

        <label>
          <span class="field icon-home">Imóvel:</span>
          <select class="select_box_customer" name="customer" required>
            <option value="" disabled selected>Selecione</option>
            <?php foreach ($owners as $owner): ?>
              <option <?= ($realty ? ($realty->proprietary == $owner->id ? 'selected' : '') : '') ?> value="<?= $owner->id ?>"><?= $owner->name ?></option>
            <?php endforeach; ?>
          </select>
        </label>


        <div class="label_group">
          <label>
              <span class="field icon-filter">Etapa:</span>
              <select name="wallet">
                <option value="contato">Contato</option>
                <option value="visita">Visita</option>
                <option value="proposta">Proposta</option>
                <option value="negociacao">Negociação</option>
              </select>
          </label>

          <label>
              <span class="field icon-calendar-check-o">Fechamento Esperado:</span>
              <input class="radius masc-date" type="date" name="due_at" required/>
          </label>
        </div>

        <div class="label_check">
          <span class="field icon-leanpub">Anotações:</span>
          <textarea name="name" rows="8" cols="80"></textarea>
        </div>

        <button class="btn radius transition icon-check-square-o">Salvar</button>
    </form>
</div>
