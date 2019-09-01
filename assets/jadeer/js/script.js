$(document).ready(function () {
    init_data_toggle();
});

function init_data_toggle() {
    $('[data-toggle="ajaxModal"]').unbind().click(function (event) {
        ajaxModal(this, event);
    });
    $('[data-toggle="ajaxRequest"]').unbind().click(function (event) {
        ajaxRequest(this, event);
    });
    $('[data-toggle="ajaxSubmit"]').unbind().submit(function(event){
        ajaxSubmit(this, event);
    });
    $('[data-toggle="confirmAction"]').unbind().click(function (event) {
        confirmAction(this, event);
    });
    $('[data-toggle="deleteAction"]').unbind().click(function (event) {
        deleteAction(this, event);
    });
    $('[data-toggle="deleteRedirectAction"]').unbind().click(function (event) {
        deleteRedirectAction(this, event);
    });
    $('[data-toggle="ajaxDelete"]').unbind().submit(function(event){
        ajaxDelete(this, event);
    });
    $('[data-loading-text]').on('click', function (event) {
        $(this).button('loading');
    });
}

function ajaxRequest(element, event) {
    event.preventDefault();

    var data = $(element).data();

    if(data.scroll !== false) {
        data.scroll = true;
    }

    $('#'+$(element).attr('data-target')).html('<div class="progress progress-striped active no-margin" >' +
        '<div class="progress-bar" style="width: 100%;"><i class="fa fa-spinner fa-spin"></i> Loading</div>' +
        '</div>');

    $.ajax({
        type: "POST",
        url: $(element).attr('href')
    }).done(function (msg) {
        var $_target = $('#'+$(element).attr('data-target'));

        $_target.html(msg);
        init_data_toggle();

        if(data.scroll) {
            $('html, body').stop().animate({
                'scrollTop': $_target.offset().top
            }, 500, 'swing');
        }

        if ($(element).attr('data-add-class') === "true") {
            $($(element).attr('data-ref')).removeClass('active');
            $(element).parent().addClass('active');
        }
    }).fail(function () {
        window.location.reload();
    });
}

function ajaxModal(element, event) {
    event.preventDefault();

    if (typeof(tinymce) !== "undefined") {
        tinymce.remove("textarea");
    }

    $('#ajaxModal').remove();

    $('body').append('<div class="modal fade" id="ajaxModal" tabindex="-1" data-backdrop="static" aria-hidden="true">' +
        ' <div id="ajaxModalDialog">' +
        '  <div class="modal-dialog">' +
        '   <div class="modal-content">' +
        '    <div class="modal-body">' +
        '     <div class="progress">' +
        '      <div class="progress-bar progress-bar-striped active" style="width: 100%; height: 21px;"><i class="fa fa-spinner fa-spin"></i> Loading</div>' +
        '     </div>' +
        '    </div>' +
        '   </div>' +
        '  </div>' +
        ' </div>' +
        '</div>');

    $('#ajaxModalDialog').load($(element).attr('href'), function() {
        init_data_toggle();
    });

    $('#ajaxModal').modal('show');

    $('#ajaxModal').on('shown.bs.modal', function () {
        resetModalBackdropHeight();
        $('#ajaxModalDialog').bind('DOMNodeInserted DOMNodeRemoved', resetModalBackdropHeight);
        afterModal();
    });

    var confirm_flag = false;

    $('#ajaxModal').on('hide.bs.modal', function () {

        var $_modal = $(this).find('.modal-dialog').first();

        var flag = $_modal.attr('confirm');
        var message = $_modal.attr('message') ? $_modal.attr('message') : "Are you sure?" ;

        if (typeof flag !== typeof undefined && flag !== false && confirm_flag === false) {

            bootbox.confirm({
                message: message,
                backdrop: false,
                callback: function (result) {
                    if (result) {
                        confirm_flag = true;
                        $('#ajaxModal').modal('hide');
                    }
                },
                className: "bootbox-sm"
            });

            $('.bootbox.modal').on('hidden.bs.modal', function () {
                if ($('#ajaxModalDialog').length) {
                    $('body').addClass('modal-open');
                }
            });

            return false;
        }
    });

    $('#ajaxModal').on('hidden.bs.modal', function () {
        if (typeof(tinymce) !== "undefined") {
            tinymce.remove("textarea");
        }
        $('#ajaxModal').remove();
    });
}

