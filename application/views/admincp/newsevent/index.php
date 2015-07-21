
<script type="text/javascript" src="/admin/assets/js/backend/backend.newsevent.js"></script>


<div class="pageheader notab">
    <h1 class="pagetitle">Danh sách tin tức</h1>
    <span class="pagedesc"></span>

</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
    <div id="jqxgrid"></div>				
</div><!--contentwrapper-->
<?php
$user_data = $this->session->userdata('user_info');
?>
<input type="hidden" id="userdata" value="<?php echo $user_data['id_group'] ?>" />
<input type="hidden" id="userid" value="<?php echo $user_data['id_admin'] ?>" />
<script type="text/javascript">
    setActiveMenu('newsevent');
    setActiveSubMenu('backend-newsevent-index');
    var arrGame = <?php echo json_encode(@$arrGame) ?>;
</script>