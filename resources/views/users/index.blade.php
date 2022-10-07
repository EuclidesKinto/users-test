
@extends('layouts.app')

@section('content')

    <div class="container mx-auto py-10 h-64 md:w-4/5 w-11/12 px-6">
        @if(Session::has('message'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
            <span class="font-medium">{{ Session::get('message') }}!</span>
        </div>
        @endif
        <div class="w-full h-full">
            <div class="flex flex-col ">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 ">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full border-2 border-gray-300">
                                @if (!empty($users))

                                <thead class="bg-white border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        #
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Nome
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        E-mail
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Ações
                                    </th>
                                </tr>
                                </thead>
                                @endif
                                <tbody>
                                    @forelse ( $users as $user)
                                        <tr class="bg-gray-100 border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">  {{ $user->id }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ $user->name }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                @if ( empty($user->contact->email))
                                                    user@mail.com
                                                @else
                                                    {{ $user->contact->email}}
                                                @endif
                                            </td>
                                            <td class="text-sm text-gray-900 space-x-3 font-light px-6 py-4 whitespace-nowrap">

                                                <span class="px-3 inline-flex text-sm leading-5 hover:bg-blue-200 rounded bg-blue-100 text-blue-800">
                                                    <a href="{{ route('users.edit', $user->id) }}">Editar</a>
                                                </span>
                                                <span @click="open = !open"  class="px-3 inline-flex text-sm leading-5 hover:bg-red-200 rounded bg-red-100 text-red-800">
                                                    <button type="submit">Deletar</button>
                                                </span>
                                                <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full" style="background-color: rgba(0,0,0,.5);" x-show="open"  >
                                                        <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0" @click.away="open = false">
                                                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                                <h3 class="text-lg font-medium leading-6 text-gray-900">
                                                                <span class="text-red-500">Deletar Usuário:</span>  {{ $user->name }}
                                                                </h3>
                                                            </div>
                                                            <div class="mt-5 sm:mt-6">
                                                                <span class="flex w-full rounded-md shadow-sm">
                                                                    <form action="{{route('users.destroy', ['user' => $user->id])}}" method="post">
                                                                        @csrf
                                                                        @method("DELETE")
                                                                        <button @click="open = false" class="inline-flex justify-center w-full px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">
                                                                            Sim, Quero Deletar!
                                                                        </button>
                                                                    </form>
                                                                </span>
                                                            </div>
                                                        </div>

                                            </td>
                                        </tr>

                                    @empty
                                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                                        <span class="font-medium">Ainda não temos usuários cadastrados -  </span><a href="{{route('users.create')}}" class="hover:underline">Cadastrar</a>
                                    </div>
                                    <form action="{{route('users.destroy', ['user' => $user->id])}}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger">Remover</button>
                                    </form>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




