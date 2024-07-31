
<div class="modal fade" id="createGMessage-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"> Create Message</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
      <div class="modal-body">
       <div class="col-12">
        <div id="mgs-add"></div>
      </div>
      <div class="form-group">
       <label> Select Student</label>
          <select class="form-control" id="fullname" style="width: 100%;">
              <option value="" selected="true"> &larr; Select Student &rarr;</option>
              <?php
               require_once "../config/StudentMonitoring_class.php";
                $conn = new Database();
                $studs = $conn->getStudents($teacherid_session);
               foreach ($studs as $row) { ?>
              <option value="<?php echo $row['Student_name'] ?>"  value_2="<?php echo htmlentities($row['guardian']); ?>"  value_3="<?php echo htmlentities($row['guardian_contact']); ?>" value_4="<?php echo htmlentities($row['student_id']); ?>" value_5="<?php echo htmlentities($row['sGradeLeveID']); ?>" value_6="<?php echo htmlentities($row['sSectionID']); ?>"><?php echo $row['Student_name'] ?></option>
              <?php } ?>
          </select>
          <span class="fname-error"></span>
      </div>
      <div class="form-group">
       <label> Guardian Name</label>
         <input type="text" class="form-control" id="guardian_name" placeholder="Guardian Name..." autocomplete="off" readonly="">
        <span class="gcn-error"></span>
      </div>
      <div class="form-group">
       <label> Guardian Contact Number</label>
         <input type="text" class="form-control" id="guardian_number" minlength="11" maxlength="11" placeholder="Guardian Contact Number..." autocomplete="off" readonly="">
        <span class="gcn-error"></span>
      </div>
       <div class="form-group">
       <label> Message </label>
         <textarea  type="text" class="form-control" id="message" placeholder="Message here..." autocomplete="off"></textarea>
        <span class="smg-error"></span>
      </div>
    
    <div class="form-group">
            <label> Type</label>
            <select class="form-control" id="stud_stat" style="width: 100%;">
                <!-- <option value="Present">Present</option> -->
                <option value="Absent">Absent</option>
            </select>
               <span class="type-error"></span>
        </div>
        </div>
      <div class="modal-footer justify-content-between">
         <input type="hidden" class="form-control" id="gradelevels_id">
         <input type="hidden" class="form-control" id="section_id">
         <input type="hidden" class="form-control" id="student_id">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_gmgs">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
        $("#fullname").on("change",function(){
                    let selValue1 = $("#fullname :selected").attr('value_2');
                    let selValue3 = $("#fullname :selected").attr('value_3');
                    let selValue4 = $("#fullname :selected").attr('value_4');
                    let selValue5 = $("#fullname :selected").attr('value_5');
                    let selValue6 = $("#fullname :selected").attr('value_6');
                    $("#guardian_name").val(selValue1);
                    $("#guardian_number").val(selValue3);
                    $("#student_id").val(selValue4);
                    $("#gradelevels_id").val(selValue5);
                    $("#section_id").val(selValue6);
                         
              });
    });
</script>
<script type="text/javascript">
       document.addEventListener('DOMContentLoaded', () => {
              let btn = document.querySelector('#btn_gmgs');
              btn.addEventListener('click', (e) => {
                e.preventDefault();

                 const fullname = $('#fullname option:selected').val();
                 console.log(fullname);

                  const guardian_name = document.querySelector('input[id=guardian_name]').value;
                  console.log(guardian_name);

                  const guardian_number = document.querySelector('input[id=guardian_number]').value;
                  console.log(guardian_number);

                  const message = document.querySelector('textarea[id=message]').value;
                  console.log(message);

                   const gradelevels_id = document.querySelector('input[id=gradelevels_id]').value;
                  console.log(gradelevels_id);

                   const section_id = document.querySelector('input[id=section_id]').value;
                  console.log(section_id);

                   const student_id = document.querySelector('input[id=student_id]').value;
                  console.log(student_id);
           
                 const stud_stat = $('#stud_stat option:selected').val();
                 console.log(stud_stat);


                  var data = new FormData(this.form);

                
                  data.append('fullname', fullname);
                  data.append('guardian_name', guardian_name);
                  data.append('guardian_number', guardian_number);
                  data.append('message', message);
                  data.append('gradelevels_id', gradelevels_id);
                  data.append('section_id', section_id);
                  data.append('student_id', student_id);
                  data.append('stud_stat', stud_stat);
     
           
             
                   function isValidFullname() {
                          if ($("#fullname").val() === "") {
                              $("#fullname").addClass("is-invalid");
                               $(".fname-error").html('Please Select Name ');
                               $(".fname-error").css({"color":"red","font-size":"14px"});
                              return false;
                          } else {
                              $("#fullname").removeClass("is-invalid").addClass("is-valid");
                              return true;
                          }
                      };

                  function isValidMessage() {
                          if ($("#message").val() === "") {
                              $("#message").addClass("is-invalid");
                               $(".smg-error").html('Please Input Message ');
                               $(".smg-error").css({"color":"red","font-size":"14px"});
                              return false;
                          } else {
                              $("#message").removeClass("is-invalid").addClass("is-valid");
                              return true;
                          }
                      };

                 function isValidType() {
                          if ($("#stud_stat").val() === "") {
                              $("#stud_stat").addClass("is-invalid");
                               $(".type-error").html('Please Select Type ');
                               $(".type-error").css({"color":"red","font-size":"14px"});
                              return false;
                          } else {
                              $("#stud_stat").removeClass("is-invalid").addClass("is-valid");
                              return true;
                          }
                      };


                  isValidFullname();
                  isValidMessage();
                  isValidType();

                 if (isValidFullname() === true && isValidMessage() === true && isValidType() === true){

                       $.ajax({
                        url: '../config/init/add_guardianmessage.php',
                          type: "POST",
                          data: data,
                          processData: false,
                          contentType: false,
                          async: false,
                          cache: false,
                        success: function(response) {
                          $("#mgs-add").html(response);
                          $('#mgs-add').animate({ scrollTop: 0 }, 'slow');
                          },
                          error: function(response) {
                            console.log("Failed");
                          }
                      });
                   }

              });
          });
</script>
  