function afterModal()
{
    return true;
}

function resetModalBackdropHeight() {
    var $_modal     = $('.modal-dialog');
    var $_backdrop  = $('.modal-backdrop');
    var el_height  = $_modal.innerHeight();

    $_backdrop.css({
        height: el_height + 60,
        minHeight: '100%'
    });
}

function deleteRedirectAction(element, event) {
    event.preventDefault();

    var message = $(element).attr('message') ? $(element).attr('message') : "Are you sure?" ;

    bootbox.confirm({
        message: message,
        callback: function (result) {
            if (result) {
                var $href = $(element).attr('href');

                $.ajax({
                    type: "GET",
                    url: $href,
                    dataType: "json"
                }).done(function (msg) {
                    window.location.replace(msg.path);
                }).fail(function (msg) {
                    window.location.replace(msg.path);
                });
            }
        },
        className: "bootbox-sm"
    });

    $('.bootbox.modal').on('hidden.bs.modal', function () {
        if ($('#ajaxModalDialog').length) {
            $('body').addClass('modal-open');
        }
    });

}

function deleteAction(element, event) {
    event.preventDefault();

    var message = $(element).attr('message') ? $(element).attr('message') : "Are you sure?" ;

    bootbox.confirm({
        message: message,
        callback: function (result) {
            if (result) {
                var $href = $(element).attr('href');

                $.ajax({
                    type: "GET",
                    url: $href,
                    dataType: "json"
                }).done(function (msg) {
                    init_data_toggle();
                    after_delete_action(element, msg);
                 }).fail(function () {
                    window.location.reload();
                });
            }
        },
        className: "bootbox-sm"
    });

    $('.bootbox.modal').on('hidden.bs.modal', function () {
        if ($('#ajaxModalDialog').length) {
            $('body').addClass('modal-open');
        }
    });

}

function after_delete_action(element, msg) {
    window.location.reload();
}

function ajaxDelete(element, event) {
    event.preventDefault();

    // $('#'+$(element).attr('data-target')).html('<div class="progress progress-striped active"><div class="progress-bar" style="width: 100%;"></div></div>');
    var message = $(element).attr('message') ? $(element).attr('message') : "Are you sure?" ;

    bootbox.confirm({
        message: message,
        callback: function (result) {
            if (result) {
                $.ajax({
                    type: "POST",
                    url: $(element).attr('action'),
                    data: $(element).serialize()
                }).done(function () {
                    // init_data_toggle();
                    location.reload();
                }).fail(function (msg) {
                    window.location.reload();
                });
            }
        },
        className: "bootbox-sm"
    });

}

function confirmAction(element, event) {
    event.preventDefault();

    var message = $(element).attr('message') ? $(element).attr('message') : "Are you sure?" ;

    bootbox.confirm({
        message: message,
        callback: function (result) {
            if (result) {
                var $href = $(element).attr('href');

                window.location = $href;
            }
        },
        className: "bootbox-sm"
    });

    $('.bootbox.modal').on('hidden.bs.modal', function () {
        if ($('#ajaxModalDialog').length) {
            $('body').addClass('modal-open');
        }
    });

}

function ajaxSubmit(element, event) {
    event.preventDefault();

    $('#'+$(element).attr('data-target')).html('<div class="progress progress-striped active"><div class="progress-bar" style="width: 100%;"></div></div>');

    $.ajax({
        type: "POST",
        url: $(element).attr('action'),
        data: $(element).serialize()
    }).done(function (msg) {
        var target = $('#'+$(element).attr('data-target'));
        target.html(msg);
        init_data_toggle();
        $('html, body').stop().animate({
            'scrollTop': target.offset().top
        }, 500, 'swing');
    }).fail(function (msg) {
        window.location.reload();
    });
}

