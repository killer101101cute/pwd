document.getElementById("menuToggle").addEventListener("click", function () {
  document.querySelector("nav").classList.toggle("active");
  console.log("wulan dari cantik");
  document.getElementById("txtNama").value = "wulan dari memang cantik";
  document.getElementById("txtPesan").value = "monika ge cion wo";
});

let nama = prompt("Siapa nama kamu?");
alert("Halo, " + nama + "!");
document.getElementById("pesan").innerText = "Halo, " + nama + "!";

document.querySelector("form").addEventListener("submit", function (e) {
  const nama = document.getElementById("txtNama").value.trim();
  const email = document.getElementById("txtEmail").value.trim();
  const pesan = document.getElementById("txtPesan").value.trim();
  if (nama === "" || email === "" || pesan === "") {
    alert("Semua kolom wajib diisi!");
    e.preventDefault();
  } else {
    alert("Terima kasih, " + nama + "! Pesan Anda telah dikirim.");
  }
});
