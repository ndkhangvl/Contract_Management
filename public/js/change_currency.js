function convertNumberToCurrency(number) {
    var ones = ['', 'một', 'hai', 'ba', 'bốn', 'năm', 'sáu', 'bảy', 'tám', 'chín', 'mười', 'mười một', 'mười hai', 'mười ba', 'mười bốn', 'mười lăm', 'mười sáu', 'mười bảy', 'mười tám', 'mười chín'];
    var units = ['', 'nghìn', 'triệu', 'tỷ', 'nghìn tỷ', 'triệu tỷ', 'nghìn triệu tỷ', 'tỷ tỷ'];
    
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
    
    var replaceMap = {
      'mươi một': 'mươi mốt',
      'mươi năm': 'mươi lăm',
      'trăm một nghìn': 'trăm linh mốt nghìn',
      'trăm hai nghìn': 'trăm linh hai nghìn',
      'trăm ba nghìn': 'trăm linh ba nghìn',
      'trăm bốn nghìn': 'trăm linh bốn nghìn',
      'trăm năm nghìn': 'trăm linh năm nghìn',
      'trăm sáu nghìn': 'trăm linh sáu nghìn',
      'trăm bảy nghìn': 'trăm linh bảy nghìn',
      'trăm tám nghìn': 'trăm linh tám nghìn',
      'trăm chín nghìn': 'trăm linh chín nghìn'
    };
    
    Object.keys(replaceMap).forEach(function (key) {
      result = result.replace(new RegExp(key, 'gi'), replaceMap[key]);
    });
    
    result = result.replace(/\s+/g, ' ').trim(); // Loại bỏ khoảng trắng dư thừa
    
    return result.charAt(0).toUpperCase() + result.slice(1) + ' đồng';
  }