@if(session('success'))
    <div class="alert alert-success alert-dismissable flash-message">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('success') }}
        
    </div>
@endif
@if(session('danger'))
    <div class="alert alert-danger alert-dismissable flash-message">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('danger') }}
    </div>
@endif