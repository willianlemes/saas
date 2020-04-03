<?php $v->layout("_theme"); ?>

<div class="app_launch_header">

    <form class="app_launch_form_filter app_form" action="<?= url("/imoveis/filter"); ?>" method="post">

        <select name="finality">
            <option <?= (empty($filter->finality) || $filter->finality == "Todas" ? "selected" : ""); ?> value="Todas">Todas</option>
            <?php foreach ($finality as $value): ?>
                <option <?= (!empty($filter->finality) && $filter->finality == $value ? "selected" : ""); ?> value="<?= $value ?>" ><?= $value ?></option>
            <?php endforeach; ?>
        </select>

        <select name="kind">
            <option <?= (empty($filter->kind) || $filter->kind == "Todos" ? "selected" : ""); ?> value="Todos">Todas</option>
            <?php foreach ($kinds as $value): ?>
                <option <?= (!empty($filter->kind) && $filter->kind == $value ? "selected" : ""); ?> value="<?= $value ?>" ><?= $value ?></option>
            <?php endforeach; ?>
        </select>

        <button class="filter radius transition icon-filter icon-notext"></button>
    </form>
</div>



<div class="app_launch_header">
  <a class="app_launch_btn income radius transition icon-plus-circle" href="<?= url('/imoveis/cadastrar') ?>">
    Novo
  </a>
</div>

<section class="app_launch_box">
    <?php if (!$properties): ?>
        <?php if (empty($filter->status)): ?>
            <div class="message info icon-info">Ainda não existem imóveis cadastrados</div>
        <?php else: ?>
            <div class="message info icon-info">Não existem imóveis para o filtro aplicado.</div>
        <?php endif; ?>
    <?php else: ?>
        <div class="app_launch_item header">
            <p class="desc">Proprietário</p>
            <p class="desc">Finalidade</p>
            <p class="desc">Tipo</p>
        </div>
        <?php foreach ($properties as $property): ?>
            <article class="app_launch_item">
                <p class="desc app_invoice_link transition">
                    <a title="<?= $property->proprietary()->name; ?>"
                       href="<?= url("/imoveis/alterar/{$property->id}") ?>">
                       <?= $property->proprietary()->name; ?>
                     </a>
                </p>
                <p class="desc app_invoice_link transition">
                  <a title="<?= $property->finality; ?>"
                     href="<?= url("/imoveis/alterar/{$property->id}"); ?>">
                     <?= $property->finality ?>
                  </a>
                </p>
                <p class="desc app_invoice_link transition">
                  <a title="<?= $property->kind; ?>"
                     href="<?= url("/imoveis/alterar/{$property->id}"); ?>">
                     <?= $property->kind ?>
                  </a>
                </p>
            </article>
        <?php endforeach; ?>
        <?= $paginator; ?>
    <?php endif; ?>
</section>
