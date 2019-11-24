(function($) {

    'use strict';

    $(document).on('ready', function() {
        setActiveLink();
        closeNotice();
        showResetPassword();
        anchor();
        uploadPopup();
        uploadButton();
        changeTabs();
        initOwlSlider();
        filterColor();
        showMessages();
        showSnapEdit();
        cancelSnapEdit();
        activateMessageForm();
        showCommentEdit();
        cancelCommentEdit();
    });

    $(document).on('ajaxComplete', function() {
        closeNotice();
        showCommentEdit();
        cancelCommentEdit();
    });

    function setActiveLink() {
        var path = window.location.pathname;
        var homeNav = $('#nav ul li:nth-child(1)');
        var discoverNav = $('#nav ul li:nth-child(2)');
        var adminPanelNav = $('#nav ul li:nth-child(5)');

        if( path.startsWith('/snap') ) {
            homeNav.find('a').addClass('active');
        }

        if( path.startsWith('/results') || path.startsWith('/archive') ) {
            discoverNav.find('a').addClass('active');
        }

        if( path.startsWith('/admin-panel') ) {
            adminPanelNav.find('a').addClass('active');
        }
    }

    function closeNotice() {
        var messages = $('#notice');

        messages.on('click', function(event) {
            if (!$(event.target).closest('.notices').length) {
                messages.fadeOut(300, function() {
                    messages.remove();
                })
            }
        });
    }

    function showResetPassword() {

        var button = $('#forget-password-button');

        button.on('click', function(e) {
            e.preventDefault();

            var content = '<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body">' +
                '<form method="POST" action="' + baseUrl + 'reset-password' + '"><div class="row"><div class="12u"><input type="email" name="reset-email" id="reset-email" placeholder="E-mail" /><label for="reset-email">Enter your E-mail.</label></div></div><div class="row"><div class="12u"><input type="button" class="button" name="reset-password-button" id="reset-password-button" onclick="resetPassword();" value="Reset" /></div></div></form>' +
                '</div></div></div></div></div>';
            $(content).hide().appendTo('#main').fadeIn(300);
            closeNotice();
        });
    }

    function anchor() {

        $('.anchor').on('click', function(e) {
            e.preventDefault();

            var div = $(this).attr('data-anchor');

            $('html, body').animate({
                scrollTop: $(div).offset().top}, 0);
        });
    }

    function uploadPopup() {
        var popup = $('#popup'),
            popupBtn = $('#popup-btn');

        popupBtn.on('click', function() {
            popup.toggleClass('show');
            $(this).toggleClass('rotate');
        });
    }

    function uploadButton() {
        $('#snapImgUpload').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#snapImgUpload')[0].files[0].name;
            $(this).prev('label').text(file);
        });

        $('#profileImgUpload').change(function() {
            $(this).prev('label').css('color', '#8ebebc');
        });
    }

    function changeTabs() {
        $('.tab-holder .tab:not(:first)').addClass('inactive');
        $('.tabcontent').hide();
        $('.tabcontent:first').show();

        $('.tab-holder .tab').on('click', function() {
            var t = $(this).attr('id');

            if($(this).hasClass('inactive')) {
                $('.tab-holder .tab').addClass('inactive');
                $(this).removeClass('inactive');

                $('.tabcontent').hide();
                $('#' + t + '-content').fadeIn('slow');
            }
        });
    }

    function initOwlSlider() {

        $('.owl-carousel').owlCarousel({
            items: 4,
            loop: false,
            nav: true
        })
    }

    function filterColor() {
        var filterHolder = $('.snap-filter');

        if (filterHolder.length) {
            filterHolder.each(function () {

                var thisHolder = $(this),
                    filter = thisHolder.find('div'),
                    color = filter.attr('class');

                color = color.substr(7);

                thisHolder.css('background-color', color);
            });
        }
    }

    function showMessages() {
        var panelHolder = $('.thread');

        if(panelHolder.length) {
            panelHolder.each(function() {
                var thisHolder = $(this),
                    thisBtn = thisHolder.find('.fa-chevron-down'),
                    thisPanel = thisHolder.find('dd');

                thisPanel.hide();

                thisBtn.on('click', function() {
                    thisPanel.slideToggle('slow');
                    thisBtn.toggleClass('rotate');

                    setTimeout(function() {
                        thisPanel.scrollTop(thisPanel[0].scrollHeight);
                    }, 0);
                });
            })
        }
    }

    function showSnapEdit() {
        var icon = $('.snap-icons .icon-edit');

        if (icon.length) {
            icon.each(function() {
                var thisItem = $(this),
                    overlay = thisItem.parent().siblings('.snap-edit-overlay');

                thisItem.on('click', function(e) {
                    e.preventDefault();
                    overlay.slideDown(300, function() {
                        overlay.children('form').fadeIn(300);
                    });
                })
            })
        }
    }

    function cancelSnapEdit() {
        var icon = $('.snap-edit-overlay .cancel-update-snap');

        if (icon.length) {
            icon.each(function() {
                var thisItem = $(this),
                    overlay = thisItem.parents('.snap-edit-overlay');

                thisItem.on('click', function(e) {
                    e.preventDefault();
                    overlay.children('form').fadeOut(300, function() {
                        overlay.slideUp(300);
                    });
                })
            })
        }
    }

    function activateMessageForm() {
        var button = $('.compose-new-message .button');

        button.on('click', function() {
            button.siblings('.compose-new-message-holder').slideToggle('slow');

            setTimeout(function() {
                window.scrollTo(0, document.body.scrollHeight);
            }, 500);

            if( button.val() === 'Compose New Message' ) {
                button.val('Cancel');
                button.css('background-color', '#b33a3a');
            } else if( button.val() === 'Cancel' ) {
                button.val('Compose New Message');
                button.css('background-color', '#8ebebc');
            }
        });
    }

    function showCommentEdit() {
        var item = $('.activate-edit-comment');

        if (item.length) {
            item.each(function() {
                var thisItem = $(this),
                    commentText = thisItem.attr('data-text'),
                    commentID = thisItem.attr('data-id');

                thisItem.on('click', function(e) {
                    e.preventDefault();
                    thisItem.css({'visibility' : 'hidden', 'opacity' : '0'});
                    thisItem.next('.cancel-edit-comment').css({'visibility' : 'visible', 'opacity' : '1'});
                    $('#commentText').val(commentText);
                    $('.comment-button').attr({onclick : 'updateComment(' + commentID + ');', value : 'Update Comment' });
                });
            });
        }
    }

    function cancelCommentEdit() {
        var item = $('.cancel-edit-comment');

        if (item.length) {
            item.each(function() {
                var thisItem = $(this);

                thisItem.on('click', function(e) {
                    e.preventDefault();
                    thisItem.css({'visibility' : 'hidden', 'opacity' : '0'});
                    thisItem.prev('.activate-edit-comment').css({'visibility' : 'visible', 'opacity' : '1'});
                    $('#commentText').val('');
                    $('.comment-button').attr({onclick : 'comment();', value : 'Comment' });
                });
            });
        }
    }

})(jQuery);

