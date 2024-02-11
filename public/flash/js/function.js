function alertSucsses(text) {
  if ($(".alert-erore").length || $(".alert-sucsses").length) {
    if ($(".alert-sucsses").length) {
      $(".alert-sucsses").animate({ top: -140 }, 600);
      setTimeout(() => {
        $(".alert-sucsses").remove();
      }, 1500);
    } else {
      $(".alert-erore").animate({ top: -140 }, 600);
      setTimeout(() => {
        $(".alert-erore").remove();
      }, 1500);
    }
  }
  $("body").append(`
            <div class="alert-sucsses">${text}</div>
        `);
  $(".alert-sucsses").animate(
    {
      top: 8,
    },
    600,
    function () {
      setTimeout(() => {
        $(".alert-sucsses").animate({ top: -140 }, 600);
      }, 3500);
    }
  );
  setTimeout(() => {
    $(".alert-sucsses").remove();
  }, 5000);
}

function alertEore(text) {
  if ($(".alert-sucsses").length || $(".alert-erore").length) {
    if ($(".alert-sucsses").length) {
      $(".alert-sucsses").animate({ top: -140 }, 600);
      setTimeout(() => {
        $(".alert-sucsses").remove();
      }, 1500);
    } else {
      $(".alert-erore").animate({ top: -140 }, 600);
      setTimeout(() => {
        $(".alert-erore").remove();
      }, 1500);
    }
  }
  $("body").append(`
            <div class="alert-erore">${text}</div>
        `);
  $(".alert-erore").animate(
    {
      top: 8,
    },
    600,
    function () {
      setTimeout(() => {
        $(".alert-erore").animate({ top: -140 }, 600);
      }, 3500);
    }
  );
  setTimeout(() => {
    $(".alert-erore").remove();
  }, 5000);
}

function getCookie(cookie_name) {
  var name = cookie_name + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(";");
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
function formatDateTime(dateTimeString) {
  let date = new Date(dateTimeString);

  let year = date.getFullYear();
  let month = ("0" + (date.getMonth() + 1)).slice(-2);
  let day = ("0" + date.getDate()).slice(-2);
  let hours = ("0" + date.getHours()).slice(-2);
  let minutes = ("0" + date.getMinutes()).slice(-2);
  let seconds = ("0" + date.getSeconds()).slice(-2);

  let formattedDateTime =
    year +
    "-" +
    month +
    "-" +
    day +
    " " +
    hours +
    ":" +
    minutes +
    ":" +
    seconds;

  return formattedDateTime;
}
