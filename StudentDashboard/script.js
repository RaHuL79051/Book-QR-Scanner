const video = document.getElementById("video");
const scannedImage = document.getElementById("scannedImage");
const qrDataLabel = document.getElementById("qrData");
const webcamButton = document.getElementById("webcamButton");
const fileInput = document.getElementById("fileInput");

function parseQRData(qrData) {
  const qrLines = qrData.split('\n');
  const jsonData = {};
  qrLines.forEach(line => {
    const [key, value] = line.split(':').map(str => str.trim());
    if (key === 'Name' || key === 'Author' || key === 'ISBN' || key === 'Title') {
      jsonData[key] = value;
    }
  });
  return jsonData;
}

function processQRCodeData(qrData) {
  const jsonData = parseQRData(qrData);
  console.log(jsonData);
  let Name = document.querySelector('#name')
  let Author = document.querySelector('#author')
  let ISBN = document.querySelector('#isbn')
  let Title = document.querySelector('#title');
  let Dates = document.querySelector('#date');
  Name.value = jsonData.Name;
  Author.value = jsonData.Author;
  ISBN.value = jsonData.ISBN;
  Title.value = jsonData.Title;
  var currentDate = new Date();
  var formattedDate = currentDate.getFullYear() + '-' + ('0' + (currentDate.getMonth() + 1)).slice(-2) + '-' + ('0' + currentDate.getDate()).slice(-2);
  Dates.value = formattedDate;
  console.log(JSON.stringify(jsonData));
}



function showWebcam() {
  qrDataLabel.textContent = "";
  qrDataLabel.style.display = "none";
  scannedImage.style.display = "none";
  video.style.display = "block";
  startWebcamScanning();
}

function startWebcamScanning() {
  if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices
      .getUserMedia({
        video: {
          facingMode: "environment",
        },
      })
      .then(function (stream) {
        video.srcObject = stream;
        video.play();
      })
      .catch(function (error) {
        qrDataLabel.textContent = "Error accessing camera: " + error;
      });
  } else {
    qrDataLabel.textContent = "getUserMedia is not supported";
  }
}

const intervalId = setInterval(() => {
  const canvas = document.createElement("canvas");
  const ctx = canvas.getContext("2d");
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
  ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
  const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
  const code = jsQR(imageData.data, imageData.width, imageData.height);
  if (code) {
    const qrData = code.data;
    qrDataLabel.style.display = "block";
    clearInterval(intervalId);
    const tracks = video.srcObject.getTracks();
    tracks.forEach((track) => track.stop());
    scannedImage.src = canvas.toDataURL();
    scannedImage.style.display = "block";
    video.style.display = "none";
    processQRCodeData(qrData);
  }
}, 100);

function isUrl(str) {
  return str.startsWith("http://") || str.startsWith("https://");
}

webcamButton.addEventListener("click", showWebcam);


let ButttonData = document.querySelector('#webcamButton');
let Counter = false;

ButttonData.addEventListener('click', () => {
  if (!Counter) {
    ButttonData.innerHTML = 'Scan Again';
    Counter = true;
  } else {
    Counter = false;
  }
})


