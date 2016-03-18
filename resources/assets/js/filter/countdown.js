export default (str) => {
    return String(str).replace(/hours?,?|minutes\sand|minutes?/gi, ':')
        .replace(/seconds?/gi, '').replace(/:\s?$/, '');
};