<x-app-layout>
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-10">
                <div class="row justify-content-md-center">
                    <div class="col-6 col-md-4">
                        <div class="profile-img">
                            <img class="h-40 w-40 rounded-full object-cover" src="{{ $user->profile_photo_url }}">
                        </div>
                    </div>
                    <div class="col-6 col-md-4 profile">
                        <h2>{{'@'.$user->nick}}</h2>
                        <p><strong>{{count($user->images)}}</strong> Publicaciones</p>
                        <h4>{{$user->name.' '.$user->surname}}</h4>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-10 publicaciones">
                        <h4>Publicaciones</h4>
                        <hr>
                        <div class="row">
                            @foreach ($user->images as $image)
                                <div class="col-4">
                                    <div class="imagen-detalle">
                                        <a href="{{ route('image.detail', ['id' => $image->id]) }}">
                                            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" width="100%" min-height="290px">
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