<?php $v->layout("_theme"); ?>

<div class="app_launch_header">
  <a class="app_launch_btn income radius transition icon-plus-circle" href="<?= url('/pessoas/cadastrar') ?>">
    Novo
  </a>
</div>


<section class="app_launch_box">
    <?php if (!$people): ?>
        <?php if (empty($filter->status)): ?>
            <div class="message info icon-info">Ainda não existem pessoas cadastradas</div>
        <?php else: ?>
            <div class="message info icon-info">Não existem pessoas para o filtro aplicado.</div>
        <?php endif; ?>
    <?php else: ?>
        <div class="app_launch_item header">
            <p class="desc">Nome / Razão Social</p>
            <p class="desc">Apelido / Nome Fantasia</p>
        </div>
        <?php foreach ($people as $person): ?>
            <article class="app_launch_item">
                <p class="desc app_invoice_link transition">
                    <a title="<?= $person->name; ?>"
                       href="<?= url("/pessoas/alterar/{$person->id}") ?>">
                       <?= $person->name; ?>
                     </a>
                </p>
                <p class="desc app_invoice_link transition">
                  <a title="<?= $person->nickname; ?>"
                     href="<?= url("/pessoas/alterar/{$person->id}"); ?>">
                     <?= $person->nickname ?>
                  </a>
                </p>
            </article>
        <?php endforeach; ?>
        <?= $paginator; ?>
    <?php endif; ?>
</section>
