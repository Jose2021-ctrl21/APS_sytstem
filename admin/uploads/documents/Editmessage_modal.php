
<div class="modal fade" id="editMessages-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"> Edit Message</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
      <div class="modal-body">
       <div class="col-12">
        <div id="mgs-edit"></div>
      </div>
<!--       <div class="form-group">
       <label> Guardian Contact Number</label>
         <input type="text" class="form-control" id="guardian_number" minlength="11" maxlength="11" placeholder="Guardian Contact Number..." autocomplete="off">
        <span class="gcn-error"></span>
      </div> -->
       <div class="form-group">
       <label> Message </label>
         <textarea  type="text" class="form-control" id="edit_message" placeholder="Custom message for Time In/Out here..." autocomplete="off"></textarea>
        <span class="smg-error"></span>
      </div>
         <div class="form-group">
            <label> Type</label>
            <select class="form-control" id="edit_type" style="width: 100%;">
                <option value="" selected="true"> &larr; Select Type &rarr;</option>
                <option value="Time In">Time In</option>
                <option value="Time Out">Time Out</option>
            </select>
               <span class="type-error"></span>
        </div>
                      
    </div>
      <div class="modal-footer justify-content-between">
        <input type="hidden" id="edit_messageid" name="">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_editsmgbtn">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
       document.addEventListener('DOMContentLoaded', () => {
              let btn = document.querySelector('#btn_editsmgbtn');
              btn.addEventListener('click', (e) => {
                e.preventDefault();
    

                  const message = document.querySelector('textarea[id=edit_message]').value;
                  console.log(message);

                  const type = $('#edit_type option:selected').val();
                  console.log(type);

                  const message_id = document.querySelector('input[id=edit_messageid]').value;
                  console.log(message_id);

                  var data = new FormData(this.form);

                  data.append('message', message);
                  data.append('type', type);
                  data.append('message_id', message_id);

    
  
                   function isValidMessage2() {
                          if ($("#edit_message").val() === "") {
                              $("#edit_message").addClass("is-invalid");
                               $(".smg-error").html('Please input Custom Message');
                               $(".smg-error").css({"color":"red","font-size":"14px"});
                              return false;
                          } else {
                              $("#edit_message").removeClass("is-invalid").addClass("is-valid");
                              return true;
                          }
                      };

                    function isValidType2() {
                            if ($("#edit_type").val() === "") {
                                $("#edit_type").addClass("is-invalid");
                                $(".type-error").html('Please select Type');
                                $(".type-error").css({"color":"red","font-size":"14px"});
                                return false;
                            } else {
                                $("#edit_type").removeClass("is-invalid").addClass("is-valid");
                                return true;
                            }
                        };

                  isValidMessage2();  
                  isValidType2();

                 if ( isValidMessage2() === true && isValidType2() === true){

                       $.ajax({
                        url: '../config/init/edit_message.php',
                          type: "POST",
                          data: data,
                          processData: false,
                          contentType: false,
                          async: false,
                          cache: false,
                        success: function(response) {
                          $("#mgs-edit").html(response);
                          $('#mgs-edit').animate({ scrollTop: 0 }, 'slow');
                          },
                          error: function(response) {
                            console.log("Failed");
                          }
                      });
                   }

              });
          });
</script>
  