function alertSucsses(text) {
    if ($('.alert-erore').length || $('.alert-sucsses').length) {
       if ($('.alert-sucsses').length){
           $('.alert-sucsses').animate({'top': -140}, 600)
           setTimeout(() => {
               $('.alert-sucsses').remove();
           }, 1500);
       }else {
           $('.alert-erore').animate({'top': -140}, 600)
           setTimeout(() => {
               $('.alert-erore').remove();
           }, 1500);
       }
    }
    $('body').append(`
            <div class="alert-sucsses">${text}</div>
        `);
    $('.alert-sucsses').animate({
        'top': 8
    }, 600, function () {
        setTimeout(() => {
            $('.alert-sucsses').animate({'top': -140}, 600)
        }, 3500);
    });
    setTimeout(() => {
        $('.alert-sucsses').remove();
    }, 5000);

}

function alertEore(text) {
    if ($('.alert-sucsses').length || $('.alert-erore').length) {
        if ($('.alert-sucsses').length){
            $('.alert-sucsses').animate({'top': -140}, 600)
            setTimeout(() => {
                $('.alert-sucsses').remove();
            }, 1500);
        }else {
            $('.alert-erore').animate({'top': -140}, 600)
            setTimeout(() => {
                $('.alert-erore').remove();
            }, 1500);
        }
    }
    $('body').append(`
            <div class="alert-erore">${text}</div>
        `);
    $('.alert-erore').animate({
        'top': 8
    }, 600, function () {
        setTimeout(() => {
            $('.alert-erore').animate({'top': -140}, 600)
        }, 3500);
    });
    setTimeout(() => {
        $('.alert-erore').remove();
    }, 5000);
}
