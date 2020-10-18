<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $clientType = Client::getClientType($request->clientType);
        return view('admin.clients.create', ['client' => new Client(), 'clientType' => $clientType]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->_validate($request);
        $data['defaulter'] = $request->has('defaulter');
        $data['clientType'] = Client::getClientType($request->clientType);
        Client::create($data);
        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $clientType = $client->clientType;
        return view('admin.clients.edit', compact('client', 'clientType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $data = $this->_validate($request);
        $data['defaulter'] = $request->has('defaulter');
        $client->fill($data);
        $client->save();
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index');
    }

    protected function _validate(Request $request)
    {
        $clientType = Client::getClientType($request->clientType);
        $documentType = $clientType == Client::TYPE_INDIVIDUAL ? 'cpf' : 'cnpj';
        $client = $request->route('client');
        $clientId = $client instanceof Client ? $client->id : null;
        $rules = [
            'name' => 'required|max:255',
            'document' => "required|unique:clients,document,$clientId|document:$documentType",
            'email' => 'required|email',
            'phone' => 'required',
        ];

        $maritalStatus = implode(',', array_keys(Client::MARITAL_STATUS));

        $rulesIndividual = [
            'dateBirth' => 'required|date',
            'gender' => 'required|in:m,f',
            'maritalStatus' => "required|in:$maritalStatus",
            'physicalDisability' => 'max:255'
        ];

        $rulesLegal = [
            'companyName' => 'required|max:255'
        ];

        return $this->validate($request, $clientType == Client::TYPE_INDIVIDUAL ?
            $rules + $rulesIndividual : $rules + $rulesLegal);
    }
}
