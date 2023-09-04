@extends('flash.layout.layout')
@section('title')
    چت با مدریت
@endsection
@section('css')
    <style>
        .chat-icon {
            display: none;
        }
    </style>
@endsection
@section('content')
    <a href="/">
        <div class="home"><i class="fa fa-home"></i><br>صفحه اصلی </div>
    </a>
    <div class="texts-container">
        @foreach ($messegs as $item)
            @if ($item->user_id == 0)
                <div class="maneger-text-con" id="{{ $item->id }}">
                    <img src="flash/img/maneger.png" alt="">
                    <div class="maneger-text parent-image">
                        @if ($item->file != null)
                            <a class="downloade-file-chat" href="/{{ $item->file }}" controls><i
                                    class="fa fa-file"></i></a><br>
                        @endif
                        @if ($item->image != null)
                            <img width="100%" class="pic" src="{{ $item->image }}" alt="">
                        @endif
                        @if ($item->voice != null)
                            <audio style="width: 100%" src="{{ $item->voice }}" controls></audio>
                        @endif
                        {{ $item->text }}
                        <span class="messege-time">{{ $item->updated_at }}</span>
                    </div>
                </div>
            @else
                <div class="user-text-con" id="{{ $item->id }}">
                    <img class="user-image" src="{{ $user->image }}"alt="">
                    <div class="user-text">
                        @if ($item->file != null)
                            <a class="downloade-file-chat" href="/{{ $item->file }}" controls><i
                                    class="fa fa-file"></i></a><br>
                        @endif
                        @if ($item->image != null)
                            <img width="100%" class="pic" src="{{ $item->image }}" alt="">
                        @endif
                        @if ($item->voice != null)
                            <audio src="{{ $item->voice }}" controls></audio>
                        @endif
                        {{ $item->text }}
                        <span class="messege-time">{{ $item->updated_at }}</span>
                    </div>
                </div>
            @endif
        @endforeach
        <button class="chateOther" onclick="chateOther()"><i class="fa fa-arrow-up"></i></button>
    </div>
    <div class="chat-form-container">
        <form class="chat-inputs" method="POST" action="/reciveData" enctype="multipart/form-data">
            @csrf
            <button class="send-chat"><i class="fa fa-paper-plane"></i></button>
            <textarea name="text" id="" placeholder="پیام خود را تایپ کنید ......"></textarea>
            <label class="label">
                <input id="file-uplode" name="file" type="file" />
                <span><i class="fa fa-image"></i></span>
            </label>
            @php
                $chat_id = App\Models\chate::where('user_id', session()->get('user'))->get()[0]->id;
            @endphp
            <input type="hidden" name="chat_id" class='chat_id' value="{{ $chat_id }}">
        </form>
        <button id="btnStart" class="send-voice"><i class="fa fa-microphone"></i></button>
    </div>
@endsection

