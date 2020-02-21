<?php $v->layout("_theme"); ?>

<div class="app_launch_header">
  <a class="app_launch_btn income radius transition icon-plus-circle" href="<?= url('/pessoas/cadastrar') ?>">
    Novo
  </a>
</div>

<section class="app_launch_box">
    <?php if (!$people): ?>
      <div class="message info icon-info">Ainda não existem imóveis cadastrados</div>
    <?php else: ?>

      <table class="table">
        <tr>
          <th>Nome</th>
          <th>Apelido</th>
          <th>Estado</th>
          <th>Cidade</th>
        </tr>
        <?php foreach ($people as $person): ?>
          <tr class="row"
              data-href="<?= url("pessoas/alterar/{$person->id}") ?>">
            <td><?= $person->name ?></td>
            <td><?= $person->nickname ?></td>
            <td><?= $person->state ?></td>
            <td><?= $person->city ?></td>
          </tr>
        <?php endforeach; ?>
      </table>

        <?= $paginator; ?>
    <?php endif; ?>
</section>
