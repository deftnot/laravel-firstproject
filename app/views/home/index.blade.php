@extends('home/inc/layout')

@section('contenido')
<div class="row">
    <div class="col-lg-8">        
            {{ Form::open(array('url' => 'login','role'=>'form')) }}
            <section class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" id="email" placeholder="user@domain.com">
            </section>
            <section class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="password">
            </section>            
            <input type="submit" class="btn btn-primary" value="Login" />
            
            {{ Form::close() }}
        
    </div>
    
</div>
@stop