const emailRegex = new RegExp(/^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i);

$("#form__field--email").on('input', function() {
    if(this.value.length == 0) {
        $(".form__field--email").removeClass('form__field--error');
        $(".form__field--email").removeClass('form__field--success');
    } else {
        if(emailRegex.test(this.value)) {
            $(".form__field--email").addClass('form__field--success');
            $(".form__field--email").removeClass('form__field--error');
        } else {
            $(".form__field--email").addClass('form__field--error');
            $(".form__field--email").removeClass('form__field--success');
        }
    }
});

$("#form__field--password").on('input', function() {
    if(this.value.length == 0) {
        $(".form__field--password").removeClass('form__field--error');
        $(".form__field--password").removeClass('form__field--success');
    } else if(this.value.length < 10 || this.value.length > 1000) {
        $(".form__field--password").addClass('form__field--error');
        $(".form__field--password").removeClass('form__field--success');
    } else {
        $(".form__field--password").addClass('form__field--success');
        $(".form__field--password").removeClass('form__field--error');
    }
})