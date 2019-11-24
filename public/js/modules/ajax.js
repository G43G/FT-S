var sessionID = $('#hidden-user-id').val();

$(document).on('ready', function() {

    if ( sessionID !== '' ) {
        loadMoreAllHomeSnaps();
        getPageLikeDislikeButton();
        loadMoreArchiveSnaps();
        pushUserTooltip();
        activateEditUser();
        activateEditRole();
        pushSnapTooltip();
        activateEditSnap();
        activateEditFilter();
        activateEditComment();
    }

    getPageLikesCount();
    getPageCommentsCount();
    getPageViewsCount();
    loadMorePublicHomeSnaps();
    TABLE.paginate('#admin-body .table', 5);
});

function resetPassword() {

    var emailField = $('#reset-email');
    var email = emailField.val();
    var regMail = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;

    var label = emailField.next('label');

    if(!regMail.test(email)) {
        label.addClass('error-label');
        label.html('E-mail is not in valid format.');
        return;
    }

    $.ajax({
        type: 'POST',
        url: baseUrl + 'reset-password',
        data: {
            _token: token,
            email: email
        },
        success: function() {
            label.removeClass('error-label');
            label.addClass('success-label');
            label.html('Your password has been reset. Please check your mail.')
        }
    });
}

function pushUserTooltip() {

    var tooltip = $('.user-tooltip-link');

    tooltip.tooltip({
        tooltipClass: 'tooltip-custom',
        track: true,
        content: function () {
            return this.getAttribute('title');
        },
        open: function( event, ui ) {
            var id = this.id;
            var split_id = id.split('-');
            var userID = split_id[1];

            $.ajax({
                url: baseUrl + 'admin-panel/users/show-data-' + userID,
                method: 'POST',
                data: {
                    _token: token,
                    id: userID,
                },
                success:function(data){
                    $('#' + id).tooltip('option', 'content', data);
                },
                error: function(errors) {
                    console.log(errors);
                }
            });
        }
    });

    tooltip.on('mouseout', function() {
        $(this).attr('title', 'Please wait...');
        $(this).tooltip();
        $('.ui-tooltip').hide();
    });
}

function pushSnapTooltip() {

    var tooltip = $('.snap-tooltip-link');

    tooltip.tooltip({
        tooltipClass: 'tooltip-custom snap-tooltip',
        track: true,
        content: function () {
            return this.getAttribute('title');
        },
        open: function( event, ui ) {
            var id = this.id;
            var split_id = id.split('-');
            var snapID = split_id[1];

            $.ajax({
                url: baseUrl + 'admin-panel/snaps/show-data-' + snapID,
                method: 'POST',
                data: {
                    _token: token,
                    id: snapID,
                },
                success:function(data){
                    $('#' + id).tooltip('option', 'content', data);
                },
                error: function(errors) {
                    console.log(errors);
                }
            });
        }
    });

    tooltip.on('mouseout', function() {
        $(this).attr('title', 'Please wait...');
        $(this).tooltip();
        $('.ui-tooltip').hide();
    });
}

function loadMoreAllHomeSnaps() {

    $(document).on('click', '#load-more-all-home-snaps-button', function() {
        var id = $(this).data('id');
        $('#load-more-all-home-snaps-form').html('<b>Loading...</b>');

        $.ajax({
            url: baseUrl + 'loadMoreAllHomeSnaps',
            method: 'POST',
            data: {
                _token: token,
                snapID: id
            },
            success:function(data) {
                $('#load-more-all-home-snaps-form').remove();
                $('.load-more-all-home-snaps-form-holder').remove();
                $('#home .container .row').append(data);

                if ( sessionID !== '' ) {
                    getPageLikeDislikeButton();
                }

                getPageLikesCount();
                getPageCommentsCount();
                getPageViewsCount();
            }
        });
    });
}

function loadMorePublicHomeSnaps() {

    $(document).on('click', '#load-more-public-home-snaps-button', function() {
        var id = $(this).data('id');
        $('#load-more-public-home-snaps-form').html('<b>Loading...</b>');

        $.ajax({
            url: baseUrl + 'loadMorePublicHomeSnaps',
            method: 'POST',
            data: {
                _token: token,
                id: id
            },
            success:function(data) {
                $('#load-more-public-home-snaps-form').remove();
                $('.load-more-public-home-snaps-form-holder').remove();
                $('#home .container .row').append(data);

                if ( sessionID !== '' ) {
                    getPageLikeDislikeButton();
                }

                getPageLikesCount();
                getPageCommentsCount();
                getPageViewsCount();
            }
        });
    });
}

