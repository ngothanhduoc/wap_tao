<script type="text/javascript">
    setActiveMenu('news_video');
    setActiveSubMenu('backend-news_video-add_news');
</script>

<script type="text/javascript" src="/admin/editor/ckeditor/ckeditor.js"></script>

<script type="text/javascript" src="/admin/assets/js/backend/backend.news.input.js?v=09072015"></script>
<script type="text/javascript" src="/admin/assets/js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="/admin/assets/js/custom/forms.js"></script>
<!-- sliders----------------->
<script type="text/javascript" src="/admin/assets/libraries/jqwidgets/jqxcore.js?v=3"></script>
<script type="text/javascript" src="/admin/assets/libraries/jqwidgets/jqxslider.js?v=3"></script>
<script type="text/javascript" src="/admin/assets/libraries/jqwidgets/jqxbuttons.js?v=3"></script>
<script type="text/javascript" src="/admin/assets/libraries/jqwidgets/jqxscrollbar.js?v=3"></script>
<script type="text/javascript" src="/admin/assets/libraries/jqwidgets/jqxpanel.js?v=3"></script>

<!-- color ------------------>
<script type="text/javascript" src="/admin/assets/libraries/jqwidgets/jqxcolorpicker.js"></script>
<script type="text/javascript" src="/admin/assets/libraries/jqwidgets/jqxradiobutton.js"></script>

<script type="text/javascript" src="/admin/assets/libraries/jqwidgets/jqxdropdownbutton.js"></script>
<!---DateTime--------->
<script type="text/javascript" src="/admin/assets/libraries/jqwidgets/jqxdatetimeinput.js"></script>
<script type="text/javascript" src="/admin/assets/libraries/jqwidgets/jqxcalendar.js"></script>
<script type="text/javascript" src="/admin/assets/libraries/jqwidgets/jqxtooltip.js"></script>
<!-- add tag----------->
<link rel="stylesheet" href="/admin/assets/libraries/addtag/jquery.tagsinput.css" type="text/css" />
<script type="text/javascript" src="/admin/assets/libraries/addtag/jquery.tagsinput.js"></script>
<script type="text/javascript" src="/admin/assets/js/plugins/jquery-ui.1.11.0.min.js"></script>
<!--format textbox--->
<script type="text/javascript" src="/admin/assets/libraries/format-text/jquery.formance.min.js"></script>
<script type="text/javascript" src="/admin/assets/libraries/format-text/awesome_form.js"></script>
<style type="text/css">
    .csButton {
        /*background-color:#fe1a00;*/
        background-color:#ccc;
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ddd), color-stop(1, #ccc));
        background:-moz-linear-gradient(center top, #ddd 5%, #ccc 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fe1a00', endColorstr='#ce0100');
        -webkit-border-radius:5px;
        -moz-border-radius:5px;
        border-radius:5px;
        text-indent:0;
        border:1px solid #c6c6c6;
        display:inline-block;
        color:#555;
        font-family:Arial;
        font-size:14px;
        font-weight:normal;
        height:32px;
        line-height:32px;
        padding: 0px 10px;
        /*width:130px;*/
        text-decoration:none;
        text-align:center;
        text-shadow:1px 1px 0px #eee;

        -moz-box-shadow:inset 0px 1px 0px 0px #eee;
        -webkit-box-shadow:inset 0px 1px 0px 0px #eee;
        box-shadow:inset 0px 1px 0px 0px #eee;
    }
    .csButton:hover {
        /*color: #8fc800;*/
        background-color:#ce0100;
        background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ccc), color-stop(1, #ddd) );
        background:-moz-linear-gradient( center top, #ccc 5%, #ddd 100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ccc', endColorstr='#ddd');
    }
    .csButton:active {
        position:relative;
        top:1px;
    }

    #image-list > div{
        margin: 20px 0px;
    }
    #image-list-wap > div{
        margin: 20px 0px;
    }
    .hidedom{display:none}
    form input[type="number"] {
        background: none repeat scroll 0 0 #fcfcfc;
        border: 1px solid #ccc;
        border-radius: 2px;
        box-shadow: 0 1px 3px #ddd inset;
        color: #666;
        padding: 8px 5px;
        vertical-align: middle;

    }
    .cl-dotuongthich,.cl-hinhanh,.cl-amthanh,.cl-gameplay,.cl-congdong{
        margin: 5px 0 10px;
    }
    .cl-dotuongthich span,.cl-hinhanh span,.cl-amthanh span,.cl-gameplay span,.cl-congdong span{
        display:inline-block;
        border-radius: 20px;
        margin-right: 5px;
        border: 1px solid #ccc;
        width: 20px;
        text-align: center;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $('#jqxDropdownlist').on('checkChange', function(event) {
            if (event.args) {
                var item = event.args.item;
                if (item) {
                    if (item.checked) {
                        if ($('#' + item.value).length == 0) {
                            $('#temp-download').find('input[type="text"]').attr('name', 'url_download[' + item.label + ']');
                            $('#temp-download').find('input[type="text"]').attr('id', item.label);
                            $('#temp-download').find('span').attr('id', 'label-' + item.label);
                            $('#temp-download').find('span').html('&nbsp;&nbsp;' + item.label);

                            if ($('#field-download input[type="text"]').length == 0) {
                                $('#field-download').html('');
                            }
                            $('#field-download').append($('#temp-download').html());

                            $('#temp-download').find('input[type="text"]').attr('name', '');
                            $('#temp-download').find('input[type="text"]').attr('id', '');
                            $('#temp-download').find('span').attr('id', '');
                            $('#temp-download').find('span').html('');
                            
                            //package
                            $('#temp-package').find('input[type="text"]').attr('name', 'package_name[' + item.label + ']');
                            $('#temp-package').find('input[type="text"]').attr('id', item.label + '_package');
                            $('#temp-package').find('span').attr('id', 'label-package-' + item.label);
                            $('#temp-package').find('span').html('&nbsp;&nbsp;' + item.label);

                            if ($('#field-package input[type="text"]').length == 0) {
                                $('#field-package').html('');
                            }
                            $('#field-package').append($('#temp-package').html());

                            $('#temp-package').find('input[type="text"]').attr('name', '');
                            $('#temp-package').find('input[type="text"]').attr('id', '');
                            $('#temp-package').find('span').attr('id', '');
                            $('#temp-package').find('span').html('');
                        }
                    } else {
                        if ($('#' + item.value).length > 0) {
                            $('#' + item.value).remove();
                            $('#label-' + item.value).remove();
                            
                            //package
                            $('#' + item.value + '_package').remove();
                            $('#label-package-' + item.value).remove();
                        }
                    }               

                }
            }
        });
    });
