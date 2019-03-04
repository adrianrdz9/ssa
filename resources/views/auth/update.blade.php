@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Editar cuenta</h2>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('updateAccount') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}*</label>
    
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $user->name) }}" required autofocus>
    
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last name') }}*</label>
    
                                <div class="col-md-8">
                                    <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
    
                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>    
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}*</label>
    
                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', $user->email) }}" required>
    
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group row">
                                <label for="height" class="col-md-4 col-form-label text-md-right">{{ __('Height') }}*</label>
    
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="height" type="text" class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}" name="height" value="{{ old('height', $user->height) }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">cm</span>
                                        </div>
                                    </div>
    
                                    @if ($errors->has('height'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('height') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>  
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group row">
                                <label for="weight" class="col-md-4 col-form-label text-md-right">{{ __('Weight') }}*</label>
    
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="weight" type="text" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" name="weight" value="{{ old('weight', $user->weight) }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
    
                                    @if ($errors->has('weight'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('weight') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>  
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group row">
                                <label for="birthdate" class="col-md-4 col-form-label text-md-right">{{ __('Birthdate') }}*</label>
    
                                <div class="col-md-8">
                                    <input id="birthdate" type="date" class="form-control{{ $errors->has('birthdate') ? ' is-invalid' : '' }}" name="birthdate" value="{{ old('birthdate', $user->birthdate) }}" required>
    
                                    @if ($errors->has('birthdate'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('birthdate') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>  
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group row">
                                <label for="career" class="col-md-4 col-form-label text-md-right">{{ __('Career') }}</label>
    
                                <div class="col-md-8">
                                    <select id="career" class="form-control{{ $errors->has('career') ? ' is-invalid' : '' }}" name="career" required>
                                        @foreach ($careers as $career)
                                            <option value="{{$career}}" {{ old('career', $user->career) == $career ? 'selected' : '' }}>{{$career}}</option>
                                        @endforeach
                                    </select>
                                    
                                    @if ($errors->has('career'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('career') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>  
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group row">
                                <label for="semester" class="col-md-4 col-form-label text-md-right">{{ __('Semester') }}</label>
    
                                <div class="col-md-8">
                                    <select id="semester" class="form-control{{ $errors->has('semester') ? ' is-invalid' : '' }}" name="semester" required>
                                        @for ($i = 1; $i <= 10; $i++)
                                            @switch($i)
                                                @case(1)
                                                    {{$semester = '1er'}}
                                                    @break
                                                @case(2)
                                                    {{$semester = '2do'}}
                                                    @break
                                                @case(3)
                                                    {{$semester = '3er'}}
                                                    @break
                                                @default
                                                    {{$semester = $i.'º'}}
                                            @endswitch
                                            {{ $semester .= ' semestre' }}
                                            <option value="{{$semester}}" {{ old('semester', $user->semester) == $semester ? 'selected' : ''  }}>{{$semester}}</option>
                                        @endfor
                                        
                                    </select>
                                    
                                    @if ($errors->has('semester'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('semester') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group row">
                                <label for="curp" class="col-md-4 col-form-label text-md-right">{{ __('CURP') }}</label>
    
                                <div class="col-md-8">
                                    <input id="curp" type="text" class="form-control{{ $errors->has('curp') ? ' is-invalid' : '' }}" name="curp" value="{{ old('curp', $user->curp) }}">
    
                                    @if ($errors->has('curp'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('curp') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>  
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
    
                                <div class="col-md-8">
                                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address', $user->address) }}">
    
                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group row">
                                <label for="medical_service" class="col-md-4 col-form-label text-md-right">{{ __('Medical service type') }}*</label>
    
                                <div class="col-md-8">
                                    <select id="medical_service" class="form-control{{ $errors->has('medical_service') ? ' is-invalid' : '' }}" name="medical_service" value="{{ old('medical_service', $user->medical_service) }}" required>
                                        <option value="IMSS">IMSS</option>
                                    </select>
                                    
                                    @if ($errors->has('medical_service'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('medical_service') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group row">
                                <label for="blood_type" class="col-md-4 col-form-label text-md-right">{{ __('Blood type') }}*</label>
    
                                <div class="col-md-8">
                                    <select id="blood_type" class="form-control{{ $errors->has('blood_type') ? ' is-invalid' : '' }}" name="blood_type" required>
                                        @foreach ($bloodTypes as $bt)
                                            <option value="{{$bt}}" {{old('blood_type', $user->blood_type) == $bt ? 'selected' : '' }}>{{$bt}}</option>
                                        @endforeach

                                    </select>
                                    
                                    @if ($errors->has('blood_type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('blood_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group row">
                                <label for="medical_card_no" class="col-md-4 col-form-label text-md-right">{{ __('Medical card number') }}*</label>
    
                                <div class="col-md-8">
                                    <input id="medical_card_no" type="text" class="form-control{{ $errors->has('medical_card_no') ? ' is-invalid' : '' }}" name="medical_card_no" value="{{ old('medical_card_no', $user->medical_card_no) }}" required>
    
                                    @if ($errors->has('medical_card_no'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('medical_card_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group row">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone number') }}*</label>
    
                                <div class="col-md-8">
                                    <input id="phone_number" type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" required>
    
                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                        </div>
                    </div>         
                    <hr>
                    <profile-avatar-input src="{{ $user->avatarPath() }}"></profile-avatar-input>
                    <div class="mt-2"></div>
                    <carnet-input src="{{$user->carnetUrl()}}"></carnet-input>
                    <div class="mt-2"></div>
                    <credencial-input src="{{$user->credencialUrl()}}"></credencial-input>

                    <hr>
                    <span>Cambiar contaseña, si no quieres cambiarla deja esta parte en blanco</span>
                    <div class="form-group row mt-4">
                        <div class="col-xs-12 col-md-6">
                            <div class="row">
                                <label for="password" class="col-md-4 form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-8">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 row">
                            <label for="current_password" class="col-4 form-label text-right">Contraseña actual (para guardar los cambios)*</label>
                            
                            <div class="col-8">
                                <input id="current_password" type="password" class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}" name="current_password" required>

                                @if ($errors->has('current_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>


                    <div class="form-group row mb-4 mt-4">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('Actualizar') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection