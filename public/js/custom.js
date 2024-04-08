$(document).ready(function () {

    //START ADMIN POV
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

        //delete student info
        $(".studentdeleteBtn").on("click", function (e) {
        
            var id = $(this).data("id");
            console.log(id);
            Swal.fire({
                title: 'Are you sure you want to delete this student?',
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
                                'Student has been deleted.',
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

        //edit faculty user info
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

        //update faculty user info
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

                    if (data.faculty_adviser1 !== null) {
                        $("#a1").show();
                        $("#facultyadviser1").text(data.faculty_adviser1);
                    } else {
                        $("#a1").hide();
                    }
                    if (data.faculty_adviser2 !== null) {
                        $("#a2").show();
                        $("#facultyadviser2").text(data.faculty_adviser2);
                    } else {
                        $("#a2").hide();
                    }
                    if (data.faculty_adviser3 !== null) {
                        $("#a3").show();
                        $("#facultyadviser3").text(data.faculty_adviser3);
                    } else {
                        $("#a3").hide();
                    }
                    if (data.faculty_adviser4 !== null) {
                        $("#a4").show();
                        $("#facultyadviser4").text(data.faculty_adviser4);
                    } else {
                        $("#a4").hide();
                    }

                    if (data.researcher1 !== null) {
                        $("#r1").show();
                        $("#researchers1").text(data.researcher1);
                    } else {
                        $("#r1").hide();
                    }
                    if (data.researcher2 !== null) {
                        $("#r2").show();
                        $("#researchers2").text(data.researcher2);
                    } else {
                        $("#r2").hide();
                    }
                    if (data.researcher3 !== null) {
                        $("#r3").show();
                        $("#researchers3").text(data.researcher3);
                    } else {
                        $("#r3").hide();
                    }
                    if (data.researcher4 !== null) {
                        $("#r4").show();
                        $("#researchers4").text(data.researcher4);
                    } else {
                        $("#r4").hide();
                    }
                    if (data.researcher5 !== null) {
                        $("#r5").show();
                        $("#researchers5").text(data.researcher5);
                    } else {
                        $("#r5").hide();
                    }
                    if (data.researcher6 !== null) {
                        $("#r6").show();
                        $("#researchers6").text(data.researcher6);
                    } else {
                        $("#r6").hide();
                    }

                    $("#timeframe").text(data.time_frame);
                    $("#datecompletion").text(data.date_completion);;      
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
                    $('#researchEditId').val(data.id);
                    $('#researchTitle').val(data.research_title);
                    $('#abstracts').val(data.abstract);
                    $('#dept').val(data.department);
                    $('#researchCourse').val(data.course);
                    $('#facultyAdviser1').val(data.faculty_adviser1);
                    $('#facultyAdviser2').val(data.faculty_adviser2);
                    $('#facultyAdviser3').val(data.faculty_adviser3);
                    $('#facultyAdviser4').val(data.faculty_adviser4);
                    $('#Researcher1').val(data.researcher1);
                    $('#Researcher2').val(data.researcher2);
                    $('#Researcher3').val(data.researcher3);
                    $('#Researcher4').val(data.researcher4);
                    $('#Researcher5').val(data.researcher5);
                    $('#Researcher6').val(data.researcher6);
                    $('#timeFrame').val(data.time_frame);
                    $('#dateCompletion').val(data.date_completion);
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //update research info
        $(".researchupdateBtn").on("click", function (e) {
            e.preventDefault();
            var id = $("#researchEditId").val();
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

        //admin manipulation for certification
        $(".adminCertification").click(function() {
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

        //admin sending certification
        $("#certificationBtn").on("click", function (e) {
            e.preventDefault();
            // var id = $(this).data("id");
            var id = $("#file_id").val();
            let editformData = new FormData($("#certificationForm")[0]);
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

        //admin show specific certificate for tracking
        $(".showCertificate").click(function() {
            var id = $(this).data('id');
            console.log(id)
            $.ajax({
                url: '/certificate/tracking/' + id, 
                type: 'GET',
                success: function(data) {
                    console.log(data);

                    if (data.requestor_type === 'Faculty') {
                        $("#t1").hide();
                        $("#t2").hide();
                        $("#s1").hide();
                        $("#s2").hide();
                        $("#c1").hide();
                    } else {
                        $("#t1").show();
                        $("#t2").show();
                        $("#s1").show();
                        $("#s2").show();
                        $("#c1").show();
                        $("#course").text(data.course);
                        $("#technicalAdviser").text(data.TechnicalAdviserName);
                        $("#taEmail").text(data.technicalAdviserEmail);
                        $("#subjectAdviser").text(data.SubjectAdviserName);
                        $("#saEmail").text(data.subjectAdviserEmail);
                    }

                    $("#research_title").text(data.research_title);
                    $("#thesis_type").text(data.thesis_type);
                    $("#submission_frequency").text(data.submission_frequency);
                    $("#adviser_name").text(data.adviser_name);
                    $("#adviser_email").text(data.adviser_email);
                    $("#control_id").text(data.control_id);

                    if (data.research_specialist === null) {
                        $("#research_specialist").text('tba');
                    } else {
                        $("#research_specialist").text(data.research_specialist);
                    }

                    if (data.research_staff === null) {
                        $("#research_staff").text('tba');
                    } else {
                        $("#research_staff").text(data.research_staff);
                    }

                    if (data.status === "Pending") {
                        $("#status").html('<span class="badge border-success border-1 text-success"><h5>Pending</h5></span>');
                    } else if (data.status === "Returned") {
                        $("#status").html('<span class="badge border-warning border-1 text-danger"><h5>Returned</h5></span>');
                    } else if (data.status === "Passed") {
                        $("#status").html('<span class="badge border-primary border-1 text-primary"><h5>Passed</h5></span>');
                    }

                    $("#initial_simmilarity_percentage").text(data.initial_simmilarity_percentage + " %");
                    $("#simmilarity_percentage_results").text(data.simmilarity_percentage_results + " %");
                    $("#requestor_name").text(data.requestor_name);
                    $("#requestor_id").text(data.tup_id);
                    $("#email").text(data.tup_mail);
                    $("#requestor_type").text(data.requestor_type);
                    $("#sex").text(data.sex);
                    $("#college").text(data.college);

                    if (data.researchers_name1 !== null) {
                        $("#r1").show();
                        $("#researchers_name1").text(data.researchers_name1);
                    } else {
                        $("#r1").hide();
                    }
                    if (data.researchers_name2 !== null) {
                        $("#r2").show();
                        $("#researchers_name2").text(data.researchers_name2);
                    } else {
                        $("#r2").hide();
                    }
                    if (data.researchers_name3 !== null) {
                        $("#r3").show();
                        $("#researchers_name3").text(data.researchers_name3);
                    } else {
                        $("#r3").hide();
                    }
                    if (data.researchers_name4 !== null) {
                        $("#r4").show();
                        $("#researchers_name4").text(data.researchers_name4);
                    } else {
                        $("#r4").hide();
                    }
                    if (data.researchers_name5 !== null) {
                        $("#r5").show();
                        $("#researchers_name5").text(data.researchers_name5);
                    } else {
                        $("#r5").hide();
                    }
                    if (data.researchers_name6 !== null) {
                        $("#r6").show();
                        $("#researchers_name6").text(data.researchers_name6);
                    } else {
                        $("#r6").hide();
                    }
                    if (data.researchers_name7 !== null) {
                        $("#r7").show();
                        $("#researchers_name7").text(data.researchers_name7);
                    } else {
                        $("#r7").hide();
                    }
                    if (data.researchers_name8 !== null) {
                        $("#r8").show();
                        $("#researchers_name8").text(data.researchers_name8);
                    } else {
                        $("#r8").hide();
                    }
                }, 
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //edit department info
        $(".departmenteditBtn").click(function() {
            var id = $(this).data("id");
            
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/admin/departmentlist/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $('#department_edit_id').val(data.id);
                    $('#dept_name').val(data.department_name);
                    $('#dept_code').val(data.department_code);
                },
                error: function (error) {
                    console.log("error");
                },
            });
        });

        //update department info
        $(".departmentupdateBtn").on("click", function (e) {
            e.preventDefault();
            var id = $("#department_edit_id").val();
            let editformData = new FormData($("#departmentinfoform")[0]);
            for(var pair of editformData.entries()){
                console.log(pair[0] + ',' + pair[1]);
            }
            // console.log(editformData)
            $.ajax({
                type: "POST",
                url: "/admin/departmentlist/" + id + "/updated",
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
                        window.location.href = '/admin/departmentlist';
                    }, 1500);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Department Info Updated',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //delete department info
        $(".departmentdeleteBtn").on("click", function (e) {
            var id = $(this).data("id");
            console.log(id);
            Swal.fire({
                title: 'Are you sure you want to delete this department?',
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
                        url: "/api/admin/departmentlist/" + id + "/deleted",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            setTimeout(function() {
                                window.location.href = '/admin/departmentlist';
                            }, 1500);
                            console.log(data);
                            Swal.fire(
                                'Deleted!',
                                'Department has been deleted.',
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

        //edit administration
        $(".editAdministrationBtn").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/administration/" + id + "/edit",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data.staff_id);
                    $('#administrationId').val(data.id);
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

        //update administration
        $(".administrationUpdateBtn").on("click", function (e) {
            e.preventDefault();
            var id = $("#administrationId").val();
            let editformData = new FormData($("#editAdministrationForm")[0]);
            for(var pair of editformData.entries()){
                console.log(pair[0] + ',' + pair[1]);
            }
            $.ajax({
                type: "POST",
                url: "/administration/" + id + "/edit/updated",
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
                        window.location.href = '/administration';
                    }, 1500);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Administration Info Updated',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

         //delete administrator
         $(".deleteAdministrationBtn").on("click", function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            console.log(id);
            Swal.fire({
                title: 'Are you sure you want to delete this administrator?',
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
                        url: "/api/administrator/" + id + "/deleted",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            setTimeout(function() {
                                window.location.href = '/administration';
                            }, 1500);
                            console.log(data);
                            Swal.fire(
                                'Deleted!',
                                'Administrator has been deleted.',
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

        //edit administration role
        $(".roleChangeBtn").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/administration/edit/" + id + "/role",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data.user_id);
                    $('#roleId').val(data.user_id);
                    $('#role').val(data.role);
                },
                error: function (error) {
                    console.log("error");
                },
            });
        });

        //update administration role
        $(".roleUpdateBtn").on("click", function (e) {
            e.preventDefault();
            var id = $("#roleId").val();
            let editformData = new FormData($("#changeRoleForm")[0]);
            for(var pair of editformData.entries()){
                console.log(pair[0] + ',' + pair[1]);
            }
            $.ajax({
                type: "POST",
                url: "/administration/edit/" + id + "/role/updated",
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
                        window.location.href = '/administration';
                    }, 1500);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Administration Role Changed',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //show userlist info
        $(".userlistShowBtn").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/admin/userlist/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    
                    if (data.avatar === "avatar.jpg") {
                        $("#userProfile").html('<img src="https://tse4.mm.bing.net/th?id=OIP.sRdQAfzOzF_ZjC3dnAZVSQHaGw&pid=Api&P=0&h=180" class="img-fluid rounded-start" alt="..."></img>');
                    } else {
                        $("#userProfile").html('<img src="storage/' + data.avatar + '" class="img-fluid rounded-start" alt="...">');
                    }

                    $("#userName").text(data.fname + ' ' + data.mname + ' ' + data.lname);
                    $("#userID").text( data.tup_id);
                    $("#userEmail").text( data.email);
                    $("#userCollege").text( data.college);
                    $("#userCourse").text(data.course);
                    $("#userPosition").text( data.position);
                    $("#userDesignation").text( data.designation);
                    $("#userDepartment").text( data.department_name);
                    $("#userGender").text(data.gender);
                    $("#userPhone").text(data.phone);
                    $("#userAddress").text(data.address);
                    $("#userBirthdate").text(data.birthdate);   

                    $('#showUserInfo').on('hidden.bs.modal', function () {
                        $("#userCollege").text('');
                        $("#userCourse").text('');
                        $("#userPosition").text('');
                        $("#userDesignation").text('');
                        $("#userDepartment").text('');
                    });
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //edit userlist info
        $(".editUserBtn").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/admin/userlist/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);

                    $("#userEditId").val(data.id);
                    $("#fname").val(data.fname);
                    $("#mname").val(data.mname);
                    $("#lname").val(data.lname);
                    $("#tup_id").val(data.tup_id);
                    $("#email").val( data.email);
                    $("#college").val(data.college);
                    $("#course").val(data.course);
                    $("#position").val(data.position);
                    $("#designation").val(data.designation);

                    if (data.role === "Student") {
                        $("#positionForm").hide();
                        $("#designationForm").hide();
                        $("#collegeForm").show();
                        $("#courseForm").show();
                    } else if (data.role === "Faculty") {
                        $("#positionForm").show();
                        $("#designationForm").show();
                        $("#collegeForm").hide();
                        $("#courseForm").hide();
                    }

                    $("#gender").val(data.gender);
                    $("#phone").val(data.phone);
                    $("#address").val(data.address);
                    $("#birthdate").val(data.birthdate);   

                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //update userlist info
        $(".userUpdateBtn").on("click", function (e) {
            e.preventDefault();
            var id = $("#userEditId").val();
            let editformData = new FormData($("#userInfoForm")[0]);
            for(var pair of editformData.entries()){
                console.log(pair[0] + ',' + pair[1]);
            }
            $.ajax({
                type: "POST",
                url: "/admin/userlist/" + id + "/update",
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
                        window.location.href = '/admin/userlist';
                    }, 1500);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'User Info Updated',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //delete userlist info
        $(".deleteUserBtn").on("click", function (e) {
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
                        url: "/api/admin/userlist/" + id + "/deleted",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            setTimeout(function() {
                                window.location.href = '/admin/userlist';
                            }, 1500);
                            console.log(data);
                            Swal.fire(
                                'Deleted!',
                                'User has been deleted.',
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

        //show appliacationlist info
        $(".applicationlistShowBtn").click(function() {
            var id = $(this).data('id');
            console.log(id)
            $.ajax({
                url: '/admin/applicationlist/' + id, 
                type: 'GET',
                success: function(data) {
                    console.log(data);

                    if (data.requestor_type === 'Faculty') {
                        $("#t1").hide();
                        $("#t2").hide();
                        $("#s1").hide();
                        $("#s2").hide();
                        $("#c1").hide();
                    } else {
                        $("#t1").show();
                        $("#t2").show();
                        $("#s1").show();
                        $("#s2").show();
                        $("#c1").show();
                        $("#course").text(data.course);
                        $("#technicalAdviser").text(data.TechnicalAdviserName);
                        $("#taEmail").text(data.technicalAdviserEmail);
                        $("#subjectAdviser").text(data.SubjectAdviserName);
                        $("#saEmail").text(data.subjectAdviserEmail);
                    }

                    $("#research_title").text(data.research_title);
                    $("#thesis_type").text(data.thesis_type);
                    $("#submission_frequency").text(data.submission_frequency);
                    $("#adviser_name").text(data.adviser_name);
                    $("#adviser_email").text(data.adviser_email);

                    if (data.control_id === null) {
                        $("#controlId").hide();
                    } else {
                        $("#controlId").show();
                        $("#control_id").text(data.control_id);
                    }
                    
                    if (data.research_specialist === null) {
                        $("#research_specialist").text('tba');
                    } else {
                        $("#research_specialist").text(data.research_specialist);
                    }

                    if (data.research_staff === null) {
                        $("#research_staff").text('tba');
                    } else {
                        $("#research_staff").text(data.research_staff);
                    }

                    if (data.status === "Pending") {
                        $("#status").html('<span class="badge border-success border-1 text-success"><h5>Pending</h5></span>');
                    } else if (data.status === "Returned") {
                        $("#status").html('<span class="badge border-warning border-1 text-danger"><h5>Returned</h5></span>');
                    } else if (data.status === "Passed") {
                        $("#status").html('<span class="badge border-primary border-1 text-primary"><h5>Passed</h5></span>');
                    }

                    $("#initial_simmilarity_percentage").text(data.initial_simmilarity_percentage + " %");
                    $("#simmilarity_percentage_results").text(data.simmilarity_percentage_results + " %");
                    $("#requestor_name").text(data.requestor_name);
                    $("#requestor_id").text(data.tup_id);
                    $("#email").text(data.tup_mail);
                    $("#requestor_type").text(data.requestor_type);
                    $("#sex").text(data.sex);
                    $("#college").text(data.college);

                    if (data.researchers_name1 !== null) {
                        $("#r1").show();
                        $("#researchers_name1").text(data.researchers_name1);
                    } else {
                        $("#r1").hide();
                    }
                    if (data.researchers_name2 !== null) {
                        $("#r2").show();
                        $("#researchers_name2").text(data.researchers_name2);
                    } else {
                        $("#r2").hide();
                    }
                    if (data.researchers_name3 !== null) {
                        $("#r3").show();
                        $("#researchers_name3").text(data.researchers_name3);
                    } else {
                        $("#r3").hide();
                    }
                    if (data.researchers_name4 !== null) {
                        $("#r4").show();
                        $("#researchers_name4").text(data.researchers_name4);
                    } else {
                        $("#r4").hide();
                    }
                    if (data.researchers_name5 !== null) {
                        $("#r5").show();
                        $("#researchers_name5").text(data.researchers_name5);
                    } else {
                        $("#r5").hide();
                    }
                    if (data.researchers_name6 !== null) {
                        $("#r6").show();
                        $("#researchers_name6").text(data.researchers_name6);
                    } else {
                        $("#r6").hide();
                    }
                    if (data.researchers_name7 !== null) {
                        $("#r7").show();
                        $("#researchers_name7").text(data.researchers_name7);
                    } else {
                        $("#r7").hide();
                    }
                    if (data.researchers_name8 !== null) {
                        $("#r8").show();
                        $("#researchers_name8").text(data.researchers_name8);
                    } else {
                        $("#r8").hide();
                    }
                }, 
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //delete applicationlist info
        $(".deleteApplicationBtn").on("click", function (e) {
            var id = $(this).data("id");
            console.log(id);
            Swal.fire({
                title: 'Are you sure you want to delete this application?',
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
                        url: "/api/admin/applicationlist/" + id + "/deleted",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            setTimeout(function() {
                                window.location.href = '/admin/applicationlist';
                            }, 1500);
                            console.log(data);
                            Swal.fire(
                                'Deleted!',
                                'Application has been deleted.',
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

        //show researchlist info
        $(".showResearchInfoBtn").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/admin/researchlist/" + id,
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

                    if (data.faculty_adviser1 !== null) {
                        $("#a1").show();
                        $("#facultyadviser1").text(data.faculty_adviser1);
                    } else {
                        $("#a1").hide();
                    }
                    if (data.faculty_adviser2 !== null) {
                        $("#a2").show();
                        $("#facultyadviser2").text(data.faculty_adviser2);
                    } else {
                        $("#a2").hide();
                    }
                    if (data.faculty_adviser3 !== null) {
                        $("#a3").show();
                        $("#facultyadviser3").text(data.faculty_adviser3);
                    } else {
                        $("#a3").hide();
                    }
                    if (data.faculty_adviser4 !== null) {
                        $("#a4").show();
                        $("#facultyadviser4").text(data.faculty_adviser4);
                    } else {
                        $("#a4").hide();
                    }

                    if (data.researcher1 !== null) {
                        $("#r1").show();
                        $("#researchers1").text(data.researcher1);
                    } else {
                        $("#r1").hide();
                    }
                    if (data.researcher2 !== null) {
                        $("#r2").show();
                        $("#researchers2").text(data.researcher2);
                    } else {
                        $("#r2").hide();
                    }
                    if (data.researcher3 !== null) {
                        $("#r3").show();
                        $("#researchers3").text(data.researcher3);
                    } else {
                        $("#r3").hide();
                    }
                    if (data.researcher4 !== null) {
                        $("#r4").show();
                        $("#researchers4").text(data.researcher4);
                    } else {
                        $("#r4").hide();
                    }
                    if (data.researcher5 !== null) {
                        $("#r5").show();
                        $("#researchers5").text(data.researcher5);
                    } else {
                        $("#r5").hide();
                    }
                    if (data.researcher6 !== null) {
                        $("#r6").show();
                        $("#researchers6").text(data.researcher6);
                    } else {
                        $("#r6").hide();
                    }

                    $("#timeframe").text(data.time_frame);
                    $("#datecompletion").text(data.date_completion);      
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //delete researchlist info
        $(".deleteResearchBtn").on("click", function (e) {
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
                        url: "/api/admin/researchlist/" + id + "/deleted",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            setTimeout(function() {
                                window.location.href = '/admin/researchlist';
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

        //preparing to send access file for the student
        $(".studentProcessAccessRequest").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/student-research-access-requests/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $("#researchTitle").text("'" + data.research_title + "'"); 
                    $("#purpose").text("'" + data.purpose + "'"); 
                    $("#requestId").val(id); 
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //preparing to send access file for the faculty
        $(".facultyProcessAccessRequest").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/faculty-research-access-requests/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $("#researchTitle").text("'" + data.research_title + "'"); 
                    $("#purpose").text("'" + data.purpose + "'"); 
                    $("#requestId").val(id); 
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //admin approval an proposal consultation appointment
        $(".processAppointmentProposal").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/appointments/proposal/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $("#appointmentId1").val(data.appointmentId);
                    $("#extensionId1").val(data.id);
                    $("#requestor1").text(data.requestor_name);
                    $("#date1").text(data.date);
                    $("#time1").text(data.time);
                    $("#purpose1").text(data.purpose);
                    $("#status1").text(data.status);

                    if (data.status === 'Appointment Pending' ) {
                        $('option[value="Appointment Done"]').prop('disabled', true);
                    } else {
                        $('option[value="Appointment Cancelled"]').prop('disabled', true);
                        $('option[value="Appointment Set"]').prop('disabled', true);
                    }
                    
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //admin approval an implementation-proper appointment
        $(".processAppointmentImplementationProper").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/appointments/implentation-proper/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $("#appointmentId2").val(data.appointmentId);
                    $("#extensionId2").val(data.id);
                    $("#requestor2").text(data.requestor_name);
                    $("#date2").text(data.date);
                    $("#time2").text(data.time);
                    $("#purpose2").text(data.purpose); 
                    $("#status2").text(data.status);

                    if (data.status === 'Appointment Pending' ) {
                        $('option[value="Appointment Done"]').prop('disabled', true);
                    } else {
                        $('option[value="Appointment Cancelled"]').prop('disabled', true);
                        $('option[value="Appointment Set"]').prop('disabled', true);
                    }
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //admin approval an pre-survey consultation appointment
        $(".processAppointmentPreSurvey").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/appointments/pre-survey/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $("#appointmentId3").val(data.appointmentId);
                    $("#extensionId3").val(data.id);
                    $("#requestor3").text(data.requestor_name);
                    $("#date3").text(data.date);
                    $("#time3").text(data.time);
                    $("#purpose3").text(data.purpose);
                    $("#status3").text(data.status); 

                    if (data.status === 'Appointment Pending' ) {
                        $('option[value="Appointment Done"]').prop('disabled', true);
                    } else {
                        $('option[value="Appointment Cancelled"]').prop('disabled', true);
                        $('option[value="Appointment Set"]').prop('disabled', true);
                    }
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //admin approval an mid-survey consultation appointment
        $(".processAppointmentMidSurvey").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/appointments/mid-survey/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $("#appointmentId4").val(data.appointmentId);
                    $("#extensionId4").val(data.id);
                    $("#requestor4").text(data.requestor_name);
                    $("#date4").text(data.date);
                    $("#time4").text(data.time);
                    $("#purpose4").text(data.purpose); 
                    $("#status4").text(data.status);

                    if (data.status === 'Appointment Pending' ) {
                        $('option[value="Appointment Done"]').prop('disabled', true);
                    } else {
                        $('option[value="Appointment Cancelled"]').prop('disabled', true);
                        $('option[value="Appointment Set"]').prop('disabled', true);
                    }
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //admin process an proposal1
        $(".processProposal1").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/admin/extension/proposalList/proposal2/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $("#proposalId1").val(data.id);
                    $("#requestor").text(data.requestor_name);
                    $("#beneficiary").text(data.beneficiary);
    
                    var pdfLink = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.mou_file),
                        text: "View PDF",
                        target: "_blank"
                    });
                    $("#mou_file").empty().append(pdfLink);
                   
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //admin process an proposal2
        $(".processProposal2").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/admin/extension/proposalList/proposal2/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $("#proposalId2").val(data.id);
                    $("#proposal2Requestor").text(data.requestor_name);
                    $("#proposal2Title").text(data.title);
                    $("#proposal2Status").text(data.status); 

                    var mou = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.mou_file),
                        text: "MOA (Memorandum of Understanding)",
                        target: "_blank"
                    });
                    $("#proposal2Mou").empty().append(mou);

                    var ppmp = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.ppmp_file),
                        text: "PPMP (Project Procurement Management Plan)", 
                        target: "_blank"
                    });
                    $("#proposal2Ppmp").empty().append(ppmp);

                    var pr = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.pr_file),
                        text: "PR (Purchase Request)",
                        target: "_blank"
                    });
                    $("#proposal2Pr").empty().append(pr);

                    var marketStudy = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.market_study_file),
                        text: "Request for Qoutation/Market Study",
                        target: "_blank"
                    });
                    $("#proposal2MarketStudy").empty().append(marketStudy);
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //admin process an proposal3
        $(".processProposal3").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/admin/extension/proposalList/proposal3/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $("#proposalId3").val(data.id);
                    $("#proposal3Requestor").text(data.requestor_name);
                    $("#proposal3Title").text(data.title);
                    $("#proposal3Status").text(data.status);

                    var mou = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.mou_file),
                        text: "MOA (Memorandum of Understanding)",
                        target: "_blank"
                    });
                    $("#proposal3Mou").empty().append(mou);

                    var ppmp = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.ppmp_file),
                        text: "PPMP (Project Procurement Management Plan)", 
                        target: "_blank"
                    });
                    $("#proposal3Ppmp").empty().append(ppmp);

                    var pr = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.pr_file),
                        text: "PR (Purchase Request)",
                        target: "_blank"
                    });
                    $("#proposal3Pr").empty().append(pr);

                    var marketStudy = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.market_study_file),
                        text: "Request for Qoutation/Market Study",
                        target: "_blank"
                    });
                    $("#proposal3MarketStudy").empty().append(marketStudy);
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //admin process an proposal4
        $(".processProposal4").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/admin/extension/proposalList/proposal4/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $("#proposalId4").val(data.id);
                    $("#proposal4Requestor").text(data.requestor_name);
                    $("#proposal4Title").text(data.title);
                    $("#proposal4Status").text(data.status);

                    var mou = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.mou_file),
                        text: "MOA (Memorandum of Understanding)",
                        target: "_blank"
                    });
                    $("#proposal4Mou").empty().append(mou);

                    var ppmp = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.ppmp_file),
                        text: "PPMP (Project Procurement Management Plan)", 
                        target: "_blank"
                    });
                    $("#proposal4Ppmp").empty().append(ppmp);

                    var pr = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.pr_file),
                        text: "PR (Purchase Request)",
                        target: "_blank"
                    });
                    $("#proposal4Pr").empty().append(pr);

                    var marketStudy = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.market_study_file),
                        text: "Request for Qoutation/Market Study",
                        target: "_blank"
                    });
                    $("#proposal4MarketStudy").empty().append(marketStudy);
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //admin process an proposal5
        $(".processProposal5").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/admin/extension/proposalList/proposal5/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $("#proposalId5").val(data.id);
                    $("#proposal5Requestor").text(data.requestor_name);
                    $("#proposal5Title").text(data.title);
                    $("#proposal5Status").text(data.status);

                    var mou = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.mou_file),
                        text: "MOA (Memorandum of Understanding)",
                        target: "_blank"
                    });
                    $("#proposal5Mou").empty().append(mou);

                    var ppmp = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.ppmp_file),
                        text: "PPMP (Project Procurement Management Plan)", 
                        target: "_blank"
                    });
                    $("#proposal5Ppmp").empty().append(ppmp);

                    var pr = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.pr_file),
                        text: "PR (Purchase Request)",
                        target: "_blank"
                    });
                    $("#proposal5Pr").empty().append(pr);

                    var marketStudy = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.market_study_file),
                        text: "Request for Qoutation/Market Study",
                        target: "_blank"
                    });
                    $("#proposal5MarketStudy").empty().append(marketStudy);
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //admin process an proposal6
        $(".processProposal6").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/admin/extension/proposalList/proposal6/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $("#proposalId6").val(data.id);
                    $("#proposal6Requestor").text(data.requestor_name);
                    $("#proposal6Title").text(data.title);
                    $("#proposal6Status").text(data.status);

                    var mou = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.mou_file),
                        text: "MOA (Memorandum of Understanding)",
                        target: "_blank"
                    });
                    $("#proposal6Mou").empty().append(mou);

                    var ppmp = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.ppmp_file),
                        text: "PPMP (Project Procurement Management Plan)", 
                        target: "_blank"
                    });
                    $("#proposal6Ppmp").empty().append(ppmp);

                    var pr = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.pr_file),
                        text: "PR (Purchase Request)",
                        target: "_blank"
                    });
                    $("#proposal6Pr").empty().append(pr);

                    var marketStudy = $('<a>', {
                        href: "/uploads/extension/" + encodeURIComponent(data.market_study_file),
                        text: "Request for Qoutation/Market Study",
                        target: "_blank"
                    });
                    $("#proposal6MarketStudy").empty().append(marketStudy);
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

         //admin process an proposal7
         $(".processProposal7").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/admin/extension/proposalList/proposal7/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $("#proposalId7").val(data.id);
                    $("#proposal7Requestor").text(data.requestor_name);
                    $("#proposal7Status").text(data.status);
                    $("#proposal7ImplementationProper").text(data.implementation_proper);

                    if (data.proponents1 === null) {
                        $("#p1").hide();
                    } else {
                        $("#p1").show();
                        $("#proposal7Proponent1").text(data.proponents1);
                    }

                    if (data.proponents2 === null) {
                        $("#p2").hide();
                    } else {
                        $("#p2").show();
                        $("#proposal7Proponent2").text(data.proponents2);
                    }

                    if (data.proponents3 === null) {
                        $("#p3").hide();
                    } else {
                        $("#p3").show();
                        $("#proposal7Proponent3").text(data.proponents3);
                    }

                    if (data.proponents4 === null) {
                        $("#p4").hide();
                    } else {
                        $("#p4").show();
                        $("#proposal7Proponent4").text(data.proponents4);
                    }

                    if (data.proponents5 === null) {
                        $("#p5").hide();
                    } else {
                        $("#p5").show();
                        $("#proposal7Proponent5").text(data.proponents5);
                    }
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //admin view research proposal status
        $(".processResearchProposal").click(function() {
            var id = $(this).data("id");
            console.log(id);
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/admin/research-proposal/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data)

                    $('#proposalId').val(id);
                    $('#researchProposalTitle').text(data.title);
                    $('#researchProposalType').text(data.research_type);

                    if (data.status === "Pending R&E Office Approval") {
                        $("#researchProposalStatus").html('<h5><span class="badge bg-warning">Pending R&E Office Approval</span></h5>');
                    } else if (data.status === "Research Proposal Approved By R&E Office") {
                        $("#researchProposalStatus").html('<h5><span class="badge bg-success">Research Proposal Approved By R&E Office</span></h5>');
                    } 

                    var pdfLink = $('<a>', {
                        href: "/uploads/researchProposal/" + encodeURIComponent(data.proposal_file),
                        text: "Download File",
                        target: "_blank"
                    });
                    $("#pdfFile").empty().append(pdfLink);
                    
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });
    //END OF ADMIN POV

    //START OF STUDENT POV
        //student view pdf  
        $(".studentshowpdfinfo").click(function () {
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
                    $("#pdf-container").html(embedElement);
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //delete student own file
        $(".studentfiledeleteBtn").on("click", function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            console.log(id);
                Swal.fire({
                title: 'Are you sure you want to delete this file',
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

        //student file history
        $(".studentfilehistory").click(function () {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/student/show/history/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function (data) {
                    console.log(data);

                    if (data.history.length === 0) {
                        $("#studenttitle").empty();
                        $("#studentmessage").empty();

                        var tbody = $("#studenthistoryTable tbody");
                        tbody.empty(); 

                        $("#studentmessage").html("<br><p class='text-center'>No certification procedure exists.</p>");
                    } else {
                        $("#studenttitle").empty();
                        $("#studentmessage").empty();
                        
                        var researchTitle = data.title ? data.title.research_title : null;
                        $("#studenttitle").text(researchTitle);

                        var tbody = $("#studenthistoryTable tbody");
                        tbody.empty(); 

                        data.history.forEach(function (entry) {
                            var color;
                            switch (entry.status) {
                                case "Passed":
                                    color = "blue";
                                    break;
                                case "Returned":
                                    color = "red";
                                    break;
                                case "Pending":
                                    color = "orange";
                                    break;
                                case "Pending Technical Adviser Approval":
                                    color = "orange";
                                    break;
                                case "Pending Subject Adviser Approval":
                                        color = "orange";
                                        break;
                                case "Reject By Technical Adviser":
                                            color = "red";
                                            break;
                                case "Reject By Subject Adviser":
                                            color = "red";
                                            break;
                                default:
                                    color = "black";
                            }
                            var row = '<tr>' +
                            '<th scope="row">' + entry.submission_frequency + '</th>' +
                            '<td>' + entry.date + '</td>' +
                            '<td>' + (entry.date_processing_end === null ? 'tba' : entry.date_processing_end) + '</td>' +
                            '<td style="color: ' + color + ';">' + entry.status + '</td>' +
                            '<td>' + entry.initial_simmilarity_percentage + '%' + '</td>' +
                            '<td>' + entry.simmilarity_percentage_results + '%' + '</td>' +
                            '</tr>';

                            tbody.append(row);
                        });

                    }

                },
                error: function (error) {
                    console.log(error);
                },
            });
        });
        
        //student fetching file id to apply certification
        $(".applyGetId").click(function() {
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
        
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });

        //student applying certification
        $("#studentApplyCertification").on("click", function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            let editformData = new FormData($("#studentApplyCertificationForm")[0]);
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
                        html: '<p>Thanks for using our system! Your feedback means a lot to us as we aim to improve our services on campus</p>' 
                        + '<img class="img" src="/assets/img/CustomerSatisfaction.png" alt="" style="width: 250px; height: auto;">',
                    })
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //student fetching file id to re-apply certification
        $(".reApplyGetId").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/student/reapply/get/file/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    console.log(id);
        
                    $('#reApplyResearchId').val(id);
        
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });

        //student re-apply certification
        $(".studentReApplyCertification").on("click", function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            console.log(id)
            let editformData = new FormData($("#studentReApplyCertificationForm")[0]);
            for(var pair of editformData.entries()){
                console.log(pair[0] + ',' + pair[1]);
            }
            $.ajax({
                type: "POST",
                url: "/student/re-apply/certification/requested/" + id ,
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
                        html: '<p>Thanks for using our system! Your feedback means a lot to us as we aim to improve our services on campus</p>' 
                        + '<img class="img" src="/assets/img/CustomerSatisfaction.png" alt="" style="width: 250px; height: auto;">',
                    })
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });
        
        //student view application status
        $(".studentViewDetails").click(function() {
            var id = $(this).data('id');
            console.log(id)
            $.ajax({
                url: '/application/status/' + id, 
                type: 'GET',
                success: function(data) {
                    console.log(data);

                    $("#research_title").text(data.research_title);
                    $("#thesis_type").text(data.thesis_type);
                    $("#submission_frequency").text(data.submission_frequency);
                    $("#technical_adviser").text(data.TechnicalAdviserName);
                    $("#taEmail").text(data.technicalAdviserEmail);
                    $("#subject_adviser").text(data.SubjectAdviserName);
                    $("#saEmail").text(data.subjectAdviserEmail);

                    if (data.research_specialist === null) {
                        $("#research_specialist").text('tba');
                    } else {
                        $("#research_specialist").text(data.research_specialist);
                    }

                    if (data.research_staff === null) {
                        $("#research_staff").text('tba');
                    } else {
                        $("#research_staff").text(data.research_staff);
                    }

                    if (data.status === "Pending") {
                        $("#status").html('<span class="badge border-success border-1 text-warning"><h5>Pending</h5></span>');
                    } else if (data.status === "Returned") {
                        $("#status").html('<span class="badge border-warning border-1 text-danger"><h5>Returned</h5></span>');
                    } else if (data.status === "Pending Technical Adviser Approval") {
                        $("#status").html('<span class="badge border-warning border-1 text-warning"><h5>Pending Technical Adviser Approval</h5></span>');
                    } else if (data.status === "Pending Subject Adviser Approval") {
                        $("#status").html('<span class="badge border-warning border-1 text-warning"><h5>Pending Subject Adviser Approval</h5></span>');
                    } else if (data.status === "Passed") {
                        $("#status").html('<span class="badge border-primary border-1 text-success"><h5>Passed</h5></span>');
                    }
                    $("#remarks").text(data.remarks);
                    $("#initial_simmilarity_percentage").text(data.initial_simmilarity_percentage + " %");
                    $("#simmilarity_percentage_results").text(data.simmilarity_percentage_results + " %");
                    $("#requestor_name").text(data.requestor_name);
                    $("#student_id").text(data.tup_id);
                    $("#tup_mail").text(data.tup_mail);
                    $("#requestor_type").text(data.requestor_type);
                    $("#sex").text(data.sex);
                    $("#course").text(data.course);
                    $("#college").text(data.college);

                    if (data.researchers_name1 !== null) {
                        $("#r1").show();
                        $("#researchers_name1").text(data.researchers_name1);
                    } else {
                        $("#r1").hide();
                    }
                    if (data.researchers_name2 !== null) {
                        $("#r2").show();
                        $("#researchers_name2").text(data.researchers_name2);
                    } else {
                        $("#r2").hide();
                    }
                    if (data.researchers_name3 !== null) {
                        $("#r3").show();
                        $("#researchers_name3").text(data.researchers_name3);
                    } else {
                        $("#r3").hide();
                    }
                    if (data.researchers_name4 !== null) {
                        $("#r4").show();
                        $("#researchers_name4").text(data.researchers_name4);
                    } else {
                        $("#r4").hide();
                    }
                    if (data.researchers_name5 !== null) {
                        $("#r5").show();
                        $("#researchers_name5").text(data.researchers_name5);
                    } else {
                        $("#r5").hide();
                    }
                    if (data.researchers_name6 !== null) {
                        $("#r6").show();
                        $("#researchers_name6").text(data.researchers_name6);
                    } else {
                        $("#r6").hide();
                    }
                    if (data.researchers_name7 !== null) {
                        $("#r7").show();
                        $("#researchers_name7").text(data.researchers_name7);
                    } else {
                        $("#r7").hide();
                    }
                    if (data.researchers_name8 !== null) {
                        $("#r8").show();
                        $("#researchers_name8").text(data.researchers_name8);
                    } else {
                        $("#r8").hide();
                    }
                }, 
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //student view application turnitin proof photos
        $(".turnitinPhotos").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                url: "/student/application/turnitin-proof-photos/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data)

                    if (data == '') { 
                        $('#carouselTurnitinProofPhotos').hide();
                        $('#noTurnitinProofPhotos').show();
                    } else {
                        $('#carouselTurnitinProofPhotos').show();
                        $('#noTurnitinProofPhotos').hide();
                        data.forEach(function(item, index) {
                            var imageName = item.img_path; 
                            var imageUrl = '/images/turnitinProofs/' + imageName;
                            
                            var carouselItem = document.createElement("div");
                            carouselItem.classList.add("carousel-item");
                            
                            if (index === 0) {
                                carouselItem.classList.add("active");
                            }
                            
                            var img = document.createElement("img");
                            img.src = imageUrl;
                            img.classList.add("d-block", "w-100");
                            img.alt = "Slide " + (index + 1);
                            
                            carouselItem.appendChild(img);
                            
                            document.querySelector("#turnitin").appendChild(carouselItem);
                        });
                    }

                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //refresh modal when the modal is close
        $("#turnitinPhotos").on("hidden.bs.modal", function () {
            function clearCarouselItems() {
                var carouselInner = document.querySelector("#turnitin");
                carouselInner.innerHTML = ''; // Clear all inner HTML
            }

            clearCarouselItems();
        });

        //if modal is hidden or close it will refresh 
        $('#studentViewInfo').on('hidden.bs.modal', function () {
            $("#certificate").empty();
        });

        //student viewing research info & requesting access
        $(".studentRequestAccessBtn").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/student/research/" + id + "/request-access",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);

                    $("#researchId").val(id);

                    if (data.status == null) {
                        $("#ResearchInfo").hide(); 
                        $("#processingRequest").hide();
                        $("#rejectRequest").hide();
                        $("#requestExpired").hide(); 
                        $("#accessDeneid").show();
                    } else if (data.status == 'Pending') {
                        $("#ResearchInfo").hide();
                        $("#accessDeneid").hide();
                        $("#rejectRequest").hide();
                        $("#requestExpired").hide(); 
                        $("#processingRequest").show();
                    } else if (data.status == 'Rejected') {
                        $("#ResearchInfo").hide();
                        $("#accessDeneid").hide();
                        $("#processingRequest").hide();
                        $("#requestExpired").hide(); 
                        $("#rejectRequest").show();
                    } else {
                        var currentDate = new Date(); 
                        var endDate = new Date(data.end_access_date); 

                        if (endDate.toDateString() === currentDate.toDateString() || endDate < currentDate) {
                            $("#accessDeneid").hide();
                            $("#processingRequest").hide();
                            $("#rejectRequest").hide();
                            $("#ResearchInfo").hide(); 
                            $("#requestExpired").show(); 
                        } else {
                            $("#accessDeneid").hide();
                            $("#processingRequest").hide();
                            $("#rejectRequest").hide();
                            $("#requestExpired").hide(); 
                            $("#ResearchInfo").show(); 

                            $("#endAccessDate").text(data.end_access_date);
                            $("#researchtitle").text(data.research_title);
                            $("#researchabstract").text( data.abstract);
                            $("#researchdepartment").text( data.department);
                            $("#researchcourse").text( data.course);

                            if (data.faculty_adviser1 !== null) {
                                $("#a1").show();
                                $("#facultyadviser1").text(data.faculty_adviser1);
                            } else {
                                $("#a1").hide();
                            }
                            if (data.faculty_adviser2 !== null) {
                                $("#a2").show();
                                $("#facultyadviser2").text(data.faculty_adviser2);
                            } else {
                                $("#a2").hide();
                            }
                            if (data.faculty_adviser3 !== null) {
                                $("#a3").show();
                                $("#facultyadviser3").text(data.faculty_adviser3);
                            } else {
                                $("#a3").hide();
                            }
                            if (data.faculty_adviser4 !== null) {
                                $("#a4").show();
                                $("#facultyadviser4").text(data.faculty_adviser4);
                            } else {
                                $("#a4").hide();
                            }

                            if (data.researcher1 !== null) {
                                $("#r1").show();
                                $("#researchers1").text(data.researcher1);
                            } else {
                                $("#r1").hide();
                            }
                            if (data.researcher2 !== null) {
                                $("#r2").show();
                                $("#researchers2").text(data.researcher2);
                            } else {
                                $("#r2").hide();
                            }
                            if (data.researcher3 !== null) {
                                $("#r3").show();
                                $("#researchers3").text(data.researcher3);
                            } else {
                                $("#r3").hide();
                            }
                            if (data.researcher4 !== null) {
                                $("#r4").show();
                                $("#researchers4").text(data.researcher4);
                            } else {
                                $("#r4").hide();
                            }
                            if (data.researcher5 !== null) {
                                $("#r5").show();
                                $("#researchers5").text(data.researcher5);
                            } else {
                                $("#r5").hide();
                            }
                            if (data.researcher6 !== null) {
                                $("#r6").show();
                                $("#researchers6").text(data.researcher6);
                            } else {
                                $("#r6").hide();
                            }

                            $("#timeframe").text(data.time_frame);
                            $("#datecompletion").text(data.date_completion);

                        }
                        
                    }
                    
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //if modal is hidden or close it will refresh 
        $('#studentRequestAccess').on('hidden.bs.modal', function () {
            $("#ResearchInfo").hide(); 
            $("#processingRequest").hide();
            $("#rejectRequest").hide();
            $("#requestExpired").hide(); 
            $("#accessDeneid").hide();
            $("#requestAccessForm").hide();
            $("#requestAccessForm")[0].reset();
        });
    //END OF STUDENT POV

    //START OF STAFF POV
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

        //staff file history
        $(".stafffilehistory").click(function () {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/staff/show/history/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function (data) {
                    console.log(data);

                    if (data.history.length === 0) {
                        $("#stafftitle").empty();
                        $("#staffmessage").empty();

                        var tbody = $("#staffhistoryTable tbody");
                        tbody.empty(); 

                        $("#staffmessage").html("<br><p class='text-center'>No certification procedure exists.</p>");
                    } else {
                        $("#stafftitle").empty();
                        $("#staffmessage").empty();
                        
                        var researchTitle = data.title ? data.title.research_title : null;
                        $("#stafftitle").text(researchTitle);

                        var tbody = $("#staffhistoryTable tbody");
                        tbody.empty(); 

                        data.history.forEach(function (entry) {
                            var color;
                            switch (entry.status) {
                                case "Passed":
                                    color = "blue";
                                    break;
                                case "Returned":
                                    color = "red";
                                    break;
                                case "Pending":
                                    color = "orange";
                                    break;
                                default:
                                    color = "black";
                            }
                            var row = '<tr>' +
                            '<th scope="row">' + entry.submission_frequency + '</th>' +
                                '<td>' + entry.date + '</td>' +
                                '<td>' + entry.date_processing_end + '</td>' +
                                '<td style="color: ' + color + ';">' + entry.status + '</td>' +
                                '<td>' + entry.initial_simmilarity_percentage + '%' + '</td>' +
                                '<td>' + entry.simmilarity_percentage_results + '%' + '</td>' +
                                '</tr>';
                            tbody.append(row);
                        });

                    }

                },
                error: function (error) {
                    console.log(error);
                },
            });
        });
        
        //staff fetching file id to apply certification
        $(".staffApplyGetId").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/staff/get/file/" + id,
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

        //staff applying certification
        $(".staffApplyCertification").on("click", function (e) {
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
                        html: '<p>Thanks for using our system! Your feedback means a lot to us as we aim to improve our services on campus</p>' 
                        + '<img class="img" src="/assets/img/CustomerSatisfaction.png" alt="" style="width: 250px; height: auto;">',
                    })
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //staff fetching file id to re-apply certification
        $(".staffReApplyGetId").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/staff/reapply/get/file/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    console.log(id);
        
                    $('#reApplyResearchId').val(id);
        
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });

        //staff re-apply certification
        $(".staffReApplyCertification").on("click", function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            console.log(id)
            let editformData = new FormData($("#staffReApplyCertificationForm")[0]);
            for(var pair of editformData.entries()){
                console.log(pair[0] + ',' + pair[1]);
            }
            $.ajax({
                type: "POST",
                url: "/staff/re-apply/certification/requested/" + id ,
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
                        html: '<p>Thanks for using our system! Your feedback means a lot to us as we aim to improve our services on campus</p>' 
                        + '<img class="img" src="/assets/img/CustomerSatisfaction.png" alt="" style="width: 250px; height: auto;">',
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
                    }
                    $("#initial_simmilarity_percentage").text(data.initial_simmilarity_percentage + " %");
                    $("#simmilarity_percentage_results").text(data.simmilarity_percentage_results + " %");
                    $("#requestor_name").text(data.requestor_name);
                    $("#remarks").text(data.remarks);
                    $("#student_id").text(data.tup_id);
                    $("#tup_mail").text(data.tup_mail);
                    $("#requestor_type").text(data.requestor_type);
                    $("#sex").text(data.sex);
                    $("#college").text(data.college);
                    if (data.researchers_name1 !== null) {
                        $("#r1").show();
                        $("#researchers_name1").text(data.researchers_name1);
                    } else {
                        $("#r1").hide();
                    }
                    if (data.researchers_name2 !== null) {
                        $("#r2").show();
                        $("#researchers_name2").text(data.researchers_name2);
                    } else {
                        $("#r2").hide();
                    }
                    if (data.researchers_name3 !== null) {
                        $("#r3").show();
                        $("#researchers_name3").text(data.researchers_name3);
                    } else {
                        $("#r3").hide();
                    }
                    if (data.researchers_name4 !== null) {
                        $("#r4").show();
                        $("#researchers_name4").text(data.researchers_name4);
                    } else {
                        $("#r4").hide();
                    }
                    if (data.researchers_name5 !== null) {
                        $("#r5").show();
                        $("#researchers_name5").text(data.researchers_name5);
                    } else {
                        $("#r5").hide();
                    }
                    if (data.researchers_name6 !== null) {
                        $("#r6").show();
                        $("#researchers_name6").text(data.researchers_name6);
                    } else {
                        $("#r6").hide();
                    }
                    if (data.researchers_name7 !== null) {
                        $("#r7").show();
                        $("#researchers_name7").text(data.researchers_name7);
                    } else {
                        $("#r7").hide();
                    }
                    if (data.researchers_name8 !== null) {
                        $("#r8").show();
                        $("#researchers_name8").text(data.researchers_name8);
                    } else {
                        $("#r8").hide();
                    }

                }, 
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //staff view specific citation
        $(".staffCitationShowBtn").click(function() {
            var id = $(this).data('id');
            console.log(id)
            $.ajax({
                url: '/staff/citation/' + id, 
                type: 'GET',
                success: function(data) {
                    console.log(data);

                    $("#citationResearchTitle").text(data.researchTitle);
                    $("#citationConferenceForum").text(data.conferenceForum);
                    $("#citationDate").text(data.date);
                    $("#citationVenue").text(data.venue);
                    $("#citationCountry").text(data.country);
                    $("#citationPresentation").text(data.presentation);
                    $("#citationPublication").text(data.publication);
                    $("#citationDocument").text(data.document);
                    
                    if (data.presentor1 !== null) {
                        $("#p1").show();
                        $("#citationPresentor1").text(data.presentor1);
                    } else {
                        $("#p1").hide();
                    }
                    if (data.presentor2 !== null) {
                        $("#p2").show();
                        $("#citationPresentor2").text(data.presentor2);
                    } else {
                        $("#p2").hide();
                    }
                    if (data.presentor3 !== null) {
                        $("#p3").show();
                        $("#citationPresentor3").text(data.presentor3);
                    } else {
                        $("#p3").hide();
                    }
                    if (data.presentor4 !== null) {
                        $("#p4").show();
                        $("#citationPresentor4").text(data.presentor4);
                    } else {
                        $("#p4").hide();
                    }
                    if (data.presentor5 !== null) {
                        $("#p5").show();
                        $("#citationPresentor5").text(data.presentor5);
                    } else {
                        $("#p5").hide();
                    }

                    if (data.author1 !== null) {
                        $("#a1").show();
                        $("#citationAuthor1").text(data.author1);
                    } else {
                        $("#a1").hide();
                    }
                    if (data.author2 !== null) {
                        $("#a2").show();
                        $("#citationAuthor2").text(data.author2);
                    } else {
                        $("#a2").hide();
                    }
                    if (data.author3 !== null) {
                        $("#a3").show();
                        $("#citationAuthor3").text(data.author3);
                    } else {
                        $("#a3").hide();
                    }
                    if (data.author4 !== null) {
                        $("#a4").show();
                        $("#citationAuthor4").text(data.author4);
                    } else {
                        $("#a4").hide();
                    }
                    if (data.author5 !== null) {
                        $("#a5").show();
                        $("#citationAuthor5").text(data.author5);
                    } else {
                        $("#a5").hide();
                    }


                }, 
                error: function (error) {
                    console.log(error);
                },
            });
        });

         //staff edit citation info
         $(".staffcitationEditBtn").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/staff/citation/" + id + "/edit",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $('#citationEditId').val(data.id);
                    $('#citation_researchTitle').val(data.researchTitle);
                    $('#citation_date').val(data.date);
                    $('#citation_conferenceForum').val(data.conferenceForum);
                    $('#citation_venue').val(data.venue);
                    $('#citation_country').val(data.country);
                    $('#citation_presentation').val(data.presentation);
                    $('#citation_publication').val(data.publication);
                    $('#citation_presentor1').val(data.presentor1);
                    $('#citation_presentor2').val(data.presentor2);
                    $('#citation_presentor3').val(data.presentor3);
                    $('#citation_presentor4').val(data.presentor4);
                    $('#citation_presentor5').val(data.presentor5);
                    $('#citation_author1').val(data.author1);
                    $('#citation_author2').val(data.author2);
                    $('#citation_author3').val(data.author3);
                    $('#citation_author4').val(data.author4);
                    $('#citation_author5').val(data.author5);
                    $('#citation_document').val(data.document);
                    
                },
                error: function (error) {
                    console.log("error");
                },
            });
        });

        //staff update citation info
        $(".staffCitationUpdateBtn").on("click", function (e) {
            e.preventDefault();
            var id = $("#citationEditId").val();
            let editformData = new FormData($("#citationInfoForm")[0]);
            for(var pair of editformData.entries()){
                console.log(pair[0] + ',' + pair[1]);
            }
            console.log(editformData)
            $.ajax({
                type: "POST",
                url: "/staff/citation/" + id + "/edit/updated",
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
                        window.location.href = '/staff/citation';
                    }, 1500);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Citation Info Updated',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

         //staff delete citation info
         $(".staffCitationDeleteBtn").on("click", function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            console.log(id);
            Swal.fire({
                title: 'Are you sure you want to delete this citation?',
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
                        url: "/api/staff/citation/" + id + "/deleted",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            setTimeout(function() {
                                window.location.href = '/staff/citation';
                            }, 1500);
                            console.log(data);
                            Swal.fire(
                                'Deleted!',
                                'Citation has been deleted.',
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
    //END OF STAFF POV

    //START OF FACULTY POV
        //faculty view pdf  
        $(".facultyshowpdfinfo").click(function () {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/faculty/show/pdf/" + id,
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

        //faculty delete own file
        $(".facultyfiledeleteBtn").on("click", function (e) {
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
                        url: "/api/faculty/myfiles/" + id + "/deleted",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            setTimeout(function() {
                                window.location.href = '/faculty/myfiles';
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

        //faculty file history
        $(".facultyfilehistory").click(function () {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/faculty/show/history/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function (data) {
                    console.log(data);

                    if (data.history.length === 0) {
                        $("#staffttitle").empty();
                        $("#staffmessage").empty();

                        var tbody = $("#facultyhistoryTable tbody");
                        tbody.empty(); 

                        $("#facultymessage").html("<br><p class='text-center'>No certification procedure exists.</p>");
                    } else {
                        $("#facultytitle").empty();
                        $("#facultymessage").empty();
                        
                        var researchTitle = data.title ? data.title.research_title : null;
                        $("#facultytitle").text(researchTitle);

                        var tbody = $("#facultyhistoryTable tbody");
                        tbody.empty(); 

                        data.history.forEach(function (entry) {
                            var color;
                            switch (entry.status) {
                                case "Passed":
                                    color = "blue";
                                    break;
                                case "Returned":
                                    color = "red";
                                    break;
                                case "Pending":
                                    color = "orange";
                                    break;
                                default:
                                    color = "black";
                            }
                            var row = '<tr>' +
                            '<th scope="row">' + entry.submission_frequency + '</th>' +
                                '<td>' + entry.date + '</td>' +
                                '<td>' + entry.date_processing_end + '</td>' +
                                '<td style="color: ' + color + ';">' + entry.status + '</td>' +
                                '<td>' + entry.initial_simmilarity_percentage + '%' + '</td>' +
                                '<td>' + entry.simmilarity_percentage_results + '%' + '</td>' +
                                '</tr>';
                            tbody.append(row);
                        });

                    }

                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //faculty fetching file id to apply certification
        $(".facultyApplyGetId").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/faculty/get/file/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    console.log(id);

                    $('#research_id').val(id);

                },
                error: function(error) {
                    console.log(error);
                },
            });
        });

        //faculty applying certification
        $(".facultyapplycertification").on("click", function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            let editformData = new FormData($("#facultycertificationform")[0]);
            for(var pair of editformData.entries()){
                console.log(pair[0] + ',' + pair[1]);
            }
            $.ajax({
                type: "POST",
                url: "/faculty/apply/certification/requested/" + id ,
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
                        window.location.href = '/faculty/apply/certification';
                    }, 1500);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Request Sent',
                        html: '<p>Thanks for using our system! Your feedback means a lot to us as we aim to improve our services on campus</p>' 
                        + '<img class="img" src="/assets/img/CustomerSatisfaction.png" alt="" style="width: 250px; height: auto;">',
                    })
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //faculty fetching file id to re-apply certification
        $(".facultyReApplyGetId").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/faculty/reapply/get/file/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    console.log(id);
        
                    $('#reApplyResearchId').val(id);
        
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });

        //faculty re-apply certification
        $(".facuyltyReApplyCertification").on("click", function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            console.log(id)
            let editformData = new FormData($("#facultyReApplyCertificationForm")[0]);
            for(var pair of editformData.entries()){
                console.log(pair[0] + ',' + pair[1]);
            }
            $.ajax({
                type: "POST",
                url: "/faculty/re-apply/certification/requested/" + id ,
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
                        window.location.href = '/faculty/apply/certification';
                    }, 1500);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Request Sent',
                        html: '<p>Thanks for using our system! Your feedback means a lot to us as we aim to improve our services on campus</p>' 
                        + '<img class="img" src="/assets/img/CustomerSatisfaction.png" alt="" style="width: 250px; height: auto;">',
                    })
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //faculty view application status
        $(".facultyViewDetails").click(function() {
            var id = $(this).data('id');
            console.log(id)
            $.ajax({
                url: '/faculty/application/status/' + id, 
                type: 'GET',
                success: function(data) {
                    console.log(data);

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
                    }

                    $("#initial_simmilarity_percentage").text(data.initial_simmilarity_percentage + " %");
                    $("#simmilarity_percentage_results").text(data.simmilarity_percentage_results + " %");
                    $("#requestor_name").text(data.requestor_name);
                    $("#student_id").text(data.tup_id);
                    $("#tup_mail").text(data.tup_mail);
                    $("#requestor_type").text(data.requestor_type);
                    $("#sex").text(data.sex);
                    $("#college").text(data.college);
                    $("#remarks").text(data.remarks);

                    if (data.researchers_name1 !== null) {
                        $("#r1").show();
                        $("#researchers_name1").text(data.researchers_name1);
                    } else {
                        $("#r1").hide();
                    }
                    if (data.researchers_name2 !== null) {
                        $("#r2").show();
                        $("#researchers_name2").text(data.researchers_name2);
                    } else {
                        $("#r2").hide();
                    }
                    if (data.researchers_name3 !== null) {
                        $("#r3").show();
                        $("#researchers_name3").text(data.researchers_name3);
                    } else {
                        $("#r3").hide();
                    }
                    if (data.researchers_name4 !== null) {
                        $("#r4").show();
                        $("#researchers_name4").text(data.researchers_name4);
                    } else {
                        $("#r4").hide();
                    }
                    if (data.researchers_name5 !== null) {
                        $("#r5").show();
                        $("#researchers_name5").text(data.researchers_name5);
                    } else {
                        $("#r5").hide();
                    }
                    if (data.researchers_name6 !== null) {
                        $("#r6").show();
                        $("#researchers_name6").text(data.researchers_name6);
                    } else {
                        $("#r6").hide();
                    }
                    if (data.researchers_name7 !== null) {
                        $("#r7").show();
                        $("#researchers_name7").text(data.researchers_name7);
                    } else {
                        $("#r7").hide();
                    }
                    if (data.researchers_name8 !== null) {
                        $("#r8").show();
                        $("#researchers_name8").text(data.researchers_name8);
                    } else {
                        $("#r8").hide();
                    }
                }, 
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //faculty view students application 
        $(".showStudentApplication").click(function() {
            var id = $(this).data('id');
            console.log(id)
            $.ajax({
                url: '/faculty/student-applications/' + id, 
                type: 'GET',
                success: function(data) {
                    console.log(data);

                    $("#research_title").text(data.research_title);
                    $("#thesis_type").text(data.thesis_type);
                    $("#submission_frequency").text(data.submission_frequency);
                    $("#technicalAdviser").text(data.TechnicalAdviserName);
                    $("#subjectAdviser").text(data.SubjectAdviserName);
                    $("#technicalAdviserEmail").text(data.technicalAdviserEmail);
                    $("#subjectAdviserEmail").text(data.subjectAdviserEmail);
                    
                    if (data.status === "Pending") {
                        $("#status").html('<span class="badge border-success border-1 text-success"><h5>Pending</h5></span>');
                    } else if (data.status === "Returned") {
                        $("#status").html('<span class="badge border-warning border-1 text-danger"><h5>Returned</h5></span>');
                    } else if (data.status === "Pending Technical Adviser Approval") {
                        $("#status").html('<span class="badge border-warning border-1 text-warning"><h5>Pending Technical Adviser Approval</h5></span>');
                    } else if (data.status === "Pending Subject Adviser Approval") {
                        $("#status").html('<span class="badge border-warning border-1 text-warning"><h5>Pending Subject Adviser Approval</h5></span>');
                    }
                    else if (data.status === "Passed") {
                        $("#status").html('<span class="badge border-primary border-1 text-primary"><h5>Passed</h5></span>');

                        var pdfLink = $('<a>', {
                            href: "/uploads/pdf/" + encodeURIComponent(data.certificate_file),
                            text: "Download PDF",
                            target: "_blank"
                        });
                    
                        $("#certificate").empty().append(pdfLink);

                        $('#showStudentApplicationInfo').on('hidden.bs.modal', function () {
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
                    if (data.researchers_name1 !== null) {
                        $("#r1").show();
                        $("#researchers_name1").text(data.researchers_name1);
                    } else {
                        $("#r1").hide();
                    }
                    if (data.researchers_name2 !== null) {
                        $("#r2").show();
                        $("#researchers_name2").text(data.researchers_name2);
                    } else {
                        $("#r2").hide();
                    }
                    if (data.researchers_name3 !== null) {
                        $("#r3").show();
                        $("#researchers_name3").text(data.researchers_name3);
                    } else {
                        $("#r3").hide();
                    }
                    if (data.researchers_name4 !== null) {
                        $("#r4").show();
                        $("#researchers_name4").text(data.researchers_name4);
                    } else {
                        $("#r4").hide();
                    }
                    if (data.researchers_name5 !== null) {
                        $("#r5").show();
                        $("#researchers_name5").text(data.researchers_name5);
                    } else {
                        $("#r5").hide();
                    }
                    if (data.researchers_name6 !== null) {
                        $("#r6").show();
                        $("#researchers_name6").text(data.researchers_name6);
                    } else {
                        $("#r6").hide();
                    }
                    if (data.researchers_name7 !== null) {
                        $("#r7").show();
                        $("#researchers_name7").text(data.researchers_name7);
                    } else {
                        $("#r7").hide();
                    }
                    if (data.researchers_name8 !== null) {
                        $("#r8").show();
                        $("#researchers_name8").text(data.researchers_name8);
                    } else {
                        $("#r8").hide();
                    }

                }, 
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //faculty show research info
        $(".researchShowInfoBtn").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/faculty/research-list/" + id,
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

                    if (data.faculty_adviser1 !== null) {
                        $("#a1").show();
                        $("#facultyadviser1").text(data.faculty_adviser1);
                    } else {
                        $("#a1").hide();
                    }
                    if (data.faculty_adviser2 !== null) {
                        $("#a2").show();
                        $("#facultyadviser2").text(data.faculty_adviser2);
                    } else {
                        $("#a2").hide();
                    }
                    if (data.faculty_adviser3 !== null) {
                        $("#a3").show();
                        $("#facultyadviser3").text(data.faculty_adviser3);
                    } else {
                        $("#a3").hide();
                    }
                    if (data.faculty_adviser4 !== null) {
                        $("#a4").show();
                        $("#facultyadviser4").text(data.faculty_adviser4);
                    } else {
                        $("#a4").hide();
                    }

                    if (data.researcher1 !== null) {
                        $("#r1").show();
                        $("#researchers1").text(data.researcher1);
                    } else {
                        $("#r1").hide();
                    }
                    if (data.researcher2 !== null) {
                        $("#r2").show();
                        $("#researchers2").text(data.researcher2);
                    } else {
                        $("#r2").hide();
                    }
                    if (data.researcher3 !== null) {
                        $("#r3").show();
                        $("#researchers3").text(data.researcher3);
                    } else {
                        $("#r3").hide();
                    }
                    if (data.researcher4 !== null) {
                        $("#r4").show();
                        $("#researchers4").text(data.researcher4);
                    } else {
                        $("#r4").hide();
                    }
                    if (data.researcher5 !== null) {
                        $("#r5").show();
                        $("#researchers5").text(data.researcher5);
                    } else {
                        $("#r5").hide();
                    }
                    if (data.researcher6 !== null) {
                        $("#r6").show();
                        $("#researchers6").text(data.researcher6);
                    } else {
                        $("#r6").hide();
                    }

                    $("#timeframe").text(data.time_frame);
                    $("#datecompletion").text(data.date_completion);;      
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //faculty/technical adviser approval for certification
        $(".taApproval").click(function() {
            var id = $(this).data('id');
            console.log(id)
            $.ajax({
                url: '/faculty/student-applications/technicalAdviser/approval/' + id, 
                type: 'GET',
                success: function(data) {
                    console.log(data.research_id);

                    $('#fileId1').val(data.research_id);
                    $('#requestId1').val(id);

                    var pdfLink = $('<a>', {
                        href: "/uploads/pdf/" + encodeURIComponent(data.research_file),
                        text: "Download File",
                        target: "_blank"
                    });
                    $("#studentApplicationFile1").empty().append(pdfLink);
                    
                }, 
                error: function() {
                    console.log(error);
                }
            });
        });

        //faculty/technical adviser sending approval for certification
        $("#technicalAdviserAprrovalBtn").on("click", function (e) {
            e.preventDefault();
            var id = $("#requestId1").val();
            let editformData = new FormData($("#technicalAdviserApprovalForm")[0]);
            for(var pair of editformData.entries()){
                console.log(pair[0] + ',' + pair[1]);
            }
            $.ajax({
                type: "POST",
                url: "/faculty/student-applications/technicalAdviser/approval/" + id + "/sent",
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
                        window.location.href = '/faculty/student-applications';
                    }, 1500);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Process Done',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //faculty/subject adviser approval for certification
        $(".saApproval").click(function() {
            var id = $(this).data('id');
            console.log(id)
            $.ajax({
                url: '/faculty/student-applications/subjectAdviser/approval/' + id, 
                type: 'GET',
                success: function(data) {
                    console.log(data.research_id);

                    $('#fileId2').val(data.research_id);
                    $('#requestId2').val(id);

                    var pdfLink = $('<a>', {
                        href: "/uploads/pdf/" + encodeURIComponent(data.research_file),
                        text: "Download File",
                        target: "_blank"
                    });
                    $("#studentApplicationFile2").empty().append(pdfLink);
                    
                }, 
                error: function() {
                    console.log(error);
                }
            });
        });

        //faculty/subject adviser sending approval for certification
        $("#subjectAdviserAprrovalBtn").on("click", function (e) {
            e.preventDefault();
            var id = $("#requestId2").val();
            let editformData = new FormData($("#subjectAdviserApprovalForm")[0]);
            for(var pair of editformData.entries()){
                console.log(pair[0] + ',' + pair[1]);
            }
            $.ajax({
                type: "POST",
                url: "/faculty/student-applications/subjectAdviser/approval/" + id + "/sent",
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
                        window.location.href = '/faculty/student-applications';
                    }, 1500);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Process Done',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //faculty view specific citation
        $(".citationShowBtn").click(function() {
            var id = $(this).data('id');
            console.log(id)
            $.ajax({
                url: '/faculty/citation/' + id, 
                type: 'GET',
                success: function(data) {
                    console.log(data);

                    $("#citationResearchTitle").text(data.researchTitle);
                    $("#citationConferenceForum").text(data.conferenceForum);
                    $("#citationDate").text(data.date);
                    $("#citationVenue").text(data.venue);
                    $("#citationCountry").text(data.country);
                    $("#citationPresentation").text(data.presentation);
                    $("#citationPublication").text(data.publication);
                    $("#citationDocument").text(data.document);
                    
                    if (data.presentor1 !== null) {
                        $("#p1").show();
                        $("#citationPresentor1").text(data.presentor1);
                    } else {
                        $("#p1").hide();
                    }
                    if (data.presentor2 !== null) {
                        $("#p2").show();
                        $("#citationPresentor2").text(data.presentor2);
                    } else {
                        $("#p2").hide();
                    }
                    if (data.presentor3 !== null) {
                        $("#p3").show();
                        $("#citationPresentor3").text(data.presentor3);
                    } else {
                        $("#p3").hide();
                    }
                    if (data.presentor4 !== null) {
                        $("#p4").show();
                        $("#citationPresentor4").text(data.presentor4);
                    } else {
                        $("#p4").hide();
                    }
                    if (data.presentor5 !== null) {
                        $("#p5").show();
                        $("#citationPresentor5").text(data.presentor5);
                    } else {
                        $("#p5").hide();
                    }

                    if (data.author1 !== null) {
                        $("#a1").show();
                        $("#citationAuthor1").text(data.author1);
                    } else {
                        $("#a1").hide();
                    }
                    if (data.author2 !== null) {
                        $("#a2").show();
                        $("#citationAuthor2").text(data.author2);
                    } else {
                        $("#a2").hide();
                    }
                    if (data.author3 !== null) {
                        $("#a3").show();
                        $("#citationAuthor3").text(data.author3);
                    } else {
                        $("#a3").hide();
                    }
                    if (data.author4 !== null) {
                        $("#a4").show();
                        $("#citationAuthor4").text(data.author4);
                    } else {
                        $("#a4").hide();
                    }
                    if (data.author5 !== null) {
                        $("#a5").show();
                        $("#citationAuthor5").text(data.author5);
                    } else {
                        $("#a5").hide();
                    }


                }, 
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //faculty edit citation info
        $(".citationEditBtn").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/faculty/citation/" + id + "/edit",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $('#citationEditId').val(data.id);
                    $('#citation_researchTitle').val(data.researchTitle);
                    $('#citation_date').val(data.date);
                    $('#citation_conferenceForum').val(data.conferenceForum);
                    $('#citation_venue').val(data.venue);
                    $('#citation_country').val(data.country);
                    $('#citation_presentation').val(data.presentation);
                    $('#citation_publication').val(data.publication);
                    $('#citation_presentor1').val(data.presentor1);
                    $('#citation_presentor2').val(data.presentor2);
                    $('#citation_presentor3').val(data.presentor3);
                    $('#citation_presentor4').val(data.presentor4);
                    $('#citation_presentor5').val(data.presentor5);
                    $('#citation_author1').val(data.author1);
                    $('#citation_author2').val(data.author2);
                    $('#citation_author3').val(data.author3);
                    $('#citation_author4').val(data.author4);
                    $('#citation_author5').val(data.author5);
                    $('#citation_document').val(data.document);
                    
                },
                error: function (error) {
                    console.log("error");
                },
            });
        });

        //update citation info
        $(".citationUpdateBtn").on("click", function (e) {
            e.preventDefault();
            var id = $("#citationEditId").val();
            let editformData = new FormData($("#citationInfoForm")[0]);
            for(var pair of editformData.entries()){
                console.log(pair[0] + ',' + pair[1]);
            }
            console.log(editformData)
            $.ajax({
                type: "POST",
                url: "/faculty/citation/" + id + "/edit/updated",
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
                        window.location.href = '/faculty/citation';
                    }, 1500);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Citation Info Updated',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

         //delete citation info
         $(".citationDeleteBtn").on("click", function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            console.log(id);
            Swal.fire({
                title: 'Are you sure you want to delete this citation?',
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
                        url: "/api/faculty/citation/" + id + "/deleted",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            setTimeout(function() {
                                window.location.href = '/faculty/citation';
                            }, 1500);
                            console.log(data);
                            Swal.fire(
                                'Deleted!',
                                'Citation has been deleted.',
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

         //faculty viewing research info & requesting access
         $(".facultyRequestAccessBtn").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/faculty/research-list/" + id + "/request-access",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $("#researchId").val(id);

                    if (data.status == null) {
                        $("#facultyRequestedFile").hide(); 
                        $("#facultyProcessingRequest").hide();
                        $("#facultyRejectRequest").hide();
                        $("#facultyRequestExpired").hide();
                        $("#facultyAccessDeneid").show();
                    } else if (data.status == 'Pending') {
                        $("#facultyRequestedFile").hide();
                        $("#facultyAccessDeneid").hide();
                        $("#facultyRejectRequest").hide();
                        $("#facultyRequestExpired").hide();
                        $("#facultyProcessingRequest").show();
                    } else if (data.status == 'Rejected') {
                        $("#facultyRequestedFile").hide();
                        $("#facultyAccessDeneid").hide();
                        $("#facultyProcessingRequest").hide();
                        $("#facultyRequestExpired").hide();
                        $("#facultyRejectRequest").show();
                    } else {
                        var currentDate = new Date(); 
                        var endDate = new Date(data.end_access_date); 

                        if (endDate.toDateString() === currentDate.toDateString() || endDate < currentDate) {
                            $("#facultyRequestedFile").hide();
                            $("#facultyAccessDeneid").hide();
                            $("#facultyProcessingRequest").hide();
                            $("#facultyRejectRequest").hide();
                            $("#facultyRequestExpired").show();
                        } else {
                            $("#facultyAccessDeneid").hide();
                            $("#facultyProcessingRequest").hide();
                            $("#facultyRejectRequest").hide();
                            $("#facultyRequestExpired").hide();
                            $("#facultyRequestedFile").show();

                            $("#facultyEndAccessDate").text(data.end_access_date); 
                            var pdfLink = $('<a>', {
                                href: "/uploads/pdf/" + encodeURIComponent(data.research_file),
                                text: "Download PDF",
                                target: "_blank"
                            });
                            $("#researchFile").empty().append(pdfLink);
                        }
                    } 
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //if modal is hidden or close it will refresh 
        $('#facultyRequestAccess').on('hidden.bs.modal', function () {
            $("#facultyAccessDeneid").hide();
            $("#facultyProcessingRequest").hide();
            $("#facultyRejectRequest").hide();
            $("#facultyRequestExpired").hide();
            $("#facultyRequestedFile").hide();
            $("#facultyRequestAccessForm").hide();
            $("#facultyRequestAccessForm")[0].reset();
        });

        //appointment checker in date and time
        $('#date, #time').change(function() {
            var selectedDate = $('#date').val();
            var selectedTime = $('#time').val();
        
            $.ajax({
                url: "/api/faculty/extension/schedule-appointment/checking-date", 
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'date': selectedDate,
                    'time': selectedTime,
                },
                success: function(response) {
                    console.log(response)
                    if (response.exists) {
                        Swal.fire({
                            icon: "error",
                            title: "Appointment Conflict: Date Already Reserved",
                            text: "Oops! This date already has an appointment.",
                          });
                        $("#date").val('');
                        $("#time").val('');
                    }
                }
            });
        });

        //appoitnment checker if you are currently have appointment
        $('#purpose').change(function() {
            var selectedPurpose = $('#purpose').val();
            var selectedUserID = $('#userId').val();
            
            $.ajax({
                url: "/api/faculty/extension/schedule-appointment/checking-appointment",
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'purpose': selectedPurpose,
                    'userId': selectedUserID,
                },
                success: function(response) {
                    console.log(response);
                    if (response.exists) {
                        Swal.fire({
                            icon: "error",
                            title: response.title, 
                            text: response.message,
                        });
                        $('#purpose').prop('selectedIndex', -1);
                    } 
                }
            });
        });

        //faculty extension application getting appointment1
        $(".appointment1").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/faculty/extension/application/status/appointment/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $('#purpose1').text(data.purpose);
                    $('#status1').text(data.status);
                    $('#time1').text(data.time);
                    $('#date1').text(data.date);
                },
                error: function (error) {
                    console.log("error");
                },
            });
        });

        //faculty extension application getting appointment2
        $(".appointment2").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/faculty/extension/application/status/appointment/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $('#purpose2').text(data.purpose);
                    $('#status2').text(data.status);
                    $('#time2').text(data.time);
                    $('#date2').text(data.date);
                },
                error: function (error) {
                    console.log("error");
                },
            });
        });

        //faculty extension application getting appointment3
        $(".appointment3").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/faculty/extension/application/status/appointment/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $('#purpose3').text(data.purpose);
                    $('#status3').text(data.status);
                    $('#time3').text(data.time);
                    $('#date3').text(data.date);
                },
                error: function (error) {
                    console.log("error");
                },
            });
        });

        //faculty extension application getting appointment4
        $(".appointment4").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/faculty/extension/application/status/appointment/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    $('#purpose4').text(data.purpose);
                    $('#status4').text(data.status);
                    $('#time4').text(data.time);
                    $('#date4').text(data.date);
                },
                error: function (error) {
                    console.log("error");
                },
            });
        });

        //faculty extension application getting extension files
        $(".extensionFiles").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/faculty/extension/application/status/extension/files/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    if (data.topics === null) {
                        $('#beneficiary').text('No Data!');
                    } else {
                        $('#beneficiary').text(data.beneficiary);
                    }
                    
                    if (data.topics === null) {
                        $('#topics').text('No Data!');
                    } else {
                        $('#topics').text(data.topics);
                    }

                    if (data.topics === null) {
                        $('#subtopics').text('No Data!');
                    } else {
                        $('#subtopics').text(data.subtopics);
                    }

                    if (data.implementation_proper === null) {
                        $('#implementationProper').text('No Data!');
                    } else {
                        $('#implementationProper').text(data.implementation_proper);
                    }
    
                    if (data.proponents1 === null) {
                        $('#prpnts1').hide();
                    } else {
                        $('#proponent1').text(data.proponents1);
                    }

                    if (data.proponents2 === null) {
                        $('#prpnts2').hide();
                    } else {
                        $('#proponent2').text(data.proponents2);
                    }

                    if (data.proponents3 === null) {
                        $('#prpnts3').hide();
                    } else {
                        $('#proponent3').text(data.proponents3);
                    }

                    if (data.proponents4 === null) {
                        $('#prpnts4').hide();
                    } else {
                        $('#proponent4').text(data.proponents4);
                    }

                    if (data.proponents5 === null) {
                        $('#prpnts5').hide();
                    } else {
                        $('#proponent5').text(data.proponents5);
                    }

                    if (data.mou_file === null) {
                        $('#mouFile').text('No File Loaded Yet');
                    } else {
                        var mouFile = $('<a>', {
                            href: "/uploads/extension/" + encodeURIComponent(data.mou_file),
                            text: "View PDF",
                            target: "_blank"
                        });
                        $("#mouFile").empty().append(mouFile);
                    }

                    if (data.ppmp_file === null) {
                        $('#ppmpmFile').text('No File Loaded Yet');
                    } else {
                        var ppmpmFile = $('<a>', {
                            href: "/uploads/extension/" + encodeURIComponent(data.ppmp_file),
                            text: "View PDF",
                            target: "_blank"
                        });
                        $("#ppmpmFile").empty().append(ppmpmFile);
                    }
                    
                    if (data.prFile === null) {
                        $('#prFile').text('No File Loaded Yet');
                    } else {
                        var prFile = $('<a>', {
                            href: "/uploads/extension/" + encodeURIComponent(data.pr_file),
                            text: "View PDF",
                            target: "_blank"
                        });
                        $("#prFile").empty().append(prFile);
                    }
                    
                    if (data.marketStudyFile === null) {
                        $('#marketStudyFile').text('No File Loaded Yet');
                    } else {
                        var marketStudyFile = $('<a>', {
                            href: "/uploads/extension/" + encodeURIComponent(data.c),
                            text: "View PDF",
                            target: "_blank"
                        });
                        $("#marketStudyFile").empty().append(marketStudyFile);
                    }
                    
                    if (data.moa_file === null) {
                        $('#moaFile').text('No File Loaded Yet');
                    } else {
                        var moaFile = $('<a>', {
                            href: "/uploads/extension/" + encodeURIComponent(data.moa_file),
                            text: "View PDF",
                            target: "_blank"
                        });
                        $("#moaFile").empty().append(moaFile);
                    }
                    
                    if (data.post_evaluation_attendance === null) {
                        $('#attendancePostEvaluationSurvey').text('No File Loaded Yet');
                    } else {
                        var attendancePostEvaluationSurvey = $('<a>', {
                            href: "/uploads/extension/" + encodeURIComponent(data.post_evaluation_attendance),
                            text: "View PDF",
                            target: "_blank"
                        });
                        $("#attendancePostEvaluationSurvey").empty().append(attendancePostEvaluationSurvey);
                    }
                    
                    if (data.evaluation_form === null) {
                        $('#evaluationForm').text('No File Loaded Yet');
                    } else {
                        var evaluationForm = $('<a>', {
                            href: "/uploads/extension/" + encodeURIComponent(data.evaluation_form),
                            text: "View PDF",
                            target: "_blank"
                        });
                        $("#evaluationForm").empty().append(evaluationForm);
                    }

                    if (data.capsule_detail === null) {
                        $('#capsuleDetail').text('No File Loaded Yet');
                    } else {
                        var capsuleDetail = $('<a>', {
                            href: "/uploads/extension/" + encodeURIComponent(data.capsule_detail),
                            text: "View PDF",
                            target: "_blank"
                        });
                        $("#capsuleDetail").empty().append(capsuleDetail);
                    }
                    
                    if (data.certificate === null) {
                        $('#certificate').text('No File Loaded Yet');
                    } else {
                        var certificate = $('<a>', {
                            href: "/uploads/extension/" + encodeURIComponent(data.certificate),
                            text: "View PDF",
                            target: "_blank"
                        });
                        $("#certificate").empty().append(certificate);
                    }
                    
                    if (data.attendance === null) {
                        $('#attendance').text('No File Loaded Yet');
                    } else {
                        var attendance = $('<a>', {
                            href: "/uploads/extension/" + encodeURIComponent(data.attendance),
                            text: "View PDF",
                            target: "_blank"
                        });
                        $("#attendance").empty().append(attendance);
                    }
                    
                },
                error: function (error) {
                    console.log("error");
                },
            });
        });

        //faculty extension application getting documentation photos
        $(".doumentationPhotos").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/faculty/extension/application/status/extension/documentation-photos/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data)

                    if (data == '') { 
                        $('#carouselExampleControls').hide();
                        $('#noDocumentationPhotos').show();
                    } else {
                        $('#carouselExampleControls').show();
                        $('#noDocumentationPhotos').hide();
                        data.forEach(function(item, index) {
                            var imageName = item.img_path; 
                            var imageUrl = '/images/documentation/' + imageName;
                            
                            var carouselItem = document.createElement("div");
                            carouselItem.classList.add("carousel-item");
                            
                            if (index === 0) {
                                carouselItem.classList.add("active");
                            }
                            
                            var img = document.createElement("img");
                            img.src = imageUrl;
                            img.classList.add("d-block", "w-100");
                            img.alt = "Slide " + (index + 1);
                            
                            carouselItem.appendChild(img);
                            
                            document.querySelector("#carouselExampleControls .carousel-inner").appendChild(carouselItem);
                        });
                    }

                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //refresh modal when the modal is close
        $("#doumentationPhotos").on("hidden.bs.modal", function () {
            function clearCarouselItems() {
                var carouselInner = document.querySelector("#carouselExampleControls .carousel-inner");
                carouselInner.innerHTML = ''; // Clear all inner HTML
            }

            clearCarouselItems();
        });

        //faculty extension application getting prototype files
        $(".prototypeFiles").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/faculty/extension/application/status/prototype/files/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data);
                    if (data.pre_evaluation_survey === null) {
                        $('#preEvaluationSurvey').text('No Data!');
                    } else {
                        $('#preEvaluationSurvey').text(data.pre_evaluation_survey);
                    }
                    
                    if (data.mid_evaluation_survey === null) {
                        $('#midEvaluationSurvey').text('No Data!');
                    } else {
                        $('#midEvaluationSurvey').text(data.mid_evaluation_survey);
                    }

                    if (data.post_evaluation_survey === null) {
                        $('#postEvaluationSurvey').text('No Data!');
                    } else {
                        $('#postEvaluationSurvey').text(data.post_evaluation_survey);
                    }


                    if (data.nda_file === null) {
                        $('#ndaFile').text('No File Loaded Yet');
                    } else {
                        var ndaFile = $('<a>', {
                            href: "/uploads/prototype/" + encodeURIComponent(data.nda_file),
                            text: "View PDF",
                            target: "_blank"
                        });
                        $("#ndaFile").empty().append(ndaFile);
                    }

                    if (data.coa_file === null) {
                        $('#coaFile').text('No File Loaded Yet');
                    } else {
                        var coaFile = $('<a>', {
                            href: "/uploads/prototype/" + encodeURIComponent(data.coa_file),
                            text: "View PDF",
                            target: "_blank"
                        });
                        $("#coaFile").empty().append(coaFile);
                    }
                    
                    if (data.capsule_detail === null) {
                        $('#prototypeCapsuleDetail').text('No File Loaded Yet');
                    } else {
                        var prototypeCapsuleDetail = $('<a>', {
                            href: "/uploads/prototype/" + encodeURIComponent(data.capsule_detail),
                            text: "View PDF",
                            target: "_blank"
                        });
                        $("#prototypeCapsuleDetail").empty().append(prototypeCapsuleDetail);
                    }
                    
                    if (data.certificate === null) {
                        $('#prototypeCertificate').text('No File Loaded Yet');
                    } else {
                        var prototypeCertificate = $('<a>', {
                            href: "/uploads/prototype/" + encodeURIComponent(data.certificate),
                            text: "View PDF",
                            target: "_blank"
                        });
                        $("#prototypeCertificate").empty().append(prototypeCertificate);
                    }

                    if (data.attendance === null) {
                        $('#prototypeAttendance').text('No File Loaded Yet');
                    } else {
                        var prototypeAttendance = $('<a>', {
                            href: "/uploads/prototype/" + encodeURIComponent(data.attendance),
                            text: "View PDF",
                            target: "_blank"
                        });
                        $("#prototypeAttendance").empty().append(prototypeAttendance);
                    }
                    
                },
                error: function (error) {
                    console.log("error");
                },
            });
        });
        
        //faculty extension application getting prototype documentation photos
        $(".prototypePhotos").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/faculty/extension/application/status/extension/prototype-photos/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data)

                    if (data == '') { 
                        $('#carouselPrototypePhotos').hide();
                        $('#noPrototypeDocumentationPhotos').show();
                    } else {
                        $('#carouselPrototypePhotos').show();
                        $('#noPrototypeDocumentationPhotos').hide();
                        data.forEach(function(item, index) {
                            var imageName = item.img_path; 
                            var imageUrl = '/images/prototypeDocumentation/' + imageName;
                            
                            var carouselItem = document.createElement("div");
                            carouselItem.classList.add("carousel-item");
                            
                            if (index === 0) {
                                carouselItem.classList.add("active");
                            }
                            
                            var img = document.createElement("img");
                            img.src = imageUrl;
                            img.classList.add("d-block", "w-100");
                            img.alt = "Slide " + (index + 1);
                            
                            carouselItem.appendChild(img);
                            
                            document.querySelector("#prototype").appendChild(carouselItem);
                        });
                    }

                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //refresh modal when the modal is close
        $("#prototypePhotos").on("hidden.bs.modal", function () {
            function clearCarouselItems() {
                var carouselInner = document.querySelector("#prototype");
                carouselInner.innerHTML = ''; // Clear all inner HTML
            }

            clearCarouselItems();
        });

        $(".proposal0GetId").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/faculty/extension/application/proposal0/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('#extensionId').val(id);
                    if (data.status === 'New Application') {
                        if (data.appointment1_id === null) {
                            $('option[value="Pre-Survey Consultation"]').prop('disabled', true);
                            $('option[value="Mid-Survey Consultation"]').prop('disabled', true);
                            $('option[value="Implementation Proper Appointment"]').prop('disabled', true);
                            $("#p1Title").text('Make an Appointment for a Proposal Consultation');
                        } 
                    } else if (data.status === 'Proposal Consultation Appointment Cancelled') {
                        if (data.status === 'Proposal Consultation Appointment Cancelled') {
                            $('option[value="Pre-Survey Consultation"]').prop('disabled', true);
                            $('option[value="Mid-Survey Consultation"]').prop('disabled', true);
                            $('option[value="Implementation Proper Appointment"]').prop('disabled', true);
                            $("#p1Title").text('Reschedule a Consultation Appointment for a Proposal');
                        } 
                    } else if (data.status === 'Topics and Sub Topics Inputted' || data.status === 'Appointment Cancelled for Pre-Survey Consultation') {
                        if (data.appointment3_id === null || data.status === 'Appointment Cancelled for Pre-Survey Consultation') {
                            $('option[value="Mid-Survey Consultation"]').prop('disabled', true);
                            $('option[value="Proposal Consultation"]').prop('disabled', true);
                            $('option[value="Implementation Proper Appointment"]').prop('disabled', true);
                            $("#p1Title").text('Make an Appointment for a Pre-Survey Consultation');
                        } 
                    } else if (data.status === 'Appointment Done for Pre-Survey Consultation' || data.status === 'Appointment Cancelled for Mid-Survey Consultation') {
                        if (data.appointment4_id === null || data.status === 'Appointment Cancelled for Mid-Survey Consultation') {
                            $('option[value="Pre-Survey Consultation"]').prop('disabled', true);
                            $('option[value="Proposal Consultation"]').prop('disabled', true);
                            $('option[value="Implementation Proper Appointment"]').prop('disabled', true);
                            $("#p1Title").text('Make an Appointment for a Mid-Survey Consultation');
                        } 
                    } else if (data.status === 'Proposal Approved By Board and OSG' || data.status === 'Implementation Proper Appointment Cancelled') {
                            $('option[value="Proposal Consultation"]').prop('disabled', true);
                            $('option[value="Pre-Survey Consultation"]').prop('disabled', true);
                            $('option[value="Mid-Survey Consultation"]').prop('disabled', true);
                            $("#p1Title").text('Make an Appointment for Implementation Proper');
                    }
                    
                },
                error: function(error) {s
                    console.log(error);
                },
            });
        });

        $(".proposal1GetId").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/faculty/extension/application/proposal1/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) { 
                    console.log(data);
                    $('#proposalId').val(id);
                    if (data.status === 'Proposal Rejected by R&E Office') {
                        $('#p2Title').text('Re-Submission of Proposal');
                    } else {
                        $('#p2Title').text('Submission of Proposal');
                    }
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });

        $(".proposal2GetId").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/faculty/extension/application/proposal2/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('#proposal2Id').val(id);

                   if (data.status === 'Proposal Rejected By DO' || data.status === 'Proposal Rejected By UES' || data.status === 'Proposal Rejected By President') {
                    $('#proposal2Title').text('Re-Submission of Documents');
                   } else if (data.status === 'Proposal Rejected By Board' || data.status === 'Proposal Rejected By OSG') {
                    $('#proposal2Title').text('Re-Submission of Documents');
                   }
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });

        $(".proposal3GetId").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/faculty/extension/application/proposal3/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('#proposal3Id').val(id);
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });

        $(".proposal4GetId").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/faculty/extension/application/proposal4/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    console.log(id);
                    $('#proposal4Id').val(id);
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });

        $(".proposal5GetId").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/faculty/extension/application/proposal5/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    console.log(id);
                    $('#proposal5Id').val(id);
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });

        $(".proposal6GetId").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/faculty/extension/application/proposal6/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    console.log(id);
                    $('#proposal6Id').val(id);
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });

        $(".proposal7GetId").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/faculty/extension/application/proposal7/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    console.log(id);
                    $('#proposal7Id').val(id);
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });

        $(".proposal8GetId").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/faculty/extension/application/proposal8/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    console.log(data); 
                    $('#proposal8Id').val(data.id);
                    $('#prototype1Id').val(data.prototypeID);
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });

        $(".proposal9GetId").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/faculty/extension/application/proposal9/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    console.log(data); 
                    $('#proposal9Id').val(data.id);
                    $('#prototype2Id').val(data.prototypeID);
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });

        $(".proposal10GetId").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/faculty/extension/application/proposal10/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    console.log(data); 
                    $('#proposal10Id').val(data.id);
                    $('#prototype3Id').val(data.prototypeID);
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });

        $(".proposal11GetId").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "/faculty/extension/application/proposal11/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    console.log(data); 
                    $('#proposal11Id').val(data.id);
                    $('#prototype4Id').val(data.prototypeID);
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });

        //faculty view research proposal status
        $(".viewReseachProposalStatus").click(function() {
            var id = $(this).data("id");
            console.log(id);
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/faculty/research-proposal/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data)

                    if (data.colloquiumId === null) { 
                        $('#colloquiumSchedule').hide();
                    } else {
                        $('#colloquiumSchedule').show();
                        $('#colloquiumTime').text(data.time);
                        $('#colloquiumDate').text(data.date);
                    }
                    
                    $('#researchTitle').text(data.title);
                    $('#status').text(data.status);
                    $('#researchProposalRemarks').text(data.remarks);
                    $('#researchProposalType').text(data.research_type);

                    if (data.status === "Pending R&E Office Approval") {
                        $("#status").html('<h5><span class="badge bg-warning">Pending R&E Office Approval</span></h5>');
                    } else if (data.status === "Research Proposal Approved By R&E Office") {
                        $("#status").html('<h5><span class="badge bg-success">Research Proposal Approved By R&E Office</span></h5>');
                    } else if (data.status === "Research Proposal Rejected By R&E Office") {
                        $("#status").html('<h5><span class="badge bg-danger">Research Proposal Rejected By R&E Office</span></h5>');
                    }

                    var pdfLink = $('<a>', {
                        href: "/uploads/researchProposal/" + encodeURIComponent(data.proposal_file),
                        text: "View File",
                        target: "_blank"
                    });
                    $("#pdfFile").empty().append(pdfLink);
                    
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        //when the research proposal modal is hidden all the data will be back to the default
        $("#viewReseachProposalStatus").on("hidden.bs.modal", function () {
            $('#researchTitle').empty();
            $('#status').empty();
            $('#researchProposalRemarks').empty();
            $('#researchProposalType').empty();
            $("#pdfFile").empty();
        });

        //faculty getting id for resubmit research proposal
        $(".reSubmitResearchProposal").click(function() {
            var id = $(this).data("id");
            console.log(id);
            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: "/faculty/research-proposal/resbumit/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) { 
                    console.log(data)

                    $('#proposalId').val(id);
                    
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });
});