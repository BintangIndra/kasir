<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-{{ $size }} modal-dialog-centered">
    <div class="modal-content" style="color:black;">
        <div class="modal-body d-flex justify-content-center">
            {!! $content !!}
        </div>
        @if($route != null)
        <div class="modal-footer d-flex justify-content-center">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a href="{{ $route }}" class="btn btn-danger">Yes</a>
        </div>
        @endif
    </div>
    </div>
</div>