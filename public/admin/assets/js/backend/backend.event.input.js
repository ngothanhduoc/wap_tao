var FORM = null;
var statecreate = true;
//var arrGroup = [];
$(document).ready(function() {
    FORM = $('form');
    BACKEND.init();

});

var BACKEND = {
    AJAX_URL_COMMIT: '/backend/ajax/addevent',
    commit: function() {
        $('#frm-add-event').submit(function(e) {
            e.preventDefault();
            $('#loading').show();
            $('button:submit').attr("disabled", true);

            var form = new FormData($('#frm-add-event')[0]);
            $('input[type="checkbox"').each(function() {
                if (!$(this).is(':checked'))
                    form.append('autoplay[]', 0);
                else
                    form.append('autoplay[]', 1);
            });
            $.ajax({
                url: BACKEND.AJAX_URL_COMMIT,
                type: "POST",
                processData: false, // Don't process the files
                contentType: false,
                data: form,
                dataType: "JSON"
            }).done(function(data) {
                if (data.code == 0) {
                    setTimeout(function() {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    var m = data.message;
                    $('#name').html('');
                    $('#image_banner').html('');
                    if (m.name != "") {
                        $('#name').val('');
                        $('#name').attr({'placeholder': m.name});
                        var c = $("#name").position().top;
                        $('body,html').animate({scrollTop: c}, 800);
                    }
                    if (m.image_banner != "") {
                        $('#image_banner').val('');
                        $('#image_banner').attr({'placeholder': m.image_banner});
                        var c = $("#image_banner").position().top;
                        $('body,html').animate({scrollTop: c}, 800);
                    }
                }
                $('#loading').hide();
                $('button:submit').attr("disabled", false);
            });
        });
    },
    init: function() {
        BACKEND.commit();
        //BACKEND.initDropdownlistType('');
        //BACKEND.initDropdownlistArticleType('');
    },
    initDropdownlistType: function(data) {
        var source = ["article", "video", "image_slide"];
        $(".jqxDropdownlistType").jqxDropDownList({source: source, /*selectedIndex: 0,*/ width: '15%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});

        if (data != '') {
            $(".jqxDropdownlistType").jqxDropDownList('selectItem', data);
        }

    },
    initDropdownlistArticleType: function(data) {
        var source = ['news', 'video', 'giftcode'];
        $(".jqxDropdownlistArticleType").jqxDropDownList({source: source, /*selectedIndex: 0,*/ width: '15%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});

        if (data != '') {
            $(".jqxDropdownlistArticleType").jqxDropDownList('selectItem', data);
        }

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

 