const wrapper = document.querySelector(".wrapper"),
  Name = wrapper.querySelector(".form #Name"),
  Author = wrapper.querySelector(".form #Author"),
  ISBN = wrapper.querySelector(".form #ISBN"),
  Title = wrapper.querySelector(".form #Title"),
  generateBtn = wrapper.querySelector(".form button"),
  qrImg = wrapper.querySelector(".qr-code img");
let preValue;

generateBtn.addEventListener("click", () => {
  let Val1 = Name.value.trim();
  let Val2 = Author.value.trim();
  let Val3 = ISBN.value.trim();
  let Val4 = Title.value.trim();
  let qrValue = `Name: ${Val1} Author: ${Val2} ISBN:${Val3} Title:${Val4}`;
  if (!qrValue || preValue === qrValue) return;
  preValue = qrValue;
  generateBtn.innerText = "Generating QR Code...";
  qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrValue}`;
  let QRDIV = document.querySelector('.qr-code')
  QRDIV.classList.add('active')
  // qrImg.addEventListener("load", () => {
  //   wrapper.classList.add("active");
  //   generateBtn.innerText = "Generate QR Code";
  // });
});

Name.addEventListener("keyup", () => {
  if (!Name.value.trim()) {
    wrapper.classList.remove("active");
    preValue = "";
  }
});