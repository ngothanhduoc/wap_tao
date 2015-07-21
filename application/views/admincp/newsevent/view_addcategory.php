<!--<script src="/layout/backend/assets/js/fileinput.js" id="script-resource-18"></script>-->

<!--<script type="text/javascript" src="/admin/editor/ckeditor/ckeditor.js"></script>-->
<script type="text/javascript" src="/admin/assets/js/backend/backend.newsevent.category.input.js"></script>
<script type="text/javascript">
    setActiveMenu('newsevent');
    setActiveSubMenu('backend-newsevent-addcategory');
    var CAT = <?php echo json_encode(@$parent) ?>;
    var CAT_INDEX = '<?php echo @$catIndex ?>';
    var STATUS = '<?php echo @$status?>';
</script>
<div class="pageheader notab">
    <h1 class="pagetitle">Thêm Danh Mục Tin Tức</h1>
    <span class="pagedesc"></span>

</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
    <form class="stdform stdform2" id="frm-add-category" role="form" action="" method="POST" enctype="multipart/form-data">
        <p>
            <label>Tiêu đề <span style="color:red">*</span></label>
            <span class="field">
                <input type="text" placeholder="" id="title" name="title" class="mediuminput" value="<?php echo @$data['title'] ?>">
            </span>
        </p>

        <p>
            <label>Mô tả</label>
            <span class="field">
                <textarea placeholder="" id="description" name="description" class="mediuminput"><?php echo @$data['description'] ?></textarea>
            </span>
        </p>
        <div style="border: #ddd solid 1px">
            <label>Parent</label>
            <span class="field">
                <div id="jqxDropdownlistCat" name="parent"></div>
                <div id="parent" style="color: #ff0000"></div>
            </span>
        </div>
        <p>
            <label>Order</label>
            <span class="field">
                <input type="text" placeholder="" id="order_home" name="order" class="mediuminput" value="<?php echo @$data['order'] ?>">
            </span>
        </p>
        <p>
            <label>Alias</label>
            <span class="field">
                <input type="text" readonly placeholder="" id="alias" name="alias" class="mediuminput" value="<?php echo @$data['alias'] ?>">
            </span>
        </p>
        <div style="border: #ddd solid 1px">
            <label>Status</label>
            <span class="field">
                <div id="jqxDropdownlistStatus" name="status"></div>
                <div id="status" style="color: #ff0000"></div>
            </span>
        </div>
        <p>
            <label for="image_banner">Icon <!--<span style="color:red">*</span>--></label>
            <span class="field">
                <input type="text" placeholder="Click vào để chọn hình" id="image" name="image" class="mediuminput" value="<?php echo @$data['image'] ?>" onclick="openKCFinderByPath('#image', 'images')" readonly>
            </span>
        </p>
        <p class="stdformbutton">
            <input id="txt_id" type="hidden" value="<?php echo @$data['id_category'] ?>" name="id_category">
            <button class="submit radius2" type="submit"><?php
                if (!empty($data['id_category']))
                    echo "Đồng Ý";
                else
                    echo "Thêm Mới"
                    ?> </button>
        </p>
    </form>
</div>
