$(function () {

  $('input[type=number]').change(function(){
    if ($(this).val()<0) {
      $(this).val(0);
    }
  }).prop('min',0);

  $(".types").change(function(){
    var maskCpfCnpj = '';
    var maskRgIe = '';
    if ($(this).val()==="F") {
      $("#name").text("Nome");
      $("#nickname").text("Apelido");
      $("#datebirth").text("Data de Nascimento");
      $("#label-rg").text("RG");
      $("#label-cpf").text("CPF");
      $("#label-genre").show();
      $("#genre").show();
      maskCpfCnpj = '000.000.000-00';
      $("#rgIe").mask('00.000.000-0', {reverse: true, placeholder: '00.000.000-0'});
    }else {
      $("#name").text("Razão Social");
      $("#nickname").text("Nome Fantasia");
      $("#datebirth").text("Data de Fundação da Empresa");
      $("#label-rg").text("IE");
      $("#label-cpf").text("CNPJ");
      $("#label-genre").hide();
      $("#genre").val("").hide();
      maskCpfCnpj = '00.000.000/0000-00';
      $('#rgIe').unmask();
    }
    $(".mask-cpf-cnpj").mask(maskCpfCnpj, {reverse: true, placeholder: maskCpfCnpj});
  });

  var url = $(".states").data("url");
  var stateValue = $(".states").data("value");

  $.getJSON(url, function( data ) {

    var options = '<option value="">Selecione</option>';

    $.each(data, function (key,val) {
      options += '<option value="' + val.sigla + '" '
                  + (val.sigla == stateValue ? 'selected' : '') +
                  '>' + val.nome + '</option>';
    });

    $(".states").html(options);

    $(".states").change(function() {

      var options_cidades = '';
      var state = "";
      var cityValue = $(".cities").data("value");

      $(".states option:selected").each(function () {
        state = $(this).val();
      });

      if (state==="") {
        $('.cities').prop('disabled', 'disabled');
        options_cidades = '<option value="">Selecione um estado</option>';
      }else {
        $('.cities').prop('disabled', false);
        options_cidades = '<option value="">Selecione</option>';
      }

      $.each(data, function (key, val) {
        if(val.sigla == state) {
          $.each(val.cidades, function (key_city, val_city) {
            options_cidades += '<option value="' + val_city + '"'
            + (val_city == cityValue ? 'selected' : '') +
            '>' + val_city + '</option>';
          });
        }
      });

      $(".cities").html(options_cidades);

       }).change();
    });

    $.fn.clear = function(){
      const TAGSNAME = ['INPUT', 'TEXTAREA'];
      if (TAGSNAME.indexOf($(this).prop('tagName')) >= 0) {
        $(this).val(null);
      }
    };

    var effecttime = 200;

    /*
     * MOBILE MENU
     */
    $("[data-mobilemenu]").click(function (e) {
        var clicked = $(this);
        var action = clicked.data("mobilemenu");

        if (action === 'open') {
            $(".app_sidebar").slideDown(effecttime);
        }

        if (action === 'close') {
            $(".app_sidebar").slideUp(effecttime);
        }
    });

    /*
     * APP MODAL
     */

     function loadBusinessForm(business){
       $('.app_modal_business input[name=id]').val(business.id);
       $('.app_modal_business select[name=client] option[selected]').removeAttr('selected');
       $('.app_modal_business select[name=client] option[value=' + business.client +  ']').attr('selected',true);
       $('.app_modal_business input[name=title]').val(business.title);
       $('.app_modal_business select[name=realty] option[selected]').removeAttr('selected');
       $('.app_modal_business select[name=realty] option[value=' + business.realty +  ']').attr('selected',true);
       $('.select_chosen').trigger('chosen:updated');
       $('.app_modal_business select[name=status] option[selected]').removeAttr('selected');
       $('.app_modal_business select[name=status] option[value=' + business.status + ']').attr('selected',true);
       $('.app_modal_business input[name=expected_closure]').val(business.expected_closure);
       $('.app_modal_business textarea[name=annotations]').val(business.annotations);
     };

     function clearBusinessForm(){
       $('.app_modal_business input[name=id]').clear();
       $('.app_modal_business select[name=client] option[selected]').removeAttr('selected');
       $(".app_modal_business select[name=client] option[value='']").attr("selected", "selected");
       $('.app_modal_business input[name=title]').clear();
       $('.app_modal_business select[name=realty] option[selected]').removeAttr('selected');
       $(".app_modal_business select[name=realty] option[value='']").attr("selected", "selected");
       $('.select_chosen').trigger('chosen:updated');
       $('.app_modal_business select[name=status] option[selected]').removeAttr('selected');
       $(".app_modal_business select[name=status] option[value='']").attr("selected", "selected");
       $('.app_modal_business input[name=expected_closure]').clear();
       $('.app_modal_business textarea[name=annotations]').clear();
     };

    $(".click_open_business_new_form").click(function (event) {
      var load = $(".ajax_load");
      load.fadeIn(200).css("display", "flex");
      clearBusinessForm();
      $('#title_business').text("Novo Negócio");
      $('.btn_remove').hide();
      $('#btn_save_business').show();
      $('#btn_update_business').hide();
      $(".app_modal").fadeIn(effecttime).css("display", "flex");
      $('.app_modal_business').fadeIn(effecttime);
      load.fadeOut(200);
    });

    $(".click_open_business_update_form").click(function (event) {
      var load = $(".ajax_load");

      $.ajax({
           url: $(this).data('url'),
           type: 'GET',
           dataType: 'json',
           beforeSend: function () {
               load.fadeIn(200).css("display", "flex");
           },
           success: function(business) {
             loadBusinessForm(business);
             $('#title_business').text("Alterar Negócio");
             $('.btn_remove').show();
             $('#btn_save_business').hide();
             $('#btn_update_business').show();
             $(".app_modal").fadeIn(effecttime).css("display", "flex");
             $('.app_modal_business').fadeIn(effecttime);
             load.fadeOut(200);
           }
       });

    });

    $(".click_back_business_form").click(function (e) {
        if (e.target === this) {
            $(".app_modal").fadeOut(effecttime);
            $(".app_modal").children().fadeOut(effecttime);
        }
    });

    /*
     * FROM CHECKBOX
     */
    $("[data-checkbox]").click(function (e) {
        var checkbox = $(this);
        checkbox.parent().find("label").removeClass("check");
        if (checkbox.find("input").is(':checked')) {
            checkbox.addClass("check");
        } else {
            checkbox.removeClass("check");
        }
    });

    /*
     * FADE
     */
    $("[data-fadeout]").click(function (e) {
        var clicked = $(this);
        var fadeout = clicked.data("fadeout");
        $(fadeout).fadeOut(effecttime, function (e) {
            if (clicked.data("fadein")) {
                $(clicked.data("fadein")).fadeIn(effecttime);
            }
        });
    });

    $("[data-fadein]").click(function (e) {
        var clicked = $(this);
        var fadein = clicked.data("fadein");
        $(fadein).fadeIn(effecttime, function (e) {
            if (clicked.data("fadeout")) {
                $(clicked.data("fadeout")).fadeOut(effecttime);
            }
        });
    });

    /*
     * SLIDE
     */
    $("[data-slidedown]").click(function (e) {
        var clicked = $(this);
        var slidedown = clicked.data("slidedown");
        $(slidedown).slideDown(effecttime);
    });

    $("[data-slideup]").click(function (e) {
        var clicked = $(this);
        var slideup = clicked.data("slideup");
        $(slideup).slideUp(effecttime);
    });

    /*
     * TOOGLE CLASS
     */
    $("[data-toggleclass]").click(function (e) {
        var clicked = $(this);
        var toggle = clicked.data("toggleclass");
        clicked.toggleClass(toggle);
    });

    /*
     * jQuery MASK
     */
    $(".mask-money").mask('000.000.000.000.000,00', {reverse: true, placeholder: "0,00"});
    $(".mask-date").mask('00/00/0000', {reverse: true, placeholder: "__/__/____"});
    $(".mask-month").mask('00/0000', {reverse: true});
    $(".mask-doc").mask('000.000.000-00', {reverse: true});
    $(".mask-cep").mask('00000-000', {reverse: true, placeholder: "00000-000"});
    $(".mask-cpf").mask('000.000.000-00', {reverse: true, placeholder: "000.000.000-00"});
    $(".mask-cnpj").mask('00.000.000/0000-00', {reverse: true, placeholder: "00.000.000/0000-00"});
    $(".mask-rg").mask('00.000.000-0', {reverse: true, placeholder: "00.000.000-0"});
    $(".mask-phone").mask('(00) 0000-0000', {reverse: false, placeholder: "(00) 0000-0000"});
    $(".mask-cellphone").mask('(00) 00000-0000', {reverse: false, placeholder: "(00) 00000-0000"});

    /*
     * AJAX FORM
     */
    $("form:not('.ajax_off')").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var load = $(".ajax_load");
        var flashClass = "ajax_response";
        var flash = $("." + flashClass);

        form.ajaxSubmit({
            url: form.attr("action"),
            type: "POST",
            dataType: "json",
            beforeSend: function () {
                load.fadeIn(200).css("display", "flex");
            },
            uploadProgress: function (event, position, total, completed) {
                var loaded = completed;
                var load_title = $(".ajax_load_box_title");
                load_title.text("Enviando (" + loaded + "%)");

                form.find("input[type='file']").val(null);
                if (completed >= 100) {
                    load_title.text("Aguarde, carregando...");
                }
            },
            success: function (response) {
                //redirect
                if (response.redirect) {
                    window.location.href = response.redirect;
                } else {
                    load.fadeOut(200);
                }

                //reload
                if (response.reload) {
                    window.location.reload();
                } else {
                    load.fadeOut(200);
                }

                //message
                if (response.message) {
                    if (flash.length) {
                        flash.html(response.message).fadeIn(100).effect("bounce", 300);
                    } else {
                        form.prepend("<div class='" + flashClass + "'>" + response.message + "</div>")
                            .find("." + flashClass).effect("bounce", 300);
                    }
                } else {
                    flash.fadeOut(100);
                }
            },
            complete: function () {
                if (form.data("reset") === true) {
                    form.trigger("reset");
                }
            },
            error: function (event, jqxhr, ajaxOptions, errorThrown) {
                var message = jqxhr.status;
                // var message = "<div class='message error icon-warning'>Desculpe mas não foi possível processar a requisição. Favor tente novamente!</div>";
                if (flash.length) {
                    flash.html(message).fadeIn(100).effect("bounce", 300);
                } else {
                    form.prepend("<div class='" + flashClass + "'>" + message + "</div>")
                        .find("." + flashClass).effect("bounce", 300);
                }
            }
        });
    });

    $(document).ajaxError(function( event, jqxhr, settings, thrownError ) {
            var contentType   = jqxhr.getResponseHeader("Content-Type");
            // var responseBody  = jqXHR.responseText;

            // console.log(jqxhr);

            //do something depending on response headers and response body.
    });

    /*
     * APP ON PAID
     */
    $("[data-onpaid]").click(function (e) {
        var clicked = $(this);
        var dataset = clicked.data();

        $.post(clicked.data("onpaid"), dataset, function (response) {
            //reload by error
            if (response.reload) {
                window.location.reload();
            }

            //Balance
            $(".j_total_paid").text("R$ " + response.onpaid.paid);
            $(".j_total_unpaid").text("R$ " + response.onpaid.unpaid);
        }, "json");
    });


    $("[data-image]").change(function (e) {
        var changed = $(this);
        var file = this;

        if (file.files && file.files[0]) {
            var render = new FileReader();

            render.onload = function (e) {
                $(changed.data("image")).fadeTo(100, 0.1, function () {
                    $(this).css("background-image", "url('" + e.target.result + "')")
                        .fadeTo(100, 1);
                });
            };

            render.readAsDataURL(file.files[0]);
        }
    });


    /*
     * APP BUSINESS DELETE
     */
    $("[data-businessdelete]").click(function (e) {
        var remove = confirm("ATENÇÃO: Essa ação não pode ser desfeita! Tem certeza que deseja excluir o lançamento do negócio?");

        if (remove === true) {
            $.post($(this).data("businessdelete") + $('.app_modal_business input[name=id]').val(), function (response) {
                if (response.reload) {
                    window.location.reload();
                }
            }, "json");
        }
    })
});
