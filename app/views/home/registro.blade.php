@extends('home/inc/layout')

@section('contenido')
<div class="alert alert-danger error hidden"></div>                
<div class="row">
    <div class="col-lg-8">        
            {{ Form::open(array('url' => 'register','role'=>'form')) }}
            <section class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" id="email" placeholder="user@domain.com" />
                
            </section>            
            <section class="form-group">
                <label for="Usuario">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña">
            </section>            
            <section class="form-group">
                <label for="Usuario">Repite Password</label>
                <input type="password" name="repassword" class="form-control" id="repassword" placeholder="Contraseña">
            </section>                                   
            <input type="submit" id="btnRegistro" class="btn btn-primary pull-right" value="Registrar" />

            {{ Form::close() }}
        
    </div>
    
</div>
@stop