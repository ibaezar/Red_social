@if(Auth::check())
<x-app-layout>
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                @include('includes.mensaje')
                @foreach ($images as $image)
                    <div class="card post">
                        <div class="card-header">
                            <div class="avatar-img">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ $image->user->profile_photo_url }}">
                            </div>
                            <div class="avatar-name">
                                <a href="{{ route('profile', ['id' => $image->user->id]) }}">
                                    {{$image->user->name.' '.$image->user->surname.' |  @'.$image->user->nick}}
                                </a>
                            </div>
                            @if(Auth::check() && $image->user->id == Auth::user()->id)
                                @include('includes.mensaje-delete')
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="imagen">
                                <a href="{{ route('image.detail', ['id' => $image->id]) }}">
                                    <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" width="100%">
                                </a>
                            </div>
                            <div class="content">
                                <div class="likes">
                                    <!--Comprobar likes-->
                                    <?php $user_like = false ?>
                                    @foreach ($image->likes as $like)
                                        @if($like->user->id == Auth::user()->id)
                                            <?php $user_like = true ?>
                                        @endif
                                    @endforeach
                                    @if($user_like)
                                        <a href="{{ route('dislike', ['image_id' => $image->id]) }}"><span class="icon-heart1 heart-red"></span></a>
                                    @else
                                        <a href="{{ route('like', ['image_id' => $image->id]) }}"><span class="icon-heart heart-white"></span></a>
                                    @endif

                                    <a href="{{ route('image.detail', ['id' => $image->id]) }}"><span style="color: #444444 !important" class="icon-bubble"></span></a>
                                    <p><strong>{{count($image->likes)}} Me gusta</strong></p>
                                </div>
                                <div class="descripcion">
                                    <p><strong>{{$image->user->nick}}</strong> {{$image->description}}</p>
                                </div>
                                <div class="comentarios">
                                    <a href="{{ route('image.detail', ['id' => $image->id]) }}">Ver los {{count($image->comments)}} comentarios</a>
                                    <br>

                                    @foreach ($image->comments as $comment)
                                        <div class="comment">
                                            <p><strong>{{$comment->user->nick}}</strong> {{$comment->content}}</p>

                                            @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                                <a href="{{ route('comment.delete', ['id' => $comment->id]) }}">Eliminar</a>
                                            @endif
                                        </div>
                                        <div class="clearfix"></div>
                                    @endforeach

                                    @if(count($image->comments) >= 1)
                                        <span class="date">{{\FormatTime::LongTimeFilter($image->comments[count($image->comments)-1]->created_at)}}</span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('comment.save') }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="hidden" name="image_id" value="{{$image->id}}">
                                    <input type="text" name="content" class="form-control comment-text" placeholder="Agrega un comentario..." required>
                                    <input type="submit" class="btn btn-light comment-button" style="color: #177f8f" value="Publicar" disabled>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach

                <!--Paginacion-->
                <div class="paginacion">
                    {{$images->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@else
    @include('includes.index')
@endif