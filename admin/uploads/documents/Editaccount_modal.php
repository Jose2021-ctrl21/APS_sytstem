
<div class="modal fade" id="editeaccount-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"> Edit Account</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
      <div class="modal-body">
       <div class="col-12">
        <div id="mgs-edit"></div>
      </div>
      <div class="form-group">
      <label> Full Name</label>
        <input type="text" class="form-control" id="edit_fullname" placeholder="Full Name..." autocomplete="off">
      <span class="uname-error"></span>
    </div>
    <div class="form-group">
      <label> Username</label>
        <input type="text" class="form-control" id="edit_username" placeholder="Username..." autocomplete="off">
      <span class="username-error"></span>
    </div>
    <div class="form-group">
      <label> Password</label>
        <input type="password" class="form-control" id="edit_password" placeholder="Password..." autocomplete="off">
      <span class="pass-error"></span>
    </div>
  <div class="form-group">
     <label> Status</label>
        <select class="form-control" id="edit_status" style="width: 100%;">
            <option value="" selected="true"> &larr; Select Status &rarr;</option>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
      <span class="user_roles2-error"></span>
     </div>
  </div>
      <div class="modal-footer">
        <input type="hidden" id="edit_accountid" name="">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_editaccountbtn">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
       document.addEventListener('DOMContentLoaded', () => {
              let btn = document.querySelector('#btn_editaccountbtn');
              btn.addEventListener('click', (e) => {
                e.preventDefault();
    
                  const full_name = document.querySelector('input[id=edit_fullname]').value;
                  console.log(full_name);

                  const username = document.querySelector('input[id=edit_username]').value;
                  console.log(username);

                  const password = document.querySelector('input[id=edit_password]').value;
                  console.log(password);

                  const status = $('#edit_status option:selected').val();
                  console.log(status);

                  const account_id = document.querySelector('input[id=edit_accountid]').value;
                  console.log(account_id);

                  var data = new FormData(this.form);
                
                  data.append('full_name', full_name);
                  data.append('username', username);
                  data.append('password', password);
                  data.append('status', status);
                  data.append('account_id', account_id);
             
                   function isValidUname2() {
                          if ($("#edit_fullname").val() === "") {
                              $("#edit_fullname").addClass("is-invalid");
                               $(".uname2-error").html('Please input Full Name');
                               $(".uname2-error").css({"color":"red","font-size":"14px"});
                              return false;
                          } else {
                              $("#edit_fullname").removeClass("is-invalid").addClass("is-valid");
                              return true;
                          }
                      };

                      function isValidUsername2() {
                          if ($("#edit_username").val() === "") {
                              $("#edit_username").addClass("is-invalid");
                               $(".username2-error").html('Please input Username');
                               $(".username2-error").css({"color":"red","font-size":"14px"});
                              return false;
                          } else {
                              $("#edit_username").removeClass("is-invalid").addClass("is-valid");
                              return true;
                          }
                      };

                      function isValidPass2() {
                          if ($("#edit_password").val() === "") {
                              $("#edit_password").addClass("is-invalid");
                               $(".pass2-error").html('Please input Password');
                               $(".pass2-error").css({"color":"red","font-size":"14px"});
                              return false;
                          } else {
                              $("#edit_password").removeClass("is-invalid").addClass("is-valid");
                              return true;
                          }
                      };

                      function isValidStatus2() {
                         if ($("#edit_status").val() === "" && $("#edit_status").val()) {
                              return false;
                          } else {
                              $("#edit_status").removeClass("is-invalid").addClass("is-valid");
                              return true;
                          }
                      };

                    isValidUname2();
                    isValidUsername2();
                    isValidPass2();
                    isValidStatus2();

                 if (isValidUname2() === true && isValidUsername2() === true && isValidPass2() === true && isValidStatus2() === true){

                       $.ajax({
                        url: '../config/init/edit_account.php',
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
  