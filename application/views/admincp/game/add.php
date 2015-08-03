<script type="text/javascript">
    setActiveMenu('game');
    setActiveSubMenu('backend-game-add');
</script>

<script type="text/javascript" src="/admin/editor/ckeditor/ckeditor.js"></script>

<script type="text/javascript" src="/admin/assets/js/backend/backend.game.input.js?v=09072015"></script>
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
<?php
$url_download = @$data['download_url'];
if (empty($url_download) === FALSE) {
    $arrDownload = json_decode($url_download, true);
} else {
    $arrDownload = array();
}
$slide_image = @$data['slide_image'];
if (empty($slide_image) === FALSE) {
    $arrSlide = json_decode($slide_image, true);
} else {
    $arrSlide = array();
}
$package_name = @$data['package_name'];
if (empty($package_name) === FALSE) {
    $arrPackage = json_decode($package_name, true);
} else {
    $arrPackage = array();
}
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#jqxDropdownlist').on('checkChange', function (event) {
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
//                            $('#temp-package').find('div').attr('id', '');
//                            $('#temp-package').find('div').html('');
                        }
                        
                    } else {
                        if ($('#' + item.value).length > 0) {
                            $('#' + item.value).remove();
                            $('#label-' + item.value).next().remove();
                            $('#label-' + item.value).remove();
                            
                            //package
                            $('#' + item.value + '_package').remove();
                            $('#label-package-' + item.value).remove();
                        }
                    }

                }
            }
        });
        $('.cate_game_app').on('change', function (event) {
            if (event.args) {
                var item = event.args.item;
                $.ajax({
                    url: '/backend/ajax/get_cat?type=' + item.label,
                    type: "GET",
                    processData: false, // Don't process the files
                    contentType: false,
                    beforeSend: BACKEND.startLoadingg,
                    complete: BACKEND.topLoadingg,
//                    dataType: "json"
                }).done(function (data) {
                    $(".content_cate").html(data);

//                var arrPlatform = data.split(',');
//                for (var i = 0; i < arrPlatform.length; i++) {
//                    $(".content_cate").jqxDropDownList('checkItem', arrPlatform[i]);
//                }
//                console.log(data);
                });
            }
            ;
        });

    });
