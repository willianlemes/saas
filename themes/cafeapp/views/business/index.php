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
          <a class="icon-plus-circle radius transition click_open_business_new_form">Novo</a>
        </li>
      </ul>
    </nav>

    <section class="app_launch_box">
        <?php if (!$businessList): ?>
          <div class="message info icon-info">Ainda não existem imóveis cadastrados</div>
        <?php else: ?>
            <div class="app_launch_item header">
                <p class="desc">Título</p>
                <p class="desc">Cliente</p>
                <p class="desc">Etapa</p>
            </div>
            <?php foreach ($businessList as $business): ?>
                <article class="app_launch_item">
                    <p class="desc app_invoice_link transition">
                        <a class="click_open_business_update_form" title="<?= $business->title; ?>"
                           data-url="<?= url('/negocios/alterar/' . $business->id) ?>">
                           <?= $business->title; ?>
                         </a>
                    </p>
                    <p class="desc app_invoice_link transition">
                        <a class="click_open_business_update_form" title="<?= $business->client()->name; ?>"
                           data-url="<?= url('/negocios/alterar/' . $business->id) ?>">
                           <?= $business->client()->name; ?>
                         </a>
                    </p>
                    <p class="desc app_invoice_link transition">
                      <a class="click_open_business_update_form" title="<?= $business->status(); ?>"
                        data-url="<?= url('/negocios/alterar/' . $business->id) ?>">
                         <?= $business->status() ?>
                      </a>
                    </p>
                </article>
            <?php endforeach; ?>
            <?= $paginator; ?>
        <?php endif; ?>
    </section>

</article>

<?php $v->start("modal"); ?>
  <?= $v->insert("views/business/registration_form_modal"); ?>
<?php $v->end(); ?>

<?php $v->start("scripts"); ?>
    <script src="<?= theme("/assets/chosen.jquery.min.js", CONF_VIEW_APP); ?>"></script>

    <script type="text/javascript">
      $(".select_chosen").chosen({
         no_results_text: "Oops, nada encontrado!",
         width: "100%",
         max_shown_results: 5
       });
    </script>
<?php $v->end(); ?>
