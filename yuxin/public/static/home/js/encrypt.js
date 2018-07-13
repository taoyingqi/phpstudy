var encrypt = new JSEncrypt();
// var key = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCNQkGbwLVopNJwUesOcvIc72GH\n'
// + 'brXKIhvtEMXzeMYO3zGFqiQptO+mA9zfvvX1/HF2V+nkY3XtoO+iQpAcM1TprQh+\n'
// + '3FK0aLezBvrwcU0jWGgizHCKagucYaYUH+KPK9OLDiJ1YDlpyYuGWT4MZzKQK7Cw\n'
// + 'wAyiGbFnXq0TlBqT6wIDAQAB';


function setPublicKey(key) {
  encrypt.setPublicKey(key);
}

function knEncrypt(val) {
  return encrypt.encrypt(val);
}