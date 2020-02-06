<?php $v->layout("_theme"); ?>

<div class="app_formbox app_widget">
    <form class="app_form" action="<?= url("/imovel/salvar"); ?>" method="post">
        <!-- <input type="hidden" name="update" value="true"/> -->

        <div class="label_group">
            <label>
                <span class="field icon-user">Nome</span>
                <input class="radius" type="text" name="name" required/>
            </label>
        </div>

        <div class="al-center">
            <div class="app_formbox_actions">
                <button class="btn btn_inline radius transition icon-pencil-square-o">Salvar</button>
            </div>
        </div>
    </form>
</div>