function getPageLikeDislikeButton() {
    var holder = $('.item');

    holder.each( function() {
        var snapID = $(this).find('.hidden-snap-id').val();
        var self = $(this);
        var likeHolder = self.find('.snap-like-button-holder');

        $.ajax({
            type: 'GET',
            url: baseUrl + '/getPageLikeDislikeButton',
            data: { id: snapID },
            success: function(data){

                if(data.length) {
                    likeHolder.html('<span class="snap-button-holder"><button class="snap-dislike-button" title="Dislike This Snap" onclick="dislikeFromPage(this, ' + snapID + ');"><i class="icon fa-heart"></i></button></span>');
                } else {
                    likeHolder.html('<span class="snap-button-holder"><button class="snap-like-button" title="Like This Snap" onclick="likeFromPage(this, ' + snapID + ');"><i class="icon fa-heart"></i></button></span>');
                }

            }
        });
    });
}

function getPageLikesCount() {
    var holder = $('.item');

    holder.each( function() {
        var snapID = $(this).find('.hidden-snap-id').val();
        var self = $(this);
        var likeHolder = self.find('.snap-likes-count');

        $.ajax({
            type: 'GET',
            url: baseUrl + '/getPageLikesCount',
            data: { id: snapID },
            success: function(data){

                if ( data === '0' ) {
                    likeHolder.html(data);
                } else {
                    if( sessionID !== '' ) {
                        likeHolder.html('<a href="#" title="Show Likes" onclick="showPageLikeUsers(this, ' + snapID + '); return false;">' + data + '</a>');
                    } else {
                        likeHolder.html('<span>' + data + '</span>');
                    }
                }
            }
        });
    });
}

function getPageCommentsCount() {
    var holder = $('.item');

    holder.each( function() {
        var snapID = $(this).find('.hidden-snap-id').val();
        var self = $(this);
        var commentHolder = self.find('.snap-comments-count');

        $.ajax({
            type: 'GET',
            url: baseUrl + '/getPageCommentsCount',
            data: { id: snapID },
            success: function(data){
                commentHolder.html(data);
            }
        });
    });
}

function getPageViewsCount() {
    var holder = $('.item');

    holder.each( function() {
        var snapID = $(this).find('.hidden-snap-id').val();
        var self = $(this);
        var viewsHolder = self.find('.snap-views-count');

        $.ajax({
            type: 'GET',
            url: baseUrl + '/getPageViewsCount',
            data: { id: snapID },
            success: function(data){
                viewsHolder.html(data);
            }
        });
    });
}

function likeFromPage(thisItem, snapID) {
    var userID = sessionID;

    var self = $(thisItem);
    var likeButton = self.parents('.snap-like-button');
    var buttonHolder = self.parents('.snap-button-holder');

    $.ajax({
        type: 'GET',
        url: baseUrl + '/likeFromPage',
        data: {
            snap: snapID,
            user: userID
        },
        success: function(data) {
            likeButton.remove();
            buttonHolder.html('<button class="snap-dislike-button" title="Dislike This Snap" onclick="dislikeFromPage(this, ' + snapID + ');"><i class="icon fa-heart"></i></button>');
            getPageLikesCount();
        },
        error: function(errors) {
            var content = '<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>' + errors + '</p></div></div></div></div></div>';
            $(content).hide().appendTo('#main').fadeIn(300);
            console.log(errors);
        }
    });
}

function dislikeFromPage(thisItem, snapID) {
    var userID = sessionID;

    var self = $(thisItem);
    var dislikeButton = self.parents('.snap-dislike-button');
    var buttonHolder = self.parents('.snap-button-holder');

    $.ajax({
        type: 'GET',
        url: baseUrl + '/dislikeFromPage',
        data: {
            snap: snapID,
            user: userID
        },
        success: function(data) {
            dislikeButton.remove();
            buttonHolder.html('<button class="snap-like-button" title="Like This Snap" onclick="likeFromPage(this, ' + snapID + ');"><i class="icon fa-heart"></i></button>');
            getPageLikesCount();
        },
        error: function(errors) {
            var content = '<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>' + errors + '</p></div></div></div></div></div>';
            $(content).hide().appendTo('#main').fadeIn(300);
            console.log(errors);
        }
    });
}