function elFinderBrowser(field_name, url, type, win) {

    var node_id = $('#node_id').val();

    var url = (config.index_page ? '/' + config.index_page : '') + '/doc_repo/file_manager/tinymce';
    if (node_id) {
        url += '_node/' + node_id;
    }

    tinymce.activeEditor.windowManager.open({
        file: url, // use an absolute path!
        title: 'Drive',
        width: 900,
        height: 450,
        resizable: 'yes'
    }, {
        setUrl: function (url) {
            win.document.getElementById(field_name).value = url;
        }
    });
    return false;
}

function getFileFromSid(property_id, element) {

    $('.file_from_sid').remove();

    var node_id = $('#node_id').val();

    var url = (config.index_page ? '/' + config.index_page : '') + '/doc_repo/file_manager/attachment';
    if (node_id) {
        url += '_node/' + node_id;
    }

    $(element).after('<div id="sid_wrapper_' + property_id + '" class="file_from_sid" style="position: absolute; z-index: 10; width: 90%; left: 40px; right: 40px; margin-top: 10px;">' +
        '<div class="panel panel-default">' +
        '<div class="panel-heading">' +
        '<button style="margin-top: -3px;" type="button" class="close" aria-label="Close" onclick="$(\'#sid_wrapper_' + property_id + '\').remove();"><span aria-hidden="true">&times;</span></button>' +
        '<h3 class="panel-title">Drive</h3>' +
        '</div>' +
        '<div class="panel-body">' +
        '<iframe style="border: none;" src=\"' + url + '?property_id=' + property_id + '\" width=\"100%\" height=\"450px\"></iframe>' +
        '</div>' +
        '</div>' +
        '</div>');
}

function getFilename(url) {
    if (url) {
        var m = url.substring(url.lastIndexOf('/') + 1);
        m = m.substr(0, m.lastIndexOf('.'));
        if (m && m.length > 1)
        {
            return decodeURIComponent(m);
        }
    }
    return "";
}

var timer_notification;

function check_notification() {

    $.ajax({
        url: '/notification/check_notification',
        dataType: "json"
    }).done(function (msg) {
        if (msg.success) {

            var html = '<a data-toggle="dropdown" class="dropdown-toggle" href="#notifications" role="button" aria-haspopup="true" aria-expanded="false">';
            html += '<i class="px-navbar-icon fa fa-bullhorn"></i>';
            html += '<span class="px-navbar-icon-label">' + msg.label + '</span>';
            html += '<span class="px-navbar-label label">' + msg.unread_count + '</span>';
            html += '</a>';

            html += '<div style="width: 300px" class="dropdown-menu p-a-0">';
            html += '<div style="height: 280px; position: relative; overflow-x: hidden;" id="navbar-notifications">';

            if (msg.all_count) {

                for (var key in msg.notifications) {

                    html += '<div class="widget-notifications-item">';
                    html += '<div class="widget-notifications-title text-'+ msg.notifications[key].type_color +'">'+ msg.notifications[key].type_name +'</div>';
                    html += '<div class="widget-notifications-description">' + msg.notifications[key].subject + '</div>';
                    html += '<div class="widget-notifications-date"><strong>'+ msg.notifications[key].sender_name +'</strong>  :: '+ msg.notifications[key].date_added +'</div>';
                    html += '<a href="/notification/view_notification/' + msg.notifications[key].id + '" data-toggle="ajaxModal">';
                    html += '<div class="widget-notifications-icon fa '+ msg.notifications[key].type_icon +' bg-'+ msg.notifications[key].type_color +'"></div>';
                    html += '</a>';
                    html += '</div>';

                }
            }

            html += '</div>';
            html += '<a class="widget-more-link" href="/notification/all">' + msg.more_label + '</a>';
            html += '</div>';

            html += '<script>';
            html += 'init_data_toggle();';
            html += "$('#notification_wrapper').unbind().on('shown.bs.dropdown', function () {";
            html += 'clearTimeout(timer_notification);';
            html += "}).on('hidden.bs.dropdown', function () {";
            html += 'setTimeout(check_notification, 10000);';
            html += '});';
            html += '</script>';

            $('#notification_wrapper').html(html).show();

            timer_notification = setTimeout(check_notification, 60000);
        }
    }).fail(function () {
        setTimeout(check_notification, 65000);
    });

}

