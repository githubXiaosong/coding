angular.module('live', [])

    .controller('LiveController', [
        '$scope',
        '$http',
        function ($scope, $http) {

<<<<<<< HEAD
            //IE9(含)以下浏览器用到的jsonp回调函数
            function jsonpCallback(rspData) {
                //设置接口返回的数据
                webim.setJsonpLastRspData(rspData);
            }

//监听大群新消息（普通，点赞，提示，红包）
            function onBigGroupMsgNotify(msgList) {
=======

>>>>>>> origin/master
                /**
                 * 但是如果说是没有msg可以显示的化就直接跳过这个for循环了 但是onBigGroupMshNotify函数还是会执行
                 // */
                for (var i = msgList.length - 1; i >= 0; i--) {//遍历消息，按照时间从后往前
                    var msg = msgList[i];

                    //显示收到的消息
                    showMsg(msg);
                }
            }

//监听新消息(私聊(包括普通消息、全员推送消息)，普通群(非直播聊天室)消息)事件
//newMsgList 为新消息数组，结构为[Msg]
            function onMsgNotify(newMsgList) {
                var newMsg;
                for (var j in newMsgList) {//遍历新消息
                    newMsg = newMsgList[j];
                    handlderMsg(newMsg);//处理新消息
                }
            }

//处理消息（私聊(包括普通消息和全员推送消息)，普通群(非直播聊天室)消息）
            function handlderMsg(msg) {
                var fromAccount, fromAccountNick, sessType, subType, contentHtml;

                fromAccount = msg.getFromAccount();
                if (!fromAccount) {
                    fromAccount = '';
                }
                fromAccountNick = msg.getFromAccountNick();
                if (!fromAccountNick) {
                    fromAccountNick = fromAccount;
                }

                //解析消息
                //获取会话类型
                //webim.SESSION_TYPE.GROUP-群聊，
                //webim.SESSION_TYPE.C2C-私聊，
                sessType = msg.getSession().type();
                //获取消息子类型
                //会话类型为群聊时，子类型为：webim.GROUP_MSG_SUB_TYPE
                //会话类型为私聊时，子类型为：webim.C2C_MSG_SUB_TYPE
                subType = msg.getSubType();

                switch (sessType) {
                    case webim.SESSION_TYPE.C2C://私聊消息
                        switch (subType) {
                            case webim.C2C_MSG_SUB_TYPE.COMMON://c2c普通消息
                                //业务可以根据发送者帐号fromAccount是否为app管理员帐号，来判断c2c消息是否为全员推送消息，还是普通好友消息
                                //或者业务在发送全员推送消息时，发送自定义类型(webim.MSG_ELEMENT_TYPE.CUSTOM,即TIMCustomElem)的消息，在里面增加一个字段来标识消息是否为推送消息
                                contentHtml = convertMsgtoHtml(msg);
                                webim.Log.warn('receive a new c2c msg: fromAccountNick=' + fromAccountNick + ", content=" + contentHtml);
                                //c2c消息一定要调用已读上报接口
                                var opts = {
                                    'To_Account': fromAccount,//好友帐号
                                    'LastedMsgTime': msg.getTime()//消息时间戳
                                };
                                webim.c2CMsgReaded(opts);
                                alert('收到一条c2c消息(好友消息或者全员推送消息): 发送人=' + fromAccountNick + ", 内容=" + contentHtml);
                                break;
                        }
                        break;
                    case webim.SESSION_TYPE.GROUP://普通群消息，对于直播聊天室场景，不需要作处理
                        break;
                }
            }

//sdk登录
            function sdkLogin() {
                //web sdk 登录
                webim.login(loginInfo, listeners, options,
                    function (identifierNick) {
                        //identifierNick为登录用户昵称(没有设置时，为帐号)，无登录态时为空
                        webim.Log.info('webim登录成功');
                        applyJoinBigGroup(avChatRoomId);//加入大群
                        hideDiscussForm();//隐藏评论表单
                        initEmotionUL();//初始化表情
                    },
                    function (err) {
                        alert(err.ErrorInfo);
                    }
                );//
            }

//进入大群
            function applyJoinBigGroup(groupId) {
                var options = {
                    'GroupId': groupId//群id
                };
                webim.applyJoinBigGroup(
                    options,
                    function (resp) {
                        //JoinedSuccess:加入成功; WaitAdminApproval:等待管理员审批
                        if (resp.JoinedStatus && resp.JoinedStatus == 'JoinedSuccess') {
                            webim.Log.info('进群成功');
                            selToID = groupId;
                        } else {
                            alert('进群失败');
                        }
                    },
                    function (err) {
                        alert(err.ErrorInfo);
                    }
                );
            }

//显示消息（群普通+点赞+提示+红包）
            function showMsg(msg) {
                /**
                 *   there is judge to text or G2C and C2C?
                 */
                switch (msg.getSubType()) {
                    case webim.GROUP_MSG_SUB_TYPE.COMMON://群普通消息
                        addDanMu(getTextFromMsg(msg), '#fff', 1, 0);
                        break;
                    default :
                        break;
                }
            }

            function getTextFromMsg(msg) {
                return (msg.getElems())[0].getContent().getText();
            }

//tls登录
            function tlsLogin() {
                //跳转到TLS登录页面
                TLSHelper.goLogin({
                    sdkappid: loginInfo.sdkAppID,
                    acctype: loginInfo.accountType,
                    url: window.location.href
                });
            }

//第三方应用需要实现这个函数，并在这里拿到UserSig
            function tlsGetUserSig(res) {
                //成功拿到凭证
                if (res.ErrorCode == webim.TLS_ERROR_CODE.OK) {
                    //从当前URL中获取参数为identifier的值
                    loginInfo.identifier = webim.Tool.getQueryString("identifier");
                    //拿到正式身份凭证
                    loginInfo.userSig = res.UserSig;
                    //从当前URL中获取参数为sdkappid的值
                    loginInfo.sdkAppID = loginInfo.appIDAt3rd = Number(webim.Tool.getQueryString("sdkappid"));
                    //从cookie获取accountType
                    var accountType = webim.Tool.getCookie('accountType');
                    if (accountType) {
                        loginInfo.accountType = accountType;
                        sdkLogin();//sdk登录
                    } else {
                        location.href = location.href.replace(/\?.*$/gi, "");
                    }
                } else {
                    //签名过期，需要重新登录
                    if (res.ErrorCode == webim.TLS_ERROR_CODE.SIGNATURE_EXPIRATION) {
                        tlsLogin();
                    } else {
                        alert("[" + res.ErrorCode + "]" + res.ErrorInfo);
                    }
                }
            }

            //把回调函数挂到windos上来
            window.tlsGetUserSig = tlsGetUserSig;

//单击图片事件
            function imageClick(imgObj) {
                var imgUrls = imgObj.src;
                var imgUrlArr = imgUrls.split("#"); //字符分割
                var smallImgUrl = imgUrlArr[0];//小图
                var bigImgUrl = imgUrlArr[1];//大图
                var oriImgUrl = imgUrlArr[2];//原图
                webim.Log.info("小图url:" + smallImgUrl);
                webim.Log.info("大图url:" + bigImgUrl);
                webim.Log.info("原图url:" + oriImgUrl);
            }


//切换播放audio对象
            function onChangePlayAudio(obj) {
                if (curPlayAudio) {//如果正在播放语音
                    if (curPlayAudio != obj) {//要播放的语音跟当前播放的语音不一样
                        curPlayAudio.currentTime = 0;
                        curPlayAudio.pause();
                        curPlayAudio = obj;
                    }
                } else {
                    curPlayAudio = obj;//记录当前播放的语音
                }
            }

//单击评论图片
            function smsPicClick() {
                if (!loginInfo.identifier) {//未登录
                    if (accountMode == 1) {//托管模式
                        //将account_type保存到cookie中,有效期是1天
                        webim.Tool.setCookie('accountType', loginInfo.accountType, 3600 * 24);
                        //调用tls登录服务
                        tlsLogin();
                    } else {//独立模式
                        alert('请填写帐号和票据');
                    }
                    return;
                } else {
                    hideDiscussTool();//隐藏评论工具栏
                    showDiscussForm();//显示评论表单
                }
            }

//发送消息(普通消息)
            function onSendMsg() {

                if (!loginInfo.identifier) {//未登录
                    if (accountMode == 1) {//托管模式
                        //将account_type保存到cookie中,有效期是1天
                        webim.Tool.setCookie('accountType', loginInfo.accountType, 3600 * 24);
                        //调用tls登录服务
                        tlsLogin();
                    } else {//独立模式
                        alert('请填写帐号和票据');
                    }
                    return;
                }

                if (!selToID) {
                    alert("您还没有进入房间，暂不能聊天");
                    $("#send_msg_text").val('');
                    return;
                }
                //获取消息内容
                var msgtosend = $("#send_msg_text").val();
                var msgLen = webim.Tool.getStrBytes(msgtosend);

                if (msgtosend.length < 1) {
                    alert("发送的消息不能为空!");
                    return;
                }

                var maxLen, errInfo;
                if (selType == webim.SESSION_TYPE.GROUP) {
                    maxLen = webim.MSG_MAX_LENGTH.GROUP;
                    errInfo = "消息长度超出限制(最多" + Math.round(maxLen / 3) + "汉字)";
                } else {
                    maxLen = webim.MSG_MAX_LENGTH.C2C;
                    errInfo = "消息长度超出限制(最多" + Math.round(maxLen / 3) + "汉字)";
                }
                if (msgLen > maxLen) {
                    alert(errInfo);
                    return;
                }

                if (!selSess) {
                    selSess = new webim.Session(selType, selToID, selToID, selSessHeadUrl, Math.round(new Date().getTime() / 1000));
                }
                var isSend = true;//是否为自己发送
                var seq = -1;//消息序列，-1表示sdk自动生成，用于去重
                var random = Math.round(Math.random() * 4294967296);//消息随机数，用于去重
                var msgTime = Math.round(new Date().getTime() / 1000);//消息时间戳
                var subType;//消息子类型
                if (selType == webim.SESSION_TYPE.GROUP) {
                    //群消息子类型如下：
                    //webim.GROUP_MSG_SUB_TYPE.COMMON-普通消息,
                    //webim.GROUP_MSG_SUB_TYPE.LOVEMSG-点赞消息，优先级最低
                    //webim.GROUP_MSG_SUB_TYPE.TIP-提示消息(不支持发送，用于区分群消息子类型)，
                    //webim.GROUP_MSG_SUB_TYPE.REDPACKET-红包消息，优先级最高
                    subType = webim.GROUP_MSG_SUB_TYPE.COMMON;

                } else {
                    //C2C消息子类型如下：
                    //webim.C2C_MSG_SUB_TYPE.COMMON-普通消息,
                    subType = webim.C2C_MSG_SUB_TYPE.COMMON;
                }
                var msg = new webim.Msg(selSess, isSend, seq, random, msgTime, loginInfo.identifier, subType, loginInfo.identifierNick);
                //解析文本和表情
                var expr = /\[[^[\]]{1,3}\]/mg;
                var emotions = msgtosend.match(expr);
                var text_obj, face_obj, tmsg, emotionIndex, emotion, restMsgIndex;
                if (!emotions || emotions.length < 1) {
                    text_obj = new webim.Msg.Elem.Text(msgtosend);
                    msg.addText(text_obj);
                } else {//有表情

                    for (var i = 0; i < emotions.length; i++) {
                        tmsg = msgtosend.substring(0, msgtosend.indexOf(emotions[i]));
                        if (tmsg) {
                            text_obj = new webim.Msg.Elem.Text(tmsg);
                            msg.addText(text_obj);
                        }
                        emotionIndex = webim.EmotionDataIndexs[emotions[i]];
                        emotion = webim.Emotions[emotionIndex];
                        if (emotion) {
                            face_obj = new webim.Msg.Elem.Face(emotionIndex, emotions[i]);
                            msg.addFace(face_obj);
                        } else {
                            text_obj = new webim.Msg.Elem.Text(emotions[i]);
                            msg.addText(text_obj);
                        }
                        restMsgIndex = msgtosend.indexOf(emotions[i]) + emotions[i].length;
                        msgtosend = msgtosend.substring(restMsgIndex);
                    }
                    if (msgtosend) {
                        text_obj = new webim.Msg.Elem.Text(msgtosend);
                        msg.addText(text_obj);
                    }
                }
                webim.sendMsg(msg, function (resp) {
                    if (selType == webim.SESSION_TYPE.C2C) {//私聊时，在聊天窗口手动添加一条发的消息，群聊时，长轮询接口会返回自己发的消息
                        showMsg(msg);
                    }
                    webim.Log.info("发消息成功");
                    $("#send_msg_text").val('');

                    hideDiscussForm();//隐藏评论表单
                    showDiscussTool();//显示评论工具栏
                    hideDiscussEmotion();//隐藏表情
                }, function (err) {
                    webim.Log.error("发消息失败:" + err.ErrorInfo);
                    alert("发消息失败:" + err.ErrorInfo);
                });
            }

//发送消息(群点赞消息)
            function sendGroupLoveMsg() {

                if (!loginInfo.identifier) {//未登录
                    if (accountMode == 1) {//托管模式
                        //将account_type保存到cookie中,有效期是1天
                        webim.Tool.setCookie('accountType', loginInfo.accountType, 3600 * 24);
                        //调用tls登录服务
                        tlsLogin();
                    } else {//独立模式
                        alert('请填写帐号和票据');
                    }
                    return;
                }

                if (!selToID) {
                    alert("您还没有进入房间，暂不能点赞");
                    return;
                }

                if (!selSess) {
                    selSess = new webim.Session(selType, selToID, selToID, selSessHeadUrl, Math.round(new Date().getTime() / 1000));
                }
                var isSend = true;//是否为自己发送
                var seq = -1;//消息序列，-1表示sdk自动生成，用于去重
                var random = Math.round(Math.random() * 4294967296);//消息随机数，用于去重
                var msgTime = Math.round(new Date().getTime() / 1000);//消息时间戳
                //群消息子类型如下：
                //webim.GROUP_MSG_SUB_TYPE.COMMON-普通消息,
                //webim.GROUP_MSG_SUB_TYPE.LOVEMSG-点赞消息，优先级最低
                //webim.GROUP_MSG_SUB_TYPE.TIP-提示消息(不支持发送，用于区分群消息子类型)，
                //webim.GROUP_MSG_SUB_TYPE.REDPACKET-红包消息，优先级最高
                var subType = webim.GROUP_MSG_SUB_TYPE.LOVEMSG;

                var msg = new webim.Msg(selSess, isSend, seq, random, msgTime, loginInfo.identifier, subType, loginInfo.identifierNick);
                var msgtosend = 'love_msg';
                var text_obj = new webim.Msg.Elem.Text(msgtosend);
                msg.addText(text_obj);

                webim.sendMsg(msg, function (resp) {
                    if (selType == webim.SESSION_TYPE.C2C) {//私聊时，在聊天窗口手动添加一条发的消息，群聊时，长轮询接口会返回自己发的消息
                        showMsg(msg);
                    }
                    webim.Log.info("点赞成功");
                }, function (err) {
                    webim.Log.error("发送点赞消息失败:" + err.ErrorInfo);
                    alert("发送点赞消息失败:" + err.ErrorInfo);
                });
            }

//隐藏评论文本框
            function hideDiscussForm() {
                $(".video-discuss-form").hide();
            }

//显示评论文本框
            function showDiscussForm() {
                $(".video-discuss-form").show();
            }

//隐藏评论工具栏
            function hideDiscussTool() {
                $(".video-discuss-tool").hide();
            }

//显示评论工具栏
            function showDiscussTool() {
                $(".video-discuss-tool").show();
            }

//隐藏表情框
            function hideDiscussEmotion() {
                $(".video-discuss-emotion").hide();
                //$(".video-discuss-emotion").fadeOut("slow");
            }

//显示表情框
            function showDiscussEmotion() {
                $(".video-discuss-emotion").show();
                //$(".video-discuss-emotion").fadeIn("slow");

            }

//展示点赞动画
            function showLoveMsgAnimation() {
                //点赞数加1
                var loveCount = $('#user-icon-like').html();
                $('#user-icon-like').html(parseInt(loveCount) + 1);
                var toolDiv = document.getElementById("video-discuss-tool");
                var loveSpan = document.createElement("span");
                var colorList = ['red', 'green', 'blue'];
                var max = colorList.length - 1;
                var min = 0;
                var index = parseInt(Math.random() * (max - min + 1) + min, max + 1);
                var color = colorList[index];
                loveSpan.setAttribute('class', 'like-icon zoomIn ' + color);
                toolDiv.appendChild(loveSpan);
            }

//初始化表情
            function initEmotionUL() {
                for (var index in webim.Emotions) {
                    var emotions = $('<img>').attr({
                        "id": webim.Emotions[index][0],
                        "src": webim.Emotions[index][1],
                        "style": "cursor:pointer;"
                    }).click(function () {
                        selectEmotionImg(this);
                    });
                    $('<li>').append(emotions).appendTo($('#emotionUL'));
                }
            }

//打开或显示表情
            function showEmotionDialog() {
                if (openEmotionFlag) {//如果已经打开
                    openEmotionFlag = false;
                    hideDiscussEmotion();//关闭
                } else {//如果未打开
                    openEmotionFlag = true;
                    showDiscussEmotion();//打开
                }
            }

//选中表情
            function selectEmotionImg(selImg) {
                $("#send_msg_text").val($("#send_msg_text").val() + selImg.id);
            }

//退出大群
            function quitBigGroup() {
                var options = {
                    'GroupId': avChatRoomId//群id
                };
<<<<<<< HEAD
                webim.quitBigGroup(
                    options,
                    function (resp) {

                        webim.Log.info('退群成功');
                        $("#video_sms_list").find("li").remove();
                        //webim.Log.error('进入另一个大群:'+avChatRoomId2);
                        //applyJoinBigGroup(avChatRoomId2);//加入大群
                    },
                    function (err) {
                        alert(err.ErrorInfo);
                    }
                );
            }

//登出
            function logout() {
                //登出
                webim.logout(
                    function (resp) {
                        webim.Log.info('登出成功');
                        loginInfo.identifier = null;
                        loginInfo.userSig = null;
                        $("#video_sms_list").find("li").remove();
                        var indexUrl = window.location.href;
                        var pos = indexUrl.indexOf('?');
                        if (pos >= 0) {
                            indexUrl = indexUrl.substring(0, pos);
                        }
                        window.location.href = indexUrl;
                    }
                );
            }


//--------------------------------------------------
            //监听 申请加群 系统消息
            function onApplyJoinGroupRequestNotify(notify) {
                webim.Log.warn("执行 加群申请 回调：" + JSON.stringify(notify));
                var timestamp = notify.MsgTime;
                var reportTypeCh = "[申请加群]";
                var content = notify.Operator_Account + "申请加入你的群";
                showGroupSystemMsg(notify.ReportType, reportTypeCh, notify.GroupId, notify.GroupName, content, timestamp);
            }

//监听 申请加群被同意 系统消息
            function onApplyJoinGroupAcceptNotify(notify) {
                webim.Log.warn("执行 申请加群被同意 回调：" + JSON.stringify(notify));
                var reportTypeCh = "[申请加群被同意]";
                var content = notify.Operator_Account + "同意你的加群申请，附言：" + notify.RemarkInfo;
                showGroupSystemMsg(notify.ReportType, reportTypeCh, notify.GroupId, notify.GroupName, content, notify.MsgTime);
            }

//监听 申请加群被拒绝 系统消息
            function onApplyJoinGroupRefuseNotify(notify) {
                webim.Log.warn("执行 申请加群被拒绝 回调：" + JSON.stringify(notify));
                var reportTypeCh = "[申请加群被拒绝]";
                var content = notify.Operator_Account + "拒绝了你的加群申请，附言：" + notify.RemarkInfo;
                showGroupSystemMsg(notify.ReportType, reportTypeCh, notify.GroupId, notify.GroupName, content, notify.MsgTime);
            }

//监听 被踢出群 系统消息
            function onKickedGroupNotify(notify) {
                webim.Log.warn("执行 被踢出群  回调：" + JSON.stringify(notify));
                var reportTypeCh = "[被踢出群]";
                var content = "你被管理员" + notify.Operator_Account + "踢出该群";
                showGroupSystemMsg(notify.ReportType, reportTypeCh, notify.GroupId, notify.GroupName, content, notify.MsgTime);
            }

//监听 解散群 系统消息
            function onDestoryGroupNotify(notify) {
                webim.Log.warn("执行 解散群 回调：" + JSON.stringify(notify));
                var reportTypeCh = "[群被解散]";
                var content = "群主" + notify.Operator_Account + "已解散该群";
                showGroupSystemMsg(notify.ReportType, reportTypeCh, notify.GroupId, notify.GroupName, content, notify.MsgTime);
            }

//监听 创建群 系统消息
            function onCreateGroupNotify(notify) {
                webim.Log.warn("执行 创建群 回调：" + JSON.stringify(notify));
                var reportTypeCh = "[创建群]";
                var content = "你创建了该群";
                showGroupSystemMsg(notify.ReportType, reportTypeCh, notify.GroupId, notify.GroupName, content, notify.MsgTime);
            }

//监听 被邀请加群 系统消息
            function onInvitedJoinGroupNotify(notify) {
                webim.Log.warn("执行 被邀请加群  回调: " + JSON.stringify(notify));
                var reportTypeCh = "[被邀请加群]";
                var content = "你被管理员" + notify.Operator_Account + "邀请加入该群";
                showGroupSystemMsg(notify.ReportType, reportTypeCh, notify.GroupId, notify.GroupName, content, notify.MsgTime);
            }

//监听 主动退群 系统消息
            function onQuitGroupNotify(notify) {
                webim.Log.warn("执行 主动退群  回调： " + JSON.stringify(notify));
                var reportTypeCh = "[主动退群]";
                var content = "你退出了该群";
                showGroupSystemMsg(notify.ReportType, reportTypeCh, notify.GroupId, notify.GroupName, content, notify.MsgTime);
            }

//监听 被设置为管理员 系统消息
            function onSetedGroupAdminNotify(notify) {
                webim.Log.warn("执行 被设置为管理员  回调：" + JSON.stringify(notify));
                var reportTypeCh = "[被设置为管理员]";
                var content = "你被群主" + notify.Operator_Account + "设置为管理员";
                showGroupSystemMsg(notify.ReportType, reportTypeCh, notify.GroupId, notify.GroupName, content, notify.MsgTime);
            }

//监听 被取消管理员 系统消息
            function onCanceledGroupAdminNotify(notify) {
                webim.Log.warn("执行 被取消管理员 回调：" + JSON.stringify(notify));
                var reportTypeCh = "[被取消管理员]";
                var content = "你被群主" + notify.Operator_Account + "取消了管理员资格";
                showGroupSystemMsg(notify.ReportType, reportTypeCh, notify.GroupId, notify.GroupName, content, notify.MsgTime);
            }

//监听 群被回收 系统消息
            function onRevokeGroupNotify(notify) {
                webim.Log.warn("执行 群被回收 回调：" + JSON.stringify(notify));
                var reportTypeCh = "[群被回收]";
                var content = "该群已被回收";
                showGroupSystemMsg(notify.ReportType, reportTypeCh, notify.GroupId, notify.GroupName, content, notify.MsgTime);
            }

//监听 用户自定义 群系统消息
            function onCustomGroupNotify(notify) {
                webim.Log.warn("执行 用户自定义系统消息 回调：" + JSON.stringify(notify));
                var reportTypeCh = "[用户自定义系统消息]";
                var content = notify.UserDefinedField;//群自定义消息数据
                showGroupSystemMsg(notify.ReportType, reportTypeCh, notify.GroupId, notify.GroupName, content, notify.MsgTime);
            }

//监听 群资料变化 群提示消息
            function onGroupInfoChangeNotify(groupInfo) {
                webim.Log.warn("执行 群资料变化 回调： " + JSON.stringify(groupInfo));
                var groupId = groupInfo.GroupId;
                var newFaceUrl = groupInfo.GroupFaceUrl;//新群组图标, 为空，则表示没有变化
                var newName = groupInfo.GroupName;//新群名称, 为空，则表示没有变化
                var newOwner = groupInfo.OwnerAccount;//新的群主id, 为空，则表示没有变化
                var newNotification = groupInfo.GroupNotification;//新的群公告, 为空，则表示没有变化
                var newIntroduction = groupInfo.GroupIntroduction;//新的群简介, 为空，则表示没有变化

                if (newName) {
                    //更新群组列表的群名称
                    //To do
                    webim.Log.warn("群id=" + groupId + "的新名称为：" + newName);
                }
            }


//显示一条群组系统消息
            function showGroupSystemMsg(type, typeCh, group_id, group_name, msg_content, msg_time) {
                var sysMsgStr = "收到一条群系统消息: type=" + type + ", typeCh=" + typeCh + ",群ID=" + group_id + ", 群名称=" + group_name + ", 内容=" + msg_content + ", 时间=" + webim.Tool.formatTimeStamp(msg_time);
                webim.Log.warn(sysMsgStr);
                alert(sysMsgStr);
            }


            function addDanMu(text, color, size, position) {
                $("#danmu").danmu("addDanmu",
                    {text: text, color: color, size: size, position: position, time: $('#danmu').data("nowTime") + 10}
                );
            }

            //监听（多终端同步）群系统消息方法，方法都定义在demo_group_notice.js文件中
            //注意每个数字代表的含义，比如，
            //1表示监听申请加群消息，2表示监听申请加群被同意消息，3表示监听申请加群被拒绝消息等
            var onGroupSystemNotifys = {
                //"1": onApplyJoinGroupRequestNotify, //申请加群请求（只有管理员会收到,暂不支持）
                //"2": onApplyJoinGroupAcceptNotify, //申请加群被同意（只有申请人能够收到,暂不支持）
                //"3": onApplyJoinGroupRefuseNotify, //申请加群被拒绝（只有申请人能够收到,暂不支持）
                //"4": onKickedGroupNotify, //被管理员踢出群(只有被踢者接收到,暂不支持)
                "5": onDestoryGroupNotify, //群被解散(全员接收)
                //"6": onCreateGroupNotify, //创建群(创建者接收,暂不支持)
                //"7": onInvitedJoinGroupNotify, //邀请加群(被邀请者接收,暂不支持)
                //"8": onQuitGroupNotify, //主动退群(主动退出者接收,暂不支持)
                //"9": onSetedGroupAdminNotify, //设置管理员(被设置者接收,暂不支持)
                //"10": onCanceledGroupAdminNotify, //取消管理员(被取消者接收,暂不支持)
                "11": onRevokeGroupNotify, //群已被回收(全员接收)
                "255": onCustomGroupNotify//用户自定义通知(默认全员接收)
            };


            //监听连接状态回调变化事件
            var onConnNotify = function (resp) {
                switch (resp.ErrorCode) {
                    case webim.CONNECTION_STATUS.ON:
                        webim.Log.warn('连接状态正常...');
                        break;
                    case webim.CONNECTION_STATUS.OFF:
                        webim.Log.warn('连接已断开，无法收到新消息，请检查下你的网络是否正常');
                        break;
                    default:
                        webim.Log.error('未知连接状态,status=' + resp.ErrorCode);
                        break;
                }
            };


            //监听事件 好像是所有的要监听的事件都需要在这里注册
            var listeners = {
                "onConnNotify": onConnNotify, // 监听连接状态回调变化事件 选填
                "onGroupSystemNotifys": onGroupSystemNotifys, //监听（多终端同步）群系统消息事件，必填
                "jsonpCallback": jsonpCallback, //IE9(含)以下浏览器用到的jsonp回调函数,移动端可不填，pc端必填
                "onBigGroupMsgNotify": onBigGroupMsgNotify, //监听新消息(大群)事件，必填
                "onMsgNotify": onMsgNotify,//监听新消息(私聊(包括普通消息和全员推送消息)，普通群(非直播聊天室)消息)事件，必填
                "onGroupInfoChangeNotify": onGroupInfoChangeNotify//监听群资料变化事件，选填
            };


            /**
             * 脚本开始
             */


            //帐号模式，0-表示独立模式，1-表示托管模式
            var accountMode = 1;

            //官方 demo appid,需要开发者自己修改（托管模式）
            var sdkAppID = 1400025455;
            var accountType = 10970;

            var avChatRoomId = '@TGS#aPB2KONEB'; //默认房间群ID，群类型必须是直播聊天室（AVChatRoom），这个为官方测试ID(托管模式)

            //给的一个默认值
            if (webim.Tool.getQueryString("groupid")) {
                avChatRoomId = webim.Tool.getQueryString("groupid");//用户自定义房间群id
            }

            var selType = webim.SESSION_TYPE.GROUP;
            var selToID = avChatRoomId;//当前选中聊天id（当聊天类型为私聊时，该值为好友帐号，否则为群号）


            //当前用户身份
            var loginInfo = {
                'sdkAppID': sdkAppID, //用户所属应用id,必填
                'appIDAt3rd': sdkAppID, //用户所属应用id，必填
                'accountType': accountType, //用户所属应用帐号类型，必填
                'identifier': null, //当前用户ID,必须是否字符串类型，选填
                'identifierNick': "null", //当前用户昵称，选填
                'userSig': null //当前用户身份凭证，必须是字符串类型，选填
                //'headurl': 'img/2016.gif'//当前用户默认头像，选填
            };

            //判断是否已经拿到临时身份凭证
            if (webim.Tool.getQueryString('tmpsig')) {
                if (loginInfo.identifier == null) {
                    webim.Log.info('start fetchUserSig');
                    //获取正式身份凭证，成功后会回调tlsGetUserSig(res)函数
                    TLSHelper.fetchUserSig();
                }
            } else {//未登录,无登录态模式
                //sdk登录
                sdkLogin();
=======
                var player = new TcPlayer('video-container', options);
                window.qcplayer = player;
                console.log(rtmp);


>>>>>>> origin/master

            }


        }
    ])
