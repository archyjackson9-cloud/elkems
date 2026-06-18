<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Partner / Organisation Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control"
               value="{{ old('name', $client->name ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Sort Order</label>
        <input type="number" name="sort_order" class="form-control" min="0"
               value="{{ old('sort_order', $client->sort_order ?? 0) }}">
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" class="form-control" rows="3"
                  placeholder="Brief profile or description of this partner">{{ old('description', $client->description ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Logo Image</label>
        @if(isset($client) && $client->logo)
        <div class="mb-2">
            <img src="{{ asset('storage/'.$client->logo) }}" alt=""
                 style="max-height:50px;max-width:120px;object-fit:contain;border:1px solid #eee;padding:4px;border-radius:4px">
        </div>
        @endif
        <input type="file" name="logo" class="form-control" accept="image/*" data-preview="client-logo-preview">
        <img id="client-logo-preview" src="#" alt=""
             style="display:none;max-height:50px;max-width:120px;object-fit:contain;margin-top:8px;border:1px solid #eee;padding:4px;border-radius:4px">
        <div class="form-text">Upload PNG, JPG, SVG. Max 2 MB. Leave blank to use text logo.</div>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Website URL</label>
        <input type="url" name="website_url" class="form-control"
               value="{{ old('website_url', $client->website_url ?? '') }}" placeholder="https://example.com">
    </div>
    <div class="col-md-8">
        <label class="form-label fw-semibold">Logo Text / HTML (fallback if no image)</label>
        <input type="text" name="logo_text" class="form-control"
               value="{{ old('logo_text', $client->logo_text ?? '') }}"
               placeholder="e.g. Ambassade de France">
        <div class="form-text">Plain text or simple HTML shown when no image is uploaded.</div>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Logo Text Style (CSS)</label>
        <input type="text" name="logo_style" class="form-control"
               value="{{ old('logo_style', $client->logo_style ?? '') }}"
               placeholder="font-weight:700;color:#3DBDA0">
    </div>
    <div class="col-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_active" id="clientActive"
                   value="1" {{ old('is_active', $client->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="clientActive">Active (visible on website)</label>
        </div>
    </div>
</div>
