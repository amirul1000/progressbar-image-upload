<?php
  include("../templates/header.php");
?>
<style>
   input[type=file] {
    display: block;
    position: relative !important;
    overflow: scroll;
    visibility:visible !important;
}
</style>
<link rel="stylesheet" href="../datepicker/jquery-ui.css">
<script src="../datepicker/jquery-1.10.2.js"></script>
<script src="../datepicker/jquery-ui.js"></script>

<a href="?cmd=list" class="btn btn-primary">List</a><br />
<div align="center"><font color="#FF0000">*</font> Required</div>
<div id="dialog-token-points" title="Token points">
     <p>
         <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        <div id="inner_data_token"></div>
    </p>
</div>
<div id="dialog-prizes-points" title="Prizes points">
    <p>
         <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        <div id="inner_data_prizes"></div>
    </p>
</div>	
<div id="spinner"></div>	

<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-globe"></i>Application form 1</div>
        <!--<div style="float:right;">
        	<a href="member_archive?cmd=list" class="btn default btn-xs blue">Archive</a>
        </div>-->
        
        <div class="tools">
            <a href="javascript:;" class="reload"></a>
            <a href="javascript:;" class="remove"></a>
        </div>
    </div>
<div class="portlet-body flip-scroll">
   <h3> Success</h3>
</div>
</div>
<?php
 include("../templates/footer.php");
?>  