<?php
if(!defined('ROOT')) exit('No direct script access allowed');

if(!isset($_ENV["LOGIKSAI_TITLE"])) {
    echo "Please call <u>configureLogiksAI</u> before using this component";
    return;
}
?>
<style>
.aiChat {
    background: white;
    z-index: 999999;
    position: fixed;
    right: 0px;
    top: 30px;
    bottom: 0px;
    border: 0px;
    border-top: 1px solid #CACACA;
}
.chatApp {
    display: flex;
    flex-direction: column;
    background-color: #DFCFBE;
    max-width: 1600px;
    /*    max-width: 500px;*/
    width: 100%;
    height: 100%;
/*    margin: 0 auto;*/
    overflow: hidden;
    float: left;
}

.chatApp img {
    max-width: 100%;
}

.wrapper {
    width: 100%;
    display: flex;
    flex-grow: 1;
    overflow: hidden;
}

.conversation-area,
.detail-area {
    width: 340px;
    flex-shrink: 0;
}

.detail-area {
    border-left: 1px solid #eef2f4;
    margin-left: auto;
    padding: 30px 30px 0 30px;
    display: flex;
    flex-direction: column;
    overflow: auto;
}

.chat-area {
    flex-grow: 1;
}

.msg-profile {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 15px;
}

.msg-profile.group {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #eef2f4;
}

.msg-profile.group svg {
    width: 60%;
}

.msg {
    display: flex;
    align-items: center;
    padding: 20px;
    cursor: pointer;
    transition: 0.2s;
    position: relative;
}

.msg:hover {
    background-color: var(--msg-hover-bg);
}

.msg.active {
    background: linear-gradient(to right,
            rgba(47, 50, 56, 0.54),
            rgba(238, 242, 244, 0) 100%);
    border-left: 4px solid #0086ff;
}

.msg.online:before {
    content: "";
    position: absolute;
    background-color: #23be7e;
    width: 9px;
    height: 9px;
    border-radius: 50%;
    border: 2px solid #fff;
    left: 50px;
    bottom: 19px;
}

.msg-username {
    margin-bottom: 4px;
    font-weight: 600;
    font-size: 15px;
}

.msg-detail {
    overflow: hidden;
}

.msg-content {
    font-weight: 500;
    font-size: 13px;
    display: flex;
}

.add {
    position: sticky;
    bottom: 25px;
    background-color: #0086ff;
    width: 60px;
    height: 60px;
    border: 0;
    border-radius: 50%;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-plus'%3e%3cpath d='M12 5v14M5 12h14'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: 50%;
    background-size: 28px;
    box-shadow: 0 0 16px #0086ff;
    margin: auto auto -55px;
    flex-shrink: 0;
    z-index: 1;
    cursor: pointer;
}


.chat-area {
    display: flex;
    flex-direction: column;
    overflow: auto;
}
.chat-area-main .ajaxloading {
    background-position: 20px;
    margin: 0px;
    padding: 20px;
}
.chat-area-header {
    display: flex;
    position: sticky;
    top: 0;
    left: 0;
    z-index: 2;
    width: 100%;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    background: var(--chat-header-bg);
}

.chat-area-profile {
    width: 32px;
    border-radius: 50%;
    object-fit: cover;
}

.chat-area-title {
    font-size: 18px;
    font-weight: 600;
}

.chat-area-main {
    flex-grow: 1;
}

