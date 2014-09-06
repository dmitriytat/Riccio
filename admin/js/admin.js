/**
 * Created by Дмитрий on 06.09.14.
 */

$(function () {
    'use strict';

    setEditable($('[r-editable = true]'));

    function setEditable(e) {
        e.on('click', function () {
            switch ($(this).attr('r-type')) {
                case 'string':
                    var Stool = $('<div class="tool"></div>');
                    var a = $('<input type="text" size="40">').val($(this).html());
                    Stool.append(a);
                    Stool.append('<button>Сохранить</button>');
                    $(this).html(Stool);
                    delEditable($(this));
                    break;
                case 'text':
                    var Ttool = $('<div class="tool"></div>');
                    var b = $('<textarea></textarea>').html($(this).html());
                    $(Ttool).append(b);
                    $(Ttool).append('<button>Сохранить</button>');
                    $(this).html(Ttool);
                    delEditable($(this));
                    break;
                default:
                    alert('Я таких значений не знаю');
            }
        });
    }

    function delEditable(e) {
        e.off('click');
        e.on('click', 'button', function () {
            var pa = $(this).parent().parent();
            var val = "";
            switch (pa.attr('r-type')) {
                case 'string':
                    val = pa.find('input').val();
                    break;
                case 'text':
                    val = pa.find('textarea').html();
                    break;
            }
            $.post(document.URL,
                {
                    edit: true,
                    id: $('[r-id]').attr('r-id'),
                    field: pa.attr('r-field'),
                    value: val
                }).done(function (data) {
                    pa.html(data);
                });
            setEditable(pa);
        });
    }
});