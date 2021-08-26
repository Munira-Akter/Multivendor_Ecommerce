(function($) {
    $(document).ready(function() {
        allPost();
        $(".select2").select2();

        CKEDITOR.replace("post_editor");

        // Post Type Slect

        $("#blog_post_format").change(function() {
            let format = $(this).val();
            if (format == "Null") {
                $(".post-image").hide();
                $(".post-gallery").hide();
                $(".post-video").hide();
                $(".post-audio").hide();
            }
            if (format == "Image") {
                $(".post-image").show();
            } else {
                $(".post-image").hide();
            }
            if (format == "Gallery") {
                $(".post-gallery").show();
            } else {
                $(".post-gallery").hide();
            }
            if (format == "Video") {
                $(".post-video").show();
            } else {
                $(".post-video").hide();
            }
            if (format == "Audio") {
                $(".post-audio").show();
            } else {
                $(".post-audio").hide();
            }
        }); // Post Type Slect

        let format = $("#blog_post_edit_format").val();

        if (format == "Image") {
            $(".post-image").show();
        } else {
            $(".post-image").hide();
        }
        if (format == "Gallery") {
            $(".post-gallery").show();
        } else {
            $(".post-gallery").hide();
        }
        if (format == "Video") {
            $(".post-video").show();
        } else {
            $(".post-video").hide();
        }
        if (format == "Audio") {
            $(".post-audio").show();
        } else {
            $(".post-audio").hide();
        }

        function customMsg(msg, type = "danger") {
            return (
                '<p class="alert alert-' +
                type +
                '"> ' +
                msg +
                ' <button class="close" data-dismiss="alert">&times;</button></p>'
            );
        }

        // ===============================
        // Blog Post Javascript Start Here
        // ===============================

        // Post Add Form Image Show
        $("#post_img_select").change(function(e) {
            let image_src = URL.createObjectURL(e.target.files[0]);
            $(".post_single_image_show")
                .attr("src", image_src)
                .css("width", "200")
                .css("height", "200");
        });

        // Multiple Image show

        $("#post_img_select_gallary").change(function(e) {
            let gallary = "";
            for (let i = 0; i < e.target.files.length; i++) {
                let image_src = URL.createObjectURL(e.target.files[i]);
                gallary +=
                    '<span class="pip" style=" color:red;"><img style="width: 200px; height: 200px; margin-right: 20px; position:relative;" class="shadow"  src="' +
                    image_src +
                    '" alt=""><a style="z-index:999;position:relative; top: -84px; left: -14px;" class="remove_cls"><i class="fa fa-close"></i></a></span>';
            }

            $(".post_multiple_image_show").html(gallary);

            $(".remove_cls").click(function(e) {
                e.preventDefault();
                $(this).parent().remove();
            });
        });

        /**
         * Blog Post Show
         */

        function allPost() {
            $.ajax({
                url: "/admin/post/all/",
                success: function(output) {
                    $("#post_tbody").html(output);
                },
            });
        }

        /**
         * Blog TAg trash Show
         */

        trashPost();

        function trashPost() {
            $.ajax({
                url: "/admin/post/trash-all/",
                success: function(output) {
                    $("#tag_post_tbody").html(output);
                },
            });
        }

        /**
         * Blog tag Delete
         */

        $(document).on("click", "#post_delete_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("delete_id");
            $.ajax({
                url: "/admin/post/move-trash/" + id,
                success: function(output) {
                    allPost();
                    trashPost();
                    toastr.error("Tag move to trash", "Trash");
                },
            });
        });

        /**
         * Blog category Recover
         */

        $(document).on("click", "#post_trash_recovery_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("recovery_id");
            $.ajax({
                url: "/admin/post/restore/" + id,
                success: function(output) {
                    allPost();
                    trashPost();
                    toastr.success("Tag move to Recovery", "Recovery");
                },
            });
        });

        /**
         * Blog category Delete permanently
         */

        $(document).on("click", "#post_trash_delete_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("delete_id");

            swal({
                title: "Deleted",
                text: "Are you sure , You want Delete this Tag Parmanently?",
                icon: "error",
                dangerMode: true,
                buttons: ["Cancel", "Delete"],
            }).then((action) => {
                if (action) {
                    $.ajax({
                        url: "/admin/post/destory/" + id,
                        success: function(output) {
                            allPost();
                            trashPost();
                            toastr.error("Tag Delete Parmanently", "Trash");
                        },
                    });
                } else {
                    toastr.success("Tag is Safe", "Safe");
                }
            });
        });
    });
})(jQuery);