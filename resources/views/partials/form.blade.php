<div class="form-group" style="margin-bottom: 0px">
	<input type="{{ $type }}" id="{{ $id }}" name="{{ $field }}" class="{{ $class }}" value="{{ old($field) }}">
		@if ($errors->has($field))
			{!! $errors->first($field, '<span class="help-block alert alert-warning">:message</span>') !!}
		@endif
</div>