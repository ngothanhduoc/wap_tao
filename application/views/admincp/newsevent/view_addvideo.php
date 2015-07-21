<!--<script src="/layout/backend/assets/js/fileinput.js" id="script-resource-18"></script>-->

<script type="text/javascript" src="/admin/editor/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/admin/assets/js/backend/backend.video.input.js?v=24042015"></script>

<!-- add tag----------->
<link rel="stylesheet" href="/admin/assets/libraries/addtag/jquery.tagsinput.css" type="text/css" />
<script type="text/javascript" src="/admin/assets/libraries/addtag/jquery.tagsinput.js"></script>
<script type="text/javascript" src="/admin/assets/js/plugins/jquery-ui.1.11.0.min.js"></script>

<script type="text/javascript">
    setActiveMenu('newsevent');
    setActiveSubMenu('backend-newsevent-addvideo');
    var PUBLISHER = <?php echo json_encode(@$publisher) ?>;
    var PUBLISHER_INDEX = '<?php echo @$publisherIndex ?>';
    var GAME = <?php echo json_encode(@$game) ?>;
    var GAME_INDEX = '<?php echo @str_replace("'", "`", $gameIndex) ?>';
    var CAT = <?php echo json_encode(@$cat) ?>;
    var CAT_INDEX = '<?php echo @str_replace("'", "`", $catIndex) ?>';
    $(function() {
        if ($('#is_ytimage').is(':checked')) {
            $('#image').parent().parent().hide();
        } else {
            $('#image').parent().parent().show();
        }
        $("#is_ytimage").click(function() {
            if ($(this).is(':checked')) {
                $('#image').parent().parent().hide();
            } else {
                $('#image').parent().parent().show();
            }

        });
    });
</script>
<?php
$arrkey = @$data['seo_keyword'];
if (empty($arrkey) === FALSE) {
    $key = implode(',', json_decode($arrkey, true));
} else {
    $key = '';
}
?>
<div class="pageheader notab">
    <h1 class="pagetitle">Thêm Video</h1>
    <span class="pagedesc"></span>

