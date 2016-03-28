import moment from 'moment';

export default (timestamp) => {
    return moment(timestamp).format('MM/DD/YYYY');
};