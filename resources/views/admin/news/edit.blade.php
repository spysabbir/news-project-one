@extends('admin.layouts.admin_master')

@section('title', 'News Edit')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="text">
                    <h4 class="card-title">News</h4>
                    <p class="card-text">Edit</p>
                </div>
                <div class="action_btn">
                    <a href="{{ route('admin.news.index') }}" class="btn btn-primary"><i class="fa-solid fa-file"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <label class="form-label">News Position</label>
                            <select class="form-select" name="news_position">
                                <option >Select Position</option>
                                <option value="Default" @selected($news->news_position == "Default")>Default</option>
                                <option value="Top Slider" @selected($news->news_position == "Top Slider")>Top Slider</option>
                                <option value="Top Right" @selected($news->news_position == "Top Right")>Top Right</option>
                                <option value="Featured" @selected($news->news_position == "Featured")>Featured</option>
                            </select>
                            @error('news_position')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <div class="form-check mt-3 pt-3">
                              <input class="form-check-input" type="checkbox" id="breaking_news" value="Yes" name="breaking_news" @checked($news->breaking_news == "Yes")/>
                              <label class="form-check-label" for="breaking_news"> Breaking News </label>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">News Headline (English)</label>
                            <input type="text" class="form-control" name="news_headline_en" value="{{ $news->translate('en')->news_headline }}"/>
                            @error('news_headline_en')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">News Headline (Bangla)</label>
                            <input type="text" class="form-control" name="news_headline_bn" value="{{ $news->translate('bn')->news_headline }}"/>
                            @error('news_headline_bn')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label class="form-label">News Category</label>
                            <select class="form-select" name="news_category_id">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected($category->id == $news->news_category_id)>{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('news_category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label class="form-label">News Tags</label>
                            <select class="form-select multiple" name="tags[]" multiple>
                                <option value="">Select Tags</option>
                                @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    @if (in_array($tag->id, $news->tags->pluck('id')->toArray()))
                                        selected
                                    @endif>
                                    {{ $tag->tag_name }}
                                </option>
                                @endforeach
                            </select>
                            @error('tags')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label class="form-label">Country</label>
                            <select class="form-select select_country" name="country_id">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country->id }}" @selected($country->id == $news->country_id)>{{ $country->country_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-12 mb-3">
                            <label class="form-label">Division</label>
                            <select class="form-select select_division" name="division_id" id="all_division">
                                <option value="">Select Division</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-12 mb-3">
                            <label class="form-label">District</label>
                            <select class="form-select select_district" name="district_id" id="all_district">
                                <option value="">Select District</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-12 mb-3">
                            <label class="form-label">Upazila</label>
                            <select class="form-select select_upazila" name="upazila_id" id="all_upazila">
                                <option value="">Select Upazila</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-12 mb-3">
                            <label class="form-label">Union</label>
                            <select class="form-select select_union" name="union_id" id="all_union">
                                <option value="">Select Union</option>
                            </select>
                        </div>
                        <div class="col-lg-6 col-12 mb-3">
                            <label class="form-label">News Thumbnail Photo</label>
                            <input type="file" class="form-control" name="news_thumbnail_photo"/>
                            <small class="text-warning">* Top Slider News Thumbnail Photo Size is (800 * 500 px) and Others News Thumbnail Photo Size is (700 * 435 px)</small>
                            @error('news_thumbnail_photo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-12 mb-3">
                            <label class="form-label">News Cover Photo</label>
                            <input type="file" class="form-control" name="news_cover_photo"/>
                            <small class="text-warning">* Top Slider News Cover Photo Size is (850 * 450 px)</small>
                            @error('news_cover_photo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">News Quote (English)</label>
                            <textarea class="form-control" name="news_quote_en" >{{ $news->translate('en')->news_quote }}</textarea>
                            @error('news_quote_en')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">News Quote (Bangla)</label>
                            <textarea class="form-control" name="news_quote_bn" >{{ $news->translate('bn')->news_quote }}</textarea>
                            @error('news_quote_bn')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">News Details (English)</label>
                            <textarea class="form-control" name="news_details_en" id="news_details_en">{{ $news->translate('en')->news_details }}</textarea>
                            @error('news_details_en')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">News Details (Bangla)</label>
                            <textarea class="form-control" name="news_details_bn" id="news_details_bn">{{ $news->translate('bn')->news_details }}</textarea>
                            @error('news_details_bn')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">News Video Link</label>
                            <textarea class="form-control" name="news_video_link" id="news_video_link" placeholder="Enter news video link">{{ $news->news_video_link }}</textarea>
                            <small class="text-warning">* Please enter youtube embed code.</small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.multiple').select2();

        $('.select_country').select2({
            placeholder: 'Select country',
        });
        $('.select_division').select2({
            placeholder: 'Select country first',
        });
        $('.select_district').select2({
            placeholder: 'Select division first',
        });
        $('.select_upazila').select2({
            placeholder: 'Select district first',
        });
        $('.select_union').select2({
            placeholder: 'Select upazila first',
        });

        $('#news_details_en').summernote();

        $('#news_details_bn').summernote();

        // Divisions Data
        $(document).on('change', '.select_country', function(e){
            e.preventDefault();
            var country_id = $(this).val();
            $.ajax({
                url: '{{ route('admin.get.divisions') }}',
                method: 'POST',
                data: {country_id:country_id},
                success: function(response) {
                    $('#all_division').html(response);
                }
            });
        })
        // District Data
        $(document).on('change', '.select_division', function(e){
            e.preventDefault();
            var division_id = $(this).val();
            $.ajax({
                url: '{{ route('admin.get.districts') }}',
                method: 'POST',
                data: {division_id:division_id},
                success: function(response) {
                    $('#all_district').html(response);
                }
            });
        })
        // Upazila Data
        $(document).on('change', '.select_district', function(e){
            e.preventDefault();
            var district_id = $(this).val();
            $.ajax({
                url: '{{ route('admin.get.upazilas') }}',
                method: 'POST',
                data: {district_id:district_id},
                success: function(response) {
                    $('#all_upazila').html(response);
                }
            });
        })
        // Union Data
        $(document).on('change', '.select_upazila', function(e){
            e.preventDefault();
            var upazila_id = $(this).val();
            $.ajax({
                url: '{{ route('admin.get.unions') }}',
                method: 'POST',
                data: {upazila_id:upazila_id},
                success: function(response) {
                    $('#all_union').html(response);
                }
            });
        })
    });
</script>
@endsection