.chat-msg-img {
    height: 40px;
    width: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.chat-msg-profile {
    flex-shrink: 0;
    margin-top: auto;
    margin-bottom: -20px;
    position: relative;
    margin-top: 0px;
}

.chat-msg-date {
    position: absolute;
    left: calc(100% + 12px);
    bottom: 0;
    font-size: 12px;
    font-weight: 600;
    color: #c0c7d2;
    white-space: nowrap;
}

.chat-msg {
    display: flex;
/*    padding: 0 20px 45px;*/
    padding: 0 10px 40px;
}

.chat-msg-content {
    margin-left: 12px;
    max-width: 80%;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.chat-msg-text {
    background-color: var(--chat-text-bg);
/*    padding: 15px;*/
    padding: 15px 15px 8px 15px;
    border-radius: 20px 20px 20px 0;
    line-height: 1.5;
    font-size: 14px;
    font-weight: 500;
}

.chat-msg-text+.chat-msg-text {
    margin-top: 10px;
}

.chat-msg-text {
    color: #000;
}

.owner {
    flex-direction: row-reverse;
}

.owner .chat-msg-content {
    margin-left: 0;
    margin-right: 12px;
    align-items: flex-end;
}

.owner .chat-msg-text {
    background-color: #0086ff;
    color: #fff;
    border-radius: 20px 20px 0 20px;
}

.owner .chat-msg-date {
    left: auto;
    right: calc(100% + 12px);
}

.chat-msg-text img {
    max-width: 300px;
    width: 100%;
}

.chat-area-foot {
    display: flex;
    border-top: 1px solid #eef2f4;
    width: 100%;
    padding: 10px 0px 10px 10px;
    align-items: center;
    background-color: #fff;
    position: sticky;
    bottom: 0;
    left: 0;
}

.chat-area-foot svg {
    color: #c1c7cd;
    width: 20px;
    flex-shrink: 0;
    cursor: pointer;
}

.chat-area-foot svg:hover {
    color: var(--settings-icon-hover);
}

.chat-area-foot svg+svg {
    margin-left: 12px;
}

.chat-area-foot input, .chat-area-foot textarea {
    border: none;
    color: #000;
    background-color: var(--input-bg);
    padding: 12px;
    border-radius: 6px;
    font-size: 15px;
    margin: 0 12px;
    width: 100%;
}

.chat-area-foot input::placeholder, , .chat-area-foot textarea::placeholder {
    color: #a2a2a2;
}

.chat-area-foot input:focus, .chat-area-foot textarea:focus{
    outline: none;
}

.logo {
    width: auto;
}

.headerRow {
    width: 325px;
    margin: -36px;
    padding: 0;
    background: #eaeef1;
    height: 78px;
    align-items: center;
}

.headerRow i {
    color: #000;
    font-size: 20px;
    vertical-align: -2px;
    margin-right: 3px;
}

.headerRow span {
    color: #000;
    font-size: 14px;
    font-weight: 500;
}

.col-md-6:not(:last-child) .headerBlock {
    border-right: 1px solid #ddd;
}

.chat-area-header {
    display: flex;
    position: sticky;
    top: 0;
    left: 0;
    z-index: 2;
    width: 100%;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    background: var(--chat-header-bg);
    box-shadow: 1px 1px 7px 1px #dfdfdf;
    background: #fff;
}

.headerBlock {
    justify-content: center;
    display: flex;
}

.chat-area-header .msg {
    padding: 00;
}

.chat-area-header {
    /*padding: 6px 20px;*/
    padding: 0px 2px;
}

.menuToggle {}

.conversation-area .headerRow {
    display: none;
}

.chat-area-foot input, .chat-area-foot textarea {
    background: #f3f3f3;
    border: 1px solid #eee;
    margin: 0;
}

.sendBox {
    position: relative;
    flex-grow: 1;
    padding-left: 13px;
}

.sendBox i {
    position: absolute;
    right: 16px;
    top: 23px;
    width: 30px;
    height: 30px;
    background: #0070ff;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 20px;
    color: #fff;
    border-radius: 4px;
}

.chat-area-foot svg {
    color: #919191;
}

.chat-area-main {
    padding-top: 15px;
    background: url(image/chat-bg.jpg);
}

.chat-msg-text {
    background-color: #ffffff;
}

.chat-area-group i {
    font-size: 23px;
}

.chat-msg-date {
    color: #232323;
}

::-webkit-scrollbar {
    width: 4px;
}

/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #bfe1ff;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555;
}

.owner .chat-msg-text {
    border-radius: 5px 5px 0 5px;
}

.chat-msg-text {
    border-radius: 5px 5px 5px 0;
}

.dropdownBox {
    position: absolute;
    width: 280px;
/*    height: 230px;*/
    height: auto;
    background: #fff;
    box-shadow: 0 2px 5px 0 rgba(11, 20, 26, .26), 0 2px 10px 0 rgba(11, 20, 26, .16);
    bottom: 76px;
    border-radius: 8px !important;
    transform: scale(0);
    opacity: 0;
    transition: ease 0.4s all;
    transform-origin: left bottom;
}

.dropdownBox ul {
    padding: 0;
    margin: 0;
    list-style: none;
    padding: 12px;
    display: flex;
    flex-wrap: wrap;
}

.dropdownBox ul li {
    flex: 0 0 33.33%;
    max-width: 33.33%;
    padding: 10px;
    text-align: center;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;

    text-align: center;
}

.dropdownBox ul li a {
    width: 45px;
    height: 45px;
    background: #ff7e0c;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    text-decoration: none;
}

.dropdownBox ul li a i {
    color: #fff;
    font-size: 17px;
}

.dropdownBox ul li span {
    font-size: 12px;
    margin-top: 9px;
}

.dropdownBox ul li:nth-child(1) a {
    background: #00abff;
}

.dropdownBox ul li:nth-child(2) a {
    background: #ff4545;
}

.dropdownBox ul li:nth-child(3) a {
    background: #9861ff;
}

.dropdownBox ul li:nth-child(4) a {
    background: #ff7801;
}

.dropdownBox ul li:nth-child(5) a {
    background: #3ab97a;
}

.dropdownBox.active {
    transform: scale(1);
    opacity: 1;
}

.sendBox textarea {
    width: 100%;
    border: 1px solid #DDD;
}

.chat-welcome {

}
.chat-welcome .chat-msg-content {
    margin: auto;
}
.chat-welcome .chat-msg-content .chat-msg-text {
    width: 100%;
    border-radius: 20px !important;
    text-align: center;
}
.chat-welcome .chat-msg-content img {

}
.chat-welcome .chat-msg-content .welcome-icon {
    width: 100px;
    margin: auto;
}

@media (max-width: 1120px) {
    .detail-area {
        display: none;
    }
}

@media (max-width: 780px) {
    .conversation-area {
        display: none;
    }

    .search-bar {
        margin-left: 0;
        flex-grow: 1;
    }

    .search-bar input {
        padding-right: 10px;
    }

    .headerRow {
        display: none;
    }

    .conversation-area .headerRow {
        display: flex;
        width: auto;
        margin-top: 0px;
        margin-bottom: 10px;
        height: 50px;
    }

    .col-6:not(:last-child) .headerBlock {
        border-right: 1px solid #ddd;
    }

    .conversation-area,
    .detail-area {
        width: 100%;
    }

    .add {
        left: 50%;
        transform: translateX(-50%);
    }
}

<?=$_ENV["LOGIKSAI_STYLE"]?>
</style>
<script src='<?=_jsLink("showdown.min")?>' type='text/javascript' language='javascript'></script>
<div class="chatApp" chatid='<?=$_ENV["LOGIKSAI_UUID"]?>'>
    <div id="chatAreaContainer" class="chat-area">
        <div class="chat-area-header">
            <div class="msg ">
                <div class="msg-profile group">
                    <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                        <path d="M12 2l10 6.5v7L12 22 2 15.5v-7L12 2zM12 22v-6.5"></path>
                        <path d="M22 8.5l-10 7-10-7"></path>
                        <path d="M2 15.5l10-7 10 7M12 2v6.5"></path>
                    </svg>
                </div>
                <div class="msg-detail">
                    <div class="msg-username"><?=$_ENV["LOGIKSAI_TITLE"]?></div>
                </div>
            </div>
            <div class="chat-area-group">
                <i class="fa fa-ellipsis-h"></i>
            </div>
        </div>
        <div id="chatAreaMain" class="chat-area-main">
            
        </div>
        <div class="chat-area-foot">
            <div class="dropdownBox">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa fa-file" aria-hidden="true"></i>
                        </a>
                        <span>Document</span>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                        </a>
                        <span>Camera</span>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-picture-o" aria-hidden="true"></i>
                        </a>
                        <span>Image</span>
                    </li>
                    <!-- <li>
                        <a href="#">
                            <i class="fa fa-video-camera" aria-hidden="true"></i>
                        </a>
                        <span>Video</span>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-headphones" aria-hidden="true"></i>
                        </a>
                        <span>Audio</span>
                    </li> -->
                </ul>
            </div>
            <div class="dropdownIcon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip">
                <path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48" />
            </svg>
          </div>
            <div class="sendBox">
                <textarea id='sendMessageBox' type="text" placeholder="Type message here..." ></textarea>
                <i class="fa fa-paper-plane sendMessageBtn"></i>
            </div>
        </div>
    </div>
</div>
<script>
const LOGIKSAI_EVENT_LISTENERS = {
    "ON_SEND": [],
    "ON_RECEIVE": []
};
const LOGIKSAI_CHATID = "<?=$_ENV["LOGIKSAI_UUID"]?>";
var LOGIKSAI_PARAMS = {
    "AVATAR": "<?=loadMedia('images/user.png')?>"
};
const LOGIKSAI_DEBUG = "<?=$_SESSION["LOGIKSAI_DEBUG"]?"true":"false"?>";
$(function() {
    
});
function initiateLogiksAIChat(params) {
    $("#chatAreaContainer .sendMessageBtn").click(sendMessage);
    $("#chatAreaContainer textarea").keyup(function(e) {
        if(e.shiftKey && e.keyCode==13) {
            sendMessage();
        }
    });

    $(".menuToggle").click(function(){
        $(".conversation-area").fadeToggle(500);
    });

    $(".dropdownIcon").click(function(){
        $(".dropdownBox").toggleClass("active");
    });

    if(params==null) params = {};

    LOGIKSAI_PARAMS = $.extend(LOGIKSAI_PARAMS, params);
    
    clearChatWindow();

    // console.log("LOGKSAI-INITIALIZED");
}
function sendMessage() {
    if($("#sendMessageBox").val()==null || $("#sendMessageBox").val().length<=0) {
        if(typeof lgksToast=="function") lgksToast("No message to send");
        return;
    }
    const msgText = $("#sendMessageBox").val().trim();
    const msgObj = {
        "msg": msgText,
        "id": new Date().getTime(),
        "chatid": LOGIKSAI_CHATID
    };
    $("#sendMessageBox").val("");

    appendNewMessage(true, "Self", msgText, LOGIKSAI_PARAMS.AVATAR, new moment().format("hh:MM:ss"), msgObj.id);//YYYY-mm-D 

    // console.log("LOGIKSAI_SENDMSG", msgText);

    $.each(LOGIKSAI_EVENT_LISTENERS.ON_SEND, function(k, func) {
        try {
            if(typeof func == "function") {
                var temp = func(msgObj);
                if(temp!=null) msgObj = temp;
            }
        } catch(e) {}
    });

    $("#chatAreaMain").append(`<div class='ajaxloading ajaxloading3'></div>`);

    processAJAXPostQuery(_service("logiksAI", "send"), jsonToQueryString(msgObj), function(data) {
        if(data.Data.status==="success") {
            recieveMessage(data.Data);
        } else {
            recieveMessage(data.Data);
        }
    }, "json");
}
function recieveMessage(msgObj) {
    console.log("LOGIKSAI_RECIEVE", msgObj);

    msgObj = $.extend({
        "user": "",
        "msg": "",
        "avatar": null,
        "timestamp": new moment().format("hh:MM:ss")//YYYY-mm-D 
    }, msgObj);

    appendNewMessage(false, msgObj.user, msgObj.msg, msgObj.avatar, msgObj.timestamp, msgObj.id);

    $.each(LOGIKSAI_EVENT_LISTENERS.ON_RECEIVE, function(k, func) {
        try {
            if(typeof func == "function") func(msgObj);
        } catch(e) {}
    });
}
function appendNewMessage(isOwner, msgUser, msgText, msgAvatar, timeStamp, msgID) {
    if(msgAvatar==null || msgAvatar===false) msgAvatar = "<?=loadMedia('images/user.png')?>";
    // timeStamp

    $("#chatAreaMain").find(".chat-welcome").detach();
    $("#chatAreaMain").find(".ajaxloading").detach();

    if(msgText==null) msgText = "";
    msgText = markdownToHTML(msgText);

    if(isOwner) {
        $("#chatAreaMain").append(`<div class="chat-msg owner" data-msgid='${msgID}'>
                <div class="chat-msg-profile">
                    <img class="chat-msg-img" src="${msgAvatar}" alt="${msgUser}" />
                    <div class="chat-msg-date">Message sent on ${timeStamp}</div>
                </div>
                <div class="chat-msg-content">
                    <div class="chat-msg-text">${msgText}</div>
                </div>
            </div>`);
    } else {
        $("#chatAreaMain").append(`<div class="chat-msg server" data-msgid='${msgID}'>
                <div class="chat-msg-profile">
                    <img class="chat-msg-img" src="${msgAvatar}" alt="${msgUser}" />
                    <div class="chat-msg-date">Message recieved at ${timeStamp}</div>
                </div>
                <div class="chat-msg-content">
                    <div class="chat-msg-text">${msgText}</div>
                </div>
            </div>`);
    }

    $("#chatAreaContainer").scrollTop($("#chatAreaMain").height());
}
function clearChatWindow() {
    $("#chatAreaMain").html(`<div class="chat-welcome">
                <div class="chat-msg-content">
                    <div class="chat-msg-text">
                        <div class='welcome-icon'><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 115.98 122.88" style="enable-background:new 0 0 115.98 122.88" xml:space="preserve"><g><path d="M17.2,0h59.47c4.73,0,9.03,1.93,12.15,5.05c3.12,3.12,5.05,7.42,5.05,12.15v38.36c0,4.73-1.93,9.03-5.05,12.15 c-3.12,3.12-7.42,5.05-12.15,5.05H46.93L20.81,95.21c-1.21,1.04-3.04,0.9-4.08-0.32c-0.51-0.6-0.74-1.34-0.69-2.07l1.39-20.07H17.2 c-4.73,0-9.03-1.93-12.15-5.05C1.93,64.59,0,60.29,0,55.56V17.2c0-4.73,1.93-9.03,5.05-12.15C8.16,1.93,12.46,0,17.2,0L17.2,0z M102.31,27.98c3.37,0.65,6.39,2.31,8.73,4.65c3.05,3.05,4.95,7.26,4.95,11.9v38.36c0,4.64-1.89,8.85-4.95,11.9 c-3.05,3.05-7.26,4.95-11.9,4.95h-0.61l1.42,20.44l0,0c0.04,0.64-0.15,1.3-0.6,1.82c-0.91,1.07-2.52,1.19-3.58,0.28l-26.22-23.2 H35.01l17.01-17.3h36.04c7.86,0,14.3-6.43,14.3-14.3V29.11C102.35,28.73,102.34,28.35,102.31,27.98L102.31,27.98z M25.68,43.68 c-1.6,0-2.9-1.3-2.9-2.9c0-1.6,1.3-2.9,2.9-2.9h30.35c1.6,0,2.9,1.3,2.9,2.9c0,1.6-1.3,2.9-2.9,2.9H25.68L25.68,43.68z M25.68,29.32c-1.6,0-2.9-1.3-2.9-2.9c0-1.6,1.3-2.9,2.9-2.9H68.7c1.6,0,2.9,1.3,2.9,2.9c0,1.6-1.3,2.9-2.9,2.9H25.68L25.68,29.32z M76.66,5.8H17.2c-3.13,0-5.98,1.28-8.05,3.35C7.08,11.22,5.8,14.06,5.8,17.2v38.36c0,3.13,1.28,5.98,3.35,8.05 c2.07,2.07,4.92,3.35,8.05,3.35h3.34v0.01l0.19,0.01c1.59,0.11,2.8,1.49,2.69,3.08l-1.13,16.26L43.83,67.8 c0.52-0.52,1.24-0.84,2.04-0.84h30.79c3.13,0,5.98-1.28,8.05-3.35c2.07-2.07,3.35-4.92,3.35-8.05V17.2c0-3.13-1.28-5.98-3.35-8.05 C82.65,7.08,79.8,5.8,76.66,5.8L76.66,5.8z"></path></g></svg></div>
                        <h4>What can I help with?</h4>
                    </div>
                </div>
            </div>`);
}
function jsonToQueryString(json) {
    return Object.keys(json)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(json[key]))
        .join('&');
}
function markdownToHTML(mdData) {
    var converter = new showdown.Converter();

    return converter.makeHtml(mdData);
}
function addLogiksAIEventListener(funcType, func) {
    if(LOGIKSAI_EVENT_LISTENERS[funcType]==null) return false;

    LOGIKSAI_EVENT_LISTENERS[funcType].push(func);
    return true;
}
</script>