function authRegisterName() {
    var registerName = document.getElementById('name');
    var registerNameRegex = /^[A-ZŠĐČĆŽ][a-zšđčćž]+$/;
    var registerNameLabel = registerName.nextElementSibling;

    if(!registerNameRegex.test(registerName.value)) {
        registerName.style.border = 'solid 1px rgb(179,58,58)';
        registerName.style.boxShadow = '0 0 2px 1px #b33a3a';
        registerNameLabel.style.color = '#b33a3a';
    }  else {
        registerName.style.border = 'solid 1px rgba(0,0,0,0.15)';
        registerName.style.boxShadow = '0 0 2px 1px #8ebebc';
        registerNameLabel.style.color = '#8ebebc';
    }
}

function authRegisterSurname() {
    var registerSurname = document.getElementById('surname');
    var registerSurnameRegex = /^[A-ZŠĐČĆŽ][a-zšđčćž]+$/;
    var RegisterSurnameLabel = registerSurname.nextElementSibling;

    if(!registerSurnameRegex.test(registerSurname.value)) {
        registerSurname.style.border = 'solid 1px rgb(179,58,58)';
        registerSurname.style.boxShadow = '0 0 2px 1px #b33a3a';
        RegisterSurnameLabel.style.color = '#b33a3a';
    }  else {
        registerSurname.style.border = 'solid 1px rgba(0,0,0,0.15)';
        registerSurname.style.boxShadow = '0 0 2px 1px #8ebebc';
        RegisterSurnameLabel.style.color = '#8ebebc';
    }
}

