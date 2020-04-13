<?php $v->layout("_theme"); ?>

<?php $v->start('styles') ?>
  <link rel="stylesheet" href="<?= theme("/assets/chosen.min.css", CONF_VIEW_APP); ?>"/>
<?php $v->stop() ?>

<article class="app_widget">
    <header class="app_widget_title">
        <h2 class="icon-suitcase">Negócios</h2>
    </header>

    <nav class="menu">
      <ul>
        <li>
          <a class="icon-plus-circle radius transition" href="#"
             data-modalopen=".app_modal_income">Novo</a>
        </li>
      </ul>
    </nav>

    <section class="app_launch_box">
        <?php if (!$businessList): ?>
          <div class="message info icon-info">Ainda não existem imóveis cadastrados</div>
        <?php else: ?>
            <div class="app_launch_item header">
                <p class="desc">Cliente</p>
                <p class="desc">Imóvel</p>
                <p class="desc">Etapa</p>
            </div>
            <?php foreach ($businessList as $business): ?>
                <article class="app_launch_item">
                    <p class="desc app_invoice_link transition">
                        <a title="<?= $business->client()->name; ?>"
                           href="<?= url("/business/alterar/{$business->id}") ?>">
                           <?= $business->client()->name; ?>
                         </a>
                    </p>
                    <p class="desc app_invoice_link transition">
                      <a title="<?= $business->realty()->street; ?>"
                         href="<?= url("/business/alterar/{$business->id}"); ?>">
                         <?= $business->realty()->street ?>
                      </a>
                    </p>
                    <p class="desc app_invoice_link transition">
                      <a title="<?= $business->stage; ?>"
                         href="<?= url("/imoveis/alterar/{$business->id}"); ?>">
                         <?= $business->stage ?>
                      </a>
                    </p>
                </article>
            <?php endforeach; ?>
            <?= $paginator; ?>
        <?php endif; ?>
    </section>

</article>

<?php $v->start("scripts"); ?>
    <script src="<?= theme("/assets/chosen.jquery.min.js", CONF_VIEW_APP); ?>"></script>

    <script type="text/javascript">
       $(".select_box_customer").chosen({
          no_results_text: "Oops, nada encontrado!",
          width: "100%",
          max_shown_results: 5
        });
    </script>
<?php $v->end(); ?>
