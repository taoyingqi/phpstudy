var verification = [false, false, false, false, true]; // 验证输入: 手机号, 密码， 确认密码, 验证码, 邀请码
$("#invite_cell").hide();

// 获取url参数
var OrgID = getQueryString('OrgID');
var AgentID = getQueryString('AgentID');
var stamp = '1500000000000';
if (Date.now) {
  stamp = Date.now().toString();
}
onclear();
var accountGroup;
try {
  if (OrgID != null) {
    var original = OrgID + '|' + stamp + '|' + OPENACCOUNT_CONFIG.version;
    var resp_accountgroup = $.ajax({
      type: 'get',
      url: OPENACCOUNT_CONFIG.serverUrl +
        '/openaccountgroup/default?OrgID=' + OrgID + '&TimeStamp=' + stamp + '&Version=' + OPENACCOUNT_CONFIG.version + '&SignMsg=' + md5Encrypt(original),
      contentType: 'application/json',
      async: false,
      cache: false
    }).responseText;
    var orgparams = JSON.parse(resp_accountgroup);
    if (orgparams.status == 0) {
      accountGroup = orgparams.data[0];
    } else {
      $("#systembug").html("系统维护，无法注册！(" + orgparams.status + ")");
      $("#page_disabled").show();
      throw SyntaxError();
    }
  } else if (AgentID != null) {
    // 获取经纪人费率
    var original = AgentID + '|' + stamp + '|' + OPENACCOUNT_CONFIG.version;
    var resp_agenttmplate = $.ajax({
      type: 'get',
      url: OPENACCOUNT_CONFIG.serverUrl +
        '/agentcustomtemplates?AgentID=' + AgentID + '&TimeStamp=' + stamp + '&Version=' + OPENACCOUNT_CONFIG.version + '&SignMsg=' + md5Encrypt(original),
      contentType: 'application/json',
      async: false,
      cache: false
    }).responseText;
    var agentparams = JSON.parse(resp_agenttmplate);
    if (agentparams.status == 0) {
      accountGroup = agentparams.data[0];
    } else {
      $("#systembug").html("系统维护，无法注册！(" + agentparams.status + ")");
      $("#page_disabled").show();
      throw SyntaxError();
    }
  } else {
    verification[4] = false;
    $("#invite_cell").show();
    // $("#systembug").html("系统维护，无法注册！(错误代码： 103)");
    // $("#page_disabled").show();
  }
  // 获取可用银行列表
  var resp_bank = $.ajax({
    type: 'get',
    url: OPENACCOUNT_CONFIG.serverUrl + '/banks?TimeStamp=' + stamp + '&Version=' + OPENACCOUNT_CONFIG.version + '&SignMsg='
      + md5Encrypt(stamp + '|' + OPENACCOUNT_CONFIG.version),
    contentType: 'application/json',
    async: false,
    cache: false
  }).responseText;
  var banks = JSON.parse(resp_bank);
  if (banks.status == 0) {
    for (var i = 0; i < banks.data.length; i++) {
      $("#input_bank").append("<option value='" + banks.data[i].Name + "'>" + banks.data[i].Name + "</option>");
    }
  }
  // 获取公钥
  var resp_publickey = $.ajax({
    type: 'get',
    url: OPENACCOUNT_CONFIG.serverUrl + '/publickey?TimeStamp=' + stamp + '&Version=' + OPENACCOUNT_CONFIG.version + '&SignMsg='
      + md5Encrypt(stamp + '|' + OPENACCOUNT_CONFIG.version),
    contentType: 'application/json',
    async: false,
    cache: false
  }).responseText;
  var publickey = JSON.parse(resp_publickey);
  console.log(publickey);
  if (publickey.status == 0 && publickey.data.length > 0) {
    setPublicKey(publickey.data[0]['PublicKey']);
  } else {
    throw SyntaxError();
  }
} catch (ex) {
  $("#page_disabled").show();
}
// 获取版权信息设置
// $("#customer").html(THIRD_CONFIG.OPENINGConfigTel);
// window.document.getElementById("oem_companylink").setAttribute("href", THIRD_CONFIG.CompanyLink);
// window.document.getElementById("oem_companylink").innerText = THIRD_CONFIG.CompanyLink;
window.document.getElementById("oem_productflag").innerText = THIRD_CONFIG.OPENINGConfigName;
// window.document.getElementById("oem_tel").setAttribute("href", "tel:" + THIRD_CONFIG.OPENINGConfigTel);
// window.document.getElementById("oem_tel").innerText = THIRD_CONFIG.OPENINGConfigTel;
// window.document.getElementById("oem_qq").setAttribute("href", "tencent://message/?uin=" + THIRD_CONFIG.OPENINGConfigQQ);
// window.document.getElementById("oem_qq").innerText = THIRD_CONFIG.OPENINGConfigQQ;
// 读取下载地址
window.document.getElementById("link_windows").setAttribute("href", OPENACCOUNT_CONFIG.WindowsDownloadUrl);
window.document.getElementById("link_android").setAttribute("href", OPENACCOUNT_CONFIG.AndroidDownloadUrl);
window.document.getElementById("link_ios").setAttribute("href", OPENACCOUNT_CONFIG.IosDownloadUrl);
window.document.getElementById("link_ios_mob").setAttribute("href", OPENACCOUNT_CONFIG.IosDownloadUrl);
function as() { window.location.href = "download.html"; }