/**
 * this workaround makes magic happen
 * thanks @harry: http://stackoverflow.com/questions/18111582/tinymce-4-links-plugin-modal-in-not-editable
 */
$(document).on('focusin', function (e) {
    if ($(e.target).closest(".mce-window").length) {
        e.stopImmediatePropagation();
    }
});

function log_form(btn, node_id) {

    $.ajax({
        type: "POST",
        url: "/accreditation/log",
        data: {node_id: node_id},
        dataType: "json"
    }).done(function (msg) {
        tinymce.remove("textarea");
        $("#ajaxModalDialog").html(msg.html);
    }).fail(function () {
        window.location.reload();
    });
}

function import_form(btn, node_id) {

    $.ajax({
        type: "POST",
        url: "/accreditation/import",
        data: {node_id: node_id},
        dataType: "json"
    }).done(function (msg) {
        tinymce.remove("textarea");
        $("#ajaxModalDialog").html(msg.html);
    }).fail(function () {
        window.location.reload();
    });
}

function integration(btn, node_id) {

    $.ajax({
        type: "POST",
        url: "/accreditation/integration",
        data: {node_id: node_id},
        dataType: "json"
    }).done(function (msg) {
        tinymce.remove("textarea");
        $("#ajaxModalDialog").html(msg.html);
    }).fail(function () {
        window.location.reload();
    });
}

function find_users(element, property_id, property_label, role, allowed_types, find_label_title, ids) {

    var find_label = '';
    var url = (config.index_page ? '/' + config.index_page : '') + '/user/find?';

    if(role) {
        url += 'user_class=' + role + '&';
    }

    if (typeof find_label_title !== "undefined") {
        find_label = find_label_title;
    } else {
        find_label = 'Find Users';
    }

    if(allowed_types) {
        allowed_types.forEach(function(element) {
            url += 'allowed_types[]=' + element + '&';
        });
    }

    if (ids) {
        url += 'ids=' + ids + '&';
    }
    $('.find_users').remove();

    var width = ($(element).width() + 26) + 'px';
    var position = $(element).position();

    $(element).after('<div id="wrapper_' + property_id + '" class="find_users" style="position: relative; z-index: 10; width: '+ width +'; left: ' + position.left + '; margin-top: 5px;">' +
        '<div class="panel panel-default">' +
        '<div class="panel-heading">' +
        '<button style="margin-top: -3px;" type="button" class="close" aria-label="Close" onclick="$(\'#wrapper_' + property_id + '\').remove();"><span aria-hidden="true">&times;</span></button>' +
        '<h3 class="panel-title">'+ find_label +'</h3>' +
        '</div>' +
        '<div class="panel-body">' +
        '<iframe style="border: none;" src="' + url + 'property_id='+property_id+'&property_label='+property_label+'" width="100%" height="400" ></iframe>' +
        '</div>' +
        '</div>' +
        '</div>');
}
function find_users_to_invite(element, club_id,property_id, property_label, role, allowed_types, find_label_title) {

    var find_label = '';
    var url = (config.index_page ? '/' + config.index_page : '') + '/team_formation/get_users_for_invite?';

    if(role) {
        url += 'user_class=' + role + '&';
    }

    if (typeof find_label_title !== "undefined") {
        find_label = find_label_title;
    } else {
        find_label = 'Find Users';
    }

    if(allowed_types) {
        allowed_types.forEach(function(element) {
            url += 'allowed_types[]=' + element + '&';
        });
    }

    $('.find_users').remove();

    var width = "100%";
    var position = $(element).position();

    $(element).after('<div id="wrapper_' + property_id + '" class="find_users" style="position: relative; z-index: 10; width: '+ width +'; left: ' + position.left + '; margin-top: 5px;">' +
        '<div class="panel panel-default">' +
        '<div class="panel-heading">' +
        '<button style="margin-top: -3px;" type="button" class="close" aria-label="Close" onclick="$(\'#wrapper_' + property_id + '\').remove();"><span aria-hidden="true">&times;</span></button>' +
        '<h3 class="panel-title">'+ find_label +'</h3>' +
        '</div>' +
        '<div class="panel-body">' +
        '<iframe style="border: none;"  src="' + url + 'property_id='+property_id+'&property_label='+property_label+'&club_id='+club_id+'" width="100%" height="400" ></iframe>' +
        '</div>' +
        '</div>' +
        '</div>');
}

