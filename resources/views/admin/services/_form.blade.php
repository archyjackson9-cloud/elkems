<div class="row g-3">
    <div class="col-md-9">
        <label class="form-label fw-semibold">Service Title <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $service->title ?? '') }}" required>
    </div>
    <div class="col-md-3">
        <label class="form-label fw-semibold">Sort Order</label>
        <input type="number" name="sort_order" class="form-control" min="0"
               value="{{ old('sort_order', $service->sort_order ?? 0) }}">
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
        <textarea name="description" rows="4" class="form-control" required>{{ old('description', $service->description ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Icon (Bootstrap Icon name)</label>
        <div class="input-group">
            <span class="input-group-text"><i id="iconPreview" class="bi bi-{{ old('icon', $service->icon ?? 'grid') }}"></i></span>
            <input type="text" name="icon" id="iconInput" class="form-control"
                   value="{{ old('icon', $service->icon ?? '') }}"
                   placeholder="e.g. link-45deg, building, briefcase">
        </div>
        <div class="form-text">Browse icons at <a href="https://icons.getbootstrap.com" target="_blank">icons.getbootstrap.com</a></div>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Badge Labels</label>
        <input type="text" name="badge_labels" class="form-control"
               value="{{ old('badge_labels', $service->badge_labels ?? '') }}"
               placeholder="SC, PM, LG">
        <div class="form-text">Comma-separated abbreviations shown as circles (e.g. SC,PM,LG).</div>
    </div>
    <div class="col-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_active" id="svcActive"
                   value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="svcActive">Active (visible on website)</label>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('iconInput').addEventListener('input', function() {
        document.getElementById('iconPreview').className = 'bi bi-' + (this.value || 'grid');
    });
</script>
@endpush