// 生成二维码
var androidQR = new QRCode(window.document.getElementById("qrcode_andriod"), {
  width: 145,
  height: 145
});
androidQR.makeCode("http://" + window.location.host + "/opening/download.html");
var iosQR = new QRCode(window.document.getElementById("qrcode_ios"), {
  width: 145,
  height: 145
});
iosQR.makeCode(OPENACCOUNT_CONFIG.IosDownloadUrl);

function onblurInvite() {
  var AgentID = $("#invite_code").val();
  if (AgentID.trim() == "") {
    return;
  }
  var original = AgentID + '|' + stamp + '|' + OPENACCOUNT_CONFIG.version;
  var resp_agenttmplate = $.ajax({
    type: 'get',
    url: OPENACCOUNT_CONFIG.serverUrl +
      '/agentcustomtemplates?AgentID=' + AgentID + '&TimeStamp=' + stamp + '&Version=' + OPENACCOUNT_CONFIG.version + '&SignMsg=' + md5Encrypt(original),
    contentType: 'application/json',
    async: false,
    cache: false
  }).responseText;
  var agentres = JSON.parse(resp_agenttmplate);
  if (agentres.status == 0) {
    accountGroup = agentres.data[0];
    $("#error_invite").html("");
    verification[4] = true;
  } else {
    accountGroup = undefined;
    verification[4] = false;
    $("#error_invite").html("该邀请码无效!(" + agentres.status + ")");
  }
}

function onblurTel() {
  verification[0] = false;
  verification[3] = false;
  var tel = $("#input_tel").val().trim();
  if (!/^[0-9]{11}$/.exec(tel)) {
    $("#error_tel").html("手机号格式错误!");
    return;
  }
  tel = encodeURI(knEncrypt(tel)).replace(/\+/g, '%2B');
  var original = tel + '|1|' + stamp + '|' + OPENACCOUNT_CONFIG.version;
  var responseText = $.ajax({
    type: 'get',
    url: OPENACCOUNT_CONFIG.serverUrl +
      '/subaccounts?Params=' + tel + '&Type=1&TimeStamp=' + stamp + '&Version=' + OPENACCOUNT_CONFIG.version + '&SignMsg=' + md5Encrypt(original)
      + '&kntype=1',
    contentType: 'application/json',
    async: false,
    cache: false
  }).responseText;
  var resp = JSON.parse(responseText);
  if (resp.status == 0) {
    if (resp.data.length == 0) {
      verification[0] = true;
      $("#error_tel").html("");
    } else if (resp.data.length > 0) {
      verification[0] = false;
      $("#error_tel").html("该手机号已注册!");
    }
  } else {
    verification[0] = false;
    alert('未连接到服务器');
    window.document.getElementById("input_tel").removeAttribute("onblur");
  }
}

function onblurPwd() {
  var pwd = $("#input_password").val();
  if (stripscript(pwd)) {
    verification[1] = false;
    $("#error_pwd").html("密码包含非法字符!");
  } else if (pwd.length > 32) {
    verification[1] = false;
    $("#error_pwd").html("密码超过最大长度!");
  } else {
    verification[1] = true;
    $("#error_pwd").html("");
  }
}

function onblurPwdConfirm() {
  var pwd = $("#input_password").val();
  var pwd_confrim = $("#input_password_confirm").val();
  if (pwd !== '' && pwd_confrim != pwd) {
    verification[2] = false;
    $("#error_pwd_confirm").html("两次输入密码不一致!");
  } else {
    verification[2] = true;
    $("#error_pwd_confirm").html("");
  }
}