function showPageLikeUsers(thisItem, snapID) {
    var userID = sessionID;

    $.ajax({
        type: 'GET',
        url: baseUrl + '/showPageLikeUsers',
        data: { id: snapID },
        success : function(data) {
            var content = '<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="info"><div class="info-title">Likes</div><div class="info-body">';

            for(var i = 0; i < data.length; i++) {

                if( parseInt(data[i].id) === parseInt(userID) ) {
                    content += '<a href="' + baseUrl + 'profile">' + data[i].username + '</a>';
                } else {
                    content += '<a href="' + baseUrl + data[i].username + '">' + data[i].username + '</a>';
                }
            }

            content += '</div></div></div></div></div></div>';

            $(content).hide().appendTo('#main').fadeIn(300);
        },
        error: function(errors) {
            var content = '<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>' + errors + '</p></div></div></div></div></div>';
            $(content).hide().appendTo('#main').fadeIn(300);
            console.log(errors);
        }
    });
}

function getSnapLikesCount() {
    var snapID = document.getElementById('hidden-snap-id').value;

    $.ajax({
        type: 'GET',
        url: baseUrl + 'snap/' + snapID + '/getSnapLikesCount',
        data: { id: snapID },
        success : function(data) {

            if( parseInt(data) === 0 ) {
                $('.snap-likes-count').html(data);
            } else {
                $('.snap-likes-count').html('<a href="#" title="Show Likes" onclick="showLikeUsers(); return false;">' + data + '</a>');
            }

        },
        error: function(errors) {
            var content = '<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>' + errors + '</p></div></div></div></div></div>';
            $(content).hide().appendTo('#main').fadeIn(300);
            console.log(errors);
        }
    });
}

function getSnapCommentsCount() {
    var snapID = document.getElementById('hidden-snap-id').value;

    $.ajax({
        type: 'GET',
        url: baseUrl + 'snap/' + snapID + '/getSnapCommentsCount',
        data: { id: snapID },
        success: function(data) {
            $('.snap-comments-count').html(data);
        },
        error: function(errors) {
            $('#main').append('<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>' + errors + '</p></div></div></div></div></div>');
            console.log(errors);
        }
    });
}

function likeSnap() {
    var snap = document.getElementById('hidden-snap-id').value;
    var user = document.getElementById('hidden-user-id').value;

    $.ajax({
        type: 'GET',
        url: baseUrl + 'snap/' + snap + '/like',
        data: {
            snap: snap,
            user: user
        },
        success: function(data) {
            $('.snap-like-button').remove();
            $('.snap-button-holder').html('<button class="snap-dislike-button" title="Dislike This Snap" onclick="dislikeSnap();"><i class="icon fa-heart"></i></button>');
            getSnapLikesCount();
        },
        error: function(errors) {
            var content = '<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>' + errors + '</p></div></div></div></div></div>';
            $(content).hide().appendTo('#main').fadeIn(300);
            console.log(errors);
        }
    });
}

function dislikeSnap() {
    var snap = document.getElementById('hidden-snap-id').value;
    var user = document.getElementById('hidden-user-id').value;

    $.ajax({
        type: 'GET',
        url: baseUrl + 'snap/' + snap + '/dislike',
        data: {
            _token: token,
            snap: snap,
            user: user
        },
        success: function(data) {
            $('.snap-dislike-button').remove();
            $('.snap-button-holder').html('<button class="snap-like-button" title="Like This Snap" onclick="likeSnap();"><i class="icon fa-heart"></i></button>');
            getSnapLikesCount();
        },
        error: function(errors) {
            var content = '<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>' + errors + '</p></div></div></div></div></div>';
            $(content).hide().appendTo('#main').fadeIn(300);
            console.log(errors);
        }
    });
}

