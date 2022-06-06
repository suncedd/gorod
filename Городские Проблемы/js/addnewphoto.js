const fileUploader = document.getElementById('file-uploader');

const reader = new FileReader();
const imageGrid = document.getElementById('image-grid');

fileUploader.addEventListener('change', (event) => {
  const files = event.target.files;
  console.log('files', files);

  const file = files[0];
  reader.readAsDataURL(file);
  
  const feedback = document.getElementById('feedback');
  const msg = `${files[0].name}`;
  feedback.innerHTML = msg;

  reader.addEventListener('load', (event) => {
    const img = document.createElement('img');
    imageGrid.appendChild(img);
    img.src = event.target.result;
    img.alt = file.name;
    img.height = 400;
    img.width = 300;
  });

  const size = file.size;
  console.log('size', size);
  let msgs = '';

  if (size > 1024 * 1024 * 1024) {
    msgs = `<span style="color:red;">Допустимый размер файла составляет 10 МБ. Файл, который вы пытаетесь загрузить, имеет ${returnFileSize(size)}</span>`;
  } 
});


function returnFileSize(number) {
    if(number < 1024) {
      return number + 'bytes';
    } else if(number >= 1024 && number < 1048576) {
      return (number/1024).toFixed(2) + 'KB';
    } else if(number >= 1048576) {
      return (number/1048576).toFixed(2) + 'MB';
}};

