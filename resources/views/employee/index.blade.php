<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de empleados') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('employees.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 m-1 mb-2">Crear nuevo producto</a>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Genero</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Area</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Boletin</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modificar</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($employees as $employee)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            {{ $employee->name }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            {{ $employee->email }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            {{ $employee->gender === 'M'? 'Masculino': 'Femenino' }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            {{ $employee->department->name ?? '' }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            {{ $employee->newsletter ? 'Si' : 'No' }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-wrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <i id="{{ $employee->id }}" class="fas fa-edit text-indigo-500 employee_edit cursor-pointer"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-wrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <i id="{{ $employee->id }}" class="fas fa-trash text-red-500 employee_delete cursor-pointer"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $employees->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>

    const categoryDeleteElements = document.getElementsByClassName('employee_delete');
    const categoryEditElements = document.getElementsByClassName('employee_edit');

    Array.from(categoryEditElements).forEach(function(element) {
        element.addEventListener('click', function() {
            const id = this.getAttribute('id')
            window.location.href = `{{ url('employees') }}/${ id }/edit`
        });
    });

    Array.from(categoryDeleteElements).forEach(function(element) {
        element.addEventListener('click', function() {
            const id = this.getAttribute('id')
            const url = `{{ url('employees') }}/${id}`
            const formData = new FormData();
            formData.append("_method", "delete");
            formData.append("_token", "{{csrf_token()}}");
            const requestOptions = {
                method: 'post',
                body: formData,
                redirect: 'follow'
            };
            fetch(url, requestOptions)
                .then(response => response.json())
                .then(data => {
                    if(data.status) {
                        location.reload();
                    }
                })
                .catch(error => console.log('error', error));
        });
    });
</script>
