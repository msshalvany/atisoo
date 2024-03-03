@extends('flash.layout.layout')
@section('title')
    چت با مدریت
@endsection
@section('css')
        .chat-icon {
            display: none;
        }

        p {
            white-space: pre-wrap;
            display: inline;
        }

        .caption-file-con {
            width: 320px;
            position: fixed;
            border-radius: 12px;
            margin-left: -150px;
            margin-top: -200px;
            background: white;
            top: -12%;
            left: 50%;
            z-index: 12;
            box-shadow: 0 0 12px rgb(98, 98, 98);
            padding: 8px 12px;
        }
        .link-in-chat{
            color: rgb(81, 81, 250);
            cursor: pointer;
        }
        .link-in-chat:hover{
            color: rgb(33, 33, 248);
            text-decoration: underline;
        }
@endsection
@section('content')
    @php
        $chat_id = App\Models\chate::where('user_id', session()->get('user'))->get()[0]->id;
        $chat = App\Models\chate::where('user_id', session()->get('user'))->get()[0];
        $onlin = App\Models\onlin::find(1)->online;
    @endphp
    <div class="caption-file-con">
        <div class="form-group">
            <label class="" for="text">توضیحات عکس :</label>
            <textarea class="form-control caption-file" name="text" id="text" rows="5"></textarea>
        </div><br>
        <div class="form-group">
            <button class="btn btn-danger">ارسال</button>
        </div>
    </div>
    <div class="nav-chat">
        <div class="search-in-chat-con">
            <input class="search-in-chat-input" type="search">
            <button class="search-in-chat-btn btn btn-sm btn-primary me-1">جستجو</button><br>
            <div style="display: none" class="goTo-f-b-r">
                <button class="next-serch-btn btn btn-sm btn-primary">بعدی</button>
                <button class="prev-serch-btn btn btn-sm btn-primary">قبلی</button>
                <button style="border-radius: 50%;padding: 5px;width: 30px;height: 30px;" class="stop-search red-btn"><i
                        class="fa fa-close"></i></button>
            </div>
        </div>
        @if ($onlin == 0)
            <div class="time-to-online-con btn btn-sm btn-danger">ادمین به زودی آنلاین می شود <span id="countdown"></span>
            </div>
        @elseif ($onlin == 1)
            <div class="time-to-online-con btn btn-sm btn-success">ادمین آنلاین است</div>
        @endif
    </div>
    <div class="texts-container">
        @foreach ($messegs as $item)
            @if ($item->user_id < 1)
                <div class="maneger-text-con" id="{{ $item->id }}">
                    <img src="flash/img/maneger.png" alt="">
                    <div class="maneger-text parent-image">
                        @if ($item->reply != 0)
                            <div class="reply-text-cont" onclick="id_to_reply(event)">
                                <span style="display: none" class="id-to-reply">{{ $item->reply }}</span>
                                <i class="fa fa-reply"></i>
                                @php
                                    $replyText = \App\Models\messegeChat::find($item->reply)->text;
                                @endphp
                                <span>{{ $replyText }}</span>
                            </div>
                        @endif
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
                        <span style="color: rgb(123, 0, 0)">آتی سو :</span>
                        <p class="main-text">{!! $item->text !!}</p>
                        <div class="messege-items-bl">
                            <i class="fa fa-reply" onclick="changReply(event)" aria-hidden="true"></i>
                            <span class="messege-time">{{ $item->updated_at }}</span>
                        </div>
                    </div>
                </div>
            @else
                @if ($item->hide == 0)
                    <div class="user-text-con" id="{{ $item->id }}">
                        <img class="user-image" src="{{ $user->image }}"alt="">
                        <div class="user-text">
                            @if ($item->reply != 0)
                                <div class="reply-text-cont" onclick="id_to_reply(event)">
                                    <span style="display: none" class="id-to-reply">{{ $item->reply }}</span>
                                    <i class="fa fa-reply"></i>
                                    @php
                                        $replyText = \App\Models\messegeChat::find($item->reply)->text;
                                    @endphp
                                    <span>{{ $replyText }}</span>
                                </div>
                            @endif
                            @if ($item->file != null)
                                <a class="downloade-file-chat" href="/{{ $item->file }}" controls><i
                                        class="fa fa-file"></i></a><br>
                            @endif
                            @if ($item->image != null)
                                <img width="100%" class="pic" src="{{ $item->image }}" alt="">
                            @endif
                            @if ($item->voice != null)
                                <audio style='width: 100%' src="{{ $item->voice }}" controls></audio>
                            @endif
                            <p class="main-text">{{ $item->text }}</p>
                            <div class="messege-items-bl">
                                <i class="fa fa-trash" onclick="messDel(event)" aria-hidden="true"></i>
                                <i class="fa fa-reply" onclick="changReply(event)" aria-hidden="true"></i>
                                <span class="messege-time">{{ $item->updated_at }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
        {{-- <button class="chateOther" onclick="chateOther()"><i class="fa fa-arrow-up"></i></button> --}}
    </div>
    <div class="chat-form-container">
        <form class="chat-inputs" method="POST" action="/reciveData" enctype="multipart/form-data">
            <div class="text-replyed"></div>
            <input type="hidden" class="input-reply" name="reply" value="0">
            @csrf
            <button class="send-chat"><i class="fa fa-paper-plane"></i></button>
            <textarea name="text" id="" placeholder="پیام خود را تایپ کنید ......"></textarea>
            <label class="label">
                <input id="file-uplode" class="file-uplode" name="file" type="file"/>
                <span><i class="fa fa-image"></i></span>
            </label>
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
        $('.texts-container > div.user-text-con').each(function() {
            console.log($(this).attr('id'));
            var id = parseInt($(this).attr('id'));
            if (id <= {{ $chat->see_admin }}) {
                $(this).find('.messege-items-bl').prepend(
                    `<i class="fa fa-eye" aria-hidden="true"></i>`)
            }
        });
        // $('.texts-container').find('#{{ $chat->see_user }}').css('color','red')
    </script>
    <script>
        function seeUser() {
            var chate_id = $(".chat_id").val();
            var last_Messege = $(".texts-container").find(".maneger-text-con").eq(0).attr("id");
            $.ajax({
                type: "get",
                url: `/lastSeenUser/${last_Messege}/${chate_id}`,
                processData: false,
                contentType: false,
                success: function(response) {},
            });
        }
        seeUser()
        setInterval(() => {
            seeUser()
        }, 5000);
        setInterval(() => {
            var chate_id = $(".chat_id").val();
            var last_Messege = $(".texts-container").find(".user-text-con").eq(0).attr("id");
            $.ajax({
                type: "get",
                url: `/checkSeeAdmin/${last_Messege}/${chate_id}`,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    if (response == 1) {
                        $('.texts-container > div.user-text-con .messege-items-bl').each(function() {
                            if (!$(this).find('i').hasClass('fa-eye')) {
                                $(this).prepend(`<i class="fa fa-eye" aria-hidden="true"></i>`)
                            }
                        });
                    }
                },
            });
        }, 5000);


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
                                <p>${data.text ? data.text : ""}</p>
                                <div class="messege-items-bl">
                                    <i class="fa fa-reply" onclick='changReply(event)'  aria-hidden="true"></i>
                                    <span class="messege-time">${formatDateTime(data.updated_at)}</span>
                                </div>
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
                                <p>${data.text ? data.text : ""}</p>
                                <div class="messege-items-bl">
                                    <i class="fa fa-reply" onclick='changReply(event)'  aria-hidden="true"></i>
                                    <span class="messege-time">${formatDateTime(data.updated_at)}</span>
                                </div>
                                </div>
                            </div>
                        `);
                        } else if (data.voice != null) {
                            $(".texts-container").append(`
                            <div class="${user_id}" id="${data.id}">
                            <img src="${user_image}"alt="">
                                <div class="${style_user}">
                                <audio style="width: 100%" src="${data.voice}" controls></audio>
                                <p>${data.text ? data.text : ""}</p>
                                <div class="messege-items-bl">
                                    <i class="fa fa-reply" onclick='changReply(event)'  aria-hidden="true"></i>
                                    <span class="messege-time">${formatDateTime(data.updated_at)}</span>
                                </div>
                                </div>
                            </div>
                        `);
                        } else {
                            $(".texts-container").append(`
                            <div class="${user_id}" id="${data.id}">
                            <img src="${user_image}"alt="">
                                <div class="${style_user}">
                                <p>${data.text ? data.text : ""}</p>
                                <div class="messege-items-bl">
                                    <i class="fa fa-reply" onclick='changReply(event)'  aria-hidden="true"></i>
                                    <span class="messege-time">${formatDateTime(data.updated_at)}</span>
                                </div>
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
                    user_image = $('.user-image').attr('src');
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
                                <img src="${user_image}" alt="">
                                    <div class="user-text">
                                        <audio style='width: 100%' controls src='${audioURL}'/>
                                    </div>
                                    <div class="messege-items-bl">
                                        <i class="fa fa-trash" onclick="messDel(event)" aria-hidden="true"></i>
                                        <i class="fa fa-reply" onclick="changReply(event)" aria-hidden="true"></i>
                                        <span class="messege-time"></span>
                                    </div>
                                </div>
                            `);
                            var formData = new FormData();
                            formData.append("file", audiofile);
                            formData.append("chat_id", $(".chat_id").val());
                            ajaxHandel = $.ajax({
                                type: "POST",
                                url: "/sendUserAudio",
                                xhr: function() {
                                    var xhr = new window.XMLHttpRequest();
                                    xhr.upload.addEventListener(
                                        "progress",
                                        function(evt) {
                                            if (evt.lengthComputable) {
                                                var percentComplete = evt.loaded / evt
                                                    .total;
                                                percentComplete = parseInt(
                                                    percentComplete * 100);
                                                console.log(percentComplete);
                                                $(".loead-wait-cin").css("display",
                                                    "flex");
                                                $(".loead-wait-cin").find(".pers").text(
                                                    `${percentComplete} %`);
                                                console.log(percentComplete);
                                                if (percentComplete == 100) {
                                                    setTimeout(() => {
                                                        $(".loead-wait-cin")
                                                            .fadeOut();
                                                        console.log("end");
                                                    }, 1000);
                                                }

                                            }
                                        },
                                        false
                                    );
                                    return xhr;
                                },
                                processData: false,
                                contentType: false,
                                data: formData,
                                success: function(response) {
                                    seeUser()
                                    if (response == 4) {
                                        alertEore('حجم فایل صوتی حد اکثر 100 مگابایت می باشد')
                                    }
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
        setInterval(() => {
            var lastMessege = $(".texts-container").children().eq(0).attr("id");
            $.ajax({
                url: `/checkSendChat`,
                type: "POST",
                dataType: "JSON",
                data: {
                    id: lastMessege,
                    user: $(".user").attr("id")
                },
                success: function(data) {

                    if (data != 0 && data.user_id == 0) {
                        var reply = ''
                        if (data.reply != 0) {
                            replytext = $(`#${data.reply}`).find('.main-text').text();
                            reply =
                                `
                                    <div class="reply-text-cont" onclick="id_to_reply(event)">
                                        <span style="display: none" class="id-to-reply">${data.reply}</span>
                                        <i class="fa fa-reply"></i>
                                        <span>${replytext}</span>
                                    </div>

                                `
                        }
                        if (data.image != null) {
                            $(".texts-container").prepend(`
                                    <div class="maneger-text-con" id="${data.id}">
                                        ${reply}
                                        <img src="flash/img/maneger.png"alt="">
                                        <div class="maneger-text">
                                        <img style="width: 100%" src="${data.image}" controls />
                                        <p><span style="color: rgb(123, 0, 0)">آتی سو :</span>${data.text ? data.text : ""}</p>
                                        <div class="messege-items-bl">
                                            <i class="fa fa-reply" onclick='changReply(event)'  aria-hidden="true"></i>
                                            <span class="messege-time">${formatDateTime(data.updated_at)}</span>
                                        </div>
                                        </div>
                                    </div>
                        `);
                        } else if (data.file != null) {
                            $(".texts-container").prepend(`
                                    <div class="maneger-text-con" id="${data.id}">
                                    ${reply}
                                    <img src="flash/img/maneger.png"alt="">
                                        <div class="maneger-text">
                                            <a class="downloade-file-chat" href="${data.file}"><i class="fa fa-file"></i></a><br>
                                                <p><span style="color: rgb(123, 0, 0)">آتی سو :</span>${data.text ? data.text : ""}</p>
                                            <div class="messege-items-bl">
                                                <i class="fa fa-reply" onclick='changReply(event)'  aria-hidden="true"></i>
                                                <span class="messege-time">${formatDateTime(data.updated_at)}</span>
                                            </div>
                                        </div>
                                    </div>
                        `);
                        } else if (data.voice != null) {
                            $(".texts-container").prepend(`
                                    <div class="maneger-text-con" id="${data.id}">
                                        ${reply}
                                        <img src="flash/img/maneger.png"alt="">
                                        <div class="maneger-text">
                                        <audio style="width: 100%" src="${
                                        data.voice
                                        }" controls></audio>dvd
                                        <p><span style="color: rgb(123, 0, 0)">آتی سو :</span>${data.text ? data.text : ""}</p>
                                            <div class="messege-items-bl">
                                                <i class="fa fa-reply" onclick='changReply(event)' aria-hidden="true"></i>
                                                <span class="messege-time">${formatDateTime(data.updated_at)}</span>
                                            </div>
                                        </div>
                                    </div>
                        `);
                        } else {
                            $(".texts-container").prepend(`
                                    <div class="maneger-text-con" id="${data.id}">
                                        <img src="flash/img/maneger.png"alt="">
                                        <div class="maneger-text">
                                            ${reply}
                                                <p><span style="color: rgb(123, 0, 0)">آتی سو :</span>${data.text}</p>
                                                <div class="messege-items-bl">
                                                    <i class="fa fa-reply" onclick='changReply(event)' aria-hidden="true"></i>
                                                    <span class="messege-time">${formatDateTime(data.updated_at)}</span>
                                                </div>
                                        </div>
                                    </div>
                        `);
                        }
                    }
                },
            });
        }, 3000);

        function changReply(e) {
            console.log('reply');
            var reply_id = $(e.target).parents().parents().parents().attr('id')
            var text = $(`#${reply_id}`).find('p').text()
            if ($('.input-reply').val() == reply_id) {
                $(e.target).css('color', 'black');
                $('.input-reply').val(0);
                $('.text-replyed').empty();
            } else {
                $('.text-replyed').empty();
                $('.fa-reply').css('color', 'black');
                $(e.target).css('color', 'red');
                $('.input-reply').val(reply_id);
                $('.text-replyed').append(`<div><i class="fa fa-reply" aria-hidden="true"></i>` + text +`</div><i class="fa fa-cancel text-danger float-end " onclick="cancelRep()" aria-hidden="true"></i>`);
            }
        }

        function cancelRep(target) {
            $('.fa-reply').css('color', 'black');
            $('.input-reply').val(0);
            $('.text-replyed').empty();
        }

        function messDel(e) {
            console.log('messDel');
            var del_id = $(e.target).parents().parents().parents().attr('id')
            var formData = new FormData();
            formData.append("id", del_id);
            $.ajax({
                type: "post",
                url: "deletMessUser",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $(`#${del_id}`).remove();
                }
            });
        }

        function id_to_reply(e) {
            var replyTo = eval($(e.currentTarget).find('.id-to-reply').text());
            $('.texts-container').animate({
                scrollTop: $(`#${replyTo}`).offset().top - 200
            }, 1000);
        }
    </script>
    <script>
        function goTo(id) {
            $('.texts-container').animate({
                scrollTop: $(`#${id}`).offset().top - 200
            }, 0);
        }
        var searchGoToCount = 0
        var ids = []
        $('.search-in-chat-btn').click(function(e) {
            e.preventDefault();
            text = $('.search-in-chat-input').val();
            if (text != '') {
                var matchingTags = $('.maneger-text-con , .user-text-con ').filter(function() {
                    return $(this).text().toLowerCase().indexOf(text) != -1;
                });
                if (matchingTags.length != 0) {
                    for (let i = 0; i < matchingTags.length; i++) {
                        ids[i] = $(matchingTags[i]).attr('id');
                    }
                    if (matchingTags.length != 1) {
                        $('.goTo-f-b-r').fadeIn();
                    }
                    console.log(ids);
                    goTo(ids[0])
                    $(`#${ids[searchGoToCount]} .user-text , #${ids[searchGoToCount]} .maneger-text`).animate({
                        left: "+=50",
                    }, 700);
                    $(`#${ids[searchGoToCount]} .user-text , #${ids[searchGoToCount]} .maneger-text`).animate({
                        left: "-=50",
                    }, 700);
                } else {
                    alertEore('موردی یافت نشد')
                }

            }
        });
        $('.goTo-f-b-r .next-serch-btn').click(function(e) {
            if (searchGoToCount <= ids.length) {
                searchGoToCount++
                e.preventDefault();
                $('.texts-container').scrollTop($('.texts-container')[0].scrollHeight);
                goTo(ids[searchGoToCount])
                $(`#${ids[searchGoToCount]} .user-text , #${ids[searchGoToCount]} .maneger-text`).animate({
                    left: "+=50",
                }, 700);
                $(`#${ids[searchGoToCount]} .user-text , #${ids[searchGoToCount]} .maneger-text`).animate({
                    left: "-=50",
                }, 700);
                console.log(ids[searchGoToCount]);
            } else {
                searchGoToCount = 0
                ids = []
                $('.goTo-f-b-r').fadeOut();
                $('.search-in-chat-input').val('');
                alertEore('موردی نیست')
            }
        });
        $('.goTo-f-b-r .prev-serch-btn').click(function(e) {
            if (searchGoToCount >= 0) {
                searchGoToCount--
                e.preventDefault();
                $('.texts-container').scrollTop($('.texts-container')[0].scrollHeight);
                goTo(ids[searchGoToCount])
                $(`#${ids[searchGoToCount]} .user-text , #${ids[searchGoToCount]} .maneger-text`).animate({
                    left: "+=50",
                }, 700);
                $(`#${ids[searchGoToCount]} .user-text , #${ids[searchGoToCount]} .maneger-text`).animate({
                    left: "-=50",
                }, 700);
                console.log(ids[searchGoToCount]);
            } else {
                searchGoToCount = 0
                ids = []
                $('.texts-container').scrollTop($('.texts-container')[0].scrollHeight);
                $('.goTo-f-b-r').fadeOut();
                $('.search-in-chat-input').val('');
                alertEore('موردی نیست')
            }
        });
        $('.goTo-f-b-r .stop-search').click(function(e) {
            $('.texts-container').scrollTop($('.texts-container')[0].scrollHeight);
            searchGoToCount = 0
            ids = []
            $('.goTo-f-b-r').fadeOut();
            $('.search-in-chat-input').val('');
        });
    </script>
    <script>
        function countdown() {
            var currentTime = new Date();
            var onlineTime = new Date("{{ $time }}");
            var difference = onlineTime.getTime() - currentTime.getTime();

            if (difference <= 0) {
                document.getElementById("countdown").innerHTML = "  ";
                return;
            }

            var seconds = Math.floor(difference / 1000);
            var minutes = Math.floor(seconds / 60);
            var hours = Math.floor(minutes / 60);
            minutes %= 60;
            seconds %= 60;

            document.getElementById("countdown").innerHTML = hours.toString().padStart(2, '0') + ":" +
                minutes.toString().padStart(2, '0') + ":" +
                seconds.toString().padStart(2, '0');

            setTimeout(countdown, 1000);
        }
        countdown();
    </script>



    {{-- //======================= SEE USER ========================= --}}
    {{-- //======================= SEE USER ========================= --}}
    {{-- //======================= SEE USER ========================= --}}

    {{-- //======================= SEE USER ========================= --}}
    {{-- //======================= SEE USER ========================= --}}
    {{-- //======================= SEE USER ========================= --}}
@endsection
