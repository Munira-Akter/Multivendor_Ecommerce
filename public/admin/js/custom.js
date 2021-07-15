(function($) {
    $(document).ready(function() {
        function customMsg(msg, type = "danger") {
            return (
                '<p class="alert alert-' +
                type +
                '"> ' +
                msg +
                ' <button class="close" data-dismiss="alert">&times;</button></p>'
            );
        }

        // Admin Edit Form Image Show
        $("#admin_Image_Url").change(function(e) {
            let image_src = URL.createObjectURL(e.target.files[0]);
            $("#admin_Image_Show").attr("src", image_src);
        });

        /**
         * Blog Category Show
         */

        allBlogCategory();

        function allBlogCategory() {
            $.ajax({
                url: "/admin-categor/all",
                success: function(output) {
                    $("#tbody").html(output);
                },
            });
        }

        /**
         * Blog Category trash Show
         */

        trashBlogCategory();

        function trashBlogCategory() {
            $.ajax({
                url: "/admin-categor/trash",
                success: function(output) {
                    $("#trash_tbody").html(output);
                },
            });
        }

        /**
         * Blog category Edit data Show
         */

        $(document).on("click", "a#cat_edit_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("edit_id");

            $.ajax({
                url: "admin-category-edit/" + id,
                success: function(output) {
                    $("#cat-edit-modal-center").modal("show");
                    $(
                        '#cat_edit_form input[name="blog_category_name_en"] '
                    ).val(output.category_name_en);
                    $(
                        '#cat_edit_form input[name="blog_category_name_lng"] '
                    ).val(output.category_name_lng);
                    $('#cat_edit_form input[name="id"] ').val(output.id);
                },
            });
        });

        /**
         * Blog category Edit data Update
         */

        $(document).on("submit", "form#cat_edit_form", function(e) {
            e.preventDefault();
            let id = $('#cat_edit_form input[name="id"] ').val();

            $.ajax({
                url: "admin-category-update/" + id,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(output) {
                    if (output) {
                        allBlogCategory();
                        $("#cat_edit_form")[0].reset();
                        $("#cat-edit-modal-center").modal("hide");
                        toastr.success(
                            "Category Updated Succeefully",
                            "Update"
                        );
                    }
                },
            });
        });

        /**
         * Blog category Delete
         */

        $(document).on("click", "#category_delete_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("delete_id");

            swal({
                title: "Deleted",
                text: "Are you sure , You want to move this category in trash?",
                icon: "error",
                dangerMode: true,
                buttons: ["Cancel", "Remove"],
            }).then((action) => {
                if (action) {
                    $.ajax({
                        url: "admin-category-delete/" + id,
                        success: function(output) {
                            allBlogCategory();
                            trashBlogCategory();
                            toastr.error("Category move to trash", "Trash");
                        },
                    });
                } else {
                    toastr.success("Category is Safe", "Safe");
                }
            });
        });

        /**
         * Blog category Recover
         */

        $(document).on("click", "#cat_trash_recovery_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("recovery_id");
            $.ajax({
                url: "/recovery/" + id,
                success: function(output) {
                    alert(output);
                    allBlogCategory();
                    trashBlogCategory();
                    toastr.success("Category move to Recovery", "Recovery");
                },
            });
        });

        /**
         * Blog category Delete permanently
         */

        $(document).on("click", "#cat_trash_delete_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("delete_id");

            swal({
                title: "Deleted",
                text: "Are you sure , You want Delete this category Parmanently?",
                icon: "error",
                dangerMode: true,
                buttons: ["Cancel", "Delete"],
            }).then((action) => {
                if (action) {
                    $.ajax({
                        url: "admin-category-pardelete/" + id,
                        success: function(output) {
                            allBlogCategory();
                            trashBlogCategory();
                            toastr.error(
                                "Category Delete Parmanently",
                                "Trash"
                            );
                        },
                    });
                } else {
                    toastr.success("Category is Safe", "Safe");
                }
            });
        });

        // ===============================
        // Blog Tag Javascript Start Here
        // ===============================

        /**
         * Blog Tag Show
         */

        allBlogtag();

        function allBlogtag() {
            $.ajax({
                url: "/admin/tag/all/",
                success: function(output) {
                    $("#tag_tbody").html(output);
                },
            });
        }

        /**
         * Blog TAg trash Show
         */

        trashBlogtag();

        function trashBlogtag() {
            $.ajax({
                url: "/admin/tag/trash-all/",
                success: function(output) {
                    $("#tag_trash_tbody").html(output);
                },
            });
        }

        $("form#blog_tag_add").submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "/admin/tag/store/",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(output) {
                    $("form#blog_tag_add")[0].reset();
                    allBlogtag();
                    toastr.success("Tag Added Successfull", "Success");
                },
            });
        });

        /**
         * Blog Tag Edit data Show
         */

        $(document).on("click", "a#tag_edit_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("edit_id");

            $.ajax({
                url: "/admin/tag/edit/" + id,
                success: function(output) {
                    $("#tag-edit-modal-center").modal("show");
                    $('#tag_edit_form input[name="blog_tag_name_en"]').val(
                        output.tag_name_en
                    );
                    $('#tag_edit_form input[name="blog_tag_name_lng"]').val(
                        output.tag_name_lng
                    );
                    $('#tag_edit_form input[name="id"]').val(output.id);
                },
            });
        });

        /**
         * Blog category Edit data Update
         */

        $(document).on("submit", "form#tag_edit_form", function(e) {
            e.preventDefault();
            let id = $('#tag_edit_form input[name="id"] ').val();

            $.ajax({
                url: "/admin/tag/update/" + id,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(output) {
                    allBlogtag();
                    $("#tag_edit_form")[0].reset();
                    $("#tag-edit-modal-center").modal("hide");
                    toastr.success("Tag Updated Succeefully", "Update");
                },
            });
        });

        /**
         * Blog tag Delete
         */

        $(document).on("click", "#tag_delete_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("delete_id");
            $.ajax({
                url: "/admin/tag/move-trash/" + id,
                success: function(output) {
                    allBlogtag();
                    trashBlogtag();
                    toastr.error("Tag move to trash", "Trash");
                },
            });
        });

        /**
         * Blog category Recover
         */

        $(document).on("click", "#tag_trash_recovery_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("recovery_id");
            $.ajax({
                url: "/admin/post/restore/" + id,
                success: function(output) {
                    allBlogtag();
                    trashBlogtag();
                    toastr.success("Tag move to Recovery", "Recovery");
                },
            });
        });

        /**
         * Blog category Delete permanently
         */

        $(document).on("click", "#tag_trash_delete_id", function(e) {
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
                        url: "/admin/tag/destory/" + id,
                        success: function(output) {
                            allBlogtag();
                            trashBlogtag();
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