var second = 60;
function onblurVcode() {
  var vcode = $("#input_vcode").val().trim();
  var tel = $("#input_tel").val().trim();
  if (!/^[0-9]{11}$/.exec(tel)) {
    $("#error_tel").html("手机号格式错误!");
    return;
  }
  if (vcode == "") {
    // $("#error_vcode").html("验证码错误!");
    verification[3] = false;
    return;
  }
  tel = encodeURI(knEncrypt(tel)).replace(/\+/g, '%2B');
  var original = tel + '|' + vcode + '|' + stamp + '|' + OPENACCOUNT_CONFIG.version;
  var responseSMS = $.ajax({
    type: 'get',
    url: OPENACCOUNT_CONFIG.serverUrl +
      '/smsverification?Phone=' + tel + '&Code=' + vcode + '&TimeStamp=' + stamp + '&Version=' + OPENACCOUNT_CONFIG.version + '&SignMsg=' + md5Encrypt(original)
      + '&kntype=1',
    contentType: 'application/json',
    async: false,
    cache: false
  }).responseText;
  var smsres = JSON.parse(responseSMS);
  if (smsres.status == 0) {
    verification[3] = true;
    $("#error_vcode").html("");
  } else if (smsres.status == 3003 || smsres.status == 9997) {
    verification[3] = false;
    $("#error_vcode").html("验证码错误!");
  } else {
    alert('未连接到服务器');
    window.document.getElementById("input_vcode").removeAttribute("onblur");
  }
}

function onblurCardno() {
  var cardno = $("#input_cardno").val();
  if (cardno != "" && !/^(\d{16}|\d{19})$/.exec(cardno)) {
    $("#error_cardno").html("请输入正确的银行卡号!");
  } else {
    $("#error_cardno").html("");
  }
}

function oncborule() {
  // if ($("#cbo_rule").is(':checked')) {
  //   $("#btn_ok").removeClass('btn_disabled');
  //   $("#btn_ok").attr("disabled", false);
  // } else {
  //   $("#btn_ok").addClass('btn_disabled');
  //   $("#btn_ok").attr("disabled", true);
  // }
}

function onVcode() {
  var tel = $("#input_tel").val().trim();
  if ((!/^[0-9]{11}$/.exec(tel)) || !verification[0]) {
    console.log(tel);
    alert('手机号格式有误, 请检查！');
    return;
  }
  disabledbutton("btnvcode", true);
  second = 60;
  var timer = window.setInterval(function () {
    $("#btnvcode").html(second + "秒后重试");
    if (second <= 0) {
      $("#btnvcode").html("获取验证码");
      disabledbutton("btnvcode", false);
      window.clearInterval(timer);
    }
    second -= 1;
  }, 1000);
  tel = encodeURI(knEncrypt(tel)).replace(/\+/g, '%2B');
  var original = tel + '|' + stamp + '|' + OPENACCOUNT_CONFIG.version;
  $.ajax({
    url: OPENACCOUNT_CONFIG.serverUrl + '/sms',
    dataType: 'text',
    method: 'POST',
    data: { Phone: tel, TimeStamp: stamp, Version: OPENACCOUNT_CONFIG.version, SignMsg: md5Encrypt(original), kntype: '1' },
    success: function (data) {
      var res = JSON.parse(data);
      if (res.status == 0) {
        // alert("短信发送成功！");
        $("#error_tel").html("<span style='color: green'>短信发送成功!</span>");
      } else {
        alert(res.message);
      }
    },
    error: function (xhr) {
      second = 0;
      alert("短信发送失败，请联系客服开户");
    }
  });
}