function showLikeUsers() {
    var snapID = document.getElementById('hidden-snap-id').value;
    var userID = document.getElementById('hidden-user-id').value;

    $.ajax({
        type: 'GET',
        url: baseUrl + 'snap/' + snapID + '/showLikeUsers',
        data: { id: snapID },
        success : function(data) {
            var content = '<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="info"><div class="info-title">Likes</div><div class="info-body">';

            for(var i = 0; i < data.length; i++) {

                if( parseInt(data[i].id) === parseInt(userID) ) {
                    content += '<a href="' + baseUrl + 'profile">' + data[i].username + '</a>';
                } else {
                    content += '<a href="' + baseUrl + data[i].username + '">' + data[i].username + '</a>';
                }
            }

            content += '</div></div></div></div></div></div>';

            $(content).hide().appendTo('#main').fadeIn(300);
        },
        error: function(errors) {
            var content = '<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>' + errors + '</p></div></div></div></div></div>';
            $(content).hide().appendTo('#main').fadeIn(300);
            console.log(errors);
        }
    });
}

function comment() {
    var text = document.getElementById('commentText').value;
    var snap = document.getElementById('hidden-snap-id').value;
    var user = document.getElementById('hidden-user-id').value;

    if ( text === '' ) {
        shake($('#commentText'));
        return;
    }

    $.ajax({
        type: 'POST',
        url: baseUrl + 'snap/' + snap + '/comment',
        data: {
            _token: token,
            text: text,
            snap: snap,
            user: user
        },
        success: function(data) {
            getComments();
            getSnapCommentsCount();
            $('#commentText').val('');
        },
        error: function(errors) {
            var content = '<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>' + errors + '</p></div></div></div></div></div>';
            $(content).hide().appendTo('#main').fadeIn(300);
            console.log(errors);
        }
    });
}

function updateComment(commentID) {
    var text = document.getElementById('commentText').value;
    var snap = document.getElementById('hidden-snap-id').value;

    if ( text === '' || text === text.defaultValue ) {
        shake($('#commentText'));
        return;
    }

    $.ajax({
        type: 'POST',
        url: baseUrl + 'snap/' + snap + '/updateComment/' + commentID,
        data: {
            _token: token,
            text: text
        },
        success: function(data) {
            getComments();
            $('#commentText').val('');
            $('.comment-button').attr({onclick : 'comment();', value : 'Comment' });
        },
        error: function(errors) {
            var content = '<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>' + errors + '</p></div></div></div></div></div>';
            $(content).hide().appendTo('#main').fadeIn(300);
            console.log(errors);
        }
    });
}

function removeComment(commentID) {
    var snap = document.getElementById('hidden-snap-id').value;

    $.ajax({
        type: 'GET',
        url: baseUrl + 'snap/' + snap + '/removeComment/' + commentID,
        success: function(data) {
            getComments();
            getSnapCommentsCount();
        },
        error: function(errors) {
            var content = '<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>' + errors + '</p></div></div></div></div></div>';
            $(content).hide().appendTo('#main').fadeIn(300);
            console.log(errors);
        }
    });
}

function getComments() {
    var snap = document.getElementById('hidden-snap-id').value;
    var user = document.getElementById('hidden-user-id').value;

    $.ajax({
        type: 'GET',
        url: baseUrl + 'snap/' + snap + '/getComments',
        success: function(data) {
            var content = '';

            if(data.length) {
                for (var i = 0; i < data.length; i++) {

                    var commentDate = data[i].commentDate;
                    var commentNewDate = data[i].commentNewDate;

                    var newCommentDate = moment(commentDate).format('DD-MMM-YYYY | HH:mm');
                    var newCommentNewDate = moment(commentNewDate).format('DD-MMM-YYYY | HH:mm');

                    var date = (commentNewDate === null) ? newCommentDate : newCommentNewDate + ' (updated)';

                    content += '<div class="comment-holder">' +
                        '<div class="comment-image-holder">' +
                        '<a href="' + baseUrl + data[i].username + '">' +
                        '<img src="' + baseUrl + data[i].thumb_path + '" alt="comment-user-thumbnail-image" class="comment-image"/>' +
                        '</a>' +
                        '</div>' +
                        '<div class="comment-content-holder">' +
                        '<span class="user-comment-date">' + data[i].username + ' @ ' + date + '</span>' +
                        '<span class="user-comment-text">' + data[i].text + '</span>';
                    if (parseInt(user) === parseInt(data[i].user)) {
                        content += '<span class="user-comment-edit">' +
                            '<a href="#" data-id="' + data[i].commentID + '" data-text="' + data[i].text + '" style="visibility: visible; opacity: 1;" class="activate-edit-comment"><i class="icon fa-edit"></i></a>' +
                            '<a href="#" title="Cancel Comment Edit" style="visibility: hidden; opacity: 0;" class="cancel-edit-comment"><i class="icon fa-ban"></i></a>' +
                            '</span>' +
                            '<span class="user-comment-delete">' +
                            '<a href="#" title="Delete Comment" onclick="removeComment(' + data[i].commentID + '); return false;"><i class="icon fa-trash"></i></a>' +
                            '</span>'
                    }
                    content += '</div>' +
                        '</div>'
                }
            }
            else {
                content += '<div class="comment-notice"><h1>There are currently no comments on this snap.<br/> Be first to comment something.</h1></div>'
            }
            $('.snap-comments').html(content);
        },
        error: function(errors) {
            $('#main').append('<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>' + errors + '</p></div></div></div></div></div>');
            console.log(errors);
        }
    });
}

