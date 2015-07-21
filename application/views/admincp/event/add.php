<script type="text/javascript" src="/admin/assets/js/backend/backend.event.input.js"></script>
<script type="text/javascript" src="/admin/assets/libraries/jsdatetimepicker/jquery.datetimepicker.css"></script>
<link rel="stylesheet" href="/admin/assets/libraries/jsdatetimepicker/jquery.datetimepicker.css" />
<script type="text/javascript"></script>
<style>
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
    .cl-criteria{
        margin: 5px 0 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #333333;
    }
    .cl-criteria span{
        display:inline-block;
        border-radius: 20px;
        margin-right: 5px;
        border: 1px solid #ccc;
        width: 20px;
        text-align: center;
    }
    .event-image-box{margin: 5px 0}
</style>
<div class="pageheader notab">
    <h1 class="pagetitle">THÊM / SỬA EVENT </h1>
    <span class="pagedesc"></span>

</div><!--pageheader-->

<div id="contentwrapper" class="contentwrapper lineheight21">
    <form class="stdform stdform2" id="frm-add-event" role="form" action="" method="POST" enctype="multipart/form-data">

        <div style="border: #ddd solid 1px">
            <label>Tên Event <span style="color:#ff0000">(*)</span></label>
            <span class="field">
                <input type="text" placeholder="Nhập vào tên event" id="name" name="name" class="smallinput" value="<?php echo @$data['name'] ?>">
            </span>
        </div>

        <div style="border: #ddd solid 1px; border-top: none">
            <label>Hình Banner <span style="color:#ff0000">(*)</span></label>
            <span class="field">
                <input type="text" placeholder="Click để chọn hình" onclick="openKCFinderByPath('#image_banner', 'images')" readonly="readonly" id="image_banner" name="image_banner" class="smallinput" value="<?php echo @$data['image_banner'] ?>">
            </span>
        </div>

        <div style="border: #ddd solid 1px; border-top:0px">
            <label for="title">Chi tiết event <span style="color:red">*</span>
            </label>
            <div class="field">
                <?php
                $k = 0;
                $event_list = json_decode(@$data['event_list'], true);
                if (empty($event_list) === FALSE) {
                    foreach ($event_list as $key => $val) {
                        ?>
                        <div class="cl-criteria">
                            <div style="margin:5px 0">
                                Ngày/tháng: <input type="text" name="date[]" value="<?php echo @$val['date'] ?>" class="date smallinput" /> * Bỏ trống nếu không muốn hiển thị
                            </div>
                            <select name="type[]" class="type">
                                <option value="article" <?php if ($val['type'] == 'article') echo "selected='selected'" ?>>Article</option>
                                <option value="video" <?php if ($val['type'] == 'video') echo "selected='selected'" ?>>Video</option>
                                <option value="image_slide" <?php if ($val['type'] == 'image_slide') echo "selected='selected'" ?>>Image Slide</option>
                            </select>
                            <button type="button" class="radius2 delevent">Xóa</button>

                            <?php if ($val['type'] == 'article') {
                                ?>
                                <div style="margin-top: 5px;" class="event-hiden event-article">
                                    <input type="text" placeholder="Nhập ID bài viết" name="id_article[]" class="smallinput" value="<?php echo $val['value']['id'] ?>" >
                                    <select name="articletype[]" class="articletype" style="min-width: 10%">
                                        <option value="news" <?php if ($val['value']['type'] == 'news') echo "selected='selected'" ?>>Tin tức</option>
                                        <option value="video" <?php if ($val['value']['type'] == 'video') echo "selected='selected'" ?>>Video</option>
                                        <option value="giftcode" <?php if ($val['value']['type'] == 'giftcode') echo "selected='selected'" ?>>Giftcode</option>
                                    </select>
                                </div>
                                <div style="margin-top: 5px;display: none" class="event-hiden event-video">
                                    <input type="text" placeholder="Nhập ID Youtube" name="id_youtube[]" class="smallinput">
                                    <input type="checkbox" name="" value="0"/> AutoPlay
                                </div>
                                <div style="margin-top: 5px;display: none" class="event-hiden event-slide">
                                    <button type="button" class="radius2 addimageslide">Thêm hình</button>
                                    <div class="hidedom">
                                        <div class="event-image-box">
                                            <input type="text" class="list" placeholder="Click vào để chọn hình" name="list<?php echo $k ?>[]" class="smallinput" onclick="openKCFinder(this)">
                                            <button type="button" class="radius2 delimageslide">Xóa hình</button>
                                        </div>
                                    </div>
                                </div>
                            <?php } else if ($val['type'] == 'video') {
                                ?>
                                <div style="margin-top: 5px;" class="event-hiden event-video">
                                    <input type="text" placeholder="Nhập ID Youtube" name="id_youtube[]" class="smallinput" value="<?php echo $val['value'] ?>">
                                    <input type="checkbox" name="" value="<?php echo @$val['autoplay']; ?>" <?php if (@$val['autoplay'] == 1) echo "checked='checked'" ?>/> AutoPlay
                                </div>
                                <div style="margin-top: 5px;display: none" class="event-hiden event-article">
                                    <input type="text" placeholder="Nhập ID bài viết" name="id_article[]" class="smallinput" >
                                    <select name="articletype[]" class="articletype" style="min-width: 10%">
                                        <option value="news">Tin tức</option>
                                        <option value="video">Video</option>
                                        <option value="giftcode">Giftcode</option>
                                    </select>
                                </div>
                                <div style="margin-top: 5px;display: none" class="event-hiden event-slide">
                                    <button type="button" class="radius2 addimageslide">Thêm hình</button>
                                    <div class="hidedom">
                                        <div class="event-image-box">
                                            <input type="text" class="list" placeholder="Click vào để chọn hình" name="list<?php echo $k ?>[]" class="smallinput" onclick="openKCFinder(this)">
                                            <button type="button" class="radius2 delimageslide">Xóa hình</button>
                                        </div>
                                    </div>
                                </div>
                            <?php } else if ($val['type'] == 'image_slide') {
                                ?>
                                <div style="margin-top: 5px;" class="event-hiden event-slide">
                                    <?php for ($i = 0; $i < count($val['value']); $i++) { ?>
                                        <div class="event-image-box">
                                            <input type="text" class="list" placeholder="Click vào để chọn hình" name="list<?php echo $k ?>[]" class="smallinput" onclick="openKCFinder(this)" value="<?php echo $val['value'][$i]; ?>">
                                            <button type="button" class="radius2 delimageslide">Xóa hình</button>
                                        </div>
                                    <?php } ?>
                                    <button type="button" class="radius2 addimageslide">Thêm hình</button>
                                    <div class="hidedom">
                                        <div class="event-image-box">
                                            <input type="text" class="list" placeholder="Click vào để chọn hình" name="list<?php echo $k ?>[]" class="smallinput" onclick="openKCFinder(this)">
                                            <button type="button" class="radius2 delimageslide">Xóa hình</button>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-top: 5px;display: none" class="event-hiden event-article">
                                    <input type="text" placeholder="Nhập ID bài viết" name="id_article[]" class="smallinput" >
                                    <select name="articletype[]" class="articletype" style="min-width: 10%">
                                        <option value="news">Tin tức</option>
                                        <option value="video">Video</option>
                                        <option value="giftcode">Giftcode</option>
                                    </select>
                                </div>
                                <div style="margin-top: 5px;display: none" class="event-hiden event-video">
                                    <input type="text" placeholder="Nhập ID Youtube" name="id_youtube[]" class="smallinput">
                                    <input type="checkbox" name="" value="0"/> AutoPlay
                                </div>
                            <?php }
                            ?>
                        </div>
                        <?php
                        $k++;
                    }
                }
                ?>
                <button type="button" class="radius2 addevent">Thêm Chi tiết</button>
                <div class="hidedom">
                    <div class="cl-criteria">
                        <div style="margin:5px 0">
                            Ngày/tháng: <input type="text" name="date[]" value="" class="date smallinput" /> * Bỏ trống nếu không muốn hiển thị
                        </div>
                        <select name="type[]" class="type">
                            <option value="article">Article</option>
                            <option value="video">Video</option>
                            <option value="image_slide">Image Slide</option>
                        </select>
                        <button type="button" class="radius2 delevent">Xóa</button>
                        <div style="margin-top: 5px;" class="event-hiden event-article">
                            <input type="text" placeholder="Nhập ID bài viết" name="id_article[]" class="smallinput" >
                            <select name="articletype[]" class="articletype" style="min-width: 10%">
                                <option value="news">Tin tức</option>
                                <option value="video">Video</option>
                                <option value="giftcode">Giftcode</option>
                            </select>
                        </div>
                        <div style="margin-top: 5px;display: none" class="event-hiden event-video">
                            <input type="text" placeholder="Nhập ID Youtube" name="id_youtube[]" class="smallinput">
                            <input type="checkbox" name="" value="0"/> AutoPlay
                        </div>
                        <div style="margin-top: 5px;display: none" class="event-hiden event-slide">
                            <button type="button" class="radius2 addimageslide">Thêm hình</button>
                            <div class="hidedom">
                                <div class="event-image-box">
                                    <input type="text" class="list" placeholder="Click vào để chọn hình" name="" class="smallinput" onclick="openKCFinder(this)">
                                    <button type="button" class="radius2 delimageslide">Xóa hình</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <p class="stdformbutton">
            <input id="id" type="hidden" value="<?php echo @$data['id'] ?>" name="id">
            <button class="submit radius2" type="submit">Add Event</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/admin/assets/images/loaders/loader10.gif"/></span>
        </p>

    </form>				