this.find_onselect = function (find_id, property_id, property_label) {};

function find_courses(element, property_id, property_label) {

    var find_label = '';
    var url = (config.index_page ? '/' + config.index_page : '') + '/course/find';

    $('.find_courses').remove();

    var width = ($(element).width() + 26) + 'px';
    var position = $(element).position();

    $(element).after('<div id="wrapper_' + property_id + '" class="find_courses" style="position: relative; z-index: 10; width: '+ width +'; left: ' + position.left + '; margin-top: 5px;">' +
        '<div class="panel panel-default">' +
        '<div class="panel-heading">' +
        '<button style="margin-top: -3px;" type="button" class="close" aria-label="Close" onclick="$(\'#wrapper_' + property_id + '\').remove();"><span aria-hidden="true">&times;</span></button>' +
        '<h3 class="panel-title">Find Courses</h3>' +
        '</div>' +
        '<div class="panel-body">' +
        '<iframe style="border: none;" src="' + url + '?property_id='+property_id+'&property_label='+property_label+'" width="100%" height="420" ></iframe>' +
        '</div>' +
        '</div>' +
        '</div>');
}

function do_post_submit(url, form_id, div_id) {

    $('#' + div_id).html(
        '<div class="progress">' +
        '   <div class="progress-bar progress-bar-striped active" style="width: 100%; height: 21px;"><i class="fa fa-spinner fa-spin"></i> Loading</div>' +
        '</div>');

    $.ajax({
        type: "POST",
        url: url,
        data: $('#' + form_id).serialize(),
        success: function (result) {
            if (result === '1') {
                window.location.reload();
            } else {
                $('#' + div_id).html(result);
            }
        }
    });
}

function ajaxRender(target, url) {

    $('#' + target).html('<div class="progress progress-striped active no-margin" >' +
        '<div class="progress-bar" style="width: 100%;"><i class="fa fa-spinner fa-spin"></i> Loading</div>' +
        '</div>');

    $.ajax({
        type: "POST",
        url: url
    }).done(function (msg) {
        var $_target = $('#'+ target);

        $_target.html(msg);
        init_data_toggle();

        $('html, body').stop().animate({
            'scrollTop': $_target.offset().top
        }, 500, 'swing');

    }).fail(function () {
        window.location.reload();
    });
}

function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}

function reset_options(type, suffix) {

    var blocks = [];

    switch (type) {
        case 'campus':
            blocks.push('college');
            blocks.push('department');
            blocks.push('program');
            blocks.push('course');
            blocks.push('section');
            break;
        case 'college':
            blocks.push('department');
            blocks.push('program');
            blocks.push('course');
            blocks.push('section');
            break;
        case 'department':
            blocks.push('program');
            blocks.push('course');
            blocks.push('section');
            break;
        case 'program':
            blocks.push('course');
            blocks.push('section');
            break;
        case 'course':
            blocks.push('section');
            break;
    }

    for (var i in blocks) {

        var block = blocks[i];

        if ( $('#' + block + '_block' + suffix).length ) {
            $('#' + block + '_block' + suffix).html('<option value>All ' + toTitleCase(block) + '</option>');
        }
    }
}

