var sessionID=$("#hidden-user-id").val();function resetPassword(){var e=$("#reset-email"),t=e.val(),a=e.next("label");if(!/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/.test(t))return a.addClass("error-label"),void a.html("E-mail is not in valid format.");$.ajax({type:"POST",url:baseUrl+"reset-password",data:{_token:token,email:t},success:function(){a.removeClass("error-label"),a.addClass("success-label"),a.html("Your password has been reset. Please check your mail.")}})}function pushUserTooltip(){var e=$(".user-tooltip-link");e.tooltip({tooltipClass:"tooltip-custom",track:!0,content:function(){return this.getAttribute("title")},open:function(e,t){var a=this.id,n=a.split("-")[1];$.ajax({url:baseUrl+"admin-panel/users/show-data-"+n,method:"POST",data:{_token:token,id:n},success:function(e){$("#"+a).tooltip("option","content",e)},error:function(e){console.log(e)}})}}),e.on("mouseout",function(){$(this).attr("title","Please wait..."),$(this).tooltip(),$(".ui-tooltip").hide()})}function pushSnapTooltip(){var e=$(".snap-tooltip-link");e.tooltip({tooltipClass:"tooltip-custom snap-tooltip",track:!0,content:function(){return this.getAttribute("title")},open:function(e,t){var a=this.id,n=a.split("-")[1];$.ajax({url:baseUrl+"admin-panel/snaps/show-data-"+n,method:"POST",data:{_token:token,id:n},success:function(e){$("#"+a).tooltip("option","content",e)},error:function(e){console.log(e)}})}}),e.on("mouseout",function(){$(this).attr("title","Please wait..."),$(this).tooltip(),$(".ui-tooltip").hide()})}function loadMoreAllHomeSnaps(){$(document).on("click","#load-more-all-home-snaps-button",function(){var e=$(this).data("id");$("#load-more-all-home-snaps-form").html("<b>Loading...</b>"),$.ajax({url:baseUrl+"loadMoreAllHomeSnaps",method:"POST",data:{_token:token,snapID:e},success:function(e){$("#load-more-all-home-snaps-form").remove(),$(".load-more-all-home-snaps-form-holder").remove(),$("#home .container .row").append(e),""!==sessionID&&getPageLikeDislikeButton(),getPageLikesCount(),getPageCommentsCount(),getPageViewsCount()}})})}function loadMorePublicHomeSnaps(){$(document).on("click","#load-more-public-home-snaps-button",function(){var e=$(this).data("id");$("#load-more-public-home-snaps-form").html("<b>Loading...</b>"),$.ajax({url:baseUrl+"loadMorePublicHomeSnaps",method:"POST",data:{_token:token,id:e},success:function(e){$("#load-more-public-home-snaps-form").remove(),$(".load-more-public-home-snaps-form-holder").remove(),$("#home .container .row").append(e),""!==sessionID&&getPageLikeDislikeButton(),getPageLikesCount(),getPageCommentsCount(),getPageViewsCount()}})})}function getPageLikeDislikeButton(){$(".item").each(function(){var t=$(this).find(".hidden-snap-id").val(),a=$(this).find(".snap-like-button-holder");$.ajax({type:"GET",url:baseUrl+"/getPageLikeDislikeButton",data:{id:t},success:function(e){e.length?a.html('<span class="snap-button-holder"><button class="snap-dislike-button" title="Dislike This Snap" onclick="dislikeFromPage(this, '+t+');"><i class="icon fa-heart"></i></button></span>'):a.html('<span class="snap-button-holder"><button class="snap-like-button" title="Like This Snap" onclick="likeFromPage(this, '+t+');"><i class="icon fa-heart"></i></button></span>')}})})}function getPageLikesCount(){$(".item").each(function(){var t=$(this).find(".hidden-snap-id").val(),a=$(this).find(".snap-likes-count");$.ajax({type:"GET",url:baseUrl+"/getPageLikesCount",data:{id:t},success:function(e){"0"===e?a.html(e):""!==sessionID?a.html('<a href="#" title="Show Likes" onclick="showPageLikeUsers(this, '+t+'); return false;">'+e+"</a>"):a.html("<span>"+e+"</span>")}})})}function getPageCommentsCount(){$(".item").each(function(){var e=$(this).find(".hidden-snap-id").val(),t=$(this).find(".snap-comments-count");$.ajax({type:"GET",url:baseUrl+"/getPageCommentsCount",data:{id:e},success:function(e){t.html(e)}})})}function getPageViewsCount(){$(".item").each(function(){var e=$(this).find(".hidden-snap-id").val(),t=$(this).find(".snap-views-count");$.ajax({type:"GET",url:baseUrl+"/getPageViewsCount",data:{id:e},success:function(e){t.html(e)}})})}function likeFromPage(e,t){var a=sessionID,n=$(e),i=n.parents(".snap-like-button"),s=n.parents(".snap-button-holder");$.ajax({type:"GET",url:baseUrl+"/likeFromPage",data:{snap:t,user:a},success:function(e){i.remove(),s.html('<button class="snap-dislike-button" title="Dislike This Snap" onclick="dislikeFromPage(this, '+t+');"><i class="icon fa-heart"></i></button>'),getPageLikesCount()},error:function(e){$('<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>'+e+"</p></div></div></div></div></div>").hide().appendTo("#main").fadeIn(300),console.log(e)}})}function dislikeFromPage(e,t){var a=sessionID,n=$(e),i=n.parents(".snap-dislike-button"),s=n.parents(".snap-button-holder");$.ajax({type:"GET",url:baseUrl+"/dislikeFromPage",data:{snap:t,user:a},success:function(e){i.remove(),s.html('<button class="snap-like-button" title="Like This Snap" onclick="likeFromPage(this, '+t+');"><i class="icon fa-heart"></i></button>'),getPageLikesCount()},error:function(e){$('<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>'+e+"</p></div></div></div></div></div>").hide().appendTo("#main").fadeIn(300),console.log(e)}})}function showPageLikeUsers(e,t){var n=sessionID;$.ajax({type:"GET",url:baseUrl+"/showPageLikeUsers",data:{id:t},success:function(e){for(var t='<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="info"><div class="info-title">Likes</div><div class="info-body">',a=0;a<e.length;a++)parseInt(e[a].id)===parseInt(n)?t+='<a href="'+baseUrl+'profile">'+e[a].username+"</a>":t+='<a href="'+baseUrl+e[a].username+'">'+e[a].username+"</a>";t+="</div></div></div></div></div></div>",$(t).hide().appendTo("#main").fadeIn(300)},error:function(e){$('<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>'+e+"</p></div></div></div></div></div>").hide().appendTo("#main").fadeIn(300),console.log(e)}})}function getSnapLikesCount(){var e=document.getElementById("hidden-snap-id").value;$.ajax({type:"GET",url:baseUrl+"snap/"+e+"/getSnapLikesCount",data:{id:e},success:function(e){0===parseInt(e)?$(".snap-likes-count").html(e):$(".snap-likes-count").html('<a href="#" title="Show Likes" onclick="showLikeUsers(); return false;">'+e+"</a>")},error:function(e){$('<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>'+e+"</p></div></div></div></div></div>").hide().appendTo("#main").fadeIn(300),console.log(e)}})}function getSnapCommentsCount(){var e=document.getElementById("hidden-snap-id").value;$.ajax({type:"GET",url:baseUrl+"snap/"+e+"/getSnapCommentsCount",data:{id:e},success:function(e){$(".snap-comments-count").html(e)},error:function(e){$("#main").append('<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>'+e+"</p></div></div></div></div></div>"),console.log(e)}})}function likeSnap(){var e=document.getElementById("hidden-snap-id").value,t=document.getElementById("hidden-user-id").value;$.ajax({type:"GET",url:baseUrl+"snap/"+e+"/like",data:{snap:e,user:t},success:function(e){$(".snap-like-button").remove(),$(".snap-button-holder").html('<button class="snap-dislike-button" title="Dislike This Snap" onclick="dislikeSnap();"><i class="icon fa-heart"></i></button>'),getSnapLikesCount()},error:function(e){$('<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>'+e+"</p></div></div></div></div></div>").hide().appendTo("#main").fadeIn(300),console.log(e)}})}function dislikeSnap(){var e=document.getElementById("hidden-snap-id").value,t=document.getElementById("hidden-user-id").value;$.ajax({type:"GET",url:baseUrl+"snap/"+e+"/dislike",data:{_token:token,snap:e,user:t},success:function(e){$(".snap-dislike-button").remove(),$(".snap-button-holder").html('<button class="snap-like-button" title="Like This Snap" onclick="likeSnap();"><i class="icon fa-heart"></i></button>'),getSnapLikesCount()},error:function(e){$('<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>'+e+"</p></div></div></div></div></div>").hide().appendTo("#main").fadeIn(300),console.log(e)}})}function showLikeUsers(){var e=document.getElementById("hidden-snap-id").value,n=document.getElementById("hidden-user-id").value;$.ajax({type:"GET",url:baseUrl+"snap/"+e+"/showLikeUsers",data:{id:e},success:function(e){for(var t='<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="info"><div class="info-title">Likes</div><div class="info-body">',a=0;a<e.length;a++)parseInt(e[a].id)===parseInt(n)?t+='<a href="'+baseUrl+'profile">'+e[a].username+"</a>":t+='<a href="'+baseUrl+e[a].username+'">'+e[a].username+"</a>";t+="</div></div></div></div></div></div>",$(t).hide().appendTo("#main").fadeIn(300)},error:function(e){$('<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>'+e+"</p></div></div></div></div></div>").hide().appendTo("#main").fadeIn(300),console.log(e)}})}function comment(){var e=document.getElementById("commentText").value,t=document.getElementById("hidden-snap-id").value,a=document.getElementById("hidden-user-id").value;""!==e?$.ajax({type:"POST",url:baseUrl+"snap/"+t+"/comment",data:{_token:token,text:e,snap:t,user:a},success:function(e){getComments(),getSnapCommentsCount(),$("#commentText").val("")},error:function(e){$('<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>'+e+"</p></div></div></div></div></div>").hide().appendTo("#main").fadeIn(300),console.log(e)}}):shake($("#commentText"))}function updateComment(e){var t=document.getElementById("commentText").value,a=document.getElementById("hidden-snap-id").value;""!==t&&t!==t.defaultValue?$.ajax({type:"POST",url:baseUrl+"snap/"+a+"/updateComment/"+e,data:{_token:token,text:t},success:function(e){getComments(),$("#commentText").val(""),$(".comment-button").attr({onclick:"comment();",value:"Comment"})},error:function(e){$('<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>'+e+"</p></div></div></div></div></div>").hide().appendTo("#main").fadeIn(300),console.log(e)}}):shake($("#commentText"))}function removeComment(e){var t=document.getElementById("hidden-snap-id").value;$.ajax({type:"GET",url:baseUrl+"snap/"+t+"/removeComment/"+e,success:function(e){getComments(),getSnapCommentsCount()},error:function(e){$('<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>'+e+"</p></div></div></div></div></div>").hide().appendTo("#main").fadeIn(300),console.log(e)}})}function getComments(){var e=document.getElementById("hidden-snap-id").value,r=document.getElementById("hidden-user-id").value;$.ajax({type:"GET",url:baseUrl+"snap/"+e+"/getComments",success:function(e){var t="";if(e.length)for(var a=0;a<e.length;a++){var n=e[a].commentDate,i=e[a].commentNewDate,s=moment(n).format("DD-MMM-YYYY | HH:mm"),o=moment(i).format("DD-MMM-YYYY | HH:mm"),l=null===i?s:o+" (updated)";t+='<div class="comment-holder"><div class="comment-image-holder"><a href="'+baseUrl+e[a].username+'"><img src="'+baseUrl+e[a].thumb_path+'" alt="comment-user-thumbnail-image" class="comment-image"/></a></div><div class="comment-content-holder"><span class="user-comment-date">'+e[a].username+" @ "+l+'</span><span class="user-comment-text">'+e[a].text+"</span>",parseInt(r)===parseInt(e[a].user)&&(t+='<span class="user-comment-edit"><a href="#" data-id="'+e[a].commentID+'" data-text="'+e[a].text+'" style="visibility: visible; opacity: 1;" class="activate-edit-comment"><i class="icon fa-edit"></i></a><a href="#" title="Cancel Comment Edit" style="visibility: hidden; opacity: 0;" class="cancel-edit-comment"><i class="icon fa-ban"></i></a></span><span class="user-comment-delete"><a href="#" title="Delete Comment" onclick="removeComment('+e[a].commentID+'); return false;"><i class="icon fa-trash"></i></a></span>'),t+="</div></div>"}else t+='<div class="comment-notice"><h1>There are currently no comments on this snap.<br/> Be first to comment something.</h1></div>';$(".snap-comments").html(t)},error:function(e){$("#main").append('<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>'+e+"</p></div></div></div></div></div>"),console.log(e)}})}function updateSnap(e,t){for(var a=document.getElementById("updateSnapText-"+t).value,n=document.getElementsByName("updateSnapStatus-"+t),i=0,s=n.length;i<s;i++)if(n[i].checked){var o=n[i].value;break}var l=$(e.parentNode.parentNode.parentNode.parentNode),r=l.find("form"),c=l.siblings(".snap-privacy"),d=c.children(".icon"),u=l.siblings(".snap-text");$.ajax({type:"GET",url:baseUrl+"profile/updateSnap/"+t,data:{_token:token,text:a,status:o},success:function(e){$('<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="info"><div class="info-body"><div class="success"><i class="fa fa-check-circle"></i><p>Snap successfully updated.</p></div></div></div></div></div></div></div>').hide().appendTo("#main").fadeIn(300),"public"===o?(d.remove(),c.append('<i class="icon fa-globe"></i>')):(d.remove(),c.append('<i class="icon fa-lock"></i>')),u.html("<h3>"+a.substr(0,35)+"</h3>"),r.fadeOut(300,function(){l.slideUp(300)})},error:function(e){$('<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>'+e+"</p></div></div></div></div></div>").hide().appendTo("#main").fadeIn(300),console.log(e)}})}function replyMessage(e,t){var a=document.getElementById("hidden-user-username").value,n=$(e),i=n.parents(".thread").find("dd:first-of-type"),s=n.siblings("#message-reply-"+t),o=s.val();if(""!==o){var l=new Date,r=moment(l).format("DD-MMM-YYYY | HH:mm");$.ajax({type:"POST",url:baseUrl+"profile/replyMessage/"+t,data:{_token:token,text:o,sender:a,viewer:"0"},success:function(){i.append('<div class="message-left"><span class="message-sender">'+a+" @ "+r+'</span><span class="message-text">'+o+"</span></div>"),i.scrollTop(i[0].scrollHeight),s.css({border:"1px solid rgba(0,0,0,0.15)","box-shadow":"inset 0 0.1em 0.1em 0 rgba(0,0,0,0.05)"}),s.val("")},error:function(e){$('<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><div class="error"><i class="fa fa-exclamation-triangle"></i><p>'+e+"</p></div></div></div></div></div>").hide().appendTo("#main").fadeIn(300)}})}else s.css({border:"1px solid #b33a3a","box-shadow":"0 0 5px #b33a3a"})}function loadMoreArchiveSnaps(){var e=window.location.href,t=e.substr(e.lastIndexOf("/")+1);$(document).on("click","#load-more-archive-snaps-button",function(){var e=$(this).data("id");$("#load-more-archive-snaps-form").html("<b>Loading...</b>"),$.ajax({url:baseUrl+"archive/"+t+"/loadMoreArchiveSnaps",method:"POST",data:{_token:token,id:e},success:function(e){$("#load-more-archive-snaps-form").remove(),$(".load-more-archive-snaps-form-holder").remove(),$("#archive .container .row").append(e),""!==sessionID&&getPageLikeDislikeButton(),getPageLikesCount(),getPageCommentsCount(),getPageViewsCount()}})})}function activateEditUser(){var e=$(".user-edit"),u=$(".user-button-holder"),m=$("#user-button");e.on("click",function(e){e.preventDefault();var d=$(this).data("id");$.ajax({url:baseUrl+"admin-panel/users/activate-edit-user-"+d,method:"POST",data:{_token:token,id:d},success:function(e){var t=e[0].name,a=e[0].surname,n=e[0].username,i=e[0].email,s=e[0].password,o=e[0].role,l=e[0].birthday,r=e[0].city,c=e[0].bio;$("#user-name").val(t),$("#user-surname").val(a),$("#user-username").val(n),$("#user-email").val(i),$("#user-password").val(s),$("#user-role").val(o),$("#user-birthday").val(l),$("#user-city").val(r),$("#user-bio").val(c),m.remove(),u.html('<input type="button" class="button" id="edit-user-button" name="edit-user-button" onclick="editUser('+d+');" value="Save Changes" /><input type="button" class="button user-cancel-button cancel-button" value="Cancel" />'),cancelUserEdit()}})})}function editUser(e){var t=$("#user-name").val(),a=$("#user-surname").val(),n=$("#user-username").val(),i=$("#user-email").val(),s=$("#user-password").val(),o=$("#user-role").val(),l=$("#user-birthday").val(),r=$("#user-city").val(),c=$("#user-bio").val();""!==t&&""!==a&&""!==n&&""!==i&&"0"!==o?$.ajax({type:"POST",url:baseUrl+"/admin-panel/users/edit-user-"+e,data:{_token:token,name:t,surname:a,username:n,email:i,password:s,role:o,birthday:l,city:r,bio:c},success:function(){alert("User information updated."),location.reload()},error:function(e){alert(e),console.log(e)}}):alert("Some of the information is invalid.")}function insertUser(){var e=$("#user-name").val(),t=$("#user-surname").val(),a=$("#user-username").val(),n=$("#user-email").val(),i=$("#user-password").val(),s=$("#user-role").val(),o=$("#user-birthday").val(),l=$("#user-city").val(),r=$("#user-bio").val();""!==e&&""!==t&&""!==a&&""!==n&&"0"!==s?$.ajax({type:"POST",url:baseUrl+"/admin-panel/users/insert-user",data:{_token:token,name:e,surname:t,username:a,email:n,password:i,role:s,birthday:o,city:l,bio:r},success:function(){alert("User added."),location.reload()},error:function(e){alert(e),console.log(e)}}):alert("Some of the information is invalid.")}function activateEditRole(){var e=$(".role-edit"),n=$(".role-button-holder"),i=$("#role-button");e.on("click",function(e){e.preventDefault();var a=$(this).data("id");$.ajax({url:baseUrl+"admin-panel/roles/activate-edit-role-"+a,method:"POST",data:{_token:token,id:a},success:function(e){var t=e[0].name;$("#role-name").val(t),i.remove(),n.html('<input type="button" class="button" id="edit-role-button" name="edit-role-button" onclick="editRole('+a+');" value="Save Changes" /><input type="button" class="button role-cancel-button cancel-button" value="Cancel" />'),cancelRoleEdit()}})})}function editRole(e){var t=$("#role-name").val();""!==t?$.ajax({type:"POST",url:baseUrl+"/admin-panel/roles/edit-role-"+e,data:{_token:token,name:t},success:function(){alert("Role updated."),location.reload()},error:function(e){alert(e),console.log(e)}}):alert("Information is invalid.")}function insertRole(){var e=$("#role-name").val();""!==e?$.ajax({type:"POST",url:baseUrl+"/admin-panel/roles/insert-role",data:{_token:token,name:e},success:function(){alert("Role added."),location.reload()},error:function(e){alert(e),console.log(e)}}):alert("Information is invalid.")}function activateEditSnap(){var e=$(".snap-edit"),c=$(".snap-button-holder"),d=$("#snap-button"),u=$("#admin-form").find("form");e.on("click",function(e){e.preventDefault();var r=$(this).data("id");$.ajax({url:baseUrl+"admin-panel/snaps/activate-edit-snap-"+r,method:"POST",data:{_token:token,id:r},success:function(e){var t=e[0].user,a=e[0].filter,n=e[0].status,i=e[0].text,s=e[0].imageID;$("#snap-user").val(t),$("#snap-filter").val(a),$("#snap-status").val(n),$("#snap-text").val(i),u.attr("action",baseUrl+"admin-panel/snaps/edit-snap");var o=$("#snap-id"),l=$("#snap-image-id");o.length&&l.length&&(o.remove(),l.remove()),u.append('<input type="hidden" id="snap-id" name="snap-id" value="'+r+'" /><input type="hidden" id="snap-image-id" name="snap-image-id" value="'+s+'" />'),d.remove(),c.html('<input type="submit" class="button" id="edit-snap-button" name="edit-snap-button" onclick="return editSnap();" value="Save Changes" /><input type="button" class="button snap-cancel-button cancel-button" value="Cancel" />'),cancelEditSnap()}})})}function activateEditFilter(){var e=$(".filter-edit"),i=$(".filter-button-holder"),s=$("#filter-button");e.on("click",function(e){e.preventDefault();var n=$(this).data("id");$.ajax({url:baseUrl+"admin-panel/filters/activate-edit-filter-"+n,method:"POST",data:{_token:token,id:n},success:function(e){var t=e[0].name,a=e[0].class;$("#filter-name").val(t),$("#filter-class").val(a),s.remove(),i.html('<input type="button" class="button" id="edit-filter-button" name="edit-filter-button" onclick="editFilter('+n+');" value="Save Changes" /><input type="button" class="button filter-cancel-button cancel-button" value="Cancel" />'),cancelFilterEdit()}})})}function editFilter(e){var t=$("#filter-name").val(),a=$("#filter-class").val();""!==t&&""!==a?$.ajax({type:"POST",url:baseUrl+"/admin-panel/filters/edit-filter-"+e,data:{_token:token,name:t,fclass:a},success:function(){alert("Filter updated."),location.reload()},error:function(e){alert(e),console.log(e)}}):alert("Some of the information is invalid.")}function insertFilter(){var e=$("#filter-name").val(),t=$("#filter-class").val();""!==e&&""!==t?$.ajax({type:"POST",url:baseUrl+"/admin-panel/filters/insert-filter",data:{_token:token,name:e,fclass:t},success:function(){alert("Filter added."),location.reload()},error:function(e){alert(e),console.log(e)}}):alert("Some of the information is invalid.")}function activateEditComment(){var e=$(".comment-edit"),n=$(".comment-form");e.on("click",function(e){e.preventDefault();var a=$(this).data("id");$.ajax({url:baseUrl+"admin-panel/comments/activate-edit-comment-"+a,method:"POST",data:{_token:token,id:a},success:function(e){var t=e[0].text;n.html('<form method="POST"><div class="row"><div class="12u"><input type="text" value="'+t+'" id="comment-text" name="comment-text" placeholder="Comment" /></div></div><div class="row"><div class="12u comment-button-holder button-holder"><input type="button" class="button" id="edit-comment-button" name="edit-comment-button" onclick="editComment('+a+');" value="Save Changes" /><input type="button" class="button comment-cancel-button cancel-button" value="Cancel" /></div></div></form>'),cancelCommentEdit()}})})}function editComment(e){var t=$("#comment-text").val();""!==t?$.ajax({type:"POST",url:baseUrl+"admin-panel/comments/edit-comment-"+e,data:{_token:token,text:t},success:function(){alert("Comment updated."),location.reload()},error:function(e){alert(e),console.log(e)}}):alert("Information is invalid.")}function redirect(){var e=window.location.href,t=e.substring(e.lastIndexOf("/")+1);$.ajax({type:"GET",url:baseUrl+"redirect",data:{snapID:t},success:function(){window.location.href=baseUrl},error:function(e){alert(e),console.log(e)}})}$(document).on("ready",function(){""!==sessionID&&(loadMoreAllHomeSnaps(),getPageLikeDislikeButton(),loadMoreArchiveSnaps(),pushUserTooltip(),activateEditUser(),activateEditRole(),pushSnapTooltip(),activateEditSnap(),activateEditFilter(),activateEditComment()),getPageLikesCount(),getPageCommentsCount(),getPageViewsCount(),loadMorePublicHomeSnaps(),TABLE.paginate("#admin-body .table",5)});var TABLE={};function authRegisterName(){var e=document.getElementById("name"),t=e.nextElementSibling;/^[A-ZŠĐČĆŽ][a-zšđčćž]+$/.test(e.value)?(e.style.border="solid 1px rgba(0,0,0,0.15)",e.style.boxShadow="0 0 2px 1px #8ebebc",t.style.color="#8ebebc"):(e.style.border="solid 1px rgb(179,58,58)",e.style.boxShadow="0 0 2px 1px #b33a3a",t.style.color="#b33a3a")}function authRegisterSurname(){var e=document.getElementById("surname"),t=e.nextElementSibling;/^[A-ZŠĐČĆŽ][a-zšđčćž]+$/.test(e.value)?(e.style.border="solid 1px rgba(0,0,0,0.15)",e.style.boxShadow="0 0 2px 1px #8ebebc",t.style.color="#8ebebc"):(e.style.border="solid 1px rgb(179,58,58)",e.style.boxShadow="0 0 2px 1px #b33a3a",t.style.color="#b33a3a")}function authRegisterPassword(){var e=document.getElementById("passwordr"),t=e.nextElementSibling;/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/.test(e.value)?(e.style.border="solid 1px rgba(0,0,0,0.15)",e.style.boxShadow="0 0 2px 1px #8ebebc",t.style.color="#8ebebc"):(e.style.border="solid 1px rgb(179,58,58)",e.style.boxShadow="0 0 2px 1px #b33a3a",t.style.color="#b33a3a")}function authRegisterPasswordConfirm(){var e=document.getElementById("passwordr"),t=document.getElementById("passwordc");e.value.match(t.value)?(t.style.border="solid 1px rgba(0,0,0,0.15)",t.style.boxShadow="0 0 2px 1px #8ebebc"):(t.style.border="solid 1px rgb(179,58,58)",t.style.boxShadow="0 0 2px 1px #b33a3a")}function authRegisterUsername(){var e=document.getElementById("usernamer"),t=e.nextElementSibling;/^[a-zA-Z0-9]{3,25}$/.test(e.value)?(e.style.border="solid 1px rgba(0,0,0,0.15)",e.style.boxShadow="0 0 2px 1px #8ebebc",t.style.color="#8ebebc"):(e.style.border="solid 1px rgb(179,58,58)",e.style.boxShadow="0 0 2px 1px #b33a3a",t.style.color="#b33a3a")}function authRegisterEmail(){var e=document.getElementById("email");/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(e.value)?(e.style.border="solid 1px rgba(0,0,0,0.15)",e.style.boxShadow="0 0 2px 1px #8ebebc"):(e.style.border="solid 1px rgb(179,58,58)",e.style.boxShadow="0 0 2px 1px #b33a3a")}function shake(e){for(var t=0;t<7;t++)$(e).animate({left:t%2==0?10:-10},100);$(e).animate({left:0,top:0},100)}function search(){var e=$(".form-holder form");""===$("#search-keyword").val()?shake(e):e.submit()}function cancelUserEdit(){var e=$(".user-button-holder"),t=$(".user-cancel-button"),a=$("#user-name"),n=$("#user-surname"),i=$("#user-username"),s=$("#user-email"),o=$("#user-password"),l=$("#user-role"),r=$("#user-birthday"),c=$("#user-city"),d=$("#user-bio");t.on("click",function(){a.val(""),n.val(""),i.val(""),s.val(""),o.val(""),l.val("0"),r.val(""),c.val(""),d.val(""),window.scroll(0,0),t.remove(),e.html('<input type="button" class="button" id="insert-user-button" name="insert-user-button" onclick="insertUser();" value="Insert New User" />')})}function cancelRoleEdit(){var e=$(".role-button-holder"),t=$(".role-cancel-button"),a=$("#role-name");t.on("click",function(){a.val(""),window.scroll(0,0),t.remove(),e.html('<input type="button" class="button" id="insert-role-button" name="insert-role-button" onclick="insertRole();" value="Insert New Role" />')})}function insertSnap(){var e=$("#snap-image").val(),t=$("#snap-user").val(),a=$("#snap-filter").val(),n=$("#snap-status").val();return""===e||"0"===t||"0"===a||"0"===n?(alert("Some of the information is invalid."),!1):(alert("Snap added."),!0)}function editSnap(){var e=$("#snap-user").val(),t=$("#snap-filter").val(),a=$("#snap-status").val();return"0"===e||"0"===t||"0"===a?(alert("Some of the information is invalid."),!1):(alert("Snap updated."),!0)}function cancelEditSnap(){var e=$(".snap-button-holder"),t=$(".snap-cancel-button"),a=$("#admin-form form"),n=$("#snap-image"),i=$("#snap-user"),s=$("#snap-filter"),o=$("#snap-status"),l=$("#snap-text"),r=$("#snap-id"),c=$("#snap-image-id");t.on("click",function(){a.attr("action",baseUrl+"admin-panel/snaps/insert-snap"),n.val(""),i.val("0"),s.val("0"),o.val("0"),l.val(""),r.remove(),c.remove(),window.scroll(0,0),t.remove(),e.html('<input type="button" class="button" id="insert-snap-button" name="insert-snap-button" onclick="insertSnap();" value="Insert New Snap" />')})}function cancelFilterEdit(){var e=$(".filter-button-holder"),t=$(".filter-cancel-button"),a=$("#filter-name"),n=$("#filter-class");t.on("click",function(){a.val(""),n.val(""),window.scroll(0,0),t.remove(),e.html('<input type="button" class="button" id="insert-filter-button" name="insert-filter-button" onclick="insertFilter();" value="Insert New Filter" />')})}function cancelCommentEdit(){var e=$(".comment-form"),t=$(".comment-cancel-button"),a=$("#comment-text");t.on("click",function(){a.val(""),window.scroll(0,0),e.html("")})}TABLE.paginate=function(e,t){var a=$(e),n=a.find("tbody > tr"),i=Math.ceil(n.length/t)-1,s=0,o=a.parents(".table-wrapper").find(".wrapper-paging ul"),l=o.find("li:first-child a"),r=o.find("li:last-child a");o.find("a.paging-this strong").text(s+1),o.find("a.paging-this span").text(1+i),l.addClass("paging-disabled").click(function(){pagination("<")}),r.click(function(){pagination(">")}),n.hide().slice(0,t).show(),pagination=function(e){reveal=function(e){l.removeClass("paging-disabled"),r.removeClass("paging-disabled"),n.hide().slice(e*t,e*t+t).show(),o.find("a.paging-this strong").text(e+1)},"<"===e?1<s?reveal(s-=1):1===s&&(reveal(s-=1),l.addClass("paging-disabled")):s<i-1?reveal(s+=1):s===i-1&&(reveal(s+=1),r.addClass("paging-disabled"))}},function(n){skel.init({reset:"full",breakpoints:{global:{range:"*",href:"../css/modules/template/style.css",containers:1400,grid:{gutters:40},viewport:{scalable:!1}},wide:{range:"961-1880",href:"../css/modules/template/style-wide.css",containers:1200,grid:{gutters:40}},normal:{range:"961-1620",href:"../css/modules/template/style-normal.css",containers:960,grid:{gutters:40}},narrow:{range:"961-1320",href:"../css/modules/template/style-narrow.css",containers:"100%",grid:{gutters:20}},narrower:{range:"-960",href:"../css/modules/template/style-narrower.css",containers:"100%",grid:{gutters:20}},mobile:{range:"-736",href:"../css/modules/template/style-mobile.css",containers:"100%!",grid:{collapse:!0}}},plugins:{layers:{config:{mode:"transform"},sidePanel:{hidden:!0,breakpoints:"narrower",position:"top-left",side:"left",animation:"pushX",width:240,height:"100%",clickToHide:!0,html:'<div data-action="moveElement" data-args="header"></div>',orientation:"vertical"},sidePanelToggle:{breakpoints:"narrower",position:"top-left",side:"top",height:"4em",width:"5em",html:'<div data-action="toggleLayer" data-args="sidePanel" class="toggle"></div>'}}}}),n(function(){var e=n(window),t=n("body");t.addClass("is-loading"),e.on("load",function(){t.removeClass("is-loading")}),skel.vars.IEVersion<9&&n(":last-child").addClass("last-child");var a=n("form");0<a.length&&(a.find(".form-button-submit").on("click",function(){return n(this).parents("form").submit(),!1}),skel.vars.IEVersion<10&&(n.fn.n33_formerize=function(){var t=new Array,e=n(this);return e.find("input[type=text],textarea").each(function(){var e=n(this);""!=e.val()&&e.val()!=e.attr("placeholder")||(e.addClass("formerize-placeholder"),e.val(e.attr("placeholder")))}).blur(function(){var e=n(this);e.attr("name").match(/_fakeformerizefield$/)||""==e.val()&&(e.addClass("formerize-placeholder"),e.val(e.attr("placeholder")))}).focus(function(){var e=n(this);e.attr("name").match(/_fakeformerizefield$/)||e.val()==e.attr("placeholder")&&(e.removeClass("formerize-placeholder"),e.val(""))}),e.find("input[type=password]").each(function(){var e=n(this),t=n(n("<div>").append(e.clone()).remove().html().replace(/type="password"/i,'type="text"').replace(/type=password/i,"type=text"));""!=e.attr("id")&&t.attr("id",e.attr("id")+"_fakeformerizefield"),""!=e.attr("name")&&t.attr("name",e.attr("name")+"_fakeformerizefield"),t.addClass("formerize-placeholder").val(t.attr("placeholder")).insertAfter(e),""==e.val()?e.hide():t.hide(),e.blur(function(e){e.preventDefault();var t=n(this),a=t.parent().find("input[name="+t.attr("name")+"_fakeformerizefield]");""==t.val()&&(t.hide(),a.show())}),t.focus(function(e){e.preventDefault();var t=n(this),a=t.parent().find("input[name="+t.attr("name").replace("_fakeformerizefield","")+"]");t.hide(),a.show().focus()}),t.keypress(function(e){e.preventDefault(),t.val("")})}),e.submit(function(){n(this).find("input[type=text],input[type=password],textarea").each(function(e){var t=n(this);t.attr("name").match(/_fakeformerizefield$/)&&t.attr("name",""),t.val()==t.attr("placeholder")&&(t.removeClass("formerize-placeholder"),t.val(""))})}).bind("reset",function(e){e.preventDefault(),n(this).find("select").val(n("option:first").val()),n(this).find("input,textarea").each(function(){var e,t=n(this);switch(t.removeClass("formerize-placeholder"),this.type){case"submit":case"reset":break;case"password":t.val(t.attr("defaultValue")),e=t.parent().find("input[name="+t.attr("name")+"_fakeformerizefield]"),""==t.val()?(t.hide(),e.show()):(t.show(),e.hide());break;case"checkbox":case"radio":t.attr("checked",t.attr("defaultValue"));break;case"text":case"textarea":t.val(t.attr("defaultValue")),""==t.val()&&(t.addClass("formerize-placeholder"),t.val(t.attr("placeholder")));break;default:t.val(t.attr("defaultValue"))}}),window.setTimeout(function(){for(x in t)t[x].trigger("formerize_sync")},10)}),e},a.n33_formerize()))})}(jQuery),function(i){"use strict";function a(){var t=i("#notice");t.on("click",function(e){i(e.target).closest(".notices").length||t.fadeOut(300,function(){t.remove()})})}function e(){var e=i(".activate-edit-comment");e.length&&e.each(function(){var t=i(this),a=t.attr("data-text"),n=t.attr("data-id");t.on("click",function(e){e.preventDefault(),t.css({visibility:"hidden",opacity:"0"}),t.next(".cancel-edit-comment").css({visibility:"visible",opacity:"1"}),i("#commentText").val(a),i(".comment-button").attr({onclick:"updateComment("+n+");",value:"Update Comment"})})})}function t(){var e=i(".cancel-edit-comment");e.length&&e.each(function(){var t=i(this);t.on("click",function(e){e.preventDefault(),t.css({visibility:"hidden",opacity:"0"}),t.prev(".activate-edit-comment").css({visibility:"visible",opacity:"1"}),i("#commentText").val(""),i(".comment-button").attr({onclick:"comment();",value:"Comment"})})})}i(document).on("ready",function(){!function(){var e=window.location.pathname,t=i("#nav ul li:nth-child(1)"),a=i("#nav ul li:nth-child(2)"),n=i("#nav ul li:nth-child(5)");e.startsWith("/snap")&&t.find("a").addClass("active");(e.startsWith("/results")||e.startsWith("/archive"))&&a.find("a").addClass("active");e.startsWith("/admin-panel")&&n.find("a").addClass("active")}(),a(),i("#forget-password-button").on("click",function(e){e.preventDefault();var t='<div id="notice"><div class="notices-wrapper"><div class="notices"><div class="notices-body"><form method="POST" action="'+baseUrl+'reset-password"><div class="row"><div class="12u"><input type="email" name="reset-email" id="reset-email" placeholder="E-mail" /><label for="reset-email">Enter your E-mail.</label></div></div><div class="row"><div class="12u"><input type="button" class="button" name="reset-password-button" id="reset-password-button" onclick="resetPassword();" value="Reset" /></div></div></form></div></div></div></div></div>';i(t).hide().appendTo("#main").fadeIn(300),a()}),i(".anchor").on("click",function(e){e.preventDefault();var t=i(this).attr("data-anchor");i("html, body").animate({scrollTop:i(t).offset().top},0)}),function(){var e=i("#popup");i("#popup-btn").on("click",function(){e.toggleClass("show"),i(this).toggleClass("rotate")})}(),i("#snapImgUpload").change(function(){i(this).prev("label").clone();var e=i("#snapImgUpload")[0].files[0].name;i(this).prev("label").text(e)}),i("#profileImgUpload").change(function(){i(this).prev("label").css("color","#8ebebc")}),i(".tab-holder .tab:not(:first)").addClass("inactive"),i(".tabcontent").hide(),i(".tabcontent:first").show(),i(".tab-holder .tab").on("click",function(){var e=i(this).attr("id");i(this).hasClass("inactive")&&(i(".tab-holder .tab").addClass("inactive"),i(this).removeClass("inactive"),i(".tabcontent").hide(),i("#"+e+"-content").fadeIn("slow"))}),i(".owl-carousel").owlCarousel({items:4,loop:!1,nav:!0}),function(){var e=i(".snap-filter");e.length&&e.each(function(){var e=i(this),t=e.find("div").attr("class");t=t.substr(7),e.css("background-color",t)})}(),function(){var e=i(".thread");e.length&&e.each(function(){var e=i(this),t=e.find(".fa-chevron-down"),a=e.find("dd");a.hide(),t.on("click",function(){a.slideToggle("slow"),t.toggleClass("rotate"),setTimeout(function(){a.scrollTop(a[0].scrollHeight)},0)})})}(),function(){var e=i(".snap-icons .icon-edit");e.length&&e.each(function(){var e=i(this),t=e.parent().siblings(".snap-edit-overlay");e.on("click",function(e){e.preventDefault(),t.slideDown(300,function(){t.children("form").fadeIn(300)})})})}(),function(){var e=i(".snap-edit-overlay .cancel-update-snap");e.length&&e.each(function(){var e=i(this),t=e.parents(".snap-edit-overlay");e.on("click",function(e){e.preventDefault(),t.children("form").fadeOut(300,function(){t.slideUp(300)})})})}(),function(){var e=i(".compose-new-message .button");e.on("click",function(){e.siblings(".compose-new-message-holder").slideToggle("slow"),setTimeout(function(){window.scrollTo(0,document.body.scrollHeight)},500),"Compose New Message"===e.val()?(e.val("Cancel"),e.css("background-color","#b33a3a")):"Cancel"===e.val()&&(e.val("Compose New Message"),e.css("background-color","#8ebebc"))})}(),e(),t()}),i(document).on("ajaxComplete",function(){a(),e(),t()})}(jQuery);