<?php
if(!defined('ROOT')) exit('No direct script access allowed');

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
    background-color: #fff;
    max-width: 1600px;
    height: 97vh;
/*    margin: 0 auto;*/
    overflow: hidden;
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
    width: 44px;
    height: 44px;
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
    padding: 0 20px 45px;
}

.chat-msg-content {
    margin-left: 12px;
    max-width: 70%;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.chat-msg-text {
    background-color: var(--chat-text-bg);
    padding: 15px;
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

.chat-area-footer {
    display: flex;
    border-top: 1px solid #eef2f4;
    width: 100%;
    padding: 10px 20px;
    align-items: center;
    background-color: #fff;
    position: sticky;
    bottom: 0;
    left: 0;
}

.chat-area-footer svg {
    color: #c1c7cd;
    width: 20px;
    flex-shrink: 0;
    cursor: pointer;
}

.chat-area-footer svg:hover {
    color: var(--settings-icon-hover);
}

.chat-area-footer svg+svg {
    margin-left: 12px;
}

.chat-area-footer input {
    border: none;
    color: #000;
    background-color: var(--input-bg);
    padding: 12px;
    border-radius: 6px;
    font-size: 15px;
    margin: 0 12px;
    width: 100%;
}

.chat-area-footer input::placeholder {
    color: #a2a2a2;
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

.chatApp {
    max-width: 500px;
}

.chat-area-footer input {
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
    right: 9px;
    top: 9px;
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

.chat-area-footer svg {
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
    height: 230px;
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
    padding: 26px;
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

.chat-area-footer {
    padding: 10px 15px;
}
.chat-area-footer input:focus{
    outline: none;
}

.mainWrapper{
   float: left;
    width: calc(100% - 500px);
    background: #f3f3f3;
    height: 100vh;
}
.chatApp{
    width: 500px;
    float: left;
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
</style>
    
<div class="chatApp">
    <div class="chat-area">
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
                    <div class="msg-username">LogiksAI</div>
                </div>
            </div>
            <div class="chat-area-group">
                <i class="fa fa-ellipsis-v"></i>
            </div>
        </div>
        <div class="chat-area-main">
            <div class="chat-msg">
                <div class="chat-msg-profile">
                    <img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%283%29+%281%29.png" alt="" />
                    <div class="chat-msg-date">Message seen 1.22pm</div>
                </div>
                <div class="chat-msg-content">
                    <div class="chat-msg-text">Luctus et ultrices posuere cubilia curae.</div>
                    <div class="chat-msg-text">
                        <img src="image/tech-yearender-2022.webp" />
                    </div>
                    <div class="chat-msg-text">Neque gravida in fermentum et sollicitudin ac orci phasellus egestas. Pretium lectus quam id leo.</div>
                </div>
            </div>
            <div class="chat-msg owner">
                <div class="chat-msg-profile">
                    <img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" />
                    <div class="chat-msg-date">Message seen 1.22pm</div>
                </div>
                <div class="chat-msg-content">
                    <div class="chat-msg-text">Sit amet risus nullam eget felis eget. Dolor sed viverra ipsum😂😂😂</div>
                    <div class="chat-msg-text">Cras mollis nec arcu malesuada tincidunt.</div>
                </div>
            </div>
            <div class="chat-msg">
                <div class="chat-msg-profile">
                    <img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%282%29.png" alt="">
                    <div class="chat-msg-date">Message seen 2.45pm</div>
                </div>
                <div class="chat-msg-content">
                    <div class="chat-msg-text">Aenean tristique maximus tortor non tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae😊</div>
                    <div class="chat-msg-text">Ut faucibus pulvinar elementum integer enim neque volutpat.</div>
                </div>
            </div>
            <div class="chat-msg owner">
                <div class="chat-msg-profile">
                    <img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" />
                    <div class="chat-msg-date">Message seen 2.50pm</div>
                </div>
                <div class="chat-msg-content">
                    <div class="chat-msg-text">posuere eget augue sodales, aliquet posuere eros.</div>
                    <div class="chat-msg-text">Cras mollis nec arcu malesuada tincidunt.</div>
                </div>
            </div>
            <div class="chat-msg">
                <div class="chat-msg-profile">
                    <img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%2812%29.png" alt="" />
                    <div class="chat-msg-date">Message seen 3.16pm</div>
                </div>
                <div class="chat-msg-content">
                    <div class="chat-msg-text">Egestas tellus rutrum tellus pellentesque</div>
                </div>
            </div>
            
        </div>
        <div class="chat-area-footer">
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
                    <li>
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
                    </li>
                    
                </ul>
            </div>
            <div class="dropdownIcon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip">
                <path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48" />
            </svg>
          </div>
            <div class="sendBox">
                <input id='sendMessageBox' type="text" placeholder="Type something here..." />
                <i data-v-e08301e8="" class="fa fa-paper-plane"></i>
            </div>
        </div>
    </div>
</div>
<script>
const EVENT_LISTENERS = {
    "ON_SEND": [],
    "ON_RECEIVE": []
};
const LOGIKSAI_DEBUG = <?=defined("LOGIKSAI_DEBUG")?LOGIKSAI_DEBUG:"false"?>;
$(function() {
    
});
function initiateLogiksAIChat(params) {

}
</script>