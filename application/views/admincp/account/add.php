<script type="text/javascript">
    setActiveMenu('account');
    setActiveSubMenu('backend-account-add');
   
    var GROUP_NAME = '<?php echo @$groupName?>';
    var arrGroup = <?php echo @json_encode($arrGroup)?>;
    var arrGroupName = <?php echo @json_encode($arrGroupName)?>;
</script>
<script type="text/javascript" src="/admin/assets/js/backend/backend.account.input.js?v=1"></script>
<script type="text/javascript" src="/admin/assets/js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="/admin/assets/js/custom/forms.js"></script>

<!-----Jcrop image---------->
<script type="text/javascript" src="/admin/assets/js/jcrop/jquery.Jcrop.js"></script>
<link rel="stylesheet" href='/admin/assets/js/jcrop/jquery.Jcrop.css'>
<style>
    #uniform-btn-select-img{
        display: none;
    }
    .btn {
    -moz-user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 3px;
    cursor: pointer;
    display: inline-block;
    font-size: 12px;
    font-weight: 400;
    line-height: 1.42857;
    margin-bottom: 0;
    padding: 6px 12px;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
}
.btn:focus {
    outline: thin dotted #333;
    outline-offset: -2px;
}
.btn:hover, .btn:focus {
    color: #303641;
    outline: medium none;
    text-decoration: none;
}
.btn:active, .btn.active {
    background-image: none;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.2) inset;
    outline: medium none;
}
.btn.disabled, .btn[disabled], fieldset[disabled] .btn {
    box-shadow: none;
    cursor: not-allowed;
    opacity: 0.65;
    pointer-events: none;
}
.label-select-img{
     border: #3f526f solid 1px; width: 80px!important; text-align: center!important; padding: 5px!important; background: #3f526f; color: #fff;
     border-radius: 4px;
     cursor: pointer;
     margin-bottom: 10px;
}
.label-select-img:hover{
    background: #3f529f;
}
</style>  
<?php 
if(isset($_GET['id'])){
    $t = '';
}else{
    $t = '<span style="color:#ff0000">(*)</span>';
}
?>
<div class="pageheader notab">
	<h1 class="pagetitle">Add/Edit Account</h1>
	<span class="pagedesc"></span>
	
</div><!--pageheader-->

