<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#advertisingModal">
    Launch demo modal
</button> --}}

<!-- Modal -->
<style>
    img {
        display: block;margin: 0 auto;
    }
    .modal-title.fix-text {
        text-align: center;
        font-size: 36px;
        color: #212529;
    }
    .btn.btn-secondary.fix-btn {
        background-color: #DF0053;
        color: #FFFFFF;
        transition: filter 0.3s, background-color 0.3s;
    }
    .btn.btn-secondary.fix-btn:hover {
        filter: brightness(80%);
    }
</style>
<div class="modal fade" id="advertisingModal" tabindex="-1" role="dialog" aria-labelledby="advertisingModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <a href="http://" target="_blank" rel="noopener noreferrer">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title fix-text" id="exampleModalLongTitle">QUẢNG CÁO</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
                </div>
                <div class="modal-body">
                    <img src="{{ asset('images/OIP.jfif') }}" alt="Hình ảnh quảng cáo">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary fix-btn" data-dismiss="modal">Đóng</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </a>
    </div>
</div>