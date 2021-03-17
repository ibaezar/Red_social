<div class="row detalle">
    <div class="col-12 col-md-8 detalle-img">
        <div class="imagen">
            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" width="100%">
        </div>
    </div>
    <div class="col-12 col-md-4 detalle-detalle">
        <div class="card post">
            <div class="card-header">
                <div class="avatar-img">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $image->user->profile_photo_url }}">
                </div>
                <div class="avatar-name">
                    <a href="{{ route('profile', ['id' => $image->user->id]) }}">
                        {{'@'.$image->user->nick}}
                    </a>
                </div>
                @if(Auth::check() && $image->user->id == Auth::user()->id)
                    @include('includes.mensaje-delete')
                @endif
            </div>
            <div class="card-body">
                <div class="content">
                    <div class="descripcion">
                        <p><strong>{{$image->user->nick}}</strong> {{$image->description}}</p>
                    </div>
                    <hr>
                    <div class="comentarios">
                        <ul>
                        @foreach ($image->comments as $comment)
                            
                            <li>
                                <div class="comment">
                                    <div class="avatar-img">
                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ $comment->user->profile_photo_url }}">
                                    </div>
                                    <p><a href="{{ route('profile', ['id' => $comment->user->id]) }}" style="float: left; padding-right: 5px"><strong>{{$comment->user->nick}}</strong></a> {{$comment->content}}</p>

                                    <div class="clearfix"></div>
                                    <span class="date">{{\FormatTime::LongTimeFilter($comment->created_at)}}</span>
                                    
                                    @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                        <a href="{{ route('comment.delete', ['id' => $comment->id]) }}">Eliminar</a>
                                    @endif
                                </div>
                                <div class="clearfix"></div>
                            </li>
                            
                        @endforeach
                        </ul>
                        <div class="clearfix"></div>       
                    </div>
                </div>
            </div>
            <div class="card-footer">
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

                    <span class="icon-bubble"></span>
                    <p><strong>{{count($image->likes)}} Me gusta</strong></p>
                </div>
                <hr>
                <form action="{{ route('comment.save') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="hidden" name="image_id" value="{{$image->id}}">
                        <input type="text" name="content" class="form-control" placeholder="Agrega un comentario..." required>
                        <input type="submit" class="btn btn-sm btn-light comment-button" value="Publicar" disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>