</script>
<div class="pageheader notab" style="border-bottom: none">
    <h1 class="pagetitle">Add News</h1>
    <span class="pagedesc"></span>
    <ul class="hornav">
        <li class="current"><a href="#info-game">Thông tin News</a></li>        
    </ul>
</div><!--pageheader-->

<div id="contentwrapper" class="contentwrapper lineheight21">
    <div id="info-game" class="subcontent" style="display: block">
        <form class="stdform stdform2" id="frm-add-game" role="form" action="" method="POST" enctype="multipart/form-data">
                        
            <p style="border-top: #ddd solid 1px; border-bottom: none">
                <label for="name">Tên <span style="color:#ff0000">(*)</span></label>
                <span class="field">
                    <input type="text" placeholder="" id="name" name="name" class="mediuminput" value="<?php echo @$data['name'] ?>">                    
                </span>
            </p>
            
<!--            <div style="border: #ddd solid 1px; border-bottom: none">
                <label>Loại <span style="color:#ff0000">(*)</span></label>
                <span class="field">
                    <div id="jqxDropdownlistType" name="type"></div>
                    <div id="type" style="color: #ff0000"></div>
                </span>
            </div> -->
            
           
            
            <p style="border-top: #ddd solid 1px; border-bottom: none">
                <label for="icon">Hình ảnh <span style="color:#ff0000">(*)</span></label>
                <span class="field">
                    <input type="text" placeholder="" id="icon" name="image" class="mediuminput" value="<?php echo @$data['image'] ?>" onclick="openKCFinderByPath('#icon', 'images')" readonly>
                </span>
            </p>
            
            <p>
                <label for="description">Description</label>
                <span class="field">
                    <textarea class="mediuminput" name="description" id="description" placeholder=""><?php echo @$data['description'] ?></textarea>
                </span>
            </p>
            <p>
                <label for="content" style="float: none">Content</label>
            </p>
            <p>
                <textarea placeholder="" id="content" name="content" class="mediuminput"><?php echo @$data['content'] ?></textarea>
            </p>
            <p>
                <label>Set Home</label>
                <span class="field">
                    <input type="checkbox" placeholder="" id="set_home" name="set_home" class="mediuminput" <?php if (@$data['set_home'] == 'active') echo "checked='checked'" ?> value="active"> Có
                </span>
            </p>
            <p>
                <label for="order">Order</label>
                <span class="field">
                    <input type="text" placeholder="" id="order" name="order" class="smallinput" value="<?php $a = empty($data['order']) == TRUE ? 0 : $data['order'] ;     echo (int)@$a ?>">
                </span>
            </p>
            <p class="stdformbutton">
                <input id="txt_id" type="hidden" value="<?php echo @$data['id_news_video'] ?>" name="id">
                <button class="submit radius2" type="submit">Add Game</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/admin/assets/images/loaders/loader10.gif"/></span>

            </p>
        </form>
    </div>   

</div>
<script type="text/javascript">
   

</script>