function updateSnap(thisItem, snapID) {
    var text = document.getElementById('updateSnapText-' + snapID).value;
    var statuses = document.getElementsByName('updateSnapStatus-' + snapID);

    for (var i = 0, length = statuses.length; i < length; i++) {
        if (statuses[i].checked) {
            var status = statuses[i].value;
            break;
        }
    }

    var overlay = $(thisItem.parentNode.parentNode.parentNode.parentNode);
    var form = overlay.find('form');
    var iconHolder = overlay.siblings('.snap-privacy');
    var icon = iconHolder.children('.icon');
    var textHolder = overlay.siblings('.snap-text');

    $.ajax({
        type: 'GET',
        url: baseUrl + 'profile/updateSnap/' + snapID,
        data: {
            _token: token,
            text: text,
            status: status
        },
        success: function(data) {
            var content = '<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="info"><div class="info-body">';

            content += '<div class="success"><i class="fa fa-check-circle"></i><p>Snap successfully updated.</p></div>';

            content += '</div></div></div></div></div></div>';

            $(content).hide().appendTo('#main').fadeIn(300);

            if (status === 'public') {
                icon.remove();
                iconHolder.append('<i class="icon fa-globe"></i>')
            } else {
                icon.remove();
                iconHolder.append('<i class="icon fa-lock"></i>');
            }

            textHolder.html('<h3>' + text.substr(0, 35) + '</h3>');

            form.fadeOut(300, function() {
                overlay.slideUp(300);
            });
        },
        error: function(errors) {
            var content = '<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>' + errors + '</p></div></div></div></div></div>';
            $(content).hide().appendTo('#main').fadeIn(300);
            console.log(errors);
        }
    });
}

function replyMessage(thisItem, threadID) {
    var sender = document.getElementById('hidden-user-username').value;
    var viewer = '0';

    var self = $(thisItem),
        parent = self.parents('.thread'),
        holder = parent.find('dd:first-of-type');

    var textHolder = self.siblings('#message-reply-' + threadID),
        textValue = textHolder.val();

    if ( textValue === '' ) {
        textHolder.css({'border' : '1px solid #b33a3a', 'box-shadow' : '0 0 5px #b33a3a'});
        return;
    }

    var date = new Date(),
        newDate = moment(date).format('DD-MMM-YYYY | HH:mm');

    $.ajax({
        type: 'POST',
        url: baseUrl + 'profile/replyMessage/' + threadID,
        data: {
            _token: token,
            text: textValue,
            sender: sender,
            viewer: viewer
        },
        success: function() {
            holder.append('<div class="message-left"><span class="message-sender">' + sender + ' @ ' + newDate + '</span><span class="message-text">' + textValue + '</span></div>');
            holder.scrollTop(holder[0].scrollHeight);
            textHolder.css({'border' : '1px solid rgba(0,0,0,0.15)', 'box-shadow' : 'inset 0 0.1em 0.1em 0 rgba(0,0,0,0.05)'});
            textHolder.val('');
        },
        error: function(errors) {
            var content = '<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>' + errors + '</p></div></div></div></div></div>';
            $(content).hide().appendTo('#main').fadeIn(300);
        }
    });
}

