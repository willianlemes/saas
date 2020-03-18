<?php $v->layout("_theme"); ?>

<div class="app_formbox app_widget">
    <form class="app_form" action="<?= url("/app/profile"); ?>" method="post">
      <fieldset>
        <legend>Sobre o Imóvel</legend>
          <!-- <label> -->
            <span class="field">Proprietário:</span>
            <div class="tagsinput">
              <div id="addTag" >
                <input type="hidden" name="property" value=""/>
                <input class="tag-input radius autocomplete"
                       type="text"
                       data-url-search="<?= url('/imoveis/proprietarios') ?>"
                       value="">
              </div>
            </div>
         <!-- </label> -->

        <div class="label_group">
          <label>
              <span class="field">Finalidade:</span>
              <select name="finality" required>
                  <option value="">Selecione</option>
                  <?php foreach ($finality as $key => $value): ?>
                    <option value="<?= $key ?>"><?= $value ?></option>
                  <?php endforeach; ?>
              </select>
          </label>
        </div>

        <div class="label_group">
          <label>
              <span class="field">Tipo:</span>
              <select name="type" required>
                  <option value="">Selecione</option>
                  <?php foreach ($types as $key => $value): ?>
                    <option value="<?= $key ?>"><?= $value ?></option>
                  <?php endforeach; ?>
              </select>
          </label>
          <label>
              <span class="field">Preço de Venda:</span>
              <input class="radius mask-money" type="text" name="value" required/>
          </label>
        </div>

      </fieldset>
        <fieldset>
          <legend>Localização</legend>
          <div class="label_group">
            <label>
                <span class="field">Logradouro:</span>
                <input class="radius" type="text" name="occupation"
                       value="<?= $person->occupation ?? null; ?>"/>
            </label>

            <label>
                <span class="field">Número:</span>
                <input class="radius" type="email" name="email"
                       value="<?= $person->email ?? null; ?>"/>
            </label>
          </div>
          <div class="label_group">
            <label>
                <span class="field">Bairro:</span>
                <input class="radius" type="text" name="occupation"
                       value="<?= $person->occupation ?? null; ?>"/>
            </label>

            <label>
                <span class="field">CEP:</span>
                <input class="radius" type="email" name="email"
                       value="<?= $person->email ?? null; ?>"/>
            </label>
          </div>
          <div class="label_group">
            <label>
                <span class="field">Estado:</span>
                <input class="radius" type="text" name="occupation"
                       value="<?= $person->occupation ?? null; ?>"/>
            </label>

            <label>
                <span class="field">Cidade:</span>
                <input class="radius" type="email" name="email"
                       value="<?= $person->email ?? null; ?>"/>
            </label>
          </div>
          <div class="label_group">
            <label>
                <span class="field">Complemento:</span>
                <input class="radius" type="text" name="occupation"
                       value="<?= $person->occupation ?? null; ?>"/>
            </label>
          </div>

        </fieldset>

        <fieldset>
          <legend>Área</legend>
          <div class="label_group">
            <label>
                <span class="field">Unidade de Medida:</span>
                <select name="type" required>
                    <option value="">Selecione</option>
                    <option value="">Alqueire</option>
                    <option value="">Metro 2</option>
                    <option value="">Hectare</option>
                    <option value="">Km</option>
                    <option value="">Metro</option>
                </select>
            </label>
          </div>
          <div class="label_group">
            <label>
                <span class="field">Frente:</span>
                <input class="radius" type="number" name="phone"
                       value="<?= $person->phone ?? null; ?>"/>
            </label>

            <label>
                <span class="field">Fundo:</span>
                <input class="radius" type="number" name="cellphone"
                       value="<?= $person->cellphone ?? null; ?>"/>
            </label>
          </div>
          <div class="label_group">
            <label>
                <span class="field">Lateral Direita:</span>
                <input class="radius" type="number" name="phone"
                       value="<?= $person->phone ?? null; ?>"/>
            </label>

            <label>
                <span class="field">Lateral Esquerda:</span>
                <input class="radius" type="number" name="cellphone"
                       value="<?= $person->cellphone ?? null; ?>"/>
            </label>
          </div>
        </fieldset>

        <fieldset>
          <legend>Características</legend>
          <div class="label_group">
            <label>
                <span class="field">Qtd. Dormitórios:</span>
                <input class="radius" type="number" name="phone"
                       value="<?= $person->phone ?? null; ?>"/>
            </label>

            <label>
                <span class="field">Qtd. Suítes:</span>
                <input class="radius" type="number" name="cellphone"
                       value="<?= $person->cellphone ?? null; ?>"/>
            </label>
          </div>
          <div class="label_group">
            <label>
                <span class="field">Qtd. Banheiros:</span>
                <input class="radius" type="number" name="phone"
                       value="<?= $person->phone ?? null; ?>"/>
            </label>

            <label>
                <span class="field">Qtd. Salas:</span>
                <input class="radius" type="number" name="cellphone"
                       value="<?= $person->cellphone ?? null; ?>"/>
            </label>
          </div>
          <div class="label_group">
            <label>
                <span class="field">Capacidade de Carros na Garagem:</span>
                <input class="radius" type="number" name="phone"
                       value="<?= $person->phone ?? null; ?>"/>
            </label>

            <label>
                <span class="field">É mobiliado?</span>
                <select name="type" required>
                    <option value="">Selecione</option>
                    <option value="">Sim</option>
                    <option value="">Não</option>
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
