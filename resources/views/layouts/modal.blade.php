<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                @if(!empty($modal_title))
                    <h4 class="modal-title">{!!   $modal_title !!}</h4>
                @endif
            </div>
            <div class="modal-body">
                @if(!empty($modal_body))
                    {!! $modal_body !!}
                @endif
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->