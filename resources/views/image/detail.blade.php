<x-app-layout>
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-12">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-10 col-lg-7 col-detalle-normal">
                        @include('includes.image-detail-normal')
                    </div>
                    <div class="col-12 col-md-10 col-lg-7 col-detalle-responsive">
                        @include('includes.image-detail-responsive')
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-12 col-lg-10 col-xl-7 publicaciones">
                        <h4>Otras publicaciones de {{'@'.$image->user->nick}}</h4>
                        <hr>
                        <div class="row">
                        @foreach ($image->user->images as $image)
                            <div class="col-4">
                                <div class="imagen-detalle">
                                    <a href="{{ route('image.detail', ['id' => $image->id]) }}">
                                        <img src="{{ route('image.file', ['filename' => $image->image_path]) }}">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>