function get_colleges_by_campus(element, enable_departments, option_only, suffix) {

    var $form = $('div.modal-content',  window.parent.document);
    if ($form.length) {
        $form.addClass('form-loading');
        $form.addClass('form-loading-inverted');
    }
    suffix = (typeof suffix === 'undefined') ? '' : suffix;

    var loading = '<i class="fa fa-spinner fa-spin"></i> Loading';

    if(option_only) {

        reset_options('campus', suffix);

        loading = '<option value="">Loading ...</option>';
    }
    $('#college_block' + suffix).html(loading);
    $.ajax({
        type: "POST",
        url: "/college/get_colleges/campus",
        data: {
            campus_id: $(element).val(),
            enable_departments: enable_departments,
            option_only: option_only,
            suffix: suffix
        }
    }).done(function (msg) {
        $('#college_block' + suffix).html(msg);
        if ($form.length) {
            $form.removeClass('form-loading');
            $form.removeClass('form-loading-inverted');
        }
    }).fail(function () {
        window.location.reload();
    });
}

function get_departments_by_campus(element, enable_programs, option_only, suffix) {

    var $form = $('div.modal-content',  window.parent.document);
    if ($form.length) {
        $form.addClass('form-loading');
        $form.addClass('form-loading-inverted');
    }

    suffix = (typeof suffix === 'undefined') ? '' : suffix;

    var loading = '<i class="fa fa-spinner fa-spin"></i> Loading';

    if(option_only) {

        reset_options('campus', suffix);

        loading = '<option value="">Loading ...</option>';
    }

    $('#department_block' + suffix).html(loading);

    $.ajax({
        type: "POST",
        url: "/department/get_departments/campus",
        data: {
            campus_id: $(element).val(),
            enable_programs: enable_programs,
            option_only: option_only,
            suffix: suffix
        }
    }).done(function (msg) {
        $('#department_block' + suffix).html(msg);
        if ($form.length) {
            $form.removeClass('form-loading');
            $form.removeClass('form-loading-inverted');
        }
    }).fail(function () {
        window.location.reload();
    });
}

function get_programs_by_campus(element, enable_courses, option_only, suffix) {

    var $form = $('div.modal-content',  window.parent.document);
    if ($form.length) {
        $form.addClass('form-loading');
        $form.addClass('form-loading-inverted');
    }

    suffix = (typeof suffix === 'undefined') ? '' : suffix;

    var loading = '<i class="fa fa-spinner fa-spin"></i> Loading';

    if(option_only) {

        reset_options('campus', suffix);

        loading = '<option value="">Loading ...</option>';
    }

    $('#program_block' + suffix).html(loading);

    $.ajax({
        type: "POST",
        url: "/program/get_programs/campus",
        data: {
            campus_id: $(element).val(),
            enable_courses: enable_courses,
            option_only: option_only,
            suffix: suffix
        }
    }).done(function (msg) {
        $('#program_block' + suffix).html(msg);
        if ($form.length) {
            $form.removeClass('form-loading');
            $form.removeClass('form-loading-inverted');
        }
    }).fail(function () {
        window.location.reload();
    });
}

function get_departments_by_college(element, enable_programs, option_only, suffix) {

    var $form = $('div.modal-content',  window.parent.document);
    if ($form.length) {
        $form.addClass('form-loading');
        $form.addClass('form-loading-inverted');
    }

    suffix = (typeof suffix === 'undefined') ? '' : suffix;

    var loading = '<i class="fa fa-spinner fa-spin"></i> Loading';

    if(option_only) {

        reset_options('college', suffix);

        loading = '<option value="">Loading ...</option>';
    }

    $('#department_block' + suffix).html(loading);

    $.ajax({
        type: "POST",
        url: "/department/get_departments/college",
        data: {
            college_id: $(element).val(),
            enable_programs: enable_programs,
            option_only: option_only,
            suffix: suffix
        }
    }).done(function (msg) {
        $('#department_block' + suffix).html(msg);
        if ($form.length) {
            $form.removeClass('form-loading');
            $form.removeClass('form-loading-inverted');
        }
    }).fail(function () {
        window.location.reload();
    });
}

