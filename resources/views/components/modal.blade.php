<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content" style="color:white; background-color:#04293A;">
        <div class="modal-header">
            <h5 class="modal-title">{{ $title }}</h5>
            <button type="button" class="btn-close" style=".btn-close{color:white;}" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        <div class="modal-body d-flex justify-content-start">
            {!! $content !!}
        </div>
    </div>
    </div>
</div>