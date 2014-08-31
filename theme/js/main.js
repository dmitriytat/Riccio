/**
 * Created with JetBrains WebStorm.
 * User: Дмитрий
 * Date: 26.08.14
 * Time: 14:12
 * To change this template use File | Settings | File Templates.
 */


$(function () {
    'use strict';
    $('#mid').css('top',($('body').height()-$('#mid').height())/2.3);
    $('.cm').on('click', function(){
        window.location.href = "/content/0.html";
    });
});