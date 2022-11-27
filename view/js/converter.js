function convert(money, isConvert) {
    $.ajax({
        type: 'POST',
        url: '/first-serious-project/convert',
        data: {
            money: money,
            isConvert: isConvert
        },
        dataType: 'json',
        success: function (response) {
            // console.log(response);
            let curr = 'BYN';

            if ($('.switch-btn').hasClass('switch-on')) {
                curr = 'USD';
            }

            for (let i = 0; i < document.getElementsByClassName('test').length; i++) {
                document.getElementsByClassName('test')[i].textContent = 'Price: ' + response[i] + ' ' + curr;
            }
        }
    })
}

$('.switch-btn').click(function(){
    $(this).toggleClass('switch-on');
    $.ajax({
        type:'GET',
        url: 'https://www.nbrb.by/api/exrates/rates/431',
        success: function (response) {
            let isConvert = false;
            if ($('.switch-btn').hasClass('switch-on')) {
                isConvert = true;
            }

            convert(response['Cur_OfficialRate'], isConvert);
        }
    })
});