function authRegisterPassword() {
    var registerPassword = document.getElementById('passwordr');
    var registerPasswordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;
    var registerPasswordLabel = registerPassword.nextElementSibling;

    if(!registerPasswordRegex.test(registerPassword.value)) {
        registerPassword.style.border = 'solid 1px rgb(179,58,58)';
        registerPassword.style.boxShadow = '0 0 2px 1px #b33a3a';
        registerPasswordLabel.style.color = '#b33a3a';
    }  else {
        registerPassword.style.border = 'solid 1px rgba(0,0,0,0.15)';
        registerPassword.style.boxShadow = '0 0 2px 1px #8ebebc';
        registerPasswordLabel.style.color = '#8ebebc';
    }
}

function authRegisterPasswordConfirm() {
    var registerPassword = document.getElementById('passwordr');
    var registerPasswordConfirm = document.getElementById('passwordc');

    if(!registerPassword.value.match(registerPasswordConfirm.value)) {
        registerPasswordConfirm.style.border = 'solid 1px rgb(179,58,58)';
        registerPasswordConfirm.style.boxShadow = '0 0 2px 1px #b33a3a';
    }  else {
        registerPasswordConfirm.style.border = 'solid 1px rgba(0,0,0,0.15)';
        registerPasswordConfirm.style.boxShadow = '0 0 2px 1px #8ebebc';
    }
}

function authRegisterUsername() {
    var registerUsername = document.getElementById('usernamer');
    var registerUsernameRegex = /^[a-zA-Z0-9]{3,25}$/;
    var registerUsernameLabel = registerUsername.nextElementSibling;

    if(!registerUsernameRegex.test(registerUsername.value)) {
        registerUsername.style.border = 'solid 1px rgb(179,58,58)';
        registerUsername.style.boxShadow = '0 0 2px 1px #b33a3a';
        registerUsernameLabel.style.color = '#b33a3a';
    }  else {
        registerUsername.style.border = 'solid 1px rgba(0,0,0,0.15)';
        registerUsername.style.boxShadow = '0 0 2px 1px #8ebebc';
        registerUsernameLabel.style.color = '#8ebebc';
    }
}

function authRegisterEmail() {
    var registerEmail = document.getElementById('email');
    var registerEmailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if(!registerEmailRegex.test(registerEmail.value)) {
        registerEmail.style.border = 'solid 1px rgb(179,58,58)';
        registerEmail.style.boxShadow = '0 0 2px 1px #b33a3a';
    }  else {
        registerEmail.style.border = 'solid 1px rgba(0,0,0,0.15)';
        registerEmail.style.boxShadow = '0 0 2px 1px #8ebebc';
    }
}

function shake(thing) {
    var interval = 100;
    var distance = 10;
    var times = 6;

    for (var i = 0; i < (times + 1); i++) {
        $(thing).animate({
            left:
                (i % 2 === 0 ? distance : distance * -1)
        }, interval);
    }
    $(thing).animate({
        left: 0,
        top: 0
    }, interval);
}

function search() {
    var form = $('.form-holder form');
    var search = $('#search-keyword').val();

    if ( search === '' ) {
        shake(form);
    } else {
        form.submit();
    }
}