@section('scripts')
    <script>
        $('.login-regester').css('box-shadow', '0px 8px 5px rgb(122 122 122)');
    </script>
    @if (session('completeError'))
        <script !src="">
            alertEore('اطاتعتن نامناسب تکمیل شده')
        </script>
    @endif
    <script>
        function seeAdmin() {
            var chate_id = $(".chat_id").val();
            var last_Messege = $(".texts-container")
                .find(".user-text-con")
                .eq(0)
                .attr("id");
            $.ajax({
                type: "get",
                url: `/lastSeenAdmin/${last_Messege}/${chate_id}`,
                processData: false,
                contentType: false,
                success: function(response) {},
            });
        }
        var chateOtherCounter = 1;

        function chateOther() {
            chate_id = $('.chat_id').val()
            $.ajax({
                type: "post",
                url: `/chateOther/${chateOtherCounter}/${chate_id}`,
                processData: false,
                contentType: false,
                success: function(response) {
                    response.forEach((data) => {
                        var user_id = data.id
                        var style_user = ''
                        var user_image = ""
                        if (data.user_id == 0) {
                            user_id = "maneger-text-con"
                            style_user = 'maneger-text'
                            user_image = "flash/img/maneger.png"
                        } else {
                            user_id = "user-text-con"
                            style_user = 'user-text'
                            user_image = $('.user-image').attr('src');
                        }
                        if (data.image != null) {
                            $(".texts-container").append(`sdsds
                            <div class="${user_id}" id="${data.id}">
                            <img src="${user_image}"alt="">
                                <div class="${style_user}">
                                <img style="width: 100%" src="${data.image}" controls />
                                ${data.text ? data.text : ""}
                                <span class="messege-time">${data.updated_at}</span>
                                </div>
                            </div>  
                         `);
                        } else if (data.file != null) {
                            $(".texts-container").append(`
                            <div class="${user_id}" id="${data.id}"> 
                            <img src="${user_image}"alt="">
                                <div class="${style_user}">
                                <a class="downloade-file-chat" href="${
                                    data.file
                                }" controls ><i class="fa fa-file"></i></a><br><br>
                                ${data.text ? data.text : ""}
                                <span class="messege-time">${data.updated_at}</span>

                                </div>
                            </div>  
                        `);
                        } else if (data.voice != null) {
                            $(".texts-container").append(`
                            <div class="${user_id}" id="${data.id}"> 
                            <img src="${user_image}"alt="">
                                <div class="${style_user}">
                                <audio style="width: 100%" src="${data.voice}" controls></audio>
                                ${data.text ? data.text : ""}
                                <span class="messege-time">${data.updated_at}</span>

                                </div>
                            </div>  
                        `);
                        } else {
                            $(".texts-container").append(`
                            <div class="${user_id}" id="${data.id}"> 
                            <img src="${user_image}"alt="">
                                <div class="${style_user}">
                                ${data.text}
                                <span class="messege-time">${data.updated_at}</span>
                                </div>
                            </div>  
                        `);
                        }
                    });
                    $('.chateOther').remove();
                    $(".texts-container").append(
                        `<button class="chateOther" onclick="chateOther()"><i class="fa fa-arrow-up"></i></button>`
                    )
                    chateOtherCounter++
                },
            });
        }



        //=====================voice====================
        //=====================voice====================
        //=====================voice====================
        // =============voice=============
        // =============voice=============
        // =============voice=============
        // =============voice=============
        // =============voice=============
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            console.log("getUserMedia supported.");
            navigator.mediaDevices
                .getUserMedia({
                    audio: true
                })
                // Success callback
                .then((stream) => {
                    const mediaRecorder = new MediaRecorder(stream);
                    let chunks = [];
                    $(".send-voice").click(function(e) {
                        var statusRecord = $(".send-voice").attr("id");
                        if (statusRecord == "btnStart") {
                            $(".send-voice").attr("id", "btnStop");
                            $(".send-voice i").removeClass();
                            $(".send-voice i").attr("class", "fa fa-stop");
                            mediaRecorder.start();
                            console.log(mediaRecorder.state);
                            mediaRecorder.ondataavailable = (e) => {
                                chunks.push(e.data);
                            };
                        } else {
                            $(".send-voice").attr("id", "btnStart");
                            $(".send-voice i").attr("class", "fa fa-microphone");
                            mediaRecorder.stop();
                            console.log(mediaRecorder.state);
                        }
                        mediaRecorder.onstop = (e) => {
                            const blob = new Blob(chunks, {
                                type: "audio/mpeg; codecs=opus"
                            });
                            const audioURL = window.URL.createObjectURL(blob);
                            const audiofile = new File([blob], "audiofile.mp3", {
                                type: "audio/mp3",
                            });
                            console.log("recorder stopped");
                            var lastMessege = $(".texts-container").children().eq(0).attr("id");
                            $(".texts-container").prepend(`
                                <div class="user-text-con" id='${eval(lastMessege) + 1}'> 
                                <img src=""alt="">
                                    <div class="user-text">
                                    <audio style='width: 100%' controls src='${audioURL}'/>
                                    </div>
                                </div>  
                            `);
                            var formData = new FormData();
                            formData.append("file", audiofile);
                            formData.append("chat_id", $(".chat_id").val());
                            $.ajax({
                                type: "POST",
                                url: "/sendUserAudio",
                                processData: false,
                                contentType: false,
                                data: formData,
                                success: function(response) {
                                    console.log(response);
                                    seeAdmin()
                                },
                            });
                        };
                    });
                })
                .catch((err) => {
                    console.log("شما قابلیت ظبط صدا را ندارید");
                });
        } else {
            console.log("شما قابلیت ظبط صدا را ندارید");
        }

        // =============voice=============
        // =============voice=============
        // =============voice=============
        // =============voice=============
        //=====================voice====================
        //=====================voice====================
        //=====================voice====================
    </script>
@endsection
