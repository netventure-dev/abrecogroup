@php $editing = isset($role) @endphp

<div class="row">
    <x-inputs.group class="col-sm-6">
        <x-inputs.text name="name" label="{{ __('Name') }}" value="{{ old('name', $editing ? $role->name : '') }}">
        </x-inputs.text>
    </x-inputs.group>
</div>
<div class="form-group row">

    <div class="mt-2 form-group col-sm-12">
        <h5> {{ __('Assign Permissions') }}</h5>

        @foreach ($permissions->chunk(4) as $items)
            <div class="row">
                @foreach ($items as $permission)
                    <div class="pt-2 col-md-3">
                        <x-inputs.checkbox id="permission{{ $permission->id }}" name="permissions[]"
                            label="{{ ucfirst($permission->name) }}" value="{{ $permission->id }}"
                            :checked="isset($role) ? $role->hasPermissionTo($permission) : false"
                            :add-hidden-value="false">
                        </x-inputs.checkbox>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
