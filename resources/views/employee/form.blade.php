<div class="px-4 py-5 bg-white sm:p-6">
    <div class="grid grid-cols-1 gap-1">

        <div class="col-span-6 sm:col-span-3">
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text"
                   name="name"
                   id="name"
                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                   value="@if(isset($employee->name)) {{$employee->name}} @else {{ old('name') }} @endif"
            >
        </div>

        <div class="col-span-6 sm:col-span-3">
            <label for="email" class="block text-sm font-medium text-gray-700">Coreo electronico</label>
            <input type="text"
                   name="email"
                   id="email"
                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                   value="@if(isset($employee->email)) {{$employee->email}} @else {{ old('name') }} @endif"
            >
        </div>

        <div class="col-span-6 sm:col-span-3">
            <label for="gender" class="block text-sm font-medium text-gray-700">Genero</label>
            <div>
                <label for="male">Masculino</label>
                <input type="radio" id="male" value="M" name="gender" @if(isset($employee->gender) && $employee->gender === 'M') checked @endif>
            </div>
            <div>
                <label for="female">Femenino</label>
                <input type="radio" id="female" value="M" name="gender" @if(isset($employee->gender) && $employee->gender === 'F') checked @endif>
            </div>
        </div>

        <div class="col-span-6 sm:col-span-3">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Area</label>

            <select id="department_id" name="department_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option name="{{ null }}">Seleccione una categoria</option>
                @foreach($departments as $department)
                    <option  @if(isset($employee->department_id) && ($employee->department_id == $department->id)) selected @endif value="{{ $department->id }}">{{$department->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-span-6 sm:col-span-3">
            <label for="reference" class="block text-sm font-medium text-gray-700">descripcion</label>
            <textarea name="description" id="" cols="30" rows="10" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">@if(isset($employee->description)) {{$employee->description}} @else {{ old('description') }} @endif</textarea>
        </div>

        <div class="col-span-6 sm:col-span-3">
            <input type="checkbox" name="newsletter" id="newsletter" value="1" @if(isset($employee->newsletter) && $employee->newsletter === 1) checked @endif>
            <label for="newsletter">Deseo recibir boletin informativo</label>
        </div>

        <div class="col-span-6 sm:col-span-3">
            <label class="block text-sm font-medium text-gray-700">Roles</label>
            @foreach($roles as  $role)
                <div class="">
                    <input type="checkbox" name="roles[]" id="{{ Str::slug($role->id) }}" value="{{$role->id}}" @if(isset($employee->roles) && array_search($role->id, $employee->roles->pluck('id')->toArray()) !== false) checked @endif>
                    <label for="{{Str::slug($role->id)}}">{{ $role->name }}</label>
                </div>
            @endforeach
        </div>

    </div>
</div>
<div class="px-4 py-3 text-right sm:px-6">
    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Guardar</button>
</div>
