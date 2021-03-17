<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Subir imagenes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="row justify-content-md-center">
            <div class="col-md-6 col-image-create">
                <div class="card">
                    <div class="card-header">
                        Subir imagen
                    </div>
                    <div class="card-body">
                        <!--Mensajes-->
                        @include('includes.mensaje')
                        
                        <form action="{{ route('image.save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image_path" lang="es" required>
                                    <label class="custom-file-label" for="image_path" data-browse="Elegir">Seleccionar Imagen</label>
                                  </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripcion</label>
                                <textarea name="description" class="form-control" required></textarea>
                            </div>
                            <input type="submit" class="btn btn-info" value="Subir">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>