<?php $v->layout("_theme"); ?>


<article class="app_widget">
    <header class="app_widget_title">
        <h2 class="icon-user-plus">Pessoas</h2>
    </header>

    <nav class="menu">
      <ul>
        <li><a class="icon-plus-circle radius transition" href="<?= url('/pessoas/cadastrar') ?>">Novo</a></li>
      </ul>
    </nav>

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
                <p class="desc">Perfil</p>
                <p class="desc">Tipo</p>
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
                    <p class="desc app_invoice_link transition">
                      <a title="<?= $person->getProfile(); ?>"
                         href="<?= url("/pessoas/alterar/{$person->id}"); ?>">
                         <?= $person->getProfile() ?>
                      </a>
                    </p>
                    <p class="desc app_invoice_link transition">
                      <a title="<?= $person->getType(); ?>"
                         href="<?= url("/pessoas/alterar/{$person->id}"); ?>">
                         <?= $person->getType() ?>
                      </a>
                    </p>
                </article>
            <?php endforeach; ?>
            <?= $paginator; ?>
        <?php endif; ?>
    </section>

</article>