function onregist() {
  var tel = $("#input_tel").val().trim();
  var Password = $("#input_password").val();
  var SubAccountName = $("#input_name").val();

  var BankName = $("#input_bank").val();
  var Name = $("#input_cardname").val();
  var BankAccount = $("#input_cardno").val();
  if (accountGroup == undefined) {
    alert('邀请码输入有误，请检查');
    return;
  }
  if (!/^[0-9]{11}$/.exec(tel)) {
    alert("手机号格式错误!");
    return;
  }
  if (SubAccountName == "") {
    alert("姓名不能为空!");
    return;
  }
  if (SubAccountName.length > 16) {
    alert("姓名长度过长!");
    return;
  }
  if (Password == "") {
    alert("密码不能为空!");
    return;
  }
  if (!verification[0]) {
    alert('手机号输入有误，请检查');
    return;
  }
  if (!verification[1]) {
    alert('交易密码输入有误，请检查');
    return;
  }
  if (!verification[2]) {
    alert('确认密码输入有误，请检查');
    return;
  }
  if (!verification[3]) {
    alert('手机验证码输入有误，请检查');
    return;
  }
  if (!verification[4]) {
    alert('邀请码输入有误，请检查');
    return;
  }
  if ($("#cbo_rule").is(':checked') == false) {
    alert('未同意风险揭示书，注册失败!');
    return;
  }
  if (AgentID == null && OrgID == null) {
    AgentID = $("#invite_code").val();
  }
  tel = encodeURI(knEncrypt(tel)).replace(/\+/g, '%2B');
  var parmsJson = {
    Phone: tel,
    AgentID: AgentID,
    OrgID: OrgID,
    ParentAccountID: accountGroup.ParentAccountID,
    SystemID: accountGroup.SystemID,
    SubAccountName: SubAccountName,
    Password: Password,
    AccountType: accountGroup.AccountType,
    MarginTemplateID: accountGroup.MarginTemplateID,
    CommissionTemplateID: accountGroup.CommissionTemplateID,
    RiskTemplateID: accountGroup.RiskTemplateID,
    MonitorID: accountGroup.MonitorID,
    SourceChannel: "扫码开户",
    Notify: true,
    TimeStamp: stamp,
    Version: OPENACCOUNT_CONFIG.version,
    kntype: '1'
  };
  if (Name.trim() != "" || BankAccount.trim() != "") {
    if (BankName == "") {
      alert("必须选择一个银行!");
      return;
    }
    if (Name == "") {
      alert("持卡人名字不能为空!");
      return;
    }
    if (Name.length > 16) {
      alert("持卡人名字长度过长!");
      return;
    }
    if (BankAccount == "") {
      alert("银行卡号不能为空!");
      return;
    }
    if (!/^(\d{16}|\d{19})$/.exec(BankAccount)) {
      alert("请输入正确的银行卡号!");
      return;
    }
    parmsJson.BankName = BankName;
    parmsJson.Name = Name;
    parmsJson.BankAccount = BankAccount;
  }
  if (OrgID == null) {
    parmsJson.OrgID = "";
  }
  if (AgentID == null) {
    parmsJson.AgentID = "";
  }
  var original = "";
  if (parmsJson.OrgID != "" && parmsJson.OrgID != null) {
    original += ('|' + parmsJson.OrgID);
  }
  if (parmsJson.AgentID != "" && parmsJson.AgentID != null) {
    original += ('|' + parmsJson.AgentID);
  }
  original += '|' + parmsJson.Phone + '|' + parmsJson.SubAccountName + '|' + parmsJson.Password + '|' + parmsJson.ParentAccountID + '|' + parmsJson.SystemID
    + '|' + parmsJson.AccountType + '|' + parmsJson.MarginTemplateID + '|' + parmsJson.CommissionTemplateID + '|' + parmsJson.RiskTemplateID;
  if (parmsJson.MonitorID != "") {
    original += ('|' + parmsJson.MonitorID);
  }
  if (parmsJson.BankName != undefined) {
    original += '|' + parmsJson.BankName + '|' + parmsJson.Name + '|' + parmsJson.BankAccount;
  }
  original += '|' + parmsJson.Notify.toString() + '|' + parmsJson.TimeStamp + '|' + parmsJson.Version;
  original = original.substring(1, original.length);
  parmsJson.SignMsg = md5Encrypt(original);
  disabledbutton("btn_ok", true);
  $.ajax({
    url: OPENACCOUNT_CONFIG.serverUrl + '/subaccounts',
    dataType: 'text',
    method: 'PUT',
    data: parmsJson,
    success: function (data) {
      var res = JSON.parse(data);
      if (res.status == 0) {
        window.location.href = "succeed.html?link=" + tel;
      } else if (res.status == 3001) {
        alert("注册成功但发送通知短信失败！");
        window.location.href = "succeed.html?link=" + tel;
      } else {
        alert("注册失败:" + res.message);
      }
    },
    error: function (xhr) {
      console.log(xhr);
      alert("注册失败: " + xhr.responseText);
      disabledbutton("btn_ok", false);
    }
  });
}

function onresetpassword() {
  if (OrgID != null) {
    window.location.href = "password.html?OrgID=" + OrgID;
  } else if (AgentID != null) {
    window.location.href = "password.html?AgentID=" + AgentID;
  } else {
    window.location.href = "password.html";
  }
}

function onclear() {
  $("#input_name").val("");
  $("#input_tel").val("");
  $("#input_vcode").val("");
  $("#input_password").val("");
  $("#input_password_confirm").val("");
  $("#input_cardname").val("");
  $("#input_cardno").val("");
  $("#input_bank").get(0).selectedIndex = 0;
}
