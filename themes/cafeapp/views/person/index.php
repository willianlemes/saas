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
        <div class="app_launch_item header">
            <p class="desc">Nome</p>
            <p class="date">Apelido</p>
        </div>
        <?php foreach ($people as $person): ?>
            <article class="app_launch_item">
                <p class="desc app_invoice_link transition">
                  <a title="<?= $person->name; ?>"
                     href="<?= url("/pessoas/alterar/{$person->id}"); ?>">
                     <?= str_limit_words($person->name, 3, "&nbsp;<span class='icon-info icon-notext'></span>") ?>
                  </a>
                </p>
                <p class="desc app_invoice_link transition">
                  <a title="<?= $person->nickname; ?>"
                     href="<?= url("/pessoas/alterar/{$person->id}"); ?>">
                     <?= str_limit_words($person->nickname, 3, "&nbsp;<span class='icon-info icon-notext'></span>") ?>
                  </a>
                </p>
            </article>
        <?php endforeach; ?>
        <?= $paginator; ?>
    <?php endif; ?>
</section>
