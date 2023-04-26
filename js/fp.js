function addbuttonadmin(){
  var a=document.getElementById("showitemadmin");
  a.style.display="inline";
}

function addbuttonlogin(){
  var a=document.getElementById("showlogin");
  a.style.display="inline";
}

function addbuttonlogout(){
  var a=document.getElementById("showlogout");
  a.style.display="inline";
}
//modal
var abc = document.getElementById("myModal");
var btn = document.getElementById("nhapttct");
// var btn2 = document.getElementById("update");
// var def = document.getElementById("modalupdate");
var close = document.getElementsByClassName("close")[0];
// /*  tại sao lại có [0] như  thế này bởi vì mỗi close là một html colection nên khi mình muốn lấy giá trị html thì phải thêm [0]. 
// Nếu mình có 2 cái component cùng class thì khi [0] nó sẽ hiển thị component 1 còn [1] thì nó sẽ hiển thị component 2. */
var close_footer = document.getElementsByClassName("close-footer")[0];
var order = document.getElementsByClassName("order")[0];


// var close_footer1 = document.getElementsByClassName("close-footer")[1];
// var order1 = document.getElementsByClassName("order")[1];
// var close1 = document.getElementsByClassName("close")[1];

btn.onclick = function () {
  abc.style.display = "block";
};
close.onclick = function () {
  abc.style.display = "none";
};
close_footer.onclick = function () {
  abc.style.display = "none";
};
window.onclick = function (event) {
  if (event.target == abc) {
    abc.style.display = "none";
  }
};

var abc2 = document.getElementById("myModal2");
function editct2(id){
  abc2.style.display = "block";
  document.getElementsByName("submit")[1].value=id;
}
function closemd(){
  abc2.style.display="none";
}
function closemd2(){
  abc.style.display="none";
}

//
function editct(id){
  abc.style.display = "block";
  document.getElementsByName("submit")[0].value=id;
}

//chinh sua ti so
function undisableTxt(clickid) {
  document.getElementById("homegoal"+clickid).disabled = false;
  document.getElementById("awaygoal"+clickid).disabled = false;
  document.getElementById("submit"+clickid).disabled = false;
}

//filter cau thu
function myFunction() {
  var input, filter, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  tbody = document.getElementById("tbodyct");
  tr = tbody.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByClassName("tencauthu")[0];
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
  }
}


function selectmatch(id){
  window.location="http://localhost/Test2/formmua.php?id="+ id;
}

function selectbaocao(id){
  window.location="http://localhost/Test2/ADchitietbaocao.php?id="+ id;
}

function send(){
    var arr =document.getElementsByTagName('input');
    var teamname = arr[0].value;
    var hlvname = arr[1].value;
    var logo  =arr[2].value;
    if(teamname==""||hlvname==""||logo==""){
      alert ("Điền đầy đủ thông tin!");
      return;
    }
    
}


