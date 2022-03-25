<x-app-layout>
    <div class="container-notifications">
        @foreach ($errors->all() as $error)
        <div class="notification shadow-xl sm:rounded-lg">
            <div class="container-icon-type">
                <i class="fas fa-exclamation-circle text-red-500 fa-icon-notification"></i>
            </div>
            <div class="container-message text-gray-700">
                <div class="title">
                   <strong>Error</strong>
                </div>
                <div class="message">
                    {{ $error }}
                </div>
            </div>
            <i class="fa fa-times close-element text-gray-700 cursor-pointer"></i>
        </div>
        @endforeach
    </div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear empleado') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="post" action="{{ route('employees.store') }}" autocomplete="off">
                    @csrf
                    @include('employee.form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
