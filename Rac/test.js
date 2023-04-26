


function addItembutton(){
    let a = document.getElementById('navbar-nav');
    let li1 = document.createElement('li');
    li1.innerHTML= "<a class ='nav-link' href='add_item.php'>Add Product</a>";
    a.appendChild(li1);
}
function showList(){
    fetch('http://localhost:8080/test1/api/read_product.php').then(res => res.json()).then(productlist);
}
function showItem(){
    fetch('http://localhost:8080/test1/api/read_product.php').then(res => res.json()).then(showProduct);
}
function showItemAdmin(){
    fetch('http://localhost:8080/test1/api/read_product.php').then(res => res.json()).then(showProductAdmin);
}
function showProduct(res){
    let arr = res.data;
    let row = document.getElementById('itemshow');
    arr.forEach(x => {
        // let col
        let col = document.createElement("div");
        col.className = "col-lg-4 col-md-6";
        let num = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(x.price);

        col.innerHTML=`
        <div class="card">
            <div class="card-header">
                <img class = "card-img-top" src = "img/${x.imgname}" alt="Card image">
            </div>
            <div class="card-body">
                <h5 class ="Item user-select-auto" ><a href="#" onclick="detail_product(${x.id})">${x.name}</a></h5>
                <h6>${num}</h6>
                <p>${x.decs}</p>
            </div>
            <div class="card-footer">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            </div>
        </div>`;
        row.appendChild(col);
        // header.className="card-header";
        // header.innerHTML=`<img class = "card-img-top" src = "img/${x.imgname}" alt="Card image">`;

    });
}
function productlist(res){
    data = res.data;
    tmp=[];
    // let row = document.getElementById("productlist");
    for(let i = 0;i<data.length;i++){
        if (tmp.includes(data[i]['type']))
            continue;
        else{
            tmp.push(data[i]['type']);
        }
    }
    let row = document.getElementById("productlist");
    console.log(tmp);
    for(let i = 0;i<tmp.length;i++){
        tmp1 = document.createElement("div");
        tmp1.className="btn btn-primary border-1";
        tmp1.setAttribute('data-toggle', 'collapse');
        tmp1.setAttribute('data-target',"#"+tmp[i]);
        tmp1.innerHTML=tmp[i];
        tmp2 =document.createElement('div');
        tmp2.id=tmp[i];
        tmp2.className="btn border-2 collapse";
        for(let j=0;j<data.length;j++){
            if(data[j]['type'] === tmp[i]){
                let tmp3=document.createElement('li');
                tmp3.innerHTML=`<a href="#" onclick="detail_product(${data[j]['id']})">${data[j]['name']}</a>`;
                tmp2.appendChild(tmp3);
            }
        }
        row.appendChild(tmp1);
        row.appendChild(tmp2);
    }
}
function showProductAdmin(res){
    let arr = res.data;
    let row = document.getElementById('itemshow');
    arr.forEach(x => {
        // let col
        let col = document.createElement("div");
        col.className = "col-lg-4 col-md-6";
        let num = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(x.price);
        col.innerHTML=`
        <div class="card">
            <div class="card-header">
                <img class = "card-img-top" src = "img/${x.imgname}" alt="Card image">
            </div>
            <div class="card-body">
                <h5 class ="Item user-select-auto"><a href="#" onclick="detail_product(${x.id})">${x.name}</a></h5>
                <h6>${num}</h6>
                <p>${x.decs}</p>
            </div>
            <div>
                <button onclick="removeProduct(this,${x.id})"class="float-right w-25 btn btn-sm btn-danger"><i class="fa-solid fa-trash-can-arrow-up"></i></button>
                <button onclick="updateProduct(${x.id})"class="float-right w-25 btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></button>
            </div>
            <div class="card-footer">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            </div>
        </div>`;
        row.appendChild(col);
        // header.className="card-header";
        // header.innerHTML=`<img class = "card-img-top" src = "img/${x.imgname}" alt="Card image">`;

    });
}
function removeProduct(button,id){
    var details = {
        'id' : id
    };

    var formBody = [];
    for (var property in details) {
        var encodedKey = encodeURIComponent(property);
        var encodedValue = encodeURIComponent(details[property]);
        formBody.push(encodedKey + "=" + encodedValue);
    }
    formBody = formBody.join("&");
    fetch('http://localhost:8080/test1/api/delete_product.php',{
        method:'POST',
        headers:{
            'Content-Type':'application/x-www-form-urlencoded;charset=UTF-8'
        },
        body:formBody
    }).then(res => res.json()).then(json =>{
        if(json.code===0){
            button.parentElement.parentElement.parentElement.remove();
        }

    })
}
function updateProduct(id){
    let a = "updateItem.php?id="+id;
    window.location.href = a;
}
function detail_product(id){
    let a = "Detail.php?id="+id;
    window.location.href = a;
}

/* <div class ="col-lg-4 col-md-6">
<div class="card">
    <div class="card-header">
        <img class = "card-img-top" src = "G-Chrono.jpg" alt="Card image">
    </div>
    <div class="card-body">
        <h5 class ="Item">Gucci G-Chrono</h5>
        <h6>$2,795</h6>
        <p>The G-Chrono watch is defined by the iconic G-shaped bezel, paying homage to the House. The contemporary design lends a modern, sporty look.</p>
    </div>
    <div class="card-footer">
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
    </div>
</div>
</div> */
