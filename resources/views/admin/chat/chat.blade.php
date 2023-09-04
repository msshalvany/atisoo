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
    <script src="/admin/js/jquery.js"></script>
    <script src="/flash/js/function.js"></script>
    <style>
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
        }
    </style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="user" id="{{ $user->id }}"></div>
    <div class="chate_id" id="{{ $chate_id }}"></div>
    <a href="/dashbord/chatlist">
        <div class="chat-back"><i class="fa fa-backward"></i><br></div>
    </a>
    <div class="texts-container">
        @foreach ($messegs as $item)
            @if ($item->user_id == 0)
                <div class="maneger-text-con" id="{{ $item->id }}">
                    <img src="/flash/img/maneger.png" alt="">
                    <div class="maneger-text parent-image">
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
                        {{ $item->text }}
                        <span class="messege-time">{{ $item->updated_at }}</span>
                    </div>
                </div>
            @else
                <div class="user-text-con" id="{{ $item->id }}">
                    <img class="user-image" src="/{{ $user->image }}"alt="">
                    <div class="user-text">
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
                        {{ $item->text }}
                        <span class="messege-time">{{ $item->updated_at }}</span>

                    </div>
                </div>
            @endif
        @endforeach
        <button class="chateOther" onclick="chateOther()"><i class="fa fa-arrow-up"></i></button>
    </div>
    <div class="chat-form-container">
        <form class="chat-inputs" method="POST" action="{{ route('reciveDataAdmin') }}" enctype="multipart/form-data">
            @csrf
            <button class="send-chat"><i class="fa fa-paper-plane"></i></button>
            <textarea name="text" placeholder="پیام خود را تایپ کنید ......"></textarea>
            <label class="label">
                <input id="file-uplode" name="file" type="file" />
                <span><i class="fa fa-image"></i></span>
            </label>
            <input type="hidden" name="chate_id" value="{{ $chate_id }}">
        </form>
        <button id="btnStart" class="send-voice"><i class="fa fa-microphone"></i></button>
    </div>
</body>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // function seeAdmin() {
    //     var chate_id = $('.chate_id').attr('id');
    //     var last_Messege = $('.texts-container').children().eq(0).attr('id');
    //     $.ajax({
    //         type: "get",
    //         url: `/lastSeenAdmin/${last_Messege}/${chate_id}`,
    //         processData: false,
    //         contentType: false,
    //         success: function(response) {

    //         }
    //     });
    // }
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
        var formValues = new FormData();
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            dataType: "JSON",
            data: new FormData(this),
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
                      <img style="width: 100%" src="/${data.path}" controls />
                      ${data.text ? data.text : ''}
                      <span class="messege-time">${data.masssege.updated_at}</span>
                        
                    </div>
                  </div>  
                  `);
                } else if (data.type == "file") {
                    $(".texts-container").prepend(`
                  <div class="maneger-text-con" id="${data.masssege.id}"> 
                  <img src="/flash/img/maneger.png"alt="">
                    <div class="maneger-text">
                      <a class="downloade-file-chat" href="/${data.path}" controls ><i class="fa fa-file"></i></a><br><br>
                      ${data.text ? data.text : ''}
                      <span class="messege-time">${data.masssege.updated_at}</span>

                    </div>
                  </div>  
                  `);
                } else if (data.type == "text") {
                    $(".texts-container").prepend(`
                  <div class="maneger-text-con" id="${data.masssege.id}"> 
                  <img src="/flash/img/maneger.png"alt="">
                    <div class="maneger-text">
                      ${data.text}
                      <span class="messege-time">${data.masssege.updated_at}</span>

                    </div>
                  </div>  
                  `);
                }
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
                                <audio style='width: 100%' controls src='${audioURL}'/>
                                </div>
                            </div>  
                         `);
                        var formData = new FormData();
                        formData.append("file", audiofile);
                        formData.append("chat_id", $(".chate_id").attr('id'));
                        $.ajax({
                            type: "POST",
                            url: "/sendAdminAudio",
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

    // =============voice=============
    // =============voice=============
    // =============voice=============
    // =============voice=============
    setInterval(() => {
        var lastMessege = $(".texts-container").children().eq(0).attr("id");
        var image = $('.user-text-con').children().find('img').attr("src")
        $.ajax({
            url: `/checkSendChat`,
            type: "POST",
            dataType: "JSON",
            data: {
                id: lastMessege,
                user: $(".user").attr("id")
            },
            success: function(data) {
                if (data != 0) {
                    if (data.image != null) {
                        $(".texts-container").prepend(`
                            <div class="user-text-con" id="${data.id}">
                                <img src="${image}"alt="">
                                <div class="user-text">
                                <img style="width: 100%" src="/${data.image}" controls />
                                ${data.text ? data.text : ''}
                                </div>
                            </div>  
                        `);
                        $('.texts-container').scrollTop(200);

                    } else if (data.file != null) {
                        $(".texts-container").prepend(`
                        <div class="user-text-con" id="${data.id}"> 
                            <img src="${image}"alt="">
                            <div class="user-text">
                            <a class="/${data.user.image}" href="/${data.file}" controls ><i class="fa fa-file"></i></a><br><br>
                            ${data.text ? data.text : ''}
                            <span class="messege-time">${data.updated_at}</span>
                            </div>
                        </div>  
                        `);
                        $('.texts-container').scrollTop(200);

                    } else if (data.voice != null) {
                        $(".texts-container").prepend(`
                        <div class="user-text-con" id="${data.id}"> 
                            <img src="${image}"alt="">
                            <div class="user-text">
                                <audio style="width: 100%" src="/${data.voice}" controls></audio>
                                <span class="messege-time">${data.updated_at}</span>
                            </div>
                        </div>  
                        `);
                        $('.texts-container').scrollTop(200);

                    } else {
                        $(".texts-container").prepend(`
                        <div class="user-text-con" id="${data.id}"> 
                        <img src="${image}"alt="">
                            <div class="user-text">
                            ${data.text}
                            <span class="messege-time">${data.updated_at}</span>
                            </div>
                        </div>  
                        `);
                    }
                    $('.texts-container').scrollTop(200);
                }
            },
        });
    }, 2000);
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
                     <img src="flash/img/maneger.png"alt="">
               `);
                    } else if (data.voice != null) {
                        $(".texts-container").append(`
                  <div class="${user_id}" id="${data.id}"> 
                  <img src="${user_image}"alt="">
                    <div class="${style_user}">
                    <audio style="width: 100%" src="/${data.voice}" controls></audio>
                      ${data.text ? data.text : ""}
                      <span class="messege-time">${data.updated_at}</span>

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
</script>
