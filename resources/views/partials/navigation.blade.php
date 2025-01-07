<div class="navigation">
    <div class="navigation_name">
        <p>Jalol ohanglari</p>
    </div>
    <div class="navigation_line"></div>
    <div class="navigation_links">
        <p>Oynalar</p>
        <ul>
            <li><a href="{{ route('home') }}"><i class="fa-solid fa-house-chimney"></i> Asosiy</a></li>
            <li><a href="{{ route('music.search') }}"><i class="fa-solid fa-magnifying-glass"></i> Izlash</a></li>
            @role('user')
                <li><a href="{{ route('music.liked') }}"><i class="fa-regular fa-heart"></i> Sevimlilar</a></li>
            @endrole
        </ul>
    </div>
    @if(Auth::check())
        <form action="{{ route('logout') }}" method="POST" style="display: inline; background: whitesmoke">
            @csrf
            <button class="exit" type="submit">Chiqish</button>
        </form>
    @endif
    <div class="navigation_line"></div>
    @role('user')
        <div class="navigation_playlists">
            <div class="navigation_playlist-header">
                <p>Sizning musiqalaringiz</p>
                <label class="upload-container" id="upload-btn">
                    <i class="fa-solid fa-plus"></i>
                </label>
            </div>
            <div class="navigation_playlist-sort">
                <div class="music-list">
                    @foreach($musics as $music)
                        <div class="music-item">
                            <a href="#" onclick="playMusic('{{ asset('storage/' . $music->file) }}')">
                                <i class="fa-brands fa-soundcloud"></i> {{ $music->name }} - {{ $music->artist }}
                            </a><button onclick="showDeletePopup('{{ route('music.destroy', $music->id) }}')" class="ranked-list__delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>

                    @endforeach
                </div>
                {{--                 Uncomment this when you want to enable the delete button--}}
            </div>
        </div>
    @endrole
    <div class="navigation_line"></div>
</div>
