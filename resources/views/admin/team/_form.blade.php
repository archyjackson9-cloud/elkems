<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control"
               value="{{ old('name', $team->name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Position / Title <span class="text-danger">*</span></label>
        <input type="text" name="position" class="form-control"
               value="{{ old('position', $team->position ?? '') }}" required>
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Bio</label>
        <textarea name="bio" rows="4" class="form-control">{{ old('bio', $team->bio ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Profile Photo</label>
        @if(isset($team) && $team->photo)
        <div class="mb-2">
            <img src="{{ asset('storage/'.$team->photo) }}" alt=""
                 style="width:70px;height:70px;border-radius:50%;object-fit:cover">
        </div>
        @endif
        <input type="file" name="photo" class="form-control" accept="image/*" data-preview="team-preview">
        <img id="team-preview" src="#" alt="" style="display:none;width:70px;height:70px;border-radius:50%;object-fit:cover;margin-top:8px">
        <div class="form-text">Max 2 MB. Square image recommended.</div>
    </div>
    <div class="col-md-3">
        <label class="form-label fw-semibold">Sort Order</label>
        <input type="number" name="sort_order" class="form-control" min="0"
               value="{{ old('sort_order', $team->sort_order ?? 0) }}">
    </div>
    <div class="col-md-3 d-flex align-items-end pb-1">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_active" id="teamActive"
                   value="1" {{ old('is_active', $team->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="teamActive">Active</label>
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">LinkedIn URL</label>
        <input type="url" name="linkedin_url" class="form-control"
               value="{{ old('linkedin_url', $team->linkedin_url ?? '') }}" placeholder="https://linkedin.com/in/...">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Twitter URL</label>
        <input type="url" name="twitter_url" class="form-control"
               value="{{ old('twitter_url', $team->twitter_url ?? '') }}" placeholder="https://twitter.com/...">
    </div>
</div>
