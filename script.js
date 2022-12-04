console.log("JAVASCRIPT JALAN");

//navigasi menu
const bar = document.getElementById("bar");
const close = document.getElementById("close");
const nav = document.getElementById("navbar");

if (bar) {
  bar.addEventListener("click", () => {
    console.log("TERKLIK");
    nav.classList.add("active");
  });
}

if (close) {
  close.addEventListener("click", () => {
    console.log("TERKLIK");
    nav.classList.remove("active");
  });
}

// validasi registrasi
function validate() {
  var pesanError = "";
  pesanError += validateName(Form.name.value);
  pesanError += validateEmail(Form.email.value);
  pesanError += validatePassword(Form.password.value);

  if (pesanError == "") return true;
  //else {alert(pesanError); return false}
  else {
    document.getElementById("errorMessagesBox").innerHTML = pesanError;
    return false;
  }
}

function validateName(field) {
  if (/[^a-zA-Z ]/.test(field)) return "Nama hanya boleh berisi huruf. \n";
  else return "";
}

function validateEmail(field) {
  if (/[^a-zA-Z0-9\.\@\_\-]/.test(field)) return "Terdapat karakter yang tidak valid pada email. \n";
  else return "";
}

function validatePassword(field) {
  if (field.length < 8) return "Password minimal 8 karakter.\n";
  else if (!/[A-Z]/.test(field)) return "Password harus memuat huruf besar.\n";
  else return "";
}

//LIVESEARCH PRODUCT
let productContainer = document.getElementById("pro-container");
function searchProduct() {
  let keyword = document.getElementById("keyword").value;
  xhttp = new XMLHttpRequest();
  showRes();
  xhttp.open("GET", "dbcust_searchProduct.php?keyword=" + keyword, true);
  console.log(keyword);
  xhttp.send();
  console.log("terkirim!");
}

function showRes() {
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      console.log("konek");
      console.log(xhttp.responseText);
      if (xhttp.responseText) {
        //rubah produk2
        productContainer.innerHTML = xhttp.responseText;
      } else {
        productContainer.innerHTML = "Maaf, produk yang anda cari tidak ditemukan. Silahkan masukkan kata kunci yang lain.";
      }
    }
  };
}

//tampilan gambar besar berubah ketika diklik gambar kecil
var MainImg = document.getElementById("MainImg");
var smallimg = document.getElementsByClassName("SmallImg");

if (MainImg && smallimg) {
  smallimg[0].onclick = function () {
    MainImg.src = smallimg[0].src;
  };
  smallimg[1].onclick = function () {
    MainImg.src = smallimg[1].src;
  };
  smallimg[2].onclick = function () {
    MainImg.src = smallimg[2].src;
  };
  smallimg[3].onclick = function () {
    MainImg.src = smallimg[3].src;
  };
} //tidak jalan, solusi : buat tag script di halaman lgs

//menuju halaman detail
prod = document.getElementsByClassName("pro");
// if (prod) {
//   prod[0].onclick = function () {
//     window.location.href = "product.php";
//   };
// }

//Menambahkan produk ke keranjang
function addToCart(id_product, price) {
  xhttp = new XMLHttpRequest();
  showResult();
  xhttp.open("GET", "dbcust_addToCart.php?id_product=" + id_product + "&price=" + price, true);
  console.log(id_product);
  xhttp.send();
  console.log("terkirim!");
}

function showResult() {
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      console.log("konek");
      console.log(xhttp.responseText);
      if (xhttp.responseText == "!LOGIN") {
        //popup login dahulu
        window.alert("Silahkan login terlebih dahulu!");
        window.location.href = "signin.php";
      } else {
        //popup barang sudah masuk keranjang
        openPopup();
      }
    }
  };
}

//fungsi popup jika barang sudah masuk keranjang
let popup = document.getElementById("popup");
function openPopup() {
  popup.classList.add("open-popup");
}
function closePopup() {
  popup.classList.remove("open-popup");
}

//hapus suatu produk dari cart
function deleteCart(no_cart) {
  xhttp = new XMLHttpRequest();
  showResult2();
  xhttp.open("GET", "dbcust_deleteCart.php?no_cart=" + no_cart, true);
  console.log(no_cart);
  xhttp.send();
  console.log("terkirim!");
}

function showResult2() {
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      console.log("konek");
      console.log(xhttp.responseText);
      if (xhttp.responseText == "DELETED!") {
        window.location.href = "cart.php";
      }
    }
  };
}

//Jika quantity dirubah
function changeQuantity(no_cart, quantity, price, index) {
  xhttp = new XMLHttpRequest();
  showResult3(index);
  xhttp.open("GET", "dbcust_changeQuantity.php?no_cart=" + no_cart + "&quantity=" + quantity + "&price=" + price, true);
  xhttp.send();
  console.log("terkirim!");
}

function showResult3(index) {
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      console.log("konek");
      console.log(xhttp.responseText);
      document.getElementsByClassName("subtotal-pro")[index].innerHTML = xhttp.responseText;
      changeTotal();
    }
  };
}
function changeTotal() {
  let subtotal = document.getElementsByClassName("subtotal-pro");
  let total = 0;
  for (i = 0; i < subtotal.length; i++) {
    total += parseInt(subtotal[i].innerHTML);
  }
  document.getElementById("cart-subtotal").innerHTML = total;
  document.getElementById("cart-total").innerHTML = "<strong>&euro; " + total + ",-</strong>";
}

//Jika size dipilih/dirubah
function selectSize(no_cart, size) {
  xhttp = new XMLHttpRequest();
  showResult4();
  xhttp.open("GET", "dbcust_selectSize.php?no_cart=" + no_cart + "&size=" + size, true);
  xhttp.send();
  console.log("terkirim!");
}

function showResult4() {
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      console.log("konek");
      console.log(xhttp.responseText);
    }
  };
}

//checkout, js hny untuk mengecek apakah seluruh produk sudah diatur
function checkOut() {
  let allOpt = document.getElementsByClassName("size");
  let i;
  let sizeSelected = true;
  for (i = 0; i < allOpt.length; i++) {
    if (allOpt[i].value == "") {
      alert("Pastikan size semua produk sudah dipilih");
      sizeSelected = false;
      break;
    } else {
      console.log("Semua size sudah ada (y)");
    }
  }
  if (sizeSelected) {
    alert("Order created!");
    order();
  }
}
//jika size sudah diatur semuanya, maka dibuat order
function order() {
  window.location.href = "dbcust_addOrder.php";
}

//cancel order
function cancelOrder(order_id) {
  let confirmation = confirm("Are you sure cancelling your order?");
  if (confirmation) {
    xhttp = new XMLHttpRequest();
    showResult5();
    xhttp.open("GET", "dbcust_cancelOrder.php?order_id=" + order_id, true);
    console.log(order_id);
    xhttp.send();
    console.log("terkirim!");
  }
}

function showResult5() {
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      console.log("konek");
      console.log(xhttp.responseText);
      if (xhttp.responseText == "CANCELED!") {
        window.location.href = "track.php";
      }
    }
  };
}

//delete account
function deleteAcc() {
  let confirmation = confirm("Are you sure deleting your account?");
  if (confirmation) {
    window.location.href = "dbcust_deleteAcc.php";
  }
}
//debugging
console.log("JAVASCRIPT JALAN SAMPAI AKHIR");
