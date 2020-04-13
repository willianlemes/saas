<?php $v->layout("_theme"); ?>

<?php $v->start('styles') ?>
  <link rel="stylesheet" href="<?= theme("/assets/chosen.min.css", CONF_VIEW_APP); ?>"/>
<?php $v->stop() ?>

<div class="app_formbox app_widget">
    <form class="app_form" action="<?= url("/imoveis/salvar"); ?>" method="post">
      <header class="app_widget_title">
          <h2 class="icon-home">Cadastro de Imóvel</h2>
      </header>
      <fieldset>
        <legend>Sobre o Imóvel</legend>
        <input type="hidden" name="id" value="<?= $realty->id ?? null ?>">

        <label>
          <span class="field">Proprietário:</span>
          <select class="select_box" name="proprietary">
            <option value="" disabled selected>Selecione</option>
            <?php foreach ($owners as $owner): ?>
              <option <?= ($realty ? ($realty->proprietary == $owner->id ? 'selected' : '') : '') ?> value="<?= $owner->id ?>"><?= $owner->name ?></option>
            <?php endforeach; ?>
          </select>
        </label>

        <div class="label_group">
          <label>
              <span class="field">Finalidade:</span>
              <select name="finality" required>
                  <option value="">Selecione</option>
                  <?php foreach ($finality as $value): ?>
                    <option <?= ($realty ? ($realty->finality == $value ? 'selected' : '') : '') ?> value="<?= $value ?>"><?= $value ?></option>
                  <?php endforeach; ?>
              </select>
          </label>
          <label>
              <span class="field">Tipo:</span>
              <select name="kind" required>
                  <option value="">Selecione</option>
                  <?php foreach ($kinds as $key => $value): ?>
                    <option <?= ($realty ? ($realty->kind == $value ? 'selected' : '') : '') ?> value="<?= $value ?>"><?= $value ?></option>
                  <?php endforeach; ?>
              </select>
          </label>
        </div>

        <div class="label_group">
          <label>
              <span class="field">Preço de Venda:</span>
              <input class="radius mask-money" type="text" name="price"
                     value="<?= $realty->price ?? null ?>" required/>
          </label>
        </div>

      </fieldset>
        <fieldset>
          <legend>Localização</legend>
          <div class="label_group">
            <label>
                <span class="field">Logradouro:</span>
                <input class="radius" type="text" name="street"
                       value="<?= $realty->street ?? null; ?>"/>
            </label>

            <label>
                <span class="field">Número:</span>
                <input class="radius" type="text" name="number"
                       value="<?= $realty->number ?? null; ?>"/>
            </label>
          </div>
          <div class="label_group">
            <label>
                <span class="field">Bairro:</span>
                <input class="radius" type="text" name="neighborhood"
                       value="<?= $realty->neighborhood ?? null; ?>"/>
            </label>

            <label>
                <span class="field">CEP:</span>
                <input class="mask-cep radius" type="text" name="cep"
                       value="<?= $realty->cep ?? null; ?>"/>
            </label>
          </div>
          <div class="label_group">
            <label>
                <span class="field">Estado:</span>
                <select class="states" name="state"
                        data-url="<?= url("/storage/estados_cidades.json") ?>"
                        data-value="<?= $realty->state ?? null; ?>">
                </select>
            </label>

            <label>
                <span class="field">Cidade:</span>
                <select class="cities" name="city"
                        data-value="<?= $realty->city ?? null; ?>">
                </select>
            </label>
          </div>
          <div class="label_group">
            <label>
                <span class="field">Complemento:</span>
                <input class="radius" type="text" name="complement"
                       value="<?= $realty->complement ?? null; ?>"/>
            </label>
          </div>

        </fieldset>

        <fieldset>
          <legend>Área</legend>
          <div class="label_group">
            <label>
                <span class="field">Unidade de Medida:</span>
                <select name="measureType">
                  <option value="">Selecione</option>
                  <?php foreach ($measureType as $key => $value): ?>
                    <option <?= ($realty ? $realty->measureType == $value ? 'selected' : '' : '') ?> value="<?= $value ?>"><?= $value ?></option>
                  <?php endforeach; ?>
                </select>
            </label>
          </div>
          <div class="label_group">
            <label>
                <span class="field">Frente:</span>
                <input class="radius" type="number" name="zoneFront"
                       value="<?= $realty->zoneFront ?? 0; ?>"/>
            </label>

            <label>
                <span class="field">Fundo:</span>
                <input class="radius" type="number" name="zoneBottom"
                       value="<?= $realty->zoneBottom ?? 0; ?>"/>
            </label>
          </div>
          <div class="label_group">
            <label>
                <span class="field">Lateral Direita:</span>
                <input class="radius" type="number" name="zoneRight"
                       value="<?= $realty->zoneRight ?? 0; ?>"/>
            </label>

            <label>
                <span class="field">Lateral Esquerda:</span>
                <input class="radius" type="number" name="zoneLeft"
                       value="<?= $realty->zoneLeft ?? 0; ?>"/>
            </label>
          </div>
        </fieldset>

        <fieldset>
          <legend>Características</legend>
          <div class="label_group">
            <label>
                <span class="field">Qtd. Dormitórios:</span>
                <input class="radius" type="number" name="numberDorms"
                       value="<?= $realty->numberDorms ?? 0; ?>"/>
            </label>

            <label>
                <span class="field">Qtd. Suítes:</span>
                <input class="radius" type="number" name="numberSuites"
                       value="<?= $realty->numberSuites ?? 0; ?>"/>
            </label>
          </div>
          <div class="label_group">
            <label>
                <span class="field">Qtd. Banheiros:</span>
                <input class="radius" type="number" name="numberBathrooms"
                       value="<?= $realty->numberBathrooms ?? 0; ?>"/>
            </label>

            <label>
                <span class="field">Qtd. Salas:</span>
                <input class="radius" type="number" name="numberRoom"
                       value="<?= $realty->numberRoom ?? 0; ?>"/>
            </label>
          </div>
          <div class="label_group">
            <label>
                <span class="field">Capacidade de Carros na Garagem:</span>
                <input class="radius" type="number" name="carsCapacity"
                       value="<?= $realty->carsCapacity ?? 0; ?>"/>
            </label>

            <label>
                <span class="field">É mobiliado?</span>
                <select name="isFurnished">
                    <option value="">Selecione</option>
                    <option <?= $realty->isFurnished == 'S' ? 'selected' : ''  ?> value="S">Sim</option>
                    <option <?= $realty->isFurnished == 'N' ? 'selected' : ''  ?> value="N">Não</option>
                </select>
            </label>
          </div>
        </fieldset>
        <div class="al-center">
            <div class="app_formbox_actions">
                <button class="btn btn_inline radius transition icon-pencil-square-o">Salvar</button>
            </div>
        </div>
    </form>
</div>

<?php $v->start('scripts') ?>
  <script src="<?= theme("/assets/chosen.jquery.min.js", CONF_VIEW_APP); ?>"></script>
  <script type="text/javascript">
    $(".select_box").chosen({
        allow_single_deselect: true,
        no_results_text: "Oops, nada encontrado!",
        width: "100%",
        max_shown_results: 5,
        herdit_select_classes: true
      });
  </script>
<?php $v->stop() ?>
