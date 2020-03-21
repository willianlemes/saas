<?php $v->layout("_theme"); ?>

<div class="app_formbox app_widget">
    <form class="app_form" action="<?= url("/pessoas/salvar"); ?>" method="post">
        <input type="hidden" name="id" value="<?= $person->id ?? null ?>"/>

        <div class="app_formbox_photo">
            <div class="rounded j_profile_image thumb" style="background-image: url('<?= $photo ?? null; ?>')"></div>
            <div><input data-image=".j_profile_image" type="file" class="radius"  name="photo"/></div>
        </div>

        <div class="label_group">
          <label>
              <span class="field">Perfil:</span>
              <select name="profile">
                <?php foreach ($profiles as $key => $value): ?>
                    <option value="<?= $key ?>" <?= ($person ? ($person->perfil === $key ? "selected" : "") : "")  ?>>
                      <?= $value ?>
                    </option>
                <?php endforeach; ?>
              </select>
          </label>

          <label>
              <span class="field">Tipo:</span>
              <select class="types" name="type">
                <?php foreach ($types as $key => $value): ?>
                  <option value="<?= $key ?>" <?= ($person ? ($person->type === $key ? "selected" : "") : "")  ?>>
                    <?= $value ?>
                  </option>
                <?php endforeach; ?>
              </select>
          </label>
        </div>

        <div class="label_group">
            <label>
                <span id="name" class="field">Nome:</span>
                <input class="radius" type="text" name="name" required
                       value="<?= $person->name ?? null; ?>"/>
            </label>

            <label>
                <span id="nickname" class="field">Apelido:</span>
                <input class="radius" type="text" name="nickname" required
                       value="<?= $person->nickname ?? null; ?>"/>
            </label>
        </div>

        <div class="label_group">

          <label>
              <span class="field">Gênero:</span>
              <select id="genre" name="genre">
                  <option value="">Selecione</option>
                  <option <?= ($person ? ($person->genre == "male" ? "selected" : "") : ""); ?> value="male">&ofcir; Masculino</option>
                  <option <?= ($person ? ($person->genre == "female" ? "selected" : "") : ""); ?> value="female">&ofcir; Feminino</option>
                  <option <?= ($person ? ($person->genre == "other" ? "selected" : "") : ""); ?> value="other">&ofcir; Outro</option>
              </select>
          </label>

          <label>
              <span id="datebirth" class="field">Data de Nascimento:</span>
              <input class="radius mask-date" type="text" name="datebirth" placeholder="dd/mm/yyyy"
                     value="<?= (isset($person->datebirth) ? date_fmt($person->datebirth, "d/m/Y") : null); ?>"/>
          </label>
        </div>

        <div class="label_group">
          <label>
              <span id="rg" class="field">RG:</span>
              <input class="radius mask-rg" type="text" name="rg" placeholder="Apenas números"
                     value="<?= $person->rg ?? null; ?>"/>
          </label>

          <label>
              <span id="cpf" class="field">CPF:</span>
              <input class="radius mask-cpf" type="text" name="cpf"
                     value="<?= $person->cpf ?? null; ?>"/>
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
              <input class="radius mask-phone" type="text" name="phone" placeholder="Apenas números"
                     value="<?= $person->phone ?? null; ?>"/>
          </label>

          <label>
              <span class="field">Celular:</span>
              <input class="radius mask-cellphone" type="text" name="cellphone" placeholder="Apenas números"
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
                     value="<?= $person->street_number ?? null; ?>"/>
          </label>

        </div>

        <div class="label_group">
          <label>
              <span class="field">Bairro:</span>
              <input class="radius" type="text" name="neighborhood"
                     value="<?= $person->neighborhood ?? null; ?>"/>
          </label>
          <label>
              <span class="field">CEP:</span>
              <input class="radius mask-cep" type="text" name="cep"
                     value="<?= $person->cep ?? null; ?>"/>
          </label>
        </div>

        <div class="label_group">
          <label>
              <span class="field">Estado:</span>
              <select class="states" name="state"
                      data-url="<?= url("/storage/estados_cidades.json") ?>"
                      data-value="<?= $person->state ?? null; ?>">
              </select>
          </label>

          <label>
              <span class="field">Cidade:</span>
              <select class="cities" name="city"
                      data-value="<?= $person->city ?? null; ?>">
              </select>
          </label>
        </div>

        <div class="al-center">
            <div class="app_formbox_actions">
                <button class="btn btn_inline radius transition icon-pencil-square-o">Salvar</button>
            </div>
        </div>
    </form>
</div>
