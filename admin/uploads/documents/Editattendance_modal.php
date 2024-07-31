
<div class="modal fade" id="EditAttendance-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"> Edit Status</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
      <div class="modal-body">
       <div class="col-12">
        <div id="mgs-edit"></div>
      </div>
      <label> Select Status</label>
       <select class="form-control" id="edit_studstat" style="width: 100%;">
         <option value=""  selected="true"> &larr; Select Status &rarr;</option>
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
            <option value="Late">Late</option>

         </select>
            <span class="a-error"></span>
        
      </div>
      <div class="modal-footer">
        <input type="hidden" id="edit_attendanceid" name="">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_statbtn">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
       document.addEventListener('DOMContentLoaded', () => {
              let btn = document.querySelector('#btn_statbtn');
              btn.addEventListener('click', (e) => {
                e.preventDefault();

                 const stud_stat = $('#edit_studstat option:selected').val();
                 console.log(stud_stat);
    
                  const attendance_id = document.querySelector('input[id=edit_attendanceid]').value;
                  console.log(attendance_id);

                  var data = new FormData(this.form);

                  data.append('stud_stat', stud_stat);
                  data.append('attendance_id', attendance_id);


                  function isValidStat() {
                          if ($("#edit_studstat").val() === "") {
                              $("#edit_studstat").addClass("is-invalid");
                               $(".a-error").html('Please input your Section Name');
                               $(".a-error").css({"color":"red","font-size":"14px"});
                              return false;
                          } else {
                              $("#edit_studstat").removeClass("is-invalid").addClass("is-valid");
                              return true;
                          }
                      };
                              

                  isValidStat();
  

                 if (isValidStat() === true){

                       $.ajax({
                        url: '../config/init/edit_attendanceReport.php',
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
  