@php
    use App\Client;
@endphp

{{ csrf_field() }}
<input type="hidden" name="clientType" value="{{ $clientType }}">
<div class="form-group">
    <label for="name">Nome</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $client->name) }}">
</div>
<div class="form-group">
    <label for="document">Documento</label>
    <input type="text" class="form-control" id="document" name="document" value="{{ old('document', $client->document) }}">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $client->email) }}">
</div>
<div class="form-group">
    <label for="phone">Telefone</label>
    <input type="phone" class="form-control" id="phone" name="phone" value="{{ old('phone', $client->phone) }}">
</div>

@php
    $maritalStatus = $client->maritalStatus;
@endphp

@if($clientType == Client::TYPE_INDIVIDUAL)
    <div class="form-group">
        <label for="maritalStatus">Estado Civil</label>
        <select class="form-control" id="maritalStatus" name="maritalStatus" value="{{ $maritalStatus }}">
            <option value="">Selecione o estado civil</option>
            <option value="1" {{ old('maritalStatus', $maritalStatus) == 1 ? 'selected="selected"' : ''}}>Solteiro</option>
            <option value="2" {{ old('maritalStatus', $maritalStatus) == 2 ? 'selected="selected"' : ''}}>Casado</option>
            <option value="3" {{ old('maritalStatus', $maritalStatus) == 3 ? 'selected="selected"' : ''}}>Divorciado</option>
        </select>
    </div>
    <div class="form-group">
        <label for="dateBirth">Data de Nascimento</label>
        <input type="date" class="form-control" id="dateBirth" name="dateBirth" value="{{ old('dateBirth', $client->dateBirth) }}">
    </div>

    @php
        $gender = $client->gender;
    @endphp

    <div class="form-group">
        <label>Gênero</label>
        <div class="radio">
            <label>
                <input type="radio" value="m" name="gender" id="m" {{ old('gender', $gender) == 'm' ? 'checked="checked"' : ''}}>Masculino
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" value="f" name="gender" id="f" {{ old('gender', $gender) == 'f' ? 'checked="checked"' : ''}}>Feminino
            </label>
        </div>
    </div>
    <div class="form-group">
        <label for="physicalDisability">Deficiência Física</label>
        <input type="text" class="form-control" id="physicalDisability" name="physicalDisability" value="{{ old('physicalDisability', $client->physicalDisability) }}">
    </div>

    @php
        $defaulter = $client->defaulter;
    @endphp

    <div class="checkbox">
        <label>
            <input type="checkbox" name="defaulter" id="defaulter" {{ old('defaulter, $default') ? 'checked="checked"' : ''}}>Inadimplente?
        </label>
    </div>
@else
<div class="form-group">
    <label for="companyName">Nome Fantasia</label>
    <input type="text" class="form-control" id="companyName" name="companyName" value="{{ old('companyName', $client->companyName) }}">
</div>
@endif
