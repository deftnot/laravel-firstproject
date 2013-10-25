@extends('usuario/inc/layout')

@section('contenido')
<section class="form-group">
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <!-- The file input field used as target for the file upload widget -->
                    <input id="foto" url="{{URL::to('usuario/sendFoto')}}" type="file" name="foto" multiple>
                </span>
                <br>
                <br>
                <!-- The global progress bar -->
                <div id="progress" class="progress">
                    <div class="progress-bar progress-bar-success"></div>
                </div>
                <!-- The container for the uploaded files -->
                <div id="files" class="files"></div>
            </section>
<div class="alert alert-danger error hidden"></div>         
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
                {{Form::select('estados', $estados,'', ['id'=>'selEstado','class'=>'form-control','site'=>URL::to('ciudades')])}}
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