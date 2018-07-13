// 导航
var menu = document.querySelector('.menu')
var menua = menu.getElementsByTagName('a')[0]
var menuPop = document.querySelector('.menu-pop')
var popBj = document.querySelector('.pop-bj')
var key1 = true
menua.addEventListener('click',function(){
  if(key1){
    menuPop.className = 'menu-pop show'
    popBj.className = 'pop-bj show'
    popBj.style.display = 'block'
    key1 = false
  }else{
    menuPop.className = 'menu-pop hide'
    popBj.className = 'pop-bj hide'
    popBj.style.display = 'none'
    key1 = true
  }
},false)
popBj.addEventListener('click',function(){
  menuPop.className = 'menu-pop hide'
  this.className = 'pop-bj hide'
  this.style.display = 'none'
  key1 = true
},false)


var indexKey = document.querySelector('.index-key')
if(indexKey){
//媒体-更多
var mtList = document.querySelector('.media .list')
var mtMore = document.querySelector('.media .more')
var key2 = true
mtMore.addEventListener('click',function(){
  if(key2){
    this.getElementsByTagName('span')[0].innerHTML = '收起'
    this.getElementsByTagName('i')[0].innerHTML = '&#xe6de;'
    mtList.className = 'list show'
    key2 = false
  }else{
    this.getElementsByTagName('span')[0].innerHTML = '展开更多'
    this.getElementsByTagName('i')[0].innerHTML = '&#xe661;'
    mtList.className = 'list hide'
    key2 = true
  }
},false)

//银行-更多
var yhList = document.querySelector('.bank .list')
var yhMore = document.querySelector('.bank .more')
var key2 = true
yhMore.addEventListener('click',function(){
  if(key2){
    this.getElementsByTagName('span')[0].innerHTML = '收起'
    this.getElementsByTagName('i')[0].innerHTML = '&#xe6de;'
    yhList.className = 'list show'
    key2 = false
  }else{
    this.getElementsByTagName('span')[0].innerHTML = '展开更多'
    this.getElementsByTagName('i')[0].innerHTML = '&#xe661;'
    yhList.className = 'list hide'
    key2 = true
  }
},false)

//选项卡
var weBtn = document.querySelector('.we .left-menu').getElementsByTagName('ul')[0].getElementsByTagName('li')
var weText = document.querySelector('.we .right-con').getElementsByTagName('ul')[0].getElementsByTagName('li')

var newsBtn = document.querySelector('.news .menu').getElementsByTagName('a')
var newsText = document.querySelector('.news .con').getElementsByTagName('ul')[0].getElementsByTagName('li')

function tab(btn,con){
  for(var i=0; i<btn.length; i++){
    btn[i].index=i;
    btn[i].onclick=function(){
      for(var i=0;i<btn.length;i++){
        btn[i].className= '';
        con[i].className='';
      }
  　　this.className='on';
      con[this.index].className='show';　
    };
  }
}

tab(weBtn,weText)
tab(newsBtn,newsText)

}

var formKey = document.querySelector('.form-key')
if(formKey){
var input1 = document.querySelector('.upload-input1')
var preview1 = document.querySelector('.upload-img1');
var input2 = document.querySelector('.upload-input2')
var preview2 = document.querySelector('.upload-img2');
var input3 = document.querySelector('.upload-input3')
var preview3 = document.querySelector('.upload-img3');
//封装函数
function upload(ebtn,eimg){
  ebtn.onchange = function(){
    var file  = ebtn.files[0];
    var reader = new FileReader();
    reader.onloadend = function () {
     eimg.src = reader.result;
    }
    if(file) {
     reader.readAsDataURL(file);
    } else {
     eimg.src = "";
    }
  }
}
//调用
upload(input1,preview1)
upload(input2,preview2)
upload(input3,preview3)


}
























//end
