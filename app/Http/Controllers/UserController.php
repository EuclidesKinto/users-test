<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormUserRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\Contact;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('contact')->get()->all();
        // dd($users);
        return  view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        return  view('users.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormUserRequest $request)
    {
        $data = $request->all();

        try {
            $user = User::create([
                'name' => $data['name'],
                'cpf' => $data['cpf'],
                'rg' => $data['rg'],
            ]);

            $city = City::create([
                'city' =>  $data['city'],
                'state_id' =>  $data['state_id'],
            ]);

            Address::create([
                'user_id' =>  $user->id,
                'zip_code' =>  $data['zip_code'],
                'street' =>  $data['street'],
                'number' =>  $data['number'],
                'complement' =>  $data['complement'],
                'neighborhood' =>  $data['neighborhood'],
                'city_id' =>  $city->id,
                'state_id' =>  $city->state->id,
            ]);

            Contact::create([
                'user_id' =>  $user->id,
                'email' =>  $data['email'],
                'whatsapp' =>  $data['whatsapp'],
            ]);

            session()->flash('message', 'Usuário cadastrado com sucesso!');
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            dd('errro');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::query()->with(['contact', 'address', 'address.city', 'address.state'])->findOrFail($id);
        $states = State::all();
        return view('users.edit', compact('user', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormUserRequest $request, $id)
    {
        $data = $request->all();
        // dd($data);
        $user = User::query()->with(['contact', 'address', 'address.city', 'address.state'])->findOrFail($id);
        // dd($data);
        try {
            $user->update([
                'name' => $data['name'],
                'cpf' => $data['cpf'],
                'rg' => $data['rg'],
            ]);

            $user->address->city->update([
                'city' =>  $data['city'],
                'state_id' =>  $data['state_id'],
            ]);

            $user->address->city->update([
                'city' => $data['city'],
                'state_id' =>  $data['state_id'],
            ]);
            $user->address->update([
                'user_id' =>  $user->id,
                'zip_code' =>  $data['zip_code'],
                'street' =>  $data['street'],
                'number' =>  $data['number'],
                'complement' =>  $data['complement'],
                'neighborhood' =>  $data['neighborhood'],
                'city_id' =>  $user->address->city->id,
                'state_id' => $data['state_id'],
            ]);

            $user->contact->update([
                'user_id' =>  $user->id,
                'email' =>  $data['email'],
                'whatsapp' =>  $data['whatsapp'],
            ]);

            session()->flash('message', 'Usuário atualizado com sucesso!');
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            dd('error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        session()->flash('message', 'Usuário deletado com sucesso!');
        return redirect()->route('users.index');
    }
}
