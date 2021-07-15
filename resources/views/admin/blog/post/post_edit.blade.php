@extends('admin.layouts.admin_master')

@section('admin')

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <form  method="POST" enctype="multipart/form-data" action="{{ route('admin.update' , $post -> id) }}">
                    @csrf
                    @php
                    $feature = json_decode($post -> feature);
                    @endphp


                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Post Format</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="post_type" id="blog_post_edit_format">
                                <option value="Null">--Select Post Format--</option>
                                <option {{ ($feature -> post_type == 'Image') ? 'selected' : '' }} value="Image">Image</option>
                                <option {{ ($feature -> post_type == 'Gallery') ? 'selected' : '' }} value="Gallery">Gallery</option>
                                <option {{ ($feature -> post_type == 'Video') ? 'selected' : '' }} value="Video">Video</option>
                                <option {{ ($feature -> post_type == 'Audio') ? 'selected' : '' }} value="Audio">Audio</option>
                            </select>
                            @error('post_type')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Post title</label>
                        <div class="col-lg-9">
                            <input value="{{ $post -> title }}" name="title" type="text" class="form-control">
                            @error('title')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                        </div>
                    </div>




                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Category</label>
                        <div class="col-md-9">
                        @php
                            $catgeory_array = [];
                            foreach ( $post -> categories as $category_single){
                                array_push($catgeory_array , $category_single -> id)
                            }

                        @endphp

                        <div class="checkbox d-inline-block mr-2">
                            @foreach ($categories as $category)
                                <input value="{{ $category -> id }}" name="category[]" type="checkbox" id="md_checkbox_{{ $category -> id }}" class="filled-in chk-col-success"  @if(in_array($category -> id ,   $catgeory_array)) checked @endif>
                                <label for="md_checkbox_{{ $category -> id }}">{{ $category -> category_name_en }}</label> &nbsp; &nbsp;

                            @endforeach
                         </div>
                            {{-- @error('category[]')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                            <br>
                            <br> --}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Tags</label>
                        <div class="col-lg-9">
                            <select class="form-control select2" multiple="multiple" data-placeholder="Select Tag"
                            style="width: 100%;" name="tag[]">

                            @foreach ($tags as $tag )
                                @foreach ($post -> tags as $tag_name)
                                     <option {{ ($tag_name -> id ==  $tag -> id  ) ? 'selected' : '' }} value="{{ $tag -> id  }}">{{ $tag -> tag_name_en }}</option>
                                @endforeach

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
                                    <input value="{{ $feature -> image }}" name="old_image" style="display:none" type="file">
                                    <input name="image" style="display:none" type="file" id="post_img_select_edit"  class="custom-file-input">
                                    <label class="custom-file-label" for="post_img_select_edit">Choose file</label>
                                </div>
                                <img src="{{ (!empty( $feature -> image )) ? url('uploads/post/' .  $feature -> image): url('')}}" class="post_single_image_show" height="{{ (!empty( $feature -> image )) ? '200px' : '' }}">

                            </div>
                        </div>
                    </div>

                    <div class="post-gallery">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Post Gallery Image</label>
                            <div class="col-lg-9">
                                <div class="custom-file">
                                    @foreach ($feature -> gallery as $gall)
                                        <input value="{{ $gall }}" style="display:none" name="old_gallery[]" type="file"
                                         multiple>
                                    @endforeach
                                    <input style="display:none" name="gallery[]" type="file" id="post_img_select_gallary_edit"
                                    multiple class="custom-file-input">
                                    <label class="custom-file-label" for="post_img_select_gallary_edit">Choose file</label>
                                </div>
                                <div class="post_multiple_image_show">
                                    @if(!empty($feature -> gallery))
                                        @foreach ($feature -> gallery as $gall)
                                            <img src="{{ asset('uploads/post/' . $gall) }}" height="200px" alt="">
                                        @endforeach
                                    @endif
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="post-video">
                        <div class="form-group  row">
                            <label class="col-lg-3 col-form-label">Post Video Link</label>
                            <div class="col-lg-9">
                                <input value="{{ $feature -> video }}" name="old_video" type="hidden" class="form-control">
                                <input  name="video" type="text" class="form-control">
                                <span>Please Paste a Embeded Code of our video</span>
                            </div>
                        </div>
                    </div>

                    <div class="post-audio">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Post Audio</label>
                            <div class="col-lg-9">
                                <div class="custom-file">
                                    <input style="display:none" name="old_audio" type="file" value="{{ $feature -> audio }}">

                                     <input style="display:none" name="audio" type="file" id="post_audio_select"
                                     class="custom-file-input">
                                    <label class="custom-file-label" for="post_audio_select">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Content</label>
                        <div class="col-lg-9">
                            <textarea name="content" rows="10" cols="180">{{ $post -> content }}</textarea>
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
