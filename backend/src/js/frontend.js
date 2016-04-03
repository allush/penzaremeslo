/**
 * Файл скриптов, приемяемых на фронте
 */
$(document).ready(function () {
    $(".fancybox").fancybox({
        loop: false,
        prevEffect: 'none',
        nextEffect: 'none',
        helpers: {
            title: {
                type: 'outside'
            },
            thumbs: {
                width: 80,
                height: 80
            }
        }
    });
});

function productPageLoaded(id, data) {
    $('html,body').scrollTo($('#content'), 100);
}

function productPushState() {

    var query = location.search.replace('?', '');
    var variables = query.split('&');
    var variablesNew = [];
    for (var i = 0; i < variables.length; i++) {
        var temp = variables[i].split('=');
        variablesNew[temp[0]] = temp[1];
        variablesNew.length++;
    }

    var catalogID = parseInt(variablesNew['c']);
    var sorting = parseInt($('#sorting').attr('value'));
    var userID = parseInt($('#userID').attr('value'));

    var url = '';
    if (!isNaN(catalogID)) {
        if (url.length == 0) {
            url += '?';
        } else {
            url += '&';
        }
        url += 'c=' + catalogID;
    }

    if (!isNaN(userID)) {
        if (url.length == 0) {
            url += '?';
        } else {
            url += '&';
        }
        url += 'userID=' + userID;
    }

    if (!isNaN(sorting)) {
        if (url.length == 0) {
            url += '?';
        } else {
            url += '&';
        }
        url += 'sorting=' + sorting;
    }

    history.replaceState(null, null, url);
}