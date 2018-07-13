function md5Encrypt(item) {
  return md5(URLencode(item) + '|' + OPENACCOUNT_CONFIG.secret_key);
}

function URLencode(str) {
  return str.replace(/\+/g, '%2B');
  // return escape(str).replace(/\+/g, '%2B').replace(/\"/g, '%22').replace(/\'/g, '%27').replace(/\//g, '%2F');
}

function stripscript(s) {
  var pattern = /[+"'^]+/;
  return pattern.exec(s);
}

function getQueryString(name) {
  var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
  var r = window.location.search.substr(1).match(reg);
  if (r != null) return unescape(r[2]); return null;
}

function disabledbutton(id, isdisabled) {
  if (isdisabled) {
    $("#" + id).addClass("disabled")
  } else {
    $("#" + id).removeClass("disabled")
  }
  $("#" + id).attr("disabled", isdisabled);
}

window.console = window.console || (function () {
  var c = {}; c.log = c.warn = c.debug = c.info = c.error = c.time = c.dir = c.profile
    = c.clear = c.exception = c.trace = c.assert = function () { };
  return c;
})();

if (!Array.prototype.filter) {
  Array.prototype.filter = function (fun /*, thisArg */) {
    "use strict";

    if (this === void 0 || this === null)
      throw new TypeError();

    var t = Object(this);
    var len = t.length >>> 0;
    if (typeof fun !== "function")
      throw new TypeError();

    var res = [];
    var thisArg = arguments.length >= 2 ? arguments[1] : void 0;
    for (var i = 0; i < len; i++) {
      if (i in t) {
        var val = t[i];

        // NOTE: Technically this should Object.defineProperty at
        //       the next index, as push can be affected by
        //       properties on Object.prototype and Array.prototype.
        //       But that method's new, and collisions should be
        //       rare, so use the more-compatible alternative.
        if (fun.call(thisArg, val, i, t))
          res.push(val);
      }
    }

    return res;
  };
}

if (!Array.prototype.find) {
  Array.prototype.find = function (callback) {
    return callback && (this.filter(callback) || [])[0];
  };
}

if (!String.prototype.trim) {
  String.prototype.trim = function () {
    return this.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
  }
}


// window.alert = function (name) {
//   var iframe = document.createElement("IFRAME");
//   iframe.style.display = "none";
//   iframe.setAttribute("src", 'data:text/plain,');
//   document.documentElement.appendChild(iframe);
//   window.frames[0].window.alert(name);
//  iframe.parentNode.removeChild(iframe);
// }

// window.confirm = function(name){
//   var iframe = document.createElement("IFRAME");
//   iframe.style.display="none";
//   iframe.setAttribute("src", 'data:text/plain,');
//   document.documentElement.appendChild(iframe);
//   var result = window.frames[0].window.confirm(name);
//   iframe.parentNode.removeChild(iframe);
//   return result;
//   }
