<div class="option">
    <ul>
        <li class="nav-item dropdown dropleft">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="icon-dots-horizontal-triple"></span>
            </a>
            <div class="dropdown-menu">
                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#modal-delete">
                    <span class="icon-bin2" style="color:red"></span> Eliminar
                </button>
            </div>
        </li>
    </ul>
</div>

<!-- Modal DELETE -->
<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modal-delete" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-deleteLabel">¿Estás seguro?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de querer eliminar esta publicación?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>