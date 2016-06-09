(function ($) {
    'use strict';

    $(function () {

        var $form_select = $('#stcath_event_signup_form'),
            $form_fields_container = $('#stcath_event_signup_form_fields');

        if (!$form_select.length || !$form_fields_container.length) {
            return;
        }

        $form_select.change(function () {

            var form_ID = $(this).val(),
                $checkbox_template = $form_fields_container.find('.stcath_event_signup_form_fields_field.dummy').clone();

            if (form_ID == '0') {
                $form_fields_container.find('.stcath_event_signup_form_fields_field:not(.dummy)').remove();
                return;
            }

            $form_fields_container.find('.stcath_event_signup_form_fields_field:not(.dummy)').remove();
            $form_fields_container.append('<span class="spinner is-active" style="float: none;"></span>');

            $.post(
                ajaxurl,
                {
                    action: 'stcath_get_form_fields',
                    form_id: form_ID
                },
                function (response) {

                    var fields;

                    if (response['success']) {

                        if (!(fields = response['data']['fields'])) {

                            alert('Cannot get fields');
                        } else {

                            $.each(fields, function (id, label) {

                                var $checkbox = $checkbox_template.clone();

                                $checkbox.find('label')
                                    .attr('for', 'stcath_event_signup_form_fields_' + id)
                                    .text(label);

                                $checkbox.find('input[type="checkbox"]')
                                    .attr('id', 'stcath_event_signup_form_fields_' + id)
                                    .attr('value', id)
                                    .prop('checked', false);

                                $checkbox.removeClass('dummy').show();

                                $form_fields_container.append($checkbox);
                            });
                        }

                        $form_fields_container.find('.spinner').remove();

                    } else {

                        alert(response['data']['error']);
                        $form_fields_container.find('.spinner').remove();
                    }
                }
            )
        });
    });
})(jQuery);