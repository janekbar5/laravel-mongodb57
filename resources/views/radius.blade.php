@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

				@role('writer')
					I am a writer!
				@else
					I am not a writer...
				@endrole
				
				<br><br>
                                

				
                                @foreach ($locations as $loc)	
                                
                                {{ $loc->title }}<br>
                                
                                @endforeach	
                             
 
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection