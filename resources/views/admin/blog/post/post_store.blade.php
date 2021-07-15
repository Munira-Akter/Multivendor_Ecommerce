@extends('admin.layouts.admin_master')

@section('admin')

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <form  method="POST" id="add_post_form" enctype="multipart/form-data" action="{{ route('admin.blog.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Post Format</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="post_type" id="blog_post_format">
                                <option value="Null">--Select Post Format--</option>
                                <option value="Image">Image</option>
                                <option value="Gallery">Gallery</option>
                                <option value="Video">Video</option>
                                <option value="Audio">Audio</option>
                            </select>
                            @error('post_type')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Post title</label>
                        <div class="col-lg-9">
                            <input name="title" type="text" class="form-control">
                            @error('title')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Category</label>
                        <div class="col-md-9">
                            <div class="checkbox d-inline-block mr-2">
                                @foreach ($categories as $category)
                                <input value="{{ $category -> id }}" name="category[]" type="checkbox" id="md_checkbox_{{ $category -> id }}" class="filled-in chk-col-success">

                                <label for="md_checkbox_{{ $category -> id }}">{{ $category -> category_name_en }}</label> &nbsp; &nbsp;
                                @endforeach

                            </div>
                            @error('category[]')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                            <br>
                            <br>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Tags</label>
                        <div class="col-lg-9">
                            <select class="form-control select2" multiple="multiple" data-placeholder="Select Tag"
                            style="width: 100%;" name="tag[]">

                            @foreach ($tags as $tag )
                                <option value="{{ $tag -> id  }}">{{ $tag -> tag_name_en }}</option>
                            @endforeach

                            </select>
                            @error('tag[]')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                            <br><br>

                        </div>
                    </div>

                    <div class="post-image">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Post Image</label>
                            <div class="col-lg-9">
                                <div class="custom-file">
                                    <input name="image" style="display:none" type="file" id="post_img_select"  class="custom-file-input">
                                    <label class="custom-file-label" for="post_img_select">Choose file</label>
                                </div>

                                <img src="" class="post_single_image_show" >

                            </div>
                        </div>
                    </div>

                    <div class="post-gallery">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Post Gallery Image</label>
                            <div class="col-lg-9">
                                <div class="custom-file">
                                    <input style="display:none" name="gallery[]" type="file" id="post_img_select_gallary"
                                    multiple class="custom-file-input">
                                    <label class="custom-file-label" for="post_img_select_gallary">Choose file</label>
                                </div>
                                <div class="post_multiple_image_show"></div>
                            </div>
                        </div>
                    </div>

                    <div class="post-video">
                        <div class="form-group  row">
                            <label class="col-lg-3 col-form-label">Post Video Link</label>
                            <div class="col-lg-9">
                                <input name="video" type="text" class="form-control">
                                <span>Please Paste a Embeded Code of our video</span>
                            </div>
                        </div>
                    </div>

                    <div class="post-audio">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Post Audio</label>
                            <div class="col-lg-9">
                                <div class="custom-file">
                                    <input style="display:none" name="audio" type="file" id="post_audio_select"
                                    multiple class="custom-file-input">
                                    <label class="custom-file-label" for="post_audio_select">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Content</label>
                        <div class="col-lg-9">
                            <textarea name="content" rows="10" cols="180"></textarea>
                        </div>
                    </div>
                    <div class="text-right">
                        <input type="submit" class="btn btn-primary" value="Add New Post"></input>
                    </div>
                </form>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection
