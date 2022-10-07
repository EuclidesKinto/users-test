
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
                                <tbody>
                                    @forelse ( $users as $user)
                                        <tr class="bg-gray-100 border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">  {{ $user->id }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ $user->name }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                @if ($user->contact->email)
                                                    {{ $user->contact->email}}
                                                @else
                                                    user@mail.com
                                                @endif
                                            </td>
                                            <td class="text-sm text-gray-900 space-x-3 font-light px-6 py-4 whitespace-nowrap">

                                                <span class="px-3 inline-flex text-sm leading-5 hover:bg-blue-200 rounded bg-blue-100 text-blue-800">
                                                    <a href="{{ route('users.edit', $user->id) }}">Editar</a>
                                                </span>
                                                <span class="px-3 inline-flex text-sm leading-5 hover:bg-red-200 rounded bg-red-100 text-red-800">
                                                    <form action="{{route('users.destroy', ['user' => $user->id])}}" method="post">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button type="submit">Deletar</button>
                                                    </form>
                                                </span>
                                            </td>
                                        </tr>

                                    @empty
                                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                                        <span class="font-medium">Ainda não temos usuários cadastrados -  </span><a href="{{route('users.create')}}" class="hover:underline">Cadastrar</a>
                                    </div>
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