<div id="contentwrapper" class="contentwrapper lineheight21">

		<form class="stdform" id="frm-add-account" role="form" action="" method="POST" enctype="multipart/form-data">
		
		
		<div class="stepContainer" style="height: 237px;">
			<div class="formwiz content" id="wiz1step1" style="display: block;">
				<h4>Thông tin User</h4>
                                        
                                        <p>
						<label for="">Group <span style="color:#ff0000">(*)</span></label>
						<span class="field">
                                                    <div id="jqxDropdownlistGroup" name="id_group"></div>
                                                    <div id="id_group" style="color: #ff0000; widows: 400px; margin-left: 220px"></div>
						</span>
					</p>
                                
					<p>
						<label for="username">User Name <span style="color:#ff0000">(*)</span></label>
						<span class="field">
							<input type="text" placeholder="" id="username" name="username" class="mediuminput" value="<?php echo @$data['username']?>">
						</span>
					</p>
					
					<p>
						<label for="full_name">Bút danh <span style="color:#ff0000">(*)</span></label>
						<span class="field">
							<input type="text" placeholder="" id="full_name" name="full_name" class="mediuminput" value="<?php echo @$data['full_name']?>">
						</span>
					</p>
                                        
                                        <p>
						<label for="full_name">Bí danh</label>
						<span class="field">
							<input type="text" placeholder="" id="penname" name="penname" class="mediuminput" value="<?php echo @$data['penname']?>">
						</span>
					</p>
                                        
                                        <p>
						<label for="full_name">Câu nói yêu thích</label>
						<span class="field">
							<textarea id="description" name="description" class="mediuminput"><?php echo @$data['description']?></textarea> 
						</span>
					</p>
													
					<p>
						<label for="password">Password <?php echo $t?></label>
						<span class="field">
							<input type="text" placeholder="" id="password" name="password" class="mediuminput" value="">
						</span>
					</p>
											
										
										
				</div>
			</div>
			 <div class="stepContainer" style="height: 237px">
                            <div class="formwiz content" id="wiz1step1" style="display: block;">
                                    <h4>Cập nhật avatar</h4>
                                        <div data-provides="fileinput" class="fileinput fileinput-new"><input type="hidden" value="" name="...">
				            <img src="/assets/images/upload/fix/<?php echo @$data['avatar']?>" id="cropbox" style="max-width: 700px">
                                            
                                                <br><br><br>
                                                <div style="text-align: center">
                                                        <span class="btn btn-white btn-file">
                                                                <label for="btn-select-img" class="label-select-img">Select image</label>
                                                                <input type="file" accept="image/*" name="ImageFile" id="btn-select-img" style="opacity: 0">
                                                        </span>
                                                       
                                                </div>
                                        </div>
                                    
                            </div>
                        </div>                  
                                           
			<div class="actionBar">
                                <input type="hidden" id="x" name="x" />
                                <input type="hidden" id="y" name="y" />
                                <input type="hidden" id="w" name="w" />
                                <input type="hidden" id="h" name="h" />
                                <input type="hidden" id="filename" name="filename" value="">
				<input id="txt_id" type="hidden" value="<?php echo @$data['id_admin']?>" name="id">
				<button class="submit radius2" type="submit">Add Account</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/admin/assets/images/loaders/loader10.gif"/></span>			
			</div>
				
		</form>
</div>				

<script>
    
$('#checkAll').on('click', function() {
       
    $('.selectedId').attr('checked', $(this).is(":checked"));
    if($(this).is(":checked")){
    $('.selectedId').parent().addClass('checked');
    }else{
    $('.selectedId').parent().removeClass('checked');
    }
});
    
$('#checkA').on('click', function() {
       
    $('.selectedI').attr('checked', $(this).is(":checked"));
    if($(this).is(":checked")){
    $('.selectedI').parent().addClass('checked');
    }else{
    $('.selectedI').parent().removeClass('checked');
    }
});
</script>

<script type="text/javascript">
    var jcrop_api;
    $(function(){
            $('#cropbox').Jcrop({
              aspectRatio: 1,
              onSelect: updateCoords

            },function(){
                    jcrop_api = this;
            });

  });
  function updateCoords(c)
  {
    console.log(c);
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };
    $('input[type=file]').change(function () {
           //$('#loadingg').show();
           var form = new FormData ($('#frm-add-account')[0]);
                    console.log(form);
                    $.ajax({
                            url: '/backend/ajax/updateavatar',
                            type: "POST",
                            processData: false, // Don't process the files
                            contentType: false, 
                            data: form,

                            //beforeSend: BACKEND.startLoading,
                            //complete: BACKEND.topLoading,

                            dataType: "JSON"
                    }).done(function(data) {
                    if (data.code == 0) {
                            var m = data.message;
                            $('#filename').val(m.filename);
                            //window.location.href = data.redirect;
                            if (typeof(jcrop_api) != "undefined") {
                                    jcrop_api.destroy();
                            }
                            var m = data.message;
                            $('#cropbox').attr('style','');
                            $('#cropbox').css({'max-width':'700px','visibility':'visible'});
                            $('#cropbox').attr('src','/assets/images/upload/' + m.filename);

                            setTimeout(function() {
                    $('#cropbox').Jcrop({
                            aspectRatio: 1,
                            setSelect:   [0,0,100,100],
                            onSelect: updateCoords

                          },function(){
                                  jcrop_api = this;
                          });

                          jcrop_api.focus();
                }, 1000);

                    } else {
                            var m = data.message;					
                    }
                            //$('#loadingg').hide();
                });
    });
  </script>