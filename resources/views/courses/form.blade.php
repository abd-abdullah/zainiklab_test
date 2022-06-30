<div class="row">
    <div class="mb-3 col-md-6">
        <div class="form-group">
            <label>Name<span class="text-danger">*</span></label>
            <input type="text" value="{{ isset($course) ? $course->name : '' }}" name="name"
                class="form-control" placeholder="Enter Name">
            <span class="invalid-feedback"></span>
        </div>
    </div>

    <div class="mb-3 col-md-6">
        <div class="form-group">
            <label>Code<span class="text-danger">*</span></label>
            <input type="text" name="code" value="{{ isset($course) ? $course->code : '' }}"
                class="form-control" placeholder="Enter Code">
            <span class="invalid-feedback"></span>
        </div>
    </div>

    <div class="mb-3 col-md-6">
        <div class="form-group">
            <label>Price<span class="text-danger">*</span></label>
            <input type="number" name="price" min="1" value="{{ isset($course) ? $course->price : '' }}" class="form-control"
                placeholder="Enter Price">
            <span class="invalid-feedback"></span>
        </div>
    </div>

    <div class="mb-3 col-md-6">
        <div class="form-group">
            <label>Thumbnail<span class="text-danger">*</span></label>
            <input class="form-control" name="thumbnail" type="file">
            @if(isset($course) && Storage::exists($course->thumbnail))
            <a href="{{ asset($course->thumbnail) }}">View</a>
            @endif
            <span class="invalid-feedback"></span>
        </div>
    </div>
</div>