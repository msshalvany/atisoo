<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">

    <title>atisoo Admin</title>
    <link href="/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin/css/bootstrap-reset.css" rel="stylesheet">
    <link href="/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/admin/css/style.css') }}?t={{ time() }}" />
    <link href="/admin/css/style-responsive.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src='/admin/js/jquery.js'></script>
    <script src={{ asset('/admin/js/script.js') }}?t={{ time() }}></script>
    <script src={{ asset('/flash/js/function.js') }}?t={{ time() }}></script>
    <style>
        p {
            white-space: pre-wrap;
            display: inline;

        }

        a {
            color: black !important;
        }

        .chateOther {
            width: 52px;
            align-self: center;
            border-radius: 12px;
            border: none;
            background: #dfdfdf;
            padding: 6px;
            font-size: 21px
        }

        .chat-back {
            position: fixed;
            top: 20px;
            left: 20px;
            font-size: 24px;
            color: black;
            cursor: pointer;

        }

        .set-time-con .set-time-form {
            position: absolute;
            display: none;
            background: white;
            padding: 27px 20px;
            margin: 6px 0 0 0;
            z-index: 12;
        }

        #countdown {
            margin: 12px 12px 0 0;
            font-weight: bold;
            font-size: 20px;
        }

        .ready-mess-con ul {
            width: 400px;
            margin: 12px 0 0 0;
            height: 300px;
            overflow: auto;
            display: none;
            position: absolute;
            z-index: 12;
        }

        .ready-mess-con ul li {
            background: white;
            padding: 12px;
            transition: all .4s;
            text-align: right;
        }

        * {
            direction: rtl
        }

        .loead-wait-cin {
            width: 100%;
            height: 100vh;
            position: fixed;
            background-color: rgb(69 69 69 / 70%);
            z-index: 12;
            display: none;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .loead-wait-cin span {
            opacity: 1;
            font-size: 40px;
            font-weight: bold;
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

        .link-in-chat {
            color: rgb(81, 81, 250) !important;
            cursor: pointer;
        }

        .link-in-chat:hover {
            color: rgb(33, 33, 248) !important;
            text-decoration: underline;
        }
    </style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="loead-wait-cin">
        <span class="pers"></span>
        <span>در حال اپلود ....</span>
        <button class="btn btn-danger stop-ajsx">کنسل</button>
    </div>
    <div class="caption-file-con">
        <div class="form-group">
            <label class="" for="text">توضیحات عکس :</label>
            <textarea class="form-control caption-file" name="text" id="text" rows="5"></textarea>
        </div><br>
        <div class="form-group">
            <button class="btn btn-danger">ارسال</button>
        </div>
    </div>
    <div id="countdown"></div>
    <script>
        function countdown() {
            var currentTime = new Date();
            var onlineTime = new Date("{{ $time }}");
            var difference = onlineTime.getTime() - currentTime.getTime();

            if (difference <= 0) {
                document.getElementById("countdown").innerHTML = "00:00";
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
    <div class="nav-chat navbar">
        <div>
            <form action="{{ route('sendSmsNow', ['id' => $user->id]) }}" method="POST">
                @csrf
                <button class="btn btn-sm btn-danger">ارسال sms</button>
            </form>
        </div>
        <div class="search-in-chat-con">
            <input class="search-in-chat-input" type="search">
            <button class="search-in-chat-btn btn-sm btn-primary">جستجو</button><br>
            <div style="display: none" class="goTo-f-b-r">
                <button class="next-serch-btn btn-sm btn-primary">بعدی</button>
                <button class="prev-serch-btn btn btn-sm btn-primary">قبلی</button>
                <button style="border-radius: 50%;padding: 5px;width: 30px;height: 30px;" class="stop-search red-btn"><i
                        class="fa fa-close"></i></button>
            </div>
        </div>

        <div class="ready-mess-con">
            <button class="btn btn-sm btn-success show-radey-mess-btn">متن های اماده</button>
            <ul>
                @foreach ($readyMessege as $item)
                    <li> {!! $item->text !!} </li>
                @endforeach
            </ul>
        </div>
        {{-- <div class="set-time-con">
            <button class="btn btn-sm btn-success  show-set-time-btn">تایین زمان انلاین شدن</button>
            <div class="set-time-form">
                <form action="{{ route('setTime') }}" method="POST">
                    @csrf
                    <div>
                    </div>
                    ساعت : <input min="0" max="12" name="hour" type="number" value="0">
                    دقیقه : <input min="0" max="59" name="minute" type="number" value="0"><br><br>
                    <input type="submit" value="set" class="btn btn-primary">
                </form>

            </div>
        </div> --}}
    </div>
    <div class="user" id="{{ $user->id }}"></div>
    <div class="chate_id" id="{{ $chate_id }}"></div>
    @php
        $chat = App\Models\chate::find($chate_id);
    @endphp
    <a href="/dashbord/chatlist">
        <div class="chat-back"><i class="fa fa-backward"></i><br></div>
    </a>
    <div class="texts-container">
        @foreach ($messegs as $item)
            @if ($item->user_id == 0)
                @if ($item->hide != 1)
                    <div class="maneger-text-con" id="{{ $item->id }}">
                        <img src="/flash/img/maneger.png" alt="">
                        <div class="maneger-text parent-image">
                            @if ($item->reply != 0)
                                <div class="reply-text-cont" onclick="id_to_reply(event)">
                                    <i class="fa fa-reply"></i>
                                    @php
                                        $replyText = \App\Models\messegeChat::find($item->reply)->text;
                                    @endphp
                                    <span style="display: none" class="id-to-reply">{{ $item->reply }}</span>
                                    <span>{{ $replyText }}</span>
                                </div>
                            @endif
                            @php
                                $admin = \App\Models\admin::find($item->admin_id);
                            @endphp
                            {{ $admin ? $admin->username : 'ادمین پاک شده' }} :
                            @if ($item->file != null)
                                <a class="downloade-file-chat" href="/{{ $item->file }}" controls><i
                                        class="fa fa-file"></i></a><br>
                            @endif
                            @if ($item->image != '')
                                <img width="100%" class="pic" src="/{{ $item->image }}" alt="">
                            @endif
                            @if ($item->voice != null)
                                <audio src="/{{ $item->voice }}" controls></audio>
                            @endif
                            <p class="main-text">{!! $item->text !!}</p>
                            <div class="messege-items-bl">
                                <i class="fa fa-trash" onclick="messDel(event)" aria-hidden="true"></i>
                                <i class="fa fa-reply" onclick="changReply(event)" aria-hidden="true"></i>
                                <span class="messege-time">{{ $item->updated_at }}</span>
                            </div>
                        </div>
                    </div>
                @elseif ($item->hide == 1 && session()->get('level') == 1)
                    <div class="maneger-text-con" id="{{ $item->id }}">
                        <img src="/flash/img/maneger.png" alt="">
                        <div class="maneger-text parent-image"
                            @if ($item->hide == 1) style="opacity: 0.5" @endif>
                            @if ($item->reply != 0)
                                <div class="reply-text-cont" onclick="id_to_reply(event)">
                                    <i class="fa fa-reply"></i>
                                    @php
                                        $replyText = \App\Models\messegeChat::find($item->reply)->text;
                                    @endphp
                                    <span style="display: none" class="id-to-reply">{{ $item->reply }}</span>
                                    <span>{{ $replyText }}</span>
                                </div>
                            @endif
                            @php
                                $admin = \App\Models\admin::find($item->admin_id);
                            @endphp
                            {{ $admin->username }} :
                            @if ($item->file != null)
                                <a class="downloade-file-chat" href="/{{ $item->file }}" controls><i
                                        class="fa fa-file"></i></a><br>
                            @endif
                            @if ($item->image != '')
                                <img width="100%" class="pic" src="/{{ $item->image }}" alt="">
                            @endif
                            @if ($item->voice != null)
                                <audio src="/{{ $item->voice }}" controls></audio>
                            @endif
                            <p class="main-text">{!! $item->text !!}</p>
                            <div class="messege-items-bl">
                                <i class="fa fa-trash" onclick="messDel(event)" aria-hidden="true"></i>
                                <i class="fa fa-reply" onclick="changReply(event)" aria-hidden="true"></i>
                                <span class="messege-time">{{ $item->updated_at }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="user-text-con" id="{{ $item->id }}">
                    <img class="user-image" src="/{{ $user->image }}"alt="">
                    <div class="user-text" @if ($item->hide == 1) style="opacity: 0.5" @endif>
                        @if ($item->reply != 0)
                            <div class="reply-text-cont" onclick="id_to_reply(event)">
                                <i class="fa fa-reply"></i>
                                <span style="display: none" class="id-to-reply">{{ $item->reply }}</span>
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
                            <img width="100%" class="pic" src="/{{ $item->image }}" alt="">
                        @endif
                        @if ($item->voice != null)
                            <audio style="width: 100%" src="/{{ $item->voice }}" controls></audio>
                        @endif
                        <span style="color: rgb(123, 0, 0)">{{ $user->frind }} :</span>
                        <p class="main-text">{!! $item->text !!}</p>
                        <div class="messege-items-bl">
                            <span class="messege-time">{{ $item->updated_at }}</span>
                            <i class="fa fa-reply" onclick="changReply(event)" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        {{-- <button class="chateOther" onclick="chateOther()"><i class="fa fa-arrow-up"></i></button> --}}
    </div>
    <div class="chat-form-container">
        <form class="chat-inputs" method="POST" action="{{ route('reciveDataAdmin') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="text-replyed"></div>
            <input type="hidden" class="input-reply" name="reply" value="0">
            <button class="send-chat"><i class="fa fa-paper-plane"></i></button>

            <textarea name="text" placeholder="پیام خود را تایپ کنید ......"></textarea>
            <label class="label">
                <input id="file-uplode" class="file-uplode" name="file" type="file" />
                <span><i class="fa fa-image"></i></span>
            </label>
            <input type="hidden" name="chate_id" value="{{ $chate_id }}">
        </form>
        <button id="btnStart" class="send-voice"><i class="fa fa-microphone"></i></button>
    </div>
</body>
<script>
    var ajaxHandel;
    $(".stop-ajsx").click(function() {
        // توقف درخواست‌های AJAX
        if (ajaxHandel && ajaxHandel.readyState !== 4) {
            ajaxHandel.abort();
            $('.loead-wait-cin').fadeOut();
        }
    });
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.texts-container > div.maneger-text-con').each(function() {
        console.log($(this).attr('id'));
        var id = parseInt($(this).attr('id'));
        if (id <= {{ $chat->see_user }}) {
            $(this).find('.messege-items-bl').prepend(
                `<i class="fa fa-eye"  aria-hidden="true"></i>`)
        }
    });

    function goTo(id) {
        $('.texts-container').animate({
            scrollTop: $(`#${id}`).offset().top - 200
        }, 00);
    }

    function seeAdmin() {
        var chate_id = $(".chate_id").attr('id');
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
    seeAdmin()
    setInterval(() => {
        seeAdmin()
    }, 5000);
    setInterval(() => {
        var chate_id = $('.chate_id').attr('id');
        var last_Messege = $(".texts-container").find(".maneger-text-con").eq(0).attr("id");
        $.ajax({
            type: "get",
            url: `/checkSeeUser/${last_Messege}/${chate_id}`,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                if (response == 1) {
                    $('.texts-container > div.maneger-text-con .messege-items-bl').each(function() {
                        if (!$(this).find('i').hasClass('fa-eye')) {
                            $(this).prepend(`<i class="fa fa-eye" aria-hidden="true"></i>`)
                        }
                    });
                }
            },
        });
    }, 5000);
    //==================chat================
    $(".image-loder").click(function(e) {
        e.preventDefault();
        var src = $(e.target)
            .parents()
            .find(".parent-image")
            .find(".image-loder")
            .attr("id");
        $(e.target)
            .parents()
            .find(".parent-image")
            .prepend(`<img width="100%" src='${src}'>`);
        $(e.target).parents().find(".image-loder").remove();
    });
    $(".chat-inputs").submit(function(e) {
        e.preventDefault();
        var reply = "";
        if ($(".input-reply").val() != 0) {
            reply = `<div class="reply-text-cont">
            <i class="fa fa-reply"></i>
                <span>${$(".text-replyed").text()}</span>
            </div>`;
        }
        var form = new FormData(this);
        ajaxHandel = $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            dataType: "JSON",
            data: form,
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener(
                    "progress",
                    function(evt) {
                        if (form.get("file").name != "") {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                percentComplete = parseInt(percentComplete * 100);
                                console.log(percentComplete);
                                $(".loead-wait-cin").css("display", "flex");
                                $(".loead-wait-cin").find(".pers").text(`${percentComplete} %`);
                                console.log(percentComplete);
                                if (percentComplete == 100) {
                                    setTimeout(() => {
                                        $(".loead-wait-cin").fadeOut();
                                        console.log("end");
                                    }, 2000);
                                }
                            }
                        }
                    },
                    false
                );
                return xhr;
            },
            processData: false,
            contentType: false,
            success: function(data) {
                if (data == 0) {
                    alertEore("این فرمت پشتیبانی نمی شود");
                } else if (data.type == "pic") {
                    $(".texts-container").prepend(`
                  <div class="maneger-text-con" id="${data.masssege.id}">
                  <img src="/flash/img/maneger.png"alt="">
                    <div class="maneger-text">
                        ${reply ? reply : ""}
                      <img style="width: 100%" src="/${data.path}" controls />
                      <p>${data.text ? data.text : ""}</p>
                      <span class="messege-time"></span>
                      <div class="messege-items-bl">
                          <i class="fa fa-trash" onclick="messDel(event)" aria-hidden="true"></i>
                          <i class="fa fa-reply" onclick='changReply(event)' aria-hidden="true"></i>
                          <span class="messege-time">${
                            formatDateTime(data.masssege.updated_at)
                          }</span>

                    </div>
                  </div>
                  `);
                } else if (data.type == "file") {
                    $(".texts-container").prepend(`
                  <div class="maneger-text-con" id="${data.masssege.id}">
                  <img src="/flash/img/maneger.png"alt="">
                    <div class="maneger-text">
                        ${reply ? reply : ""}
                        <a class="downloade-file-chat" href="/${
                            data.path
                        }" controls ><i class="fa fa-file"></i></a><br><br>
                        <p>${data.text ? data.text : ""}</p>
                        <div class="messege-items-bl">
                            <i class="fa fa-trash" onclick="messDel(event)" aria-hidden="true"></i>
                            <i class="fa fa-reply" onclick='changReply(event)'  aria-hidden="true"></i>
                            <span class="messege-time">${
                            formatDateTime(data.masssege.updated_at)
                            }</span>
                    </div>
                  </div>
                  `);
                } else if (data.type == "text") {
                    $(".texts-container").prepend(`
                  <div class="maneger-text-con" id="${data.masssege.id}">
                  <img src="/flash/img/maneger.png"alt="">
                    <div class="maneger-text">
                        ${reply ? reply : ""}
                      <p>${data.text ? data.text : ""}</p>
                        <div class="messege-items-bl">
                            <i class="fa fa-trash" onclick="messDel(event)" aria-hidden="true"></i>
                            <i class="fa fa-reply" onclick='changReply(event)'  aria-hidden="true"></i>
                          <span class="messege-time">${
                            formatDateTime(data.masssege.updated_at)
                          }</span>
                      </div>
                    </div>
                  </div>
                  `);
                }
                $(".chat-inputs").trigger("reset");
                $('.fa-reply').css('color', 'black');
                $(".input-reply").val(0);
                $(".text-replyed").empty();
                $(".chat-inputs").trigger("reset");
            },
        });
    });

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
                            <div class="maneger-text-con" id='${lastMessege + 1}'>
                            <img src="/flash/img/maneger.png"alt="">
                                <div class="maneger-text">
                                    <div class="messege-items-bl">
                                        <i class="fa fa-trash" onclick="messDel(event)" aria-hidden= "true"></i>
                                        <i class="fa fa-reply" onclick="changReply(event)" aria-hidden="true"></i>
                                        <span class="messege-time"></span>
                                    </div>
                                    <audio style='width: 100%' controls src='${audioURL}'/>
                                </div>
                            </div>
                         `)
                        var formData = new FormData();
                        formData.append("file", audiofile);
                        formData.append("chat_id", $(".chate_id").attr('id'));
                        ajaxHandel = $.ajax({
                            type: "POST",
                            url: `{{ route('sendAdminAudio') }}`,
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
                                console.log(response);
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
    $(".file-uplode").change(function(e) {
        $(".caption-file-con").animate({
            top: "50%",
        });
    });
    $(".caption-file-con button").click(function(e) {
        e.preventDefault();
        $(".caption-file-con").animate({
            top: "-12%",
        });
        var text = $(".caption-file").val();
        $(".chat-form-container textarea").val(text);
        $(".chat-inputs").submit();
        $(".chat-form-container textarea").val("");
    });
    // =============voice=============
    // =============voice=============
    // =============voice=============
    // =============voice=============
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
                if (data != 0 && data.user_id != 0) {
                    seeAdmin()
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
                    var image = $('.user-text-con').find('img').attr("src")
                    if (data.image != null) {
                        $(".texts-container").prepend(`
                            <div class="user-text-con" id="${data.id}">
                                <img src="${image}"alt="">
                                <div class="user-text">
                                    ${reply}
                                    <img style="width: 100%" src="/${data.image}" />
                                    <span style="color: rgb(123, 0, 0)">{{ $user->frind }} :</span>
                                    <p>${data.text ? data.text : ''}</p>
                                    <div class="messege-items-bl">
                                        <span class="messege-time">${formatDateTime(data.updated_at)}</span>
                                        <i class="fa fa-reply" onclick="changReply(event)" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        `);
                        $('.texts-container').scrollTop(200);

                    } else if (data.file != null) {
                        $(".texts-container").prepend(`
                        <div class="user-text-con" id="${data.id}">
                            ${reply}
                            <img src="${image}"alt="">
                            <div class="user-text">
                            <a class="/${data.user.image}" href="/${data.file}" controls ><i class="fa fa-file"></i></a><br><br>
                            <span style="color: rgb(123, 0, 0)">{{ $user->frind }} :</span>
                            <p>${data.text ? data.text : ''}</p>
                                <div class="messege-items-bl">
                                    <span class="messege-time">${formatDateTime(data.updated_at)}</span>
                                    <i class="fa fa-reply" onclick="changReply(event)" aria-hidden="true"></i>
                                /div>
                            </div>
                        </div>
                        `);
                        $('.texts-container').scrollTop(200);

                    } else if (data.voice != null) {
                        $(".texts-container").prepend(`
                        <div class="user-text-con" id="${data.id}">
                            <img src="${image}"alt="">
                            <div class="user-text">
                                ${reply}
                                <audio style="width: 100%" src="/${data.voice}" controls></audio>
                                <div class="messege-items-bl">
                                    <span class="messege-time">${formatDateTime(data.updated_at)}</span>
                                    <i class="fa fa-reply" onclick="changReply(event)" aria-hidden="true"></i>
                                /div>
                            </div>
                        </div>
                        `);
                        $('.texts-container').scrollTop(200);

                    } else {
                        $(".texts-container").prepend(`
                        <div class="user-text-con" id="${data.id}">
                            <img src="${image}"alt="">
                            <div class="user-text">
                                ${reply}
                                <span style="color: rgb(123, 0, 0)">{{ $user->frind }} :</span>
                                <p>${data.text}</p>
                                <div class="messege-items-bl">
                                        <span class="messege-time">${formatDateTime(data.updated_at)}</span>
                                        <i class="fa fa-reply" onclick="changReply(event)" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        `);
                    }
                    $('.texts-container').scrollTop(200);
                }
            },
        });
    }, 3000);
    var chateOtherCounter = 1;

    function chateOther() {
        chate_id = $('.chate_id').attr('id');
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
                        user_image = "/flash/img/maneger.png"
                    } else {
                        user_id = "user-text-con"
                        style_user = 'user-text'
                        user_image = $('.user-image').attr('src');
                    }
                    if (data.image != null) {
                        $(".texts-container").append(`
                  <div class="${user_id}" id="${data.id}">
                  <img src="${user_image}"alt="">
                    <div class="${style_user}">
                      <img style="width: 100%" src="/${data.image}" controls />
                      ${data.text ? data.text : ""}
                      <span class="messege-time">${formatDateTime(data.updated_at)}</span>
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
                      <span class="messege-time">${formatDateTime(data.updated_at)}</span>
                    </div>
                  </div>
                     <img src="flash/img/maneger.png"alt="">
               `);
                    } else if (data.voice != null) {
                        $(".texts-container").append(`
                  <div class="${user_id}" id="${data.id}">
                  <img src="${user_image}"alt="">
                    <div class="${style_user}">
                    <audio style="width: 100%" src="/${data.voice}" controls></audio>
                      ${data.text ? data.text : ""}
                      <span class="messege-time">${formatDateTime(data.updated_at)}</span>

                    </div>
                  </div>
                     <img src="flash/img/maneger.png"alt="">
               `);
                    } else {
                        $(".texts-container").append(`
                  <div class="${user_id}" id="${data.id}">
                  <img src="${user_image}"alt="">
                    <div class="${style_user}">
                    ${data.text}
                    <span class="messege-time">${formatDateTime(data.updated_at)}</span>

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

    function changReply(e) {
        console.log('reply');
        var reply_id = $(e.target).parents().parents().parents().attr('id')
        var text = $(`#${reply_id}`).find('p').text()
        console.log(text);
        if ($('.input-reply').val() == reply_id) {
            $(e.target).css('color', 'black');
            $('.input-reply').val(0);
            $('.text-replyed').empty();
        } else {
            $('.text-replyed').empty();
            $('.fa-reply').css('color', 'black');
            $(e.target).css('color', 'red');
            $('.input-reply').val(reply_id);
            $('.text-replyed').append(`<div><i class="fa fa-reply" aria-hidden="true"></i>` + text +
                `</div><i class="fa fa-close text-danger float-end " onclick="cancelRep()" aria-hidden="true"></i>`);
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
            url: "{{ route('deletMessAdmin') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response == 2) {
                    alertEore('امکان حذف وجود ندارد')
                } else {
                    $(`#${del_id}`).remove();
                }
            }
        });
    }

    function id_to_reply(e) {
        var replyTo = eval($(e.currentTarget).find('.id-to-reply').text());
        $('.texts-container').animate({
            scrollTop: $(`#${replyTo}`).offset().top - 100
        }, 1000);
    }
    var goToPr = getUrlParameter('goTo')
    if (goToPr != false) {
        $('.texts-container').animate({
            scrollTop: $(`#${goToPr}`).offset().top - 200
        }, 1000);
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

    $('.show-radey-mess-btn').click(function(e) {
        e.preventDefault();
        $('.ready-mess-con ul').toggle();
    });
    $('.ready-mess-con ul li').click(function(e) {
        var text = $(e.target).text();
        console.log(text);
        $('.chat-inputs textarea').text(text);
        $('.ready-mess-con ul').toggle();
    });
</script>
