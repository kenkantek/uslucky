var digitsRE = /(\d{3})(?=\d)/g;

module.exports = function(value, currency) {
    if(isNaN(value)) return value;
    value = parseFloat(value);
    if (!isFinite(value) || (!value && value !== 0)) return '';
    currency = currency != null ? currency : '$';
    var stringified = Math.abs(value).toFixed(2);
    var _int = stringified.slice(0, -3);
    var i = _int.length % 3;
    var head = i > 0 ? (_int.slice(0, i) + (_int.length > 3 ? ',' : '')) : '';
    var _float = stringified.slice(-3);
    var sign = value < 0 ? '-' : '';
    var final = sign + currency + head +
        _int.slice(i).replace(digitsRE, '$1,') +
        _float;
        
    return final.replace(/\.00$/, '');
};