function loadMoreArchiveSnaps() {

    var path = window.location.href;
    var archiveDate = path.substr(path.lastIndexOf('/') + 1);

    $(document).on('click', '#load-more-archive-snaps-button', function() {
        var id = $(this).data('id');

        $('#load-more-archive-snaps-form').html('<b>Loading...</b>');

        $.ajax({
            url: baseUrl + 'archive/' + archiveDate + '/loadMoreArchiveSnaps',
            method: 'POST',
            data: {
                _token: token,
                id: id
            },
            success:function(data) {
                $('#load-more-archive-snaps-form').remove();
                $('.load-more-archive-snaps-form-holder').remove();
                $('#archive .container .row').append(data);

                if ( sessionID !== '' ) {
                    getPageLikeDislikeButton();
                }

                getPageLikesCount();
                getPageCommentsCount();
                getPageViewsCount();
            }
        });
    });
}

function activateEditUser() {

    var editButton = $('.user-edit');

    var buttonHolder = $('.user-button-holder'),
        button = $('#user-button');

    editButton.on('click', function(e) {
        e.preventDefault();
        var userID = $(this).data('id');

        $.ajax({
            url: baseUrl + 'admin-panel/users/activate-edit-user-' + userID,
            method: 'POST',
            data: {
                _token: token,
                id: userID
            },
            success: function(data) {
                var name = data[0].name,
                    surname = data[0].surname,
                    username = data[0].username,
                    email = data[0].email,
                    password = data[0].password,
                    role = data[0].role,
                    birthday = data[0].birthday,
                    city = data[0].city,
                    bio = data[0].bio;

                $('#user-name').val(name);
                $('#user-surname').val(surname);
                $('#user-username').val(username);
                $('#user-email').val(email);
                $('#user-password').val(password);
                $('#user-role').val(role);
                $('#user-birthday').val(birthday);
                $('#user-city').val(city);
                $('#user-bio').val(bio);

                button.remove();
                buttonHolder.html('<input type="button" class="button" id="edit-user-button" name="edit-user-button" onclick="editUser(' + userID + ');" value="Save Changes" /><input type="button" class="button user-cancel-button cancel-button" value="Cancel" />');

                cancelUserEdit();
            }
        });
    });
}

function editUser(userID) {

    var name = $('#user-name').val(),
        surname = $('#user-surname').val(),
        username = $('#user-username').val(),
        email = $('#user-email').val(),
        password = $('#user-password').val(),
        role = $('#user-role').val(),
        birthday = $('#user-birthday').val(),
        city = $('#user-city').val(),
        bio = $('#user-bio').val();

    if ( name === '' || surname === '' || username === '' || email === '' || role === '0' ) {
        alert('Some of the information is invalid.');
        return;
    }

    $.ajax({
        type: 'POST',
        url: baseUrl + '/admin-panel/users/edit-user-' + userID,
        data: {
            _token: token,
            name: name,
            surname: surname,
            username: username,
            email: email,
            password: password,
            role: role,
            birthday: birthday,
            city: city,
            bio: bio
        },
        success: function() {
            alert('User information updated.');
            location.reload();
        },
        error: function(errors) {
            alert(errors);
            console.log(errors);
        }
    });
}

function insertUser() {

    var name = $('#user-name').val(),
        surname = $('#user-surname').val(),
        username = $('#user-username').val(),
        email = $('#user-email').val(),
        password = $('#user-password').val(),
        role = $('#user-role').val(),
        birthday = $('#user-birthday').val(),
        city = $('#user-city').val(),
        bio = $('#user-bio').val();

    if ( name === '' || surname === '' || username === '' || email === '' || role === '0' ) {
        alert('Some of the information is invalid.');
        return;
    }

    $.ajax({
        type: 'POST',
        url: baseUrl + '/admin-panel/users/insert-user',
        data: {
            _token: token,
            name: name,
            surname: surname,
            username: username,
            email: email,
            password: password,
            role: role,
            birthday: birthday,
            city: city,
            bio: bio
        },
        success: function() {
            alert('User added.');
            location.reload();
        },
        error: function(errors) {
            alert(errors);
            console.log(errors);
        }
    });
}

