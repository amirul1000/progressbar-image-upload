<?php
  include("../templates/header.php");
?>
<style>
   input[type=file] {
    display: block;
    position: relative !important;
    overflow: none;
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
<table class="table table-bordered table-striped table-condensed flip-content">
 <tr>
  <td>  
        <div align="center" class="caption-subject theme-font-color bold uppercase">General Information</div>
	    <form name="frm_registration" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		   <table class="table table-bordered table-striped table-condensed flip-content">
                 
                              
                                 
                  <tr>
                                     <td nowrap="nowrap"> VAT Paper <font color="#FF0000">*</font></td>
                                     <td>
                                        <!--<input type="file" name="file_mouza_map" id="file_mouza_map"  value="<?=$file_mouza_map?>" class="form-control-static" >-->
                                        
                                          <link href="../Simple-Ajax-Uploader-master/assets/css/styles.css" rel="stylesheet">
                                     
                                          <!--<div class="container">-->                               
                                              <div class="row" style="padding-top:10px;">
                                                <div class="col-xs-2">
                                                  <input type="file" id="uploadBtn1"  value="Choose File" <?php if(empty($vat_file)){echo "required";} ?>>
                                                </div>
                                                <div class="col-xs-10">
                                              <div id="progressOuter1" class="progress progress-striped active" style="display:none;">
                                                <div id="progressBar1" class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                </div>
                                              </div>
                                                </div>
                                              </div>
                                              <div class="row" style="padding-top:10px;">
                                                <div class="col-xs-10">
                                                  <div id="msgBox1">
                                                  </div>
                                                </div>
                                              </div>
                                          <!--</div>-->
                                          <?php
                                             if(isset($Id)) {
                                               $url = 'file_upload.php?id='.$Id;
                                            }
                                            else {
                                                $url = 'file_upload.php';
                                                }
                                          ?>
                                    
                                        <script src="../Simple-Ajax-Uploader-master/SimpleAjaxUploader.js"></script>
                                        <script>
                                        function escapeTags( str ) {
                                          return String( str )
                                                   .replace( /&/g, '&amp;' )
                                                   .replace( /"/g, '&quot;' )
                                                   .replace( /'/g, '&#39;' )
                                                   .replace( /</g, '&lt;' )
                                                   .replace( />/g, '&gt;' );
                                        }
                                        
                                        $(document).ready(function() {
                                         
                                          var btn1 = document.getElementById('uploadBtn1'),
                                              progressBar1 = document.getElementById('progressBar1'),
                                              progressOuter1 = document.getElementById('progressOuter1'),
                                              msgBox1 = document.getElementById('msgBox1');
                                        
                                          var uploader1 = new ss.SimpleUpload({
                                                button: btn1,
                                                url: '<?=$url?>',
                                                sessionProgressUrl: '../Simple-Ajax-Uploader-master/code/sessionProgress.php',
                                                //name: 'uploadfile',
                                                name:'vat_file', 
                                                multipart: true,
                                                hoverClass: 'hover',
                                                focusClass: 'focus',
                                                responseType: 'json',
                                                startXHR: function() {
                                                    progressOuter1.style.display = 'block'; // make progress bar visible           
                                                    this.setProgressBar( progressBar1 );           
                                                },
                                                onSubmit: function() {
                                                    msgBox1.innerHTML = ''; // empty the message box
                                                    btn1.innerHTML = 'Uploading...'; // change button text to "Uploading..."
                                                  },
                                                onComplete: function( filename, response ) {
                                                    //btn.innerHTML = 'Choose Another File';
													$("#uploadBtn1").removeAttr('required');
                                                    btn1.innerHTML = 'Choose File';
                                                    progressOuter1.style.display = 'none'; // hide progress bar when upload is completed
                                        
                                                    if ( !response ) {
                                                        msgBox1.innerHTML = 'Unable to upload file';
                                                        return;
                                                    }
                                        
                                                    if ( response.success === true ) {
                                                        msgBox1.innerHTML = '<strong>' + escapeTags( filename ) + '</strong>' + ' successfully uploaded.';
                                        
                                                    } else {
                                                        if ( response.msg )  {
                                                            msgBox1.innerHTML = escapeTags( response.msg );
                                        
                                                        } else {
                                                            msgBox1.innerHTML = 'An error occurred and the upload failed.';
                                                        }
                                                    }
                                                  },
                                                onError: function() {
                                                    progressOuter1.style.display = 'none';
                                                    msgBox1.innerHTML = 'Unable to upload file';
                                                  }
                                            });
                                            
                                          
                                        });
                                        </script>
                                        
                                         <?php 
                                          if(empty($vat_file))
                                          {
                                            echo "Is file uploaded?  No";
                                          }
                                         else
                                         {
                                           echo "Is file uploaded? Yes";
                                         }
                                        ?>	<br />
                                        
                                        <code><font color="#993333">[N.B. Supported file extension is pdf,png,jpg,jpeg. Example file.jpg]</font></code>
                                     </td>
                                 </tr>               
                        
                                  
                  <tr>
                                     <td nowrap="nowrap"  width="54%">No Objection Certificate (NOC) <font color="#FF0000">*</font></td>
                                     <td>
                                        <!--<input type="file" name="file_approval_doc" id="file_approval_doc"  value="<?=$file_approval_doc?>" class="form-control-static" >-->
                                        <!--<div class="container">-->                               
                                              <div class="row" style="padding-top:10px;">
                                                <div class="col-xs-2">
                                                  <input type="file" id="uploadBtn2"  value="Choose File"   <?php //if(empty($noc_file)){echo "required";} ?>>
                                                </div>
                                                <div class="col-xs-10">
                                              <div id="progressOuter2" class="progress progress-striped active" style="display:none;">
                                                <div id="progressBar2" class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                </div>
                                              </div>
            
                                                </div>
                                              </div>
                                              <div class="row" style="padding-top:10px;">
                                                <div class="col-xs-10">
                                                  <div id="msgBox2">
                                                  </div>
                                                </div>
                                              </div>
                                          <!--</div>-->
                                          <?php
                                             if(isset($Id)) {
                                               $url = 'file_upload.php?id='.$Id;
                                            }
                                            else {
                                                $url = 'file_upload.php';
                                                }
                                          ?>
                                        <script>
                                          // window.onload = function() {
                                        $(document).ready(function() {
                  
                                                  
                                          var btn2 = document.getElementById('uploadBtn2'),
                                              progressBar2 = document.getElementById('progressBar2'),
                                              progressOuter2 = document.getElementById('progressOuter2'),
                                              msgBox2 = document.getElementById('msgBox2');
                                        
                                          var uploader2 = new ss.SimpleUpload({
                                                button: btn2,
                                                url: '<?=$url?>',
                                                sessionProgressUrl: '../Simple-Ajax-Uploader-master/code/sessionProgress.php',
                                                //name: 'uploadfile',
                                                name:'noc_file', 
                                                multipart: true,
                                                hoverClass: 'hover',
                                                focusClass: 'focus',
                                                responseType: 'json',
                                                startXHR: function() {
                                                    progressOuter2.style.display = 'block'; // make progress bar visible           
                                                    this.setProgressBar( progressBar2 );           
                                                },
                                                onSubmit: function() {
                                                    msgBox2.innerHTML = ''; // empty the message box
                                                    btn2.innerHTML = 'Uploading...'; // change button text to "Uploading..."
                                                  },
                                                onComplete: function( filename, response ) {
                                                    //btn.innerHTML = 'Choose Another File';
													$("#uploadBtn2").removeAttr('required');
                                                    btn2.innerHTML = 'Choose File';
                                                    progressOuter2.style.display = 'none'; // hide progress bar when upload is completed
                                        
                                                    if ( !response ) {
                                                        msgBox2.innerHTML = 'Unable to upload file';
                                                        return;
                                                    }
                                        
                                                    if ( response.success === true ) {
                                                        msgBox2.innerHTML = '<strong>' + escapeTags( filename ) + '</strong>' + ' successfully uploaded.';
                                        
                                                    } else {
                                                        if ( response.msg )  {
                                                            msgBox2.innerHTML = escapeTags( response.msg );
                                        
                                                        } else {
                                                            msgBox2.innerHTML = 'An error occurred and the upload failed.';
                                                        }
                                                    }
                                                  },
                                                onError: function() {
                                                    progressOuter2.style.display = 'none';
                                                    msgBox2.innerHTML = 'Unable to upload file';
                                                  }
                                            });
                                         
                                        });
                                        </script>
                                        <?php 
                                          if(empty($noc_file))
                                          {
                                            echo "Is file uploaded?  No";
                                          }
                                         else
                                         {
                                           echo "Is file uploaded? Yes";
                                         }
                                        ?>	<br />
                                        <code><font color="#993333">[N.B. Supported file extension is pdf,png,jpg,jpeg. Example file.jpg]</font></code>
                                     </td>
                                 </tr>
                   <tr>
                         <td valign="top" nowrap="nowrap">Project  <font color="#FF0000">*</font></td>
                         <td>
                            <textarea name="project" id="project"  class="form-control-static" style="width:70%;height:100px;" required><?=$project?></textarea>
                         </td>
                   </tr>
                   <tr> 
                         <td align="right"></td>
                         <td>
                            <input type="hidden" name="cmd" value="add_form1">
                            <input type="hidden" name="id" value="<?=$Id?>">			
                            <input type="submit" name="btn_submit" id="btn_submit" value="Save" class="btn btn-primary">
                         </td>     
                   </tr>
	      </table>
	</form>
  </td>
 </tr>
</table>
</div>
</div>
<?php
 include("../templates/footer.php");
?>  