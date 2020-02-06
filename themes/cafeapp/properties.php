<?php $v->layout("_theme"); ?>

<div class="app_launch_header">
    <div class="app_launch_btn income radius transition icon-plus-circle">
      Novo
    </div>
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
            <p class="desc">Id</p>
            <p class="date">Nome</p>
        </div>
        <?php foreach ($properties as $property): ?>
            <article class="app_launch_item">
                <p class="desc app_invoice_link transition">
                    <a title="<?= $property->id; ?>"
                       href=""><?= $property->id ?></a>
                </p>
                <p class="desc"><?= $property->name ?></p>
            </article>
        <?php endforeach; ?>
        <?= $paginator; ?>
    <?php endif; ?>
</section>