function activateEditRole() {

    var editButton = $('.role-edit');

    var buttonHolder = $('.role-button-holder'),
        button = $('#role-button');

    editButton.on('click', function(e) {
        e.preventDefault();
        var roleID = $(this).data('id');

        $.ajax({
            url: baseUrl + 'admin-panel/roles/activate-edit-role-' + roleID,
            method: 'POST',
            data: {
                _token: token,
                id: roleID
            },
            success: function(data) {
                var name = data[0].name;

                $('#role-name').val(name);

                button.remove();
                buttonHolder.html('<input type="button" class="button" id="edit-role-button" name="edit-role-button" onclick="editRole(' + roleID + ');" value="Save Changes" /><input type="button" class="button role-cancel-button cancel-button" value="Cancel" />');

                cancelRoleEdit();
            }
        });
    });
}

function editRole(roleID) {

    var name = $('#role-name').val();

    if ( name === '' ) {
        alert('Information is invalid.');
        return;
    }

    $.ajax({
        type: 'POST',
        url: baseUrl + '/admin-panel/roles/edit-role-' + roleID,
        data: {
            _token: token,
            name: name
        },
        success: function() {
            alert('Role updated.');
            location.reload();
        },
        error: function(errors) {
            alert(errors);
            console.log(errors);
        }
    });
}

function insertRole() {

    var name = $('#role-name').val();

    if ( name === '' ) {
        alert('Information is invalid.');
        return;
    }

    $.ajax({
        type: 'POST',
        url: baseUrl + '/admin-panel/roles/insert-role',
        data: {
            _token: token,
            name: name
        },
        success: function() {
            alert('Role added.');
            location.reload();
        },
        error: function(errors) {
            alert(errors);
            console.log(errors);
        }
    });
}

function activateEditSnap() {

    var editButton = $('.snap-edit');

    var buttonHolder = $('.snap-button-holder'),
        button = $('#snap-button');

    var form = $('#admin-form').find('form');

    editButton.on('click', function(e) {
        e.preventDefault();
        var snapID = $(this).data('id');

        $.ajax({
            url: baseUrl + 'admin-panel/snaps/activate-edit-snap-' + snapID,
            method: 'POST',
            data: {
                _token: token,
                id: snapID
            },
            success: function(data) {
                var user = data[0].user,
                    filter = data[0].filter,
                    status = data[0].status,
                    text = data[0].text,
                    imageID = data[0].imageID;

                $('#snap-user').val(user);
                $('#snap-filter').val(filter);
                $('#snap-status').val(status);
                $('#snap-text').val(text);

                form.attr('action', baseUrl + 'admin-panel/snaps/edit-snap');

                var hiddenID = $('#snap-id'),
                    hiddenImageID = $('#snap-image-id');

                if( hiddenID.length && hiddenImageID.length ) {
                    hiddenID.remove();
                    hiddenImageID.remove();
                    form.append('<input type="hidden" id="snap-id" name="snap-id" value="' + snapID + '" /><input type="hidden" id="snap-image-id" name="snap-image-id" value="' + imageID + '" />');
                } else {
                    form.append('<input type="hidden" id="snap-id" name="snap-id" value="' + snapID + '" /><input type="hidden" id="snap-image-id" name="snap-image-id" value="' + imageID + '" />');
                }

                button.remove();
                buttonHolder.html('<input type="submit" class="button" id="edit-snap-button" name="edit-snap-button" onclick="return editSnap();" value="Save Changes" /><input type="button" class="button snap-cancel-button cancel-button" value="Cancel" />');

                cancelEditSnap();
            }
        });
    });
}

function activateEditFilter() {

    var editButton = $('.filter-edit');

    var buttonHolder = $('.filter-button-holder'),
        button = $('#filter-button');

    editButton.on('click', function(e) {
        e.preventDefault();
        var filterID = $(this).data('id');

        $.ajax({
            url: baseUrl + 'admin-panel/filters/activate-edit-filter-' + filterID,
            method: 'POST',
            data: {
                _token: token,
                id: filterID
            },
            success: function(data) {
                var name = data[0].name,
                    fclass = data[0].class;

                $('#filter-name').val(name);
                $('#filter-class').val(fclass);

                button.remove();
                buttonHolder.html('<input type="button" class="button" id="edit-filter-button" name="edit-filter-button" onclick="editFilter(' + filterID + ');" value="Save Changes" /><input type="button" class="button filter-cancel-button cancel-button" value="Cancel" />');

                cancelFilterEdit();
            }
        });
    });
}