function get_programs_by_college(element, enable_courses, option_only, suffix) {

    var $form = $('div.modal-content',  window.parent.document);
    if ($form.length) {
        $form.addClass('form-loading');
        $form.addClass('form-loading-inverted');
    }

    suffix = (typeof suffix === 'undefined') ? '' : suffix;

    var loading = '<i class="fa fa-spinner fa-spin"></i> Loading';

    if(option_only) {

        reset_options('college', suffix);

        loading = '<option value="">Loading ...</option>';
    }

    $('#program_block' + suffix).html(loading);

    $.ajax({
        type: "POST",
        url: "/program/get_programs/college",
        data: {
            college_id: $(element).val(),
            enable_courses: enable_courses,
            option_only: option_only,
            suffix: suffix
        }
    }).done(function (msg) {
        $('#program_block' + suffix).html(msg);
        if ($form.length) {
            $form.removeClass('form-loading');
            $form.removeClass('form-loading-inverted');
        }
    }).fail(function () {
        window.location.reload();
    });
}

function get_programs_by_department(element, enable_courses, option_only, suffix) {

    var $form = $('div.modal-content',  window.parent.document);
    if ($form.length) {
        $form.addClass('form-loading');
        $form.addClass('form-loading-inverted');
    }
    suffix = (typeof suffix === 'undefined') ? '' : suffix;

    var loading = '<i class="fa fa-spinner fa-spin"></i> Loading';

    if(option_only) {

        reset_options('department', suffix);

        loading = '<option value="">Loading ...</option>';
    }

    $('#program_block' + suffix).html(loading);

    $.ajax({
        type: "POST",
        url: "/program/get_programs/department",
        data: {
            department_id: $(element).val(),
            enable_courses: enable_courses,
            option_only: option_only,
            suffix: suffix
        }
    }).done(function (msg) {
        $('#program_block' + suffix).html(msg);
        if ($form.length) {
            $form.removeClass('form-loading');
            $form.removeClass('form-loading-inverted');
        }
    }).fail(function () {
        window.location.reload();
    });
}

function get_courses_by_program(element, enable_sections, option_only, suffix)
{
    var $form = $('div.modal-content',  window.parent.document);
    if ($form.length) {
        $form.addClass('form-loading');
        $form.addClass('form-loading-inverted');
    }
    suffix = (typeof suffix === 'undefined') ? '' : suffix;

    var loading = '<i class="fa fa-spinner fa-spin"></i> Loading';

    if(option_only) {

        reset_options('program', suffix);

        loading = '<option value="">Loading ...</option>';
    }

    $('#course_block' + suffix).html(loading);

    $.ajax({
        type: "POST",
        url: "/course/get_courses/program",
        data: {
            program_id: $(element).val(),
            enable_sections: enable_sections,
            option_only: option_only,
            suffix: suffix
        }
    }).done(function (msg) {
        $('#course_block' + suffix).html(msg);
        if ($form.length) {
            $form.removeClass('form-loading');
            $form.removeClass('form-loading-inverted');
        }
    }).fail(function () {
        window.location.reload();
    });
}

function get_sections_by_course(element, semester_id, option_only, suffix)
{
    var $form = $('div.modal-content',  window.parent.document);
    if ($form.length) {
        $form.addClass('form-loading');
        $form.addClass('form-loading-inverted');
    }
    suffix = (typeof suffix === 'undefined') ? '' : suffix;

    var loading = '<i class="fa fa-spinner fa-spin"></i> Loading';

    if(option_only) {

        reset_options('course', suffix);

        loading = '<option value="">Loading ...</option>';
    }

    $('#section_block' + suffix).html(loading);

    $.ajax({
        type: "POST",
        url: "/course_section/get_sections/course",
        data: {
            course_id: $(element).val(),
            semester_id: semester_id,
            option_only: option_only,
            suffix: suffix
        }
    }).done(function (msg) {
        $('#section_block' + suffix).html(msg);
        if ($form.length) {
            $form.removeClass('form-loading');
            $form.removeClass('form-loading-inverted');
        }
    }).fail(function () {
        window.location.reload();
    });
}
