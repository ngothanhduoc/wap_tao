var FORM = null;
var statecreate = true;
$(document).ready(function() {
	FORM = $('form');
	
    CKEDITOR.replace('note');
	 //-- init textbox nha phat hanh --------------------------------------------
    BACKEND.init();
	/*
	FORM = $('form');
    CKEDITOR.replace('txt-content');
    $('body').tooltip('disable');
    setDefaultValueSelectBox();
   
	*/
});

var BACKEND = {
    AJAX_URL_COMMIT: '/backend/ajax/addpublisher',
    commit: function() {
		   $('#frm-add-game-publisher').submit(function(e) {
			e.preventDefault();
			
			$('button:submit').attr("disabled", true);
			
			var form = new FormData ($('#frm-add-game-publisher')[0]);
			console.log(form);
			if($('#jqxDropdownlistCountry').val() != ''){
                            form.append("id_country", arrQuocgiaName[$('#jqxDropdownlistCountry').val()]);
                        }
			form.append("note", CKEDITOR.instances['note'].getData());
			
			$.ajax({
				url: BACKEND.AJAX_URL_COMMIT,
				type: "POST",
				processData: false, // Don't process the files
				contentType: false, 
				data: form,
				
				beforeSend: BACKEND.startLoading,
				complete: BACKEND.topLoading,
				
				dataType: "JSON"
			}).done(function(data) {
				if (data.code == 0) {
					setTimeout(function(){
					window.location.href = data.redirect,1000});
				} else {
					var m = data.message;
					/*
                                        if (m.phone!= "") {
						$('#phone').val('');
						$('#phone').attr('placeholder', m.phone);
						var c = $("#phone").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}	
					if (m.address!= "") {
						$('#address').val('');
						$('#address').attr('placeholder', m.address);
						var c = $("#address").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
                                        */
                                        /*
                                        if (m.logo != "") {
						$('#logo').val('');
						$('#logo').attr('placeholder', m.logo);
						var c = $("#logo").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
                                        */
					if (m.full_name!= "") {
						$('#full_name').val('');
						$('#full_name').attr('placeholder', m.full_name);
						var c = $("#full_name").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
                                        if (m.id_country!= "") {
						$('#id_country').html(m.id_country);
						var c = $("#id_country").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
					
				}
				$('button:submit').attr("disabled", false);
			});
			
		});
       
    },
    init: function() {
        BACKEND.initDropdownlistCountry(QG_NAME);
        BACKEND.initJqxInput(arrPublisher);//autocomplet
	BACKEND.commit();        
    },
   initJqxInput: function(arr) {
        $("#full_name").jqxInput({source: arr, theme: 'office'});
    },
    initDropdownlist: function(platform) {
		var source = ["Android", "IOS", "Java"];
        $("#jqxDropdownlist").jqxDropDownList({checkboxes: true, source: source, selectedIndex: 1, width: '100%', height: '25', theme: THEME, placeHolder: "Vui lòng chọn"});

        var arrPlatform = platform.split(',');
        for (var i = 0; i < arrPlatform.length; i++) {
            $("#jqxDropdownlist").jqxDropDownList('checkItem', arrPlatform[i]);
        }
    },
    initDropdownlistType: function(data) {
        var source = ["Game mới", "Game Hot", "Nạp nhiều"];
        $("#jqxDropdownlistType").jqxDropDownList({checkboxes: true, source: source, selectedIndex: 1, width: '100%', height: '25', theme: THEME, placeHolder: "Vui lòng chọn"});

        var arr = data.split(',');
        for (var i = 0; i < arr.length; i++) {
            $("#jqxDropdownlistType").jqxDropDownList('checkItem', arr[i]);
        }
    },
	initDropdownlistSmsCard: function(data) {
        var source = ["sms", "card"];
        $("#jqxDropdownlistSmsCard").jqxDropDownList({checkboxes: true, source: source, selectedIndex: 1, width: '100%', height: '25', theme: THEME, placeHolder: "Vui lòng chọn"});

        var arr = data.split(',');
        for (var i = 0; i < arr.length; i++) {
            $("#jqxDropdownlistSmsCard").jqxDropDownList('checkItem', arr[i]);
        }
    },
	startLoading: function(){
		$('#loading').show();
	},
	topLoading: function(){
		$('#loading').hide();
		$('button:submit').attr("disabled", false);
	},
     initDropdownlistCountry: function(data) {
        var source = arrQuocgia;
	$("#jqxDropdownlistCountry").jqxDropDownList({source: source, /*selectedIndex: 0,*/ width: '50%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});

        if(data != ''){
                $("#jqxDropdownlistCountry").jqxDropDownList('selectItem',data);
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

 