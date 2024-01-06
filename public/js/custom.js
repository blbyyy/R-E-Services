$(document).ready(function () {

    //student view application status
    $(".view-details-button").click(function() {
        var id = $(this).data('id');
        console.log(id)
        $.ajax({
            url: '/application/status/' + id, 
            type: 'GET',
            success: function(data) {
                console.log(data.certificate_file);

                $("#research_title").text(data.research_title);
                $("#thesis_type").text(data.thesis_type);
                $("#submission_frequency").text(data.submission_frequency);
                $("#adviser_name").text(data.adviser_name);
                $("#adviser_email").text(data.adviser_email);
                $("#research_specialist").text(data.research_specialist);
                $("#research_staff").text(data.research_staff);
                if (data.status === "Pending") {
                    $("#status").html('<span class="badge border-success border-1 text-success"><h5>Pending</h5></span>');
                } else if (data.status === "Returned") {
                    $("#status").html('<span class="badge border-warning border-1 text-danger"><h5>Returned</h5></span>');
                } else if (data.status === "Passed") {
                    $("#status").html('<span class="badge border-primary border-1 text-primary"><h5>Passed</h5></span>');

                    var pdfLink = $('<a>', {
                        href: "/uploads/pdf/" + encodeURIComponent(data.certificate_file),
                        text: "Download PDF",
                        target: "_blank"
                    });
                    $("#certificate").empty().append(pdfLink);

                    $('#viewInfo').on('hidden.bs.modal', function () {
                        $("#certificate").empty();
                    });


                }
                $("#initial_simmilarity_percentage").text(data.initial_simmilarity_percentage + " %");
                $("#simmilarity_percentage_results").text(data.simmilarity_percentage_results + " %");
                $("#requestor_name").text(data.requestor_name);
                $("#student_id").text(data.tup_id);
                $("#tup_mail").text(data.tup_mail);
                $("#requestor_type").text(data.requestor_type);
                $("#sex").text(data.sex);
                $("#course").text(data.course);
                $("#college").text(data.college);
                $("#researchers_name1").text(data.researchers_name1);
                $("#researchers_name2").text(data.researchers_name2);
                $("#researchers_name3").text(data.researchers_name3);
                $("#researchers_name4").text(data.researchers_name4);
                $("#researchers_name5").text(data.researchers_name5);
                $("#researchers_name6").text(data.researchers_name6);
                $("#researchers_name7").text(data.researchers_name7);
                $("#researchers_name8").text(data.researchers_name8);
            }, 
            error: function (error) {
                console.log(error);
            },
        });
    });

    //show student in studentlist
    $(".studentshowBtn").click(function() {
        var id = $(this).data("id");
        
        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "/studentlist/show/" + id,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) { 
                console.log(data);
                
                if (data.avatar === "avatar.jpg") {
                    $("#student_profile").html('<img src="https://tse4.mm.bing.net/th?id=OIP.sRdQAfzOzF_ZjC3dnAZVSQHaGw&pid=Api&P=0&h=180" class="img-fluid rounded-start" alt="..."></img>');
                } else {
                    $("#student_profile").html('<img src="storage/' + data.avatar + '" class="img-fluid rounded-start" alt="...">');
                }
                $("#student_name").text(data.fname + ' ' + data.lname + ' ' + data.mname);
                $("#student_id").text('TUP ID: ' + data.tup_id);
                $("#student_email").text('Email: ' + data.email);
                $("#student_college").text('College: ' + data.college);
                $("#student_course").text('Course: ' + data.course);
                $("#student_gender").text('Gender: ' + data.gender);
                $("#student_phone").text('Phone Number: ' + data.phone);
                $("#student_address").text('Address: ' + data.address);
                $("#student_birthdate").text('Birthdate: ' + data.birthdate);
                
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //edit student info
    $(".studenteditBtn").click(function() {
        var id = $(this).data("id");
        
        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "/studentlist/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) { 
                console.log(data);
                $('#student_edit_id').val(data.id);
                $('#fname').val(data.fname);
                $('#lname').val(data.lname);
                $('#mname').val(data.mname);
                $('#sid').val(data.tup_id);
                $('#email').val(data.email);
                $('#college').val(data.college);
                $('#course').val(data.course);
                $('#phone').val(data.phone);
                $('#gender').val(data.gender);
                $('#address').val(data.address);
                $('#birthdate').val(data.birthdate);
                
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //update student info
    $(".studentupdateBtn").on("click", function (e) {
        e.preventDefault();
        var id = $("#student_edit_id").val();
        let editformData = new FormData($("#studentinfoform")[0]);
        for(var pair of editformData.entries()){
            console.log(pair[0] + ',' + pair[1]);
        }
        // console.log(editformData)
        $.ajax({
            type: "POST",
            url: "/studentlist/" + id + "/edit/updated",
            data: editformData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                setTimeout(function() {
                    window.location.href = '/studentlist';
                }, 1500);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Student Info Updated',
                    showConfirmButton: false,
                    timer: 1500
                  })
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $(".studentdeleteBtn").on("click", function (e) {
       
        var id = $(this).data("id");
        console.log(id);
        Swal.fire({
            title: 'Are you sure you want to delete this venue?',
            text: "You won't be able to undo this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "DELETE",
                    url: "/api/studentlist/" + id + "/deleted",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        setTimeout(function() {
                            window.location.href = '/studentlist';
                        }, 1500);
                        console.log(data);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                          )
                    },
                    error: function (error) {
                        console.log("error");
                    },
                });

            }
          })

    });

    //show staff user info
    $(".staffshowBtn").click(function() {
        var id = $(this).data("id");
        
        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "/stafflist/show/" + id,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) { 
                console.log(data);
                
                if (data.avatar === "avatar.jpg") {
                    $("#staff_profile").html('<img src="https://tse4.mm.bing.net/th?id=OIP.sRdQAfzOzF_ZjC3dnAZVSQHaGw&pid=Api&P=0&h=180" class="img-fluid rounded-start" alt="..."></img>');
                } else {
                    $("#staff_profile").html('<img src="storage/' + data.avatar + '" class="img-fluid rounded-start" alt="...">');
                }
                $("#staff_name").text(data.fname + ' ' + data.lname + ' ' + data.mname);
                $("#staff_id").text('TUP ID: ' + data.tup_id);
                $("#staff_email").text('Email: ' + data.email);
                $("#staff_position").text('Position: ' + data.position);
                $("#staff_designation").text('Designation: ' + data.designation);
                $("#staff_gender").text('Gender: ' + data.gender);
                $("#staff_phone").text('Phone Number: ' + data.phone);
                $("#staff_address").text('Address: ' + data.address);
                $("#staff_birthdate").text('Birthdate: ' + data.birthdate);
                
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //edit staff user info
    $(".staffeditBtn").click(function() {
        var id = $(this).data("id");
        
        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "/stafflist/" + id + "/edit/",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) { 
                console.log(data.staff_id);
                $('#staff_edit_id').val(data.id);
                $('#fname').val(data.fname);
                $('#lname').val(data.lname);
                $('#mname').val(data.mname);
                $('#staffid').val(data.tup_id);
                $('#email').val(data.email);
                $('#position').val(data.position);
                $('#designation').val(data.designation);
                $('#phone').val(data.phone);
                $('#gender').val(data.gender);
                $('#address').val(data.address);
                $('#birthdate').val(data.birthdate);
                
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //update staff user info
    $(".staffupdateBtn").on("click", function (e) {
        e.preventDefault();
        var id = $("#staff_edit_id").val();
        let editformData = new FormData($("#staffinfoform")[0]);
        for(var pair of editformData.entries()){
            console.log(pair[0] + ',' + pair[1]);
        }
        $.ajax({
            type: "POST",
            url: "/stafflist/" + id + "/edit/updated",
            data: editformData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                // console.log(data);
                setTimeout(function() {
                    window.location.href = '/stafflist';
                }, 1500);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Staff Information Updated',
                    showConfirmButton: false,
                    timer: 1500
                  })
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    //delete staff user
    $(".staffdeleteBtn").on("click", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        console.log(id);
        Swal.fire({
            title: 'Are you sure you want to delete this user?',
            text: "You won't be able to undo this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "DELETE",
                    url: "/api/stafflist/" + id + "/deleted",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        setTimeout(function() {
                            window.location.href = '/stafflist';
                        }, 1500);
                        console.log(data);
                        Swal.fire(
                            'Deleted!',
                            'User has been deleted.',
                            'success'
                          )
                    },
                    error: function (error) {
                        console.log("error");
                    },
                });

            }
          })

    });

    //show faculty user info
    $(".facultyshowBtn").click(function() {
        var id = $(this).data("id");
        
        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "/facultylist/show/" + id,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) { 
                console.log(data);
                
                if (data.avatar === "avatar.jpg") {
                    $("#faculty_profile").html('<img src="https://tse4.mm.bing.net/th?id=OIP.sRdQAfzOzF_ZjC3dnAZVSQHaGw&pid=Api&P=0&h=180" class="img-fluid rounded-start" alt="..."></img>');
                } else {
                    $("#faculty_profile").html('<img src="storage/' + data.avatar + '" class="img-fluid rounded-start" alt="...">');
                }
                $("#faculty_name").text(data.fname + ' ' + data.lname + ' ' + data.mname);
                $("#faculty_id").text('TUP ID: ' + data.tup_id);
                $("#faculty_email").text('Email: ' + data.email);
                $("#faculty_department").text('Department: ' + data.department);
                $("#faculty_position").text('Position: ' + data.position);
                $("#faculty_designation").text('Designation: ' + data.designation);
                $("#faculty_gender").text('Gender: ' + data.gender);
                $("#faculty_phone").text('Phone Number: ' + data.phone);
                $("#faculty_address").text('Address: ' + data.address);
                $("#faculty_birthdate").text('Birthdate: ' + data.birthdate);
                
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //edit staff user info
    $(".facultyeditBtn").click(function() {
        var id = $(this).data("id");
        
        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "/facultylist/" + id + "/edit/",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) { 
                console.log(data);
                $('#faculty_edit_id').val(data.id);
                $('#fname').val(data.fname);
                $('#lname').val(data.lname);
                $('#mname').val(data.mname);
                $('#fid').val(data.tup_id);
                $('#email').val(data.email);
                $('#department').val(data.department);
                $('#position').val(data.position);
                $('#designation').val(data.designation);
                $('#phone').val(data.phone);
                $('#gender').val(data.gender);
                $('#address').val(data.address);
                $('#birthdate').val(data.birthdate);
                
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    //update staff user info
    $(".facultyupdateBtn").on("click", function (e) {
        e.preventDefault();
        var id = $("#faculty_edit_id").val();
        let editformData = new FormData($("#facultyinfoform")[0]);
        for(var pair of editformData.entries()){
            console.log(pair[0] + ',' + pair[1]);
        }
        $.ajax({
            type: "POST",
            url: "/facultylist/" + id + "/edit/updated",
            data: editformData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                setTimeout(function() {
                    window.location.href = '/facultylist';
                }, 1500);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Faculty Information Updated',
                    showConfirmButton: false,
                    timer: 1500
                  })
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    //delete faculty user
    $(".facultydeleteBtn").on("click", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        console.log(id);
        Swal.fire({
            title: 'Are you sure you want to delete this user?',
            text: "You won't be able to undo this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "DELETE",
                    url: "/api/facultylist/" + id + "/deleted",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        setTimeout(function() {
                            window.location.href = '/facultylist';
                        }, 1500);
                        console.log(data);
                        Swal.fire(
                            'Deleted!',
                            'User has been deleted.',
                            'success'
                          )
                    },
                    error: function (error) {
                        console.log("error");
                    },
                });

            }
          })

    });

    //show research info
    $(".researchshowBtn").click(function() {
        var id = $(this).data("id");
        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "/researchlist/show/" + id,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) { 
                console.log(data);
                $("#researchtitle").text(data.research_title);
                $("#researchabstract").text( data.abstract);
                $("#researchdepartment").text( data.department);
                $("#researchcourse").text( data.course);
                $("#facultyadviser1").text(data.faculty_adviser1);
                $("#facultyadviser2").text(data.faculty_adviser2);
                $("#facultyadviser3").text(data.faculty_adviser3);
                $("#facultyadviser4").text(data.faculty_adviser4);
                $("#researchers1").text(data.researcher1);
                $("#researchers2").text(data.researcher2);
                $("#researchers3").text(data.researcher3);
                $("#researchers4").text(data.researcher4);
                $("#researchers5").text(data.researcher5);
                $("#researchers6").text(data.researcher6);
                $("#timeframe").text(data.time_frame);
                $("#datecompletion").text(data.date_completion);      
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    //edit research info
    $(".researcheditBtn").click(function() {
        var id = $(this).data("id");
        
        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "/researchlist/" + id + "/edit/",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) { 
                console.log(data);
                $('#research_edit_id').val(data.id);
                $('#research_title').val(data.research_title);
                $('#abstract').val(data.abstract);
                $('#department').val(data.department);
                $('#course').val(data.course);
                $('#faculty_adviser1').val(data.faculty_adviser1);
                $('#faculty_adviser2').val(data.faculty_adviser2);
                $('#faculty_adviser3').val(data.faculty_adviser3);
                $('#faculty_adviser4').val(data.faculty_adviser4);
                $('#researcher1').val(data.researcher1);
                $('#researcher2').val(data.researcher2);
                $('#researcher3').val(data.researcher3);
                $('#researcher4').val(data.researcher4);
                $('#researcher5').val(data.researcher5);
                $('#researcher6').val(data.researcher6);
                $('#time_frame').val(data.time_frame);
                $('#date_completion').val(data.date_completion);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    //update research info
    $(".researchupdateBtn").on("click", function (e) {
        e.preventDefault();
        var id = $("#research_edit_id").val();
        let editformData = new FormData($("#researchinfoform")[0]);
        for(var pair of editformData.entries()){
            console.log(pair[0] + ',' + pair[1]);
        }
        $.ajax({
            type: "POST",
            url: "/researchlist/" + id + "/edit/updated",
            data: editformData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                setTimeout(function() {
                    window.location.href = '/researchlist';
                }, 1500);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Research Information Updated',
                    showConfirmButton: false,
                    timer: 1500
                  })
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    //delete research info
    $(".researchdeleteBtn").on("click", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        console.log(id);
        Swal.fire({
            title: 'Are you sure you want to delete this research?',
            text: "You won't be able to undo this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "DELETE",
                    url: "/api/researchlist/" + id + "/deleted",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        setTimeout(function() {
                            window.location.href = '/researchlist';
                        }, 1500);
                        console.log(data);
                        Swal.fire(
                            'Deleted!',
                            'Research has been deleted.',
                            'success'
                          )
                    },
                    error: function (error) {
                        console.log(error);
                    },
                });

            }
          })

    });

    //show comments
    $(".commentshowBtn").click(function() {
        var id = $(this).data("id");
    
        $.ajax({
            type: "GET",
            url: "/show/comments/" + id,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function(data) {
                console.log(data);
    
                $('#announcement_id').val(id);
    
                if (data.length === 0) {
                    $('#header').text('No Comments');
                    $("#try").html("<br><p class='text-center'>Be the first to comment on this post.</p>");
                } else {
                    // If comments exist, display them
                    data.forEach(function(item) {
                        $('#header').text('All Comments');
                        var card = $("<div>").addClass("d-flex align-items-center");
                        var cardIcon = $("<div>").addClass("card-icon rounded-circle d-flex align-items-center justify-content-center");
                        var img = $("<img>").attr("style", "width: 50px; height: 40px;").addClass("rounded-circle").attr("src", "https://tse4.mm.bing.net/th?id=OIP.sRdQAfzOzF_ZjC3dnAZVSQHaGw&pid=Api&P=0&h=180").attr("alt", "");
                        var cardContent = $("<div>").addClass("ps-3");
                        var h4 = $("<h4>").text(item.fname + ' ' + item.mname + ' ' + item.lname);
                        var span = $("<span>").attr("style", "font-size: smaller").text("(" + item.role + ")" + " " + item.created_at);
    
                        cardIcon.append(img);
                        cardContent.append(h4, span);
                        card.append(cardIcon, cardContent);
    
                        $("#try").append(card);
                        
                        $("#try").append(
                            "<br>",
                            "<span>" + item.comment_content + "</span>",
                            "<hr>"
                        );
                    });
                }
            },
            error: function(error) {
                console.log(error);
            },
        });
    });
    
    //refresh modal when the modal is close
    $("#showcomments").on("hidden.bs.modal", function () {
        $("#try").html("");
    });

    //add comment 
    $(".addcommentBtn").on("click", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        let editformData = new FormData($("#addcommentform")[0]);
        for(var pair of editformData.entries()){
            console.log(pair[0] + ',' + pair[1]);
        }
        $.ajax({
            type: "POST",
            url: "/add/" + id + "/comment",
            data: editformData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                setTimeout(function() {
                    window.location.href = '/homepage';
                }, 1500);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Comment Sent',
                    showConfirmButton: false,
                    timer: 1500
                  })
            },
            error: function (error) {
                console.log(error);
            },
        });
    });
    
    //student view pdf  
    $(".showpdfinfo").click(function () {
        var id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: "/show/pdf/" + id,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                var pdfUrl = '/uploads/pdf/' + data.research_file;
    
                // Dynamically create an <embed> element
                var embedElement = document.createElement("embed");
                embedElement.setAttribute("src", pdfUrl);
                embedElement.setAttribute("type", "application/pdf");
                embedElement.setAttribute("width", "100%");
                embedElement.setAttribute("height", "600px");
    
                // Replace the existing content of the container with the new <embed> element
                $('#content').text(data.research_title);
                $("#pdf-container").html(embedElement);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    //fetching file id to apply certification
    $(".applycert").click(function() {
        var id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: "/get/file/" + id,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function(data) {
                console.log(id);
    
                $('#research_id').val(id);
    
                // if (data.length === 0) {
                //     $('#header').text('No Comments');
                //     $("#try").html("<br><p class='text-center'>Be the first to comment on this post.</p>");
                // } else {
                //     // If comments exist, display them
                //     data.forEach(function(item) {
                //         $('#header').text('All Comments');
                //         var card = $("<div>").addClass("d-flex align-items-center");
                //         var cardIcon = $("<div>").addClass("card-icon rounded-circle d-flex align-items-center justify-content-center");
                //         var img = $("<img>").attr("style", "width: 50px; height: 40px;").addClass("rounded-circle").attr("src", "https://tse4.mm.bing.net/th?id=OIP.sRdQAfzOzF_ZjC3dnAZVSQHaGw&pid=Api&P=0&h=180").attr("alt", "");
                //         var cardContent = $("<div>").addClass("ps-3");
                //         var h4 = $("<h4>").text(item.fname + ' ' + item.mname + ' ' + item.lname);
                //         var span = $("<span>").attr("style", "font-size: smaller").text("(" + item.role + ")" + " " + item.created_at);
    
                //         cardIcon.append(img);
                //         cardContent.append(h4, span);
                //         card.append(cardIcon, cardContent);
    
                //         $("#try").append(card);
                        
                //         $("#try").append(
                //             "<br>",
                //             "<span>" + item.comment_content + "</span>",
                //             "<hr>"
                //         );
                //     });
                // }
            },
            error: function(error) {
                console.log(error);
            },
        });
    });

    //student applying certification
    $(".applycertification").on("click", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        let editformData = new FormData($("#certificationform")[0]);
        for(var pair of editformData.entries()){
            console.log(pair[0] + ',' + pair[1]);
        }
        $.ajax({
            type: "POST",
            url: "/apply/certification/requested/" + id ,
            data: editformData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                setTimeout(function() {
                    window.location.href = '/apply/certification';
                }, 1500);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Request Sent',
                    showConfirmButton: false,
                    timer: 1500
                  })
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    //admin manipulation for certification
    $(".admincertification").click(function() {
        var id = $(this).data('id');
        console.log(id)
        $.ajax({
            url: '/application/status/certification/' + id, 
            type: 'GET',
            success: function(data) {
                console.log(data);

                $('#file_id').val(id);

                var pdfLink = $('<a>', {
                    href: "/uploads/pdf/" + encodeURIComponent(data.research_file),
                    text: "View PDF",
                    target: "_blank"
                });
                $("#pdf").empty().append(pdfLink);
                
            }, 
            error: function() {
                console.log(error);
            }
        });
    });

    //sending certification
    $(".certificationBtn").on("click", function (e) {
        e.preventDefault();
        // var id = $(this).data("id");
        var id = $("#file_id").val();
        let editformData = new FormData($("#certificationform")[0]);
        for(var pair of editformData.entries()){
            console.log(pair[0] + ',' + pair[1]);
        }
        $.ajax({
            type: "POST",
            url: "/application/status/certification/" + id + "/sent",
            data: editformData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                setTimeout(function() {
                    window.location.href = '/applicationlist';
                }, 1500);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Certification Process Done',
                    showConfirmButton: false,
                    timer: 1500
                  })
            },
            error: function (error) {
                console.log(error);
            },
        });
    });
    
    //delete student file
    $(".filedeleteBtn").on("click", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        console.log(id);
            Swal.fire({
            title: 'Are you sure you want to delete this file?',
            text: "You won't be able to undo this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "DELETE",
                    url: "/api/student/myfiles/" + id + "/deleted",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        setTimeout(function() {
                            window.location.href = '/student/myfiles';
                        }, 1500);
                        console.log(data);
                        Swal.fire(
                            'Deleted!',
                            'File has been deleted.',
                            'success'
                          )
                    },
                    error: function (error) {
                        console.log(error);
                    },
                });

            }
          })

    });

    //delete staff file
    $(".stafffiledeleteBtn").on("click", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        console.log(id);
            Swal.fire({
            title: 'Are you sure you want to delete this file?',
            text: "You won't be able to undo this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "DELETE",
                    url: "/api/staff/myfiles/" + id + "/deleted",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        setTimeout(function() {
                            window.location.href = '/staff/myfiles';
                        }, 1500);
                        console.log(data);
                        Swal.fire(
                            'Deleted!',
                            'File has been deleted.',
                            'success'
                          )
                    },
                    error: function (error) {
                        console.log(error);
                    },
                });

            }
          })

    });

    //staff view pdf  
    $(".staffshowpdfinfo").click(function () {
        var id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: "/staff/show/pdf/" + id,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                var pdfUrl = '/uploads/pdf/' + data.research_file;
    
                // Dynamically create an <embed> element
                var embedElement = document.createElement("embed");
                embedElement.setAttribute("src", pdfUrl);
                embedElement.setAttribute("type", "application/pdf");
                embedElement.setAttribute("width", "100%");
                embedElement.setAttribute("height", "600px");
    
                // Replace the existing content of the container with the new <embed> element
                $('#content').text(data.research_title);
                $("#pdf-container").html(embedElement);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    //staff applying certification
    $(".staffapplycertification").on("click", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        let editformData = new FormData($("#staffcertificationform")[0]);
        for(var pair of editformData.entries()){
            console.log(pair[0] + ',' + pair[1]);
        }
        $.ajax({
            type: "POST",
            url: "/staff/apply/certification/requested/" + id ,
            data: editformData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                setTimeout(function() {
                    window.location.href = '/staff/apply/certification';
                }, 1500);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Request Sent',
                    showConfirmButton: false,
                    timer: 1500
                  })
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    //staff view application status
    $(".staff-view-details-button").click(function() {
        var id = $(this).data('id');
        console.log(id)
        $.ajax({
            url: '/staff/application/status/' + id, 
            type: 'GET',
            success: function(data) {
                console.log(data.certificate_file);

                $("#research_title").text(data.research_title);
                $("#thesis_type").text(data.thesis_type);
                $("#submission_frequency").text(data.submission_frequency);
                $("#adviser_name").text(data.adviser_name);
                $("#adviser_email").text(data.adviser_email);
                $("#research_specialist").text(data.research_specialist);
                $("#research_staff").text(data.research_staff);
                if (data.status === "Pending") {
                    $("#status").html('<span class="badge border-success border-1 text-success"><h5>Pending</h5></span>');
                } else if (data.status === "Returned") {
                    $("#status").html('<span class="badge border-warning border-1 text-danger"><h5>Returned</h5></span>');
                } else if (data.status === "Passed") {
                    $("#status").html('<span class="badge border-primary border-1 text-primary"><h5>Passed</h5></span>');

                    var pdfLink = $('<a>', {
                        href: "/uploads/pdf/" + encodeURIComponent(data.certificate_file),
                        text: "Download PDF",
                        target: "_blank"
                    });
                    $("#certificate").empty().append(pdfLink);

                    $('#viewInfo').on('hidden.bs.modal', function () {
                        $("#staffviewInfo").empty();
                    });


                }
                $("#initial_simmilarity_percentage").text(data.initial_simmilarity_percentage + " %");
                $("#simmilarity_percentage_results").text(data.simmilarity_percentage_results + " %");
                $("#requestor_name").text(data.requestor_name);
                $("#student_id").text(data.tup_id);
                $("#tup_mail").text(data.tup_mail);
                $("#requestor_type").text(data.requestor_type);
                $("#sex").text(data.sex);
                $("#course").text(data.course);
                $("#college").text(data.college);
                $("#researchers_name1").text(data.researchers_name1);
                $("#researchers_name2").text(data.researchers_name2);
                $("#researchers_name3").text(data.researchers_name3);
                $("#researchers_name4").text(data.researchers_name4);
                $("#researchers_name5").text(data.researchers_name5);
                $("#researchers_name6").text(data.researchers_name6);
                $("#researchers_name7").text(data.researchers_name7);
                $("#researchers_name8").text(data.researchers_name8);
            }, 
            error: function (error) {
                console.log(error);
            },
        });
    });
 
    
});