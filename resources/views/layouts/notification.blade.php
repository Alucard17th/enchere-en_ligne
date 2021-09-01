@if(session()->has('notification.message'))
    @if(session()->get('notification.status') == "success")
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span> {{ session()->get('notification.message') }}
        </div>
    @elseif(session()->get('notification.status') == "error")
        <div class="alert alert-danger">
            <span class="glyphicon glyphicon-remove"></span> {{ session()->get('notification.message') }}
        </div>
    @elseif(session()->get('notification.status') == "info")
        <div class="alert alert-info">
            <span class="glyphicon glyphicon-info-sign"></span> {{ session()->get('notification.message') }}
        </div>
    @elseif(session()->get('notification.status') == "warning")
        <div class="alert alert-warning">
            <span class="glyphicon glyphicon-warning-sign"></span> {{ session()->get('notification.message') }}
        </div>
    @else
        <div class="alert"> {{ session()->get('notification.message') }}</div>
    @endif
@endif