</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
    <form class="stdform stdform2" id="frm-add-video" role="form" action="" method="POST" enctype="multipart/form-data">
        <p>
            <label>Tiêu đề <span style="color:red">*</span></label>
            <span class="field">
                <input type="text" placeholder="" id="title" name="title" class="mediuminput" value="<?php echo @$data['title'] ?>">
            </span>
        </p>
        <div style="border: #ddd solid 1px">
            <label>Nhà phát hành</label>
            <span class="field">
                <div id="jqxDropdownlistPublisher" name="publisher_name"></div>
                <div id="publisher_name" style="color: #ff0000"></div>
            </span>
        </div>
        <div style="border: #ddd solid 1px">
            <label>Game <span style="color:red">*</span></label>
            <span class="field">
                <div id="jqxDropdownlistGame" name="game_name"></div>
                <div id="game_name" style="color: #ff0000"></div>
            </span>
        </div>
        <div style="border: #ddd solid 1px">
            <label>Category <span style="color:red">*</span></label>
            <span class="field">
                <div id="jqxDropdownlistCategory" name="category_name"></div>
                <div id="category_name" style="color: #ff0000"></div>
            </span>
        </div>
        <p>
            <label>Id Youtube <span style="color:red">*</span></label>
            <span class="field">
                <input type="text" placeholder="" id="id_youtube" name="id_youtube" class="mediuminput" value="<?php echo @$data['id_youtube'] ?>">
            </span>
        </p>
        <p>
            <label>Mô tả <span style="color:red">*</span></label>
            <span class="field">
                <textarea placeholder="" id="description" name="description" class="mediuminput"><?php echo @$data['description'] ?></textarea>
            </span>
        </p>
        <p>
            <label style="float: none">Mô tả chi tiết</label>
        </p>
        <p>
            <textarea placeholder="" id="description_detail" name="description_detail" class="mediuminput"><?php echo @$data['description_detail'] ?></textarea>
        </p>
    <!--<p>
        <label>Order</label>
        <span class="field">
            <input type="text" placeholder="" id="order_home" name="order" class="mediuminput" value="<?php echo @$data['order'] ?>">
        </span>
    </p>
        <p>
            <label style="float: none">Nội dung</label>
        </p>
        <p>
            <textarea placeholder="" id="content" name="content" class="mediuminput"><?php echo @$data['content'] ?></textarea>
        </p>
        <p>
            <label>Lượt xem</label>
            <span class="field">
                <input type="text" readonly id="view_count" name="view_count" class="mediuminput" value="<?php echo @$data['view_count'] ?>">
            </span>
        </p>-->
        <p>
            <label>Youtube Image (480*360)</label>
            <span class="field">
                <input type="checkbox" placeholder="" id="is_ytimage" name="is_ytimage" class="mediuminput" <?php if (@$data['is_ytimage'] == 1) echo "checked='checked'" ?>> Có
            </span>
        </p>
        <p>
            <label for="image_banner">Image (715*367)</label>
            <span class="field">
                <input type="text" placeholder="Click vào để chọn hình" onclick="openKCFinderFixSize('#image', 715, 367)" readonly id="image" name="image" class="mediuminput" value="<?php echo @$data['image'] ?>">
            </span>
        </p>
        <div style="border: #ddd solid 1px">
            <label>Hot Video</label>
            <span class="field">
                <input type="checkbox" placeholder="" id="hot_video" name="hot_video" class="mediuminput" <?php if (@$data['hot_video'] == 1) echo "checked='checked'" ?>> Active
            </span>
        </div>
        <div style="border: #ddd solid 1px">
            <label>Active Slide</label>
            <span class="field">
                <input type="checkbox" placeholder="" id="active_slide" name="active_slide" class="mediuminput" <?php if (@$data['active_slide'] == 1) echo "checked='checked'" ?>> Active
            </span>
        </div>
        <div style="border: #ddd solid 1px">
            <label>Display Download</label>
            <span class="field">
                <input type="checkbox" placeholder="" id="display_download" name="display_download" class="mediuminput" <?php if (@$data['display_download'] == 1) echo "checked='checked'" ?>> Active
            </span>
        </div>
        <div style="border: #ddd solid 1px">
            <label>Status</label>
            <span class="field">
                <input type="checkbox" placeholder="" id="status" name="status" class="mediuminput" <?php if (@$data['status'] == 1) echo "checked='checked'" ?>> Active
            </span>
        </div>

        <p>
            <label>SEO Keyword</label>
            <span class="field">
                <textarea placeholder="" id="seo_keyword" name="seo_keyword" class="tags mediuminput"><?php echo @$key ?></textarea>
            </span>
        </p>

        <p class="stdformbutton">
            <input id="txt_id" type="hidden" value="<?php echo @$data['id_video'] ?>" name="id_video">
            <input id="id_video_scan" type="hidden" value="<?php echo @$data['id_video'] ?>" name="id_video_scan">
            <button class="submit radius2" type="submit"><?php
                if (!empty($data['id_video']))
                    echo "Đồng Ý";
                else
                    echo "Thêm Mới"
                    ?> </button>
        </p>
    </form>
</div>
<div id="mask-div" style="position: fixed; top: 0px; left: 0px; bottom: 0px; width: 100%; height: 100%; display: none; background: rgba(0, 0, 0, 0.7)">
    <div style="width: 550px; height: 60px; margin: 270px auto; color: #fb9337; text-align: center">
        <img alt="" src="/admin/assets/images/loaders/loader10.gif"><br>
        Vui lòng chờ trong giây lát, hệ thống đang quét keyword để add tag vào nội dung!
    </div>
</div>
<script>
    function openKCFinder(field) {
        window.KCFinder = {
            callBack: function(url) {
                field.setValue(url);
                window.KCFinder = null;
            }
        };
        window.open('/admin/editor/kcfinder/browse.php?type=images&dir=images/public', 'kcfinder_textbox',
                'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
                'resizable=1, scrollbars=0, width=800, height=600'
                );
    }
    $(function() {
        $('#seo_keyword').tagsInput({width: 'auto',
            autocomplete_url: '/backend/ajax/getkeywords',
            autocomplete: {
                source: function(request, response) {
                    $.ajax({
                        url: "/backend/ajax/getkeywords",
                        dataType: "json",
                        data: {
                            keyword: request.term
                        },
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    label: item,
                                    value: item
                                }
                            }));
                        }
                    });
                }
            }
        });

        checkLimitString($('#title'), 0, 70);
        checkLimitString($('#description'), 0, 150);
    });
</script>
