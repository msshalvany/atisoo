$(document).ready(function () {
  var ajaxHandel;
  $(".stop-ajsx").click(function () {
    // توقف درخواست‌های AJAX
    if (ajaxHandel && ajaxHandel.readyState !== 4) {
      ajaxHandel.abort();
      $(".loead-wait-cin").fadeOut();
    }
  });
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
  $(".mask ,.img-mask").click(function (e) {
    e.preventDefault();
    $(".mask").fadeOut();
    $(".learn-ios").fadeOut();
    $(".navBtns").animate({ right: "-400" });
    $(".img-mask").attr("src", " ");
  });

  $(".navBtns-open").click(function (e) {
    e.preventDefault();
    $(".navBtns").css("display", "flex");
    $(".navBtns").animate({ right: "0" });
    $(".mask").fadeIn();
  });

  $(".dropdao-btn").click(function (e) {
    var list = $(e.target).next();
    $(list).slideToggle();
  });

  $(".form-1").submit(function (e) {
    e.preventDefault();
    $.ajax({
      type: "post",
      url: "/user/getPhon",
      data: $("#phon"),
      success: function (responce) {
        if (responce == 1) {
          $(".form-1").animate({
            top: "+=600",
          });
          $(".form-2").animate({
            top: "50%",
          });
        } else if (responce == "ex") {
          alertEore("شما قبلا ثبت نام کرده ای");
          setTimeout(function () {
            location.assign("/login");
          }, 2000);
        } else if (responce == 0) {
          alertEore("شماره را صحیح وارد کنید");
        }
      },
    });
  });
  $(".form-2").submit(function (e) {
    e.preventDefault();
    $.ajax({
      type: "post",
      url: "/user/atheUser",
      data: $("#code"),
      success: function (responce) {
        if (responce == 1) {
          $(".form-2").animate({
            top: "+=600",
          });
          $(".form-3").animate({
            top: "50%",
          });
        } else if (responce == 0) {
          alertEore("کد اشتباه است");
        }
      },
    });
  });
  $(".form-3").submit(function (e) {
    e.preventDefault();
    $.ajax({
      type: "post",
      url: "/user/setUserPass",
      data: new FormData(this),
      processData: false,
      contentType: false,
      success: function (responce) {
        if (responce == 1) {
          $("#send").attr("disabled", "disabled");
          alertSucsses("عملیات موفق");
          setTimeout(function () {
            location.assign("/login");
          }, 2000);
        } else if (responce == 0) {
          alertEore("رمز مناسب نیست حد اقل 4 رقم");
        } else if (responce == 2) {
          alertEore("این شماره موجود نیست");
        }
      },
    });
  });

  $(".forms-resetPass-1").submit(function (e) {
    e.preventDefault();
    $.ajax({
      type: "post",
      url: "resetPass/auth",
      data: $("#phon"),
      success: function (responce) {
        if (responce == 1) {
          $(".forms-resetPass-1").animate({
            top: "+=600",
          });
          $(".forms-resetPass-2").animate({
            top: "50%",
          });
        } else if (responce == "ex") {
          alertEore("شماره موجود نیست");
        } else if (responce == 0) {
          alertEore("شماره را صحیح وارد کنید");
        }
      },
    });
  });
  $(".forms-resetPass-2").submit(function (e) {
    e.preventDefault();
    $.ajax({
      type: "post",
      url: "/resetPass/reset",
      data: $("#code"),
      success: function (responce) {
        if (responce == 1) {
          $(".forms-resetPass-2").animate({
            top: "+=600",
          });
          $(".forms-resetPass-3").animate({
            top: "50%",
          });
        } else if (responce == 0) {
          alertEore("کد اشتباه است");
        }
      },
    });
  });
  $(".forms-resetPass-3").submit(function (e) {
    e.preventDefault();
    $.ajax({
      type: "post",
      url: "/resetPass/passChang",
      data: $("#password"),
      success: function (responce) {
        if (responce == 1) {
          $("#send").attr("disabled", "disabled");
          alertSucsses("عملیات موفق");
          setTimeout(function () {
            location.assign("/login");
          }, 2000);
        } else if (responce == 0) {
          alertEore("رمز مناسب نیست حد اقل 4 رقم");
        }
      },
    });
  });

  var sliders = document.getElementsByClassName("slider");
  for (var i = 0; sliders.length > i; i++) {
    var img = sliders[i].firstChild.nextSibling;
    img.classList.add("activ");
  }
  $(".next").click(function (e) {
    var countSlider = $(e.target).siblings(".img-magnifier-container").length;
    for (
      let index = 0;
      index < $(e.target).siblings(".img-magnifier-container").length;
      index++
    ) {
      if (
        $(e.target)
          .siblings(".img-magnifier-container")
          .eq(index)
          .hasClass("activ")
      ) {
        sliderPos = index;
      }
    }
    if (sliderPos + 1 < countSlider) {
      $(e.target)
        .parent()
        .find(".activ")
        .next(".img-magnifier-container")
        .addClass("activ");
      $(e.target).parent().find(".activ").first().removeClass("activ");
    }
  });

  $(".prev").click(function (e) {
    var sliderPos = 0;
    for (
      let index = 0;
      index < $(e.target).siblings(".img-magnifier-container").length;
      index++
    ) {
      if (
        $(e.target)
          .siblings(".img-magnifier-container")
          .eq(index)
          .hasClass("activ")
      ) {
        sliderPos = index;
      }
    }
    if (0 < sliderPos) {
      $(e.target)
        .parent()
        .find(".activ")
        .prev(".img-magnifier-container")
        .addClass("activ");
      $(e.target).parent().find(".activ").last().removeClass("activ");
    }
  });
  $(".myimage").hover(
    function (e) {
      var zoom = 5;
      function moveMagnifier(e) {
        var pos, x, y;
        /*prevent any other actions that may occur when moving over the image*/
        e.preventDefault();
        /*get the cursor's x and y positions:*/
        pos = getCursorPos(e);
        x = pos.x;
        y = pos.y;
        /*prevent the magnifier glass from being positioned outside the image:*/
        if (x > img.width - w / zoom) {
          x = img.width - w / zoom;
        }
        if (x < w / zoom) {
          x = w / zoom;
        }
        if (y > img.height - h / zoom) {
          y = img.height - h / zoom;
        }
        if (y < h / zoom) {
          y = h / zoom;
        }
        /*set the position of the magnifier glass:*/
        /*display what the magnifier glass "sees":*/
        glass.style.backgroundPosition =
          "-" + (x * zoom - w + bw) + "px -" + (y * zoom - h + bw) + "px";
      }
      function getCursorPos(e) {
        var a,
          x = 0,
          y = 0;
        e = e || window.event;
        /*get the x and y positions of the image:*/
        a = img.getBoundingClientRect();
        /*calculate the cursor's x and y coordinates, relative to the image:*/
        x = e.pageX - a.left;
        y = e.pageY - a.top;
        /*consider any page scrolling:*/
        x = x - window.pageXOffset;
        y = y - window.pageYOffset;
        return { x: x, y: y };
      }
      var img, glass, w, h, bw;
      img = e.target;
      /*create magnifier glass:*/
      glass = document.createElement("DIV");
      glass.setAttribute("class", "img-magnifier-glass");
      /*insert magnifier glass:*/
      img.parentElement.insertBefore(glass, img);
      /*set background properties for the magnifier glass:*/
      glass.style.backgroundImage = "url('" + img.src + "')";
      glass.style.backgroundRepeat = "no-repeat";
      glass.style.backgroundSize =
        img.width * zoom + "px " + img.height * zoom + "px";
      bw = 3;
      w = glass.offsetWidth / 2;
      h = glass.offsetHeight / 2;
      /*execute a function when someone moves the magnifier glass over the image:*/
      glass.addEventListener("mousemove", moveMagnifier);
      img.addEventListener("mousemove", moveMagnifier);
      /*and also for touch screens:*/
      glass.addEventListener("touchmove", moveMagnifier);
      img.addEventListener("touchmove", moveMagnifier);
    },
    function () {
      $(".img-magnifier-glass").remove();
    }
  );

  // Click function
  $("#tabs-nav li").click(function () {
    $("#tabs-nav li").removeClass("active");
    $(this).addClass("active");
    $(".tab-content").hide();
    var activeTab = $(this).find("a").attr("href");
    $(activeTab).fadeIn();
    return false;
  });
  // $('#down-tab').parent().removeClass('active');
  // $('#by-tab').parent().addClass('active');
  // $('.tab-content2').hide();
  // $('.tab-content1').show();

  $(".addShop").click(function (e) {
    var device = $(e.target).prev().attr("id");
    var flash = $(e.target).siblings("ul").find("li .flash").prop("checked");
    var iprom = $(e.target).siblings("ul").find("li .iprom").prop("checked");
    if (iprom == undefined) {
      iprom = false;
    }
    if ($(".user").attr("id") != 0) {
      $.ajax({
        type: "get",
        url: `/user/addFlash/${device}/${$(".user").attr(
          "id"
        )}/${flash}/${iprom}`,
        data: null,
        success: function (responce) {
          if (responce == 1) {
            alertSucsses("عملیات موفق");
            var num = eval($(".cart-count").text());
            $(".cart-count").text(num + 1);
          } else if (responce == 0) {
            alertEore("باید تیک فایل خود را بزنید");
          }
        },
      });
    } else {
      alertEore("ابتدا باید ثبت نام کنید");
    }
  });
  $(".check-after-by").click(function (e) {
    var check = $(".by-end").prop("disabled");
    if (check == false) {
      $(".by-end").css({
        opacity: 0.5,
      });

      $(".by-end").prop("disabled", true);
    } else {
      $(".by-end").css({
        opacity: 1,
      });
      $(".by-end").prop("disabled", false);
    }
  });
  $(".learn-ios-btn").click(function (e) {
    $(".mask").fadeIn();
    $(".learn-ios").fadeIn();
  });
  $(".learn-ios-cancel").click(function (e) {
    $(".mask").fadeOut();
    $(".learn-ios").fadeOut();
  });
  //==================chat================
  function seeUser() {
    var chate_id = $(".chat_id").val();
    var last_Messege = $(".texts-container")
      .find(".maneger-text-con")
      .eq(0)
      .attr("id");
    $.ajax({
      type: "get",
      url: `/lastSeenUser/${last_Messege}/${chate_id}`,
      processData: false,
      contentType: false,
      success: function (response) {
        console.log("see user");
      },
    });
  }
  $(".image-loder").click(function (e) {
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

  $(".chat-form-container textarea").keydown(function (e) {
    if (e.key === "Enter" && e.ctrlKey) {
      e.preventDefault(); // جلوگیری از رفتار پیش‌فرض کلید Enter
      $(this).val($(this).val() + "\n"); // اضافه کردن خط جدید
    }
  });
  $(".chat-form-container textarea").keydown(function (e) {
    if (e.key === "Enter" && !e.ctrlKey) {
      e.preventDefault();
      $(".chat-inputs").submit();
    }
  });

  $(".chat-inputs").submit(function (e) {
    var form = new FormData(this);
    e.preventDefault();
    var reply = "";
    if ($(".input-reply").val() != 0) {
      reply = `<div class="reply-text-cont">
      <i class="fa fa-reply"></i>
          <span>${$(".text-replyed").text()}</span>
      </div>`;
    }
    ajaxHandel = $.ajax({
      url: $(this).attr("action"),
      type: $(this).attr("method"),
      xhr: function () {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener(
          "progress",
          function (evt) {
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
                  }, 1000);
                }
              }
            }
          },
          false
        );
        return xhr;
      },
      dataType: "JSON",
      data: form,
      processData: false,
      contentType: false,
      success: function (data) {
        console.log(data);
        if (data == 0) {
          alertEore("این فرمت پشتیبانی نمی شود");
        } else if (data == 3) {
          alertEore("شما فقط میتونید هزار کاراکتر ارسال کنید");
        } else if (data == 4) {
          alertEore("حجم فایل حد اکثر 200 مگابایت باید باشد");
        } else if (data.type == "pic") {
          $(".texts-container").prepend(`
                  <div class="user-text-con" id=${data.masssege.id}>
                  <img src="${data.user.image} "alt="">
                    <div class="user-text">
                      ${reply ? reply : ""}
                      <img style="width: 100%" src="${data.path}" controls />
                      <p>${data.text ? data.text : ""}</p>
                      <span class="messege-time"></span>
                      <div class="messege-items-bl">
                          <i class="fa fa-trash" onclick="messDel(event)" aria-hidden="true"></i>    
                          <i class="fa fa-reply" onclick='changReply(event)' aria-hidden="true"></i>
                          <span class="messege-time">${formatDateTime(
                            data.masssege.updated_at
                          )}</span>
                      </div>                                        
                    </div>
                  </div>  
                  `);
        } else if (data.type == "file") {
          $(".texts-container").prepend(`
                  <div class="user-text-con" id=${data.masssege.id}> 
                  <img src="${data.user.image} "alt="">
                    <div class="user-text">
                      ${reply ? reply : ""}
                      <a class="downloade-file-chat" href="${
                        data.path
                      }" controls ><i class="fa fa-file"></i></a><br><br>
                      <p>${data.text ? data.text : ""}</p>
                      <div class="messege-items-bl">
                        <i class="fa fa-trash" onclick="messDel(event)" aria-hidden="true"></i>
                        <i class="fa fa-reply" onclick='changReply(event)'  aria-hidden="true"></i>
                        <span class="messege-time">${formatDateTime(
                          data.masssege.updated_at
                        )}</span>
                    </div> 
                    </div>
                  </div>  
                  `);
        } else if (data.type == "text") {
          $(".texts-container").prepend(`
                  <div class="user-text-con" id=${data.masssege.id}> 
                  <img src="${data.user.image} "alt="">
                    <div class="user-text">
                       ${reply ? reply : ""}
                      <p>${data.text ? data.text : ""}</p>
                      <div class="messege-items-bl">
                          <i class="fa fa-trash" onclick="messDel(event)" aria-hidden="true"></i>
                          <i class="fa fa-reply" onclick='changReply(event)'  aria-hidden="true"></i>
                          <span class="messege-time">${formatDateTime(
                            data.masssege.updated_at
                          )}</span>
                      </div> 
                    </div>
                  </div>  
                  `);
        }
        $(".chat-inputs").trigger("reset");
        $(".fa-reply").css("color", "black");
        $(".input-reply").val(0);
        $(".text-replyed").empty();
        seeUser();
      },
    });
  });
  $(".file-uplode").change(function (e) {
    $(".caption-file-con").animate({
      top: "50%",
    });
  });
  $(".caption-file-con button").click(function (e) {
    e.preventDefault();
    $(".caption-file-con").animate({
      top: "-12%",
    });
    var text = $(".caption-file").val();
    $(".chat-form-container textarea").val(text);
    $(".chat-inputs").submit();
    $(".chat-form-container textarea").val("");
  });
  // ============  search  ==============
  // ============  search  ==============
  $(".serach-cam").submit(function (e) {
    e.preventDefault();
    text = $(".serach-cam input").val();
    $(".resetCam-container ul li").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(text) > -1);
    });
  });
  $(".serach-device").submit(function (e) {
    e.preventDefault();
    text = $(".serach-device input").val();
    $(".resetDevice-container ul li").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(text) > -1);
    });
  });
  // ============  search  ==============
  // ============  search  ==============
});
