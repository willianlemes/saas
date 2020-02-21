<?php $v->layout("_theme"); ?>

<div class="app_formbox app_widget">
    <form class="app_form" action="<?= url("/app/profile"); ?>" method="post">
        <input type="hidden" name="id" value="true"/>
        <div class="label_group">
            <label>
                <span class="field">Proprietário:</span>
                <input class="radius" type="text" name="name" required
                       value="<?= $person->name ?? null; ?>"/>
            </label>
        </div>

        <div class="label_group">

          <label>
              <span class="field">Gênero:</span>
              <select name="genre" required>
                  <option value="">Selecione</option>
                  <option <?= ($person->genre == "male" ? "selected" : ""); ?> value="male">&ofcir; Masculino</option>
                  <option <?= ($person->genre == "female" ? "selected" : ""); ?> value="female">&ofcir; Feminino</option>
                  <option <?= ($person->genre == "other" ? "selected" : ""); ?> value="other">&ofcir; Outro</option>
              </select>
          </label>

          <label>
              <span class="field">Data de Nascimento:</span>
              <input class="radius mask-date" type="text" name="datebirth" placeholder="dd/mm/yyyy" required
                     value="<?= (isset($person->datebirth) ? date_fmt($person->datebirth, "d/m/Y") : null); ?>"/>
          </label>
        </div>

        <div class="label_group">
          <label>
              <span class="field">RG:</span>
              <input class="radius mask-doc" type="text" name="rg" placeholder="Apenas números" required
                     value="<?= $person->rg ?? null; ?>"/>
          </label>

          <label>
              <span class="field">CPF:</span>
              <input class="radius mask-doc" type="text" name="cpf" placeholder="Apenas números" required
                     value="<?= $user->cpf ?? null; ?>"/>
          </label>
        </div>

        <div class="label_group">
          <label>
              <span class="field">Profissão:</span>
              <input class="radius" type="text" name="occupation"
                     value="<?= $person->occupation ?? null; ?>"/>
          </label>

          <label>
              <span class="field">E-mail:</span>
              <input class="radius" type="email" name="email"
                     value="<?= $person->email ?? null; ?>"/>
          </label>
        </div>

        <div class="label_group">
          <label>
              <span class="field">Telefone:</span>
              <input class="radius" type="text" name="phone"
                     value="<?= $person->phone ?? null; ?>"/>
          </label>

          <label>
              <span class="field">Celular:</span>
              <input class="radius" type="text" name="cellphone"
                     value="<?= $person->cellphone ?? null; ?>"/>
          </label>
        </div>

        <div class="label_group">
          <label>
              <span class="field">Logradouro:</span>
              <input class="radius" type="text" name="street"
                     value="<?= $person->street ?? null; ?>"/>
          </label>

          <label>
              <span class="field">Número:</span>
              <input class="radius" type="text" name="street_number"
                     value="<?= $person->cellphone ?? null; ?>"/>
          </label>

        </div>

        <div class="label_group">
          <label>
              <span class="field">Bairro:</span>
              <input class="radius" type="text" name="neighborhood"
                     value="<?= $person->neighborhood ?? null; ?>"/>
          </label>
        </div>

        <div class="label_group">
          <label>
              <span class="field">Estado:</span>
              <select name="genre" required>
                  <option value="">Selecione</option>
                  <?php foreach ($states as $key => $value): ?>
                    <option <?= ($person->state == $key ? "selected" : ""); ?> value="<?= $key ?>"><?= $value ?></option>
                  <?php endforeach; ?>
              </select>
          </label>

          <label>
              <span class="field">Cidade:</span>
              <input class="radius" type="text" name="city"
                     value="<?= $person->city ?? null; ?>"/>
          </label>
        </div>

        <div class="al-center">
            <div class="app_formbox_actions">
                <button class="btn btn_inline radius transition icon-pencil-square-o">Salvar</button>
            </div>
        </div>
    </form>
</div>
