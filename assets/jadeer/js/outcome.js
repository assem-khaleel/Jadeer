
function find_plo(element, property_id, property_label, find_label, id) {

    var url = (config.index_page==''?'':'/')+config.index_page+'/curriculum_mapping/program/find_plo?';

    id = id || 0;
    find_label = find_label || 'Find Program Learning Outcome';

    $('.find_learning_outcome').remove();

    var width = ($(element).width() + 26) + 'px';
    var position = $(element).position();

    $(element).after('<div id="wrapper_' + property_id + '" class="find_learning_outcome" style="position: relative; z-index: 10; width: '+ width +'; left: ' + position.left + '; margin-top: 5px;">' +
        '<div class="panel panel-default">' +
        '<div class="panel-heading">' +
        '<button style="margin-top: -3px;" type="button" class="close" aria-label="Close" onclick="$(\'#wrapper_' + property_id + '\').remove();"><span aria-hidden="true">&times;</span></button>' +
        '<h3 class="panel-title">'+ find_label +'</h3>' +
        '</div>' +
        '<div class="panel-body">' +
        '<iframe style="border: none;" src="' + url + 'id=' + id + '&property_id='+property_id+'&property_label='+property_label+'" width="100%" height="400" ></iframe>' +
        '</div>' +
        '</div>' +
        '</div>');
}

function find_clo(element, property_id, property_label, find_label, id) {

    var url = (config.index_page==''?'':'/')+config.index_page+'/curriculum_mapping/course/find_clo?';

    id = id || 0;
    find_label = find_label || 'Find Course Learning Outcome';

    $('.find_learning_outcome').remove();

    var width = ($(element).width() + 26) + 'px';
    var position = $(element).position();

    $(element).after('<div id="wrapper_' + property_id + '" class="find_learning_outcome" style="position: relative; z-index: 10; width: '+ width +'; left: ' + position.left + '; margin-top: 5px;">' +
        '<div class="panel panel-default">' +
        '<div class="panel-heading">' +
        '<button style="margin-top: -3px;" type="button" class="close" aria-label="Close" onclick="$(\'#wrapper_' + property_id + '\').remove();"><span aria-hidden="true">&times;</span></button>' +
        '<h3 class="panel-title">'+ find_label +'</h3>' +
        '</div>' +
        '<div class="panel-body">' +
        '<iframe style="border: none;" src="' + url + 'id=' + id + '&property_id='+property_id+'&property_label='+property_label+'" width="100%" height="400" ></iframe>' +
        '</div>' +
        '</div>' +
        '</div>');
}
