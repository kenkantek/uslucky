module.exports = {
    params: ['submiting', 'complete', 'error'],

    data: null,

    bind() {
        this.el.addEventListener(
            'submit', this.onSubmit.bind(this)
        );
    },

    update(data = {}) {
        this.data = data;
    },

    onSubmit(event) {
        this.beginSubmit(this.data);

        const requestType = this.getRequestType();

        this.vm
            .$http[requestType](this.el.action, this.data)
            .then(this.onComplete.bind(this))
            .catch(this.onError.bind(this));

        event.preventDefault();
    },

    beginSubmit(data) {
        if(typeof this.params.submiting === 'function') {
            this.params.submiting(data);
        }
    },

    onComplete({ data }) {
        if(this.checkSilent()) return;

        if (typeof this.params.complete === 'function') {
            this.params.complete(data);
        }
    },

    onError({ status, data }) {
        if(this.checkSilent()) return;

        if (typeof this.params.error === 'function') {
            this.params.error(data, status);
        }
    },

    getRequestType() {
        const method = this.el.querySelector('input[name="_method"]');

        return (method ? method.value : this.el.method).toLowerCase();
    },

    checkSilent() {
        return !!this.arg && this.arg === 'slient';
    }
}