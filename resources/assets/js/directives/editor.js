module.exports = {
    bind() {
        const that = this;

        const config = {
            minHeight: null,
            height: 200,
            focus: false,
            codemirror: {
                theme: 'monokai'
            },
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['table', 'hr', 'link', 'picture']]
            ]
        };

        $(this.el).summernote(config).on('summernote.blur', function() {
            that.vm.$set(that.expression, $(this).summernote('code'));
        });

    }
}