</div><!--contentwrapper-->

<script type="text/javascript">
    setActiveMenu('event');
    setActiveSubMenu('backend-event-add');
    $(function() {
        $('.addevent').click(function() {
            var _me = $(this);

            _me.before(_me.next().html());
            return false;
        });
        //xoa tieu chi
        $('body .delevent').live('click', function() {
            $(this).parent().remove();
            return false;
        });
        $('body .type').live('change', function() {
            $(this).parent().find('.event-hiden').css({'display': 'none'});
            if ($(this).val() == 'article') {
                $(this).parent().find('.event-article').css({'display': 'block'});
            }
            else if ($(this).val() == 'video') {
                $(this).parent().find('.event-video').css({'display': 'block'});
            }
            else {
                $(this).parent().find('.event-slide').css({'display': 'block'});
            }
        });
        $('body .addimageslide').live('click', function() {
            var count = $('.cl-criteria').length - 2;
            if ($(this).next().find('.list').attr('name') == '')
                $(this).next().find('.list').attr('name', 'list' + (count) + '[]');
            var next = $(this).next();
            $(this).before(next.html());
            return false;
        });
        $('body .delimageslide').live('click', function() {
            $(this).parent().remove();
            return false;
        });
    });

    function openKCFinder(field) {
        window.KCFinder = {
            callBack: function(url) {
                field.value = url;
                window.KCFinder = null;
            }
        };
        window.open('/admin/editor/kcfinder/browse.php?type=images&dir=images/public', 'kcfinder_textbox',
                'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
                'resizable=1, scrollbars=0, width=800, height=600'
                );
    }
</script>

