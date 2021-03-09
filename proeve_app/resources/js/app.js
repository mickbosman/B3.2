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
    } else if(this.value.length < 8 || this.value.length > 1000) {
        $(".form__field--password").addClass('form__field--error');
        $(".form__field--password").removeClass('form__field--success');
    } else {
        $(".form__field--password").addClass('form__field--success');
        $(".form__field--password").removeClass('form__field--error');
    }
})

$("#form__field--password_confirm").on('input', function() {
    if(this.value.length == 0) {
        $(".form__field--password_confirm").removeClass('form__field--error');
        $(".form__field--password_confirm").removeClass('form__field--success');
    } else if(this.value.length < 8 || this.value.length > 1000) {
        $(".form__field--password_confirm").addClass('form__field--error');
        $(".form__field--password_confirm").removeClass('form__field--success');
    } else {
        $(".form__field--password_confirm").addClass('form__field--success');
        $(".form__field--password_confirm").removeClass('form__field--error');
    }
})

$("#form__field--name").on('input', function() {
    if(this.value.length == 0) {
        $(".form__field--name").removeClass('form__field--error');
        $(".form__field--name").removeClass('form__field--success');
    } else if(this.value.length < 4 || this.value.length > 255) {
        $(".form__field--name").addClass('form__field--error');
        $(".form__field--name").removeClass('form__field--success');
    } else {
        $(".form__field--name").addClass('form__field--success');
        $(".form__field--name").removeClass('form__field--error');
    }
})