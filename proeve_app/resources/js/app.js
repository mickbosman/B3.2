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
});

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
});

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
});

window.closeMenu = function() {
    var menu = document.getElementById('navigation');
    menu.style.transform = "translateX(-100%)"
}
window.openMenu = function() {
    var menu = document.getElementById('navigation');
    menu.style.transform = "translateX(0%)"
}

window.closeModal = function() {
    var modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.style.display = "none";
    });
}

window.prevModal = function() {
    closeModal();
    var modal = document.getElementById('activity-modal');
    modal.style.display = "block";
}

window.openModal = function(name, description, begin, end, audio_src, video_src, icon_src) {
    var modal = document.getElementById('activity-modal');

    modal.querySelector('#modal-icon').src = icon_src;
    modal.querySelector('#modal-title').innerHTML = name;
    modal.querySelector('#modal-description').innerHTML = description;
    modal.querySelector('#modal-period').innerHTML = "From " + begin + " to " + end;
  
    modal.style.display = "block";

    var view_button = document.getElementById('play-btn');
    var listen_button = document.getElementById('listen-btn');

    view_button.onclick = function() {
        var video_modal = document.getElementById('video-modal');

        video_modal.querySelector('#modal-icon').src = icon_src;
        video_modal.querySelector('#modal-title').innerHTML = name;
        video_modal.querySelector('#modal-video').src = video_src;

        closeModal();
        var modal = document.getElementById('video-modal');
        modal.style.display = "block";
    }

    listen_button.onclick = function() {
        var listen_modal = document.getElementById('listen-modal');

        listen_modal.querySelector('#modal-icon').src = icon_src;
        listen_modal.querySelector('#modal-title').innerHTML = name;
        listen_modal.querySelector('#modal-audio').src = audio_src;

        closeModal();
        var modal = document.getElementById('listen-modal');
        modal.style.display = "block";
    }
}