function cancelUserEdit() {

    var buttonHolder = $('.user-button-holder'),
        cancelButton = $('.user-cancel-button');

    var nameField = $('#user-name'),
        surnameField = $('#user-surname'),
        usernameField = $('#user-username'),
        emailField = $('#user-email'),
        passwordField = $('#user-password'),
        roleField = $('#user-role'),
        birthdayField = $('#user-birthday'),
        cityField = $('#user-city'),
        bioField = $('#user-bio');

    cancelButton.on('click', function() {
        nameField.val('');
        surnameField.val('');
        usernameField.val('');
        emailField.val('');
        passwordField.val('');
        roleField.val('0');
        birthdayField.val('');
        cityField.val('');
        bioField.val('');

        window.scroll(0, 0);

        cancelButton.remove();
        buttonHolder.html('<input type="button" class="button" id="insert-user-button" name="insert-user-button" onclick="insertUser();" value="Insert New User" />');
    });
}

function cancelRoleEdit() {

    var buttonHolder = $('.role-button-holder'),
        cancelButton = $('.role-cancel-button');

    var nameField = $('#role-name');

    cancelButton.on('click', function() {
        nameField.val('');

        window.scroll(0, 0);

        cancelButton.remove();
        buttonHolder.html('<input type="button" class="button" id="insert-role-button" name="insert-role-button" onclick="insertRole();" value="Insert New Role" />');
    });
}

function insertSnap() {

    var image = $('#snap-image').val(),
        user = $('#snap-user').val(),
        filter = $('#snap-filter').val(),
        status = $('#snap-status').val();

    if ( image === '' || user === '0' || filter === '0' || status === '0' ) {
        alert('Some of the information is invalid.');
        return false;
    } else {
        alert('Snap added.');
        return true;
    }
}

function editSnap() {

    var user = $('#snap-user').val(),
        filter = $('#snap-filter').val(),
        status = $('#snap-status').val();

    if ( user === '0' || filter === '0' || status === '0' ) {
        alert('Some of the information is invalid.');
        return false;
    } else {
        alert('Snap updated.');
        return true;
    }
}

function cancelEditSnap() {

    var buttonHolder = $('.snap-button-holder'),
        cancelButton = $('.snap-cancel-button');

    var form = $('#admin-form form');

    var imageField = $('#snap-image'),
        userField = $('#snap-user'),
        filterField = $('#snap-filter'),
        statusField = $('#snap-status'),
        textField = $('#snap-text'),
        hiddenField = $('#snap-id'),
        hiddenImageField = $('#snap-image-id');

    cancelButton.on('click', function() {
        form.attr('action', baseUrl + 'admin-panel/snaps/insert-snap');

        imageField.val('');
        userField.val('0');
        filterField.val('0');
        statusField.val('0');
        textField.val('');
        hiddenField.remove();
        hiddenImageField.remove();

        window.scroll(0, 0);

        cancelButton.remove();
        buttonHolder.html('<input type="button" class="button" id="insert-snap-button" name="insert-snap-button" onclick="insertSnap();" value="Insert New Snap" />');
    });
}

function cancelFilterEdit() {

    var buttonHolder = $('.filter-button-holder'),
        cancelButton = $('.filter-cancel-button');

    var nameField = $('#filter-name'),
        classField = $('#filter-class');

    cancelButton.on('click', function() {
        nameField.val('');
        classField.val('');

        window.scroll(0, 0);

        cancelButton.remove();
        buttonHolder.html('<input type="button" class="button" id="insert-filter-button" name="insert-filter-button" onclick="insertFilter();" value="Insert New Filter" />');
    });
}

function cancelCommentEdit() {

    var commentForm = $('.comment-form'),
        cancelButton = $('.comment-cancel-button');

    var textField = $('#comment-text');

    cancelButton.on('click', function() {
        textField.val('');

        window.scroll(0, 0);

        commentForm.html('');
    });
}
