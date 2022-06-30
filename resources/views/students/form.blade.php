<div class="row">
    <div class="mb-3 col-md-6">
        <div class="form-group">
            <label>First Name<span class="text-danger">*</span></label>
            <input type="text" value="{{ isset($student) ? $student->first_name : '' }}" name="first_name"
                class="form-control" placeholder="Enter First Name">
            <span class="invalid-feedback"></span>
        </div>
    </div>

    <div class="mb-3 col-md-6">
        <div class="form-group">
            <label>Last Name<span class="text-danger">*</span></label>
            <input type="text" name="last_name" value="{{ isset($student) ? $student->last_name : '' }}"
                class="form-control" placeholder="Enter Last Name">
            <span class="invalid-feedback"></span>
        </div>
    </div>

    <div class="mb-3 col-md-6">
        <div class="form-group">
            <label>Email<span class="text-danger">*</span></label>
            <input type="email" name="email" value="{{ isset($student) ? $student->email : '' }}" class="form-control"
                placeholder="Enter Email">
            <span class="invalid-feedback"></span>
        </div>
    </div>

    <div class="mb-3 col-md-6">
        <div class="form-group">
            <label>Registration No<span class="text-danger">*</span></label>
            <input type="text" name="registration_no" value="{{ isset($student) ? $student->registration_no : '' }}"
                class="form-control" placeholder="Enter Registration No">
            <span class="invalid-feedback"></span>
        </div>
    </div>

    <div class="mb-3 col-md-6">
        <div class="form-group">
            <label>Photo<span class="text-danger">*</span></label>
            <input class="form-control" name="photo" type="file">
            @if(isset($student) && Storage::exists($student->photo))
            <a href="{{ asset($student->photo) }}">View</a>
            @endif
            <span class="invalid-feedback"></span>
        </div>
    </div>

    <div class="mb-3 col-md-6">
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" value="" class="form-control" autocomplete="false" readonly
                onfocus="this.removeAttribute('readonly');" placeholder="Enter Password">
            <small class="fst-italic text-muted">While adding student by default email will be the password.</small>
            <span class="invalid-feedback"></span>
        </div>
    </div>
</div>