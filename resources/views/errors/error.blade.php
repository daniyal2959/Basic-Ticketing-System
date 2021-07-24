@if( count($errors) )

<div style="z-index: 200; width: 600px; top: 2em; left: 2em; position:absolute;" class="alert alert-danger alert-dismissible fade show" role="alert">
    @php $i = 0 @endphp
    @foreach($errors->all() as $error)
    <span class="alert-icon"><i class="ni ni-air-baloon" style="@if($i!=0) opacity: 0 @endif"></i></span>
    <span class="alert-text"><strong>Danger!</strong> {{ $error }}</span>
    <br>
    @php $i++; @endphp
    @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif
