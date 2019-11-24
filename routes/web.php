<?php

Route::group(['middleware' => 'checkUser'], function() {

    Route::post('/loadMoreAllHomeSnaps', 'SnapController@loadMoreAllHomeSnaps');


    Route::get('/logout', 'AuthController@logout')->name('logout');


    Route::get('/profile', 'FrontEndController@getProfile');

    Route::post('/profile/uploadImage', 'ProfileController@uploadImage');

    Route::get('/profile/deleteImage/{imageId}', 'ProfileController@deleteImage');

    Route::post('/profile/addSnap', 'SnapController@addSnap');

    Route::get('/profile/updateSnap/{snapID}', 'SnapController@updateSnap');

    Route::get('/profile/removeSnap/{snapID}', 'SnapController@removeSnap');

    Route::post('/profile/sendMessage', 'MessageController@composeNewMessage');

    Route::post('/profile/replyMessage/{threadID}', 'MessageController@replyMessage');

    Route::get('/profile/deleteMessage/{threadID}', 'MessageController@deleteMessage');

    Route::post('/profile/editProfile', 'ProfileController@editProfile');


    Route::get('/getPageLikeDislikeButton', 'LikeController@getLikeDislikeButton');

    Route::get('/likeFromPage', 'LikeController@like');

    Route::get('/dislikeFromPage', 'LikeController@dislike');


    Route::get('/archive/{archiveDate}', 'FrontEndController@getArchive');

    Route::post('/archive/{archiveDate}/loadMoreArchiveSnaps', 'SnapController@loadMoreArchiveSnaps');

});

Route::group(['middleware' => 'checkAdmin'], function() {

    Route::get('/admin-panel/users', 'FrontEndController@getAdminUsers');

    Route::post('/admin-panel/users/show-data-{userID}', 'UserController@showUserData');

    Route::post('/admin-panel/users/activate-edit-user-{userID}', 'UserController@activateEditUser');

    Route::post('/admin-panel/users/edit-user-{userID}', 'UserController@editUser');

    Route::post('/admin-panel/users/insert-user', 'UserController@insertUser');

    Route::get('/admin-panel/users/delete-user-{userID}', 'UserController@deleteUser');


    Route::get('/admin-panel/roles', 'FrontEndController@getAdminRoles');

    Route::post('/admin-panel/roles/activate-edit-role-{roleID}', 'RoleController@activateEditRole');

    Route::post('/admin-panel/roles/edit-role-{roleID}', 'RoleController@editRole');

    Route::post('/admin-panel/roles/insert-role', 'RoleController@insertRole');

    Route::get('/admin-panel/roles/delete-role-{roleID}', 'RoleController@deleteRole');


    Route::get('/admin-panel/snaps', 'FrontEndController@getAdminSnaps');

    Route::post('/admin-panel/snaps/show-data-{snapID}', 'SnapController@showSnapData');

    Route::post('/admin-panel/snaps/activate-edit-snap-{snapID}', 'SnapController@activateEditSnap');

    Route::post('/admin-panel/snaps/edit-snap', 'SnapController@editSnap');

    Route::post('/admin-panel/snaps/insert-snap', 'SnapController@insertSnap');

    Route::get('/admin-panel/snaps/delete-snap-{snapID}', 'SnapController@deleteSnap');


    Route::get('/admin-panel/filters', 'FrontEndController@getAdminFilters');

    Route::post('/admin-panel/filters/activate-edit-filter-{filterID}', 'FilterController@activateEditFilter');

    Route::post('/admin-panel/filters/edit-filter-{filterID}', 'FilterController@editFilter');

    Route::post('/admin-panel/filters/insert-filter', 'FilterController@insertFilter');

    Route::get('/admin-panel/filters/delete-filter-{filterID}', 'FilterController@deleteFilter');


    Route::get('admin-panel/comments', 'FrontEndController@getAdminComments');

    Route::post('/admin-panel/comments/activate-edit-comment-{commentID}', 'CommentController@activateEditComment');

    Route::post('/admin-panel/comments/edit-comment-{commentID}', 'CommentController@editComment');

    Route::get('/admin-panel/comments/delete-comment-{commentID}', 'CommentController@deleteComment');
});

Route::get('/', 'FrontEndController@getHome');

Route::post('/loadMorePublicHomeSnaps', 'SnapController@loadMorePublicHomeSnaps');


Route::get('/discover', 'FrontEndController@getDiscover');

Route::post('/results', 'FrontEndController@getResults');


Route::get('/auth', 'FrontEndController@getAuth');

Route::post('/register', 'AuthController@register')->name('register');

Route::post('/login', 'AuthController@login')->name('login');

Route::post('/reset-password', 'AuthController@resetPassword');

Route::post('/about/send-mail', 'AuthController@sendMail');


Route::get('/about', 'FrontEndController@getAbout');

Route::get('/about/download', 'FrontEndController@download');


Route::get('/snap/{snapID}', 'FrontEndController@getSnap');

Route::get('/snap/{snapID}/like', 'LikeController@like');

Route::get('/snap/{snapID}/dislike', 'LikeController@dislike');

Route::get('/snap/{snapID}/getSnapLikesCount', 'LikeController@getLikesCount');

Route::get('/snap/{snapID}/showLikeUsers', 'LikeController@showLikeUsers');

Route::post('/snap/{snapID}/comment', 'CommentController@comment');

Route::get('/snap/{snapID}/getComments', 'CommentController@getComments');

Route::get('/snap/{snapID}/getSnapCommentsCount', 'CommentController@getCommentsCount');

Route::post('/snap/{snapID}/updateComment/{commentID}', 'CommentController@updateComment');

Route::get('/snap/{snapID}/removeComment/{commentID}', 'CommentController@removeComment');


Route::get('/getPageLikesCount', 'LikeController@getLikesCount');

Route::get('/getPageCommentsCount', 'CommentController@getCommentsCount');

Route::get('/showPageLikeUsers', 'LikeController@showLikeUsers');

Route::get('/getPageViewsCount', 'SnapController@getViewsCount');


Route::get('/redirect', 'SnapController@redirect');


Route::get('/{username}', 'FrontEndController@getUser');

Route::post('/{username}/send', 'MessageController@sendMessage');








































