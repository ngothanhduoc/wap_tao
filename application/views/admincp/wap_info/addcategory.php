<!--<script type="text/javascript" src="/admin/editor/ckeditor/ckeditor.js"></script>-->
<script type="text/javascript" src="/admin/assets/js/backend/backend.game.category.input.js"></script>
<script type="text/javascript" src="/admin/assets/libraries/jqwidgets/jqxradiobutton.js"></script>
<style>
    .fileinput .thumbnail > img {
        display: block;
    }
    .thumbnail > img {
        display: block;
        height: auto;
        margin-left: auto;
        margin-right: auto;
        max-width: 100%;
    }
    div.uploader {
        cursor: default;
        left: 260px;
        overflow: hidden;
        position: absolute;
        top: -50px;
    }
</style>
<div class="pageheader notab">
    <h1 class="pagetitle">Add Category</h1>
    <span class="pagedesc"></span>

</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
    <form class="stdform stdform2" id="frm-add-game-category" role="form" action="" method="POST" enctype="multipart/form-data">

        <p>
            <label for="title">Title <span style="color:#ff0000">(*)</span></label>
            <span class="field">
                <input type="text" placeholder="" id="title" name="title" class="mediuminput" value="<?php echo @$data['title'] ?>">
            </span>
        </p>

        <div style="border: #ddd solid 1px; border-bottom: none">
            <label>Loại <span style="color:#ff0000">(*)</span></label>
            <span class="field" style="height: 25px;  width: 50% !important;">
                <div id="jqxDropdownlistType" name="type" ></div>
                <div id="type" style="color: #ff0000"></div>
            </span>
        </div>   
        <p class="stdformbutton">
            <input id="txt_id" type="hidden" value="<?php echo @$data['id_cate'] ?>" name="id">
            <button class="submit radius2" type="submit">Add Category</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/admin/assets/images/loaders/loader10.gif"/></span>
        </p>

    </form>				
</div><!--contentwrapper-->

<script type="text/javascript">
    setActiveMenu('category');
    setActiveSubMenu('backend-category-add_list_category');

    var TYPE = '<?php echo @$type ?>';
</script>