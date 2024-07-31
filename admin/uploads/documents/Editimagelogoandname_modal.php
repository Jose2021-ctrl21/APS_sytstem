      <div class="modal fade" id="edit-imagelandn">
          <div class="modal-dialog modal-sm">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Edit Image</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                     <form enctype="multipart/form-data" method="POST">
                          <div id="msg-landnimg"></div>
                          <div class="form-group">
                              <label>Image:</label>
                              <input type="file" id="img_imglogo" alt="img_imageprofile" class="form-control" >
                          </div>
                  </div>
                  <div class="modal-footer">
                      <input type="hidden" id="img_logonameid" name="">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" id="Edit-imglogoandname">Update</button>
                  </div>
                  </form>
              </div>
          </div>
      </div>
      <script>
          document.addEventListener('DOMContentLoaded', () => {
              let btn = document.querySelector('#Edit-imglogoandname');
              btn.addEventListener('click', () => {

                  const system_logo = document.querySelector('input[id=img_imglogo]').value;
                  const logoname_id = document.querySelector('input[id=img_logonameid]').value;

                  var data = new FormData(this.form);
                   data.append('system_logo', $('#img_imglogo')[0].files[0]);
                   data.append('logoname_id', logoname_id);

                      $.ajax({
                          url: '../config/init/edit_logoandnameimage.php',
                          type: "POST",
                          data: data,
                          processData: false,
                          contentType: false,

                          async: false,
                          cache: false,

                          success: function(data) {
                              $('#msg-landnimg').html(data);

                          },
                          error: function(data) {
                              console.log("Failed");
                          }
                      });
                  //}

              });
          });
      </script>