</script>
<div class="pageheader notab" style="border-bottom: none">
    <h1 class="pagetitle">Add game</h1>
    <span class="pagedesc"></span>
    <ul class="hornav">
        <li class="current"><a href="#info-game">Thông tin Game</a></li>        
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
            <p style="border-top: #ddd solid 1px; border-bottom: none">
                <label for="code_game">Code <span style="color:#ff0000">(*)</span></label>
                <span class="field">
                    <input type="text" placeholder="" id="code_game" name="code_game" class="smallinput" value="<?php echo @$data['code_game'] ?>">                    
                </span>
            </p>
            <div style="border: #ddd solid 1px; border-bottom: none">
                <label>Loại <span style="color:#ff0000">(*)</span></label>
                <span class="field">
                    <div id="jqxDropdownlistType" class="cate_game_app" name="type"></div>
                    <div id="type" style="color: #ff0000"></div>
                </span>
            </div> 
            <div style="border: #ddd solid 1px; border-bottom: none">
                <label>Loại <span style="color:#ff0000">(*)</span></label>
                <span class="field content_cate">
                </span>
            </div> 
            <p style="border-top: #ddd solid 1px; border-bottom: none">
                <label for="size">Dung lượng<span style="color:#ff0000">(*)</span></label>
                <span class="field">
                    <input type="text" placeholder="" id="size" name="size" class="smallinput" value="<?php echo @$data['size'] ?>">
                </span>
            </p>
            <div style="border: #ddd solid 1px; border-bottom: none">
                <label>Platform <span style="color:#ff0000">(*)</span></label>
                <span class="field">
                    <div id="jqxDropdownlist" name="platform"></div>
                    <div id="platform" style="color: #ff0000"></div>
                </span>
            </div>
            <div style="border: #ddd solid 1px;">
                <label for="code_game">Url download</label>
                <span class="field" id="field-download">
                    <?php
                    if (empty($arrDownload) === FALSE) {
                        ?>    
                        <?php
                        foreach ($arrDownload as $key => $val) {
                            ?>
                            <input type="text" placeholder="" id="<?php echo $key ?>" name="url_download[<?php echo $key ?>]" class="mediuminput" value="<?php echo $val ?>" style="margin-bottom: 10px"><span id="label-<?php echo $key ?>">&nbsp;&nbsp;<?php echo $key ?></span>
                            <?php
                        }
                        ?>
                        <?php
                    } else {
                        ?>    
                        &nbsp;
                        <?php
                    }
                    ?>
                </span>
                <span id="temp-download" style="display: none">
                    <input type="text" placeholder="" id="link" name=""  class="mediuminput link_download" value="" style="margin-bottom: 10px"><span id="">Android</span> <div onclick="openKCFinderByPath($(this).prev().prev(), 'files');"  id="add" style="color: red; font-weight: bold; cursor: pointer">ADD FILE</div> 
                </span>

            </div>


            <div style="border: #ddd solid 1px; border-top: none">
                <label for="code_game">Package name</label>
                <span class="field" id="field-package">
                    <?php
                    if (empty($arrPackage) === FALSE) {
                        ?>    
                        <?php
                        foreach ($arrPackage as $key => $val) {
                            ?>
                            <input type="text" placeholder="" id="<?php echo $key ?>_package" name="package_name[<?php echo $key ?>]" class="mediuminput" value="<?php echo $val ?>" style="margin-bottom: 10px"><span id="label-package-<?php echo $key ?>">&nbsp;&nbsp;<?php echo $key ?></span>
                            <?php
                        }
                        ?>
                        <?php
                    } else {
                        ?>    
                        &nbsp;
                        <?php
                    }
                    ?>
                </span>
                <span id="temp-package" style="display: none">
                    <input type="text" placeholder="" id="" name="" class="mediuminput" value="" style="margin-bottom: 10px"><span id="">Android</span>
                </span>

            </div>

            <p>
                <label for="count_download">Đặt số Download <span style="color:#ff0000">(*)</span></label>
                <span class="field">
                    <input type="text" placeholder="" id="count_download" name="count_download" class="smallinput" value="<?php echo @$data['count_download'] ?>">
                </span>
            </p>



            <p>
                <label for="icon">Icon <span style="color:#ff0000">(*)</span></label>
                <span class="field">
                    <input type="text" placeholder="" id="icon" name="icon" class="mediuminput" value="<?php echo @$data['icon'] ?>" onclick="openKCFinderByPath('#icon', 'images')" readonly>
                </span>
            </p>
            <div style="border: #ddd solid 1px; border-top: none">
                <label for="code_game">Slile Ảnh Game<span style="color:#ff0000">(*)</span></label>
                <span class="field " id="field-package">
                    <div class="field-slide-image">
                        <?php
                        if (empty($arrSlide) === FALSE) {
                            ?>    
                            <?php
                            foreach ($arrSlide as $key => $val) {
                                ?>
                                <input type="text" placeholder="" id="<?php echo $key ?>_slide" name="slide[<?php echo $key ?>]" class="mediuminput" onclick="openKCFinderByPath('#<?php echo $key ?>_slide', 'images')"  value="<?php echo $val ?>" style="margin-bottom: 10px">
                                <?php
                            }
                            ?>
                            <?php
                        } else {
                            ?>    
                            <input type="text" placeholder="" id="1_slide" name="slide[1]" class="mediuminput input-slide" onclick="openKCFinderByPath('#1_slide', 'images')"  value="" style="margin-bottom: 10px"> 

                            <?php
                        }
                        ?>
                    </div>
                    <div class="addslide" style="cursor: pointer">Thêm Hình</div>
                    <script>
                        $(function () {
                            $i = 2;
                            $(".addslide").click(function () {
                                $('.field-slide-image').append('<input type="text" placeholder="" id="' + $i + '_slide" name="slide[' + $i + ']" class="mediuminput input-slide"  onclick="openKCFinderByPath(\'#' + $i + '_slide\', \'images\')"  value="" style="margin-bottom: 10px"> <span style="cursor: pointer" class="delete-slide"> Xóa </span>   ');
                                $i++;
                                $('span.delete-slide').click(function () {
                                    $(this).prev().remove();
                                    $(this).remove();
                                });
                            })

                        })
                    </script>
                </span>
                <span id="temp-package" style="display: none">
                    <input type="text" placeholder="" id="" name="" class="mediuminput" value="" style="margin-bottom: 10px"><span id="">Android</span>
                </span>

            </div>

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
                <label>Set slide</label>
                <span class="field">
                    <input type="checkbox" placeholder="" id="set_slide" name="set_slide" class="mediuminput" <?php if (@$data['set_slide'] == 'active') echo "checked='checked'" ?> value="active"> Có
                </span>
            </p>
            <p>
                <label for="order">Order</label>
                <span class="field">
                    <input type="text" placeholder="" id="order" name="order" class="smallinput" value="<?php echo (int) @$data['order'] ?>">
                </span>
            </p>
            <p class="stdformbutton">
                <input id="txt_id" type="hidden" value="<?php echo @$data['id_game_app'] ?>" name="id">
                <button class="submit radius2" type="submit">Add Game</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/admin/assets/images/loaders/loader10.gif"/></span>

            </p>
        </form>
    </div>   

</div>
<script type="text/javascript">
    var arrPlat = <?php echo @json_encode($arrPlatform) ?>;
    var PLAT = '<?php echo @$platform ?>';

    var TYPE = '<?php echo @$type ?>';

</script>