function editFilter(filterID) {

    var name = $('#filter-name').val(),
        fclass = $('#filter-class').val();

    if ( name === '' || fclass === '' ) {
        alert('Some of the information is invalid.');
        return;
    }

    $.ajax({
        type: 'POST',
        url: baseUrl + '/admin-panel/filters/edit-filter-' + filterID,
        data: {
            _token: token,
            name: name,
            fclass: fclass
        },
        success: function() {
            alert('Filter updated.');
            location.reload();
        },
        error: function(errors) {
            alert(errors);
            console.log(errors);
        }
    });
}

function insertFilter() {

    var name = $('#filter-name').val(),
        fclass = $('#filter-class').val();

    if ( name === '' || fclass === '' ) {
        alert('Some of the information is invalid.');
        return;
    }

    $.ajax({
        type: 'POST',
        url: baseUrl + '/admin-panel/filters/insert-filter',
        data: {
            _token: token,
            name: name,
            fclass: fclass
        },
        success: function() {
            alert('Filter added.');
            location.reload();
        },
        error: function(errors) {
            alert(errors);
            console.log(errors);
        }
    });
}

function activateEditComment() {

    var editButton = $('.comment-edit');

    var commentForm = $('.comment-form');

    editButton.on('click', function(e) {
        e.preventDefault();
        var commentID = $(this).data('id');

        $.ajax({
            url: baseUrl + 'admin-panel/comments/activate-edit-comment-' + commentID,
            method: 'POST',
            data: {
                _token: token,
                id: commentID
            },
            success: function(data) {
                var text = data[0].text;

                commentForm.html('<form method="POST">' +
                    '<div class="row">' +
                    '<div class="12u">' +
                    '<input type="text" value="' + text + '" id="comment-text" name="comment-text" placeholder="Comment" />' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="12u comment-button-holder button-holder">' +
                    '<input type="button" class="button" id="edit-comment-button" name="edit-comment-button" onclick="editComment(' + commentID + ');" value="Save Changes" /><input type="button" class="button comment-cancel-button cancel-button" value="Cancel" />' +
                    '</div>' +
                    '</div>' +
                    '</form>');

                cancelCommentEdit();
            }
        });
    });
}

function editComment(commentID) {

    var text = $('#comment-text').val();

    if ( text === '' ) {
        alert('Information is invalid.');
        return;
    }

    $.ajax({
        type: 'POST',
        url: baseUrl + 'admin-panel/comments/edit-comment-' + commentID,
        data: {
            _token: token,
            text: text
        },
        success: function() {
            alert('Comment updated.');
            location.reload();
        },
        error: function(errors) {
            alert(errors);
            console.log(errors);
        }
    });
}

function redirect() {

    var url = window.location.href;
    var snapID = url.substring(url.lastIndexOf('/') + 1);

    $.ajax({
        type: 'GET',
        url: baseUrl + 'redirect',
        data: {
            snapID: snapID
        },
        success: function() {
            window.location.href = baseUrl;
        },
        error: function(errors) {
            alert(errors);
            console.log(errors);
        }
    });
}

var TABLE = {};

TABLE.paginate = function(table, pageLength){
    var $table = $(table);
    var $rows = $table.find('tbody > tr');
    var numPages = Math.ceil($rows.length / pageLength) - 1;
    var current = 0;

    var $nav = $table.parents('.table-wrapper').find('.wrapper-paging ul');
    var $back = $nav.find('li:first-child a');
    var $next = $nav.find('li:last-child a');

    $nav.find('a.paging-this strong').text(current + 1);
    $nav.find('a.paging-this span').text(numPages + 1);
    $back.addClass('paging-disabled').click(function(){
        pagination('<');
    });

    $next.click(function(){
        pagination('>');
    });

    $rows.hide().slice(0,pageLength).show();

    pagination = function(direction){
        reveal = function(current){
            $back.removeClass('paging-disabled');
            $next.removeClass('paging-disabled');
            $rows.hide().slice(current * pageLength, current * pageLength + pageLength).show();
            $nav.find('a.paging-this strong').text(current + 1);
        };

        if(direction === '<'){
            if(current > 1){
                reveal(current -= 1);
            }
            else if(current === 1){
                reveal (current -= 1);
                $back.addClass('paging-disabled');
            }
        }
        else{
            if(current < numPages - 1){
                reveal(current += 1);
            }
            else if(current === numPages - 1){
                reveal(current += 1);
                $next.addClass('paging-disabled');
            }
        }
    };
};


