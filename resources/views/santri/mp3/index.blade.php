@extends('main.app')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aplayer/1.10.1/APlayer.min.css"
        integrity="sha512-CIYsJUa3pr1eoXlZFroEI0mq0UIMUqNouNinjpCkSWo3Bx5NRlQ0OuC6DtEB/bDqUWnzXc1gs2X/g52l36N5iw=="
        crossorigin="anonymous" />

    <style>
        @font-face {
            font-family: gloss;
            src: url(assets/gloss-and-bloom/gloss.ttf);
        }

        .imgMP3 {
            object-fit: cover;
            /* background-position: center center;
                        background-repeat: no-repeat; */
            width: 100%;
            height: 250px;
        }

        .main {
            padding: 40px 0;
        }

        .h4 {
            text-transform: uppercase;
        }

        .album-poster {
            display: block;
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 0 25px #3d2173a1;
            transition: all ease 1s;
        }

        .album-poster:hover {
            transform: scale(0.95) translateY(10px);
        }

        .col-md-3,
        col-md-2 {
            margin-bottom: 50px;
        }

        h3 {
            font-size: 34px;
            margin-bottom: 34px;
            border-bottom: 4px solid #e6e6e6;
        }

        h4 {
            font-size: 14px;
            text-transform: uppercase;
            margin-top: 15px;
            font-weight: 700;
        }

        #aplayer {
            position: fixed;
            bottom: -100%;
            left: 0;
            width: 100%;
            box-shadow: 0 -2px 2px #dadada;
            background-color: white;
            transition: all ease 0.5s;
        }

        #aplayer.showPlayer {
            bottom: 0;
        }

    </style>
@endsection

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">MP3 Stream</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">MP3 Streaming</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Manage MP3</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
@endsection

@section('page-wrapper')

    <div class="row">
        <div class="col-12">
            <div class="row">

                @if ($widget['mp3'] != null)
                    @foreach ($widget['mp3'] as $item)
                        <div class="col-sm-2">
                            <a href="javascript:void();" class="album-poster" data-switch="{{ $loop->iteration - 1 }}">
                                <img class="imgMP3" src="{{ URL::to('/web_files/mp3/image/') . '/' . $item->cover }}"
                                    alt="{{ $item->name }}">
                            </a>
                            <div class="mt-4">
                                <h4>{{ $item->name }}</h4>
                                <h5>{{ $item->artist }}</h5>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>

    </div>

   

    <div class="fixed-bottom" id="aplayer"></div>
@endsection


@section('app-script')
    <!-- APlayer Jquery and CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aplayer/1.10.1/APlayer.min.js"
        integrity="sha512-RWosNnDNw8FxHibJqdFRySIswOUgYhFxnmYO3fp+BgCU7gfo4z0oS7mYFBvaa8qu+axY39BmQOrhW3Tp70XbaQ=="
        crossorigin="anonymous"></script>


    <script>
        $(".album-poster").on('click', function(e) {
            var dataSwitchID = $(this).attr('data-switch');

            if (dataSwitchID >= 0) {
                ap.list.switch(dataSwitchID)
                ap.play()
                $("#aplayer").addClass("showPlayer");
            } else {
                ap.pause();
            }
        });


        const ap = new APlayer({
            container: document.getElementById('aplayer'),
            listFolded: true,
            audio: <?php echo json_encode($widget['song']); ?>
        });

    </script>

    <script>
        function previewPhoto() {
            document.getElementById("input-image")
            var fileReader = new FileReader();
            fileReader.readAsDataURL(document.getElementById("input-image").files[0])
            fileReader.onload = function(oFREvent) {
                document.getElementById("previewCover").src = oFREvent.target.result;
            };
        };

        function previewFile(input) {
            var file = $("input[type=file]").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $("#previewImg").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }

        $(document).ready(function() {

            $.myfunction = function() {
                $("#previewName").text($("#inputSongName").val());
                $("#previewArtist").text($("#inputSongArtist").val());
                var artist = $.trim($("#inputSongArtist").val())
                var song = $.trim($("#inputSongName").val())
                if (artist == "") {
                    $("#previewArtist").text("Composer")
                }
                if (song == "") {
                    $("#previewName").text("Song Name")
                }
            };

            $("#inputSongName").keyup(function() {
                $.myfunction();
            });

            $("#inputSongArtist").keyup(function() {
                $.myfunction();
            })

            $("#btn1").click(function() {
                $("#test1").text("Hello world!");
            });
            $("#btn2").click(function() {
                $("#test2").html("<b>Hello world!</b>");
            });
            $("#btn3").click(function() {
                $("#test3").val("Dolly Duck");
            });
        });

    </script>
@endsection
