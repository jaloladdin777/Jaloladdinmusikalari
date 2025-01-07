<div class="popup" id="delete-popup" style="display: none;">
    <div class="popup-content">
        <h2 class="popup-title">O'chirishni tasdiqlaysizmi</h2>
        <form id="delete-form" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Ha, O'chirish</button>
            <button type="button" class="btn btn-secondary" onclick="hideDeletePopup()">Yuq</button>
        </form>
    </div>
</div>
