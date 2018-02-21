<div class="form-group" style="margin-bottom: 0px">
	<select type="{{ $type }}" id="{{ $id }}" name="{{ $field }}" value="{{ old($field) }}" class="{{ $class }}"></select>
		@if ($errors->has($field))
			{!! $errors->first($field, '<span class="help-block alert alert-warning">:message</span>') !!}
		@endif
</div>