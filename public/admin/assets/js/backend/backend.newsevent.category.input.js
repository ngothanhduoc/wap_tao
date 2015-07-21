var FORM = null;
var statecreate = true;
$(document).ready(function() {
    FORM = $('form');
    //-- init textbox nha phat hanh --------------------------------------------
    BACKEND.init();
});
var BACKEND = {
    AJAX_URL_COMMIT: '/backend/ajax/addcategorynews',
    commit: function() {
        $('#frm-add-category').submit(function(e) {
            e.preventDefault();
            var form = new FormData($('#frm-add-category')[0]);
            console.log(form);

            $('button:submit').attr("disabled", true);

            $.ajax({
                url: BACKEND.AJAX_URL_COMMIT,
                type: "POST",
                processData: false, // Don't process the files
                contentType: false,
                beforeSend: BACKEND.startLoading,
                complete: BACKEND.topLoading,
                data: form,
                beforeSend: BACKEND.startLoading,
                        //complete: BACKEND.topLoading,

                        dataType: "JSON"
            }).done(function(data) {
                //$('#loading').addClass('load30');

                if (data.code == 0) {
                    window.location.href = data.redirect;
                } else {
                    var m = data.message;

                    if (m.title != "") {
                        $('#title').val('');
                        $('#title').attr('placeholder', m.title);
                        var c = $("#title").position().top;
                        $('body,html').animate({scrollTop: c}, 800);
                    }
                    $('#parent').html('');
                    if (m.parent != "") {
                        $('#parent').html('Vui lòng chọn!');
                        var c = $("#jqxDropdownlistCat").position().top;
                        $('body,html').animate({scrollTop: c}, 800);
                    }

                }

                $('button:submit').attr("disabled", false);

            });
        });

    },
    init: function() {

        BACKEND.commit();
        BACKEND.initDropdownlistCat(CAT_INDEX);
        BACKEND.initDropdownlistStatus(STATUS);
    },
    initDropdownlistCat: function(data) {
        var source = CAT;
        $("#jqxDropdownlistCat").jqxDropDownList({source: source, width: '25%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});

        if (data != '') {
            $("#jqxDropdownlistCat").jqxDropDownList('selectItem', data);
        }
    },
    initDropdownlistStatus: function(data) {
        var source = ['active', 'block'];
        $("#jqxDropdownlistStatus").jqxDropDownList({source: source, width: '25%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});

        if (data != '') {
            $("#jqxDropdownlistStatus").jqxDropDownList('selectItem', data);
        }
    },
    startLoading: function() {
        $('#loading-input').css({display: 'inline'});
    },
    topLoading: function() {
        $('#loading-input').hide();
    },
}


$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

 