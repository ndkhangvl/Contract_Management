
function convertNumberToCurrency(number) {
    var ones = [
        '', 'một', 'hai', 'ba', 'bốn', 'năm', 'sáu', 'bảy', 'tám', 'chín', 'mười',
        'mười một', 'mười hai', 'mười ba', 'mười bốn', 'mười lăm', 'mười sáu',
        'mười bảy', 'mười tám', 'mười chín'
    ];
    var units = ['', 'nghìn', 'triệu', 'tỷ', 'nghìn tỷ', 'triệu tỷ', 'nghìn triệu tỷ', 'tỷ tỷ'];

    // Hàm chuyển đổi một số nhỏ hơn 1000 thành chuỗi chữ
    function convertLessThanOneThousand(number) {
        var result = '';

        if (number >= 100) {
        result += ones[Math.floor(number / 100)] + ' trăm ';
        number %= 100;
        }

        if (number >= 10 && number <= 19) {
        result += ones[number] + ' ';
        } else if (number >= 20) {
        result += ones[Math.floor(number / 10)] + ' mươi ';
        number %= 10;
        }

        if (number >= 1 && number <= 9) {
        result += ones[number] + ' ';
        }

        return result;
    }

    if (number === 0) {
        return 'Không đồng';
    }

    var result = '';

    for (var i = 0; number > 0; i++) {
        var chunk = number % 1000;
        if (chunk !== 0) {
        result = convertLessThanOneThousand(chunk) + units[i] + ' ' + result;
        }
        number = Math.floor(number / 1000);
    }

    return result.trim().charAt(0).toUpperCase() + result.slice(1) + 'đồng';
}