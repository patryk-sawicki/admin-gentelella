<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ $fieldName ?? '' }} <span class="required">*</span>
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" name="{{ $fieldName ?? '' }}" value="{{ $value ?? '' }}" id="{{ $fieldName ?? '' }}" placeholder="{{ $fieldData->placeholder ?? $fieldData->name ?? '' }}" class="form-control col-md-7 col-xs-12">
    </div>
</div>