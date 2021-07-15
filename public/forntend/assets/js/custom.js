(function($) {
    $(document).ready(function() {
        var slideCount = $("#slider ul li").length;
        var slideWidth = $("#slider ul li").width();
        var slideHeight = $("#slider ul li").height();
        var sliderUlWidth = slideCount * slideWidth;

        $("#slider").css({ width: slideWidth, height: slideHeight });

        $("#slider ul").css({ width: sliderUlWidth, marginLeft: -slideWidth });

        $("#slider ul li:last-child").prependTo("#slider ul");

        function moveLeft() {
            $("#slider ul").animate({
                    left: +slideWidth,
                },
                200,
                function() {
                    $("#slider ul li:last-child").prependTo("#slider ul");
                    $("#slider ul").css("left", "");
                }
            );
        }

        function moveRight() {
            $("#slider ul").animate({
                    left: -slideWidth,
                },
                200,
                function() {
                    $("#slider ul li:first-child").appendTo("#slider ul");
                    $("#slider ul").css("left", "");
                }
            );
        }

        $("a.control_prev").click(function(e) {
            e.preventDefault();
            moveLeft();
        });

        $("a.control_next").click(function(e) {
            e.preventDefault();
            moveRight();
        });

        // Admin Edit Form Image Show
        $("#user_profile_update").change(function(e) {
            let image_src = URL.createObjectURL(e.target.files[0]);
            $("#user_profile_update_show").attr("src", image_src);
        });

        // Address from show
        $("#address_add_btn").click(function(e) {
            e.preventDefault();
            $("#address_add").slideToggle(700);
        });
        // Address Delete
        $(document).on("click", "#delete_address_btn", function(e) {
            e.preventDefault();
            alert();
            let delete_id = $(this).attr("delete_id");
            swal({
                title: "Deleted",
                text: "Are you sure , You want to delete this address?",
                icon: "error",
                dangerMode: true,
                buttons: ["Cancel", "Remove"],
            }).then((action) => {
                if (action) {
                    $.ajax({
                        url: "user-delete-address/" + delete_id,
                        success: function(output) {
                            swal({
                                title: "Deleted",
                                text: "Your Address is deleted",
                                icon: "error",
                                dangerMode: true,
                            });

                            $("#address_edit").css("display", "none");
                        },
                    });
                } else {
                    swal("success", "Address is Safe");
                }
            });
        });

        // All Blog Post Show

        allpost();

        function allpost() {
            $.ajax({
                url: "/blog/all",
                success: function(output) {
                    $("#blog_post").html(output);
                },
            });
        }

        // Comment Store
        $(document).on("submit", "#comment_form", function(e) {
            e.preventDefault();

            let name = $('#comment_form input[name="name"]').val();
            let email = $('#comment_form input[name="email"]').val();
            let comment = $('#comment_form input[name="comment"]').val();
            let _token = $('#comment_form input[name="_token"]').val();

            $.ajax({
                url: "comment/",
                type: "POST",
                data: {
                    name: name,
                    email: email,
                    comment: comment,
                    _token: _token,
                },
                success: function(output) {
                    if (output) {
                        alert(
                            output.name +
                            output.email +
                            output.user_id +
                            output.comment
                        );
                        $("#comment_form")[0].reset();
                        toastr.success(
                            "Your Comment is Published Now",
                            "Published"
                        );
                    }
                },
            });
        });
    });
})(jQuery);