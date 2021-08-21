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

        /**
         * Product Brand Js Start
         */

        // Brand Added Image preview

        $(document).on(
            "change",
            '#brandAddform input[name="logo"]',
            function(e) {
                let img_url = URL.createObjectURL(e.target.files[0]);

                $("#brand_upload_img")
                    .attr("src", img_url)
                    .css("width", "120")
                    .css("height", "80");
            }
        );

        $(document).on("click", ".brand_im_hide", function(e) {
            e.preventDefault();
            let img_url = $('#brandAddform input[name="logo"]').val("");
            $("#brand_upload_img")
                .attr("src", "")
                .css("width", "0")
                .css("height", "0");
        });

        // Datatable intigrate

        $("#brandTable").DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: "/brand",
            },

            columns: [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                },

                {
                    data: "name_en",
                    name: "name_en",
                },
                {
                    data: "name_bn",
                    name: "name_bn",
                },
                {
                    data: "logo",
                    name: "logo",
                    render: (data, type, full, meta) => {
                        return `<img src="${data}">`;
                    },
                },

                {
                    data: "time",
                    name: "time",
                },

                {
                    data: "action",
                    name: "action",
                },
            ],
        });

        // Add Brand
        $(document).on("submit", "#brandAddform", function(e) {
            e.preventDefault();

            let name_en = $('#brandAddform input[name="brand_en"]').val();

            if (name_en == "") {
                $(".err").html("This field is required");
            } else {
                $.ajax({
                    url: "/brand",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(output) {
                        if (output) {
                            $("#brandTable").DataTable().ajax.reload();
                            showBrandcount();
                            $("#brandAddform")[0].reset();
                            $("#brand_upload_img")
                                .attr("src", "")
                                .css("width", "0")
                                .css("height", "0");
                            toastr.success("Brand Added Succeefully", "Add");
                        } else {
                            toastr.error("Something went wrong!", "Error");
                        }
                    },
                });
            }
        });

        // Brand Edit Model Show with data
        $(document).on("click", "#brand_edit_id", function() {
            let id = $(this).attr("brand_edit");
            $.ajax({
                url: "brand/edit/" + id,
                success: function(output) {
                    $("#brand_edit_model").modal("show");
                    $('#brand_edit_form input[name="brand_en"]').val(
                        output.name_en
                    );
                    $('#brand_edit_form input[name="brand_bn"]').val(
                        output.name_bn
                    );
                    $('#brand_edit_form input[name="old_logo"]').val(
                        output.logo
                    );
                    $('#brand_edit_form input[name="id"]').val(output.id);
                },
            });
        });

        // Brand Update Code Start from Here

        $(document).on("submit", "#brand_edit_form", function(e) {
            e.preventDefault();
            let id = $('#brand_edit_form input[name="id"]').val();
            $.ajax({
                url: "/brand/update/" + id,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(output) {
                    if (output) {
                        $("#brandTable").DataTable().ajax.reload();
                        showBrandcount();
                        $("#brand_edit_form")[0].reset();
                        $("#brand_edit_model").modal("hide");
                        toastr.success("Brand Updated Succeefully", "Update");
                    } else {
                        toastr.error("Something went wrong!", "Error");
                    }
                },
            });
        });

        // Brand move to trash
        $(document).on("click", "#brand_delete_id", function(e) {
            e.preventDefault();

            let id = $(this).attr("brand_trash");

            $.ajax({
                url: "/brand/trash/" + id,
                success: function(output) {
                    if (output) {
                        $("#brandTable").DataTable().ajax.reload();
                        showBrandcount();
                        toastr.error(
                            "Brand move to trash Succeefully",
                            "Trash"
                        );
                    } else {
                        toastr.error("Something went wrong!", "Error");
                    }
                },
            });
        });

        // brand index count show
        showBrandcount();

        function showBrandcount() {
            $.ajax({
                url: "/brand/showcount",
                success: function(output) {
                    $(".count_brand").html(output);
                },
            });
        }

        // index page load

        // Datatable intigrate

        $("#brandTrashTable").DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: "/brand/trash",
            },

            columns: [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                },

                {
                    data: "name_en",
                    name: "name_en",
                },
                {
                    data: "name_bn",
                    name: "name_bn",
                },
                {
                    data: "logo",
                    name: "logo",
                },

                {
                    data: "time",
                    name: "time",
                },

                {
                    data: "action",
                    name: "action",
                },
            ],
        });

        // Brand Recovery

        $(document).on("click", "#brand_recover_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("brand_recovery");

            $.ajax({
                url: "/brand/recovery/" + id,
                success: function(output) {
                    if (output) {
                        $("#brandTable").DataTable().ajax.reload();
                        showBrandcount();
                        toastr.success("Brand restore Succeefully", "Restore");
                    } else {
                        toastr.error("Something went wrong!", "Error");
                    }
                },
            });
        });

        /**
         * Brand Delete permanently
         */

        $(document).on("click", "#brand_fdel_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("brand_delete");

            swal({
                title: "Deleted",
                text: "Are you sure , You want Delete this brand Parmanently?",
                icon: "error",
                dangerMode: true,
                buttons: ["Cancel", "Delete"],
            }).then((action) => {
                if (action) {
                    $.ajax({
                        url: "/brand/delete/" + id,
                        success: function(output) {
                            if (output) {
                                $("#brandTrashTable").DataTable().ajax.reload();
                                showBrandcount();
                                toastr.error(
                                    "Brand Delete Parmanently",
                                    "Deleted"
                                );
                            } else {
                                toastr.error("Something goes wrong", "Error");
                            }
                        },
                    });
                } else {
                    toastr.success("Brand is Safe", "Safe");
                }
            });
        });

        /**
         * Product Tag Js Start
         */

        // Datatable intigrate

        $("#producttagTable").DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: "/tag",
            },

            columns: [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                },

                {
                    data: "name_en",
                    name: "name_en",
                },
                {
                    data: "name_bn",
                    name: "name_bn",
                },
                {
                    data: "status",
                    name: "status",
                    render: (data, type, full, meta) => {
                        return `${data}`;
                    },
                },

                {
                    data: "time",
                    name: "time",
                },

                {
                    data: "action",
                    name: "action",
                },
            ],
        });

        // Add Brand
        $(document).on("submit", "#producttagAddform", function(e) {
            e.preventDefault();

            let name_en = $(
                '#producttagform input[name="producttag_en"]'
            ).val();

            if (name_en == "") {
                $(".err").html("This field is required");
            } else {
                $.ajax({
                    url: "/tag",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(output) {
                        if (output) {
                            $("#producttagTable").DataTable().ajax.reload();
                            showBrandcount();
                            $("#producttagAddform")[0].reset();
                            toastr.success("Tag Added Succeefully", "Add");
                        } else {
                            toastr.error("Something goes wrong!", "Error");
                        }
                    },
                });
            }
        });

        // Product Tag Edit Model Show with data
        $(document).on("click", "#producttag_edit_id", function() {
            let id = $(this).attr("producttag_edit");
            $.ajax({
                url: "tag/edit/" + id,
                success: function(output) {
                    $("#producttag_edit_model").modal("show");
                    $('#producttag_edit_form input[name="producttag_en"]').val(
                        output.name_en
                    );
                    $('#producttag_edit_form input[name="producttag_bn"]').val(
                        output.name_bn
                    );
                    $('#producttag_edit_form input[name="id"]').val(output.id);
                },
            });
        });

        // Brand Update Code Start from Here

        $(document).on("submit", "#producttag_edit_form", function(e) {
            e.preventDefault();
            let id = $('#producttag_edit_form input[name="id"]').val();
            $.ajax({
                url: "/tag/update/" + id,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(output) {
                    if (output) {
                        $("#producttagTable").DataTable().ajax.reload();
                        showproducttagcount();
                        $("#producttag_edit_form")[0].reset();
                        $("#producttag_edit_model").modal("hide");
                        toastr.info("Tag Updated Succeefully", "Update");
                    } else {
                        toastr.error("Something went wrong!", "Error");
                    }
                },
            });
        });

        // Brand move to trash
        $(document).on("click", "#producttag_delete_id", function(e) {
            e.preventDefault();

            let id = $(this).attr("producttag_trash");

            $.ajax({
                url: "/tag/trash/" + id,
                success: function(output) {
                    if (output) {
                        $("#producttagTable").DataTable().ajax.reload();
                        showproducttagcount();
                        toastr.error("Tag move to trash Succeefully", "Trash");
                    } else {
                        toastr.error("Something went wrong!", "Error");
                    }
                },
            });
        });

        // brand index count show
        showproducttagcount();

        function showproducttagcount() {
            $.ajax({
                url: "/tag/showcount",
                success: function(output) {
                    $(".count_producttag").html(output);
                },
            });
        }

        // index page load

        // Datatable intigrate

        $("#producttagTrashTable").DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: "/tag/trash",
            },

            columns: [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                },

                {
                    data: "name_en",
                    name: "name_en",
                },
                {
                    data: "name_bn",
                    name: "name_bn",
                },

                {
                    data: "time",
                    name: "time",
                },

                {
                    data: "action",
                    name: "action",
                },
            ],
        });

        // Brand Recovery

        $(document).on("click", "#producttag_recover_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("producttag_recovery");

            $.ajax({
                url: "/tag/recovery/" + id,
                success: function(output) {
                    if (output) {
                        $("#producttagTable").DataTable().ajax.reload();
                        showproducttagcount();
                        toastr.success("Tag restore Succeefully", "Restore");
                    } else {
                        toastr.error("Something went wrong!", "Error");
                    }
                },
            });
        });

        /**
         * Brand Delete permanently
         */

        $(document).on("click", "#producttag_fdel_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("producttag_delete");

            swal({
                title: "Deleted",
                text: "Are you sure , You want Delete this tag Parmanently?",
                icon: "error",
                dangerMode: true,
                buttons: ["Cancel", "Delete"],
            }).then((action) => {
                if (action) {
                    $.ajax({
                        url: "/tag/delete/" + id,
                        success: function(output) {
                            if (output) {
                                $("#brandTrashTable").DataTable().ajax.reload();
                                showBrandcount();
                                toastr.error(
                                    "Tag Delete Parmanently",
                                    "Deleted"
                                );
                            } else {
                                toastr.error("Something goes wrong", "Error");
                            }
                        },
                    });
                } else {
                    toastr.success("Tag is Safe", "Safe");
                }
            });
        });
    });
})(jQuery);
