<script type="text/javascript">
    setActiveMenu('introapp');
    setActiveSubMenu('backend-introapp-add');
</script>
<script type="text/javascript" src="/admin/editor/ckeditor/ckeditor.js"></script>

<script type="text/javascript" src="/admin/assets/js/backend/backend.introapp.input.js?v=3"></script>
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
<div class="pageheader notab" style="border-bottom: none">
    <h1 class="pagetitle">Sửa nội dung</h1>
    <span class="pagedesc"></span>
    <ul class="hornav">
        <li class="current"><a href="#info-game">Sửa nội dung</a></li>        
    </ul>
</div><!--pageheader-->

<div id="contentwrapper" class="contentwrapper lineheight21">
    <div id="info-game" class="subcontent" style="display: block">
        <form class="stdform stdform2" id="frm-add-game" role="form" action="" method="POST" enctype="multipart/form-data">
            <div style="border: #ddd solid 1px">
                <label>Type <span style="color:#ff0000">(*)</span></label>
                <span class="field">
                    <div id="jqxDropdownlistType" name="type"></div>
                    <div id="type" style="color: #ff0000"></div>
                </span>
            </div>               
            <p>
                <label for="icoin">Icoin <span style="color:#ff0000">(*)</span></label>
                <span class="field">
                    <input type="text" placeholder="" id="icoin" name="icoin" class="smallinput" value="<?php echo @$data['icoin'] ?>">
                </span>
            </p>
            <p>
                <label for="content" style="float: none">Content</label>
            </p>
            <p>
                <textarea placeholder="" id="content" name="content" class="mediuminput"><?php echo @$data['content'] ?></textarea>
            </p>      
            <p class="stdformbutton">
                <input id="txt_id" type="hidden" value="<?php echo @$data['id'] ?>" name="id">
                <button class="submit radius2" type="submit">Edit</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/admin/assets/images/loaders/loader10.gif"/></span>
            </p>
        </form>
    </div>   

</div>

<script type="text/javascript">
    var TYPE = '<?php echo @$type ?>';    
</script>
