@extends('usuario/inc/layout')

@section('contenido')

<div class="alert alert-danger error hidden"></div>         
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Perfiles</h3>
    </div>
    <div class="panel-body" id="perfilList">
        <ul class="list-group">
            @foreach ($perfiles as $perfil)
            <li class="list-group-item" data-id="{{$perfil->id}}">{{$perfil->titulo}}  <span class="glyphicon glyphicon-floppy-remove deletePerfil pull-right"></span></li>
            @endforeach
            @if (count($perfiles) < 3)
            <li class="list-group-item">
                {{ Form::open(array('url' => 'usuario/perfiles','role'=>'form','id'=>'frmPerfil')) }}            
                <div class="input-group">                  
                    <input type="text" name="titulo" class="form-control" id="nombre" placeholder="Perfil" />
                      <span class="input-group-btn">
                          <button class="btn btn-primary" id="btnPerfil" type="button">Add</button>
                    </span>
                </div><!-- /input-group -->
                {{ Form::close() }}
            </li>
            @endif
        </ul>
    </div>
</div>    

{{ Form::open(array('url' => 'usuario/informacion','role'=>'form','id'=>"formPersonal")) }}            
            <section class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" />
            </section>
            <section class="form-group">
                <label for="email">Apellidos</label>
                <input type="text" name="apellidos" class="form-control" id="apellidos" />
            </section> 
            <section class="form-group input-group btn-group-sm">
                <label for="fecha">Fecha de Nacimiento</label><br />                
                <input type="text" name="fecha" readonly="" class="form-control col-lg-3 fechaN" id="fecha" />
            </section> 
            <section class="form-group">
                <label for="Sexo">Sexo</label>
                {{Form::select('sexo', ['M' => 'Masculino', 'F' => 'Femenino'],'', ['class'=>'form-control'])}}
            </section> 
            <section class="form-group col-lg-6">
                <label for="estados">Estado</label>
                {{--Form::select('estados', $estados,'', ['id'=>'selEstado','class'=>'form-control','site'=>URL::to('ciudades')])--}}
            </section> 
            <section class="form-group col-lg-6">
                <label for="ciudades">Ciudad</label>
                {{Form::select('ciudades', [], '', ['id'=>'selCiudad','class'=>'form-control'])}}
            </section> 
            <section class="form-group">
                <label for="civil">Estado Civil</label>
                {{Form::select('estcivil', ['S'=>'Soltero','C'=>'Casado'], '', ['id'=>'selCivil','class'=>'form-control'])}}
            </section> 
            <input id="txtIdFoto" type="hidden" name="fotoId">
            <input type="submit" id="btnPersonal" value="Guardar" class="btn btn-primary" />            
            <button type="button" id="btnPersonal" class="btn btn-warning pull-right">Next</button>
{{ Form::close() }}
            
@stop