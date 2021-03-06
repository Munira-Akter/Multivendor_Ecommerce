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
                url: "/producttag",
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
                    url: "/producttag",
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
                url: "producttag/edit/" + id,
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
                url: "/producttag/update/" + id,
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
                url: "/producttag/trash/" + id,
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
                url: "/producttag/showcount",
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
                url: "/producttag/trash",
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
                url: "/producttag/recovery/" + id,
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
                        url: "/producttag/delete/" + id,
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

        /**
         * Product Part JQuery Start from Here
         */
        $(document).on("change", "#thumbnail_img_input", function(e) {
            e.preventDefault();
            let img_url = URL.createObjectURL(e.target.files[0]);
            $("#product_thumbnail")
                .attr("src", img_url)
                .css("width", "120")
                .css("height", "80");
        });

        window.imagePreview = function(t) {
            if (t.files && t.files[0]) {
                for (var i = 0; t.files.length > i; i++) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var thumbnail = "<span>";
                        thumbnail +=
                            '<img class="image" style="width: 120px; height: 80px; margin-right: 20px; position:relative;" class="shadow" src="' +
                            e.target.result +
                            '"/>';
                        thumbnail +=
                            '<a class="removeButton" style="z-index: 999;position: relative;right: 35px;top: -26px;"><i class="fa fa-close"></i></a>';
                        thumbnail += "</span>";
                        $("#image-preview").append(thumbnail);

                        $(".removeButton").on("click", function() {
                            $(this).closest("span").remove();
                            document.getElementById("file").value = "";
                        });
                    };
                    reader.readAsDataURL(t.files[i]);
                }
            }
        };

        /**
         * Slider Part Javascript code start from here
         */

        $("#SliderTable").DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: "/slider",
            },

            columns: [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                },

                {
                    data: "image",
                    name: "image",
                    render: function(data, full) {
                        return `<img src="${data}">`;
                    },
                },
                {
                    data: "link",
                    name: "link",
                },

                {
                    data: "status",
                    name: "status",
                    render: (data, full) => {
                        return `<div class="status-toggle">
                        <input  name="che" type="checkbox" status_id="${data}"  ${
                            data == 1 ? "checked" : ""
                        } id="slider_status" class="check post_check" >
                        <label class="checktoggle">${
                            data == 1 ? "Active" : "Inactive"
                        }</label>
                    </div>`;
                    },
                },
                {
                    data: "action",
                    name: "action",
                },
            ],
        });

        // Slider Status change

        $(document).on(
            "change",
            '#slideradd input[name="image"]',
            function(e) {
                let img_url = URL.createObjectURL(e.target.files[0]);

                $("#slider_img")
                    .attr("src", img_url)
                    .css("width", "120")
                    .css("height", "80");
            }
        );

        // Add Slider
        $(document).on("submit", "#slideradd", function(e) {
            e.preventDefault();
            let slider_img = $('#slideradd input[name="image"]').val();

            let link = $('#slideradd input[name="link"]').val();

            if (link == "" || slider_img == "") {
                $(".err").html("This field is required");
            } else {
                $.ajax({
                    url: "/slider/store",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(output) {
                        if (output) {
                            $("#SliderTable").DataTable().ajax.reload();
                            $("#slideradd")[0].reset();
                            $("#slider_img")
                                .attr("src", "")
                                .css("width", "0")
                                .css("height", "0");
                            toastr.success("Slider Added Succeefully", "Add");
                        } else {
                            toastr.error("Something goes wrong!", "Error");
                        }
                    },
                });
            }
        });

        // slider Edit Code start from here

        $(document).on("click", "#slider_edit_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("slider_edit");

            $.ajax({
                url: "/slider/edit/" + id,
                success: function(output) {
                    if (output) {
                        $("#slider_edit_model").modal("show");
                        $('#slider_edit_form input[name="link"]').val(
                            output.link
                        );
                        $('#slider_edit_form input[name="old_image"]').val(
                            output.image
                        );
                        $("#slider_edit_form #slider_up_img").attr(
                            "src",
                            output.image
                        );
                        $('#slider_edit_form input[name="id"]').val(output.id);
                    } else {
                        toastr.error("Something goes wrong!", "Error");
                    }
                },
            });
        });

        /**
         * Blog category Edit data Update
         */

        $(document).on("submit", "#slider_edit_form", function(e) {
            e.preventDefault();
            let id = $('#slider_edit_form input[name="id"] ').val();

            $.ajax({
                url: "/slider/update/" + id,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(output) {
                    if (output) {
                        $("#SliderTable").DataTable().ajax.reload();
                        $("#slider_edit_form")[0].reset();
                        $("#slider_up_img")
                            .attr("src", "")
                            .css("width", "0")
                            .css("height", "0");
                        $("#slider_edit_model").modal("hide");
                        toastr.success("Slider Updated Succeefully", "Update");
                    } else {
                        toastr.error("Something goes wrong!", "Error");
                    }
                },
            });
        });

        $(document).on(
            "change",
            '#slider_edit_form input[name="new_image"]',
            function(e) {
                let img_url = URL.createObjectURL(e.target.files[0]);
                $("#slider_up_img")
                    .attr("src", img_url)
                    .css("width", "500")
                    .css("height", "200");
            }
        );

        // Slider delete code start from here

        $(document).on("click", "#slider_fdel_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("slider_trash");

            swal({
                title: "Deleted",
                text: "Are you sure , You want Delete this Slider Parmanently?",
                icon: "error",
                dangerMode: true,
                buttons: ["Cancel", "Delete"],
            }).then((action) => {
                if (action) {
                    $.ajax({
                        url: "/slider/delete/" + id,
                        success: function(output) {
                            if (output) {
                                $("#SliderTable").DataTable().ajax.reload();
                                toastr.error(
                                    "Slider Delete Parmanently",
                                    "Deleted"
                                );
                            } else {
                                toastr.error("Something goes wrong", "Error");
                            }
                        },
                    });
                } else {
                    toastr.success("Slider is Safe now", "Safe");
                }
            });
        });

        // Slider Status Update

        // $(document).on("change", "#slider_status", function(e) {
        //     e.preventDefault();

        //     let status_id = $(this).attr("status_id");

        //     alert(status_id);

        //     $.ajax({
        //         url: "/slider/status/" + status_id,
        //         success: function(output) {
        //             if (output) {
        //                 $("#SliderTable").DataTable().ajax.reload();
        //                 toastr.error("Slider updated", "Updated");
        //             } else {
        //                 toastr.error("Something goes wrong", "Error");
        //             }
        //         },
        //     });
        // });

        /**
         * category Part Code Start from Here
         */

        $(".icon-picker").iconPicker();
        $(".icon-picker-edit").iconPicker();

        // ========= Category Add ==============//

        $(document).on(
            "change",
            '#categoryForm input[name="image"]',
            function(e) {
                let img_url = URL.createObjectURL(e.target.files[0]);

                $("#category_img")
                    .attr("src", img_url)
                    .css("width", "120")
                    .css("height", "80");
            }
        );

        $("#CategoryTable").DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: "/productcateory",
            },

            columns: [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                },

                {
                    data: "category",
                    name: "category",
                },
                {
                    data: "icon",
                    name: "icon",
                    render: function(data, full) {
                        if (data == null) {
                            return `No Icon Selected`;
                        } else {
                            return `<i class="${data}"></i>`;
                        }
                    },
                },

                {
                    data: "image",
                    name: "image",
                    render: function(data, full) {
                        if (data == null) {
                            return `No Image Selected`;
                        } else {
                            return `<img src="${data}">`;
                        }
                    },
                },
            ],
        });

        // From catagory load

        allproductcat();

        function allproductcat() {
            $.ajax({
                url: "/productcateory/create",
                success: function(output) {
                    $("#cat_add_from").html(output);
                },
            });
        }

        // Add Category

        $(document).on("submit", "#categoryForm", function(e) {
            e.preventDefault();
            let name_en = $('#categoryForm input[name="name_en"]').val();
            let name_bn = $('#categoryForm input[name="name_bn"]').val();
            if (name_en == "" || name_bn == "") {
                $(".err").html("This field is required");
            } else {
                $.ajax({
                    url: "/productcateory/store",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(output) {
                        if (output) {
                            allproductcat();
                            $("#CategoryTable").DataTable().ajax.reload();
                            $("#categoryForm")[0].reset();
                            $("#category_img")
                                .attr("src", "")
                                .css("width", "0")
                                .css("height", "0");
                            toastr.success("Category Added Succeefully", "Add");
                        } else {
                            toastr.error("Something goes wrong!", "Error");
                        }
                    },
                });
            }
        });

        $(document).on("click", "#product_cat_edit", function(e) {
            e.preventDefault();
            let product_cat_edit = $(this).attr("product_cat_edit");
            $.ajax({
                url: "/productcateory/edit/" + product_cat_edit,
                success: function(output) {
                    $("#product_cat_edit_model").modal("show");
                    $("#categoryUpdateForm input[name='name_en']").val(
                        output.edit_data.name_en
                    );
                    $("#categoryUpdateForm input[name='name_bn']").val(
                        output.edit_data.name_bn
                    );
                    $("#categoryUpdateForm input[name='id']").val(
                        output.edit_data.id
                    );
                    $("#categoryUpdateForm select").html(output.cat);
                    $("#categoryUpdateForm input[name='old_image']").val(
                        output.edit_data.image
                    );
                    $("#categoryUpdateForm input[name='icon']").val(
                        output.edit_data.icon
                    );

                    $("#categoryUpdateForm img#category_edit_img")
                        .attr("src", output.edit_data.image)
                        .css("width", "120")
                        .css("height", "80");
                },
            });
        });

        $(document).on(
            "change",
            '#categoryUpdateForm input[name="image"]',
            function(e) {
                let img_url = URL.createObjectURL(e.target.files[0]);

                $("#category_edit_img")
                    .attr("src", img_url)
                    .css("width", "120")
                    .css("height", "80");
            }
        );

        $(document).on("click", "#product_cat_del", function(e) {
            e.preventDefault();
            let product_cat_del = $(this).attr("product_cat_del");
            swal({
                title: "Deleted",
                text: "Are you sure , You want Delete this Category Parmanently?",
                icon: "error",
                dangerMode: true,
                buttons: ["Cancel", "Delete"],
            }).then((action) => {
                if (action) {
                    $.ajax({
                        url: "/productcateory/delete/" + product_cat_del,
                        success: function(output) {
                            if (output) {
                                allproductcat();
                                $("#CategoryTable").DataTable().ajax.reload();
                                toastr.error(
                                    "category Delete Parmanently",
                                    "Deleted"
                                );
                            } else {
                                toastr.error("Something goes wrong", "Error");
                            }
                        },
                    });
                } else {
                    toastr.success("Category is Safe now", "Safe");
                }
            });
        });

        $(document).on("submit", "#categoryUpdateForm", function(e) {
            e.preventDefault();
            let id = $('#categoryUpdateForm input[name="id"] ').val();

            $.ajax({
                url: "/productcateory/update/" + id,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(output) {
                    if (output) {
                        allproductcat();
                        $("#CategoryTable").DataTable().ajax.reload();
                        $("#categoryUpdateForm")[0].reset();
                        $("#category_edit_img")
                            .attr("src", "")
                            .css("width", "0")
                            .css("height", "0");
                        $("#product_cat_edit_model").modal("hide");
                        toastr.success(
                            "Category Updated Succeefully",
                            "Update"
                        );
                    } else {
                        toastr.error("Something goes wrong!", "Error");
                    }
                },
            });
        });

        // Product Part Start from here
        $("#productTable").DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: "/product",
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
                    data: "brand",
                    name: "brand",
                },

                {
                    data: "code",
                    name: "code",
                },

                {
                    data: "price_s",
                    name: "price_s",
                },

                {
                    data: "stock",
                    name: "stock",
                },

                {
                    data: "status",
                    name: "status",
                    render: function(data, full) {
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

        // Product move to trash
        $(document).on("click", "#product_del_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("product_trash");

            $.ajax({
                url: "/product/trash/" + id,
                success: function(output) {
                    if (output) {
                        $("#productTable").DataTable().ajax.reload();
                        showProductcount();
                        toastr.error(
                            "Product move to trash Succeefully",
                            "Trash"
                        );
                    } else {
                        toastr.error("Something went wrong!", "Error");
                    }
                },
            });
        });

        $("#producttrashTable").DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: "/product/trash-list",
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
                    data: "brand",
                    name: "brand",
                },

                {
                    data: "code",
                    name: "code",
                },

                {
                    data: "price_s",
                    name: "price_s",
                },

                {
                    data: "stock",
                    name: "stock",
                },

                {
                    data: "status",
                    name: "status",
                    render: function(data, full) {
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

        // brand index count show
        showProductcount();

        function showProductcount() {
            $.ajax({
                url: "/product/showcount",
                success: function(output) {
                    $(".product_count").html(output);
                },
            });
        }

        // Brand Recovery

        $(document).on("click", "#product_recovery_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("product_recovery");

            $.ajax({
                url: "/product/recovery/" + id,
                success: function(output) {
                    if (output) {
                        $("#producttrashTable").DataTable().ajax.reload();
                        showProductcount();
                        toastr.success(
                            "Product restore Succeefully",
                            "Restore"
                        );
                    } else {
                        toastr.error("Something went wrong!", "Error");
                    }
                },
            });
        });

        $(document).on("click", "#product_fdel_id", function(e) {
            e.preventDefault();
            let id = $(this).attr("product_del");

            swal({
                title: "Deleted",
                text: "Are you sure , You want Delete this brand Parmanently?",
                icon: "error",
                dangerMode: true,
                buttons: ["Cancel", "Delete"],
            }).then((action) => {
                if (action) {
                    $.ajax({
                        url: "/product/delete/" + id,
                        success: function(output) {
                            if (output) {
                                $("#producttrashTable")
                                    .DataTable()
                                    .ajax.reload();
                                showProductcount();
                                toastr.error(
                                    "Product Delete Parmanently",
                                    "Deleted"
                                );
                            } else {
                                toastr.error("Something goes wrong", "Error");
                            }
                        },
                    });
                } else {
                    toastr.success("Product is Safe", "Safe");
                }
            });
        });

        // Product Attribute Custom Js

        let id = 1;
        $(document).on("click", "#size_collaps", function(e) {
            e.preventDefault();
            $(".size_collaps_box").append(`
                <div id="size-box">
                <div class="bg-info clearfix head">
                    <h6 class="py-2 px-3 fs-15 float-left" type="button" data-toggle="collapse" data-target="#size-${id}" aria-expanded="false" aria-controls="collapseExample">Size-Xl</h6>
                    <button class="close text-light pt-2  pr-2 close-btn float-right">&times;</button>
                </div>


                <div class="card text-center shadow-lg" class="collapse" id="size-${id}">
                    <div class="card-body" >
                    <p class="card-text">
                       <form id="attr-form">
                       <input name="attr_name[]" type="text" placeholder="Attribute Name" class="form-control" name="" id=""> <br>
                       <textarea name="variable[]" value="" id="textarea" class="form-control" aria-invalid="false" placeholder=" Enter Variable name Use PiP Sign for sparate each Variable. e.g. S|M|L|XL" spellcheck="true"></textarea>
                       <br>
                       <input type="submit" value="Add" class="float-right btn btn-sm btn-soft-primary">
                       </form>
                    </p>
                    </div>
                </div>
                </div>
            `);
            id++;
        });

        $(document).on("click", ".close-btn", function() {
            $(this).parent(".head").parent("#size-box").remove();
            $("#attr-form input").val("");
        });

        // Click variavle product btn
        $("input[name='product']").change(function() {
            let checkrd = $(this).val();
            if (checkrd == "var") {
                $(".attr-box").show();
                $(".attr-box").css("background", "#272E48");
            } else if (checkrd == "gen") {
                $(".attr-box").hide();
            }
        });

        // Attribute form sumission
        $(document).on("submit", "#attr-form", function(e) {
            e.preventDefault();
            const postFormData = {
                attr_name: $("input[name='attr_name']").val(),
                variable: $("input[name='variable']").val(),
                _token: $("input[name='_token']").val(),
            };
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            console.log(postFormData._token);
            $.ajax({
                url: "/product/attr/",
                method: "POST",
                data: {
                    myObj: postFormData,
                    _token: "{{ csrf_token() }}",
                },
                contentType: false,
                processData: false,
                success: function(output) {
                    console.log(output);
                },
            });
        });
    });
})(jQuery);
