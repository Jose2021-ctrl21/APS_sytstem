<div class="modal fade" id="createstudent-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"> Create Student</h6>
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
                      
                      <center>
                          <div class="file-uploader">

                              <label name="upload-label" class="upload-img-btn" style="border-style: dashed;">
                                  <input type="file" id="photo" name="photo" class="upload-field-1" style="display:none;" accept="image/*" title="Upload Foto.." />
                                  <img class="preview-1" src="../assets/images/kisspng-computer-icons-user-profile-icon-design-add-to-cart-button-5ad698003f7dd7.4764400015240130562601.jpg" style="width:150px!important;" title="Upload Photo.."  />
                              </label>
                          </div>
                      </center>
                  </div>
         
                    <div class="row mb-1">
                          <div class="col-3">
                            <label> StudentID No.</label>
                            <input type="text" class="form-control" id="student_no" placeholder="Student ID Number..." autocomplete="off">
                            <span class="studIDno-error"></span>
                        </div>
                        <div class="col-3">
                            <label> First Name</label>
                            <input type="text" class="form-control" id="first_name" placeholder="First Name..." autocomplete="off">
                            <span class="firstname-error"></span>
                        </div>
                        <div class="col-3">
                            <label> Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" placeholder="Middle Name (Optional)..." autocomplete="off">
                        </div>
                        <div class="col-3">
                            <label> Last Name</label>
                            <input type="text" class="form-control" id="last_name" placeholder="Last Name..." autocomplete="off">
                            <span class="lastname-error"></span>
                        </div>
                    </div>
                    <div class="row mb-1">
                    
                        <div class="col-4">
                            <label> Contact Number</label>
                            <input type="text" class="form-control" id="contact_number" maxlength="11" placeholder="Contact Number..." autocomplete="off">
                            <span class="cn-error"></span>
                        </div>
                        <div class="col-4">
                            <label> Gender</label>
                            <select class="form-control" id="gender" style="width: 100%;">
                                <option value="" selected="true"> &larr; Select Gender &rarr;</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                               <span class="gender-error"></span>
                        </div>
                       <div class="col-4">

                            <label> Select Grade level</label>
                            <select class="form-control" id="gradelevels_id" style="width: 100%;">
                                <option value="" selected="true"> &larr; Select Grade level &rarr;</option>
                                <?php
                                 require_once "../config/StudentMonitoring_class.php";
                                  $conn = new Database();
                                  $glevels = $conn->getGradeLevels();
                                 foreach ($glevels as $row) { ?>
                                <option value="<?php echo $row['gradelevels_id'] ?>"><?php echo $row['gradelevels_name'] ?></option>
                                <?php } ?>
                            </select>
                               <span class="glevels-error"></span>
                        </div>
                    </div>

                    <div class="row mb-1">
    
                        <div class="col-4">
                            <label> Select Section</label>
                            <select class="form-control" id="section" style="width: 100%;">
                                <option value="" selected="true"> &larr; Select Section &rarr;</option>
                                <?php
                                 require_once "../config/StudentMonitoring_class.php";
                                  $conn = new Database();
                                  $gSec = $conn->getGradeSection();
                                 foreach ($gSec as $row) { ?>
                                <option value="<?php echo $row['section_id'] ?>"><?php echo $row['section_name'] ?></option>
                                <?php } ?>
                            </select>
                               <span class="section-error"></span>
                        </div>

                       <div class="col-4">
                            <label> Select Class Teacher</label>
                            <select class="form-control" id="teacher_id" style="width: 100%;">
                                <option value="" selected="true"> &larr; Select Class Teacher &rarr;</option>
                                <?php
                                 require_once "../config/StudentMonitoring_class.php";
                                  $conn = new Database();
                                  $gTec = $conn->getTeacher();
                                 foreach ($gTec as $row) { ?>
                                <option value="<?php echo $row['teacher_id'] ?>"><?php echo $row['last_name'] .' '.$row['first_name'].', '.$row['middle_name']?></option>
                                <?php } ?>
                            </select>
                               <span class="teacher-error"></span>
                        </div>

                        <div class="col-4">
                            <label> Status</label>
                            <input type="text" class="form-control" id="status" value="Active" autocomplete="off" readonly="">
                            <span class="status-error"></span>
                        </div>
                    </div>
        <!--         </div>
                    <label> Security Question</label>
                    <input type="text" class="form-control" id="section_name" value="" autocomplete="off" readonly="">
                       <span class="sq-error"></span> -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn_studentbtn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        let btn = document.querySelector('#btn_studentbtn');
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            const images = document.querySelector('input[id=photo]').value;
            console.log(images);

            const student_no = document.querySelector('input[id=student_no]').value;
            console.log(student_no);

            const first_name = document.querySelector('input[id=first_name]').value;
            console.log(first_name);

            const middle_name = document.querySelector('input[id=middle_name]').value;
            console.log(middle_name);

            const last_name = document.querySelector('input[id=last_name]').value;
            console.log(last_name);

            const contact_number = document.querySelector('input[id=contact_number]').value;
            console.log(contact_number);

            const gender = $('#gender option:selected').val();
            console.log(gender);

            const gradelevels_id = $('#gradelevels_id option:selected').val();
            console.log(gradelevels_id);

            const section_id = $('#section option:selected').val();
            console.log(section_id);

            const teacher_id = $('#teacher_id option:selected').val();
            console.log(teacher_id);

            const status = document.querySelector('input[id=status]').value;
            console.log(status);


            var data = new FormData(this.form);

            data.append('images', $('#photo')[0].files[0]);
            data.append('student_no', student_no);
            data.append('first_name', first_name);
            data.append('middle_name', middle_name);
            data.append('last_name', last_name);
            data.append('contact_number', contact_number);
            data.append('gender', gender);
            data.append('gradelevels_id', gradelevels_id);
            data.append('section_id', section_id);
            data.append('teacher_id', teacher_id);
            data.append('status', status);
    
    
          function isValidStudentIDNo() {
                if ($("#student_no").val() === "") {
                    $("#student_no").addClass("is-invalid");
                    $(".studIDno-error").html('Please input your Student No.');
                    $(".studIDno-error").css({"color":"red","font-size":"14px"});

                    return false;
                } else {
                    $("#student_no").removeClass("is-invalid").addClass("is-valid");
                    return true;
                }
            };


            function isValidFirstName() {
                if ($("#first_name").val() === "") {
                    $("#first_name").addClass("is-invalid");
                    $(".firstname-error").html('Please input your First Name');
                    $(".firstname-error").css({"color":"red","font-size":"14px"});

                    return false;
                } else {
                    $("#first_name").removeClass("is-invalid").addClass("is-valid");
                    return true;
                }
            };


            function isValidMiddleName() {
               if ($("#middle_name").val() === "" && $("#middle_name").val()) {
                    return false;
                } else {
                    $("#middle_name").removeClass("is-invalid").addClass("is-valid");
                    return true;
                }
            };

            function isValidLastName() {
                if ($("#last_name").val() === "") {
                    $("#last_name").addClass("is-invalid");
                    $(".lastname-error").html('Please input your Last Name');
                    $(".lastname-error").css({"color":"red","font-size":"14px"});

                    return false;
                } else {
                    $("#last_name").removeClass("is-invalid").addClass("is-valid");
                    return true;
                }
            };
   

            function isValidCN() {
                if ($("#contact_number").val() === "") {
                    $("#contact_number").addClass("is-invalid");
                    $(".cn-error").html('Please input Contact No. Atleast 11 digit');
                    $(".cn-error").css({"color":"red","font-size":"14px"});

                    return false;
                } else {
                    $("#contact_number").removeClass("is-invalid").addClass("is-valid");
                    return true;
                }
            };
   

            function isValidGender() {
                if ($("#gender").val() === "") {
                    $("#gender").addClass("is-invalid");
                    $(".gender-error").html('Please select gender');
                    $(".gender-error").css({"color":"red","font-size":"14px"});
                    return false;
                } else {
                    $("#gender").removeClass("is-invalid").addClass("is-valid");
                    return true;
                }
            };

           function isValidGLevels() {
                if ($("#gradelevels_id").val() === "") {
                    $("#gradelevels_id").addClass("is-invalid");
                    $(".glevels-error").html('Please select Grade Levels');
                    $(".glevels-error").css({"color":"red","font-size":"14px"});
                    return false;
                } else {
                    $("#gradelevels_id").removeClass("is-invalid").addClass("is-valid");
                    return true;
                }
            };
        
           function isValidSection() {
                if ($("#section").val() === "") {
                    $("#section").addClass("is-invalid");
                    $(".section-error").html('Please select Section');
                    $(".section-error").css({"color":"red","font-size":"14px"});
                    return false;
                } else {
                    $("#section").removeClass("is-invalid").addClass("is-valid");
                    return true;
                }
            };

           function isValidTeacher() {
                if ($("#teacher_id").val() === "") {
                    $("#teacher_id").addClass("is-invalid");
                    $(".teacher-error").html('Please select Teacher');
                    $(".teacher-error").css({"color":"red","font-size":"14px"});
                    return false;
                } else {
                    $("#teacher_id").removeClass("is-invalid").addClass("is-valid");
                    return true;
                }
            }; 

          function isValidStatus() {
               if ($("#status").val() === "" && $("#status").val()) {
                    return false;
                } else {
                    $("#status").removeClass("is-invalid").addClass("is-valid");
                    return true;
                }
            };
            isValidStudentIDNo();
            isValidFirstName();
            isValidMiddleName();
            isValidLastName();
            isValidCN();
            isValidGender();
            isValidGLevels();
            isValidSection();
            isValidTeacher();
            isValidStatus();


            if (isValidStudentIDNo() === true && isValidFirstName() === true && isValidMiddleName() === true && isValidLastName() === true  &&
                isValidCN() === true && isValidGender() === true  && isValidGLevels() === true && isValidSection() === true &&
                 isValidTeacher() === true && isValidStatus() === true) {

                $.ajax({
                    url: '../config/init/add_student.php',
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                    success: function(response) {
                        $("#mgs-add").html(response);
                        $('#mgs-add').animate({
                            scrollTop: 0
                        }, 'slow');
                    },
                    error: function(response) {
                        console.log("Failed");
                    }
                });
            }

        });
    });
</script>